<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  @if (LaravelLocalization::getCurrentLocale() == 'ar')
    <meta name="lang" content="ar">
@elseif(LaravelLocalization::getCurrentLocale() == 'en')
    <meta name="lang" content="en">
@endif
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Victory Admin</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{ asset('cp/node_modules/mdi/css/materialdesignicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('cp/node_modules/simple-line-icons/css/simple-line-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('cp/node_modules/flag-icon-css/css/flag-icon.min.css') }}">
  <link rel="stylesheet" href="{{ asset('cp/node_modules/perfect-scrollbar/dist/css/perfect-scrollbar.min.css') }}">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <link rel="stylesheet" href="{{ asset('cp/node_modules/font-awesome/css/font-awesome.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('cp/node_modules/jquery-bar-rating/dist/themes/fontawesome-stars.css') }}">
   @yield('style')
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{ asset('cp/css/style.css') }}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{ asset('cp/images/favicon.png') }}" />
</head>
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
<body class="@if (LaravelLocalization::getCurrentLocale() == 'ar') rtl @endif">
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row navbar-primary">
      <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
        <a class="navbar-brand brand-logo" href="index.html"><img src="{{ asset('cp/images/logo.png') }}" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="index.html"><img src="{{ asset('cp/images/logo-mini.png') }}" alt="logo"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
        
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item dropdown d-none d-lg-flex">
            <a class="nav-link dropdown-toggle" id="languageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
              @if($val == 'en') <i class="flag-icon flag-icon-ae"></i> @else <i class="flag-icon flag-icon-gb"></i> @endif
                {{ trans('main.lang') }}
            </a>
            <div class="dropdown-menu navbar-dropdown" aria-labelledby="languageDropdown">
              
              <div class="dropdown-divider"></div>
              <a class="dropdown-item font-weight-medium" href="{{ LaravelLocalization::getLocalizedUrl($val) }}">
                @if($val == 'ar') <i class="flag-icon flag-icon-ae"></i> @else <i class="flag-icon flag-icon-gb"></i> @endif
                {{ trans('main.currentLang') }}
              </a>
            </div>
          </li>
          
          <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
              <i class="icon-user mx-0"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
              <a class="dropdown-item">
                <p class="mb-0 font-weight-normal float-left">{{ trans('main.logout_settings') }}
                </p>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item" href="/{{ $lang }}/teacher/profile">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-success">
                    <i class="icon-settings mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-medium">{{ trans('main.account_settings') }}</h6>
                  <p class="font-weight-light small-text">
                     {{ trans('main.all_account_settings') }}
                  </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item" href="{{ url('/teacher/logout') }}"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                                 <form id="logout-form" action="{{ url('/teacher/logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-warning">
                    <i class="icon-lock mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-medium">{{ trans('main.logout') }}</h6>
                  <p class="font-weight-light small-text">
                  {{ trans('main.p_logout') }}
                  </p>
                </div>
              </a>
              
            </div>
          </li>
          
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="icon-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <div class="row row-offcanvas row-offcanvas-right">
        
        <!-- partial -->
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-profile">
              <div class="nav-link">
                <div class="profile-image">
                  <img src="{{ asset('cp/images/profile') }}/{{ Auth::user()->image }}" alt="image"/>
                </div>
                <div class="profile-name">
                  <p class="name">
                  
                  @if ($lang == 'ar')
                      {{ Auth::user()->ar_name }}
                  @elseif($lang == 'en')
                      {{ Auth::user()->en_name }}
                  @endif
                  
                    
                  </p>
                  <p class="designation">
                    {{ trans('main.teacher') }}
                  </p>
                </div>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/{{ $lang }}/teacher/home">
                <i class="icon-home menu-icon"></i>
                <span class="menu-title">{{ trans('main.home') }}</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/{{ $lang }}/teacher/student">
                <i class="icon-user menu-icon"></i>
                <span class="menu-title">{{ trans('main.students') }}</span>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="/{{ $lang }}/teacher/student/create">
                <i class="icon-plus menu-icon"></i>
                <span class="menu-title">{{ trans('main.new_student') }}</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/{{ $lang }}/teacher/subject">
                <i class="icon-options-vertical menu-icon"></i>
                <span class="menu-title">{{ trans('main.subjects') }}</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/{{ $lang }}/teacher/sub-subject">
                <i class="icon-options menu-icon"></i>
                <span class="menu-title">{{ trans('main.sub_subjects') }}</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/{{ $lang }}/teacher/standard">
                <i class="icon-menu menu-icon"></i>
                <span class="menu-title">{{ trans('main.standards') }}</span>
              </a>
            </li>
          </ul>
        </nav>
        <!-- partial -->
        <div class="content-wrapper">
          @if(Session::has('message'))    
            <div class="alert alert-fill-{{ Session::get('m-class') }} " role="alert">
              <i class="mdi mdi-alert-circle"></i><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong></strong> {{ Session::get('message') }}
            </div>
        @endif
            
            @if (count($errors) > 0)
                <div class="alert alert-fill-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
          @yield('content')
          
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="container-fluid clearfix">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">{{ trans('main.Copyright') }}</span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- row-offcanvas ends -->
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
   @yield('script')
  <!-- End custom js for this page-->
</body>

</html>
