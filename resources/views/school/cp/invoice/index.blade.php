@extends('school.layout.header')

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

<div class="card">
  <div class="card-body">
    <h4 class="card-title">{{ trans('indexing.available_invoices') }}</h4>
    <div class="row">
      <div class="col-12">
        <div class="table-responsive">
          <table class="table order-listing">
            <thead>
              <tr>
                  <th class="text-center">{{ trans('indexing.status') }} </th>
                  <th class="text-center">{{ trans('indexing.trans_num') }} </th>
                  <th class="text-center">{{ trans('indexing.trans_date') }} </th>
                  <th class="text-center">{{ trans('indexing.active_date') }} </th>
                  <th class="text-center">{{ trans('indexing.settings') }}</th>
              </tr>
            </thead>
            <tbody>
            
            @foreach ($billingBills as $billingBill)
              <tr>
                    <td class="text-center">{{ $billingBill->m_active }} | {{ $billingBill->isActive }}</td>
                    <td class="text-center">{{ $billingBill->NORV }}</td>
                    <td class="text-center">{{ $billingBill->created_at }}</td>
                    <td class="text-center">{{ $billingBill->active_to }}</td>
                    <td class="text-center">
                    @if ($billingBill->accepted == 0)
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteBillingBill-{{ $billingBill->id }}" >{{ trans('error.delete') }} </button>
                    @endif
                    <a class="btn btn-primary" href="/en{{ $path }}billingBills/{{ $billingBill->id }}" target="_blank">{{ trans('error.show') }}</a>
                    </td>
              </tr>
              <div class="modal fade" id="deleteBillingBill-{{ $billingBill->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteBillingBill-{{ $billingBill->id }}" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                      <h5 class="modal-title">{{ trans('error.confirm') }}</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                      </div>
                      <form action="/{{ $lang }}/school/delete-billingBill/{{ $billingBill->id }}" method="POST">
                      <div class="modal-body">
                      
                      {{ csrf_field() }}
                          <h4>
                              {{ trans('error.confirm-delete') }} <i class="fa fa-exclamation"></i>
                          </h4>
                      
                      </div>
                      <div class="modal-footer">
                      <button type="submit" class="btn btn-success">{{ trans('error.delete') }}</button>
                      <button type="button" class="btn btn-light" data-dismiss="modal">{{ trans('error.cancel') }}</button>
                      </div>
                      </form>
                  </div>
                  </div>
              </div>
              
          @endforeach
            </tbody>
          </table>                    
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
