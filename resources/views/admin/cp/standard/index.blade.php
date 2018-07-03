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

<div class="card">
  <div class="card-body">
    <h4 class="card-title">{{ trans('indexing.standards') }}</h4>
    <h5><a href="/admin/standard/create"><i class="icon-plus icon-menu"></i>معيار جديد</a></h5>
    <div class="row">
      <div class="col-12">
        <div class="table-responsive">
          <table class="table order-listing">
            <thead>
              <tr>
                  <th class="text-center">{{ trans('indexing.standard') }} </th>
                  <th class="text-center">{{ trans('indexing.section') }} </th>
                  <th class="text-center">{{ trans('indexing.settings') }}</th>
              </tr>
            </thead>
            <tbody>
            
            @foreach ($standards as $standard)
              <tr>
                  @if ($lang == 'ar')
                    <td class="text-center">{{ $standard->standard }}</td>
                    
                    <td class="text-center">{{ $standard->sub_subject->ar_name }}</td>
                  @elseif($lang == 'en')
                    <td class="text-center">{{ $standard->standard }}</td>
                    
                    <td class="text-center">{{ $standard->sub_subject->en_name }}</td>
                  @endif
                  
                  <td class="text-center"><a class="btn btn-primary" href="{{ $path }}/{{ $standard->id }}" target="_blank">{{ trans('error.show') }}</a> | <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteStandard-{{ $standard->id }}" >{{ trans('error.delete') }} </button></td>
              </tr>
              <div class="modal fade" id="deleteStandard-{{ $standard->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteStandard-{{ $standard->id }}" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                      <h5 class="modal-title">{{ trans('error.confirm') }}</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                      </div>
                      <form action="/admin/delete-standard/{{ $standard->id }}" method="POST">
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
