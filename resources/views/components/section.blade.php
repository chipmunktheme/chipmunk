<section class="{{ Helper::class('l-section', $type ?? '') }} {{ $class ?? '' }}" {{ $id ? "id='$id'" : '' }}>
  <div class="l-container">
    {!! $slot !!}
  </div>
</section>
