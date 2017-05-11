<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>TinHot - Trang quản trị</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link rel="shortcut icon" type="image/ico" href="{{$adminUrl}}/images/favicon.ico" />

  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{$adminUrl}}/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{$adminUrl}}/css/select2.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="{{$adminUrl}}/css/jquery-jvectormap-1.2.2.css">
  
   <!-- DataTables -->
  <link rel="stylesheet" href="{{$adminUrl}}/css/dataTables.bootstrap.css">
   <!-- Theme style -->
  <link rel="stylesheet" href="{{$adminUrl}}/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{$adminUrl}}/css/_all-skins.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{$adminUrl}}/css/blue.css">
  <link rel="stylesheet" href="{{$adminUrl}}/css/style.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <!-- jQuery 2.2.3 -->
  <script src="{{$adminUrl}}/js/jquery-2.2.3.min.js"></script>
  <!-- jQuery Validate -->
  <script src="{{$adminUrl}}/js/jquery.validate.js"></script>
  <script src="{{$adminUrl}}/js/validate.js"></script>
  <!-- Bootstrap 3.3.6 -->
  <script src="{{$adminUrl}}/js/bootstrap.min.js"></script>
  <!-- AdminLTE App -->
  <script src="{{$adminUrl}}/js/app.min.js"></script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">