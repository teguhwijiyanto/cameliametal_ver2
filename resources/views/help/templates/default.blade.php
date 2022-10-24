<!DOCTYPE html>
<html lang="en">
    @include('help.templates.partials.head')
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    @include('help.templates.partials.preloader')
    @include('help.templates.partials.navbar')
    @include('help.templates.partials.sidebar')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @include('help.templates.partials.content-header')
    @yield('content')
  </div>
  <!-- /.content-wrapper -->
  @include('help.templates.partials.footer')
  @include('help.templates.partials.control-sidebar')
</div>
<!-- ./wrapper -->
    @include('help.templates.partials.scripts')

</body>
</html>
