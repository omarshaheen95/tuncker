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
              <h4 class="card-title">{{ trans('indexing.available_students') }}</h4>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table class="table order-listing">
                      <thead>
                        <tr>
                            <th class="text-center">{{ trans('indexing.student') }} </th>
                            <th class="text-center"> {{ trans('indexing.teacher') }}</th>
                            <th class="text-center">{{ trans('indexing.settings') }}</th>
                        </tr>
                      </thead>
                      <tbody>
                      
                      @foreach ($students as $student)
                        <tr>
                          @if ($lang == 'ar')
                            <td class="text-center">{{ $student->ar_name }}</td>
                            
                            <td class="text-center">{{ $student->teacher->ar_name }}</td>
                          @elseif($lang == 'en')
                            <td class="text-center">{{ $student->en_name }}</td>
                            
                            <td class="text-center">{{ $student->teacher->en_name }}</td>
                          @endif
                            <td class="text-center">
                            <a class="btn btn-success" href="/{{ $lang }}{{ $path }}/report/{{ $student->id }}" >{{ trans('error.report') }}</a> 
                            |
                            <a class="btn btn-primary" href="/{{ $lang }}{{ $path }}/{{ $student->id }}" target="_blank">{{ trans('error.show') }}</a> 
                            | 
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteStudent-{{ $student->id }}" >{{ trans('error.delete') }} </button></td>
                        </tr>
                        <div class="modal fade" id="deleteStudent-{{ $student->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteStudent-4{{ $student->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel-4">{{ trans('error.confirm') }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <form action="/{{ $lang }}/admin/delete-student/{{ $student->id }}" method="POST">
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
