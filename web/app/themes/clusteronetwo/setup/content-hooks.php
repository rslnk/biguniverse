<?php

/*
* This function checs number of queries on each page 
* and outputs info in html in footer
*


add_action( 'wp_footer', 'performance', 20 );
function performance( $visible = false ) {
    $stat = sprintf(  '%d queries in %.3f seconds, using %.2fMB memory',
        get_num_queries(),
        timer_stop( 0, 3 ),
        memory_get_peak_usage() / 1024 / 1024
        );
    echo $visible ? $stat : "<!-- {$stat} -->" ;
}
*/

/* ------------------------------- Temp functions / Future hooks for version 2.0 -------------------------------------------- */

// filter out posts that belong to wiki & video categories, showing 9 post on page
function loop_filter() {
   global $wp_query, $post;

        $idObj = get_category_by_slug('wiki');
        $idObj_2 = get_category_by_slug('videos');
        $catid = $idObj->term_id;
        $catid_2 = $idObj_2->term_id;
        $exl_posts = 'post__not_in';
      
        query_posts( 'cat=-' . $catid . ',-' .$catid_2 . '&showposts=9' );
        wp_reset_postdata();
}

// Get the page number (shows up in html titles)
function get_page_number() {
    if (get_query_var('paged')) {
        print ' &mdash; ' . __( 'страница ' , 'clusterone') . get_query_var('paged');
    }
}

// Show custom post title (meta key)
function custom_title() {
  global $wp_query, $post;
  $html_title = get_post_meta($post->ID, 'custom_title', true);
    if ($html_title) {  

      $title_string = $html_title;
      if (strlen($title_string) >200) {

                // truncate string
                $title_stringCut = substr($title_string, 0, 200);

                // make sure it ends in a word so assassinate doesn't become ass...
                $title_string = substr($title_stringCut, 0, strrpos($title_stringCut, ' ')).'...'; 
            }

      echo $title_string;
    }
    // if it doesn't exist fallback to default title 
    else {
      the_title();
    } 
    // Reset Post Data
wp_reset_postdata();
}

// Show subcategory of the post as link
function show_subcategory() {    
  foreach((get_the_category()) as $subcategory)

  {
      if ($subcategory->category_parent)
      {
            $string = $subcategory->cat_name;
            $string = strip_tags($string);
            if (strlen($string) >40) {

                // truncate string
                $stringCut = substr($string, 0, 40);

                // make sure it ends in a word so "assassinate" doesn't become "ass"...
                $string = substr($stringCut, 0, strrpos($stringCut, ' ')); //.'...'; 
            }
            
          echo '<a href="' . get_category_link($subcategory->cat_ID) . '">' . $string . '</a>';

      }
  }
}


// Excerpt (smart excerpt with words limit)
function smart_excerpt() {
  global $wp_query, $post;
  $excerpt = get_the_excerpt();
    $words = explode(" ",$excerpt);
    $limit = 20;
    $dots = '...';
      if ( $excerpt && count($words) >= $limit) $dots = '...'; {
        echo implode(" ",array_splice($words,0,$limit)).$dots;
    }
}


//  выводим рубрики (подкатегории), категория и лимит рубрик передаются через переменные. пример: get_projects ('posts', 2)
function get_projects($from_category, $limit) {
  global $wp_query, $post;

    $num = $limit;
    $catid_3 = $from_category;

    $idObj_3 = get_category_by_slug($catid_3); // не забудь что idObj_ также используются в других функциях
    $catid_3 = $idObj_3->term_id;

    $categories = get_categories('child_of=' . $catid_3 . '&orderby=date&order=DESC&title_li=&show_option_none=0&number=' . $num ); // сортируем рубрики по дате их создания
    
    foreach($categories as $category) {
      $posts = get_posts('showposts=1&cat='. $category->term_id);
      print '<div id="project">';
          if ($posts) {
            echo '<div class="head"><a href="' . get_category_link( $category->term_id ) .   '" ' . '>' . $category->name.'</a><div class="split"></div></div>';
                foreach($posts as $post) {
                setup_postdata($post); ?>
            <div class="title"><a href="<?php the_permalink() ?>" rel="bookmark"><?php custom_title(); ?></a></div>
       </div>
            <?php
                } // foreach($posts
            } // if ($posts
      } // foreach($categories
        // Reset Post Data
wp_reset_postdata();
}

// список авторов отсортированный по дате добавления последней статьи
function get_authors() { 
  global $wp_query, $post;

  $uc=array();
  $authors = get_users();
  if ($authors) {
    foreach ($authors as $author) {
      $userpost = get_posts('showposts=1&author='.$author->ID);
      $uc[$author->ID] = '';
      if ($userpost) {
        $uc[$author->ID]=$userpost[0]->post_date;
      }
    }
    arsort($uc);
    $i = 0;
    foreach ($uc as $key => $value) {
      $user = get_userdata($key);
      $post_count = count_user_posts($user->ID);
      $authordesc = get_the_author_meta( 'description', $user->ID );
      $login_name = get_the_author_meta('user_login', $user->ID );
      if ($post_count && $i < 3) {      // ограничиваем количество авторов
        $author_posts_url = get_author_posts_url($key);
        echo 
          '<div id="author" class="block x1 inline">
          <div class="imagewrap">
            <div class="tint">
              <a class="thumbnail" href="' . $author_posts_url . '"><img src="' . get_template_directory_uri() . '/images/authors/' . $login_name . '.jpg"></a>
            </div>
          </div>
          <div class="caption">
            <div class="head"><a href="' . $author_posts_url . '">' . $user->display_name . '</a><div class="split"></div></div>
            <div class="bio">' . $authordesc . '</div>
          </div>
        </div>';          
      }
    $i++;
    }
  }
  // Reset Post Data
wp_reset_postdata();
}
?>