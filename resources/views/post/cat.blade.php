@extends('templates.public.contact')
@section('main')

<div class="col-lg-8 col-md-8 col-sm-8">
  <div class="left_content">
    <div class="single_page">
      <ol class="breadcrumb">
        <li><a>{{ $name[0]['name'] }}</a></li>
      </ol>

      <!-- ----------------- -->

      <div class="single_post_content">
        @if(count($arNews) == 0)
          <div>
          <p class="text-center" style="font-size: 25px;">Chuyên mục này không có bài đăng nào</p>
            
          </div>
        @endif
        @foreach ($arNews as $key => $arTT)
        <?php  
        $nid = $arTT['id'];
        $cid = $arTT['cat_id'];
        $nname = $arTT['name'];
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
        @if ($key %2 == 0)
        <div class="single_post_content_left">
          @else
          <div class="single_post_content_right">
            @endif
            <div class="spost_nav">
              <div class="media wow fadeInDown"> 
                <a href="{{ $urlPost }}" class="media-left" title="{{ $nname }}"> 
                  <img alt="{{ $nname }}" src="{{ $imageUrl }}/{{ $picture }}"> 
                </a>
                <div class="media-body"> 
                  <a href="{{ $urlPost }}" class="catg_title" title="{{ $nname }}"> {{ $nname }}</a>
                </div>
              </div>
            </div>
          </div>
          @endforeach
        </div>

        <div class="pull-right">
          
           {{ $arNews->links() }}
        </div>

        <!-- ----------------- -->
      </div>
    </div>
  </div>
  <script type="text/javascript">
  window.history.pushState('page2', 'Title', "{{  route('public.news.cat', ['slug' => str_slug($name[0]['name']), 'id' => $name[0]['id']]) }}");
</script>

  @stop      