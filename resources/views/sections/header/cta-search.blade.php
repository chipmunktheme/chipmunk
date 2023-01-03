@optionEnabled('search')
  <button class="c-page-head__icon" data-panel="search">
    @include('partials.icon', ['icon' => 'search', 'size' => 'lg'])
    <span class="u-hidden-visually">{{ __('Search', 'chipmunk') }}</span>
  </button>
@endoptionEnabled
