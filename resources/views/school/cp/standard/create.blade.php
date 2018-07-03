@extends('admin.layout.header')



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
<form action="{{ $path }}/create" method="POST" >
    {{ csrf_field() }}
<div class="row">
    
        
        <div class="col-md-12 d-flex align-items-stretch grid-margin">
            <div class="row flex-grow">
                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">{{ trans('indexing.standard_application_form') }}</h4>
                            <p class="card-description font-weight-bold">
                            {{ trans('indexing.new_standard') }}
                            </p>
                                <div class="form-group">
                                <label for="name">{{ trans('indexing.section') }}</label>
                                <select name="sub_subject_id" class="form-control">
                                    
                                    @foreach ($s_subjects as $s_subject)
                                        <option value="{{ $s_subject->id }}">{{ $s_subject->ar_name }}</option>
                                    @endforeach
                                    
                                </select>
                                </div>
                                
                                <div class="form-group">
                                <label for="address">{{ trans('indexing.standard') }}</label>
                                <textarea class="form-control" name="standard">{{ old('standard') }}</textarea>
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
