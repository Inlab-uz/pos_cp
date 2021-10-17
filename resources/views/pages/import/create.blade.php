@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="card card-body">
            <form action="{{ route('importStore') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" name="bar_code" id="bar_code" class="form-control" placeholder="barcode">
                    </div>

                    <div class="col-md-4">
                        <input type="hidden" id="product_id" value="" name="product_id" >
                        <p id="product_name"></p>
                    </div>
                </div>

                <br>
                <div id="d_none" class="row d-none" >
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <label>O'lchami</label>
                                <input type="text" name="measure" class="form-control" placeholder="O'lchami">

                                <label>Soni</label>
                                <input type="text" name="quantity" class="form-control" placeholder="Soni">

                                <label>Tannarxi</label>
                                <input type="text" name="price" class="form-control" placeholder="Tannarxi">

                                <label>Sotish narxi</label>
                                <input type="text" name="sale_price" class="form-control" placeholder="Sotish narxi">

                                <label>Nds</label>
                                <input type="text" name="nds" class="form-control" placeholder="Nds">
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-success form-control">Save</button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).on("keyup","#bar_code",function (){
            var temp = $(this);
            setTimeout(function (){
                var bar_code = temp.val();
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    type:'POST',
                    url:'{{ route('getBarCode') }}',
                    data:{bar_code:bar_code},
                    success:function(data){
                        $("#product_name").text("Tovar nomi: "+data['name']);
                        $("#product_id").val(data['id']);
                        $("#d_none").removeClass("d-none");
                    }
                });
            }, 200)
        });
    </script>
@endsection
