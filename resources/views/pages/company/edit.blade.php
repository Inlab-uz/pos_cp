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
                                    <h3 class="card-title">@lang('cruds.company.fields.edit')</h3>
                                </div>
                                <div class="col-6">

                                </div>
                            </div>
                        </div>
                        <!-- ./card-header -->
                        <form method="POST" action="{{ route('companyUpdate',$company->id) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="categoryName">@lang('cruds.company.fields.name')</label>
                                            <input type="text" class="form-control" id="categoryName" name="Company[name]" placeholder="Name of company" value="{{$company->name}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="exampleInputFile">@lang('cruds.company.fields.logo')</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="categoryLogo" name="Company[logo]">
                                                    <label class="custom-file-label" for="companyLogo">@lang('cruds.company.fields.logo_choose')</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="exampleInputFile">@lang('cruds.company.fields.description')</label>
                                            <div class="input-group">
                                                 <textarea name="Company[description]" class="form-control" rows="3">{{ $company->description }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">@lang('cruds.company.fields.edit')</button>
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
