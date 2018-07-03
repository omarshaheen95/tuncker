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
        <div class="auth-form-light p-5 pattern pattern">
        <h2>{{ trans('main.register') }}</h2>
        <h4 class="font-weight-light card-title">{{ trans('main.welcome') }}</h4>
        <form class="pt-4" role="form" method="POST" action="{{  url('/school/register')}}">
                        {{ csrf_field() }}
            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                <label>{{ trans('main.email') }}</label>
                <input type="email" class="form-control" name="email" value="{{ old('email') }}"  aria-describedby="emailHelp" placeholder="{{ trans('main.email') }}" value="{{ old('email') }}" autofocus>
                <i class="mdi mdi-email"></i>
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

            <div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                <label>{{ trans('main.password_confirmation') }}</label>
                <input type="password" class="form-control" name="password_confirmation"  placeholder="{{ trans('main.password_confirmation') }}">
                <i class="mdi mdi-eye"></i>
                @if ($errors->has('password_confirmation'))
                    <span class="help-block text-danger">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group {{ $errors->has('ar_name') ? ' has-error' : '' }}">
                <label>{{ trans('profile.ar_name') }}</label>
                <input type="text" class="form-control" name="ar_name" value="{{ old('ar_name') }}"  placeholder="{{ trans('profile.ar_name') }}">
                <i class="mdi mdi-account"></i>
                @if ($errors->has('ar_name'))
                    <span class="help-block text-danger">
                        <strong>{{ $errors->first('ar_name') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group {{ $errors->has('en_name') ? ' has-error' : '' }}">
                <label>{{ trans('profile.en_name') }}</label>
                <input type="text" class="form-control" name="en_name" value="{{ old('en_name') }}"  placeholder="{{ trans('profile.en_name') }}">
                <i class="mdi mdi-account"></i>
                @if ($errors->has('en_name'))
                    <span class="help-block text-danger">
                        <strong>{{ $errors->first('en_name') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group {{ $errors->has('url') ? ' has-error' : '' }}">
                <label>{{ trans('profile.website_URL') }}</label>
                <input type="text" class="form-control" name="url" value="{{ old('url') }}"  placeholder="{{ trans('profile.website_URL') }}">
                <i class="mdi mdi-link-variant"></i>
                @if ($errors->has('url'))
                    <span class="help-block text-danger">
                        <strong>{{ $errors->first('url') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group {{ $errors->has('ar_address') ? ' has-error' : '' }}">
                <label>{{ trans('profile.ar_address') }}</label>
                <input type="text" class="form-control" name="ar_address" value="{{ old('ar_address') }}"  placeholder="{{ trans('profile.ar_address') }}">
                <i class="mdi mdi-account-location"></i>
                @if ($errors->has('ar_address'))
                    <span class="help-block text-danger">
                        <strong>{{ $errors->first('ar_address') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group {{ $errors->has('en_address') ? ' has-error' : '' }}">
                <label>{{ trans('profile.en_address') }}</label>
                <input type="text" class="form-control" name="en_address" value="{{ old('en_address') }}"  placeholder="{{ trans('profile.en_address') }}">
                <i class="mdi mdi-account-location"></i>
                @if ($errors->has('en_address'))
                    <span class="help-block text-danger">
                        <strong>{{ $errors->first('en_address') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
                <label>{{ trans('profile.mobile_number') }}</label>
                <input type="text" class="form-control" name="phone" value="{{ old('phone') }}"  placeholder="{{ trans('profile.mobile_number') }}">
                <i class="mdi mdi-phone"></i>
                @if ($errors->has('phone'))
                    <span class="help-block text-danger">
                        <strong>{{ $errors->first('phone') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group {{ $errors->has('ar_delegate') ? ' has-error' : '' }}">
                <label>{{ trans('profile.ar_delegate') }}</label>
                <input type="text" class="form-control" name="ar_delegate" value="{{ old('ar_delegate') }}"  placeholder="{{ trans('profile.ar_delegate') }}">
                <i class="mdi mdi-rename-box"></i>
                @if ($errors->has('ar_delegate'))
                    <span class="help-block text-danger">
                        <strong>{{ $errors->first('ar_delegate') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group {{ $errors->has('en_delegate') ? ' has-error' : '' }}">
                <label>{{ trans('profile.en_delegate') }}</label>
                <input type="text" class="form-control" name="en_delegate" value="{{ old('en_delegate') }}"  placeholder="{{ trans('profile.en_delegate') }}">
                <i class="mdi mdi-rename-box"></i>
                @if ($errors->has('en_delegate'))
                    <span class="help-block text-danger">
                        <strong>{{ $errors->first('en_delegate') }}</strong>
                    </span>
                @endif
            </div>

            <div class="mt-5">
                <input class="btn btn-block btn-primary btn-lg font-weight-medium" type="submit" value="{{ trans('main.register') }}" />
            </div>
            <div class="mt-3 text-center">
                <a href="/{{ $lang }}/school/login" class="auth-link text-black">{{ trans('main.login') }}</a>
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
