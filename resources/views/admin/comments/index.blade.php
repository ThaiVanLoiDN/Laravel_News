  @extends('templates.admin.template')
  @section('main')

  <!-- ChartJS 1.0.1 -->
  <script src="{{$adminUrl}}/js/Chart.min.js"></script>
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Bình luận
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{route('admin.index.index')}}"><i class="fa fa-dashboard"></i>Trang chủ</a></li>
      <li class="active">Bình luận</a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        @if(Session::get('msg') != "")
        <div class="alert alert-success"><p><strong>{{Session::get('msg')}}</strong></p></div>
        @endif
        <div class="box">
          <div class="box-header with-border">
            <div class="pull-left">
              <h3 class="box-title text-uppercase">Danh sách bình luận</h3>
            </div>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive">
            <form action="{{ route('admin.comments.delmore') }}" method="post">
              {{ csrf_field() }}
              <table class="table table-bordered">
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Tên bài viêt</th>
                  <th>Họ tên</th>
                  <th>Email</th>
                  <th>Nội dung bình luận</th>
                  <th>Trạng thái</th>
                  <th class="text-center">Thao tác</th>
                  <th class="text-center">
                    <input type="checkbox" name="chkAll" id="chkAll" value="" />
                    <input type="submit" name="dels" id="dels" value="Xóa" onclick="return valDels();" />

                  </th>
                </tr>
                @foreach ($arCommentAs as $key => $arComment)
                <?php  
                  $is_active = ($arComment['is_active'] == 1)?'active.png':'disactive.png';
                  $gt  = ($arComment['is_active'] == 1)?'0':'1';
                ?>
                <tr>
                  <td>{{$arComment['id']}}.</td>
                  <td><a href="{{ route('public.news.detail', ['slug' => str_slug($arComment['nname']), 'id' => $arComment['nid']  ]) }}" target="_blank">{{$arComment['nname']}}</a></td>
                  <td>{{$arComment['hoten']}}</td>
                  <td>{{$arComment['email']}}</td>
                  <td>{{$arComment['content']}}</td>
                  <td class="text-center change-{{ $arComment['id'] }}"> 
                    <a href="javascript:void(0)" onclick="changeActive({{ $arComment['id'] }}, {{ $gt }})">
                      <img src="{{$adminUrl}}/images/{{$is_active}}" width="20px">
                    </a>
                  </td>
                  <td class="thao-tac text-center">    
                    <a href="{{route('admin.comments.del', $arComment['id'])}}" onclick="return confirmAction()">Xóa &nbsp;<i class="fa fa-times" aria-hidden="true"></i></a>
                  </td>
                  <td class="text-center">
                    <input type="checkbox" name="iddel[]" value="{{$arComment['id']}}" />
                  </td>
                </tr>
                @endforeach
              </table>
            </form>
          </div>
          <div class="box-footer clearfix">
            <ul class="pagination pagination-sm no-margin pull-right">
              {{$arCommentAs->links()}}
            </ul>
          </div>
        </div>
        <!-- /.box-body -->
      </div>
    </div>
  </section>

  <script type="text/javascript">
    function confirmAction(){
      return confirm('Bạn có chắc muốn xóa?');
    }
  </script>

  <script type="text/javascript">
    function valDels()
    {
      var checkedAtLeastOne = false;
      $('input[type="checkbox"][name="iddel[]"]').each(function() {
        if ($(this).is(":checked")) {
          checkedAtLeastOne = true;
        }
      });

      if (checkedAtLeastOne == true){
        return confirm('Bạn có muốn xóa các bình luận đã chọn?');
      } else {
        alert('Vui lòng chọn ít nhất 1 bình luận để xóa');
        return false;
      }
    }

    $('#chkAll').click(function(event) {
      if(this.checked) {
      // Iterate each checkbox
      $(':checkbox').each(function() {
        this.checked = true;
      });
    }
    else {
      $(':checkbox').each(function() {
        this.checked = false;
      });
    }
  });

</script>

<script type="text/javascript">
  function changeActive(id, gt){
    $.ajax({
      url: "{{route('admin.comments.active')}}",
      type: 'GET',
      cache: false,
      data: {
        agt : gt,
        aid: id
      },

      success: function(data){
        $(".change"+'-'+id).html(data); 
      },
      error: function (){
        alert('Có lỗi');
      }
    }); 
  }

</script>
@stop