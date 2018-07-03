@extends('teacher.layout.header')

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
    <h4 class="card-title">{{ trans('subject.available_subjects') }}</h4>
    <div class="row">
      <div class="col-12">
        <div class="table-responsive">
          <table class="table order-listing">
            <thead>
              <tr>
                  <th class="text-center">{{ trans('indexing.name') }} </th>
                  <th class="text-center">{{ trans('indexing.section') }} </th>
                  <th class="text-center">{{ trans('indexing.students') }} </th>
                  <th class="text-center">{{ trans('indexing.standards') }} </th>
                  <th class="text-center">{{ trans('indexing.description') }} </th>
              </tr>
            </thead>
            <tbody>
            
            @foreach ($subjects as $subject)
              <tr>
                  @if ($lang == 'ar')
                    <td class="text-center">{{ $subject->ar_name }}</td>
                    <td class="text-center">{{ $subject->subject->ar_name }}</td>
                    <td class="text-center">
                    <a class="btn btn-dark" href="/{{ $lang }}/teacher/students-standards/{{ $subject->id }}">
                      <i class="icon-people"></i>
                      {{ trans('indexing.students') }}
                      </a>
                    </td>
                    <td class="text-center">
                    <a class="btn btn-primary" href="/{{ $lang }}{{ $path }}-standards/{{ $subject->id }}">
                      <i class="icon-menu"></i>
                      {{ trans('indexing.standards') }} ({{ $subject->count_standards }})
                      </a>
                    </td>
                    <td class="text-center">{{ $subject->ar_description }}</td>
                  @elseif($lang == 'en')
                    <td class="text-center">{{ $subject->en_name }}</td>
                    <td class="text-center">{{ $subject->subject->en_name }}</td>
                    <td class="text-center">
                    <a class="btn btn-dark" href="/{{ $lang }}/teacher/students-standards/{{ $subject->id }}">
                      <i class="icon-people"></i>
                      {{ trans('indexing.students') }}
                      </a>
                    </td>
                    <td class="text-center">
                    <a class="btn btn-primary" href="/{{ $lang }}{{ $path }}-standards/{{ $subject->id }}" target="_blank">
                      <i class="icon-menu"></i>
                      {{ trans('indexing.standards') }} ({{ $subject->count_standards }})
                      </a>
                      </td>
                    <td class="text-center">{{ $subject->en_description }}</td>
                  @endif
                  
              </tr>
              
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
