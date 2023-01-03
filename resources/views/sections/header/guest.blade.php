<a href="{{ get_members_link('login') }}" class="{{ Helper::class('c-button', 'primary-outline') }} u-visible-lg-block">
  {{ __('Login', 'chipmunk') }}
</a>

@if (get_option('users_can_register'))
  <a href="{{ get_members_link('register') }}" class="{{ Helper::class('c-button', 'primary-outline') }} u-visible-lg-block">
    {{ __('Register', 'chipmunk') }}
  </a>
@endif
