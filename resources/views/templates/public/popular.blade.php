
<div class="single_sidebar">
  <h2><span>Bài viết HOT nhất</span></h2>
  <ul class="spost_nav">
    @foreach ($arNewPostes as $key => $arNewPost)
    <?php  
    $id = $arNewPost['id'];
    $name = $arNewPost['name'];
    $nameSeo = str_slug($name);
    $picture =  ($arNewPost['picture'] == NULL)?'noimage.jpg':$arNewPost['picture'];
    ?>
    <li>
      <div class="media wow fadeInDown"> 
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
</div>
