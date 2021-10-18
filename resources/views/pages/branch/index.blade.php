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
                                    <h3 class="card-title">Branch</h3>
                                </div>
                                <div class="col-6">
                                    <a href="{{ route('branchCreate') }}" class="btn btn-xs btn-flat btn-success" style="float: right">
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
                                    <th>Company</th>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Phone</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $index = 1
                                @endphp
                                @foreach($branches as $branch)
                                    <tr style=" align-items: center">
                                        <td style="vertical-align: middle;">{{$index++}}</td>
                                        <td style="vertical-align: middle;">{{$branch->company->name}}</td>
                                        <td style="vertical-align: middle;">{{$branch->name}}</td>
                                        <td style="vertical-align: middle;">{{$branch->address}}</td>
                                        <td style="vertical-align: middle;">{{$branch->phone}}</td>

                                        <td width="100px" style="vertical-align: middle;">
                                            <div class="btn-group">
                                                <a href="{{ route('branchView',$branch->id) }}" class="btn btn-info btn-flat">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('branchEdit',$branch->id) }}" class="btn btn-info btn-flat">
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
            {{ $branches->links() }}
        </div>
    </section>

@endsection
