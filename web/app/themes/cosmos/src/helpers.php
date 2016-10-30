<?php

namespace App;

use Roots\Sage\Asset;
use Roots\Sage\Assets\JsonManifest;
use Roots\Sage\Template;

function template($layout = 'base')
{
    return Template::$instances[$layout];
}

function template_part($template, array $context = [], $layout = 'base')
{
    extract($context);
    include template($layout)->partial($template);
}

/**
 * @param $filename
 * @return string
 */
function asset_path($filename)
{
    static $manifest;
    isset($manifest) || $manifest = new JsonManifest(get_template_directory() . '/' . Asset::$dist . '/assets.json');
    return (string) new Asset($filename, $manifest);
}

/**
 * Determine whether to show the sidebar
 * @return bool
 */
function display_sidebar()
{
    static $display;
    isset($display) || $display = apply_filters('cosmos/display_sidebar', true);
    return $display;
}

/**
 * Page titles
 * @return string
 */
function title()
{
    if (is_home()) {
        if ($home = get_option('page_for_posts', true)) {
            return get_the_title($home);
        }
        return __('Latest Posts', 'cosmos');
    }
    if (is_archive()) {
        return get_the_archive_title();
    }
    if (is_search()) {
        return sprintf(__('Search Results for %s', 'cosmos'), get_search_query());
    }
    if (is_404()) {
        return __('Not Found', 'cosmos');
    }
    return get_the_title();
}

/**
*  Check if element is empty
* @param $element
* @return string
*/
function is_element_empty($element)
{
    $element = trim($element);
    return !empty($element);
}

/**
*  Check if logged in user has a role
* @param string $role, `administrator`, `editor` etc.
* @return string
*/
function is_user_role($role)
{
    $currentUser = wp_get_current_user();
    return in_array($role, $currentUser->roles);
}

/**
 * Get Google Analytics ID from Site settings
 * @return string
 */
function get_google_analytics_id()
{
    if (get_field('google_analytics_id', 'option')) {
        return get_field('google_analytics_id', 'option');
    }
}

/**
* Facebook's JavaScript SDK
* @return string
*/
function get_facebook_sdk()
{
    // Get Facebook App ID and site language values set via WordPress admin
    if (get_field('facebook_app_id', 'option')) {
        $app_id = get_field('facebook_app_id', 'option');
        echo '
        <script>
          window.fbAsyncInit = function() {
            FB.init({
              appId      : '. $app_id .',
              xfbml      : true,
              version    : \'v2.8\'
            });
          };

          (function(d, s, id){
             var js, fjs = d.getElementsByTagName(s)[0];
             if (d.getElementById(id)) {return;}
             js = d.createElement(s); js.id = id;
             js.src = "//connect.facebook.net/ru_RU/sdk.js";
             fjs.parentNode.insertBefore(js, fjs);
         }(document, \'script\', \'facebook-jssdk\'));
        </script>';
    }
}
