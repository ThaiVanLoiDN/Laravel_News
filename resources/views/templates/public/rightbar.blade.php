<div class="col-lg-4 col-md-4 col-sm-4">
  <aside class="right_content">
    @include('templates.public.popular')

    <div class="single_sidebar">
      <h2><span>Bình luận gần đây</span></h2>
      <ul class="spost_nav">
        @foreach ($arComments as $key => $arComment)
        <?php  
        $nid = $arComment['nid'];
        $hoten = $arComment['hoten'];
        $name = $arComment['nname'];
        $nameSeo = str_slug($name);
        $picture =  $arComment['picture'];
        if($picture == ''){
          $picture = 'noimage.jpg';
        }
        $urlPost = route('public.news.detail', ['slug' => $nameSeo, 'id' => $nid]);
        ?>
        <li>
          <div class="media wow fadeInDown"> 
            <a href="{{ $urlPost }}" class="media-left"> 
              <img alt="{{$name}}" src="{{$imageUrl}}/{{$picture}}"> 
            </a>
            <div class="media-body"> 
              <span style="float: left;">{{$hoten}} trên </span> 
              <a href="{{ $urlPost }}" class="catg_title" alt="{{$name}}"  style="color: green;"> {{$name}}</a> 
            </div>
          </div>
        </li>
        @endforeach
      </ul>
    </div>
  </aside>
</div>