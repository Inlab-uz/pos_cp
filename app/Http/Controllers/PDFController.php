<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade as PDF;


use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function generatePDF($data, $total)
    {

        $pdf = PDF::loadView('webPDF', compact('data', 'total'));

        return $pdf->download('mobile.pdf');
    }
}
