@extends('layouts.admin')

@section('title', 'Open POS')
@section('content-header', 'Open POS')

@section('content')


    <div class="container-fluid pt-3 ">

        <div class="row ">
            <div class="col-md-6 col-lg-5">
            <form action="{{route("order.create")}}" method="POST">
                    @csrf
                <div class="row mb-2">
                    <div class="col">
                        <input type="text" class="form-control" autoFocus onkeyup="scanBarcode()" id="barcode"
                               placeholder="Scan Barcode..."/>

                    </div>
                    <div class="col">
                        <select class="form-control" name="pay_type">
                            <option value="1">Naqd</option>
                            <option value="2">Plastik</option>
                            </option>
                        </select>
                    </div>
                </div>

                    <div class="user-cart">
                        <div class="card">


                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th class="text-right">Price</th>
                                </tr>
                                </thead>
                                <tbody id="cart_items">

                                {{--<tr id="barcode">
                                    <td>Name<input type="hidden" name="name[]" value="55"></td>
                                    <td><input type="hidden" name="count[]" value="55">
                                        <label class="d-flex align-items-center">
                                            <input type="number" class="form-control form-control-sm w-25 qty" value="1"/>
                                             </label>
                                    </td>

                                    <td class="text-right">1000<input type="hidden" name="price[]" value="1"></td>
                                </tr>--}}

                                </tbody>
                            </table>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col">Total:</div>
                        <div class="col total">

                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button
                                type="button"
                                class="btn btn-danger btn-block">
                                Cancel
                            </button>
                        </div>
                        <div class="col">
                            <button
                                type="submit"
                                class="btn btn-primary btn-block">
                                Submit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-6 col-lg-7">
                <div class="mb-2">
                    <input
                        type="text"
                        id="myFilter" class="form-control" onkeyup="myFunction()"
                        placeholder="Search Product..."
                    />
                </div>
                <div class="order-product">
                    <div class="row" id="myProducts">
                        @foreach($products as $product)


                            <div class="col-md-3">
                                <div class="card" id="{{$product['barcode_number']}}"
                                     onclick="productClickAdd({{$product['barcode_number']}})">
                                    <div class="card-header">


                                        <h3 class="card-title" id="{{$product['title']}}">{{$product['title']}}</h3>
                                        <div class="card-tools">
                                            <!-- Buttons, labels, and many other things can be placed here! -->
                                            <!-- Here is a label for exa    mple -->
                                            <span
                                                class="badge badge-primary">{{($product['status']==1)?"On":"OFF"}}</span>
                                        </div>
                                        <!-- /.card-tools -->
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <img src="{{$product["images"]}}">
                                    </div>

                                    <div class="card-body">
                                        <h3 id="price">{{$product['import']['price']}}</h3>
                                    </div>

                                    <!-- /.card-body -->
                                    <div class="card-footer">
                                        {{$product["description"]}}
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



<script>

    function productClickAdd(barcode) {
        let card = document.getElementById(barcode);
        let product = document.getElementById('i' + barcode);
        if (product) {
            product.querySelector('.w-25').value = +product.querySelector('.w-25').value + 1;
            let price = product.querySelector('.text-right');
            price.innerHTML = +price.innerHTML + Number(card.querySelector('#price').innerHTML);
        } else {
            $('#cart_items').append('<tr id="i' + barcode + '"> <td><input type="hidden" name="barcode[]" value="' + barcode + '">' + $(card).find('.card-title').text() +
                '</td> <td> <label class="d-flex align-items-center"> ' +
                '<input type="number" name="count[]"  class="form-control form-control-sm w-25 qty" value="1" onchange="update(' + barcode + ')" /> ' +
                '<a href="#" onclick="remove(' + barcode + ')" type="button" class="btn-sm btn-danger btn-delete ml-2" data-url=""><i class="fas fa-trash"></i></a> </label> </td>' +
                '<td class="text-right">' + '' +
                +$(card).find('#price').text() +
                '</td> </tr>');
        }
        calculateTotal()
    }

    function update(barcode) {
        let card = document.getElementById(barcode);
        let product = document.getElementById('i' + barcode);
        let quantity = product.querySelector('.w-25').value;
        let price = product.querySelector('.text-right');
        price.innerHTML = +quantity * Number(card.querySelector('#price').innerHTML);
        calculateTotal();
    }

    function scanBarcode() {
        $('#myProducts .card').each(function () {
            let card_id = $(this).attr('id');
            let barcode = $('#barcode').val();
            $(this).filter(function () {
                // console.log(card_id === input)
                if (card_id === barcode) {
                    console.log(this);
                    $('#cart_items').append('<tr  id="i' + barcode + '"> <td><input type="hidden" name="barcode[]" value="' + barcode + '">' + $(this).find('.card-title').text() +
                        '</td> <td> <label class="d-flex align-items-center"> ' +
                        '<input type="number"  name="count[]" class="form-control form-control-sm w-25 qty" value="1"/> ' +
                        '<a href="#" onclick="remove(' + barcode + ')" type="button" class="btn-sm btn-danger btn-delete ml-2" data-url=""><i class="fas fa-trash"></i></a> </label> </td>' +
                        '<td id = "item_price" class="text-right">' + '' +
                        +$(this).find('#price').text() +
                        '</td> </tr>');
                    $('#barcode').val("");
                }
            })
        })
    }


    function remove(barcode) {
        console.log(barcode)
        let item = document.getElementById('i' + barcode);
        item.remove();
        calculateTotal();
    }

    function calculateTotal() {
        // var input, filter, cards, cardContainer, title, i;
        // input = document.getElementById("myFilter");
        // filter = input.value.toUpperCase();
        let cardsContainer = document.getElementById("cart_items");
        let cards = cardsContainer.querySelectorAll(".text-right");
        let total = 0;

        for (let i = 0; i < cards.length; i++) {
            let price = cards[i].innerHTML;
            total += Number(price);
        }
        document.querySelector('.total').innerHTML = total;
    }


    function myFunction() {
        var input, filter, cards, cardContainer, title, i;
        input = document.getElementById("myFilter");
        filter = input.value.toUpperCase();
        cardContainer = document.getElementById("myProducts");
        cards = cardContainer.getElementsByClassName("card");
        for (i = 0; i < cards.length; i++) {
            title = cards[i].querySelector(".card-title");
            if (title.innerText.toUpperCase().indexOf(filter) > -1) {
                cards[i].style.display = "";
            } else {
                cards[i].style.display = "none";
            }
        }
    }

</script>

