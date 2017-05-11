@extends('templates.public.index')
@section('main')

<div class="col-lg-8 col-md-8 col-sm-8">
  <div class="left_content">

    @foreach ($arCats as $key => $arCat)
    <?php  
    $cid = $arCat['id'];
    $cname = $arCat['name'];
    $cnameSeo = str_slug($cname);
    ?>

    @if(isset($arNews[$cid][0]))
    <div class="single_post_content">
      <h2><span><a href="{{route('public.news.cat', ['slug' => $cnameSeo, 'id' => $cid])}}">{{ $cname }}</a></span></h2>
      <div class="single_post_content_left">
        <ul class="business_catgnav  wow fadeInDown">
          @foreach ($arNews[$cid] as $key => $arTT)
          <?php  
          $nid = $arTT['nid'];
          $nname = $arTT['nname'];
          $picture = $arTT['picture'];
          $preview = $arTT['preview'];
          if($picture == ''){
            $picture = 'noimage.jpg';
          }
          if (!File::exists('storage/app/files/'.$picture))
          {
            $picture = 'error.jpg';
          }

          $nameSeo = str_slug($nname);
          $urlPost = route('public.news.detail', ['slug' => $nameSeo, 'id' => $nid]);

          ?>
          @if($key == 0)
          <li>
            <figure class="bsbig_fig"> 
              <a href="{{ $urlPost }}" class="featured_img" title="{{ $nname }}"> 
                <img alt="{{ $nname }}" src="{{ $imageUrl }}/{{ $picture }}"> 
                <span class="overlay"></span> 
              </a>
              <figcaption> 
                <a href="{{ $urlPost }}" title="{{ $nname }}">{{ $nname }}</a> 
              </figcaption>
              <p>{{ $preview }}</p>
            </figure>
          </li>
        </ul>
      </div>
      <div class="single_post_content_right">
        <ul class="spost_nav">
          @else
          <li>
            <div class="media wow fadeInDown"> 
              <a href="{{ $urlPost }}" class="media-left" title="{{ $nname }}"> 
                <img alt="{{ $nname }}" src="{{ $imageUrl }}/{{ $picture }}"> 
              </a>
              <div class="media-body"> 
                <a href="{{ $urlPost }}" class="catg_title" title="{{ $nname }}"> {{ $nname }}</a>
              </div>
            </div>
          </li>
          @endif
          @endforeach
        </ul>
      </div>
    </div>
    @endif
    @endforeach
  </div>
</div>
@stop