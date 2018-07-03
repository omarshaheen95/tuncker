@extends('layout.login')

@section('content')
<div class="row">
    <div class="col-lg-6 bg-white pattern">
        <div class="auth-form-light p-5 pattern">
        <h2>{{ trans('main.login') }}</h2>
        <h4 class="font-weight-light card-title">{{ trans('main.welcome') }}</h4>
        <form class="pt-4" role="form" method="POST" action="{{ url('/admin/login') }}">
                        {{ csrf_field() }}
            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                <label>{{ trans('main.email') }}</label>
                <input type="email" class="form-control" name="email"  aria-describedby="emailHelp" placeholder="{{ trans('main.email') }}" value="{{ old('email') }}" autofocus>
                <i class="mdi mdi-account"></i>
                @if ($errors->has('email'))
                    <span class="help-block text-danger">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                <label>{{ trans('main.password') }}</label>
                <input type="password" class="form-control" name="password"  placeholder="{{ trans('main.password') }}">
                <i class="mdi mdi-eye"></i>
                @if ($errors->has('password'))
                    <span class="help-block text-danger">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>

            <div class="mt-5">
                <input class="btn btn-block btn-primary btn-lg font-weight-medium" type="submit" value="{{ trans('main.login') }}" />
            </div>
            
            
            </form>                  
        </form>
        </div>
    </div>
    <div class="col-lg-6 register-half-bg d-flex flex-row">
        <p class="font-weight-medium text-center flex-grow align-self-end">{{ trans('main.Copyright') }}</p>
    </div>
</div>
@endsection
