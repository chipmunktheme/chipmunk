@set($buttonClass, Helper::class('c-button', 'primary-outline'))

<div class="c-overlay u-hidden-lg">
  <div class="c-overlay__inner">
    @include('sections.overlay.menu')

    @addonEnabled('members')
      <div class="c-overlay__bottom">
        @guest
          @include('sections.overlay.guest')
        @else
          @include('sections.overlay.cta-submit')
        @endif
      </div>
    @else
      <div class="c-overlay__bottom">
        @include('sections.overlay.cta-submit')
      </div>
    @endif
  </div>
</div>
