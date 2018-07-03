@extends('teacher.layout.header')

@section('style')
    <link rel="stylesheet" href="{{  asset('cp/node_modules/dropify/dist/css/dropify.min.css') }}">
    <link rel="stylesheet" href="{{ asset('cp/node_modules/select2/dist/css/select2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('cp/node_modules/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('cp/node_modules/select2-bootstrap-theme/dist/select2-bootstrap.min.css') }}" />
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
                            <h4 class="card-title">{{ trans('profile.student_application_form') }}</h4>
                            <p class="card-description font-weight-bold">
                            {{ trans('profile.new_student') }}
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
                                <label for="mobile">{{ trans('profile.nationality') }}</label>
                                <input type="text" class="form-control" name="nationality" placeholder="{{ trans('profile.nationality') }}" value="{{ old('nationality') }}">
                                </div>
                                <div class="form-group">
                                <label for="address">{{ trans('profile.year_lang') }}</label>
                                <input type="number" name="year_lang" class="form-control" placeholder="{{ trans('profile.year_lang') }}" value="{{ old('year_lang') }}" />
                                </div>
                                <div class="form-group">
                                <label for="address">{{ trans('profile.dob') }}</label>
                                <input autocomplete="off" type="text" name="dob" class="form-control date-picker" placeholder="{{ trans('profile.dob') }}" value="{{ old('dob') }}" />
                                </div>
                    
                                <div class="form-group">
                                    <label>{{ trans('profile.assigned_subjects') }}</label>
                                    <select name="subjects[]" class="js-example-basic-multiple" multiple="multiple" style="width:100%">
                                    @foreach ($subjects as $subject)
                                        
                                        
                                        <option value="{{ $subject->id }}">
                                            @if ($lang == 'ar')
                                            {{ $subject->ar_name }}
                                            @elseif($lang == 'en')
                                            {{ $subject->en_name }}
                                            @endif
                                        </option> 
                                        
                                    @endforeach
                                    </select>
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
    <script src="{{ asset('cp/node_modules/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('cp/node_modules/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('cp/js/select2.js') }}"></script>
    <script type="text/javascript">
            jQuery().datepicker && $(".date-picker").datepicker({ rtl: false, orientation: "left",clearBtn:true,startView:2, autoclose: !0 }), $(document).scroll(function() { $("#form_modal2 .date-picker").datepicker("place") })
    </script>
@stop
