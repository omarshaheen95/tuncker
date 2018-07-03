<!DOCTYPE html>
<html lang="en">

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
  <!-- endinject -->
  <!-- plugin css for this page -->
  <link rel="stylesheet" href="{{ asset('cp/node_modules/font-awesome/css/font-awesome.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('cp/node_modules/jquery-bar-rating/dist/themes/fontawesome-stars.css') }}">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{ asset('cp/css/style.css') }}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{ asset('cp/images/favicon.png') }}" />

  
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper ">
      <div class="row">
        <div class="content-wrapper full-page-wrapper d-flex align-items-center auth @if (LaravelLocalization::getCurrentLocale() == 'ar')
    rtl
@endif">
          <div class="row w-100">
            <div class="col-lg-8 mx-auto">
              
              @yield('content')
              
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
