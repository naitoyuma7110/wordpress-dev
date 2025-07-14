<?php

/**
 * My Theme functions and definitions
 *
 * @package My_Theme
 */

// テーマサポートの設定
function my_theme_setup()
{
  // タイトルタグのサポート
  add_theme_support('title-tag');

  // アイキャッチ画像のサポート
  add_theme_support('post-thumbnails');

  // HTML5マークアップのサポート
  add_theme_support('html5', array(
    'search-form',
    'comment-form',
    'comment-list',
    'gallery',
    'caption',
  ));

  // カスタムロゴのサポート
  add_theme_support('custom-logo', array(
    'height'      => 100,
    'width'       => 400,
    'flex-height' => true,
    'flex-width'  => true,
  ));

  // メニューの登録
  register_nav_menus(array(
    'primary' => __('Primary Menu', 'my-theme'),
    'footer'  => __('Footer Menu', 'my-theme'),
  ));
}
add_action('after_setup_theme', 'my_theme_setup');

// スタイルシートとスクリプトの読み込み
function my_theme_scripts()
{
  // メインのスタイルシート
  wp_enqueue_style('my-theme-style', get_stylesheet_uri(), array(), '1.0.0');

  // レスポンシブデザイン用のスタイルシート
  wp_enqueue_style('my-theme-responsive', get_template_directory_uri() . '/responsive.css', array(), '1.0.0');

  // コメント用のスクリプト
  if (is_singular() && comments_open() && get_option('thread_comments')) {
    wp_enqueue_script('comment-reply');
  }
}
add_action('wp_enqueue_scripts', 'my_theme_scripts');

// ウィジェットエリアの登録
function my_theme_widgets_init()
{
  register_sidebar(array(
    'name'          => __('Sidebar', 'my-theme'),
    'id'            => 'sidebar-1',
    'description'   => __('Add widgets here.', 'my-theme'),
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
  ));

  register_sidebar(array(
    'name'          => __('Footer Widget Area', 'my-theme'),
    'id'            => 'footer-1',
    'description'   => __('Add widgets here.', 'my-theme'),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'   => '</h3>',
  ));
}
add_action('widgets_init', 'my_theme_widgets_init');

// カスタム投稿タイプの登録
function my_theme_custom_post_types()
{
  // ポートフォリオ投稿タイプ
  register_post_type('portfolio', array(
    'labels' => array(
      'name'               => __('Portfolio', 'my-theme'),
      'singular_name'      => __('Portfolio Item', 'my-theme'),
      'add_new'            => __('Add New', 'my-theme'),
      'add_new_item'       => __('Add New Portfolio Item', 'my-theme'),
      'edit_item'          => __('Edit Portfolio Item', 'my-theme'),
      'new_item'           => __('New Portfolio Item', 'my-theme'),
      'view_item'          => __('View Portfolio Item', 'my-theme'),
      'search_items'       => __('Search Portfolio', 'my-theme'),
      'not_found'          => __('No portfolio items found', 'my-theme'),
      'not_found_in_trash' => __('No portfolio items found in trash', 'my-theme'),
    ),
    'public'       => true,
    'has_archive'  => true,
    'supports'     => array('title', 'editor', 'thumbnail', 'excerpt'),
    'menu_icon'    => 'dashicons-portfolio',
    'rewrite'      => array('slug' => 'portfolio'),
  ));
}
add_action('init', 'my_theme_custom_post_types');

// カスタムタクソノミーの登録
function my_theme_custom_taxonomies()
{
  // ポートフォリオカテゴリー
  register_taxonomy('portfolio_category', 'portfolio', array(
    'labels' => array(
      'name'              => __('Portfolio Categories', 'my-theme'),
      'singular_name'     => __('Portfolio Category', 'my-theme'),
      'search_items'      => __('Search Portfolio Categories', 'my-theme'),
      'all_items'         => __('All Portfolio Categories', 'my-theme'),
      'parent_item'       => __('Parent Portfolio Category', 'my-theme'),
      'parent_item_colon' => __('Parent Portfolio Category:', 'my-theme'),
      'edit_item'         => __('Edit Portfolio Category', 'my-theme'),
      'update_item'       => __('Update Portfolio Category', 'my-theme'),
      'add_new_item'      => __('Add New Portfolio Category', 'my-theme'),
      'new_item_name'     => __('New Portfolio Category Name', 'my-theme'),
      'menu_name'         => __('Portfolio Categories', 'my-theme'),
    ),
    'hierarchical'      => true,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array('slug' => 'portfolio-category'),
  ));
}
add_action('init', 'my_theme_custom_taxonomies');

// エクセプトの長さを調整
function my_theme_excerpt_length($length)
{
  return 20;
}
add_filter('excerpt_length', 'my_theme_excerpt_length');

// エクセプトの末尾を変更
function my_theme_excerpt_more($more)
{
  return '...';
}
add_filter('excerpt_more', 'my_theme_excerpt_more');

// カスタム画像サイズの追加
add_image_size('portfolio-thumbnail', 300, 200, true);
add_image_size('featured-large', 800, 400, true);

// セキュリティ強化
function my_theme_security_headers()
{
  // XSS保護
  header('X-XSS-Protection: 1; mode=block');

  // クリックジャッキング保護
  header('X-Frame-Options: SAMEORIGIN');

  // MIMEタイプスニッフィング保護
  header('X-Content-Type-Options: nosniff');
}
add_action('send_headers', 'my_theme_security_headers');

// 管理画面のカスタマイズ
function my_theme_admin_customization()
{
  // 管理画面のロゴを変更
  add_action('admin_head', function () {
    echo '<style>
            #wpadminbar .ab-item {
                background: #333 !important;
            }
        </style>';
  });
}
add_action('admin_init', 'my_theme_admin_customization');

// パフォーマンス最適化
function my_theme_performance_optimization()
{
  // 絵文字の無効化
  remove_action('wp_head', 'print_emoji_detection_script', 7);
  remove_action('wp_print_styles', 'print_emoji_styles');

  // WordPressバージョンの削除
  remove_action('wp_head', 'wp_generator');

  // RSDリンクの削除
  remove_action('wp_head', 'rsd_link');

  // WLWマニフェストの削除
  remove_action('wp_head', 'wlwmanifest_link');

  // 短縮URLの削除
  remove_action('wp_head', 'wp_shortlink_wp_head');
}
add_action('init', 'my_theme_performance_optimization');

// フォールバックメニュー
function my_theme_fallback_menu()
{
  echo '<ul id="primary-menu" class="nav-menu">';
  echo '<li><a href="' . home_url('/') . '">' . __('Home', 'my-theme') . '</a></li>';
  echo '<li><a href="' . home_url('/about/') . '">' . __('About', 'my-theme') . '</a></li>';
  echo '<li><a href="' . home_url('/contact/') . '">' . __('Contact', 'my-theme') . '</a></li>';
  echo '</ul>';
}
