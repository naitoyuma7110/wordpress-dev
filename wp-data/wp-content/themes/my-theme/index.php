<?php

/**
 * The main template file
 *
 * @package My_Theme
 */

get_header(); ?>

<div class="container">
  <div class="site-main">
    <div class="content-area">
      <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
          <article id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
            <header class="entry-header">
              <h2 class="post-title">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
              </h2>
              <div class="post-meta">
                <span class="post-date"><?php echo get_the_date(); ?></span>
                <span class="post-author">by <?php the_author(); ?></span>
                <?php if (has_category()) : ?>
                  <span class="post-categories">in <?php the_category(', '); ?></span>
                <?php endif; ?>
              </div>
            </header>

            <div class="entry-content post-content">
              <?php if (has_post_thumbnail()) : ?>
                <div class="post-thumbnail">
                  <?php the_post_thumbnail('medium'); ?>
                </div>
              <?php endif; ?>

              <?php if (is_single()) : ?>
                <?php the_content(); ?>
              <?php else : ?>
                <?php the_excerpt(); ?>
                <a href="<?php the_permalink(); ?>" class="read-more">続きを読む &raquo;</a>
              <?php endif; ?>
            </div>

            <?php if (is_single()) : ?>
              <footer class="entry-footer">
                <?php if (has_tag()) : ?>
                  <div class="post-tags">
                    <strong>タグ:</strong> <?php the_tags('', ', '); ?>
                  </div>
                <?php endif; ?>

                <div class="post-navigation">
                  <?php
                  $prev_post = get_previous_post();
                  $next_post = get_next_post();
                  ?>

                  <?php if ($prev_post) : ?>
                    <div class="nav-previous">
                      <a href="<?php echo get_permalink($prev_post); ?>">
                        &laquo; <?php echo get_the_title($prev_post); ?>
                      </a>
                    </div>
                  <?php endif; ?>

                  <?php if ($next_post) : ?>
                    <div class="nav-next">
                      <a href="<?php echo get_permalink($next_post); ?>">
                        <?php echo get_the_title($next_post); ?> &raquo;
                      </a>
                    </div>
                  <?php endif; ?>
                </div>
              </footer>
            <?php endif; ?>
          </article>
        <?php endwhile; ?>

        <div class="pagination">
          <?php
          the_posts_pagination(array(
            'mid_size' => 2,
            'prev_text' => '&laquo; 前へ',
            'next_text' => '次へ &raquo;',
          ));
          ?>
        </div>

      <?php else : ?>
        <article class="no-posts">
          <h2>投稿が見つかりません</h2>
          <p>申し訳ございませんが、お探しの投稿は見つかりませんでした。</p>
          <?php get_search_form(); ?>
        </article>
      <?php endif; ?>
    </div>

    <?php get_sidebar(); ?>
  </div>
</div>

<?php get_footer(); ?>