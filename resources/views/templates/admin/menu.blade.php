<header class="main-header">
<!-- Logo -->
  <a href="{{route('admin.index.index')}}" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
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
            ?>

    <span class="logo-mini"><b>{{ $capbac }}</b></span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>{{ $capbac }}</b></span>
  </a>

  <!-- Header Navbar -->
  <nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>
    <!-- Navbar Right Menu -->
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        @if(Auth::user()->capbac == 4 || Auth::user()->capbac == 3 || Auth::user()->capbac == 1)
        <li class="dropdown messages-menu">
          <!-- Menu toggle button -->
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-envelope-o"></i>
            <span class="label label-success">{{$count_inbox}}</span>
          </a>
          <ul class="dropdown-menu">
            <li class="header">Thư chưa đọc</li>
            <li>
              <!-- inner menu: contains the messages -->
              <ul class="menu">
                @if (count($arInbox) == 0)
                <li><!-- start message -->
                  <a>
                    <p>Không có liên hệ mới nào</p>
                  </a>
                </li>
                @else 
                @foreach ($arInbox as $key => $arIb)

                <li><!-- start message -->
                  <a href="{{ route('admin.contacts.read', $arIb['id']) }}">
                    <div class="pull-left">
                      <!-- User Image -->
                      <img src="{{$adminUrl}}/images/mail.png" class="img-circle" alt="User Image">
                    </div>
                    <!-- Message title and timestamp -->
                    <h4>
                      {{str_limit($arIb['fullname'], 20)}}
                      <small><i class="fa fa-clock-o"></i> {{date('d-M', strtotime($arIb['created_at']))}}</small>
                    </h4>
                    <!-- The message -->
                    <p>{{str_limit($arIb['title'], 30)}}</p>
                  </a>
                </li>
                @endforeach

                @endif
                <!-- end message -->
              </ul>
              <!-- /.menu -->
            </li>
            <li class="footer"><a href="{{route('admin.contacts.index')}}">Tất cả liên hệ</a></li>
          </ul>
        </li>
        @endif

        <!-- User Account Menu -->
        <li class="dropdown user user-menu">
          <!-- Menu Toggle Button -->
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <!-- The user image in the navbar-->
            <img src="{{$imageUrl}}/{{ (Auth::user()->picture == '') ? 'avatar.png' : Auth::user()->picture }}" class="user-image" alt="User Image">
            <!-- hidden-xs hides the username on small devices so only the image appears. -->
            <span class="hidden-xs">{{ Auth::user()->fullname }}</span>
          </a>
          <ul class="dropdown-menu">
            <!-- The user image in the menu -->
            <li class="user-header">
              <img src="{{$imageUrl}}/{{ (Auth::user()->picture == '') ? 'avatar.png' : Auth::user()->picture }}" class="img-circle" alt="User Image">

              <p>
                {{ Auth::user()->fullname }}
              </p>
            </li>
            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="pull-left">
                <a href="{{ route('admin.users.edit', Auth::id()) }}" class="btn btn-default btn-flat">Tài khoản</a>
              </div>
              <div class="pull-right">
                <a href="{{route('admin.auth.logout')}}" class="btn btn-default btn-flat">Đăng xuất <i class="fa fa-sign-out" aria-hidden="true"></i></a>
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>