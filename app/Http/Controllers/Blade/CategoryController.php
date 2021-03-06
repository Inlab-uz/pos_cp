<?php

namespace App\Http\Controllers\Blade;


use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Category;
use App\Models\Company;
use App\Models\Meneger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $company = Company::where('user_id', auth()->user()->id)->first();
        if (auth()->user()->hasRole('Super Admin')) {
            $categories = Category::latest()->paginate(20);
        } elseif (auth()->user()->hasRole('Administrator')) {
            $categories = Category::where('company_id', $company->id)->paginate(20);
        }


        return view('pages.category.index', compact(
            'categories'
        ));
    }

    public function add(Request $request)
    {

        $company = auth()->user()->companies->first();
        if ($company == null) {
            $categories = [];
            $branches = [];
            return view('pages.category.add', compact('categories', 'branches'))
                ->with('error', 'Company not created');
        }

        $branches = Branch::where('company_id', $company->id)->get();
        $categories = Category::where('company_id', $company->id)->get();

        return view('pages.category.add', compact('categories', 'branches'));
    }

    public function store(Request $request)
    {

        $v = Validator::make($request->all(), [
            'Category' => 'required|array',
            'Category.name' => 'required',
            'Category.parent_id' => 'numeric|nullable',
            'Category.branch_id' => 'numeric|nullable',
            'Category.logo' => 'file',
        ]);

        if ($v->failed()) {
            error_message($v->errors()->first());
            return redirect()->back();
        } else {
            if ($request->file('Company.logo') != null) {
                $name = Str::random(40);
                $file_name = "" . $name . "." . $request->file('Category.logo')->extension();
                $request->file('Category.logo')->move(storage_path('category'), $file_name);
            } else
                $file_name = null;
        }

        $company = auth()->user()->companies->first();
        $manager = Meneger::where("branch_id", $request->Category['branch_id'])->first();

        $manager_id = $manager->id ?? auth()->user()->id;


        Category::create([
            'name' => $request->Category['name'],
            'parent_id' => $request->Category['parent_id'] ?? 0,
            'logo' => "/category/" . $file_name,
            'company_id' => $company->id,
            'manager_id' => $manager_id,
            'branch_id' => $request->Category['branch_id'],
        ]);

        return redirect('/category');
    }

    public function img($resource)
    {
        $cat = Category::where('id', $resource)->first();
        return response()->download(storage_path() . ($cat->logo ?? "/category/not-found.png"));
    }

    public function edit(Request $request, $id)
    {
        $categories = Category::all();
        $cat = Category::where('id', $id)->firstOrFail();
        return view('pages.category.edit', compact(
            'categories',
            'cat'
        ));
    }

    public function update(Request $request, $id)
    {

        $v = Validator::make($request->all(), [
            'Category' => 'required|array',
            'Category.name' => 'required',
            'Category.parent_id' => 'numeric|nullable',
            'Category.logo' => 'file|nullable',
        ]);

        if ($v->failed()) {
            error_message($v->errors()->first());
            return redirect()->back();
        }

        $file_name = null;

        if ($request->file('Category.logo')) {
            $name = Str::random(40);

            $file_name = "" . $name . "." . $request->file('Category.logo')->extension();
            $request->file('Category.logo')->move(storage_path('category'), $file_name);
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

    public function view(Request $request, $id)
    {
        $cat = Category::where('id', $id)->firstOrFail();
        return view('pages.category.view', compact(
            'cat'
        ));
    }

}
