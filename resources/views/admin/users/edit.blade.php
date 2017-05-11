@extends('templates.admin.template')
@section('main')
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="{{$adminUrl}}/css/datepicker3.css">

<section class="content-header">
  <h1>
    Quản trị viên
    <small>Sửa quản trị viên</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{route('admin.index.index')}}"><i class="fa fa-dashboard"></i>Trang chủ</a></li>
    <li><a href="{{route('admin.users.index')}}">Quản trị viên</a></li>
    <li class="active">Sửa quản trị viên</li>
  </ol>
</section>

<?php  
  $id = $arUser['id'];
  $username = $arUser['username'];
  $email = $arUser['email'];
  $fullname = $arUser['fullname'];
  $capbac = $arUser['capbac'];
  $picture = $arUser['picture'];
  if($picture == ''){
    $picture = 'noimage.jpg';
  }
?>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Sửa quản trị viên</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        @if (count($errors) > 0)
        <ul class="validate-error">
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
        @endif
        <form role="form" action="{{route('admin.users.edit', $id)}}" method="post" enctype="multipart/form-data" id="editUser">
          {{csrf_field()}}
          <div class="box-body">
            <div class="form-group">
              <div class="row">
                <div class="col-md-4">
                  <label for="username">Nhập tên đăng nhập</label>
                  <input type="text" class="form-control" name="username" id="username" placeholder="abcxyz" value="{{ $username }}">
                </div>
                <div class="col-md-4">
                  <label for="fullname">Nhập tên đầy đủ</label>
                  <input type="text" class="form-control" name="fullname" id="fullname" placeholder="Nguyễn Văn A" value="{{ $fullname }}">
                </div>
                <div class="col-md-4">
                  <label for="capbac">Cấp bậc</label>
                  <select class="form-control select2" name="capbac" id="capbac" style="width: 100%;">
                    <option value="4" <?php echo ($capbac == 4)?'selected' :''; ?> >Admin</option>
                    <option value="3" <?php echo ($capbac == 3)?'selected' :''; ?> >Smod</option>
                    <option value="2" <?php echo ($capbac == 2)?'selected' :''; ?> >Mod</option>
                    <option value="1" <?php echo ($capbac == 1)?'selected' :''; ?> >Trial Mod</option>
                    <option value="0" <?php echo ($capbac == 0)?'selected' :''; ?> >Mem</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  <label for="email">Nhập email</label>
                  <input type="text" class="form-control" name="email" id="email" placeholder="abcxyz@gmail.com" value="{{ $email }}">
                </div>
                <div class="col-md-6">
                  <label for="reemail">Nhập lại email</label>
                  <input type="text" class="form-control" name="reemail" id="reemail" placeholder="abcxyz@gmail.com" value="{{ $email }}">
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  <label for="password">Nhập mật khẩu</label>
                  <input type="password" class="form-control" name="password" id="password" placeholder="******">
                </div>
                <div class="col-md-6">
                  <label for="repassword">Nhập lại mật khẩu</label>
                  <input type="password" class="form-control" name="repassword" id="repassword" placeholder="******">
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  <label for="hinhanh">Hình ảnh</label>
                  <input type="file" id="hinhanh" name="picture" onchange="viewImg(this)">
                  <br>
                  <p><img id="avartar-img-show" src="{{ $imageUrl }}/{{ $picture }}" alt="avatar" class="img-responsive" ></p>
                </div>
                <div class="col-md-6">
                  <label for="active">Xóa hình ảnh</label>
                  <p><input type="checkbox" id="active" name="delete_picture">Xóa</p>
                </div>
              </div>
            </div>
          </div>
          <!-- /.box-body -->

          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Sửa quản trị viên</button>
          </div>
        </form>
      </div>
      <!-- /.box -->
    </div>        
  </div>
  <!-- /.row -->
</section>        
<!-- CK Editor -->
<script src="{{$adminUrl}}/js/ckeditor/ckeditor.js"></script>
<!-- Select2 -->
<script src="{{$adminUrl}}/js/select2/select2.full.min.js"></script>
<script>
  function viewImg(img) {
    var fileReader = new FileReader;
    fileReader.onload = function(img) {
      var avartarShow = document.getElementById("avartar-img-show");

      avartarShow.src = img.target.result
    }, fileReader.readAsDataURL(img.files[0])
  }
</script>
<script type="text/javascript">
  $(function () {
   $(".select2").select2();
 });   

</script>
@stop        