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
                                            <td>{{$company->name}}</td>
                                        </tr>
                                        <tr>
                                            <td>Logo</td>
                                            <td>{{$company->logo ?? ''}}</td>
                                        </tr>
                                        <tr>
                                            <td>User</td>
                                            <td>{{$company->user->name ?? ''}}</td>
                                        </tr>
                                        <tr>
                                            <td>Description</td>
                                            <td>{{$company->description}}</td>
                                        </tr>
                                        <tr>
                                            <td>Created</td>
                                            <td>{{$company->created_at}}</td>
                                        </tr>
                                        <tr>
                                            <td>Updated</td>
                                            <td>{{$company->updated_at}}</td>
                                        </tr>
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
