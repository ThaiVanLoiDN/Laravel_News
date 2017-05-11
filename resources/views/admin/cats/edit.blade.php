  @extends('templates.admin.template')
  @section('main')

  <!-- ChartJS 1.0.1 -->
  <script src="{{$adminUrl}}/js/Chart.min.js"></script>
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Chuyên mục
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{route('admin.index.index')}}"><i class="fa fa-dashboard"></i>Trang chủ</a></li>
      <li><a href="{{route('admin.news.index')}}">Bài viết</a></li>
      <li class="active">Chuyên mục</li>
    </ol>
  </section>

  <!-- Add Cats -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <div class="pull-left">
              <h3 class="box-title text-uppercase">Sửa chuyên mục</h3>
              <i class="fa fa-edit text-green" aria-hidden="true"></i>
            </div>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
          </div>
          <div class="box-body">
            <div class="row">
              @if (count($errors) > 0)
              <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
              </ul>
              @endif
              <form action="{{route('admin.cats.edit', $arItems['id'])}}" method="post" id="addCat">
                {{csrf_field()}}
                <div class="modal-body">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-6">
                        <label>Tên chuyên mục (*)</label>
                        <input type="text" name="name" value="{{ $arItems['name'] }}" class="form-control" placeholder="Nhập tên chuyên mục">
                      </div>
                      <div class="col-md-6">
                        <label>Chuyên mục cha</label>
                        <select name="parent_id" class="form-control select2" style="width: 100%;">
                          @foreach ($arCats as $key => $arCat)
                          <option value="{{$arCat['id']}}" <?php echo ($arItems['parent_id'] == $arCat['id']) ? 'selected' : '' ?>>{{$arCat['name']}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <div class="row">
                    <div class="col-md-12">
                      <input type="submit" class="btn btn-primary" value="Sửa chuyên mục" />
                    </div>
                  </div>
                </div>
              </form>
              <!-- /.col -->
            </div>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
    </div>
  </section>  

  <script type="text/javascript">
    function confirmAction(){
      return confirm('Bạn có chắc muốn xóa?');
    }
  </script>
  @stop