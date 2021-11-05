<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>lazzat taomlari</title>
    <link rel="stylesheet" href="style.css">
</head>
<style>
    * {
        margin: 0;
        padding: 0;
    }

    body {
    }

    .havas {
        margin: 0 auto;
        width: 60%;
        padding: 10px;

    }

    .name-food {
    }

    .name-food hr {
        width: 90%;
        border-top: 1px dashed black;
        margin-left: 10px;
        padding: 0 2px;
    }

    .location {
        padding: 10px;
    }

    .name-food_name {
        text-align: left;
        padding-left: 100px;
    }

    .anons {
        display: flex;
        padding-top: 10px;
        padding-left: 5px;
    }

    .raqam {
        padding: 0 85px 20px 10px;
    }

    .raqam h4 {
        padding: 5px 0;

    }

    .chek {
        float: right;
    }

    .chek h4 {
        padding: 5px;
    }

    .anons-hr {
        width: 95%;
        border-top: 1px dashed black;
        margin-left: 10px
    }

    .maxsulot {
        padding-left: 10px;
        padding-top: 10px;
        padding-bottom: 20px;

    }

    .maxsulot h4 {

    }

    .maxsulot_narxi {
        float: right;
    }

    .maxsulot_nomi {
        padding: 0 10px;
    }

    .maxsulot_narxi {
        padding: 0 10px;
    }

    .maxsulot-hr {
        width: 95%;
        border-top: 1px dashed black;
        margin-left: 10px

    }

    .jami {
        display: flex;
        padding-top: 10px;

    }

    .jami h4 {
        padding: 4px 0;
    }

    .jami-nom {
        padding: 0 10px;
    }

    .jami-narx {
        float: right;
    }

    .jami-narx {
        padding: 0 10px;
    }

</style>
<body>

<div class="havas">

    <div class="name-food">
        <h4 style="margin-left: 65px;" class="name-food_name"><span>000</span> {{ $data[0]['company_name'] }}</h4>
        <h4 style="text-align: center" class="location">{{ $data[0]['branch_name'] }}</h4>
        <hr>
    </div>

    <div class="anons">
        <div class="raqam">
            <h4>Smena raqami : 271</h4>
            <h4>Kassir : {{ $data[0]['cashier_name'] }}</h4>
            <h4>Savdo Cheki : 18</h4>
        </div>
        <div class="chek">
            <h4>Kassa raqami : 2</h4>
            <h4>STIR : 305645847</h4>
            <h4>{{ $data[0]['date'] }}</h4>
        </div>

    </div>
    <hr class="anons-hr">

    <div style="" class="maxsulot">
        @foreach($data as $key => $value)

            <h4 style="text-transform: uppercase; margin-bottom: 10px"><b>{{$key+1}}
                    .</b> {{ $value['title'] }}   {{ $value['price']}}              {{ "*".$value['count']}}
                = {{ $value['total_price'] }}</h4>
            <h4 style="margin-bottom: 20px">Barcode: {{ $value['barcode_number'] }}</h4>
            <h4 style="margin-bottom: 20px">JAMI        {{ $value['total_price'] }}</h4>
            @dd($data)
        @endforeach
        {{--        <div class="maxsulot_nomi">--}}
        {{--            @foreach($data as $key => $value)--}}
        {{--                <p  style="text-transform: uppercase;"><b>{{$key+1}}.</b> {{ $value['title'] }}   {{ $value['price']}}              {{ "*".$value['count']}} = {{ $value['total_price'] }}</p>--}}
        {{--                <p>Barcode: {{ $value['barcode_number'] }}</p>--}}
        {{--            @endforeach--}}
        {{--        </div>--}}
        {{--        <div class="maxsulot_narxi">--}}
        {{--            <h4>*1&emsp;=3600.00 so'm</h4>--}}
        {{--            <h4>15%&ensp;=469.57</h4>--}}
        {{--            <h4>*2&emsp;=2000.00 so'm</h4>--}}
        {{--            <h4>15%&ensp;=260.87</h4>--}}
        {{--            <h4>*3&emsp;=3000.00 so'm</h4>--}}
        {{--            <h4>15%&ensp;=391.30</h4>--}}
        {{--        </div>--}}
        <hr class="anons-hr">
    </div>
    <div class="anons">
        <div class="raqam">
            <h4>Jami:</h4>
            <h4>Chegirma</h4>
            <h4>Qaytim</h4>
            <h4>QQS Jami</h4>
        </div>
        <div class="chek">
            <h4>Kassa raqami : 2</h4>
            <h4>STIR : 305645847</h4>
            <h4>{{ $data[0]['date'] }}</h4>
            <h4>{{ $data[0]['date'] }}</h4>
        </div>

    </div>
    {{--    <hr class="maxsulot-hr">--}}

    {{--    <div class="jami">--}}
    {{--        <div class="jami-nom">--}}
    {{--            <h4>JAMI</h4>--}}
    {{--            <h4>CHEGIRMA</h4>--}}
    {{--            <h4>NAQD</h4>--}}
    {{--            <h4>QAYTIM</h4>--}}
    {{--            <h4>QQS JAMI 15%</h4>--}}
    {{--        </div>--}}
    {{--        <div class="jami-narx">--}}
    {{--            <h4>=8600 .00</h4>--}}
    {{--            <h4>=0 .00</h4>--}}
    {{--            <h4>=50600 .00</h4>--}}
    {{--            <h4>=42000. 00</h4>--}}
    {{--            <h4>=1121. 74</h4>--}}

    {{--        </div>--}}
    {{--    </div>--}}


</div>


</body>
</html>


{{--<!doctype html>--}}
{{--<html lang="en">--}}
{{--<head>--}}
{{--    <meta charset="UTF-8">--}}
{{--    <meta name="viewport"--}}
{{--          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">--}}
{{--    <meta http-equiv="X-UA-Compatible" content="ie=edge">--}}
{{--    <title>pdf</title>--}}
{{--    <style>--}}
{{--        .col-3{--}}
{{--            width: 20px;--}}
{{--            background-color: red;--}}
{{--        }--}}
{{--    </style>--}}
{{--</head>--}}
{{--<body class="">--}}
{{--    @dd($data['title'])--}}

{{--<div class="col-3">--}}
{{--    Lorem ipsum dolor sit amet, consectetur adipisicing elit. At nihil placeat quo. A aspernatur consequatur cum, debitis dignissimos est eveniet facere impedit molestiae nulla, numquam officiis quaerat saepe, tempore ullam!--}}
{{--</div>--}}
{{--<h3 style="text-align: center">{{ $data[0]['company_name'] }}</h3>--}}
{{--<h4 style="font-size: 18px; margin-bottom: 0">{{ $data[0]['branch_name'] }}</h4>--}}
{{--<p>---------------------------------------------------------------------------------------------------------------------------------------</p>--}}
{{--<div style="display: flex">--}}
{{--    <p style="margin: 0">Smena raqami: 271</p>--}}
{{--    <p style="float: right">Kassa raqami: 2</p>--}}
{{--</div>--}}
{{--<div style="display: flex">--}}
{{--    <p style="margin: 0;">{{ $data[0]['cashier_name'] }}</p>--}}
{{--    <p style="float: right">STIR: 35151212</p>--}}
{{--</div>--}}
{{--<div style="display: flex">--}}
{{--    <p style="margin: 0">Savdo Cheki: 18</p>--}}
{{--    <p  style="float: right; margin: 0">{{ $data[0]['date'] }}</p>--}}
{{--</div>--}}
{{--<p>---------------------------------------------------------------------------------------------------------------------------------------</p>--}}
{{--    @foreach($data as $key => $value)--}}
{{--        <p  style="text-transform: uppercase;"><b>{{$key+1}}.</b> {{ $value['title'] }}   {{ $value['price']}}              {{ "*".$value['count']}} = {{ $value['total_price'] }}</p>--}}
{{--        <p>Barcode: {{ $value['barcode_number'] }}</p>--}}
{{--    @endforeach--}}
{{--<p>---------------------------------------------------------------------------------------------------------------------------------------</p>--}}
{{--</body>--}}
{{--</html>--}}
