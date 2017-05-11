@extends('templates.admin.template')
@section('main')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Admin
    <small>Trang chủ</small>
  </h1>
  <ol class="breadcrumb">
    <li class="active"><i class="fa fa-dashboard"></i> Trang chủ</li>
  </ol>

</section>


<!-- Main content -->
<section class="content">

  <div class="row">
    @if(Auth::user()->capbac == 1)
    <div class="col-md-12">
      <div class="callout callout-warning">
        <h4>Trial Mod!</h4>

        <p>Bạn là trial mod nên chỉ có thể XEM các chức năng của quản trị viên, chứ không thể thêm, sửa, xóa các bài viết, chuyên mục, người dùng,...</p>
      </div>
    </div>
    @endif
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-aqua"><i class="fa fa-file-o"></i></span>

        <div class="info-box-content">
          <span class="info-box-text"><a href="{{ route('admin.news.index') }}">Bài viết</a></span>
          <span class="info-box-number">{{ $arThongKe['soBai'] }}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-red"><i class="fa fa-comment-o"></i></span>

        <div class="info-box-content">
          <span class="info-box-text"><a href="{{ route('admin.comments.index') }}">Bình luận</a></span>
          <span class="info-box-number">{{ $arThongKe['soCmt'] }}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->

    <!-- fix for small devices only -->
    <div class="clearfix visible-sm-block"></div>

    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-green"><i class="fa fa-user"></i></span>

        <div class="info-box-content">
          <span class="info-box-text"><a href="{{ route('admin.users.index') }}">Quản trị viên</a></span>
          <span class="info-box-number">{{ $arThongKe['soNguoi'] }}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-yellow"><i class="fa fa-envelope-o"></i></span>

        <div class="info-box-content">
          <span class="info-box-text"><a href="{{ route('admin.contacts.index') }}">Liên hệ</a></span>
          <span class="info-box-number">{{ $arThongKe['soMail'] }}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
  </div>



  <div class="row">
    <div class="col-md-6">
      <!-- DONUT CHART -->
      <div class="box box-danger">
        <div class="box-header with-border">
          <h3 class="box-title">Bài viết chuyên mục</h3>

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
    <!-- /.col (LEFT) -->
    <div class="col-md-6">

      <!-- BAR CHART -->
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Số bài viết của quản trị viên</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <div class="chart">
            <canvas id="barChart" style="height:230px"></canvas>
          </div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

    </div>
    <!-- /.col (RIGHT) -->
  </div>
</section>
<!-- /.content -->
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
        segmentShowStroke: true,
        segmentStrokeColor: "#fff",
        segmentStrokeWidth: 2,
        percentageInnerCutout: 50,
        animationSteps: 100,
        animationEasing: "easeOutBounce",
        animateRotate: true,
        animateScale: false,
        responsive: true,
        maintainAspectRatio: true,
        legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
      };
      pieChart.Doughnut(PieData, pieOptions);
      
    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $("#barChart").get(0).getContext("2d");
    var barChart = new Chart(barChartCanvas);
    var barChartData = {
      labels: [

      @foreach ($arDemPostUser as $key => $arDemPost)
        
      "{{ $arDemPost['uname']}}",
      @endforeach

      ],
      datasets: [
      {
        label: "Electronics",
        fillColor: "rgba(210, 214, 222, 1)",
        strokeColor: "rgba(210, 214, 222, 1)",
        pointColor: "rgba(210, 214, 222, 1)",
        pointStrokeColor: "#c1c7d1",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "rgba(220,220,220,1)",
        data: [
        
        @foreach ($arDemPostUser as $key => $arDemPost)
        "{{ $arDemPost['soluong']}}",
        @endforeach
        ]
      }
      ]
    };

    barChartData.datasets[0].fillColor = "#00a65a";
    barChartData.datasets[0].strokeColor = "#00a65a";
    barChartData.datasets[0].pointColor = "#00a65a";
    
    var barChartOptions = {
      scaleBeginAtZero: true,
      scaleShowGridLines: true,
      scaleGridLineColor: "rgba(0,0,0,.05)",
      scaleGridLineWidth: 1,
      scaleShowHorizontalLines: true,
      scaleShowVerticalLines: true,
      barShowStroke: true,
      barStrokeWidth: 2,
      barValueSpacing: 5,
      barDatasetSpacing: 1,
      legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
      responsive: true,
      maintainAspectRatio: true
    };

    barChartOptions.datasetFill = false;
    barChart.Bar(barChartData, barChartOptions);
  });
</script>   
@stop