<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade as PDF;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

class PDFController extends Controller
{
    public function generatePDF($data, $total, $cheque)
    {


        $customPaper = array(0, 0, 567.00, 150.80);
        $pdf = PDF::loadView('webPDF', compact('data', 'total'))->setPaper($customPaper, 'landscape');

        Storage::put("public/pdf/$cheque.pdf", $pdf->output());
        // List all printers
        return redirect()->back()->with('has_cheque', $cheque . ".pdf");
    }

    public function printCheque(
//        $data, $company, $format = 'a4', $date = null
    )
    {
        $date = null;

        if ($date == null) {
            $date = date('Y-m-d H:i:s', time());
        }

        $company = (object)[
            "name" => "INLAB"
        ];
        $data = (object)[
            (object)["name" => "Product 1",
                "count" => 1,
                "product_total" => 1000,],
        ];

        $company_name = $company->name;
        $html = "<h1>$company_name</h1></br>";
        $html = $html . "<p>Sanasi: $date</p></br>";
        $total = 0;

        foreach ($data as $datum) {
            $html = $html . "<p>$datum->name: $datum->count : $datum->product_total</p></br>";
            $total += $datum->product_total;
        }
        $html = $html . "</br><p>Total: $total</p>";


        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($html);
        return $pdf->stream();

    }
}
