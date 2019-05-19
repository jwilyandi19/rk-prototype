

<body>

<div class="d-flex" id="wrapper">

    @isset($user)
    @include('part.sidebar')
    @endisset


    <!-- Page Content -->
    <div id="page-content-wrapper">

    @include('part.topbar')

    <div class="container-fluid">
        @yield('content')
    </div>
    </div>
  <!-- /#page-content-wrapper -->
</body>


