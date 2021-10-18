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
                                    <h3 class="card-title">Category Add</h3>
                                </div>
                                <div class="col-6">

                                </div>
                            </div>
                        </div>
                        <!-- ./card-header -->
                        <form method="POST" action="{{ route('branchUpdate',$branch->id) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="branchName">Name</label>
                                            <input type="text" value="{{ $branch->name }}" class="form-control" id="branchName" name="Branch[name]" placeholder="Name of branch">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="branchCompany">Company</label>
                                            <select class="form-control" name="Branch[company_id]" id="branchCompany">
                                                <option value="">Select Company</option>
                                                @foreach($companies as $company)
                                                    <option @if($company->id == $branch->company_id) selected @endif value="{{$company->id}}">{{$company->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="branchAddress">Address</label>
                                            <input type="text" value="{{ $branch->address }}" class="form-control" id="branchAddress" name="Branch[address]" placeholder="Address of branch">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="branchPhone">Phone</label>
                                            <input type="text" value="{{ $branch->phone }}" class="form-control" id="branchPhone" name="Branch[phone]" placeholder="Phone of branch">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>

@endsection
