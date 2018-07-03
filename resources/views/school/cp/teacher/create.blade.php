@extends('school.layout.header')

@section('style')
<link rel="stylesheet" href="{{  asset('cp/node_modules/dropify/dist/css/dropify.min.css') }}">
@stop

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
<form action="/{{ $lang }}{{ $path }}/create" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
<div class="row">
    
        <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
            <div class="card-body">
                <h4 class="card-title d-flex">{{ trans('profile.avatar') }}
                </h4>
                    <span class="font-weight-light">{{ trans('profile.p_note') }}</a>
                <input type="file" name="image" class="dropify" />
            </div>
            </div>
        </div>
        <div class="col-md-8 d-flex align-items-stretch grid-margin">
            <div class="row flex-grow">
                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">{{ trans('profile.teacher_application_form') }}</h4>
                            <p class="card-description font-weight-bold">
                            {{ trans('profile.new_teacher') }}
                            </p>
                            
                                <div class="form-group">
                                <label for="name">{{ trans('profile.ar_name') }}</label>
                                <input type="text" class="form-control" name="ar_name" placeholder="{{ trans('profile.ar_name') }}" value="{{ old('ar_name') }}">
                                </div>
                                <div class="form-group">
                                <label for="name">{{ trans('profile.en_name') }}</label>
                                <input type="text" class="form-control" name="en_name" placeholder="{{ trans('profile.en_name') }}" value="{{ old('en_name') }}">
                                </div>
                                <div class="form-group">
                                <label for="email">{{ trans('profile.email') }}</label>
                                <input type="email" class="form-control" name="email" placeholder="{{ trans('profile.email') }}" value="{{ old('email') }}">
                                </div>
                                <div class="form-group">
                                <label for="mobile">{{ trans('profile.mobile_number') }}</label>
                                <input type="text" class="form-control" name="phone" placeholder="{{ trans('profile.mobile_number') }}" value="{{ old('phone') }}">
                                </div>
                                <div class="form-group">
                                <label for="address">{{ trans('profile.ar_address') }}</label>
                                <input type="text" name="ar_address" class="form-control" placeholder="{{ trans('profile.ar_address') }}" value="{{ old('ar_address') }}"/>
                                </div>
                                <div class="form-group">
                                <label for="address">{{ trans('profile.en_address') }}</label>
                                <input type="text" name="en_address" class="form-control" placeholder="{{ trans('profile.en_address') }}"  value="{{ old('en_address') }}" />
                                </div>
                                <div class="form-group">
                                <label for="address">{{ trans('profile.ar_description') }}</label>
                                <textarea name="ar_description" rows="6" class="form-control" placeholder="{{ trans('profile.ar_description') }}">{{ old('ar_description') }}</textarea>
                                </div>
                                <div class="form-group">
                                <label for="address">{{ trans('profile.en_description') }}</label>
                                <textarea name="en_description" rows="6" class="form-control" placeholder="{{ trans('profile.en_description') }}">{{ old('en_description') }}</textarea>
                                </div>
                                <button type="submit" class="btn btn-success mr-2">{{ trans('profile.submit') }}</button>
                                <button class="btn btn-light">{{ trans('error.cancel') }}</button>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
</div>
  </form>      
@endsection


@section('script')
    <script src="{{ asset('cp/node_modules/dropify/dist/js/dropify.min.js') }}"></script>
    <script src="{{ asset('cp/js/dropify.js') }}"></script>
    <script src="{{ asset('cp/js/file-upload.js') }}"></script>
@stop
