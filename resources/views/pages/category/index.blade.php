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
                                    <h3 class="card-title">Category</h3>
                                </div>
                                <div class="col-6">
                                    <a href="/category/add" class="btn btn-xs btn-flat btn-success" style="float: right">
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
                                    <th>Name</th>
                                    <th>Parent</th>
                                    <th>Company</th>
                                    <th>Logo</th>
                                    <th>User</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                $index = 1
                                @endphp
                                @foreach($categories as $c)
                                    <tr style=" align-items: center">
                                        <td style="vertical-align: middle;">{{$index++}}</td>
                                        <td style="vertical-align: middle;">{{$c->name}}</td>
                                        <td style="vertical-align: middle;">{{$c->parent->name ?? ''}}</td>
                                        <td style="vertical-align: middle;">{{$c->company->name ?? ''}}</td>
                                        <td width="100px">
                                            <img src="/category/img/{{$c->id}}" alt="" style="max-width: 100px">
                                        </td>
                                        <td style="vertical-align: middle;">
                                            {{$c->user->name}}
                                        </td>
                                        <td width="100px" style="vertical-align: middle;">
                                            <div class="btn-group">
                                                <a href="/category/view/{{$c->id}}" class="btn btn-info btn-flat">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="/category/edit/{{$c->id}}" class="btn btn-info btn-flat">
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
