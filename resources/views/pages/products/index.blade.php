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
                <div class="col-4">
                    <form action="" method="get">
                        <div class="input-group">
                            <select class="form-control" name="key" id="key">
                                <option value="title" selected>@lang('cruds.pos.fields.product_name')</option>
                                <option value="barcode_number">@lang('cruds.pos.fields.barcode')</option>
                                <option value="price">@lang('cruds.import.fields.price')</option>
                                <option value="sale_price">@lang('cruds.import.fields.sale_price')</option>
                                <option value="quantity">@lang('cruds.import.fields.quantity')</option>
                                <option value="inactive">@lang('cruds.product.fields.movement')</option>
                                <option value="least">@lang('cruds.product.fields.least_products')</option>
                            </select>
                            <input type="search" class="form-control" name="search"
                                   placeholder="@lang('cruds.pos.fields.product_search')"> <span
                                class="input-group-btn">
                            <button type="submit" class="btn btn-primary">
                            <span class="glyphicon glyphicon-search">@lang('global.search')</span>
                            </button>
                            </span>
                        </div>
                    </form>
                </div>
                <div class="col-5">
                    <form action="{{ url('import_excel') }}" method="POST" name="importform"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="btn-group">
                            <a class="btn btn-default btn-flat" href="{{ asset('exemple.xlsx') }}" title="Sample">
                                <i class="fas fa-download"></i>
                            </a>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                            </div>
                            <a class="btn btn-default btn-flat" href="#" title="Import">
                                <i class="fas fa-file-import"></i>
                            </a>


                            <a class="btn btn-default btn-flat" href="{{ url('export_excel') }}" title="Export">
                                <i class="fas fa-file-export"></i>
                            </a>
                        </div>
                    </form>
                </div>
                <div class="col-2">
                    <a style="float: right" href="{{route('products.create')}}" class="btn btn-primary">
                        @lang('cruds.product.fields.add')
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>@lang('cruds.pos.fields.product_name')</th>
                    <th>@lang('cruds.product.fields.image')</th>
                    <th>@lang('cruds.pos.fields.barcode')</th>
                    <th>@lang('cruds.import.fields.price')</th>
                    <th>@lang('cruds.import.fields.sale_price')</th>
                    <th>@lang('cruds.import.fields.quantity')</th>
                    <th>@lang('cruds.product.fields.state')</th>
                    <th>@lang('cruds.product.fields.movement')</th>
                    <th>@lang('cruds.user.fields.created_at')</th>

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
