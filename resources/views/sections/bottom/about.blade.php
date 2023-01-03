@if ($aboutCopy)
  <div class="c-page-foot__column">
    <h5 class="c-page-foot__heading {{ Helper::class('c-heading', 'h6') }}">
      {{ __('About', 'chipmunk') }}
    </h5>

    <div class="c-page-foot__description c-content">
      {!! apply_shortcodes(wp_kses_post(wpautop($aboutCopy))) !!}
    </div>
  </div>
@endif
