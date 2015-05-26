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
	<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.ico" type="image/x-icon" />

	<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" />
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/fonts/font-awesome.css" type="text/css" />

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
	<meta property="og:image" content="<?php if (function_exists('wp_get_attachment_thumb_url')) {echo wp_get_attachment_thumb_url(get_post_thumbnail_id($post->ID)); } ?>" />
	<!-- if page is others -->
	<?php } else { ?>
	<meta property="og:site_name" content="<?php bloginfo('name'); ?>" />
	<meta property="og:description" content="<?php bloginfo('description'); ?>" />
	<meta property="og:type" content="website" />
	<meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/share-fallback-logo.jpg" />
	<?php } ?>
	<!-- end opengraph-->
	<?php
		if (!is_admin()) add_action("wp_enqueue_scripts", "my_jquery_enqueue", 11);
		function my_jquery_enqueue() {
		   wp_deregister_script('jquery');
		   wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js", false, null);
		   wp_enqueue_script('jquery');
		}
	?>
	<?php wp_head(); ?>

	<script src="//vk.com/js/api/openapi.js" type="text/javascript"></script>
	<script type="text/javascript">
	  VK.init({
	    apiId: 2677034
	  });
	</script>
</head>

<body <?php body_class(); ?>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/ru_RU/sdk.js#xfbml=1&appId=210792705638856&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<?php if ( !is_404() ) get_template_part( 'site-header' ); ?>
