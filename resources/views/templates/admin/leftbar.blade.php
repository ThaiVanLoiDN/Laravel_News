<aside class="main-sidebar">

  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">

    <!-- Sidebar user panel (optional) -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="{{$imageUrl}}/<?php echo (Auth::user()->picture == '') ? 'avatar.png' : Auth::user()->picture ?>" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>{{ Auth::user()->fullname }}</p>
        <!-- Status -->
        <a><i class="fa fa-circle text-success"></i> 

          <?php  
          switch (Auth::user()->capbac) {
            case '4':
            $capbac = 'Admin';
            break;
            case '3':
            $capbac = 'Smod';
            break;
            case '2':
            $capbac = 'Mod';
            break;
            case '1':
            $capbac = 'Trial Mod';
            break;
            case '0':
            $capbac = 'Mem';
            break;
            default:
            $capbac = 'Khác';
            break;
          }
          echo $capbac;
          ?>

        </a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <ul class="sidebar-menu">
      <!-- Optionally, you can add icons to the links -->
      <li class="{{ Request::is('qtri') ? 'active' : '' }}">
        <a href="{{route('admin.index.index')}}"><i class="fa fa-dashboard"></i>Trang quản trị</a></li>

      <li class="{{ Request::is('qtri/news*') ? 'active' : '' }}">
        <a href="{{route('admin.news.index')}}"><i class="fa fa-file-o"></i>Bài viết</a></li>

      @if(Auth::user()->capbac == 4 || Auth::user()->capbac == 3 || Auth::user()->capbac == 1)
      <li class="{{ Request::is('qtri/cats*') ? 'active' : '' }}"><a href="{{route('admin.cats.index')}}"><i class="fa fa-folder-o"></i>Chuyên mục</a></li>
      @endif

      @if(Auth::user()->capbac == 4 || Auth::user()->capbac == 3 || Auth::user()->capbac == 1)
      <li class="{{ Request::is('qtri/contacts*') ? 'active' : '' }}"><a href="{{route('admin.contacts.index')}}"><i class="fa fa-envelope-o" aria-hidden="true"></i><span>Liên hệ</span></a></li>
      @endif

      <li class="{{ Request::is('qtri/comments*') ? 'active' : '' }}"><a href="{{route('admin.comments.index')}}"><i class="fa fa-comment-o" aria-hidden="true"></i><span>Bình luận</span></a></li>

      @if(Auth::user()->capbac == 4 || Auth::user()->capbac == 1)
      <li class="{{ Request::is('qtri/users*') ? 'active' : '' }}"><a href="{{route('admin.users.index')}}"><i class="fa fa-user"></i>Quản trị viên</a></li>
      @endif
      
      @if(Auth::user()->capbac == 4 || Auth::user()->capbac == 1)
      <li class="{{ Request::is('qtri/setting*') ? 'active' : '' }}"><a href="{{route('admin.setting.index')}}"><i class="fa fa-cog" aria-hidden="true"></i><span>Cài đặt</span></a></li>
      @endif
    </ul>
    <!-- /.sidebar-menu -->
  </section>
  <!-- /.sidebar -->
</aside>

