@extends('templates.admin.contact')
@section('main')
<link rel="stylesheet" href="{{$adminUrl}}/css/bootstrap3-wysihtml5.min.css" />
<div class="col-md-9">
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Đọc thư</h3>
    </div>
    @foreach ($arItems as $key => $arItem)
    <?php
    $id = $arItem['id'];
    $fullname = $arItem['fullname'];
    $title = $arItem['title'];
    $email = $arItem['email'];
    $detail = $arItem['detail'];
    $readed = $arItem['readed'];
    $created_at = $arItem['created_at'];
    $is_del = $arItem['is_del'];
    ?>
    @endforeach

    <!-- /.box-header -->
    <div class="box-body no-padding">
      <div class="mailbox-read-info">
        <h3>{{ $title }}</h3>
        <h5>Từ: {{ $email }}
          <span class="mailbox-read-time pull-right">{{date('d-m-Y', strtotime($created_at))}}</span></h5>
        </div>
        <!-- /.mailbox-read-info -->
        <div class="mailbox-controls with-border">
          <!-- /.mailbox-controls -->
          <div class="mailbox-read-message">
           {!! $detail !!}
         </div>
         <!-- /.mailbox-read-message -->
       </div>
       <!-- /.box-body -->
       <div class="mailbox-read-info">
        <h3>Gửi thư khác</h3>
        @if (count($errors) > 0)
        <ul>
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
        @endif
      </div>

      <!-- /.box-footer -->
      <form action="{{ route('admin.contacts.add') }}" method="post" id="replyMail">
       {{ csrf_field() }}
       <div class="box-footer">
        <div class="form-group">
          <input class="form-control" placeholder="Đến:" value="{{ $email }}" name="email">
        </div>
        <div class="form-group">
          <input class="form-control" placeholder="Tiêu đề:" value="Re: {{ $title }}" name="title">
        </div>
        <div class="form-group">
        	<label for="detail">Nội dung</label>
        <br>
          <textarea id="detail" class="form-control ckeditor" style="height: 200px" name="detail">
          </textarea>
        </div>
      </div>
      <!-- /.box-footer -->
      <div class="box-footer">
        <div class="pull-right">
          <button type="submit" class="btn btn-default"><i class="fa fa-reply"></i> Gửi</button>
        </div>
        <a href="{{ route('admin.contacts.delmail', $id) }}" class="btn btn-default" onclick="return confirmAction()"><i class="fa fa-trash-o"></i> Xóa hẳn thư này</a>
      </div>
    </form>
    <!-- /.box-footer -->
  </div>
  <!-- /. box -->
</div>

<script type="text/javascript">
  function confirmAction(){
    return confirm('Bạn có chắc muốn xóa?');
  }
</script>
<!-- CK Editor -->
<script src="{{$adminUrl}}/js/ckeditor/ckeditor.js"></script>
@stop