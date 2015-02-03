<?php


// Deletes default Wodpress style for wp-caption
add_shortcode('wp_caption', 'fixed_img_caption_shortcode');
add_shortcode('caption', 'fixed_img_caption_shortcode');
function fixed_img_caption_shortcode($attr, $content = null) {
	// Allow plugins/themes to override the default caption template.
	$output = apply_filters('img_caption_shortcode', '', $attr, $content);
	if ( $output != '' ) return $output;
	extract(shortcode_atts(array(
		'id'=> '',
		'align'	=> 'alignnone',
		'width'	=> '',
		'caption' => ''), $attr));
	if ( 1 > (int) $width || empty($caption) )
	return $content;
	if ( $id ) $id = 'id="' . esc_attr($id) . '" ';
	return '<div ' . $id . 'class="wp-caption ' . esc_attr($align)
	. '">'
	. do_shortcode( $content ) . '<p class="wp-caption-text">'
	. $caption . '</p></div>';
}

function sButton($atts, $content = null) {
   extract(shortcode_atts(array('link' => '#'), $atts));
   return '<a class="button" href="'.$link.'"><span>' . do_shortcode($content) . '</span></a>';
}
add_shortcode('button', 'sButton');

function sQuotename($atts, $content = null) {
   return '<div class="quotename">' . do_shortcode($content) . '</div>';
}
add_shortcode('quotename', 'sQuotename');

function shortcode_underline($atts, $content = null) {
   return '<div class="headline">' . do_shortcode($content) . '</div>';
}
add_shortcode('underline', 'shortcode_underline');

/* pollquotes */

function test_shortcode( $atts, $content = null ) {
   extract( shortcode_atts( array(
 	'size' => '',
 	'color' => '',
 	'align' => '',
 	'quotes' => '',
 	'cite' => 'unknown',
	'url' => 'url',
      ), $atts ) );

      if ( $cite == 'unknown' ) {
		return '<span class="pullquote ' . esc_attr($align) . '">'.$content.'</span>';
	} elseif ( $url == 'url' ) {
		return '<span class="pullquote ' . esc_attr($align) . ' ">'.$content.'<span class="cite"><br /> &mdash; '.$cite.'</span></span>';	
	} else {
		return '<span class="pullquote ' . esc_attr($align) . ' ">'.$content.'<p class="cite">- <a href="'.$url.'">'.$cite.'</a></p></span>';
	}
 
  /* return '<span class="test ' . esc_attr($size) . ' ' . esc_attr($color) . ' ">' . $content . '</span>'; */

}
add_shortcode('pullquote', 'test_shortcode');


/* two columns */

function shortcode_columns ($atts, $content = null) {
   return '<div class="columns">' . do_shortcode($content) . '</div>';
}
add_shortcode('columns', 'shortcode_columns');

function shortcode_column_left ($atts, $content = null) {
	$content = wptexturize($content);
 	$content = wpautop($content);
	return '<div class="column-left">' . $content . '</div>';
}
add_shortcode('column-left', 'shortcode_column_left');

function shortcode_column_right ($atts, $content = null) {
	$content = wptexturize($content);
	$content = wpautop($content);
	return '<div class="column-right">' . $content . '</div><div style="clear: both;"></div>';
}
add_shortcode('column-right', 'shortcode_column_right');


/* TEST 
function one_shortcode( $atts, $content = null ) {
   return '<div class="one">' . do_shortcode($content) . '</div>';
}
add_shortcode( 'one', 'one_shortcode' );

function two_shortcode( $atts, $content = null ) {
   return '<div class="two">' . $content . '</div>';
}
add_shortcode( 'two', 'two_shortcode' );
*/

/**********************
*
* shortcode handler for columnization of project posts
* ex: [leftcol]content here...[/leftcol]

function shortcode_columnize_left( $atts, $content = null ) {
 $content = wptexturize( $content );
 $content = wpautop( $content );
 $content = '<div style="width: 47%; margin-right: 5%; float: left; text-align: left; ">' . $content . '</div>';
 return $content;
}

/* columnize right inserts 'clear' div after content 
function shortcode_columnize_right( $atts, $content = null ) {
 $content = wptexturize( $content );
 $content = wpautop( $content );
 $content = '<div style="width: 47%; float: left; text-align: left;">' . $content . '</div><div style="clear: both;"></div>';
 return $content;
}
add_shortcode( 'leftcol', 'shortcode_columnize_left' );
add_shortcode( 'rightcol', 'shortcode_columnize_right' );
*/
?>