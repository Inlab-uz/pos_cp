<?php

namespace App\Http\Controllers\Blade;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CompanyController extends Controller
{
    public function index(){
        $companies = Company::latest()->paginate(20);
        return view('pages.company.index',[
            'companies'=>$companies,
        ]);
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



}
