<?php

namespace App\Http\Controllers\Blade;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Cashier;
use App\Models\Company;
use App\Models\Meneger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CashierController extends Controller
{
    public function index()
    {
        $company = Company::where('user_id', auth()->user()->id)->first();
        $cashiers = Cashier::where('company_id', 0)->paginate(20);
        if ($company){

            if (auth()->user()->hasRole('Super Admin')){
                $cashiers = Cashier::latest()->paginate(20);
            }elseif (auth()->user()->hasRole('Administrator')){
                $cashiers = Cashier::where('company_id', $company->id)->paginate(20);
            }
        }
        return view('pages.cashier.index', [
            'cashiers' => $cashiers,
        ]);
    }

    public function create()
    {
        $company = Company::where('user_id', auth()->user()->id)->first();
        if (auth()->user()->hasRole('Super Admin')){
            $branches = Branch::latest()->paginate(20);
        }elseif (auth()->user()->hasRole('Administrator')){
            $branches = Branch::where('company_id', $company->id)->paginate(20);
        }
        return view('pages.cashier.add', [
            'branches' => $branches
        ]);
    }

    public function store(Request $request)
    {
        $v = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'branch_id' => 'required',
            'password' => 'required|min:4|confirmed',

        ]);

        if ($v->failed()) {
            error_message($v->errors()->first());
            return redirect()->back();
        }
        Cashier::create([
            'name' => $request->name,
            'email' => $request->email,
            'branch_id' => $request->branch_id,
            'password' => Hash::make($request->password),
            'company_id' => self::company_id($request->branch_id),

        ]);
        success_message('Cashier Created success!!!');
        return redirect()->route('cashierIndex');
    }

    public function edit($id)
    {
        $branches = Branch::all();
        $cashier = Cashier::find($id);

        return view('pages.cashier.edit', compact('cashier', 'branches'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:cashiers,email,' . $id],
            'password' => ['nullable', 'string', 'min:4', 'confirmed'],
        ]);

        $cashier = Cashier::find($id);
        $cashier->name = $request->name;
        $cashier->email = $request->email;
        $cashier->branch_id = $request->branch_id;
        $cashier->company_id = self::company_id($request->branch_id);
        $cashier->update();
        if ($request->has('password')){
            $cashier->password = Hash::make($request->password);
            $cashier->update();
        }
        success_message('Maneger success updated!!!');
        return redirect()->route('cashierIndex');
    }

    public function destroy($id)
    {
        $cashier = Cashier::where('id', $id)->first();
        $cashier->delete();
        success_message('deleted success');
        return back();
    }

//    STATIC FUNCTIONS ==================================================
    public static function manager_id()
    {
        $menegers = auth()->user()->menegers;
        foreach ($menegers as $meneger) {
            $meneger_id = $meneger['id'];
            return $meneger_id;
        }
    }

    public static function company_id($id)
    {
        $branch = Branch::find($id);
            return $branch->company_id;
    }
}
