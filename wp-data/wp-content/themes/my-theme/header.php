<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="https://gmpg.org/xfn/11">

  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <?php wp_body_open(); ?>

  <div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'my-theme'); ?></a>

    <header id="masthead" class="site-header">
      <div class="container">
        <div class="site-branding">
          <?php
          if (has_custom_logo()) {
            the_custom_logo();
          } else {
          ?>
            <h1 class="site-title">
              <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                <?php bloginfo('name'); ?>
              </a>
            </h1>
            <?php
            $my_theme_description = get_bloginfo('description', 'display');
            if ($my_theme_description || is_customize_preview()) :
            ?>
              <p class="site-description"><?php echo $my_theme_description; ?></p>
            <?php endif; ?>
          <?php } ?>
        </div><!-- .site-branding -->

        <nav id="site-navigation" class="main-navigation">
          <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
            <?php esc_html_e('Menu', 'my-theme'); ?>
          </button>
          <?php
          wp_nav_menu(array(
            'theme_location' => 'primary',
            'menu_id'        => 'primary-menu',
            'menu_class'     => 'nav-menu',
            'container'      => false,
            'fallback_cb'    => 'my_theme_fallback_menu',
          ));
          ?>
        </nav><!-- #site-navigation -->
      </div>
    </header><!-- #masthead -->

    <?php if (!is_front_page() && !is_home()) : ?>
      <div class="page-header">
        <div class="container">
          <?php if (is_single()) : ?>
            <h1 class="page-title"><?php the_title(); ?></h1>
          <?php elseif (is_archive()) : ?>
            <h1 class="page-title"><?php the_archive_title(); ?></h1>
            <?php the_archive_description('<div class="archive-description">', '</div>'); ?>
          <?php elseif (is_search()) : ?>
            <h1 class="page-title">
              <?php printf(esc_html__('Search Results for: %s', 'my-theme'), '<span>' . get_search_query() . '</span>'); ?>
            </h1>
          <?php elseif (is_404()) : ?>
            <h1 class="page-title"><?php esc_html_e('Page Not Found', 'my-theme'); ?></h1>
          <?php else : ?>
            <h1 class="page-title"><?php the_title(); ?></h1>
          <?php endif; ?>
        </div>
      </div>
    <?php endif; ?>