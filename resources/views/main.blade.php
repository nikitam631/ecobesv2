<!DOCTYPE html>
<html lang="en">
  @include('partials._head')
  <body>

    @include('partials._menu')

    <div class="container">
      @yield('content')
    </div>
    @include('partials._footer')
    @include('partials._javascript')

  </body>
</html>
