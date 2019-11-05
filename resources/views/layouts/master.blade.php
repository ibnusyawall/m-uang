<!--

=========================================================
* Argon Dashboard - v1.1.0
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-dashboard
* Copyright 2019 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://github.com/creativetimofficial/argon-dashboard/blob/master/LICENSE.md)

* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. -->
<!DOCTYPE html>
<html lang="en">

<head>
  @include('layouts.css')
</head>

<body class="">
  @include('layouts.sidenav')
  <div class="main-content">
    <!-- Navbar -->
    @include('layouts.top_bar')
    <!-- End Navbar -->
    <!-- Header -->
    <div class="header bg-gradient-orange pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          <!-- Card stats -->
          @yield('content')
        </div>
      </div>
    </div>
    
  </div>
  <!--   Core   -->
  @include('layouts.js')

  @yield('script')
</body>

</html>