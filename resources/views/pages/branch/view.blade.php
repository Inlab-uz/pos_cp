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
                                    <h3 class="card-title">Branch {{$branch->name}}</h3>
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
                                            <td>{{ $branch->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Company</td>
                                            <td>{{ $branch->company->name ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Address</td>
                                            <td>{{ $branch->address }}</td>
                                        </tr>
                                        <tr>
                                            <td>Phone</td>
                                            <td>{{ $branch->phone }}</td>
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
