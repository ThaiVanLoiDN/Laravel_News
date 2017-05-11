@extends('templates.admin.contact')
@section('main')
<link rel="stylesheet" href="{{$adminUrl}}/css/bootstrap3-wysihtml5.min.css">

<!-- /.col -->
<div class="col-md-9">
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Soạn thư mới</h3>
    </div>
    <!-- /.box-header -->
    @if (count($errors) > 0)
        <ul class="validate-error">
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
        @endif
    <form action="{{ route('admin.contacts.add') }}" method="post" id="replyMail">
    {{ csrf_field() }}
    <div class="box-body">
      <div class="form-group">
        <input class="form-control" placeholder="Đến:" value="" name="email">
      </div>
      <div class="form-group">
        <input class="form-control" placeholder="Tiêu đề:" value="" name="title">
      </div>
      <div class="form-group">
        <label for="detail">Nội dung</label>
        <br>
        <textarea id="detail" class="form-control ckeditor" style="height: 300px" name="detail"></textarea>
      </div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
      <div class="pull-right">
        <button type="button" class="btn btn-default"><i class="fa fa-times"></i> Hủy</button>
        <button type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Gửi</button>
      </div>
    </div>
    </form>
    <!-- /.box-footer -->
  </div>
  <!-- /. box -->
</div>
<!-- /.col -->

<!-- CK Editor -->
<script src="{{$adminUrl}}/js/ckeditor/ckeditor.js"></script>
</script>
@stop