<?php

namespace App\Http\Controllers\Blade;


use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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

        $v = Validator::make($request->all(), [
            'Category' => 'required|array',
            'Category.name' => 'required',
            'Category.parent_id' => 'numeric|nullable',
            'Category.logo' => 'file',
        ]);

        if($v->failed()){
            error_message($v->errors()->first());
            return redirect()->back();
        }else{
            $name = Str::random(40);

            $file_name = "/" . $name . "." . $request->file('Category.logo')->extension();
            $request->file('Category.logo')->move(storage_path('category') , $file_name);
        }


        Category::create([
            'name' => $request->Category['name'],
            'parent_id' => $request->Category['parent_id'],
            'logo' => "/category/" . $file_name,
            'company_id' => 1,
            'branch_id' => 1,
            'user_id' => auth()->id(),
        ]);

        return redirect('/category');
    }

    public function img($resource){
        $cat = Category::where('id', $resource)->first();
        return response()->download(storage_path().($cat->logo ?? "/category/not-found.png"));
    }

    public function edit(Request $request, $id){
        $categories = Category::all();
        $cat = Category::where('id', $id)->firstOrFail();
        return view('pages.category.edit', compact(
            'categories',
            'cat'
        ));
    }

    public function update(Request $request, $id){

        $v = Validator::make($request->all(), [
            'Category' => 'required|array',
            'Category.name' => 'required',
            'Category.parent_id' => 'numeric|nullable',
            'Category.logo' => 'file|nullable',
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


        Category::where('id', $id)->update(
            [
                'name' => $request->Category['name'],
                'parent_id' => $request->Category['parent_id'],
                'company_id' => 1,
                'branch_id' => 1,
                'user_id' => auth()->id(),
            ]
            +
            ($file_name ? ['logo' => "/category/" . $file_name] : [])
        );

        return redirect('/category');
    }

    public function view(Request $request, $id){
        $cat = Category::where('id', $id)->firstOrFail();
        return view('pages.category.view', compact(
            'cat'
        ));
    }

}
