<!DOCTYPE html>
<html lang="en">
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
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Victory Admin</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{ asset('cp/node_modules/mdi/css/materialdesignicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('cp/node_modules/simple-line-icons/css/simple-line-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('cp/node_modules/flag-icon-css/css/flag-icon.min.css') }}">
  <link rel="stylesheet" href="{{ asset('cp/node_modules/perfect-scrollbar/dist/css/perfect-scrollbar.min.css') }}">
  <link rel="stylesheet" href="{{ asset('cp/node_modules/font-awesome/css/font-awesome.min.css') }}" />
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{ asset('cp/css/style.css') }}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{ asset('cp/images/favicon.png') }}" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper">
      <div class="row">
        <div class="content-wrapper full-page-wrapper d-flex  auth lock-full-bg @if (LaravelLocalization::getCurrentLocale() == 'ar') rtl @endif">
          <div class="row w-100">
            <div class="col-lg-3">
              <div class="auth-form-transparent text-left p-5 text-center">
                  
                  <div class="mt-0">
                    <a class="btn btn-block btn-success btn-lg font-weight-medium" style="bold;font-size:18px;" href="{{  url('/school/login')}}"><i class="fa fa-institution"></i> {{ trans('main.school_login') }}</a>
                  </div>
                  

                  <div class="mt-5">
                    <a class="btn btn-block btn-success btn-lg font-weight-medium" style="bold;font-size:18px;" href="{{  url('/teacher/login')}}"> <i class="fa fa-user-o"></i> {{ trans('main.teacher_login') }}</a>
                  </div>
                  
              </div>
            </div>
            <div class="col-lg-5">
              <div class="auth-form-transparent text-left p-5 text-center">
                <img width="90%" src="{{ asset('cp/images/logo_report_full.png') }}" alt="profile" class="">
                  <div class="mt-3 text-center">
                    <a href="#" class="auth-link text-white" style="font-weight:  bold;font-size: 20px;">{{ trans('main.about_tracker') }}</a>
                </div>
                  
                  
              </div>
            </div>
          </div>
            <div class="main-footer" style="position: fixed;bottom:  0;">
                <div class="mt-3 text-center">
                    <p class="text-white">Copyright &copy; 2018  All rights reserved. <a href="{{ LaravelLocalization::getLocalizedUrl($val) }}" class="auth-link text-white">
                    @if($val == 'ar') <i class="flag-icon flag-icon-ae"></i> @else <i class="flag-icon flag-icon-gb"></i> @endif
                    {{ trans('main.currentLang') }}</a></p>
                </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        
      </div>
      <!-- row ends -->
      
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="{{ asset('cp/node_modules/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('cp/node_modules/popper.js/dist/umd/popper.min.js') }}"></script>
  <script src="{{ asset('cp/node_modules/bootstrap/dist/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('cp/node_modules/perfect-scrollbar/dist/js/perfect-scrollbar.jquery.min.js') }}"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="{{ asset('cp/js/off-canvas.js') }}"></script>
  <script src="{{ asset('cp/js/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('cp/js/misc.js') }}"></script>
  <script src="{{ asset('cp/js/settings.js') }}"></script>
  <script src="{{ asset('cp/js/todolist.js') }}"></script>
  <!-- endinject -->
</body>

</html>
