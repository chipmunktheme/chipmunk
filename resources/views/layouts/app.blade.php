<!doctype html>
<html @php(language_attributes())>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @wphead
  </head>

  <body @bodyclass('l-body')>
    @wpbodyopen

    {{-- Custom global JS variables --}}
    {{-- TODO: Add current URL to the login form --}}
    @js('ajaxUrl', admin_url('admin-ajax.php'))
    @js('loginUrl', wp_login_url())

    @include('sections.header')
    @include('sections.overlay')

    <main class="l-body__bag" id="top">
      <div class="l-body__placeholder"></div>

      @hasSection('view')
        <div class="l-body__area">
          @yield('view')
        </div>
      @endif

      @include('sections.bottom')
      @include('sections.footer')
    </main>

    @wpfoot

    <!-- Made with {{ $theme->get('Name') }} v{{ $theme->get('Version') }} -->
  </body>
</html>
