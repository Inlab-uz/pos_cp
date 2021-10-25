<?php

namespace App\Http\Controllers\Blade;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Company;
use App\Models\Meneger;
use App\Models\User;
use App\Services\LogWriter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class MenagerController extends Controller
{
    public function index()
    {
        $id = auth()->user()->id;
        if (auth()->user()->hasRole('Super Admin')){
            $menegers = Meneger::latest()->paginate(20);
        }elseif (auth()->user()->hasRole('Administrator')){
            $branches = Meneger::where('user_id', $id)->paginate(20);
        }
        $menegers = Meneger::latest()->paginate(20);
        return view('pages.meneger.index', [
            'menegers' => $menegers,
        ]);
    }

    public function create()
    {
        $id = auth()->user()->id;
        $company = Company::where('user_id', $id)->first();
        if (auth()->user()->hasRole('Super Admin')){
            $branches = Branch::latest()->paginate(20);
        }elseif (auth()->user()->hasRole('Administrator')){
            $branches = Branch::where('company_id', $company->id)->paginate(20);
        }
        return view('pages.meneger.add', [
            'branches' => $branches
        ]);
    }

    public function store(Request $request)
    {
        $v = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:menegers,email',
            'branch_id' => 'required',
            'password' => 'required|min:8|confirmed',

        ]);

        if ($v->failed()) {
            error_message($v->errors()->first());
            return redirect()->back();
        }

        Meneger::create([
            'name' => $request->name,
            'email' => $request->email,
            'branch_id' => $request->branch_id,
            'password' => Hash::make($request->password),
            'user_id' => auth()->user()->id,
            'company_id' => self::companyid(),

        ]);
        return redirect()->route('menegerIndex')->with("success", "Saved!");
    }

    public function edit($id)
    {
        $company = Company::where('user_id', auth()->user()->id)->first();
        if (auth()->user()->hasRole('Super Admin')){
            $branches = Branch::latest()->paginate(20);
        }elseif (auth()->user()->hasRole('Administrator')){
            $branches = Branch::where('company_id', $company->id)->paginate(20);
        }
        $meneger = Meneger::find($id);

        return view('pages.meneger.edit', compact('meneger', 'branches'));
    }

    public function update(Request $request, $id)
    {



        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:menegers,email,' . $id],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);


        $meneger = Meneger::find($id);
        $meneger->name = $request->name;
        $meneger->email = $request->email;
        $meneger->password = $request->password;
        $meneger->branch_id = $request->branch_id;
        $meneger->user_id = auth()->user()->id;
        $meneger->company_id = self::companyid();
        $meneger->update();
        success_message('Maneger success updated!!!');
        return redirect()->route('menegerIndex');
    }

    public function destroy($id)
    {
        $manager = Meneger::where('id', $id)->first();
        $manager->delete();
        success_message('deleted success');
        return back();
    }
//    STATIC FUNCTIONS ==================================================
    public static function companyid(){
        $companies = auth()->user()->companies;
        foreach ($companies as $company) {
            $company_id = $company['id'];
            return $company_id;
        }
    }
}
