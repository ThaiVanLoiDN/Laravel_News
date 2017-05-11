@include('templates.admin.header')
  @include('templates.admin.menu')
  @include('templates.admin.leftbar')

  <div class="content-wrapper" style="min-height: 100px !important;">
    <section class="content-header">
      <h1>
        Liên hệ
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('admin.index.index')}}"><i class="fa fa-dashboard"></i>Trang chủ</a></li>
        <li class="active">Liên hệ</a></li>
      </ol>
    </section>

    <section class="content">
      <div class="row">
        @include('templates.admin.leftcontact')  
        @yield('main')

      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
    </div>
@include('templates.admin.footer')  