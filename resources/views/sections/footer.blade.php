<x-section type="compact" class="c-page-foot">
  <div class="c-page-foot__inner">
    <p class="c-page-foot__copy">
      {{ apply_shortcodes(wp_kses_post(get_option('copyright_text'))) }}
    </p>

    @optionEnabled('credits')
      {{-- {% set credits %}
        {{ __('Made with %s', 'chipmunk') | format(get_theme_property('name')) }}
        @asset('images/logo.svg')->contents
      {% endset %} --}}

      {{-- {{ get_external_link('https://chipmunktheme.com', credits, {
        class: 'c-page-foot__credits',
        rel: null,
      }) }} --}}
    @endoptionEnabled
  </div>
</x-section>
