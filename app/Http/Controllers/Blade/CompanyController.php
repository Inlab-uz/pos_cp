<?php

namespace App\Http\Controllers\Blade;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CompanyController extends Controller
{
    public function index(){
        $has = false;
        $id = auth()->user()->id;
        $count = 0;
        if (auth()->user()->hasRole('Super Admin')){
            $companies = Company::latest()->paginate(20);
        }elseif (auth()->user()->hasRole('Administrator')){
            $companies = Company::where('user_id', $id)->paginate(5);
            $has = true;
            $count = count($companies);

        }
        return view('pages.company.index', compact('companies', 'has', 'count'));
    }

    public function create(){
        return view('pages.company.add');
    }

    public function store(Request $request){
        $v = Validator::make($request->all(), [
            'Company' => 'required|array',
            'Company.name' => 'required',
            'Company.logo' => 'file',
        ]);
        if($v->failed()){
            error_message($v->errors()->first());
            return redirect()->back();
        }else{
            $name = Str::random(40);
            $file_name = "/" . $name . "." . $request->file('Company.logo')->extension();
            $request->file('Company.logo')->move(storage_path('company') , $file_name);
        }
        Company::create([
            'name' => $request->Company['name'],
            'logo' => "/company/".$file_name,
            'description' => $request->Company['description'],
            'user_id' => auth()->id(),
        ]);
        return redirect()->route('companyIndex')->with("success","Saved!");
    }

    public function img($resource){
        dd('1234');
        $com = Company::where('id', $resource)->first();
        return response()->download(storage_path().($com->logo ?? "/category/not-found.png"));
    }

    public function view($id){
        $company = Company::where('id', $id)->firstOrFail();
        return view('pages.company.view', [
            'company'=>$company,
        ]);
    }

    public function edit($id){
        $company = Company::where('id', $id)->firstOrFail();
        return view('pages.company.edit', [
            'company'=>$company,
        ]);
    }

    public function update(Request $request,$id){
        $v = Validator::make($request->all(), [
            'Company' => 'required|array',
            'Company.name' => 'required',
        ]);
        if($v->failed()){
            error_message($v->errors()->first());
            return redirect()->back();
        }
        $file_name = null;
        if($request->file('Category.logo')){
            $name = Str::random(40);

            $file_name = "/" . $name . "." . $request->file('Category.logo')->extension();
            $request->file('Category.logo')->move(storage_path('category') , $file_name);
        }


        Company::where('id', $id)->update(
            [
                'name' => $request->Company['name'],
                'description' => $request->Company['description'],
            ]
            +
            ($file_name ? ['logo' => "/company/" . $file_name] : [])
        );
        return redirect()->route('companyIndex')->with("success","Update!");
    }
}
