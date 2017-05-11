@extends('templates.admin.template')
@section('main')
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="{{$adminUrl}}/css/datepicker3.css">

<section class="content-header">
  <h1>
    Bài viết
    <small>Thêm bài mới</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{route('admin.index.index')}}"><i class="fa fa-dashboard"></i>Trang chủ</a></li>
    <li><a href="{{route('admin.news.index')}}">Bài viết</a></li>
    <li class="active">Thêm bài mới</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Thêm bài mới</h3>
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
        <form role="form" action="{{route('admin.news.add')}}" method="post" enctype="multipart/form-data" id="addNews">
          {{csrf_field()}}
          <div class="box-body">
            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  <label for="ten-bai-viet">Nhập tên bài viết</label>
                  <input type="text" class="form-control" name="name" id="ten-bai-viet" placeholder="Nhập tên bài viết">
                </div>
                <div class="col-md-4">
                  <label>Chuyên mục</label>
                  <select class="form-control select2" name="cat_id" style="width: 100%;">
                    <option value="{{$arCats[0]['id']}}">{{$arCats[0]['name']}}</option>
                    @foreach ($arCats as $key => $arCat)
                      @if($arCat['id'] != 0)
                        @if($arCat['parent_id'] == 0)
                          <option value="{{$arCat['id']}}">{{$arCat['name']}}</option>
                          @foreach ($arCats as $key => $arCat2)
                            @if($arCat2['parent_id'] == $arCat['id'])
                              <option value="{{$arCat2['id']}}">----{{$arCat2['name']}}</option>
                            @endif
                          @endforeach
                        @endif
                      @endif
                    @endforeach
                  </select>
                </div>
                <div class="col-md-1 col-xs-6">
                  <label for="slide">Slide</label>
                  <p><input type="checkbox" id="slide" name="is_slide" checked="checked">Hiện</p>
                </div>
                <div class="col-md-1 col-xs-6">
                  <label for="active">Trạng thái</label>
                  <p><input type="checkbox" id="active" name="is_active" checked="checked">Hiện</p>
                </div>               
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  <label for="hinhanh">Hình ảnh</label>
                  <input type="file" id="hinhanh" name="picture" onchange="viewImg(this)">
                  <br>
                  <p><img id="avartar-img-show" src="{{$imageUrl}}/noimage.jpg" alt="avatar" class="img-responsive" ></p>
                </div>
              </div>
            </div>
            <!-- textarea -->
            <div class="form-group">
              <label>Mô tả bài viết</label>
              <textarea class="form-control" name="preview" rows="3" placeholder="Nhập mô tả bài viết ..."></textarea>
            </div>

            <div class="form-group">
              <label for="detail">Nội dung bài viết</label>
              <textarea id="detail" name="detail" class="form-control ckeditor" rows="3"></textarea>
            </div>
          </div>
          <!-- /.box-body -->

          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Thêm bài viết</button>
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