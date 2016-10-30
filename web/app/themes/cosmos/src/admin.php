<?php

namespace App;

/**
 * Theme customizer
 */
add_action('customize_register', function (\WP_Customize_Manager $wp_customize) {
    // Add postMessage support
    $wp_customize->get_setting('blogname')->transport = 'postMessage';
});

/**
 * Customizer JS
 */
add_action('customize_preview_init', function () {
    wp_enqueue_script('sage/customizer.js', asset_path('scripts/customizer.js'), ['customize-preview'], null, true);
});

/**
* Add option pages to admin menu
* Requires ACF PRO >= 5.0.0
* @link http://www.advancedcustomfields.com/resources/acf_add_options_page/
*/
add_action('init', function () {
    if (function_exists('acf_add_options_page')) {
        // Site Settings page
        acf_add_options_page([

            'page_title'  => __('Site Settings', 'cosmos'),
            'menu_title'  => __('Settings', 'cosmos'),
            'menu_slug'   => 'site-settings',
            'capability'  => 'edit_pages',
            'icon_url'    => 'dashicons-admin-settings',
            'redirect'    => false

        ]);

        // Site Settings/Dictionary
        acf_add_options_sub_page([

            'page_title'  => __('Dictionary', 'cosmos'),
            'menu_title'  => __('Dictionary', 'cosmos'),
            'parent_slug' => 'site-settings',
            'capability'  => 'edit_pages'

        ]);

        // Site Settings/Advanced settigns
        acf_add_options_sub_page([

            'page_title'  => __('Advanced settigns', 'cosmos'),
            'menu_title'  => __('Advanced', 'cosmos'),
            'parent_slug' => 'site-settings',
            'capability'  => 'activate_plugins'

        ]);
    }
}, 99);

/**
 * Clean up Yoast SEO plugin UI
 */
 add_action('admin_init', function () {
     // Remove plugin notification center from admin
     if (class_exists('Yoast_Notification_Center')) {
         $yoast_nc = \Yoast_Notification_Center::get();
         remove_action('admin_notices', [$yoast_nc, 'display_notifications']);
         remove_action('all_admin_notices', [$yoast_nc, 'display_notifications']);
     }
     // Move plugin metabox to the bottom of the post editor page
     add_filter('wpseo_metabox_prio', function () {
        return 'low';
     });
 });

/**
* Clean up admin menu
* Requires ACF PRO >= 5.0.0
* @link http://www.advancedcustomfields.com/resources/acf_add_options_page/
*/
add_action('admin_menu', function () {

    // Rename admin menu pages
    global $menu;
    $menu[80][0]      = 'WordPress'; // Change 'Settings' to 'WordPress'

    // Customize admin menu order
    add_filter('custom_menu_order', '__return_true');
    add_filter('menu_order', function () {
        return
        [
            'index.php',
            'edit.php', // posts
            'separator1',
            'edit.php?post_type=page',
            'separator2',
            'upload.php',
            'separator3',
            'site-settings', // ACF PRO options page
            'separator-last',
            'profile.php',
        ];

    });

    // Hide the following menu pages for all users
    remove_menu_page('index.php');
    remove_menu_page('edit-comments.php');
    remove_menu_page('tools.php');

    // Hide the following menu pages for Editor role
    if (is_user_role('editor')) {
        remove_menu_page('themes.php');
        remove_menu_page('edit.php?post_type=acf-field-group');
    }
});

/**
 * Clean up admin Toolbar
 * @link https://codex.wordpress.org/Plugin_API/Action_Reference/wp_before_admin_bar_render
 */
add_action('wp_before_admin_bar_render', function () {
    global $wp_admin_bar;
    // Remove Menu Items from the admin toolbar
    $wp_admin_bar->remove_menu('wp-logo');
    $wp_admin_bar->remove_menu('comments');
    $wp_admin_bar->remove_menu('wpseo-menu');
});

/**
 * Hide admin Toolbar on all front facing pages
 * @link https://codex.wordpress.org/Function_Reference/show_admin_bar
 */
add_filter('show_admin_bar', '__return_false');

/**
 * Clean up Dashboard
 * @link https://codex.wordpress.org/Plugin_API/Action_Reference/wp_dashboard_setup
 */
add_action('wp_dashboard_setup', function () {
    global $wp_meta_boxes;
    // Remove Dashboard Widgets
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
}, 999);
