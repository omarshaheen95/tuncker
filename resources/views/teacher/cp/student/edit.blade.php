@extends('admin.layout.header')

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

<div class="row">
    <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
        <div class="card-body">
            <h4 class="card-title d-flex">الصورة الشخصية
            <small class="mr-auto align-self-end">
                <span class="font-weight-light">لا تزيد الصورة عن 1 MB</a>
            </small>
            </h4>
            <input type="file" class="dropify" />
        </div>
        </div>
    </div>
    <div class="col-md-8 d-flex align-items-stretch grid-margin">
        <div class="row flex-grow">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Default form</h4>
                        <p class="card-description">
                        Basic form layout
                        </p>
                        <form class="forms-sample">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                        </div>
                        <button type="submit" class="btn btn-success mr-2">Submit</button>
                        <button class="btn btn-light">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        
@endsection


@section('script')
<script src="{{ asset('cp/node_modules/dropify/dist/js/dropify.min.js') }}"></script>
<script src="{{ asset('cp/js/dropify.js') }}"></script>
@stop
