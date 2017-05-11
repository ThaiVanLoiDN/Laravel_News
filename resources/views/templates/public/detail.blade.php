@include('templates.public.header')
  <section id="contentSection">
    <div class="row">
      @yield('main')
      @include('templates.public.rightbar')
    </div>
  </section>
 @include('templates.public.footer')