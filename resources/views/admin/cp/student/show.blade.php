@extends('admin.layout.header')

@section('style')
    <link rel="stylesheet" href="{{ asset('cp/node_modules/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('cp/node_modules/select2/dist/css/select2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('cp/node_modules/select2-bootstrap-theme/dist/select2-bootstrap.min.css') }}" />
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
<div class="row user-profile">
    <div class="col-lg-4 side-left d-flex align-items-stretch">
        <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
            <div class="card-body avatar">
                <h4 class="card-title">{{ trans('profile.info') }}</h4>
                <img src="{{ asset('cp/images/profile') }}/{{ $student->image }}" alt="">
                <p class="name">
                    @if ($lang == 'ar')
                      {{ $student->ar_name }}
                    @elseif($lang == 'en')
                        {{ $student->en_name }}
                    @endif
                </p>
                <p class="designation">-  {{ trans('profile.student') }}  -</p>
                <a class="d-block text-center text-dark" href="#">{{ $student->phone }}</a>
                @if ($lang == 'ar')
                <span class="d-block text-center text-dark mt-2">{{ $student->school->ar_name }}</span>
                <span class="d-block text-center text-dark mt-2">{{ $student->teacher->ar_name }}</span>
                @elseif($lang == 'en')
                <span class="d-block text-center text-dark mt-2">{{ $student->school->en_name }}</span>
                <span class="d-block text-center text-dark mt-2">{{ $student->teacher->ar_name }}</span>
                @endif   
                <span class="d-block text-center text-dark mt-2">{{ trans('profile.dob') }} : {{ $student->dob }}</span>
            </div>
            </div>
        </div>
        <div class="col-12 stretch-card">
            <div class="card">
            <div class="card-body overview">
                
                <div class="wrapper about-user">
                <h4 class="card-title mt-4 mb-3">{{ trans('profile.about') }}</h4>
                
                <span class="d-block text-center text-dark mt-2">{{ trans('profile.nationality') }} : {{ $student->nationality }}</span>
                <span class="d-block text-center text-dark mt-2">{{ trans('profile.year_lang') }} : {{ $student->year_lang }}</span>
                
                </div>
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
                <a class="nav-link" id="avatar-tab" data-toggle="tab" href="#avatar" role="tab" aria-controls="avatar" aria-selected="false">{{ trans('profile.avatar') }}</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" id="subjects-tab" data-toggle="tab" href="#subjects" role="tab" aria-controls="subjects" aria-selected="false">{{ trans('profile.assigned_subjects') }}</a>
                </li>
                
            </ul>
            </div>
            <div class="wrapper">
            <hr>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade active show" id="info" role="tabpanel" aria-labelledby="info">
                <form action="{{ $path }}update-information-student/{{ $student->id }}" method="POST">
                {{ csrf_field() }}
                
                    
                    <div class="form-group">
                    <label for="name">{{ trans('profile.ar_name') }}</label>
                    <input type="text" class="form-control" name="ar_name" placeholder="{{ trans('profile.ar_name') }}" value="{{ $student->ar_name }}">
                    </div>
                    <div class="form-group">
                    <label for="name">{{ trans('profile.en_name') }}</label>
                    <input type="text" class="form-control" name="en_name" placeholder="{{ trans('profile.en_name') }}" value="{{ $student->en_name }}">
                    </div>
                    
                    <div class="form-group">
                    <label for="mobile">{{ trans('profile.nationality') }}</label>
                    <input type="text" class="form-control" name="nationality" placeholder="{{ trans('profile.nationality') }}" value="{{ $student->nationality }}">
                    </div>
                    <div class="form-group">
                    <label for="address">{{ trans('profile.year_lang') }}</label>
                    <input type="text" name="year_lang" class="form-control" placeholder="{{ trans('profile.year_lang') }}" value="{{ $student->year_lang }}" />
                    </div>
                    <div class="form-group">
                    <label for="address">{{ trans('profile.dob') }}</label>
                    <input type="text" autocomplete="off" name="dob" class="form-control date-picker" placeholder="{{ trans('profile.dob') }}" value="{{ $student->dob }}" />
                    </div>
                    <div class="form-group">
                    <label for="address">{{ trans('profile.school') }}</label>
                    <select id="schools" name="school_id" class="form-control">
                    <option>{{ trans('profile.school') }}</option>
                    
                    @foreach ($schools as $school)
                        
                        @if ($school->id == $student->school_id)
                            <option selected value="{{ $school->id }}">{{ $school->ar_name }}</option>
                        @else
                            <option value="{{ $school->id }}">{{ $school->ar_name }}</option>
                        @endif
                        
                    @endforeach
                    
                    </select>
                    </div>
                    <div class="form-group">
                    <label for="address">{{ trans('profile.teacher') }}</label>
                    <select id="teachers" name="teacher_id" class="form-control">
                    <option>{{ trans('profile.school') }}</option>
                    @foreach ($teachers as $teacher)
                    @if ($teacher->id == $student->teacher_id)
                        <option selected value="{{ $teacher->id }}">{{ $teacher->ar_name }}</option>
                    @else
                        <option value="{{ $teacher->id }}">{{ $teacher->ar_name }}</option>
                    @endif
                    @endforeach
                    </select>
                    </div>
                    <div class="form-group mt-5">
                    <button type="submit" class="btn btn-success mr-2">{{ trans('profile.update') }}</button>
                    </div>
                </form>
                </div>
                <!-- tab content ends -->
                <div class="tab-pane fade" id="avatar" role="tabpanel" aria-labelledby="avatar-tab">
                <div class="wrapper mb-5 mt-4">
                    <span class="badge badge-warning  ">{{ trans('profile.note') }} : </span>
                    <p class="d-inline ml-3 text-muted">{{ trans('profile.p_note') }} .</p>
                </div>
                <form action="{{ $path }}update-image-student/{{ $student->id }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                    <div class="form-group">
                      <label>{{ trans('profile.avatar') }}</label>
                      <input type="file" name="image" class="file-upload-default">
                      <div class="input-group col-xs-12">
                        <input type="text" disabled="" class="form-control file-upload-info" placeholder="Upload Image">
                        <div class="input-group-prepend">
                          <button class="file-upload-browse btn btn-info" type="button">Upload</button>                          
                        </div>
                      </div>
                    </div>
                    <div class="form-group mt-5">
                    <button type="submit" class="btn btn-success mr-2">{{ trans('profile.update') }}</button>
                    </div>
                </form>
                </div>
                <!-- tab content ends -->
                <div class="tab-pane fade" id="subjects" role="tabpanel" aria-labelledby="subjects-tab">
                <div class="wrapper mb-5 mt-4">
                    <span class="badge badge-warning  ">{{ trans('profile.note') }} : </span>
                    <p class="d-inline ml-3 text-muted">{{ trans('profile.s_note') }} .</p>
                </div>
                <form action="{{ $path }}update-subjects-student/{{ $student->id }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                    <div class="form-group">
                        <label>{{ trans('profile.assigned_subjects') }}</label>
                        <select name="subjects[]" class="js-example-basic-multiple" multiple="multiple" style="width:100%">
                          @foreach ($subjects as $subject)
                              
                            @if ($s_s->search($subject->id) !== false)
                            <option value="{{ $subject->id }}" selected>
                                @if ($lang == 'ar')
                                {{ $subject->ar_name }}
                                @elseif($lang == 'en')
                                {{ $subject->en_name }}
                                @endif
                            </option>
                            @else
                            <option value="{{ $subject->id }}">
                                @if ($lang == 'ar')
                                {{ $subject->ar_name }}
                                @elseif($lang == 'en')
                                {{ $subject->en_name }}
                                @endif
                            </option> 
                              @endif
                              
                          @endforeach
                        </select>
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


@section('script')
    <script src="{{ asset('cp/js/file-upload.js') }}"></script>
    <script src="{{ asset('cp/node_modules/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('cp/node_modules/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('cp/js/select2.js') }}"></script>

    <script type="text/javascript">
            jQuery().datepicker && $(".date-picker").datepicker({ rtl: false, orientation: "left",clearBtn:true,startView:2, autoclose: !0 }), $(document).scroll(function() { $("#form_modal2 .date-picker").datepicker("place") })
    </script>
    <script type="text/javascript">
            $(document).on('change', '#schools', function(){  
                
                selectValue = $('#schools').val();
                console.log(selectValue);
                $.ajax({
                    type: "GET",
                    url: '/admin/get_teacher_school/'+ selectValue,
                    data: [],
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function( msg ) {
                        if(msg.success == true){
                            $('#teachers').empty();
                            $.each(msg.teachers, function (i, teacher) {
                                $('#teachers').append($('<option>', { 
                                    value: teacher.id,
                                    text : teacher.ar_name 
                                }));
                            });
                        }
                    }
                });
            });
    </script>
@stop
