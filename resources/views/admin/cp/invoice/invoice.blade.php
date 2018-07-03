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
  <link rel="stylesheet" href="{{ asset('cp/css/components.min.css') }}">
  <link rel="stylesheet" href="{{ asset('cp/css/custom.min.css') }}">
  <link rel="stylesheet" href="{{ asset('cp/css/plugins.min.css') }}">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <link rel="stylesheet" href="{{ asset('cp/node_modules/font-awesome/css/font-awesome.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('cp/css/invoice.css') }}">
  
  @yield('style')
  
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  
  <!-- endinject -->
  <link rel="shortcut icon" href="{{ asset('cp/images/favicon.png') }}" />
</head>
<body class="">
<div class="page">
        <div class="subpage-w">
            <div class="row">
                <div class="col-xs-6">
                    <h2 style="margin-top: 0px"><img width="70%" src="" /></h2>
                    <p>https://www.arabic-uae.com<br>
                        admin@arabic-uae.com<br>
                        The United Arab Emirates
                    </p>
                </div>
                <div class="col-xs-6 text-right">
                    <h4>INVOICE</h4>
                </div>
            </div>
            <div class="well m-t" style="margin-bottom: 50px">
                <div class="row">
                    <div class="col-xs-6">
                        <p class="h4"></p>
                        <strong>TO: {{ $BillingBill->school->en_name }}</strong>
                        <h4></h4>
                        <b>Phone: {{ $BillingBill->school->phone }}</b>
                        <h4></h4>
                        <b>Email: {{ $BillingBill->school->email }}</b>
                    </div>
                    <div class="col-xs-6 text-right">
                        
                        <h5>Delevery date: <strong>{{ $BillingBill->created_at }}</strong></h5>
                        <h5>Print date: <strong>{{ date("d/m/Y") }}</strong><h5>
                        <p class="m-t m-b">Invoice ID: <strong>{{ $BillingBill->id }}</strong></p>
                    </div>
                </div>
            </div>
            <div class="line"></div>
            <table class="table">
                <thead>
                <tr>
                    <th class="text-center">Price</th>
                    <th class="text-center">description</th>
                    <th class="text-center">Bank transfer number</th>
                    <th class="text-center">Payment Status</th>
                    <th class="text-center">Invoice Status</th>
                    <th class="text-center">Date of submission</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center">4000$</td>
                        <td class="text-center">Annual Subscription Application</td>
                        <td class="text-center">{{ $BillingBill->NORV }}</td>
                        <td class="text-center">{{ $BillingBill->isActive }}</td>
                        <td class="text-center">{{ $BillingBill->m_active }}</td>
                        <td class="text-center">{{ $BillingBill->created_at }}</td>
                    </tr>
                    
                <tr>
                    <td class="text-center"><strong> 4000$ </strong></td>
                    <td colspan="1" class="text-left no-border"><strong>Total </strong></td>
                    <td class="text-right"><strong> Active to :</strong></td>
                    <td class="text-center"><strong> {{ $BillingBill->active_to }} </strong></td>
                </tr>
                </tbody>
            </table>
            <div class="row">
                <div class="col-xs-8">
                    <p style="text-align: justify;"><i> This invoice was issued by A.B.T under the request for purchase of special levels and this invoice was issued in detail for the application.</i></p><br><br>

                    <p>Recvied By: __________________ </p>
                </div>
            </div>
           
        </div>
    </div>
    
</body>

</html>
