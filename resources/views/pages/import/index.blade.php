@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('cruds.import.title')</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('global.home')</a></li>
                        <li class="breadcrumb-item active">@lang('cruds.import.title_singular')</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">@lang('cruds.import.title_singular')</h3>
{{--                        <a href="{{ route('importCreate') }}" class="btn btn-success btn-sm float-right">--}}
{{--                            <span class="fas fa-plus-circle"></span>--}}
{{--                            @lang('global.add')--}}
{{--                        </a>--}}
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered table-striped dtr-inline table-responsive-lg">
                            <thead>
                            <tr>
                                <th>@lang('cruds.category.title')</th>
                                <th>@lang('cruds.product.title')</th>
                                <th>@lang('cruds.discount.title')</th>
                                <th>@lang('cruds.import.fields.measure')</th>
                                <th>@lang('cruds.import.fields.quantity')</th>
                                <th>@lang('cruds.import.fields.left_quantity')</th>
                                <th>@lang('cruds.import.fields.price')</th>
                                <th>@lang('cruds.import.fields.nds')</th>
                                <th>@lang('cruds.import.fields.sale_price')</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($imports as $import)
                                    <tr>
                                        <td>Category</td>
                                        <td>{{ $import->product->title }}</td>
                                        <td>Chegirma</td>
                                        <td>{{ $import->measure }}</td>
                                        <td>{{ $import->quantity }}</td>
                                        <td>{{ $import->part }}</td>
                                        <td>{{ $import->price }}</td>
                                        <td>{{ $import->sale_price }}</td>
                                        <td>{{ $import->nds }}</td>
                                        <th>
                                            <a style="margin-left: 10px" href="{{route('importEdit',$import->id)}}" class="float-left fa fa-edit btn btn-info btn-sm" ></a>
                                        </th>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <br>
                        {{ $imports->links() }}
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
@endsection
