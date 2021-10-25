<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade as PDF;


use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function generatePDF()
    {
        $data = [
            'title' => 'Welcome to ItSolutionStuff.com',
            'date' => date('m/d/Y')
        ];

        $pdf = PDF::loadView('myPDF', $data);

        return $pdf->download('mobile.pdf');
    }
}
