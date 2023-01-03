<header class="{{ Helper::class('c-page-head', get_option('sticky_header') ? 'sticky' : '') }}" data-placehold-height="header">
  <div class="l-container">
    <div class="c-page-head__inner">
      @include('sections.header.logo')
      @include('sections.header.menu')

      <div class="c-page-head__cta">
        @include('sections.header.cta-search')
        @include('sections.header.cta-menu')

        @addonEnabled('members')
          @guest
            @include('sections.header.guest')
          @else
            @include('sections.header.user')
          @endguest
        @else
          @include('sections.header.cta-submit')
        @endif
      </div>

      @include('sections.header.search')
    </div>
  </div>
</header>
