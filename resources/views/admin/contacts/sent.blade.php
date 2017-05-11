@extends('templates.admin.contact')
@section('main')
<div class="col-md-9">
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Inbox</h3>
      <!-- /.box-tools -->
    </div>
    <!-- /.box-header -->
    <div class="box-body no-padding">
      <form action="{{ route('admin.contacts.delmoremail') }}" method="post">
        {{ csrf_field() }}
        <div class="mailbox-controls">
          <!-- Check all button -->
          <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
          </button>
          <div class="btn-group">
            <button type="submit" class="btn btn-default btn-sm" onclick="return confirmAction()"><i class="fa fa-trash-o"></i></a></button>
          </div>
          <!-- /.btn-group -->
          <a href="{{ route('admin.contacts.index') }}" class="btn btn-default btn-sm" title="Refresh"><i class="fa fa-refresh"></i></a>
        </div>
        <div class="table-responsive mailbox-messages">
          <table class="table table-hover table-striped">
            <tbody>
              @foreach ($arContacts as $key => $arContact)
              <?php  
              $imp = ($arContact['imp'] == 1) ? ' color-yellow' :'-o color-green';
              $titleC = ($arContact['imp'] == 0) ? 'Đánh dấu thư quan trọng' :'Bỏ đánh dấu thư quan trọng';

              $qt  = ($arContact['imp'] == 1)?'0':'1';
              ?>
              <tr>
                <td><input type="checkbox" name="iddel[]" value="{{$arContact['id']}}" ></td>
                <td class="mailbox-name"><a href="{{route('admin.contacts.readmail', $arContact['id'])}}">{{ $arContact['email'] }}</a></td>
                <td class="mailbox-subject">
                  @if ($arContact['readed'] == 0)
                  <strong><a href="{{route('admin.contacts.readmail', $arContact['id'])}}"  class="color-black">{{ $arContact['title'] }}</a></strong>
                  @else
                  <a href="{{route('admin.contacts.readmail', $arContact['id'])}}" class="color-black">{{ $arContact['title'] }}</a>
                  @endif

                </td>
                <td class="mailbox-attachment"></td>
                <td class="mailbox-date">{{date('d-m-Y', strtotime($arContact['created_at']))}}</td>
              </tr>
              @endforeach

            </tbody>
          </table>
          <!-- /.table -->
        </div>
        <!-- /.mail-box-messages -->
      </form> 
    </div>
    <!-- /.box-body -->
    <div class="box-footer no-padding">
      <div class="mailbox-controls">
        <div class="pull-right">
          <div class="btn-group">
            {{ $arContacts->links() }}
          </div>
          <!-- /.btn-group -->
        </div>
        <!-- /.pull-right -->
      </div>
    </div>
  </div>
  <!-- /. box -->
</div>
<script src="{{$adminUrl}}/js/icheck.min.js"></script>
<script>
  $(function () {
//Enable iCheck plugin for checkboxes
//iCheck for checkbox and radio inputs
$('.mailbox-messages input[type="checkbox"]').iCheck({
  checkboxClass: 'icheckbox_flat-blue',
  radioClass: 'iradio_flat-blue'
});

//Enable check and uncheck all functionality
$(".checkbox-toggle").click(function () {
  var clicks = $(this).data('clicks');
  if (clicks) {
//Uncheck all checkboxes
$(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
$(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
} else {
//Check all checkboxes
$(".mailbox-messages input[type='checkbox']").iCheck("check");
$(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
}
$(this).data("clicks", !clicks);
});

//Handle starring for glyphicon and font awesome
$(".mailbox-star").click(function (e) {
  e.preventDefault();
//detect type
var $this = $(this).find("a > i");
var glyph = $this.hasClass("glyphicon");
var fa = $this.hasClass("fa");

//Switch states
if (glyph) {
  $this.toggleClass("glyphicon-star");
  $this.toggleClass("glyphicon-star-empty");
}

});
});
</script>


<script type="text/javascript">
  function confirmAction(){
    return confirm('Bạn có chắc muốn xóa?');
  }
</script>    
@stop