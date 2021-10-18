<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laravel Generate Barcode Examples</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
</head>

<body>

<div class="container mt-4">
{{--    <div class="mb-3">{!! DNS2D::getBarcodeHTML('4445645656', 'QRCODE') !!}</div>--}}

{{--            <div class="mb-3">{!! DNS1D::getBarcodeHTML('4445645656', 'UPCA'); !!}</div>--}}


{{--    <div class="mb-3">{!! DNS1D::getBarcodeHTML('4445645656', 'PHARMA2T') !!}</div>--}}

{{--    <div class="mb-3">{!! DNS1D::getBarcodeHTML('4445645656', 'CODABAR') !!}</div>--}}

{{--    <div class="mb-3">{!! DNS1D::getBarcodeHTML('4445645656', 'KIX') !!}</div>--}}

{{--    <div class="mb-3">{!! DNS1D::getBarcodeHTML('4445645656', 'RMS4CC') !!}</div>--}}

{{--    <div class="mb-3">{!! DNS1D::getBarcodeHTML('4445645656', 'UPCA',3,33,'black', true) !!}</div>--}}

    <img src="data:image/png;base64,{{DNS1D::getBarcodePNG('44422456569', 'UPCA')}}" alt="barcode" height="20px" width="90px"/>
     <br/>



</div>
</body>
</html>
