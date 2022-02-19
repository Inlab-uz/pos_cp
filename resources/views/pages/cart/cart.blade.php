@extends('layouts.applite')

@section('title', 'Open POS')
@section('content-header', 'Open POS')

@section('content')


    <div class="container-fluid pt-3 ">

        @php
            $cheque = time();

        @endphp

        <div class="row ">
            <div class="col-md-6 col-lg-5">
                <form id="form_cart" onkeydown="return event.key !== 'Enter';" action="{{route("order.create")}}"
                      method="POST">
                    @csrf
                    <div class="row mb-2">
                        <div class="col">
                            <input type="text" class="form-control" autoFocus onkeyup="setTimeout(scanBarcode(this), 30000);" id="barcode"
                                   placeholder="@lang('cruds.pos.fields.barcode')..."/>

                        </div>
                        <div class="col">
                            <select class="form-control" name="pay_type">
                                <option value="1">@lang('cruds.pos.fields.cash')</option>
                                <option value="2">@lang('cruds.pos.fields.credit')</option>
                                <option disabled value="3">@lang('cruds.pos.fields.loan')</option>
                                <option disabled value="4">@lang('cruds.pos.fields.installment')</option>
                                </option>
                            </select>
                        </div>
                    </div>

                    <input hidden name="cheque" value="{{$cheque}}">

                    <div class="user-cart">
                        <div class="card">

                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>@lang('cruds.pos.fields.product_name')</th>
                                    <th>@lang('cruds.pos.fields.product_quantity')</th>
                                    <th class="text-right">@lang('cruds.pos.fields.product_cost')</th>
                                </tr>
                                </thead>
                                <tbody id="cart_items">
                                </tbody>
                            </table>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col">@lang('cruds.pos.fields.cart_total'):</div>
                        <div class="col total">

                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button
                                    type="button"
                                    class="btn btn-danger btn-block">
                                @lang('cruds.pos.fields.cancel')
                            </button>
                        </div>
                        <div class="col">
                            <button id="btn_submit"
                                    {{--                            <button id="btn_submit" onclick="printJS('{{ Storage::url("public/pdf/$cheque.pdf") }}')"--}}
                                    type="submit"
                                    class="btn btn-primary btn-block">
                                @lang('cruds.pos.fields.confirm')
                            </button>
                        </div>


                    </div>
                </form>
            </div>
            <div class="col-md-6 col-lg-7">
                <div class="mb-2">
                    <input
                            type="text"
                            id="searchKey" class="form-control"
                            placeholder=" @lang('cruds.pos.fields.product_search')..."
                    />
                </div>
                <div class="order-product">
                    <div class="row" id="myProducts">

                        @foreach($products as $product)


                            <div class="col-md-4"
                                 title="Kelgan narxi: {{number_format($product['import']['price'],2)}}">
                                <div class="card" id="{{$product['barcode_number']}}"
                                        {{--                                     onclick="productClickAdd( {{$product['barcode_number']}})"--}}
                                >
                                    <div class="card-header">


                                        <h3 class="card-title" id="{{$product['title']}}">{{$product['title']}}</h3>
                                        <div class="card-tools">
                                            <!-- Buttons, labels, and many other things can be placed here! -->
                                            <!-- Here is a label for exa    mple -->
                                            <span
                                                    class="badge badge-primary">{{($product['status']==1)?"Bor":"Yo'q"}}</span>
                                        </div>
                                        <!-- /.card-tools -->
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <img src="{{$product["images"]}}">
                                    </div>

                                    <div class="card-body">
                                        <h7 class="invisible"
                                            id="price">{{($product['import']['sale_price']==0)?$product['import']['price']:$product['import']['sale_price']}}</h7>
                                        <h6 id="price_formated">{{number_format($product['import']['sale_price'],2)}}
                                            so'm</h6>
                                    </div>


                                    <!-- /.card-body -->
                                    <div class="card-footer">
                                        <i class="fas  fa-barcode"></i> {{$product["barcode_number"]}} <br> <i
                                                class="fas  fa-box"></i> {{(int)$product['import']['part']}}
                                    </div>
                                    <!-- /.card-footer -->
                                </div>
                            </div>


                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


<!-- ./wrapper -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>


<script>
    $(document).ready(function () {





        window.scanBarcode = (barcode) => {

            console.log("Barcode entered: "+barcode.value)
            var barcode = barcode.value;

            $.ajax({
                url: "/api/web/get-product/by-barcode/{{$company->id}}/"+barcode,
                type:"POST",
                success:function(response){

                    if(response) {
                        if (response.status){
                            console.log(response)
                            var  price = response.product.imports.sale_price
                            var  title = response.product.title
                            console.log("Barcode: "+barcode+ " Title: "+response.product.title+" Price:"+ price);


                            let product = document.getElementById('i' + barcode)

                            if (product) {
                                product.querySelector('.qty').value = +product.querySelector('.qty').value + 1;
                                $('#cart_price').html(Number($('#cart_price').html()) + price)
                            } else {
                                $('#cart_items').append(
                                    `<tr id="i${barcode}">
                                <td>
                                    <input type="hidden" name="barcode[]" value="${barcode}">
                                    ${title}
                                </td>
                                <td class="d-flex align-items-center">
                                    <input type="number" name='count[]' class="form-control-sm qty w-25 changable" value="1" onchange="update('${barcode}')" onkeyup="update('${barcode}')"/>
                                    <button onclick="remove('${barcode}')" type="button" class="btn btn-sm btn-danger ml-2"><i class="fas fa-trash"></i></button>
                                </td>
                                <td id="cart_price"> ${price} </td>
                        </tr>`)

                            }
                            calculateTotal()

                        }else{
                            console.log(response.message)

                        }
                       // $('.success').text(response.success);
                       // $("#ajaxform")[0].reset();
                    }
                },
                error: function(error) {
                    console.log(error);
                }

            });

            return true;
        }

        function calculateTotal() {
            let cart_items = $('#cart_items tr');
            let total = 0;

            cart_items.each(function () {
                total = total + Number($(this).find('#cart_price').text())
            })
            $('.total').html(total);

            $('#barcode').val("");
        }

        window.remove = (barcode) => {
            let item = document.getElementById('i' + barcode);
            item.remove();
            calculateTotal();
        }


        window.update = (barcode) => {

            // let card = $('#' + barcode);
            // let product = $('#i' + barcode);
            // let quantity = product.find('.changable').val();
            // let price = product.find('#cart_price');
            // $(price).html(quantity * Number(card.find('#price').text()))
            // console.log(quantity);
            calculateTotal()
        }



        //setup before functions
        var typingTimer;                //timer identifier
        var doneTypingInterval = 3000;  //time in ms, 5 seconds for example
        var $input = $('#searchKey');

//on keyup, start the countdown
        $input.on('keyup', function () {
            clearTimeout(typingTimer);
            typingTimer = setTimeout(doneTyping, doneTypingInterval);
        });

//on keydown, clear the countdown
        $input.on('keydown', function () {
            clearTimeout(typingTimer);
        });

//user is "finished typing," do something
        function doneTyping () {
            let key = document.getElementById('searchKey').value
            console.log(key)
            $.ajax({
                url: "/api/web/get-product/by-name/{{$company->id}}/"+key,
                type:"POST",
                success:function(response){

                    if(response) {

                        if (response.status){
                            var products = response.products

                            //console.log(products)
                            $("#myProducts").empty();
                            for(var i = 0;i<products.length;i++)
                            {
                                title = products[i].title
                                price = 0
                                if(products[i].imports.sale_price ===null){
                                    price = products[i].imports.price
                                }else {
                                    price = products[i].imports.sale_price
                                }

                                barcode = products[i].barcode_number
                                part = products[i].imports.part
                                status = "Yo'q"
                                if(products[i].status ===1){
                                    status = "Bor"
                                }

                                $('#myProducts').append(`<div class="col-md-4"
                                 title="Kelgan narxi: ${price}">
                                <div class="card" id="${barcode}" >
                                    <div class="card-header">


                                        <h3 class="card-title" id="${title}">${title}</h3>
                                        <div class="card-tools">
                                            <!-- Buttons, labels, and many other things can be placed here! -->
                                            <!-- Here is a label for exa    mple -->
                                            <span
                                                class="badge badge-primary">${status}</span>
                                        </div>
                                        <!-- /.card-tools -->
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
<!--                                        <img src="#">-->
                                    </div>

                                    <div class="card-body">
                                        <h7 class="invisible"
                                            id="price">${price}</h7>
                                        <h6 id="price_formated">${price}
                                so'm</h6>
                        </div>


                        <!-- /.card-body -->
                        <div class="card-footer">
                            <i class="fas  fa-barcode"></i> ${barcode} <br> <i
                                            class="fas  fa-box"></i> ${part}
                                </div>
                                <!-- /.card-footer -->
                            </div>
                        </div>`)



                            }
                        }else {
                            $("#myProducts").empty();
                            console.log(response)
                        }
                        // $('.success').text(response.success);
                        // $("#ajaxform")[0].reset();
                    }
                },
                error: function(error) {
                    console.log(error);
                }

            });

        }




    })  //
</script>

<script>
    $(document).ready(function () {
        if ({{session()->get( 'has_cheque' ) !=null}}) {
            printJS('{{ Storage::url("public/pdf/".session()->get( 'has_cheque' )) }}')
        }

    });
</script>




