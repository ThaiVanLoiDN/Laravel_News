<footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      thaivanloidn@gmail.com
    </div>
    <!-- Default to the left -->
    <strong>{{ $nameWebsite }} &copy; 2016 <a href="http://www.facebook.com/ThaiVanLoiDN" title="Thái Văn Lợi" target="_blank">Thái Văn Lợi</a>.</strong>
  </footer>

  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->
<!-- Slimscroll -->
<script src="{{$adminUrl}}/js/jquery.slimscroll.min.js"></script>

<script src="{{$adminUrl}}/js/fastclick.js"></script>
<script src="{{$adminUrl}}/js/demo.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{$adminUrl}}/js/bootstrap3-wysihtml5.all.min.js"></script>
<script type="text/javascript">
  $(function(){

    var url = window.location.pathname, 
    urlRegExp = new RegExp(url.replace(/\/$/,'') + "$");
    $('.sidebar-menu a').each(function(){
      if(urlRegExp.test(this.href.replace(/\/$/,''))){
        $(this).parent().addClass('active');
        $(this).parent().parent().parent().addClass('active');
      }
    });

  });
</script>
</body>
</html>
