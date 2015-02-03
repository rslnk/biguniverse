<?php

/* ------------------------------- AND NOW Starting clean-up --------------------------------------- */

// remove unncessary header info
function remove_header_info() {
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'start_post_rel_link');
    remove_action('wp_head', 'index_rel_link');
    remove_action('wp_head', 'adjacent_posts_rel_link');
}
add_action('init', 'remove_header_info');

// remove Wordpress version info from head and feeds
function complete_version_removal() {
    return '';
}
add_filter('the_generator', 'complete_version_removal');

// add to robots.txt
// http://codex.wordpress.org/Search_Engine_Optimization_for_WordPress#Robots.txt_Optimization
function roots_robots() {
  echo "Disallow: /cgi-bin\n";
  echo "Disallow: /wp-admin\n";
  echo "Disallow: /wp-includes\n";
  echo "Disallow: /wp-content/plugins\n";
  echo "Disallow: /plugins\n";
  echo "Disallow: /wp-content/cache\n";
  echo "Disallow: /wp-content/themes\n";
  echo "Disallow: /trackback\n";
  echo "Disallow: /feed\n";
  echo "Disallow: /comments\n";
  echo "Disallow: /trackback\n";
  echo "Disallow: /feed\n";
  echo "Disallow: /comments\n";
  echo "Disallow: /*?*\n";
  echo "Disallow: /*?\n";
  echo "Allow: /wp-content/uploads\n";
  //echo "Allow: /wp-content/uploads\n";
  //echo "Allow: /assets";
}

add_action('do_robots', 'roots_robots');

/** 
 * Exclude pages from search results
 *
*/
function SearchFilter($query) {
	if ($query->is_search) {
	$query->set('post_type', 'post');
	}
	return $query;
}
add_filter('pre_get_posts','SearchFilter');

// Post excerpt and post thumbnail in RSS feeds (Does it work?)
function thumbnail_in_rssfeed($content) {
  global $post;

  if(has_post_thumbnail($post->ID)) {
  $content = '<div style="float:left;">' . get_the_post_thumbnail($post->ID) . '</div>' . $content;
  }
  return $content;
}

add_filter('the_excerpt_rss', 'thumbnail_in_rssfeed');
add_filter('the_content_feed', 'thumbnail_in_rssfeed');

/* 
* The following functions remove 
* HTML title attribute from the WP generated markup
*
*/

// Removes images are inserted via Add Media. Author URL: http://quirm.net/
add_filter('the_content', 'remove_img_titles');
function remove_img_titles($text) {

    // Get all title="..." tags from the html.
    $result = array();
    preg_match_all('|title="[^"]*"|U', $text, $result);

    // Replace all occurances with an empty string.
    foreach($result[0] as $img_tag) {
        $text = str_replace($img_tag, '', $text);
    }

    return $text;
}

// For all images (another option, just to be safe)
function remove_attachment_title_attr( $attr ) {
  unset($attr['title']);
  return $attr;
}
add_action('wp_get_attachment_image_attributes', 'remove_attachment_title_attr');

// For Page lists
function wp_list_pages_remove_title_attributes($output) {
  $output = preg_replace('` title="(.+)"`', '', $output);
  return $output;
}
add_filter('wp_list_pages', 'wp_list_pages_remove_title_attributes');

// For category lists
function wp_list_categories_remove_title_attributes($output) {
  $output = preg_replace('` title="(.+)"`', '', $output);
  return $output;
}
add_filter('wp_list_categories', 'wp_list_categories_remove_title_attributes');


// For tag clouds
function wp_tag_cloud_remove_title_attributes($return) {
  // N.B. This function uses single quotes
  $return = preg_replace("` title='(.+)'`", "", $return);
  return $return;
}
add_filter('wp_tag_cloud', 'wp_tag_cloud_remove_title_attributes');

// For post category links
function the_category_remove_title_attributes($thelist) {
  $thelist = preg_replace('` title="(.+)"`', '', $thelist);
  return $thelist;
}
add_filter('the_category', 'the_category_remove_title_attributes');

//For post edit links
function edit_post_link_remove_title_attributes($link) {
  $link = preg_replace('` title="(.+)"`', '', $link);
  return $link;
}
add_filter('edit_post_link', 'edit_post_link_remove_title_attributes');
?>