<!DOCTYPE html>
<html>
<head>
  <?php $title = (isset($title)) ?  $title.' - '.$nameWebsite :  $nameWebsite; ?>
  <title>{{ $title }}</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" type="image/ico" href="{{$publicUrl}}/images/favicon.ico" />
  <link rel="stylesheet" type="text/css" href="{{$publicUrl}}/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="{{$publicUrl}}/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="{{$publicUrl}}/css/animate.css">
  <link rel="stylesheet" type="text/css" href="{{$publicUrl}}/css/font.css">
  <link rel="stylesheet" type="text/css" href="{{$publicUrl}}/css/li-scroller.css">
  <link rel="stylesheet" type="text/css" href="{{$publicUrl}}/css/slick.css">
  <link rel="stylesheet" type="text/css" href="{{$publicUrl}}/css/jquery.fancybox.css">
  <link rel="stylesheet" type="text/css" href="{{$publicUrl}}/css/theme.css">
  <link rel="stylesheet" type="text/css" href="{{$publicUrl}}/css/style.css">
  <link rel="stylesheet" type="text/css" href="{{$publicUrl}}/css/styles.css">

  <meta name="robots" content="noodp"/>
  <meta name="keywords" content="{{$nameWebsite}}"/>
  <link rel="canonical" href="{{getenv('APP_URL')}}" />
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <meta property="og:locale" content="en_US" />
  <meta property="og:type" content="article" />
  <meta property="og:title" content="{{$nameWebsite}}" />

  <meta property="og:url" content="{{ $diachiWebsite}}/{{ Request::path() }}" />

  <?php if(isset($motaSeo)){ 
    ?>
    <meta property="og:description" content="{{$motaSeo}}" />
    <meta name="description" content="{{$motaSeo}}"/>
    <?php
  }else{
    ?>
    <meta name="description" content="{{$sloganWebsite}}"/>
    <meta property="og:description" content="{{$sloganWebsite}}" />
    <?php
  }
  ?>

  <meta property="og:url" content="{{getenv('APP_URL')}}" />
  <meta property="og:site_name" content="{{$nameWebsite}}" />

  <script src="{{$publicUrl}}/js/jquery.min.js"></script> 
  <script src="{{$publicUrl}}/js/bootstrap.min.js"></script> 

  <script src="{{$publicUrl}}/js/jquery.validate.js"></script>
  <script src="{{$publicUrl}}/js/validate.js"></script>
<!--[if lt IE 9]>
<script src="{{$publicUrl}}/js/html5shiv.min.js"></script>
<script src="{{$publicUrl}}/js/respond.min.js"></script>
<![endif]-->
</head>
<body>
  <div id="preloader">
    <div id="status">&nbsp;</div>
  </div>
  <a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>
  <div class="container">
    <header id="header">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <div class="header_top">
            <div class="header_top_left">
              <ul class="top_nav">
                <li><a href="{{route('public.index.index')}}">Trang chủ</a></li>
                <li><a href="{{route('public.contact.index')}}">Liên hệ</a></li>
              </ul>
            </div>
            <div class="header_top_right">
              <p><?php echo 'Ngày '.date('d-m-Y') ?></p>
            </div>
          </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12">
          <div class="header_bottom">
            <div class="logo_area"><a href="{{route('public.index.index')}}" class="logo"><img src="{{ $imageUrl }}/{{ $logo }}" alt=""></a></div>
          </div>
        </div>
      </div>
    </header>
    <section id="navArea">
      <nav class="navbar navbar-inverse" role="navigation">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav main_nav">
            <li <?php echo (Request::path()== '/' ? 'class="active"' : '')?>><a href="{{route('public.index.index')}}"><span class="fa fa-home desktop-home"></span><span class="mobile-show">Home</span></a></li>
            <?php $arMenuCon = $arMenu; ?>
            @foreach ($arMenu as $key => $arMn)
            @if($arMn['parent_cate'] == 'khongcon')
            <li <?php if(isset($id_cm) && ($id_cm == $arMn['id'])){ echo 'class="active"'; }?> > 
              <a href="{{ route('public.news.cat', ['slug' => str_slug($arMn['name']), 'id' =>$arMn['id'] ]) }}" title="{{ $arMn['name'] }}">{{ $arMn['name'] }}</a>
            </li>
            @endif
            @if($arMn['parent_cate'] == 'cocon')
            <li class="dropdown <?php if(isset($id_cm) && ($id_cm == $arMn['id'])){ echo 'active'; }?>"> 
              <a href="{{ route('public.news.cat', ['slug' => str_slug($arMn['name']), 'id' =>$arMn['id'] ]) }}" title="{{ $arMn['name'] }}">{{ $arMn['name'] }}</a>
              <ul class="dropdown-menu" role="menu">
                @foreach ($arMenuCon as $key => $arMnC)
                @if($arMnC['parent_cate'] == 'con' && $arMnC['parent_id'] == $arMn['id'])
                <li <?php if(isset($id_cm) && ($id_cm == $arMnC['id'])){ echo 'class="active"'; }?> ><a href="{{ route('public.news.cat', ['slug' => str_slug($arMnC['name']), 'id' =>$arMnC['id'] ]) }}" title="{{ $arMnC['name'] }}">{{ $arMnC['name'] }}</a></li>
                @endif
                @endforeach
              </ul>
            </li>
            @endif
            @endforeach
          </ul>
        </div>
      </nav>
    </section>
    <section id="newsSection">
      <div class="row">
        <div class="col-lg-12 col-md-12">
          <div class="latest_newsarea"> <span>Bài viết mới nhất</span>
            <ul id="ticker01" class="news_sticker">
              @foreach ($arNewPostes as $key => $arNewPost)
              <?php  
              $id = $arNewPost['id'];
              $name = $arNewPost['name'];
              $nameSeo = str_slug($name);

              $picture =  ($arNewPost['picture'] == NULL)?'noimage.jpg':$arNewPost['picture'];
              ?>
              <li><a href="{{route('public.news.detail', ['slug' => $nameSeo, 'id' => $id])}}"><img src="{{$imageUrl}}/{{$picture}}" alt="{{$name}}">{{$name}}</a></li>
              @endforeach
            </ul>
            <div class="social_area">
              <ul class="social_nav">
                @foreach ($arMangXaHoi as $key => $arMXH)
                
                <li class="{{ $arMXH['name'] }}"><a href="{{ $arMXH['giatri'] }}" target="_blank"></a></li>
                @endforeach
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>

