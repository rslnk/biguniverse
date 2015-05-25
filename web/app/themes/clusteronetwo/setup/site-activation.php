<?php

// http://foolswisdom.com/wp-activate-theme-actio/

//global $pagenow;
//if (is_admin() && $pagenow  === 'themes.php' && isset( $_GET['activated'])) {

  // on theme activation

  // set the permalink structure
  //if (get_option('permalink_structure') !== '/%category%/%postname%/') {
    //update_option('permalink_structure', '/%category%/%postname%/');
  //}

  //$wp_rewrite->init();
  //$wp_rewrite->flush_rules();

  // don't organize uploads by year and month
  //update_option('uploads_use_yearmonth_folders', 0);
  //update_option('upload_path', 'assets');
//}


function theme_setup() {

  // This theme styles the visual editor with editor-style.css to match the theme style.
  //add_editor_style();

  // This theme uses custom menus
  //add_theme_support( 'menus' );

  // Add default posts and comments RSS feed links to head
  //add_theme_support( 'automatic-feed-links' );

  // set the permalink structure
  update_option('permalink_structure', '/%category%/%postname%/');

  // don't organize uploads by year and month
  update_option('uploads_use_yearmonth_folders', 1);
  //update_option('upload_path', 'assets');

  // Show a certain number of posts per page.
  update_option( 'posts_per_page', 25 );
    update_option( 'paging_mode', 'default' );

  // Add support for a variety of post formats
  //add_theme_support( 'post-formats', array( 'aside', 'link', 'gallery', 'status', 'quote', 'image' ) );

  // This theme uses post thumbnails
  add_theme_support( 'post-thumbnails' );
    add_image_size('x1', 320, 9999);

      // This theme uses post thumbnails
  add_theme_support( 'post-thumbnails' );
    add_image_size('x2', 470, 9999);

  // Sets default widht for media files if it wasn't provided
  if ( ! isset( $content_width ) ) $content_width = 990;

   // This theme uses wp_nav_menu() in two locations.
  register_nav_menus( array(
    'primary_navigation' => __( 'Основная навигация:', 'clusterone' ),
    'secondary_navigation' => __('Вспомогательная навигация:', 'clusterone')
  ));
}

add_action('after_setup_theme', 'theme_setup');

// Pagination (does it depend on category base that is currently removed?)
function pages( $args = false ) {
  global $wp_query, $wp_rewrite;

  if( is_single() )
  {
    paginate_comments_links(array('type' => 'plain', 'end_size' => 3, 'mid_size' => 2));
  }
  else
  {
    $current = $wp_query->query_vars['paged'] > 1 ? $wp_query->query_vars['paged'] : 1;

    $pagination = array(
      'base'    => $wp_rewrite->using_permalinks() ? user_trailingslashit(trailingslashit(remove_query_arg('s',get_pagenum_link(1))) . 'page/%#%/', 'paged') : @add_query_arg('paged','%#%'),
      'add_args'  => !empty($wp_query->query_vars['s']) ? array('s'=>get_query_var('s')) : '',
      'total'   => $wp_query->max_num_pages,
      'current' => $current,
      'end_size'  => 1,
      'mid_size'  => 2,
      'type'    => 'plain',
      'format'  => '',
      'prev_text' => '< Предыдущая страница',
      'next_text' => 'Следующая страница >',
    );

    echo paginate_links( $pagination );
  }
}

function roots_rel_canonical() {
  if (!is_singular()) {
    return;
  }

  global $wp_the_query;
  if (!$id = $wp_the_query->get_queried_object_id()) {
    return;
  }

  $link = get_permalink($id);
  echo "\t<link rel=\"canonical\" href=\"$link\">\n";
}


// Custom templates for single post templates based on categories
//define(SINGLE_PATH, TEMPLATEPATH . '/single');
add_filter('single_template', 'my_single_template');

/**
 * Define a constant path to a single template folder
 * Filter the single_template with a custom function
 *
 * Checks for single template by category
 * Check by category slug and ID
 *
 */

function my_single_template($single) {
  global $wp_query, $post;

  /**
  * Checks for single template by category
  * Check by category slug and ID
  */
  foreach((array)get_the_category() as $cat) :

    if(file_exists(TEMPLATEPATH . '/single-' . $cat->slug . '.php'))
      return TEMPLATEPATH . '/single-' . $cat->slug . '.php';

  endforeach;

  return $single;

}
/*
Plugin Name: TheRussianDate
Plugin URI: http://www.yaroshevich.ru/php/the-wp-russian-date
Description: russian formated date
Version: 1.01
Author: Vasil Yaroshevich
Author URI: http://www.yaroshevich.ru
License: GPL
Last modified: 11/24/2006 07:48PM MSK
*/


/*
Добавляет функцию the_russian_time(), которая используется аналогично
стандартной функции the_time(), в дополнение к которой добавлена обработка
символа "R" для вывода названия месяца на русском языке в родительном падеже.

Пример: the_russian_time('j R Y г.') выведет дату в виде "23 ноября 2006 г."
*/

function the_russian_time($template='') {

$RinTemplate = strpos($template, "R");

if ($RinTemplate===FALSE) {
  echo get_the_time($template);
} else {
  if($RinTemplate > 0) {
    echo get_the_time(substr($template, 0,$RinTemplate));
  }

  $months= array (
  "января",
  "февраля",
  "марта",
  "апреля",
  "мая",
  "июня",
  "июля",
  "августа",
  "сентября",
  "октября",
  "ноября",
  "декабря"
  );
  echo $months[get_the_time('n')-1];
  the_russian_time(substr($template,$RinTemplate+1));
}
}
?>
