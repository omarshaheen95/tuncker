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
<div class="row user-profile">
    <div class="col-lg-4 side-left d-flex align-items-stretch">
        <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
            <div class="card-body avatar">
                <h4 class="card-title">{{ trans('profile.info') }}</h4>
                <img src="{{ asset('cp/images/profile') }}/{{ $teacher->image }}" alt="">
                <p class="name">
                    @if ($lang == 'ar')
                      {{ $teacher->ar_name }}
                    @elseif($lang == 'en')
                        {{ $teacher->en_name }}
                    @endif
                </p>
                <p class="designation">-  {{ trans('main.teacher') }}  -</p>
                <a class="d-block text-center text-dark" href="#">{{ $teacher->email }}</a>
                <a class="d-block text-center text-dark" href="#">{{ $teacher->phone }}</a>
                
                    
                @if ($teacher->active ==1)
                <span class="d-block text-center text-success">
                    {{ trans('error.active') }}
                </span>
                <form action="{{ $path }}d-e-teacher/{{ $teacher->id }}" method="POST">
                {{ csrf_field() }}
                    <div class="form-group mt-3 text-center">
                    <button type="submit" class="btn btn-danger">{{ trans('error.disable') }}</button>
                    </div>
                </form>
                @else
                <span class="d-block text-center text-danger">
                    {{ trans('error.disabled') }}
                </span>
                <form action="{{ $path }}d-e-teacher/{{ $teacher->id }}" method="POST">
                {{ csrf_field() }}
                    <div class="form-group mt-3 text-center">
                    <button type="submit" class="btn btn-success">{{ trans('error.enable') }}</button>
                    </div>
                </form>
                @endif
                    
                
            </div>
            </div>
        </div>
        <div class="col-12 stretch-card">
            <div class="card">
            <div class="card-body overview">
                <ul class="achivements">
                <li><p>{{ $teacher->count_students }}</p><p>{{ trans('profile.students') }}</p></li>
                </ul>
                <div class="wrapper about-user">
                <h4 class="card-title mt-4 mb-3">{{ trans('profile.about') }}</h4>
                <p>
                    @if ($lang == 'ar')
                      {{ $teacher->ar_description }}
                    @elseif($lang == 'en')
                        {{ $teacher->en_description }}
                    @endif
                </p>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
    <div class="col-lg-8 side-right stretch-card">
        <div class="card">
        <div class="card-body">
            <div class="wrapper d-block d-sm-flex align-items-center justify-content-between">
            <h4 class="card-title mb-0">{{ trans('profile.details') }}</h4>
            <ul class="nav nav-tabs tab-solid tab-solid-primary mb-0" id="myTab" role="tablist">
                <li class="nav-item">
                <a class="nav-link active show" id="info-tab" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-expanded="true" aria-selected="true">{{ trans('profile.info') }}</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" id="avatar-tab" data-toggle="tab" href="#avatar" role="tab" aria-controls="avatar" aria-selected="false">{{ trans('profile.avatar') }}</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" id="security-tab" data-toggle="tab" href="#security" role="tab" aria-controls="security" aria-selected="false">{{ trans('profile.security') }}</a>
                </li>
            </ul>
            </div>
            <div class="wrapper">
            <hr>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade active show" id="info" role="tabpanel" aria-labelledby="info">
                <form action="{{ $path }}update-information-teacher/{{ $teacher->id }}" method="POST">
                {{ csrf_field() }}
                    <div class="form-group">
                    <label for="name">{{ trans('profile.ar_name') }}</label>
                    <input type="text" class="form-control" name="ar_name" placeholder="Change user name" value="{{ $teacher->ar_name }}">
                    </div>
                    <div class="form-group">
                    <label for="name">{{ trans('profile.en_name') }}</label>
                    <input type="text" class="form-control" name="en_name" placeholder="Change user name" value="{{ $teacher->en_name }}">
                    </div>
                    <div class="form-group">
                    <label for="email">{{ trans('profile.email') }}</label>
                    <input type="email" class="form-control" name="email" placeholder="Change email address" value="{{ $teacher->email }}">
                    </div>
                    <div class="form-group">
                    <label for="mobile">{{ trans('profile.mobile_number') }}</label>
                    <input type="text" class="form-control" name="phone" placeholder="Change mobile number" value="{{ $teacher->phone }}">
                    </div>
                    <div class="form-group">
                    <label for="address">{{ trans('profile.ar_address') }}</label>
                    <input type="text" name="ar_address" class="form-control" placeholder="Change address" value="{{ $teacher->ar_address }}" />
                    </div>
                    <div class="form-group">
                    <label for="address">{{ trans('profile.en_address') }}</label>
                    <input type="text" name="en_address" class="form-control" placeholder="Change address" value="{{ $teacher->en_address }}" />
                    </div>
                    <div class="form-group">
                    <label for="address">{{ trans('profile.ar_description') }}</label>
                    <textarea name="ar_description" rows="6" class="form-control" placeholder="Change address">{{ $teacher->ar_description }}</textarea>
                    </div>
                    <div class="form-group">
                    <label for="address">{{ trans('profile.en_description') }}</label>
                    <textarea name="en_description" rows="6" class="form-control" placeholder="Change address">{{ $teacher->en_description }}</textarea>
                    </div>
                    <div class="form-group mt-5">
                    <button type="submit" class="btn btn-success mr-2">{{ trans('profile.update') }}</button>
                    </div>
                </form>
                </div><!-- tab content ends -->
                <div class="tab-pane fade" id="avatar" role="tabpanel" aria-labelledby="avatar-tab">
                <div class="wrapper mb-5 mt-4">
                    <span class="badge badge-warning  ">{{ trans('profile.note') }} : </span>
                    <p class="d-inline ml-3 text-muted">{{ trans('profile.p_note') }} .</p>
                </div>
                <form action="{{ $path }}update-image-teacher/{{ $teacher->id }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                    <div class="form-group">
                      <label>{{ trans('profile.avatar') }}</label>
                      <input type="file" name="image" class="file-upload-default">
                      <div class="input-group col-xs-12">
                        <input type="text" disabled="" class="form-control file-upload-info" placeholder="Upload Image">
                        <div class="input-group-prepend">
                          <button class="file-upload-browse btn btn-info" type="button">Upload</button>                          
                        </div>
                      </div>
                    </div>
                    <div class="form-group mt-5">
                    <button type="submit" class="btn btn-success mr-2">{{ trans('profile.update') }}</button>
                    </div>
                </form>
                </div>
                <div class="tab-pane fade" id="security" role="tabpanel" aria-labelledby="security-tab">
                <form action="{{ $path }}update-password-teacher/{{ $teacher->id }}" method="POST">
                {{ csrf_field() }}
                    
                    <div class="form-group">
                    <input type="password" class="form-control" name="new-password" placeholder="{{ trans('profile.new_password') }}">
                    </div>
                    <div class="form-group mt-5">
                    <button type="submit" class="btn btn-success mr-2">{{ trans('profile.update') }}</button>
                    </div>
                </form>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection


@section('script')
    <script src="{{ asset('cp/js/file-upload.js') }}"></script>
@stop
