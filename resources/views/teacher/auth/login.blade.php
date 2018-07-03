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
        <h2>{{ trans('main.login') }}</h2>
        <h4 class="font-weight-light card-title">{{ trans('main.welcome') }}</h4>
        @if ($errors->has('message'))
            <ul>
                <li class="text-danger">{{ $errors->first('message') }}</li>
            </ul>
        @endif
        <form class="pt-4" role="form" method="POST" action="/{{ $lang }}/teacher/login">
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
            <div class="mt-3 text-center">
                <a href="/{{ $lang }}/teacher/password/reset" class="auth-link text-black">{{ trans('main.forgot') }}</a>
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
