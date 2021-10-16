<?php
/*
 * InLab Group Copyright (c)  2021.
 *
 * Created by Fatulloyev Shukrullo
 * Please contact before making any changes
 *
 * Tashkent, Uzbekistan
 */

namespace App\Http\Controllers;

use App\Models\Import;
use Illuminate\Http\Request;

class ImportController extends Controller
{
    public function index(){
        $imports = Import::latest()->paginate(40);
        return view('pages.import.index',[
            'imports'=>$imports,
        ]);
    }

    public function create(){
        return view('pages.import.create');
    }

    public function store(Request $request){
        dd($request);
    }
}
