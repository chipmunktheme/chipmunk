<?php $providers = array(
  array(
    'name' => 'Twitter',
    'slug' => 'twitter',
    'href' => 'https://twitter.com/share?url=%url%&amp;text=%title%',
  ),
  array(
    'name' => 'Facebook',
    'slug' => 'facebook',
    'href' => 'https://facebook.com/sharer.php?u=%url%&amp;t=%title%+%url%',
  ),
  array(
    'name' => 'Pinterest',
    'slug' => 'pinterest',
    'href' => 'https://pinterest.com/pin/create/button/?url=%url%&media=%image%&description=%title%',
  ),
); ?>

<nav class="nav-socials">
  <h4 class="nav-socials__title visible-sm-block"><?php _e('Share', 'chipmunk'); ?></h4>
  <ul>
    <?php foreach ($providers as $provider) : ?>
      <li class="nav-socials__item">
        <?php
        $link = strtr($provider['href'], array(
          '%url%'   => esc_url(get_permalink()),
          '%image%' => esc_url(get_the_post_thumbnail_url()),
          '%title%' => urlencode(get_the_title()),
        ));
        ?>

        <a href="<?php echo $link; ?>" title="<?php echo $provider['name']; ?>" target="_blank">
          <i class="icon icon_<?php echo $provider['slug']; ?>" aria-hidden="true"></i>
          <span class="sr-only"><?php echo $provider['name']; ?></span>
        </a>
      </li>
    <?php endforeach; ?>
  </ul>
</nav>
<!-- /.nav-socials -->
