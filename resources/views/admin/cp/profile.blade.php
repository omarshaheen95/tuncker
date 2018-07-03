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
        <div class="row" style="width: 100%;">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
            <div class="card-body avatar">
                <h4 class="card-title">{{ trans('profile.info') }}</h4>
                <img src="{{ asset('cp/images/profile') }}/default.png" alt="">
                <p class="name">
                      {{ Auth::user()->name }}
                </p>
                <p class="designation">-  الإدارة  -</p>
                <a class="d-block text-center text-dark" href="#">{{ Auth::user()->email }}</a>
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
                <a class="nav-link" id="security-tab" data-toggle="tab" href="#security" role="tab" aria-controls="security" aria-selected="false">{{ trans('profile.security') }}</a>
                </li>
            </ul>
            </div>
            <div class="wrapper">
            <hr>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade active show" id="info" role="tabpanel" aria-labelledby="info">
                <form action="/admin/update-information" method="POST">
                {{ csrf_field() }}
                    <div class="form-group">
                    <label for="name">الإسم</label>
                    <input type="text" class="form-control" name="name" placeholder="Change user name" value="{{ Auth::user()->name }}">
                    </div>
                    <div class="form-group">
                    <label for="email">{{ trans('profile.email') }}</label>
                    <input type="email" class="form-control" name="email" placeholder="Change email address" value="{{ Auth::user()->email }}">
                    </div>
                    
                    <div class="form-group">
                    <label for="address">IBAN</label>
                    <input type="text" name="IBAN" class="form-control" placeholder="Change address" value="{{ Auth::user()->IBAN }}" />
                    </div>
                    <div class="form-group">
                    <label for="address">الهاتف</label>
                    <input type="text" name="phone" class="form-control" placeholder="Change address" value="{{ Auth::user()->phone }}" />
                    </div>
                    
                    <div class="form-group mt-5">
                    <button type="submit" class="btn btn-success mr-2">{{ trans('profile.update') }}</button>
                    </div>
                </form>
                </div><!-- tab content ends -->
                <div class="tab-pane fade" id="security" role="tabpanel" aria-labelledby="security-tab">
                <form action="/admin/update-password" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                    <label for="change-password">{{ trans('profile.change_password') }}</label>
                    <input type="password" class="form-control" name="password" placeholder="{{ trans('profile.current_password') }}">
                    </div>
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



