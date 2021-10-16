<?php

namespace App\Http\Controllers\Blade;


use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(Request $request){

        $categories = Category::paginate(20);

        return view('pages.category.index', compact(
            'categories'
        ));
    }

    public function add(Request $request){
        $categories = Category::all();
        return view('pages.category.add', compact(
            'categories'
        ));
    }

    public function store(Request $request){
        dd($request->file('Category.logo')->extension());
        dump($request->all());
        $name = Str::random(40);
        $request->file('Category.logo')->move(storage_path('category') . "/" . $name . "." . $request->file('Category.logo')->extension());
        return redirect('/category/index');
    }
}
