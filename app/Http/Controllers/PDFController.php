<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade as PDF;


use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function generatePDF($data, $total)
    {



        $customPaper = array(0,0,567.00,150.80);
        $pdf = PDF::loadView('webPDF', compact('data', 'total'))->setPaper($customPaper, 'landscape')->stream('mobile.pdf');

        return $pdf;
        //return $pdf->setPaper('a4', 'landscape')->setWarnings(false)->stream('mobile.pdf');
    }
}
