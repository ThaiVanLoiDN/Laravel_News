@include('templates.admin.header')

  <!-- Main Header -->
  @include('templates.admin.menu')
  <!-- Left side column. contains the logo and sidebar -->
  <!-- Leftbar -->
  @include('templates.admin.leftbar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="min-height: 100px !important;">
  @yield('main')
    
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
@include('templates.admin.footer')  