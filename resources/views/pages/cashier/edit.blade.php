@extends('layouts.admin')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('cruds.user.title')</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('global.home')</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('cashierIndex') }}">@lang('cruds.user.title')</a>
                        </li>
                        <li class="breadcrumb-item active">@lang('global.edit')</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->

    <section class="content">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">@lang('global.edit')</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <form action="{{ route('cashierUpdate',$cashier->id) }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>@lang('cruds.user.fields.name')</label>
                                <input type="text" name="name"
                                       class="form-control {{ $errors->has('name') ? "is-invalid":"" }}"
                                       value="{{ old('name',$cashier->name) }}" required>
                                @if($errors->has('name'))
                                    <span class="error invalid-feedback">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>@lang('cruds.user.fields.email')</label>
                                <input type="email" name="email"
                                       class="form-control {{ $errors->has('email') ? "is-invalid":"" }}"
                                       value="{{ old('email',$cashier->email) }}" required>
                                @if($errors->has('email'))
                                    <span class="error invalid-feedback">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="">Branch</label>
                                <select class="form-control" name="branch_id">
                                    <option value="">Select Branch</option>
                                    @foreach($branches as $branch)
                                        <option value="{{$branch->id}}">{{$branch->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <label>@lang('cruds.user.fields.password')</label>
                            <div class="form-group">
                                <input type="password" name="password" id="password-field"
                                       class="form-control {{ $errors->has('password') ? "is-invalid":"" }}">
                                <span toggle="#password-field"
                                      class="fa fa-fw fa-eye toggle-password field-icon"></span>
                                @if($errors->has('password'))
                                    <span class="error invalid-feedback">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>@lang('global.login_password_confirmation')</label>
                                <input id="password-confirm" type="password" class="form-control"
                                       name="password_confirmation" autocomplete="new-password">
                                <span toggle="#password-confirm"
                                      class="fa fa-fw fa-eye toggle-password field-icon"></span>
                                @if($errors->has('password_confirmation'))
                                    <span
                                        class="error invalid-feedback">{{ $errors->first('password_confirmation') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success float-right">@lang('global.save')</button>
                                <a href="{{ route('cashierIndex') }}"
                                   class="btn btn-default float-left">@lang('global.cancel')</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
