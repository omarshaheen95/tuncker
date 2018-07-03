@extends('layout.login')
@if (LaravelLocalization::getCurrentLocale() == 'ar')
    @php
        $val = 'en';
        $lang = 'ar'
    @endphp
@elseif(LaravelLocalization::getCurrentLocale() == 'en')
    @php
        $val = 'ar';
        $lang = 'en'
    @endphp
@endif
@section('content')
<div class="row">
    <div class="col-lg-6 bg-white pattern">
        <div class="auth-form-light p-5 pattern">
        <h2>{{ trans('main.resetPassword') }}</h2>
        <h4 class="font-weight-light card-title">{{ trans('main.welcome') }}</h4>
        <form class="pt-4" role="form" method="POST" action="{{ url('/school/password/reset') }}">
                        {{ csrf_field() }}

            <input type="hidden" name="token" value="{{ $token }}">
            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                <label>{{ trans('main.email') }}</label>
                <input type="email" class="form-control" name="email"  aria-describedby="emailHelp" placeholder="{{ trans('main.email') }}" value="{{ $email or old('email') }}" autofocus>
                <i class="mdi mdi-account"></i>
                @if ($errors->has('email'))
                    <span class="help-block text-danger">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                <label>{{ trans('main.email') }}</label>
                <input type="password" class="form-control" name="password"  aria-describedby="emailHelp" placeholder="{{ trans('main.password') }}">
                <i class="mdi mdi-account"></i>
                @if ($errors->has('password'))
                    <span class="help-block text-danger">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                <label>{{ trans('main.email') }}</label>
                <input type="password" class="form-control" name="password_confirmation"  aria-describedby="emailHelp" placeholder="{{ trans('main.password_confirmation') }}">
                <i class="mdi mdi-account"></i>
                @if ($errors->has('password_confirmation'))
                    <span class="help-block text-danger">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                @endif
            </div>
            

            <div class="mt-5">
                <input class="btn btn-block btn-primary btn-lg font-weight-medium" type="submit" value="{{ trans('main.resetPassword') }}" />
            </div>
            <div class="mt-3 text-center">
                <a href="{{ LaravelLocalization::getLocalizedUrl($val) }}" class="auth-link text-black">
                @if($val == 'ar') <i class="flag-icon flag-icon-ae"></i> @else <i class="flag-icon flag-icon-gb"></i> @endif
                {{ trans('main.currentLang') }}</a>
            </div>

            </form>                  
        </form>
        </div>
    </div>
    <div class="col-lg-6 register-half-bg d-flex flex-row">
        <p class="  font-weight-medium text-center flex-grow align-self-end">{{ trans('main.Copyright') }}</p>
    </div>
</div>
@endsection
