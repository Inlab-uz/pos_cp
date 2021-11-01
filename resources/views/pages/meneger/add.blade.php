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
                                    <h3 class="card-title">Maneger Add</h3>
                                </div>
                                <div class="col-6">
                                </div>
                            </div>
                        </div>
                        <!-- ./card-header -->
                        <form method="POST" action="{{ route('menegerStore') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">

                                <div class="form-group">
                                    <label>@lang('cruds.user.fields.name')</label>
                                    <input type="text" name="name"
                                           class="form-control {{ $errors->has('name') ? "is-invalid":"" }}"
                                           value="{{ old('name') }}" required>
                                    @if($errors->has('name'))
                                        <span class="error invalid-feedback">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>


                                <div class="form-group">
                                    <label>@lang('cruds.user.fields.email')</label>
                                    <input type="email" name="email"
                                           class="form-control {{ $errors->has('email') ? "is-invalid":"" }}"
                                           value="{{ old('email') }}" required>
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


                                <div class="form-group">
                                    <label>@lang('cruds.user.fields.password')</label>
                                    <input type="password" name="password" id="password-field"
                                           class="form-control {{ $errors->has('password') ? "is-invalid":"" }}"
                                           required>
                                    <span toggle="#password-field"
                                          class="fa fa-fw fa-eye toggle-password field-icon"></span>
                                    @if($errors->has('password'))
                                        <span class="error invalid-feedback">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>@lang('global.login_password_confirmation')</label>
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" required autocomplete="new-password">
                                    <span toggle="#password-confirm"
                                          class="fa fa-fw fa-eye toggle-password field-icon"></span>
                                    @if($errors->has('password_confirmation'))
                                        <span
                                            class="error invalid-feedback">{{ $errors->first('password_confirmation') }}</span>
                                    @endif
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
