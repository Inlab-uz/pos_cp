@extends('layouts.admin')

@section('title', 'Open POS')
@section('content-header', 'Open POS')

@section('content')


    <div class="container-fluid pt-3 ">

        <div class="row ">
            <div class="col-md-6 col-lg-5">
                <div class="row mb-2">
                    <div class="col">
                        <input type="text" class="form-control" autoFocus  onkeyup="scanBarcode()" id="barcode" placeholder="Scan Barcode..."/>

                    </div>
                    <div class="col">
                        <select class="form-control">
                            <option value="">Walking Customer</option>
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

                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row">
                    <div class="col">Total:</div>
                    <div class="col text-right">

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
                            type="button"
                            class="btn btn-primary btn-block">
                            Submit
                        </button>
                    </div>
                </div>
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


                            <div class="col-md-3" >
                                <div class="card" id="{{$product['barcode_number']}}">
                                    <div class="card-header">

                                        <h3 class="card-title" id="{{$product['title']}}">{{$product['title']}}</h3>
                                        <div class="card-tools">
                                            <!-- Buttons, labels, and many other things can be placed here! -->
                                            <!-- Here is a label for example -->
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

    function scanBarcode(){
        $('#myProducts .card').each(function(){
            var card_id = $(this).attr('id')
            var input = $('#barcode').val();
            $(this).filter( function (){
                // console.log(card_id === input)
                if(card_id === input){
                    console.log(this)
                    $('#cart_items').append('<tr> <td>' + $(this).find('.card-title').text() +
                        '</td> <td> <label class="d-flex align-items-center"> ' +
                        '<input type="number" min="1" class="form-control form-control-sm w-25 qty"value="1"/> ' +
                        '<button class="btn-sm btn-danger btn-delete ml-2" data-url=""><i class="fas fa-trash"></i></button> </label> </td>' +
                        '<td class="text-right">' + '' +
                             + $(this).find('#price').text() +
                        '</td> </tr>');
                    $('#barcode').val("");
                }
            })


        })
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

