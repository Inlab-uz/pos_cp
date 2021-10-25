@extends('layouts.admin')

@section('content')

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
        <div class="container-fluit">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-6">
                                    <h3 class="card-title">Company</h3>
                                </div>
                                <div class="col-6">
                                    @if($has == false)
                                        <a href="{{ route('companyCreate') }}" class="btn btn-xs btn-flat btn-success" style="float: right">
                                            Add New
                                        </a>
                                    @elseif($has == true)
                                        @if($count == 0 )
                                            <a href="{{ route('companyCreate') }}" class="btn btn-xs btn-flat btn-success" style="float: right">
                                                Add New
                                            </a>
                                        @endif
                                    @endif

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
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            {{ $companies->withQueryString()->links() }}
                        </div>
                    </div>
                    </div>
                    <!-- /.card -->
                </div>
        </div>
    </section>
@endsection
