@extends('school.layout.header')

@section('style')
<link rel="stylesheet" href="{{ asset('cp/node_modules/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('cp/node_modules/bootstrap-daterangepicker/daterangepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('cp/node_modules/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}">
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
<br/>
<br/>
<div class="row">
    
    <div class="col-md-12 d-flex align-items-stretch grid-margin">
        <div class="row flex-grow">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ trans('error.student_report') }}</h4>
                        <p class="card-description">
                        {{ trans('subject.available_subjects') }}
                        </p>
                        <form class="forms-sample" action="{{ $path }}student/{{ $student->id }}/report">
                        <div class="form-group">
                            <div class="row">
                                
                                @foreach ($subjects as $subject)
                                    <div class="col-md-6">
                                        
                                        @foreach ($subject as $sub)
                                            <div class="form-check form-check-flat">
                                                <label class="form-check-label">
                                                <input name="subjects[]" value="{{ $sub->id }}" type="checkbox" class="form-check-input">
                                                @if ($lang == 'ar')
                                                {{ $sub->ar_name }}
                                                @elseif($lang == 'en')
                                                    {{ $sub->en_name }}
                                                @endif
                                                <i class="input-helper"></i></label>
                                            </div>
                                        @endforeach
                                        
                                    </div>
                                @endforeach
                                
                            </div>
                        </div>
                        <div class="form-group ">
                            <label class="control-label col-md-3">{{ trans('profile.search_range') }}</label>
                            <div class="col-md-4">
                                <div id="reportrange" class="btn default">
                                    <i class="fa fa-calendar"></i> &nbsp;
                                    <span> </span>
                                    <b class="fa fa-angle-down"></b>
                                </div>
                            </div>
                            <input type="hidden" name="startDate" id="startDate" />
                            <input type="hidden" name="endDate" id="endDate" />
                        </div>
                        <!--<div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address">{{ trans('profile.date_from') }}</label>
                                        <input type="text" autocomplete="off" name="date_from" class="form-control date-picker" placeholder="{{ trans('profile.date_from') }}" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address">{{ trans('profile.date_to') }}</label>
                                        <input type="text" autocomplete="off" name="date_to" class="form-control date-picker" placeholder="{{ trans('profile.date_to') }}" />
                                    </div>
                                </div>
                            </div>
                        </div>-->
                        <button type="submit" class="btn btn-success mr-2">{{ trans('profile.search') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        
@endsection


@section('script')
<script src="{{ asset('cp/js/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('cp/node_modules/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('cp/node_modules/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>
<script src="{{ asset('cp/node_modules/bootstrap-daterangepicker/daterangepicker.min.js') }}"></script>

<script type="text/javascript">
var startDate;
var endDate;
            jQuery().datepicker && $(".date-picker").datepicker({ rtl: false,clearBtn:true,startView:2, orientation: "left", autoclose: !0 }), $(document).scroll(function() { $("#form_modal2 .date-picker").datepicker("place") })
            $('#reportrange').daterangepicker({
                
                @if ($lang == 'ar')
                opens: 'left' ,
                @elseif($lang == 'en')
                opens: 'rgith' ,
                @endif
                startDate: moment().subtract('days', 29),
                endDate: moment(),
                //minDate: '01/01/2012',
                maxDate: moment(),
                dateLimit: {
                    days: 60
                },
                showDropdowns: true,
                showWeekNumbers: true,
                timePicker: false,
                timePickerIncrement: 1,
                timePicker12Hour: true,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
                    'Last 7 Days': [moment().subtract('days', 6), moment()],
                    'Last 30 Days': [moment().subtract('days', 29), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
                },
                buttonClasses: ['btn'],
                applyClass: 'btn-success',
                cancelClass: 'default',
                format: 'DD/MM/YYYY',
                separator: ' to ',
                locale: {
                    applyLabel: 'Apply',
                    fromLabel: 'From',
                    toLabel: 'To',
                    customRangeLabel: 'Custom Range',
                    daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
                    monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                    firstDay: 1
                }
            },
            function (start, end) {
                startDate = start;
                endDate = end;
                $('#startDate').val(start.format('D-MMMM-YYYY') );
                $('#endDate').val(end.format('D-MMMM-YYYY') );
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            }
        );
        //Set the initial state of the picker label
        $('#reportrange span').html(moment().subtract('days', 29).format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
    
</script>
    
@stop