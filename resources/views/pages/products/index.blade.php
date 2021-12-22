@extends('layouts.admin')

@section('title', 'Product List')
@section('content-header', 'Product List')
@section('content-actions')

@endsection
@section('css')
{{--<link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">--}}
@endsection
@section('content')

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-5">
                <form action="" method="get">
                    <div class="input-group">
                        <select class="form-control" name="key" id="key">
                            <option value="title" selected>Name</option>
                            <option value="barcode_number">Barcode</option>
                            <option value="price">Price</option>
                            <option value="sale_price">Sale Price</option>
                            <option value="quantity">Quantity</option>
                            <option value="inactive">Xarakatsiz</option>
                            <option value="least">Kam qolgan tovarlar</option>
                        </select>
                        <input type="search" class="form-control" name="search"
                               placeholder="Search product"> <span class="input-group-btn">
                            <button type="submit" class="btn btn-primary">
                            <span class="glyphicon glyphicon-search">Search</span>
                            </button>
                            </span>
                    </div>
                </form>
            </div>
            <div class="col-5">
                <form action="{{ url('import_excel') }}" method="POST" name="importform"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-3">
                            <a class="btn btn-primary" href="{{ asset('exemple.xlsx') }}"><i class="fas fa-download"></i> Example</a>
                        </div>
                        <div class="col-5">
                            <div class="form-group">
{{--                                <label for="file">File:</label>--}}
                                <input id="file" type="file" name="file" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-2">
                            <button class="btn btn-success">Import</button>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                <a class="btn btn-info" href="{{ url('export_excel') }}">Export</a>
                            </div>
                        </div>
                    </div>



                </form>
            </div>
            <div class="col-2">
                <a style="float: right" href="{{route('products.create')}}" class="btn btn-primary">Create Product</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Barcode</th>
                    <th>Price</th>
                    <th>Sale price</th>
                    <th>Quantity</th>
                    <th>Status</th>
                    <th>Xarakati</th>
                    <th>Created At</th>

                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)

                <tr>
                    <td>{{$product->id}}</td>
                    <td>{{$product->title ?? $product->product->title}}</td>
                    <td><img src="{{ Storage::url($product->images) }}" alt="" width="100"></td>
                    <td>{{$product->barcode_number ?? $product->product->barcode_number}}</td>
                    <td>
                        @if($key)
                            {{$product->price ?? '0.00'}}
                        @else
                            {{$product->import->price ?? '0.00'}}
                        @endif
                    </td>
                    <td>
                        @if($key)
                            {{$product->sale_price ?? '0.00'}}
                        @else
                            {{$product->import->sale_price ?? '0.00'}}
                        @endif
                    </td>
                    <td>
                        @if($key)
                            {{$product->part ?? '0.00'}}
                        @else
                            {{$product->import->part ?? '0.00'}}
                        @endif
                    </td>
                    <td>
                        <span
                            class="right badge badge-@if($key){{$product->product->status ? 'success' : 'danger'}}@else{{ $product->status ? 'success' : 'danger' }}@endif">
                            @if($key)
                                {{$product->product->status ? 'Active' : 'Inactive'}}
                            @else
                                {{$product->status ? 'Active' : 'Inactive'}}
                            @endif
                        </span>
                    </td>
                    <td>-</td>
                    <td>{{$product->created_at}}</td>
                    <td>
                        <a href="{{ route('products.edit', $product) }}" class="btn btn-primary"><i
                                class="fas fa-edit"></i></a>
                        <a href="{{route('productDelete', $product)}}" class="btn btn-danger btn-delete"><i
                                class="fas fa-trash"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $products->links() }}
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script>
    $(document).ready(function () {
        $(document).on('click', '.btn-delete', function () {
            $this = $(this);
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
                })

                swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "Do you really want to delete this product?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No',
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    $.post($this.data('url'), {_method: 'DELETE', _token: '{{csrf_token()}}'}, function (res) {
                        $this.closest('tr').fadeOut(500, function () {
                            $(this).remove();
                        })
                    })
                }
            })
        })
    })
</script>
@endsection
