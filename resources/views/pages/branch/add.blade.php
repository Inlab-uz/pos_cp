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
                                    <h3 class="card-title">@lang('cruds.branch.fields.add')</h3>
                                </div>
                                <div class="col-6">
                                </div>
                            </div>
                        </div>
                        <!-- ./card-header -->
                        <form method="POST" action="{{ route('branchStore') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="branchName">@lang('cruds.branch.fields.name')</label>
                                            <input type="text" class="form-control" id="branchName" name="Branch[name]" placeholder="@lang('cruds.branch.fields.name_helper')" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="branchCompany">@lang('cruds.branch.fields.company')</label>
                                            <select class="form-control" name="Branch[company_id]" id="branchCompany" required>
                                                <option value="">@lang('cruds.branch.fields.company_helper')</option>
                                                @foreach($companies as $company)
                                                    <option value="{{$company->id}}">{{$company->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="branchAddress">@lang('cruds.branch.fields.address')</label>
                                            <input type="text" class="form-control" id="branchAddress" name="Branch[address]" placeholder="@lang('cruds.branch.fields.address_helper')" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="branchPhone">@lang('cruds.branch.fields.phone')</label>
                                            <input type="text" class="form-control" id="branchPhone" name="Branch[phone]" placeholder="@lang('cruds.branch.fields.phone_helper')" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">@lang('cruds.branch.fields.create')</button>
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
