<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\ExportProducts;
use App\Imports\ImportProducts;
use Maatwebsite\Excel\Facades\Excel;

class Import_Export_Controller extends Controller
{
    public function importExport()
    {
        return view('import');
    }

    public function export()
    {
        return Excel::download(new ExportProducts(), 'products.xlsx');
    }

    public function import()
    {
        Excel::import(new ImportProducts, request()->file('file'));

        return back();
    }
}
