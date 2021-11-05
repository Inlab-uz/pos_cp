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
        <div class="anons">
            <div class="raqam">
                <h4>{{ $data[0]['company_name'] }}</h4>
            </div>
            <div class="chek">
                <h4>{{ $data[0]['branch_name'] }}</h4>
            </div>
        </div>
        <hr class="anons-hr">
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

            <div class="anons">
                <div class="raqam">
                    <h4>{{$key+1}}.{{ $value['title'] }}</h4>
                </div>
                <div class="chek">
                    <h4>{{ $value['price']}}{{ "*".$value['count']}} = {{ $value['total_price'] }} so'm</h4>
                </div>
            </div>
        @endforeach
            <hr class="anons-hr">
            <div class="anons">
                <div class="raqam">
                    <h4>JAMI</h4>
                </div>
                <div class="chek">
                    <h4>{{ $total }} so'm</h4>
                </div>
            </div>
    </div>
</div>


</body>
</html>
