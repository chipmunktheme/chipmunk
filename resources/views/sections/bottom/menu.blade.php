{{-- {% if menu.items or not get_option('disable_submissions') %}
  <div class="c-page-foot__column">
    <h5 class="c-page-foot__heading {{ Helper::class('c-heading', 'h6') }}">
      {{ __('Navigation', 'chipmunk') }}
    </h5>

    {% embed 'partials/menu.twig' with { type: 'secondary', items: menu.items } %}
      {% block extra_items %}
        {% if not get_option('disable_submissions') %}
          <li class="{{ item_class }}">
            {% include 'partials/submit-button.twig' with { class: link_class } %}
          </li>
        {% endif %}
      {% endblock %}
    {% endembed %}
  </div>
{% endif %} --}}
