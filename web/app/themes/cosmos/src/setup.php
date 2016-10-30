<?php

namespace App;

use Roots\Sage\Template;
use WPBasic\Navigation\NavWalker;
use WPBasic\Post\PostType;
use WPBasic\Post\Taxonomy;

/**
 * Theme assets
 */
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('cosmos/main.css', asset_path('styles/main.css'), false, null);
    wp_enqueue_script('cosmos/main.js', asset_path('scripts/main.js'), ['jquery'], null, true);
    wp_enqueue_style('google/fonts/css', 'https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,400,300,600,700', false, null);
}, 100);

/**
 * Theme setup
 */
add_action('after_setup_theme', function () {
    /**
     * Enable features from Soil when plugin is activated
     * @link https://roots.io/plugins/soil/
     */
    add_theme_support('soil-clean-up');
    add_theme_support('soil-jquery-cdn');
    add_theme_support('soil-nav-walker');
    add_theme_support('soil-nice-search');
    add_theme_support('soil-relative-urls');
    add_theme_support('soil-js-to-footer');
    add_theme_support('soil-disable-trackbacks');
    add_theme_support('soil-google-analytics', get_google_analytics_id());

    /**
     * Enable plugins to manage the document title
     * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Title_Tag
     */
    add_theme_support('title-tag');

    /**
     * Register navigation menus
     * @link http://codex.wordpress.org/Function_Reference/register_nav_menus
     */
    register_nav_menus([
        'modal_navigation'     => __('Modal menu', 'cosmos'),
        'primary_navigation'   => __('Primary Navigation', 'cosmos'),
        'secondary_navigation' => __('Secondary Navigation', 'cosmos')
    ]);
    
    /**
     * Cleaner walker wp_nav_menu()
     * Adds custom classes to navigation menus
     * @link http://codex.wordpress.org/Function_Reference/register_nav_menus
     */
    new NavWalker([
        'menu_item_class'     => 'c-menu__item',
        'active_class'        => 'is-active',
        'menu_sub_item_class' => 'c-menu__subitem',
        'dropdown_class'      => 'c-menu__dropdown'
    ]);
    
    /**
     * Enable post thumbnails
     * @link http://codex.wordpress.org/Post_Thumbnails
     * @link http://codex.wordpress.org/Function_Reference/set_post_thumbnail_size
     * @link http://codex.wordpress.org/Function_Reference/add_image_size
     */
    add_theme_support('post-thumbnails');

    /**
     * Enable post formats
     * @link http://codex.wordpress.org/Post_Formats
     */
    add_theme_support('post-formats', ['gallery', 'image', 'video']);

    /**
     * Enable HTML5 markup support
     * @link http://codex.wordpress.org/Function_Reference/add_theme_support#HTML5
     */
    add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);

    /**
     * Use main stylesheet for visual editor
     * @see assets/styles/layouts/_tinymce.scss
     */
    add_editor_style(asset_path('styles/main.css'));
    
    /**
    * Disable year/month uploads folders
    */
    update_option('uploads_use_yearmonth_folders', false);

    /**
    * Set the default comment status to 'closed'
    */
    update_option('default_comment_status', 'closed');    
});

/**
 * Register sidebars
 */
add_action('widgets_init', function () {
    $config = [
        'before_widget' => '<section class="widget %1$s %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>'
    ];
    register_sidebar([
        'name'          => __('Primary', 'cosmos'),
        'id'            => 'sidebar-primary'
    ] + $config);
    register_sidebar([
        'name'          => __('Footer', 'cosmos'),
        'id'            => 'sidebar-footer'
    ] + $config);
});
