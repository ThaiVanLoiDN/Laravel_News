<div class="col-lg-8 col-md-8 col-sm-8">
        <div class="slick_slider">
          @foreach ($arSlidePostes as $key => $arSlidePost)
        <?php  
        $id = $arSlidePost['id'];
        $name = $arSlidePost['name'];
        $preview = $arSlidePost['preview'];
        $nameSeo = str_slug($name);
        $picture =  ($arSlidePost['picture'] == NULL)?'noimage.jpg':$arSlidePost['picture'];
        ?>
          <div class="single_iteam"> 
          <a href="{{route('public.news.detail', ['slug' => $nameSeo, 'id' => $id])}}" title="{{$name}}"> 
          <img src="{{$imageUrl}}/{{$picture}}" alt="{{$name}}">
          </a>
            <div class="slider_article">
              <h2><a class="slider_tittle" href="{{route('public.news.detail', ['slug' => $nameSeo, 'id' => $id])}}" title="{{$name}}">{{$name}}</a></h2>
              <p>{{$preview}}</p>
            </div>
          </div>

         @endforeach
        </div>
      </div>