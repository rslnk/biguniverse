<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?> xmlns:og="http://ogp.me/ns#" xmlns:fb="https://www.facebook.com/2008/fbml">
<head>
	<meta name="google-site-verification" content="22lVpgLZnuEQH_chSH5E7kt4jRPIb7Vurix8ZEl2lP4" />
	<title>
	<?php
        if ( is_home() || is_front_page() ) { bloginfo('name'); print ' &mdash; '; print get_option('moto'); get_page_number(); }
        elseif ( is_page() ) { bloginfo('name'); print ' &mdash; '; bloginfo('description'); get_page_number(); }
        elseif ( is_page() ) { single_post_title(''); }
        elseif ( is_search() ) { bloginfo('name'); print ' &mdash; Поиск: ' . esc_html('&laquo;' . $s . '&raquo;'); get_page_number(); }
        elseif ( is_404() ) { bloginfo('name'); print ' &mdash; Ого! Черная дыра!'; }
        else { bloginfo('name'); wp_title('&mdash;'); get_page_number(); }
    ?>
	</title>
	<meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="alternate" type="application/rss+xml" href="<?php bloginfo('rss2_url'); ?>" title="<?php printf( __( '%s последние публикации', 'clusterone' ), esc_html( get_bloginfo('name')) ); ?>" />
	<link rel="alternate" type="application/rss+xml" href="<?php bloginfo('comments_rss2_url') ?>" title="<?php printf( __( '%s последние комментарии', 'clusterone' ), esc_html( get_bloginfo('name')) ); ?>" />
	<link rel="shortcut icon" href="<?php echo home_url(); ?>/favicon.ico" type="image/x-icon" />
	<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" />
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/fonts/font-awesome.css" type="text/css" />
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/fonts/font-awesome-ie7.css" type="text/css" />

	<!--opengraph -->
	<?php if (have_posts()):while(have_posts()):the_post(); endwhile; endif;?>
	<!-- the default values -->
	<meta property="fb:app_id" content="210792705638856" />
	<meta property="fb:admins" content="548861778" />
	<!-- if page is content page -->
	<?php if (is_single()) { ?>
	<meta property="og:url" content="<?php the_permalink() ?>"/>
	<meta property="og:title" content="<?php single_post_title(''); ?>" />
	<meta property="og:description" content="<?php echo strip_tags(get_the_excerpt($post->ID)); ?>" />
	<meta property="og:type" content="article" />
	<meta property="og:image" content="<?php if (function_exists('wp_get_attachment_thumb_url')) {echo wp_get_attachment_thumb_url(get_post_thumbnail_id($post->ID)); }?>" />
	<!-- if page is others -->
	<?php } else { ?>
	<meta property="og:site_name" content="<?php bloginfo('name'); ?>" />
	<meta property="og:description" content="<?php bloginfo('description'); ?>" />
	<meta property="og:type" content="website" />
	<meta property="og:image" content="<?php echo home_url(); ?>/share-fallback-logo.jpg" />
	<?php } ?>
	<!-- end opengraph-->

	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="<?php echo get_template_directory_uri(); ?>/js/jquery-1.9.0.min.js"><\/script>')</script>

</head>

<body <?php body_class(); ?>>

<?php if ( !is_404() ) get_template_part( 'bodyhead' ); ?>