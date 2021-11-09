{{--<!DOCTYPE html>--}}
{{--<html lang="en">--}}
{{--<head>--}}
{{--    <meta charset="UTF-8">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1.0">--}}
{{--    <title>INLAB POS System</title>--}}
{{--    <link rel="stylesheet" href="style.css">--}}
{{--</head>--}}
{{--<style>--}}
{{--    * {--}}
{{--        margin: 0;--}}
{{--        padding: 0;--}}
{{--    }--}}

{{--    body {--}}
{{--    }--}}

{{--    .havas {--}}
{{--        margin: 0 auto;--}}
{{--        width: 60%;--}}
{{--        padding: 2px;--}}

{{--    }--}}

{{--    .name-food {--}}
{{--    }--}}

{{--    .name-food hr {--}}
{{--        width: 90%;--}}
{{--        border-top: 1px dashed black;--}}
{{--        margin-left: 2px;--}}
{{--        padding: 0 2px;--}}
{{--    }--}}

{{--    .location {--}}
{{--        padding: 10px;--}}
{{--    }--}}

{{--    .name-food_name {--}}
{{--        text-align: left;--}}
{{--        padding-left: 100px;--}}
{{--    }--}}

{{--    .anons {--}}
{{--        display: flex;--}}
{{--        padding-top: 10px;--}}
{{--        padding-left: 5px;--}}
{{--    }--}}

{{--    .raqam {--}}
{{--        padding: 0 85px 20px 10px;--}}
{{--    }--}}

{{--    .raqam p {--}}
{{--        padding: 5px 0;--}}

{{--    }--}}

{{--    .chek {--}}
{{--        float: right;--}}
{{--    }--}}

{{--    .chek p {--}}
{{--        padding: 5px;--}}
{{--    }--}}

{{--    .anons-hr {--}}
{{--        width: 95%;--}}
{{--        border-top: 1px dashed black;--}}
{{--        margin-left: 10px--}}
{{--    }--}}

{{--    .maxsulot {--}}
{{--        padding-left: 10px;--}}
{{--        padding-top: 10px;--}}
{{--        padding-bottom: 20px;--}}

{{--    }--}}

{{--    .maxsulot p {--}}

{{--    }--}}

{{--    .maxsulot_narxi {--}}
{{--        float: right;--}}
{{--    }--}}

{{--    .maxsulot_nomi {--}}
{{--        padding: 0 10px;--}}
{{--    }--}}

{{--    .maxsulot_narxi {--}}
{{--        padding: 0 10px;--}}
{{--    }--}}

{{--    .maxsulot-hr {--}}
{{--        width: 95%;--}}
{{--        border-top: 1px dashed black;--}}
{{--        margin-left: 10px--}}

{{--    }--}}

{{--    .jami {--}}
{{--        display: flex;--}}
{{--        padding-top: 10px;--}}

{{--    }--}}

{{--    .jami p {--}}
{{--        padding: 4px 0;--}}
{{--    }--}}

{{--    .jami-nom {--}}
{{--        padding: 0 10px;--}}
{{--    }--}}

{{--    .jami-narx {--}}
{{--        float: right;--}}
{{--    }--}}

{{--    .jami-narx {--}}
{{--        padding: 0 10px;--}}
{{--    }--}}

{{--</style>--}}
{{--<body>--}}

{{--<div class="havas">--}}

{{--    <div class="name-food">--}}
{{--        <div class="anons">--}}
{{--            <div class="raqam">--}}
{{--                <p>{{ $data[0]['company_name'] }}</p>--}}
{{--            </div>--}}
{{--            <div class="chek">--}}
{{--                <p>{{ $data[0]['branch_name'] }}</p>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <hr class="anons-hr">--}}
{{--    </div>--}}

{{--    <div class="anons">--}}
{{--        <div class="raqam">--}}
{{--            <p>Smena raqami : 271</p>--}}
{{--            <p>Kassir : {{ $data[0]['cashier_name'] }}</p>--}}
{{--            <p>Savdo Cheki : 18</p>--}}
{{--        </div>--}}
{{--        <div class="chek">--}}
{{--            <p>Kassa raqami : 2</p>--}}
{{--            <p>STIR : 305645847</p>--}}
{{--            <p>{{ $data[0]['date'] }}</p>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <hr class="anons-hr">--}}
{{--    <div style="" class="maxsulot">--}}
{{--        @foreach($data as $key => $value)--}}

{{--            <div class="anons">--}}
{{--                <div class="raqam">--}}
{{--                    <p>{{$key+1}}.{{ $value['title'] }}</p>--}}
{{--                </div>--}}
{{--                <div class="chek">--}}
{{--                    <p>{{ $value['price']}}{{ "*".$value['count']}} = {{ $value['total_price'] }} so'm</p>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        @endforeach--}}
{{--            <hr class="anons-hr">--}}
{{--            <div class="anons">--}}
{{--                <div class="raqam">--}}
{{--                    <p>JAMI</p>--}}
{{--                </div>--}}
{{--                <div class="chek">--}}
{{--                    <p>{{ $total }} so'm</p>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--    </div>--}}
{{--</div>--}}


{{--</body>--}}
{{--</html>--}}


        <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>INLAB POS</title>

    <style>
        * {
            box-sizing: border-box;
            margin-left: 0px;
            padding-left: 0px;
            margin-top: 0;
            padding-top: 0;
            font-family:  sans-serif;

        }


        .box {
            text-align: center;
        }

        h3 {
            margin-bottom: 2rem;
        }

        table {
            width: 100%;
        }

        table td {
            font-size: 9px;
            border-bottom: 1px dashed;
            padding: 1px 0;
        }

        td:first-child {
            text-align: left;
        }

        td:last-child {
            word-break: break-word;
            font-weight: bold;
            text-align: right;
        }

    </style>

</head>
<body>


<div class="box">
    <table>
            <tr>
                <td>Savdo nuqta:</td>
                <td> {{ $data[0]['branch_name'] }}</td>
            </tr>
            <tr>
                <td>Kassir:</td>
                <td> {{ $data[0]['cashier_name'] }}</td>
            </tr>
            @foreach($data as $key => $value)

                <tr>
                    <td>{{$key+1}}.{{ $value['title'] }}</td>
                    <td>{{ $value['price']}}{{ "*".$value['count']}} = {{ $value['total_price'] }} so'm</td>

                </tr>
            @endforeach
            <tr>
                <td>Jami:</td>
                <td> {{ $total }} so'm</td>
            </tr>


            <tr>
                <td>Sana:</td>
                <td> {{ $data[0]['date'] }}</td>
            </tr>
        </table>

</div>


</body>
</html>
