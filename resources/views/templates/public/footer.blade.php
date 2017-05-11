<footer id="footer">
  <div class="footer_top">
    <div class="row">
      <div class="col-lg-4 col-md-4 col-sm-4">
        <div class="footer_widget wow fadeInLeftBig">
          <h2>Google Map</h2>
          <div id="map"></div>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4">
        <div class="footer_widget wow fadeInDown">
          <h2>Theo dõi</h2>
          <ul class="tag_nav">
            @foreach ($arMangXaHoi as $key => $arMXH)
            <li class="text-uppercase"><a href="{{ $arMXH['giatri'] }}" target="_blank">{{ $arMXH['name'] }}</a></li>
            @endforeach
          </ul>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4">
        <div class="footer_widget wow fadeInRightBig">
          <h2>{{ $nameWebsite }}</h2>
          <p>{!! $thongtinlienhe !!}</p>
        </div>
      </div>
    </div>
  </div>
  <div class="footer_bottom">
    <p class="copyright">Copyright &copy; 2017 <a href="{{route('public.index.index')}}">{{$nameWebsite}}</a></p>
    <p class="developer">Developed By Thái Văn Lợi</p>
  </div>
</footer>
</div>

<script src="{{$publicUrl}}/js/wow.min.js"></script> 
<script src="{{$publicUrl}}/js/slick.min.js"></script> 
<script src="{{$publicUrl}}/js/jquery.li-scroller.1.0.js"></script> 
<script src="{{$publicUrl}}/js/jquery.newsTicker.min.js"></script> 
<script src="{{$publicUrl}}/js/jquery.fancybox.pack.js"></script> 
<script src="{{$publicUrl}}/js/custom.js"></script>

<script>
  function initMap() {
    var uluru = {lat: {{ $vido }}, lng: {{ $kinhdo }}};
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 15,
      center: uluru
    });
    var marker = new google.maps.Marker({
      position: uluru,
      map: map
    });
  }
</script>
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCXIPN4cSUCwBcs3W4i8VnzVf2qqL6IBN8&callback=initMap">
</script>

<script type="text/javascript">
  $(function(){
    $('.main_nav .dropdown .dropdown-menu .active').each(function(){
      $(this).parent().parent().addClass('active');
      
    });

  });
</script>






<script src="{{$publicUrl}}/js/jquery.lazyload.min.js"></script>

<script type="text/javascript">
  $(function() {
    $(".noi-dung-bai-viet img").lazyload();
});
</script>
</body>
</html>