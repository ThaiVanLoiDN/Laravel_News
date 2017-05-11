@extends('templates.admin.template')
@section('main')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Quản trị viên
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{route('admin.index.index')}}"><i class="fa fa-dashboard"></i>Trang chủ</a></li>
    <li class="active">Quản trị viên</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      @if(Session::get('msg') != "")
      <div class="alert alert-success"><p><strong>{{Session::get('msg')}}</strong></p></div>
      @endif

      @if(Session::get('msgWarning') != "")
      <div class="alert alert-warning"><p><strong>{{Session::get('msgWarning')}}</strong></p></div>
      @endif
      <div class="box">
        <div class="box-header with-border">
          <div class="pull-left">
            <h3 class="box-title text-uppercase">Danh sách quản trị viên</h3>
            <a href="{{route('admin.users.add')}}" class="pull-right-container" style="color: green;">
              | Thêm
              <i class="fa fa-plus-square" aria-hidden="true"></i>
            </a>
          </div>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive">
          <table class="table table-bordered">
            <tr>
              <th style="width: 10px">#</th>
              <th>Username</th>
              <th>Fullname</th>
              <th>Email</th>
              <th class="text-center">Cấp bậc</th>
              <th class="text-center">Avatar</th>
              <th colspan="2" class="text-center">Thao tác</th>
            </tr>
            @foreach ($arUsers as $key => $arUser)
            <?php  
            switch ($arUser['capbac']) {
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
            $picture =  ($arUser['picture'] == NULL)?'noimage.jpg':$arUser['picture'];
            if (!File::exists('storage/app/files/'.$picture))
            {
              $picture = 'error.jpg';
            }
            ?>

            <tr>
              <td>{{ $arUser['id'] }}.</td>
              <td>{{ $arUser['username'] }}</td>
              <td>{{ $arUser['fullname'] }}</td>
              <td>{{ $arUser['email'] }}</td>
              <td class="text-center">{{ $capbac }}</td>
              <td class="text-center"><img src="{{$imageUrl}}/{{$picture}}" class="img-responsive" width="100px" style="margin: 0 auto;"></td>
              <td class="thao-tac text-center">
                <a href="{{ route('admin.users.edit', $arUser['id']) }}">Sửa &nbsp;<i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
              </td>
              <td class="thao-tac text-center">    
                @if($arUser['id'] == 1)
                <span>-----</span>
                @else
                <a href="{{ route('admin.users.del', $arUser['id']) }}" onclick="return confirmAction()">Xóa &nbsp;<i class="fa fa-times" aria-hidden="true"></i></a>
                @endif
              </td>
            </tr>

            @endforeach
          </table>
        </div>
        <!-- /.box-body -->
      </div>
    </div>
  </div>
</section>

<script type="text/javascript">
  function confirmAction(){
    return confirm('Bạn có chắc muốn xóa?');
  }
</script>


@stop