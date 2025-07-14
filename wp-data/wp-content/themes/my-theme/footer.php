    <footer id="colophon" class="site-footer">
      <div class="container">
        <div class="footer-content">
          <div class="footer-widgets">
            <?php if (is_active_sidebar('footer-1')) : ?>
              <div class="footer-widget-area">
                <?php dynamic_sidebar('footer-1'); ?>
              </div>
            <?php endif; ?>
          </div>

          <div class="footer-navigation">
            <?php
            wp_nav_menu(array(
              'theme_location' => 'footer',
              'menu_id'        => 'footer-menu',
              'menu_class'     => 'footer-menu',
              'container'      => false,
              'depth'          => 1,
            ));
            ?>
          </div>

          <div class="site-info">
            <p>
              &copy; <?php echo date('Y'); ?>
              <a href="<?php echo esc_url(home_url('/')); ?>">
                <?php bloginfo('name'); ?>
              </a>
              .
              <?php esc_html_e('All rights reserved.', 'my-theme'); ?>
            </p>
            <p>
              <?php
              printf(
                esc_html__('Powered by %s', 'my-theme'),
                '<a href="https://wordpress.org/">WordPress</a>'
              );
              ?>
              <?php esc_html_e('and', 'my-theme'); ?>
              <a href="https://example.com/">My Custom Theme</a>
            </p>
          </div><!-- .site-info -->
        </div>
      </div>
    </footer><!-- #colophon -->
    </div><!-- #page -->

    <?php wp_footer(); ?>

    </body>

    </html>