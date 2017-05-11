@extends('templates.public.detail')
@section('main')

@foreach ($arNews as $key => $arItem)
<?php  

$id = $arItem['id'];
$nname = $arItem['nname'];
$cname = $arItem['cname'];
$cid = $arItem['cat_id'];
$uname = $arItem['uname'];
$cat_id = $arItem['cat_id'];
$detail = $arItem['detail'];
$created_at = date('d-m-Y', strtotime($arItem['created_at']));
$luocdoc = $arItem['luocdoc'];
?>  
@endforeach
<div class="col-lg-8 col-md-8 col-sm-8">
  <div class="left_content">
    <div class="single_page">
      <ol class="breadcrumb">
        <li><a href="{{ route('public.news.cat', ['slug' => str_slug($cname), 'id' => $cid]) }}">{{$cname}}</a></li>
      </ol>
      <h1>{{$nname}}</h1>
      <div class="post_commentbox"> 
        <div class="row">
          <div class="col-xs-9">
            <span><i class="fa fa-user"></i>{{$uname}}</span> <span><i class="fa fa-calendar"></i>Ngày {{$created_at}}</span> <a href="{{ route('public.news.cat', ['slug' => str_slug($cname), 'id' => $cid]) }}"><i class="fa fa-tags"></i>{{$cname}}</a> 
          </div>
          <div class="col-xs-3 text-right">
            <span><i class="fa fa-eye"></i>{{$luocdoc}}</span>
          </div>
        </div>
        
      </div>
      <div class="single_page_content">
        <div class="noi-dung-bai-viet">
         {!!$detail!!}
       </div>
     </div>
     <div class="social_link">
       <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-588f4067e9013c65"></script> 
       <div class="addthis_inline_share_toolbox_8u0w"></div>
     </div>
     <div class="binh-luan">
      <h2>Bình luận</h2>
      <br>
      <div class="row">
        <div class="col-md-12">
          <div class="show-comment">
            @foreach ($arCommentPosts as $key => $arCommentP)
            @if($arCommentP['parent_id'] == 0)
            <div class="comment">
              <div class="row">
                <div class="col-md-12">
                  <p class="text-grey text-justify">{{ $arCommentP['content'] }}</p>
                </div>
              </div>
              <div class="row nguoi-comment">
                <div class="col-xs-11">
                  <h5>{{ $arCommentP['hoten'] }} <span> lúc {{ $arCommentP['created_at'] }}</span></h5> 
                </div>
                <div class="col-xs-1">
                  <h5 class="text-right"><a href="javascript:void(0)"  onclick="openform({{ $arCommentP['id'] }})"><i class="fa fa-reply" aria-hidden="true"></i></a></h5>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 phan-hoi">
                  <!-- ----------------------------- -->
                  <div id="open-form-{{ $arCommentP['id'] }}"  style="display:none">
                    <form action="javascript:void(0)" class="contact_form form-{{ $arCommentP['id'] }}" method="post" novalidate="novalidate">
                      {{ csrf_field() }}
                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-6">
                            <input class="form-control" name="hotenr" type="text" placeholder="Họ tên (*)">                          
                          </div>
                          <div class="col-md-6">
                            <input class="form-control" name="emailr" type="email" placeholder="Email (*)">
                          </div>
                        </div>
                      </div>
                      <div class="form-group nhap-binh-luan">
                        <div class="row">
                          <div class="col-md-12">
                            <textarea name="contentr" class="form-control" style="height: 100px" placeholder="Nội dung phản hồi (*)"></textarea>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-12 thong-bao-{{ $arCommentP['id'] }}">
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-6">
                            <input type="submit" value="Phản hồi" onclick="reply({{ $arCommentP['id'] }})">
                            <a class="loading" style="display:none">
                              <img src="/resources/assets/templates/public/images/loading.gif" width="40px">
                            </a>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- ----------------------------- -->
                </div>
              </div>
            </div>
            @foreach ($arCommentPosts as $key => $arCommentP2)
            @if($arCommentP2['parent_id'] == $arCommentP['id'])
            <div class="reply">
              <h5>{{ $arCommentP2['hoten'] }} <span> lúc {{ $arCommentP2['created_at'] }}</span></h5> 
              <p class="text-grey text-justify">{{ $arCommentP2['content'] }}</p>
            </div>
            @endif
            @endforeach
            @endif
            @endforeach 
          </div>
        </div>
      </div>
      <form action="javascript:void(0)" class="contact_form" method="post" id="comment">
        {{csrf_field()}}

        <div class="form-group">
          <div class="row">
            <div class="col-md-6">
              <input class="form-control" name="hoten" type="text" placeholder="Họ tên (*)">
            </div>
            <div class="col-md-6">
              <input class="form-control" name="email" type="email" placeholder="Email (*)">
            </div>
          </div>
        </div>
        <div class="form-group nhap-binh-luan">
          <div class="row">
            <div class="col-md-12">
              <textarea id="compose-textarea" name="content" class="form-control" style="height: 100px" placeholder="Nội dung bình luận (*)"></textarea>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-md-12">
              <div class="thong-bao">
              </div>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-md-6">
              <input type="submit" value="Bình luận">
              <a id='loadingmessage' style='display:none'>
                <img src='{{ $publicUrl }}/images/loading.gif' width="40px">
              </a>
            </div>
          </div>
        </div>
      </form>
      <hr>
    </div>
    <div class="related_post">
      <h2>Bài đăng khác <i class="fa fa-thumbs-o-up"></i></h2>
      <ul class="spost_nav wow fadeInDown animated">
        @foreach ($arNewsOther as $key => $arNewsOt)
        <?php  
        $oid = $arNewsOt['id'];
        $oname = $arNewsOt['name'];
        $opicture = $arNewsOt['picture'];

        if($opicture == ''){
          $opicture = 'noimage.jpg';
        }

        $nameSeo = str_slug($oname);
        $urlPost = route('public.news.detail', ['slug' => $nameSeo, 'id' => $oid]);

        ?>
        <li>
          <div class="media"> 
            <a class="media-left" href="{{ $urlPost }}" title="{{ $oname }}"> 
              <img src="{{$imageUrl}}/{{ $opicture }}" alt="{{ $oname }}"> 
            </a>
            <div class="media-body"> 
              <a class="catg_title" href="{{ $urlPost }}" title="{{ $oname }}">{{ $oname }}</a>
            </div>
          </div>
        </li>
        @endforeach
      </ul>
    </div>
  </div>
</div>
</div>
<script type="text/javascript">
  window.history.pushState('page2', 'Title', "{{  route('public.news.detail', ['slug' => str_slug($nname), 'id' => $id]) }}");
</script>

<script type="text/javascript">
  $(function(){
    $(document).on('submit','#comment', function(){
      var hoten = $( "input[name='hoten']").val();
      var email = $( "input[name='email']").val();
      var _token = $( "input[name='_token']").val();
      var content = $( "textarea[name='content']").val();
      var news_id = {{ $id }};

      $('#loadingmessage').show();
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        url: "{{ route('public.news.comment', $id) }}",
        type: 'POST',
        cache: false,
        data: {
          ahoten: hoten,
          aemail: email,
          acontent: content,
          anews_id: news_id,
          token: _token
        },
        success: function(data){
          $('#loadingmessage').hide();
          $('.thong-bao').html(data);
        },
        error: function (){
          alert('Có lỗi');
        }
      });   
    });
  });
</script>

<script type="text/javascript">
  function reply(id_cmt){
    var hoten = $('#open-form-'+ id_cmt + " input[name='hotenr']").val();
    var email = $('#open-form-'+ id_cmt +  " input[name='emailr']").val();
    var _token = $('#open-form-'+ id_cmt +  " input[name='_token']").val();
    var content = $('#open-form-'+ id_cmt +  " textarea[name='contentr']").val();
    var news_id = {{ $id }};

    $('.loading').show();
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      url: "{{ route('public.news.reply', $id) }}",
      type: 'POST',
      cache: false,
      data: {
        ahoten: hoten,
        aemail: email,
        acontent: content,
        anews_id: news_id,
        aid_cmt: id_cmt,
        token: _token
      },
      success: function(data){
        $('.loading').hide();
        $('.thong-bao-'+id_cmt).html(data);
      },
      error: function (){
        alert('Có lỗi');
      }
    });  
  }
</script>

<script type="text/javascript">
  function openform(id){
    @foreach ($arCommentPosts as $key => $arCommentP)
    $('#open-form-'+{{ $arCommentP['id']}}).hide();
    @endforeach
    $('#open-form-'+id).show();
  }
</script>

@stop      