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
                            <input type="text" class="form-control" autoFocus onkeyup="scanBarcode()" id="barcode"
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
                                {{--                                Cart Items--}}
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

                        {{-- <button type="button" >
                             Direct PRINT
                         </button>--}}

                    </div>
                </form>
            </div>
            <div class="col-md-6 col-lg-7">
                <div class="mb-2">
                    <input
                        type="text"
                        id="myFilter" class="form-control" onkeyup="myFunction()"
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


        $('#myProducts .card').each(function () {
            $(this).click(function () {
                let barcode = $(this).attr('id');
                let product = document.getElementById('i' + barcode)
                if (product) {
                    product.querySelector('.qty').value = +product.querySelector('.qty').value + 1;
                    let product_price = Number($(this).find('#price').text());
                    $('#cart_price').html(Number($('#cart_price').html()) + product_price)
                } else {
                    $('#cart_items').append(
                        `<tr id="i${barcode}">
                                <td>
                                    <input type="hidden" name="barcode[]" value="${barcode}">
                                    ${$(this).find('.card-title').text()}
                                </td>
                                <td class="d-flex align-items-center">
                                    <input type="number" name='count[]' class="form-control-sm qty w-25 changable" value="1" onchange="update('${barcode}')" onkeyup="update('${barcode}')"/>
                                    <button onclick="remove('${barcode}')" type="button" class="btn btn-sm btn-danger ml-2"><i class="fas fa-trash"></i></button>
                                </td>
                                <td id="cart_price"> ${$(this).find('#price').text()} </td>
                        </tr>`)

                }
                calculateTotal()
            })
        })

        window.remove = (barcode) => {
            let item = document.getElementById('i' + barcode);
            item.remove();
            calculateTotal();
        }


        window.update = (barcode) => {

            let card = $('#' + barcode);
            let product = $('#i' + barcode);
            let quantity = product.find('.changable').val();
            let price = product.find('#cart_price');
            $(price).html(quantity * Number(card.find('#price').text()))
            console.log(quantity);
            calculateTotal()
        }


        window.scanBarcode = () => {
            // let product = document.getElementById('i' + barcode)
            // if (product) {
            //     product.querySelector('.qty').value = +product.querySelector('.qty').value + 1;
            //     let product_price = Number($(this).find('#price').text());
            //     $('#cart_price').html( Number($('#cart_price').html()) + product_price )
            // } else {
            //     $('#cart_items').append(
            //         `<tr id="i${barcode}">
            //                     <td>
            //                         <input type="hidden" name="barcode[]" value="${barcode}">
            //                         ${$(this).find('.card-title').text()}
            //                     </td>
            //                     <td class="d-flex align-items-center">
            //                         <input type="number" name='count[]' class="form-control-sm qty w-25" value="1" onchange="update(${barcode})"/>
            //                         <button onclick="remove(${barcode})" type="button" class="btn btn-sm btn-danger ml-2"><i class="fas fa-trash"></i></button>
            //                     </td>
            //                     <td id="cart_price"> ${$(this).find('#price').text()} </td>
            //             </tr>`)
            //
            // }
            // calculateTotal()
            $('#myProducts .card').each(function () {
                let card_id = $(this).attr('id');
                let barcode = $('#barcode').val();
                console.log(barcode)
                let card = document.getElementById(barcode);
                let product = document.getElementById('i' + barcode)
                $(this).filter(function () {
                    if (card_id === barcode) {
                        if (product) {
                            // product.querySelector('.w-25').value = +product.querySelector('.w-25').value + 1;
                            // let price = product.querySelector('.text-right');
                            // price.innerHTML = +price.innerHTML + Number(card.querySelector('#price').innerHTML);
                            product.querySelector('.qty').value = +product.querySelector('.qty').value + 1;
                            let product_price = Number($(this).find('#price').text());
                            $('#cart_price').html(Number($('#cart_price').html()) + product_price)
                            $('#barcode').val("");
                            calculateTotal();
                        } else {
                            $('#cart_items').append(
                                `<tr id="i${barcode}">
                                                <td>
                                                    <input type="hidden" name="barcode[]" value="${barcode}">
                                                    ${$(this).find('.card-title').text()}
                                                </td>
                                                <td class="d-flex align-items-center">
                                                    <input type="number" name='count[]' class="form-control-sm qty w-25 changable" value="1" onchange="update('${barcode}')"  onkeyup="update('${barcode}')"/>
                                                    <button onclick="remove('${barcode}')" type="button" class="btn btn-sm btn-danger ml-2"><i class="fas fa-trash"></i></button>
                                                </td>
                                                <td id="cart_price"> ${$(this).find('#price').text()} </td>
                                        </tr>`)
                            $('#barcode').val("");
                            calculateTotal();
                            // console.log(this);
                            // $('#cart_items').append('<tr  id="i' + barcode + '"> <td><input type="hidden" name="barcode[]" value="' + barcode + '">' + $(this).find('.card-title').text() +
                            //     '</td> <td> <label class="d-flex align-items-center"> ' +
                            //     '<input type="number"  name="count[]" class="form-control form-control-sm w-25 qty" value="1"/> ' +
                            //     '<a href="#" onclick="remove(' + barcode + ')" type="button" class="btn-sm btn-danger btn-delete ml-2" data-url=""><i class="fas fa-trash"></i></a> </label> </td>' +
                            //     '<td id = "item_price" class="text-right">' + '' +
                            //     +$(this).find('#price').text() +
                            //     '</td> </tr>');
                            // $('#barcode').val("");
                        }
                    }
                })
            })


        }


        function calculateTotal() {
            let cart_items = $('#cart_items tr');
            let total = 0;

            cart_items.each(function () {
                total = total + Number($(this).find('#cart_price').text())
            })
            $('.total').html(total);
        }


        window.myFunction = () => {
            var input, filter, cards, cardContainer, title, i;
            input = document.getElementById("myFilter");
            filter = input.value.toUpperCase();
            cardContainer = document.getElementById("myProducts");
            cards = cardContainer.getElementsByClassName("card");
            for (i = 0; i < cards.length; i++) {
                title = cards[i].querySelector(".card-title");
                if (title.innerText.toUpperCase().indexOf(filter) > -1) {
                    cards[i].parentElement.style.display = "block";
                } else {
                    cards[i].parentElement.style.display = "none";
                }
            }
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

