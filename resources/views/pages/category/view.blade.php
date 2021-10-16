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
                                    <h3 class="card-title">Category {{$cat->name}}</h3>
                                </div>
                                <div class="col-6">

                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>Attribute</th>
                                            <th>Value</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>Name</td>
                                            <td>{{$cat->name}}</td>
                                        </tr>
                                        <tr>
                                            <td>Parent</td>
                                            <td>{{$cat->parent->name ?? ''}}</td>
                                        </tr>
                                        <tr>
                                            <td>Company</td>
                                            <td>{{$cat->company->name ?? ''}}</td>
                                        </tr>
                                        <tr>
                                            <td>Branch</td>
                                            <td>{{$cat->branch->name ?? ''}}</td>
                                        </tr>
                                        <tr>
                                            <td>User</td>
                                            <td>{{$cat->user->name ?? ''}}</td>
                                        </tr>
                                        <tr>
                                            <td>Created</td>
                                            <td>{{$cat->created_at}}</td>
                                        </tr>
                                        <tr>
                                            <td>Updated</td>
                                            <td>{{$cat->updated_at}}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-6">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>Childs</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($cat->child() as $c)
                                            <tr>
                                                <td>{{$c->name}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>

@endsection
