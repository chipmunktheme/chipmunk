<div class="c-menu-toolbox u-dropdown__trigger">
  <button class="c-menu-toolbox__dropdown" data-dropdown="click">
    <div class="u-avatar">
      <img src="{{ get_avatar(get_current_user_id(), 64) }}" alt="">
    </div>

    @include('partials.icon', ['icon' => 'chevron-down', 'size' => 'sm'])
  </button>

  <nav class="{{ Helper::class('u-dropdown', get_option('dropdown_theme')) }}">
    <a href="{{ get_members_link('dashboard') }}" class="u-dropdown__link">
      {{ __('Dashboard', 'chipmunk') }}
    </a>

    @optionEnabled('user_profiles')
      <a href="{{ user.path }}" class="u-dropdown__link">
        {{ __('Profile', 'chipmunk') }}
      </a>
    @endoptionEnabled

    <a href="{{ get_members_link('profile') }}" class="u-dropdown__link">
      {{ __('Edit Profile', 'chipmunk') }}
    </a>

    @include('partials.submit-button', ['class' => 'u-dropdown__link'])

    <a href="{{ wp_logout_url() }}" class="u-dropdown__link">
      {{ __('Logout', 'chipmunk') }}
    </a>
  </nav>
</div>
