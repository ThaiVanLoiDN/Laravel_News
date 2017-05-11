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
      <li class="active">Bài viết</a></li>
    </ol>
  </section>

  <!-- Add Cats -->
  <section class="content">
    <div class="row">
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
                          @foreach ($arCats as $key => $arCat)
                          <option value="{{$arCat['id']}}">{{$arCat['name']}}</option>
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

      //-------------
      //- BAR CHART -
      //-------------
      var barChartCanvas = $("#barChart").get(0).getContext("2d");
      var barChart = new Chart(barChartCanvas);
      var barChartData = areaChartData;
      barChartData.datasets[1].fillColor = "#00a65a";
      barChartData.datasets[1].strokeColor = "#00a65a";
      barChartData.datasets[1].pointColor = "#00a65a";
      var barChartOptions = {
        //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
        scaleBeginAtZero: true,
        //Boolean - Whether grid lines are shown across the chart
        scaleShowGridLines: true,
        //String - Colour of the grid lines
        scaleGridLineColor: "rgba(0,0,0,.05)",
        //Number - Width of the grid lines
        scaleGridLineWidth: 1,
        //Boolean - Whether to show horizontal lines (except X axis)
        scaleShowHorizontalLines: true,
        //Boolean - Whether to show vertical lines (except Y axis)
        scaleShowVerticalLines: true,
        //Boolean - If there is a stroke on each bar
        barShowStroke: true,
        //Number - Pixel width of the bar stroke
        barStrokeWidth: 2,
        //Number - Spacing between each of the X value sets
        barValueSpacing: 5,
        //Number - Spacing between data sets within X values
        barDatasetSpacing: 1,
        //String - A legend template
        legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
        //Boolean - whether to make the chart responsive
        responsive: true,
        maintainAspectRatio: true
      };

      barChartOptions.datasetFill = false;
      barChart.Bar(barChartData, barChartOptions);
    });
  </script>    

  <script type="text/javascript">
    function confirmAction(){
      return confirm('Bạn có chắc muốn xóa?');
    }
  </script>
  @stop