<{{ is_front_page() ? 'h1' : 'div' }} class="c-page-head__logo">
  <a href="{{ $siteUrl }}" rel="index">
    @if ($logo)
      <span class="u-hidden-visually">{{ $siteName }}</span>
      <img src="{{ $logo }}" alt="" />
    @else
      {{ $siteName }}
    @endif
  </a>
</{{ is_front_page() ? 'h1' : 'div' }}>
