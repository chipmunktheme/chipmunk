@optionEnabled('search')
  <div class="c-page-head__search">
    <button type="button" data-panel="search">
      @include('partials.icon', ['icon' => 'close', 'size' => 'lg'])
      <span class="u-hidden-visually">{{ __('Close', 'chipmunk') }}</span>
    </button>

    {!! get_search_form(false) !!}
  </div>
@endoptionEnabled
