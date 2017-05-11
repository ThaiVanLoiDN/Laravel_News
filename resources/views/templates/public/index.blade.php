@include('templates.public.header')
  <section id="sliderSection">
    <div class="row">
      @include('templates.public.banner')
      @include('templates.public.latest')
    </div>
  </section>
  <section id="contentSection">
    <div class="row">
      @yield('main')
      @include('templates.public.rightbar')  
    </div>
  </section>
@include('templates.public.footer')