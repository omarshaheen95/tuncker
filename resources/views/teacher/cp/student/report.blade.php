<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Victory Admin</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{ asset('cp/css/bootstrap.min.css') }}">
  
  <!-- endinject -->
  <!-- plugin css for this page -->
  <link rel="stylesheet" href="{{ asset('cp/node_modules/font-awesome/css/font-awesome.min.css') }}" />

    <script src="{{ asset('cp/js/highcharts.js') }}"></script>
    @if (LaravelLocalization::getCurrentLocale() == 'ar')
    <link rel="stylesheet" href="{{ asset('cp/css/bootstrap-rtl.min.css') }}">
    <link href="{{ asset('cp/css/print_ar.css') }}" rel="stylesheet" type="text/css" />
    @php
        $val = 'en';
        $lang = 'ar'
    @endphp
@elseif(LaravelLocalization::getCurrentLocale() == 'en')
<link href="{{ asset('cp/css/print.css') }}" rel="stylesheet" type="text/css" />
    @php
        $val = 'ar';
        $lang = 'en'
    @endphp
@endif
    

    <title>{{ $student->en_full_name }}</title>
    <style>
        tspan{
            font-weight: bold;
        }
        .highcharts-plot-line-label-s {
            font-weight: bold !important;
        }
        .text-warning {
            color: #F3C200 !important;
        }
        .text-success {
            color: #26C281 !important;
        }
        .text-primary {
            color: #03a9f3 !important;
        }
        .text-danger {
            color: #D91E18 !important;
        }
        
    </style>
    </head>
<body>


    <div class="page">
        <img class="logo" src="{{ asset('cp/images/logo_sm1.png') }}" />
        <div class="subpage-w">
            <div class="row" style="margin-top:250px;">
                <div class="col-xs-8 col-xs-offset-2">
                    <div class="">
                        <img width="100%" src="{{ asset('cp/images/logo_report_full.png') }}" />
                    </div>
                </div>
            </div>
            <br />
            <br />
            <br />
            <div class="row">
                <div class="col-xs-12">
                    <h1 class="text-center">{{ trans('profile.student_report') }}</h1>
                </div>
                <div class="col-xs-12">
                    <h4 class="text-center">{{ trans('profile.source') }} :<a class="text-center">https://www.arabic-uae.com</a></h4>
                    
                </div>
                <div class="col-xs-12">
                    <h4 class="text-center">{{ trans('profile.email') }} :<a class="text-center">admin@arabic-uae.com</a></h4>
                    
                </div>
                <div class="col-xs-12">
                    <h4 class="text-center">{{ trans('profile.release_date') }} : {{ date("d/m/Y") }}</h4>
                    
                </div>
            </div>
            
        </div>
        <span class="numder-page">1</span>
    </div>
    <div class="page">
        <img class="logo" src="{{ asset('cp/images/logo_sm1.png') }}" />
        <div class="subpage-w">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="thumbnail">
                        <img class="img-thumbnail" src="{{ asset('cp/images/profile') }}/{{ $student->image }}" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                     <br/>
                    <br/>
                    <table class="table table-bordered table-hover">
                    <thead>
                    @if ($lang == 'ar')
                    
                        <tr>
                            <th> {{ trans('profile.student_name') }}  </th>
                            <th class="text-center"> {{ $student->ar_name }} </th>
                        </tr>
                        <tr>
                            <th> {{ trans('profile.nationality') }} </th>
                            <th class="text-center">{{ $student->nationality }}</th>
                        </tr>
                        <tr>
                            <th> {{ trans('profile.dob') }} </th>
                            <th class="text-center">{{ $student->dob }}</th>
                        </tr>
                        <tr>
                            <th> {{ trans('profile.School') }} </th>
                            <th class="text-center">{{ $student->school->ar_name }}</th>
                        </tr>
                        
                        <tr>
                            <th> {{ trans('profile.Teacher') }} </th>
                            <th class="text-center">{{ $student->teacher->ar_name }}</th>
                        </tr>
                        <tr>
                            <th> {{ trans('profile.year_lang') }} </th>
                            <th class="text-center">{{ $student->year_lang }}</th>
                        </tr>
                        @elseif($lang == 'en')
                        <tr>
                            <th> {{ trans('profile.student_name') }} </th>
                            <th class="text-center"> {{ $student->en_name }} </th>
                        </tr>
                        <tr>
                            <th> {{ trans('profile.nationality') }} </th>
                            <th class="text-center">{{ $student->nationality }}</th>
                        </tr>
                        <tr>
                            <th> {{ trans('profile.Teacher') }} </th>
                            <th class="text-center">{{ $student->dob }}</th>
                        </tr>
                        <tr>
                            <th> {{ trans('profile.School') }} </th>
                            <th class="text-center">{{ $student->school->en_name }}</th>
                        </tr>
                        
                        <tr>
                            <th> {{ trans('profile.Teacher') }} </th>
                            <th class="text-center">{{ $student->teacher->en_name }}</th>
                        </tr>
                        <tr>
                            <th> {{ trans('profile.year_lang') }} </th>
                            <th class="text-center">{{ $student->year_lang }}</th>
                        </tr>

                        @endif
                    </thead>
                    <tbody>
                        
                        
                        </tbody>
                    </table>
                   
                    
                </div>
                
            </div>
        </div>    
        <span class="numder-page">2</span>
    </div>

    @php
        $counter = 3;
        @endphp  
    @foreach ($sub_subject_collection as $sub_subject)
        @foreach ($sub_subject['standards'] as $standards)
            
        
        
    
    
    <div class="page">
        <img class="logo" src="{{ asset('cp/images/logo_sm1.png') }}" />
        <div class="subpage-w">
        
            <div class="row">
                <h3 class="text-center red-font">
                {{ $sub_subject['sub_name'] }}
                
                <small class="red-font" > {{ trans('profile.subject_from') }} 
                {{ $sub_subject['name'] }}
                </small></h3>
            </div>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="text-center" width="20" style="font-size: 12px;">#</th>
                            <th class="" style="font-size: 12px;"> {{ trans('profile.standard') }} </th>
                            <th class="text-center" width="70" style="font-size: 12px;"> current level </th>
                            <th class="text-center" width="70" style="font-size: 12px;"> date access </th>
                            <th class="text-center" width="70" style="font-size: 12px;"> percentage  </th>
                            <th class="text-center" width="70" style="font-size: 12px;"> percentage  </th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach ($standards as $key => $standard)
                        
                        <tr>
                            <td class="text-center">{{ $key+1 }}</td>
                            <td class="" style="font-size:10px;max-width:80px">{{ $standard->standard->standard }}</td>
                            <td class="text-center" style="font-size:10px;max-width:80px">{!! $standard->status_result !!}</td>
                            <td class="text-center" style="font-size:10px;max-width:80px">{{ $standard->date_result }}</td>
                            <td class="text-center" style="font-size:10px;max-width:80px">{{ $standard->rate_school }}</td>
                            <td class="text-center" style="font-size:10px;max-width:80px">{{ $standard->rate_system }}</td>
                        </tr>
                           
                        @endforeach
                        
                        
                    </tbody>
                </table>
            
        </div>    
        <span class="numder-page">{{ $counter }}</span>
        
    </div>
    
    
          @php
        $counter ++;
        @endphp
    @endforeach
    @endforeach
    
        
        @if (count($sub_subject_collection) == 0)
            
        
        
    <div class="page">
        <img class="logo" src="{{ asset('cp/images/logo_sm.png') }}" />
        <div class="subpage-w">
        
        <div class="row">
            <h2 class="text-center">{{ trans('profile.no_standards') }}</h2>
        </div>

        </div>  
        
        <span class="numder-page">3</span>
        
    </div>
    @endif
        <!-- plugins:js -->
        <script src="{{ asset('cp/node_modules/jquery/dist/jquery.min.js') }}"></script>
        <script src="{{ asset('cp/node_modules/popper.js/dist/umd/popper.min.js') }}"></script>
        <script src="{{ asset('cp/node_modules/bootstrap/dist/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('cp/node_modules/perfect-scrollbar/dist/js/perfect-scrollbar.jquery.min.js') }}"></script>
        <!-- endinject -->
        <!-- Plugin js for this page-->
        <script src="{{ asset('cp/node_modules/jquery-bar-rating/dist/jquery.barrating.min.js') }}"></script>
        <script src="{{ asset('cp/node_modules/chart.js/dist/Chart.min.js') }}"></script>
        <script src="{{ asset('cp/node_modules/raphael/raphael.min.js') }}"></script>
        <script src="{{ asset('cp/node_modules/morris.js/morris.min.js') }}"></script>
        <script src="{{ asset('cp/node_modules/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
        <!-- End plugin js for this page-->
        <!-- inject:js -->
        <script src="{{ asset('cp/js/off-canvas.js') }}"></script>
        <script src="{{ asset('cp/js/hoverable-collapse.js') }}"></script>
        <script src="{{ asset('cp/js/misc.js') }}"></script>
        <script src="{{ asset('cp/js/settings.js') }}"></script>
        <script src="{{ asset('cp/js/todolist.js') }}"></script>
        <!-- endinject -->
        <!-- Custom js for this page-->
        <script src="{{ asset('cp/js/dashboard.js') }}"></script>
        
        <!-- END THEME LAYOUT SCRIPTS -->
        <script type="text/javascript">
        @yield('script')
        </script>
        <script type="text/javascript">
            $(document).ready (function(){
                //window.print();
            });
        </script>
        <!-- End -->
    <script type='text/javascript'>//<![CDATA[
        $(function(){
            var names_temrs = new Array();
            var colors = ['#5E738B', '#F44336', '#00c853', '#2AB4C0'];
            var data_array = new Array();
            var data_array_all = new Array();
            var full_data_array = new Array();
            var full_data_array_all = new Array();
            var full_marks = new Array();
            var ticks = [];
                for(var i=0;i<25;i++){
                ticks.push(i+1);
                }
            
            
             
            colors = ['#5E738B', '#F44336', '#00c853', '#2AB4C0', '#FFC107'];
            
            
        });
        </script>
</body>