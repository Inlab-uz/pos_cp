@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="card card-body">
            <form action="{{ route('importStore') }}" method="POST">
                <input type="text" name="bar_code" id="bar_code" class="form-control" placeholder="barcode">
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
                        $("#acocunt_number").html('');
                    }
                });

            }, 200)
        });
    </script>
@endsection
