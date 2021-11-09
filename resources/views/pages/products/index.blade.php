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
            <div class="col-6">
                <form action="" method="get">
                    <div class="input-group">
                        <select class="form-control" name="key" id="key">
                            <option value="title" selected>Name</option>
                            <option value="barcode_number">Barcode</option>
                            <option value="price">Price</option>
                            <option value="sale_price">Sale Price</option>
                            <option value="quantity">Quantity</option>
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
            <div class="col-2"></div>
            <div class="col-4">
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
                            {{$product->quantity ?? '0.00'}}
                        @else
                            {{$product->import->quantity ?? '0.00'}}
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
                    <td>{{$product->created_at}}</td>
                    <td>
                        <a href="{{ route('products.edit', $product) }}" class="btn btn-primary"><i
                                class="fas fa-edit"></i></a>
                        <button class="btn btn-danger btn-delete" data-url="{{route('products.destroy', $product)}}"><i
                                class="fas fa-trash"></i></button>
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
