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
                                    <a href="{{ route('cashierCreate') }}" class="btn btn-xs btn-flat btn-success"
                                       style="float: right">
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
                                    <th>name</th>
                                    <th>email</th>

                                </tr>
                                </thead>
                                <tbody>

                                @foreach($cashiers as $cashier)
                                    <tr style=" align-items: center">
                                        <td style="vertical-align: middle;">{{$cashier->id}}</td>
                                        <td style="vertical-align: middle;">{{$cashier->name}}</td>
                                        <td style="vertical-align: middle;">{{$cashier->email}}</td>

                                        <td width="100px" style="vertical-align: middle;">
                                            <div class="btn-group">
                                                <a href="{{ route('cashierEdit', $cashier->id) }}"
                                                   class="btn btn-info btn-flat">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="{{ route('cashierDelete', $cashier->id) }}"
                                                   class="btn btn-danger btn-flat">
                                                    @method('delete')
                                                    <i class="far fa-trash-alt"></i>
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
            {{ $cashiers->links() }}
        </div>
    </section>

@endsection
