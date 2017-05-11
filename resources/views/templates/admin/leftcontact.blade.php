<div class="col-md-12">
  @if(Session::get('msg') != "")
  <div class="alert alert-success"><p><strong>{{Session::get('msg')}}</strong></p></div>
  @endif

  @if(Session::get('msgWarning') != "")
  <div class="alert alert-warning"><p><strong>{{Session::get('msgWarning')}}</strong></p></div>
  @endif
</div>
<div class="col-md-3">
  <a href="{{ route('admin.contacts.add') }}" class="btn btn-primary btn-block margin-bottom">Soạn thư</a>
  <div class="box box-solid">
    <div class="box-header with-border">
      <h3 class="box-title">Liên hệ</h3>
      <div class="box-tools">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
        </button>
      </div>
    </div>
    <div class="box-body no-padding">
      <ul class="nav nav-pills nav-stacked">
        <li>
          <a href="{{route('admin.contacts.index')}}"><i class="fa fa-inbox"></i> Hộp thư đến
            <span class="label label-primary pull-right"><?php echo ($count_inbox > 0) ? $count_inbox: ''; ?></span>
          </a>
        </li>
        <li><a href="{{route('admin.contacts.sent')}}"><i class="fa fa-paper-plane"></i> Thư đã gửi</a></li>
        <li><a href="{{route('admin.contacts.important')}}"><i class="fa fa-star-o"></i> Thư quan trọng</a></li>
        <li><a href="{{route('admin.contacts.recyclebin')}}"><i class="fa fa-trash-o"></i> Thùng rác</a></li>
      </ul>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /. box -->
</div>