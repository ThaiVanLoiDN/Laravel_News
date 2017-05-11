<div class="col-lg-4 col-md-4 col-sm-4">
  <div class="latest_post">
    <h2><span>Bài viết mới nhất</span></h2>
    <div class="latest_post_container">
      <div id="prev-button"><i class="fa fa-chevron-up"></i></div>
      <ul class="latest_postnav">
        @foreach ($arNewPostes as $key => $arNewPost)
        <?php  
        $id = $arNewPost['id'];
        $name = $arNewPost['name'];
        $nameSeo = str_slug($name);
        $picture =  ($arNewPost['picture'] == NULL)?'noimage.jpg':$arNewPost['picture'];
        ?>
        <li>
          <div class="media"> 
          <a href="{{route('public.news.detail', ['slug' => $nameSeo, 'id' => $id])}}" class="media-left"> 
          <img alt="{{$name}}" src="{{$imageUrl}}/{{$picture}}"> 
          </a>
            <div class="media-body"> 
            <a href="{{route('public.news.detail', ['slug' => $nameSeo, 'id' => $id])}}" class="catg_title" alt="{{$name}}">{{$name}}</a> 
            </div>
          </div>
        </li>
          @endforeach
      </ul>
      <div id="next-button"><i class="fa  fa-chevron-down"></i></div>
    </div>
  </div>
</div>