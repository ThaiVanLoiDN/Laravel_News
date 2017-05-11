  @extends('templates.admin.template')
  @section('main')


  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Chuyên mục
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{route('admin.index.index')}}"><i class="fa fa-dashboard"></i>Trang chủ</a></li>
      <li class="active">Chuyên mục</a></li>
    </ol>
  </section>

  <!-- Add Cats -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">

      </div>
      <div class="col-md-6">
        <div class="box">
          <div class="box-header with-border">
            <div class="pull-left">
              <h3 class="box-title text-uppercase">Thêm chuyên mục</h3>
              <i class="fa fa-plus-square text-green" aria-hidden="true"></i>
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
              <form action="{{route('admin.cats.add')}}" method="post" id="addCat">
                {{csrf_field()}}
                <div class="modal-body">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-12">
                        <label>Tên chuyên mục (*)</label>
                        <input type="text" name="name" value="" class="form-control" placeholder="Nhập tên chuyên mục">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-12">
                        <label>Chuyên mục cha</label>
                        <select name="parent_id" class="form-control select2" style="width: 100%;">
                          <option value="0">--Không có--</option>
                          @foreach ($arCatParents as $key => $arCatParent)
                          @if($arCatParent['id'] != 0)
                          <option value="{{$arCatParent['id']}}">{{$arCatParent['name']}}</option>
                          @endif
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <div class="row">
                    <div class="col-md-12">
                      <input type="submit" class="btn btn-primary" value="Thêm chuyên mục" />
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
      <div class="col-md-6">
        <div class="box">
          <div class="box-header with-border">
            <div class="pull-left">
              <h3 class="box-title text-uppercase">Số bài viết chuyên mục</h3>
              <i class="fa fa-pie-chart" aria-hidden="true" style="color: green;"></i>
            </div>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
          </div>
          <div class="box-body">
            <div class="row">
              <div class="col-md-8">
                <div class="chart-responsive" height="280">
                  <canvas id="pieChart" style="height:250px"></canvas>
                  <!-- <canvas id="pieChart" height="202" width="303" ></canvas> -->
                </div>
                <!-- ./chart-responsive -->
              </div>
              <!-- /.col -->
              <div class="col-md-4">
                <ul class="chart-legend clearfix">
                  @foreach ($arDemBaiViet as $key => $arDemBV)
                  <li><i class="fa fa-circle-o text-{{ $arDemBV['color'] }}"></i> {{ $arDemBV['cname'] }}</li>
                  @endforeach
                </ul>
              </div>
              <!-- /.col -->
            </div>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
    </div>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        @if(Session::get('msg') != "")
        <div class="alert alert-success"><p><strong>{{Session::get('msg')}}</strong></p></div>
        @endif
        @if(Session::get('msgWarning') != "")
        <div class="alert alert-warning"><p><strong>{{Session::get('msgWarning')}}</strong></p></div>
        @endif
        <div class="box">
          <div class="box-header with-border">
            <div class="pull-left">
              <h3 class="box-title text-uppercase">Danh sách chuyên mục</h3>
            </div>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive">
            <table class="table table-bordered table-hover">
              <tr>
                <th>Tên chuyên mục</th>
                <th colspan="2" class="text-center">Thao tác</th>
              </tr>
              @foreach ($arCats as $key => $arCat)
                @if($arCat['id'] != 0)
                  @if($arCat['parent_id'] == 0)
                    <tr class="text-bold text-uppercase color-blue">
                      <td>{{$arCat['name']}}</td>
                      <td class="thao-tac text-center">
                        <a href="{{ route('admin.cats.edit', $arCat['id']) }}" title="Sửa chuyên mục">Sửa &nbsp;<i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                      </td>
                      <td class="thao-tac text-center">    
                        <a href="{{route('admin.cats.del', $arCat['id'])}}" onclick="return confirmAction()">
                          Xóa &nbsp;<i class="fa fa-times" aria-hidden="true"></i>
                        </a>
                      </td>
                    </tr>
                    @foreach ($arCats as $key => $arCat2)
                      @if($arCat2['parent_id'] == $arCat['id'])
                      <tr>
                        <td><i class="fa fa-long-arrow-right" aria-hidden="true"></i> {{$arCat2['name']}}</td>
                        <td class="thao-tac text-center">
                          <a href="{{ route('admin.cats.edit', $arCat2['id']) }}" title="Sửa chuyên mục">Sửa &nbsp;<i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                        </td>
                        <td class="thao-tac text-center">    
                          <a href="{{route('admin.cats.del', $arCat2['id'])}}" onclick="return confirmAction()">
                            Xóa &nbsp;<i class="fa fa-times" aria-hidden="true"></i>
                          </a>
                        </td>
                      </tr>
                      @endif
                    @endforeach

                @endif
               @endif
              @endforeach
            </table>
          </div>
          <!-- /.box-body -->
        </div>
      </div>
    </div>
    </section>

    <!-- ChartJS 1.0.1 -->
  <script src="{{$adminUrl}}/js/Chart.min.js"></script>

    <script>
      $(function () {
        var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
        var pieChart = new Chart(pieChartCanvas);
        var PieData = [
        @foreach ($arDemBaiViet as $key => $arDemBV)

        {
          value: {{ $arDemBV['soluong'] }},
          color: "{{ $arDemBV['color'] }}",
          highlight: "{{ $arDemBV['color'] }}",
          label: "{{ $arDemBV['cname'] }}"
        },
        @endforeach
        
        ];
        var pieOptions = {
        //Boolean - Whether we should show a stroke on each segment
        segmentShowStroke: true,
        //String - The colour of each segment stroke
        segmentStrokeColor: "#fff",
        //Number - The width of each segment stroke
        segmentStrokeWidth: 2,
        //Number - The percentage of the chart that we cut out of the middle
        percentageInnerCutout: 50, // This is 0 for Pie charts
        //Number - Amount of animation steps
        animationSteps: 100,
        //String - Animation easing effect
        animationEasing: "easeOutBounce",
        //Boolean - Whether we animate the rotation of the Doughnut
        animateRotate: true,
        //Boolean - Whether we animate scaling the Doughnut from the centre
        animateScale: false,
        //Boolean - whether to make the chart responsive to window resizing
        responsive: true,
        // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
        maintainAspectRatio: true,
        //String - A legend template
        legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
      };
      //Create pie or douhnut chart
      // You can switch between pie and douhnut using the method below.
      pieChart.Doughnut(PieData, pieOptions);
    });
  </script>    

  <script type="text/javascript">
    function confirmAction(){
      return confirm('Bạn có chắc muốn xóa?');
    }
  </script>
  @stop