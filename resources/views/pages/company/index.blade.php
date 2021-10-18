@extends('layouts.admin')

@section('content')
<<<<<<< HEAD
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Company</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('global.home')</a></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
=======
    <section class="content-header">

    </section>
    <section class="content">
        <div class="container-fluit">
>>>>>>> cfb08140a40df43f65a60bfb3b13a35addd84dd4
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
<<<<<<< HEAD
                            <h3 class="card-title">@lang('global.cards')</h3>
                            <span class="badge badge-light">@lang('global.amount') : {{ $companies->total() ?? 0 }}</span>
                            <div class="card-tools">
                                <div class="btn-group">
                                    <button name="filter" type="button" value="1" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#filter-modal"><i class="fas fa-filter"></i> @lang('global.filter')</button>
                                    <form action="" method="get">
                                        <div class="modal fade" id="filter-modal" tabindex="-1" role="dialog" aria-labelledby="filters" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">@lang('global.filter')</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        {{--name--}}
                                                        <div class="form-group row align-items-center">
                                                            <div class="col-3">
                                                                <h6>Name</h6>
                                                            </div>
                                                            <div class="col-2">
                                                                <select class="form-control form-control-sm">
                                                                    <option value="" selected> like </option>
                                                                </select>
                                                            </div>
                                                            <div class="col-3">
                                                                <input class="form-control form-control-sm" type="text" name="name" value="{{ old('name',request()->name ?? '') }}">
                                                                <input type="text" name="name_operator" value="like" hidden>
                                                            </div>
                                                        </div>

                                                        <!-- User -->
                                                        <div class="form-group row align-items-center">
                                                            <div class="col-3">
                                                                <h6>User</h6>
                                                            </div>
                                                            <div class="col-2">
                                                                <select class="form-control form-control-sm">
                                                                    <option value=""> = </option>
                                                                </select>
                                                            </div>
                                                            <div class="col-3">
                                                                <select class="form-control form-control-sm" name="sms">
                                                                    <option value=""></option>
                                                                    @foreach($users as $user)
                                                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" name="filter" class="btn btn-primary">@lang('global.filtering')</button>
                                                        <button type="button" class="btn btn-outline-warning float-left pull-left" id="reset_form">@lang('global.clear')</button>
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('global.closed')</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <a href="{{ route('companies.index') }}" class="btn btn-secondary btn-sm"><i class="fa fa-redo-alt"></i> @lang('global.clear')</a>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr class="text-center">
                                    <th>ID</th>
                                    <th>Company name</th>
                                    <th>Description</th>
                                    <th>Owner</th>
                                    <th>Branches</th>
                                    <th style="width: 40px">@lang('global.action')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($companies as $company)
                                    <tr class="text-center">
                                        <td>{{ $company->id }}</td>
                                        <td>{{ $company->name }}</td>
                                        <td>{{ $company->shortDescription() }}</td>
                                        <td>{{ $company->getOwner() }}</td>
                                        <td>{{ $company->branches_count }}</td>
                                        <td class="text-center" style="vertical-align: middle">
                                                <form action="{{ route('companies.destroy',$company->id) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <div class="btn-group">
                                                        @can('company.edit')
                                                            <a href="{{ route('companies.edit',$company->id) }}" type="button" class="btn btn-info btn-sm"> <i class="fa fa-pen"></i></a>
                                                        @endcan
                                                        @can('company.delete')
                                                            <button class="submitButton btn btn-danger btn-sm"> <i class="fa fa-trash"></i></button>
                                                        @endcan
                                                    </div>
                                                </form>
=======
                            <div class="row">
                                <div class="col-6">
                                    <h3 class="card-title">Company</h3>
                                </div>
                                <div class="col-6">
                                    <a href="{{ route('companyCreate') }}" class="btn btn-xs btn-flat btn-success" style="float: right">
                                        Add New
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- ./card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>User</th>
                                    <th>Name</th>
                                    <th>Logo</th>
                                    <th>Description</th>
                                    <th>User</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $index = 1
                                @endphp
                                @foreach($companies as $company)
                                    <tr style=" align-items: center">
                                        <td style="vertical-align: middle;">{{$index++}}</td>
                                        <td style="vertical-align: middle;">{{$company->user_id}}</td>
                                        <td style="vertical-align: middle;">{{$company->name}}</td>
                                        <td width="100px">
                                            <img src="{{ route('companyImg',$company->id) }}" alt="" style="max-width: 100px">
                                        </td>
                                        <td style="vertical-align: middle;">{{$company->description}}</td>
                                        <td width="100px" style="vertical-align: middle;">
                                            <div class="btn-group">
                                                <a href="{{ route('companyView',$company->id) }}" class="btn btn-info btn-flat">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('companyEdit',$company->id) }}" class="btn btn-info btn-flat">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            </div>
>>>>>>> cfb08140a40df43f65a60bfb3b13a35addd84dd4
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
<<<<<<< HEAD
                        <div class="card-footer">
                            {{ $companies->withQueryString()->links() }}
                        </div>
                    </div>
=======
                    </div>
                    <!-- /.card -->
>>>>>>> cfb08140a40df43f65a60bfb3b13a35addd84dd4
                </div>
            </div>
        </div>
    </section>
<<<<<<< HEAD
=======

>>>>>>> cfb08140a40df43f65a60bfb3b13a35addd84dd4
@endsection
