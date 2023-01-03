<form
  action="{{ $siteUrl }}"
  method="get"
  role="search"
  class="{{ Helper::class('c-form', ['inline', isset($narrow) ? 'narrow' : '']) }}"
  novalidate
  data-validate
  autocomplete="off"
>
  <span class="u-hidden-visually">
    {{ _x('Search for:', 'label', 'chipmunk') }}
  </span>

	<div class="c-form__field">
		<input
      type="text"
      name="s"
      placeholder="{{ __('Search query...', 'chipmunk') }}"
      value="{{ get_search_query() }}"
      class={{ Helper::class('c-form__input', isset($default) ? 'default' : '') }}"
      required
      minlength="3"
    >

		<button type="submit" class="c-form__button">
      @include('partials.icon', ['icon' => 'search'])
      <span class="u-hidden-visually">{{ _x('Search', 'submit button', 'chipmunk') }}</span>
    </button>
	</div>
</form>
