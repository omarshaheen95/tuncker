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
<form action="{{ $path }}update-sub-subject/{{ $subject->id }}" method="POST" >
    {{ csrf_field() }}
<div class="row">
    
        
        <div class="col-md-12 d-flex align-items-stretch grid-margin">
            <div class="row flex-grow">
                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">{{ trans('subject.subject_application_form') }}</h4>
                            <p class="card-description font-weight-bold">
                            {{ trans('subject.new_subject') }}
                            </p>
                                <div class="form-group">
                                <label for="name">المادة التابعة لها</label>
                                <select name="subject_id" class="form-control">
                                    
                                    @foreach ($subjects as $m_subject)
                                        
                                        @if ($m_subject->id == $subject->subject_id)
                                            <option selected value="{{ $m_subject->id }}">{{ $m_subject->ar_name }}</option>
                                        @else
                                            <option value="{{ $m_subject->id }}">{{ $m_subject->ar_name }}</option>
                                        @endif
                                        
                                        
                                    @endforeach
                                    
                                </select>
                                </div>
                                <div class="form-group">
                                <label for="name">{{ trans('profile.ar_name') }}</label>
                                <input type="text" class="form-control" name="ar_name" placeholder="{{ trans('profile.ar_name') }}" value="{{ $subject->ar_name }}">
                                </div>
                                <div class="form-group">
                                <label for="name">{{ trans('profile.en_name') }}</label>
                                <input type="text" class="form-control" name="en_name" placeholder="{{ trans('profile.en_name') }}" value="{{ $subject->en_name }}">
                                </div>
                                
                                <div class="form-group">
                                <label for="mobile">{{ trans('profile.ar_description') }}</label>
                                <textarea class="form-control" name="ar_description">{{ $subject->ar_description }}</textarea>
                                </div>
                                <div class="form-group">
                                <label for="address">{{ trans('profile.en_description') }}</label>
                                <textarea class="form-control" name="en_description">{{ $subject->en_description }}</textarea>
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
