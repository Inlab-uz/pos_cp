<?php

namespace App\Http\Controllers\Blade;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class BranchController extends Controller
{
    public function index(){
        $branches = Branch::latest()->paginate(20);
        return view('pages.branch.index',[
            'branches'=>$branches,
        ]);
    }

    public function create(){
        $companies = Company::all();
        return view('pages.branch.add',[
            'companies'=>$companies
        ]);
    }

    public function store(Request $request){
        $v = Validator::make($request->all(), [
            'Branch' => 'required|array',
            'Branch.name' => 'required',
            'Branch.company_id' => 'required',
            //'Branch.address' => 'required',
            //'Branch.phone' => 'required',
        ]);
        if($v->failed()){
            error_message($v->errors()->first());
            return redirect()->back();
        }

        Branch::create([
            'company_id'=>$request->Branch['company_id'],
            'name'=>$request->Branch['name'],
            'address'=>$request->Branch['address'],
            'phone'=>$request->Branch['phone'],
        ]);
        return redirect()->route('branchIndex')->with("success","Saved!");
    }

    public function view($id){
        $branch = Branch::where('id', $id)->firstOrFail();
        return view('pages.branch.view', [
            'branch'=>$branch,
        ]);
    }

    public function edit($id){
        $branch = Branch::where('id', $id)->firstOrFail();
        $companies = Company::all();
        return view('pages.branch.edit', [
            'branch'=>$branch,
            'companies'=>$companies,
        ]);
    }

    public function update(Request $request,$id){
        $v = Validator::make($request->all(), [
            'Branch' => 'required|array',
            'Branch.name' => 'required',
            'Branch.company_id' => 'required',
            //'Branch.address' => 'required',
            //'Branch.phone' => 'required',
        ]);
        if($v->failed()){
            error_message($v->errors()->first());
            return redirect()->back();
        }
        Branch::where('id', $id)->update(
            [
                'company_id'=>$request->Branch['company_id'],
                'name'=>$request->Branch['name'],
                'address'=>$request->Branch['address'],
                'phone'=>$request->Branch['phone'],
            ]
        );
        return redirect()->route('branchIndex')->with("success","Update!");
    }
}
