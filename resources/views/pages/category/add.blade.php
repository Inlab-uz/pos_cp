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
                                    <h3 class="card-title">@lang('cruds.category.fields.add')</h3>
                                </div>
                                <div class="col-6">

                                </div>
                            </div>
                        </div>
                        <!-- ./card-header -->
                        <form method="POST" action="/category/store" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="categoryName">@lang('cruds.category.fields.name')</label>
                                            <input type="text" class="form-control" id="categoryName"
                                                   name="Category[name]" placeholder="@lang('cruds.category.fields.add_helper')">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="categoryParent">@lang('cruds.category.fields.parent')</label>
                                            <select class="form-control" name="Category[parent_id]" id="categoryParent">
                                                <option value="">@lang('cruds.category.fields.parent_helper')</option>
                                                @foreach($categories as $c)
                                                    <option value="{{$c->id}}">{{$c->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="categoryBranch">@lang('cruds.branch.title')</label>
                                            <select class="form-control" name="Category[branch_id]" id="categoryBranch">
                                                @foreach($branches as $b)
                                                    <option value="{{$b->id}}">{{$b->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">@lang('cruds.category.fields.category_image')</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="categoryLogo"
                                                   name="Category[logo]">
                                            <label class="custom-file-label" for="categoryLogo">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">@lang('cruds.category.fields.create_category')</button>
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
