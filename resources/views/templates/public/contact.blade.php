@include('templates.public.header')
  <section id="contentSection">
    <div class="row">
      @yield('main')
      <div class="col-lg-4 col-md-4 col-sm-4">
        <aside class="right_content">
      @include('templates.public.popular')
      </aside>
      </div>
    </div>
  </section>
@include('templates.public.footer')  