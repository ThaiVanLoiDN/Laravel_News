  @extends('templates.admin.template')
  @section('main')
  <!-- Bài viết -->
  <section class="content-header">
    <h1>
      Bài viết
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{route('admin.index.index')}}"><i class="fa fa-dashboard"></i>Trang chủ</a></li>
      <li><a href="{{route('admin.news.index')}}">Bài viết</a></li>
      <li class="active">Tìm kiếm</a></li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <div class="pull-left">
              <h3 class="box-title text-uppercase">Tìm kiếm</h3>
            </div>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
          </div>
          <div class="box-body">
            <form method="get" action="{{route('admin.news.search')}}">
              <div class="form-group">
                <div class="row">
                  <div class="col-md-4">
                    <label for="ten-bai-viet">Nhập tên bài viết</label>
                    <input type="text" class="form-control" name="name" id="ten-bai-viet" placeholder="Nhập tên bài viết" value="{{ $nameSeach }}">
                  </div>
                  <div class="col-md-4">
                    <label>Chuyên mục</label>
                    <select class="form-control select2 " name="cat_id" style="width: 100%;" tabindex="-1" aria-hidden="true">
                     <option value="">Tất cả</option>
                     <option value="{{$arCats[0]['id']}}" <?php if($chuyenMuc == '0') { echo 'selected'; } ?> >{{$arCats[0]['name']}}</option>
                        @foreach ($arCats as $key => $arCat)
                          @if($arCat['id'] != 0)
                            @if($arCat['parent_id'] == 0)
                              <option value="{{$arCat['id']}}" <?php if($chuyenMuc == $arCat['id']) { echo 'selected'; } ?> >{{$arCat['name']}}</option>
                              @foreach ($arCats as $key => $arCat2)
                                @if($arCat2['parent_id'] == $arCat['id'])
                                  <option value="{{$arCat2['id']}}" <?php if($chuyenMuc == $arCat2['id']) { echo 'selected'; } ?> >----{{$arCat2['name']}}</option>
                                @endif
                              @endforeach
                            @endif
                          @endif
                        @endforeach
                    </select>
                  </div>
                  <div class="col-md-2 col-xs-6">
                    <label>Trạng thái</label>
                    <select class="form-control select2" name="active" style="width: 100%;" tabindex="-1" aria-hidden="true">
                      <option value="">Tất cả</option>
                      <option value="1" <?php if($active == '1') { echo 'selected'; } ?> >Hiển thị</option>
                      <option value="0" <?php if($active == '0') { echo 'selected'; } ?> >Không hiển thị</option>
                    </select>
                  </div>
                  <div class="col-md-2 col-xs-6">
                    <br>
                    <button type="submit" class="btn btn-primary" style="margin-top: 5px;">Tìm kiếm <i class="fa fa-search" aria-hidden="true"></i></button>
                  </div>               
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-xs-12">
        @if(Session::get('msg') != "")
        <div class="alert alert-success"><p><strong>{{Session::get('msg')}}</strong></p></div>
        @endif

        @if(Session::get('msgWarning') != "")
        <div class="alert alert-warning"><p><strong>{{Session::get('msgWarning')}}</strong></p></div>
        @endif
        <div class="box">
          <div class="box-header with-border">
            <div class="pull-left">
              <h3 class="box-title text-uppercase">Danh sách kết quả</h3>
            </div>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive">
          	@if(count($arNewses) != 0)
            <form action="{{ route('admin.news.delmore') }}" method="post">
              {{ csrf_field() }}
              <table class="table table-bordered">
                <tr>
                  <th style="width: 10px" class="hidden-sm hidden-xs">#</th>
                  <th>Tên bài viết</th>
                  <th class="text-center">Chuyên mục</th>
                  <th class="text-center hidden-sm hidden-xs">Người đăng</th>
                  <th class="text-center hidden-sm hidden-xs">Ngày đăng</th>
                  <th class="text-center hidden-sm hidden-xs">Ngày sửa</th>
                  <th class="text-center  hidden-sm hidden-xs">Hình ảnh</th>
                  <th class="text-center">Trạng thái</th>
                  <th colspan="2" class="text-center">Thao tác</th>
                  <th class="text-center hidden-sm hidden-xs">
                    <input type="checkbox" name="chkAll" id="chkAll" value="" />
                    <input type="submit" name="dels" id="dels" value="Xóa" onclick="return valDels();" />
                  </th>
                </tr>
                @foreach ($arNewses as $key => $arNews)
                <?php  
                $created_at = date('d-m-Y', strtotime($arNews['created_at']));
                $updated_at = date('d-m-Y', strtotime($arNews['updated_at']));

                $updated_at = ($arNews['created_at'] == $arNews['updated_at'])?'-':$updated_at;

                $picture =  ($arNews['picture'] == NULL)?'noimage.jpg':$arNews['picture'];
                if (!File::exists('storage/app/files/'.$picture))
                {
                  $picture = 'error.jpg';
                }

                $is_active = ($arNews['is_active'] == 1)?'active.png':'disactive.png';
                $gt  = ($arNews['is_active'] == 1)?'0':'1';
                $sl  = ($arNews['is_slide'] == 1)?'0':'1';
                $is_slide = ($arNews['is_slide'] == 1)
                ?'-o color-yellow'
                :'-o color-green';
                ?>
                <tr valign="center">
                  <td class="hidden-sm hidden-xs">{{$arNews['id']}}.</td>
                  <td><a href="{{ route('public.news.detail', ['slug' => str_slug($arNews['name']), 'id' => $arNews['id']]) }}" title="Xem bài viết" target="_blank">{{ $arNews['nname'] }}</a> &nbsp &nbsp &nbsp 
                    <span class=" changeS-{{ $arNews['id'] }}">
                      <a href="javascript:void(0)" onclick="changeSlide({{ $arNews['id'] }}, {{ $sl }})">
                        <i class="fa fa-star{{ $is_slide }}" aria-hidden="true"></i>
                      </a>
                    </span>

                  </td>
                  <td class="text-center">{{$arNews['cname']}}</td>
                  <td class="text-center hidden-sm hidden-xs">{{$arNews['uname']}}</td>
                  <td class="text-center hidden-sm hidden-xs">{{$created_at}}</td>
                  <td class="text-center hidden-sm hidden-xs">{{$updated_at}}</td>
                  <td class="text-center hidden-sm hidden-xs">
                    <img src="{{$photoUrl}}/{{$picture}}" class="img-responsive" width="100px">
                  </td>
                  <td class="text-center change-{{ $arNews['id'] }}"> 
                    <a href="javascript:void(0)" onclick="changeActive({{ $arNews['id'] }}, {{ $gt }})">
                      <img src="{{$adminUrl}}/images/{{$is_active}}" width="20px">
                    </a>
                  </td>
                  <td class="thao-tac text-center">
                    <a href="{{route('admin.news.edit', $arNews['id'])}}">Sửa&nbsp;<i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                  </td>
                  <td class="thao-tac text-center">    
                    <a href="{{route('admin.news.del', $arNews['id'])}}" onclick="return confirmAction()">Xóa&nbsp;<i class="fa fa-times" aria-hidden="true"></i></a>
                  </td>
                  <td class="text-center  hidden-sm hidden-xs">
                    <input type="checkbox" name="iddel[]" value="{{$arNews['id']}}" />
                  </td>
                </tr>
                @endforeach
              </table>
            </form>
            @else
            	<p>Không có kết quả nào</p>
            @endif
          </div>
          <!-- /.box-body -->
          <div class="box-footer clearfix">
            <div class="pagination-sm no-margin pull-right">
              {{$arNewses->links()}}
            </div>
          </div>
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->

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
        return confirm('Bạn có muốn xóa các mẫu tin đã chọn?');
      } else {
        alert('Vui lòng chọn ít nhất 1 tin để xóa');
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
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      url: "{{route('admin.news.active')}}",
      type: 'POST',
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

<script type="text/javascript">
  function changeSlide(id, sl){
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      url: "{{route('admin.news.slide')}}",
      type: 'POST',
      cache: false,
      data: {
        asl : sl,
        aid: id
      },

      success: function(data){
        $(".changeS"+'-'+id).html(data); 
      },
      error: function (){
        alert('Có lỗi');
      }
    }); 
  }

</script>
<!-- Select2 -->
<script src="{{$adminUrl}}/js/select2/select2.full.min.js"></script>

<script type="text/javascript">
  $(function () {
   $(".select2").select2();
 });   

</script>

@stop
