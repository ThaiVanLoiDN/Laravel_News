@extends('templates.public.contact')
@section('main')
      <div class="col-lg-8 col-md-8 col-sm-8">
        <div class="left_content">
          <div class="error_page">
            <h3>Chúng tôi xin lỗi</h3>
            <h1>404</h1>
            <p>Rất tiếc, địa chỉ bạn đang truy cập không tồn tại.</p>
            <span></span> <a href="{{route('public.index.index')}}" class="wow fadeInLeftBig">Trở về trang chủ</a> </div>
        </div>
      </div>
      @stop