<!DOCTYPE html>
<html lang="en">
    @include('templates.partials.head')
<body class="hold-transition sidebar-mini layout-fixed sidebar-collapse">
<div class="wrapper">
    @include('templates.partials.preloader')
    @include('templates.partials.navbar')
    @include('templates.partials.sidebar')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @include('templates.partials.content-header')
    @yield('content')
  </div>
  <!-- /.content-wrapper -->
  @include('templates.partials.footer')
  @include('templates.partials.control-sidebar')
</div>
<!-- ./wrapper -->
    @include('templates.partials.scripts')

</body>
</html>
