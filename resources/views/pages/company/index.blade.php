@extends('layouts.admin')

@section('content')
    <section class="content-header">

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
                                            <img src="/company/{{$company->logo}}" alt="" style="max-width: 100px">
                                        </td>
                                        <td style="vertical-align: middle;">{{$company->description}}</td>
                                        <td width="100px" style="vertical-align: middle;">
                                            <div class="btn-group">
                                                <a href="{{ route('companyShow') }}" class="btn btn-info btn-flat">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="/category/edit/{{$company->id}}" class="btn btn-info btn-flat">
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
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>

@endsection
