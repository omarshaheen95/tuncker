@extends('teacher.layout.header')

@section('style')
    <link rel="stylesheet" href="{{ asset('cp/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('cp/node_modules/jquery-toast-plugin/dist/jquery.toast.min.css') }}">
    <style>
      .font-lg{
            font-size: 1.1rem;
        }
    </style>
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
    <div class="row">
      <div class="col-12">
        <div class="table-responsive">
          <table class="table table-hover table-bordered order-listing">
            <thead>
              <tr>
                  <th class="text-center">{{ trans('indexing.standards') }}  </th>
                
                @foreach ($students as $std)
                
                @if ($lang == 'ar')
                  <th width="120" class="text-center">{{ $std->ar_name }}</th>
                @elseif($lang == 'en')
                  <th width="120" class="text-center"><p >{{ $std->en_name }}</p></th>
                @endif
                
                  
                @endforeach
                
                
              </tr>
            </thead>
            <tbody>
             
                @foreach ($standards as $standard)
                <tr>
                <td width="250" class="text-center">{{ $standard->standard }}</td>
                  @foreach ($students as $std)
                
                    @php
                      $students_standard = $standard->getStandardStudent($standard->id,$std->id);
                    @endphp

                    @if ($students_standard->e_status == 1)
                      <td class="text-center" data-toggle="tooltip" data-placement="bottom" title="Next Step U">
                        <span id="status" data-id="{{  $students_standard->id  }}" data-student="{{  $std->id  }}" data-step="E" class="font-weight-bold font-lg margin-right-10 status"><i class="fa fa-2x fa-star text-primary"></i> E</span>
                      </td>
                    @elseif($students_standard->m_status == 1)
                      <td class="text-center" data-toggle="tooltip" data-placement="bottom" title="Next Step E">
                        <span id="status" data-id="{{  $students_standard->id  }}" data-student="{{  $std->id  }}" data-step="M" class="font-weight-bold font-lg margin-right-10 status"><i class="fa fa-2x fa-star text-success"></i> M</span>
                      </td>
                    @elseif($students_standard->a_status == 1)
                      <td class="text-center" data-toggle="tooltip" data-placement="bottom" title="Next Step M">
                        <span id="status" data-id="{{  $students_standard->id  }}" data-student="{{  $std->id  }}" data-step="A" class="font-weight-bold font-lg margin-right-10 status"><i class="fa fa-2x fa-star text-warning"></i> A</span>
                      </td>
                    @elseif($students_standard->t_status == 1)
                      <td class="text-center" data-toggle="tooltip" data-placement="bottom" title="Next Step A">
                        <span id="status" data-id="{{  $students_standard->id  }}" data-student="{{  $std->id  }}" data-step="T" class="font-weight-bold font-lg margin-right-10 status"><i class="fa fa-2x fa-star text-danger"></i> T</span>
                      </td>
                    @else
                      <td class="text-center" data-toggle="tooltip" data-placement="bottom" title="Next Step T">
                        <span id="status" data-id="{{  $students_standard->id  }}" data-student="{{  $std->id  }}" data-step="U" class="font-weight-bold font-lg margin-right-10 status"><i class="fa fa-2x fa-star-o"></i> U</span>
                      </td>
                    @endif
                    
                
                
                @endforeach
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
  <script src="{{ asset('cp/node_modules/jquery-toast-plugin/dist/jquery.toast.min.js') }}"></script>
  <script src="{{ asset('cp/js/data-table.js') }}"></script>
  <script src="{{ asset('cp/js/tooltips.js') }}"></script>
  <script type="text/javascript">
      var lang = $('meta[name="lang"]').attr('content');
      var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
      $("span[id*='status']").click(function(){
				var id = $(this).data("id");
        var student = $(this).data("student");
        var itemTihs = $(this);
        var step = $(this).data("step");
        $.ajax({
          url: '/' + lang + '/teacher/update-student-standard',
          type: 'POST',
          data: {_token: CSRF_TOKEN, standard_id:id, student_id: student, step: step},
          dataType: 'JSON',
          success: function (data) { 
                $.toast({
                    heading: data['heading'],
                    text: data['message'],
                    showHideTransition: 'slide',
                    icon: data['icon'],
                    loaderBg: data['color'],
                    position: data['position']
                });
                if(data.status == true){
                  itemTihs.parent().attr("data-original-title", data.nextStep);
                  itemTihs.data("step", data.step);
                  itemTihs.text(data.text);
                  itemTihs.prepend(data.iconTyep);
                }
                
            }
        });
			});	
      </script>
@stop

