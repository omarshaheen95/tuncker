@extends('admin.layout.header')

@section('style')
    <link rel="stylesheet" href="{{ asset('cp/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css') }}">
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
    <div class="col-12">
        <div class="card">
        <div class="card-body pt-0">
            <div class="container text-center pt-0">
            <h4 class="mb-3 mt-5">{{ trans('pricing.start_up') }}</h4>
            <p class="w-75 mx-auto mb-5">{{ trans('pricing.start_up_p') }}</p>
            <div class="row pricing-table">
                
                <div class="col-md-4 grid-margin stretch-card pricing-card margin-auto">
                <div class="card border border-success pricing-card-body">
                    <div class="text-center pricing-card-head">
                    <h3 class="text-success">{{ trans('pricing.plan') }}</h3>
                    <p>{{ trans('pricing.annual') }}</p>
                    <h1 class="font-weight-normal mb-4">$4000.0</h1>
                    </div>
                    <ul class="list-unstyled plan-features text-center">
                    <li>{{ trans('pricing.feature_1') }}</li>
                    <li>{{ trans('pricing.feature_2') }}</li>
                    <li>{{ trans('pricing.feature_3') }}</li>
                    <li>{{ trans('pricing.feature_4') }}</li>
                    <li>{{ trans('pricing.feature_5') }}</li>
                    <li></li>
                    </ul>
                    <div class="wrapper">
                    <button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#start_now" >{{ trans('pricing.start_now') }} </button>
                    </div>
                </div>
                </div>
                
            </div>
            </div>
            <h4 class="card-title">{{ trans('pricing.payment_mechanism') }}</h4>
            <p class="card-description">{{ trans('pricing.complete_payment_mechanism') }}</p>
            <div class="modal fade" id="start_now" tabindex="-1" role="dialog" aria-labelledby="start_now" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title">{{ trans('pricing.new_payment') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <form>
                    <div class="modal-body">
                    
                    {{ csrf_field() }}
                        <h5>
                            {{ trans('pricing.payment_note') }} <i class="fa fa-exclamation"></i>
                        </h5>
                        <div class="form-group">
                            <label for="name">{{ trans('pricing.NORV') }}</label>
                            <input type="text" class="form-control" name="NORV" placeholder="{{ trans('pricing.NORV') }}" value="{{ old('NORV') }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                    <button type="submit" class="btn btn-success">{{ trans('pricing.submit') }}</button>
                    <button type="button" class="btn btn-light" data-dismiss="modal">{{ trans('error.cancel') }}</button>
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
  <script src="{{ asset('cp/node_modules/datatables.net/js/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('cp/node_modules/datatables.net-bs4/js/dataTables.bootstrap4.js') }}"></script>
  <script src="{{ asset('cp/js/data-table.js') }}"></script>
@stop
