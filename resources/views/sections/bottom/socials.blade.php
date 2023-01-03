@if ($socialLinks)
  <div class="c-page-foot__column u-visible-lg-flex">
    <h5 class="c-page-foot__heading {{ Helper::class('c-heading', 'h6') }}">
      {{ __('Follow', 'chipmunk') }}
    </h5>

    <nav class="c-menu-secondary">
      @foreach ($socialLinks as $key => $value)
        <a href="{{ $value }}" class="c-menu-secondary__link" target="_blank" rel="nofollow">
          {{ $key }}
        </a>
      @endforeach
    </nav>
  </div>
@endif
