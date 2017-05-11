@extends('templates.admin.template')
@section('main')
<link rel="stylesheet" href="/resources/assets/templates/admin/css/bootstrap3-wysihtml5.min.css" />
<link rel="stylesheet" href="/resources/assets/templates/admin/css/AdminLTE.min.css">

<section class="content-header">
  <h1>
    Cài đặt
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{route('admin.index.index')}}"><i class="fa fa-dashboard"></i>Trang chủ</a></li>
    <li class="active">Cài đặt</li>
  </ol>

</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      @if(Session::get('msg') != "")
      <div class="alert alert-success"><p><strong>{{Session::get('msg')}}</strong></p></div>
      @endif
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Cài đặt</h3>

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
        <form role="form" action="{{route('admin.setting.add')}}" method="post" enctype="multipart/form-data">
          {{csrf_field()}}
          <div class="box-body">
            <div class="form-group">
              <div class="row">
                <div class="col-md-4">
                  <label for="tenwebsite">Tên website</label>
                  <input type="text" class="form-control" name="tenwebsite" id="tenwebsite" value="{{ $arSetting['tenwebsite'] }}">
                </div>
                <div class="col-md-8">
                  <label for="slogan">Slogan</label>
                  <input type="text" class="form-control" name="slogan" id="slogan" value="{{ $arSetting['slogan'] }}">
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-12">
                  <label for="lienhe">Liên hệ</label>
                  <textarea id="compose-textarea" name="lienhe" class="form-control" style="height: 200px"" id="lienhe">{{ $arSetting['lienhe'] }}</textarea>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  <label for="facebook">Facebook <i class="fa fa-facebook-official" aria-hidden="true"></i></label>
                  <input type="text" class="form-control" name="facebook" id="facebook"  value="{{ $arSetting['facebook'] }}">
                </div>
                <div class="col-md-6">
                  <label for="twitter">Twitter <i class="fa fa-twitter-square" aria-hidden="true"></i></label>
                  <input type="text" class="form-control" name="twitter" id="twitter"  value="{{ $arSetting['twitter'] }}">
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  <label for="flickr">Flickr <i class="fa fa-flickr" aria-hidden="true"></i></label>
                  <input type="text" class="form-control" name="flickr" id="flickr"  value="{{ $arSetting['flickr'] }}">
                </div>
                <div class="col-md-6">
                  <label for="pinterest">Pinterest <i class="fa fa-pinterest-square" aria-hidden="true"></i></label>
                  <input type="text" class="form-control" name="pinterest" id="pinterest" value="{{ $arSetting['pinterest'] }}">
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  <label for="googleplus">Google Plus <i class="fa fa-google-plus-square" aria-hidden="true"></i></label>
                  <input type="text" class="form-control" name="googleplus" id="googleplus" value="{{ $arSetting['googleplus'] }}">
                </div>
                <div class="col-md-6">
                  <label for="vimeo">Vimeo <i class="fa fa-vimeo-square" aria-hidden="true"></i></label>
                  <input type="text" class="form-control" name="vimeo" id="vimeo"  value="{{ $arSetting['vimeo'] }}">
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  <label for="youtube">Youtube <i class="fa fa-youtube-play" aria-hidden="true"></i></label>
                  <input type="text" class="form-control" name="youtube" id="youtube"  value="{{ $arSetting['youtube'] }}">
                </div>
                <div class="col-md-6">
                  <label for="mail">Mail <i class="fa fa-envelope-o"></i></label>
                  <input type="email" class="form-control" name="mail" id="mail" value="{{ $arSetting['mail'] }}">
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-12">
                  <label for="picture">Hình ảnh</label>
                  <input type="file" id="picture" name="picture" onchange="viewImg(this)">
                  <br>
                  <p><img id="avartar-img-show" src="{{ $imageUrl }}/{{$logo}}" alt="avatar" class="img-responsive" ></p>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  <label for="kinhdo">Kinh độ <i class="fa fa-map-marker" aria-hidden="true"></i></label>
                  <input type="text" class="form-control" name="kinhdo" id="kinhdo"  value="{{ $kinhdo }}">
                </div>
                <div class="col-md-6">
                  <label for="vido">Vĩ độ <i class="fa fa-map-marker" aria-hidden="true"></i></label>
                  <input type="text" class="form-control" name="vido" id="vido" value="{{ $vido }}">
                </div>
                <div class="col-md-12">
                  <div id="map"></div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.box-body -->

          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
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
<script>
  $(function () {
    $("#compose-textarea").wysihtml5();
  });
</script>
<script>
  function viewImg(img) {
    var fileReader = new FileReader;
    fileReader.onload = function(img) {
      var avartarShow = document.getElementById("avartar-img-show");

      avartarShow.src = img.target.result
    }, fileReader.readAsDataURL(img.files[0])
  }
</script>

<script>
  function initMap() {
    var uluru = {lat: {{ $vido }}, lng: {{ $kinhdo }}};
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 15,
      center: uluru
    });
    var marker = new google.maps.Marker({
      position: uluru,
      map: map
    });
  }
</script>
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCXIPN4cSUCwBcs3W4i8VnzVf2qqL6IBN8&callback=initMap">
</script>

@stop        