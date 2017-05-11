@extends('templates.public.contact')
@section('main')
<link rel="stylesheet" href="/resources/assets/templates/admin/css/bootstrap3-wysihtml5.min.css" />
<link rel="stylesheet" href="/resources/assets/templates/admin/css/AdminLTE.min.css">
<script src="{{$adminUrl}}/js/ckeditor/ckeditor.js"></script>

<div class="col-lg-8 col-md-8 col-sm-8">
  <div class="left_content">
    <div class="contact_area">
      <h2>Liên hệ</h2>
      <p>Vui lòng gửi liên hệ của bạn đến với chúng tôi...</p>
      @if(Session::get('msg') != "")
      <div class="alert alert-success"><p><strong>{{Session::get('msg')}}</strong></p></div>
      @endif
      @if (count($errors) > 0)
      <ul class="validate-error">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
      @endif
      <form action="{{route('public.contact.index')}}" class="contact_form" method="post" id="addContact">
        {{csrf_field()}}
        <div class="form-group">
          <div class="row">
            <div class="col-md-12">
            <label for="fullname">Họ và tên</label>
              <input class="form-control" name="fullname" id="fullname" type="text" placeholder="Họ tên (*)">
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-md-12">
            <label for="email">Email</label>
              <input class="form-control" name="email" id="email" type="email" placeholder="Email (*)">
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-md-12">
            <label for="title">Tiêu đề</label>
              <input class="form-control" name="title"  id="title" type="text" placeholder="Tiêu đề (*)">
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-md-12">
              <label for="detail">Nội dung liên hệ</label>
              <br>
              <textarea id="detail" name="detail" class="form-control ckeditor" placeholder="Nội dung liên hệ (*)"></textarea>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-md-12">
              <input type="submit" value="Gửi">
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<script src="/resources/assets/templates/admin/js/bootstrap3-wysihtml5.all.min.js"></script>
@stop