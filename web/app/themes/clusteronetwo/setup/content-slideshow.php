<?php
/*
This function uses code from Portfolio Slideshow (version: 1.1.5) by Dalton Rooney
Plugin URI: http://madebyraygun.com/lab/portfolio-slideshow
Description: A shortcode that inserts a clean and simple jQuery + cycle powered slideshow of all image attachments on a post or page. Use shortcode [slideshow] to activate.
*/

//get ready for local


// add our default options if they're not already there:
	add_option("slideshow_size", 'full'); 
	add_option("slideshow_transition", 'fade'); 
	add_option("slideshow_transition_speed", '400'); 
	add_option("slideshow_show_support", 'false'); 
	add_option("slideshow_show_titles", 'true'); 
	add_option("slideshow_show_captions", 'true'); 
	add_option("slideshow_show_descriptions", 'false'); 
	add_option("slideshow_show_thumbs", 'false');
	add_option("slideshow_show_thumbs_hp", 'false');
	add_option("slideshow_nav_position", 'top'); 
	add_option("slideshow_nowrap", '');
	add_option("slideshow_showhash", ''); 
	add_option("slideshow_timeout", '0'); 
	add_option("slideshow_showloader", ''); 
	add_option("slideshow_descriptionisURL", '');
	add_option("slideshow_jquery_version", '1.4.4');
//end update

// now let's grab the options table data
$ps_size = get_option('slideshow_size'); 
$ps_trans = get_option('slideshow_transition'); 
$ps_speed = get_option('slideshow_transition_speed'); 
$ps_support = get_option('slideshow_show_support'); 
$ps_titles = get_option('slideshow_show_titles');
$ps_captions = get_option('slideshow_show_captions');
$ps_descriptions = get_option('slideshow_show_descriptions');
$ps_thumbs = get_option('slideshow_show_thumbs');
$ps_thumbs_hp = get_option('slideshow_show_thumbs_hp');
$ps_navpos = get_option('slideshow_nav_position');
$ps_nowrap = get_option('slideshow_nowrap');
$ps_timeout = get_option('slideshow_timeout');
$ps_showhash = get_option('slideshow_showhash');
$ps_showloader = get_option('slideshow_showloader');
$ps_descriptionisURL = get_option('slideshow_descriptionisURL');
$ps_jquery = get_option('slideshow_jquery_version');

//set up defaults if these fields are empty
if (empty($ps_showloader)) {$ps_showloader = "false";}
if (empty($ps_descriptionisURL)) {$ps_descriptionisURL = "false";}
if (empty($ps_showhash)) {$ps_showhash = "false";}
if (empty($ps_nowrap)) {$ps_nowrap = "0";}

// put the attachment ID on the media page 
function add_post_id($content) { 
   	$showlink = "Attachment ID:" . get_the_ID($post->ID, true);
	$content[] = $showlink;
    return $content;}
add_filter ( 'media_row_actions', 'add_post_id');

//Adds custom fields to attachment page. Via Frank Bültge, http://bueltge.de/ ref: http://wpengineer.com/2076/add-custom-field-attachment-in-wordpress/

if ($ps_descriptionisURL == "true") {
	
	function ps_image_attachment_fields_to_edit($form_fields, $post) {  
		$form_fields["ps_image_link"] = array(  
			"label" => __('Slideshow image links to URL:', 'port_slide'),
			"input" => "text",
			"value" => get_post_meta($post->ID, "_ps_image_link", true)  
		);        
		
		return $form_fields;  
	}  
	
	function ps_image_attachment_fields_to_save($post, $attachment) {
		if( isset($attachment['ps_image_link']) ){
			update_post_meta($post['ID'], '_ps_image_link', $attachment['ps_image_link']);
		}  
		return $post;  
	}  
	
	add_filter("attachment_fields_to_edit", "ps_image_attachment_fields_to_edit", null, 2);
	add_filter("attachment_fields_to_save", "ps_image_attachment_fields_to_save", null, 2);
}

// create the shortcode
add_shortcode('slideshow', 'slideshow_shortcode');

// define the shortcode function
function slideshow_shortcode($atts) {
	
	STATIC $i=0;
	
	//count the attachments
	
	global $ps_trans, $ps_speed, $ps_size, $ps_titles, $ps_captions, $ps_descriptions, $ps_thumbs, $ps_navpos, $ps_timeout, $ps_thumbs_hp, $ps_showhash, $ps_showloader, $ps_descriptionisURL, $ps_nowrap;
	
	extract(shortcode_atts(array(
		'size' => $ps_size,
		'nowrap' => $ps_nowrap,
		'speed' => $ps_speed,
		'trans' => $ps_trans,
		'timeout' => $ps_timeout,
		'thumbs' => $ps_thumbs,
		'nav' => $ps_navpos,
		'id' => '',
		'exclude' => '',
		'include' => ''
	), $atts));
	
	if ( empty ( $id ) ) { $id = get_the_ID(); }
	
	$attachments = get_children( array ( 'post_parent' => $id, 'post_type' => 'attachment', 'post_mime_type' => 'image' ) );
	$count = count( $attachments );
		
	if( !is_feed() && $ps_showloader=="true"){ //show the loader.gif if necessary
					$slideshow = '<div class="slideshow-holder"></div>';}
	$jindex = $i;
	
	if ( !is_feed() ) { $slideshow = '<script type="text/javascript">/* <![CDATA[ */ psTimeout['.$jindex.']='.$timeout.';psTrans['.$jindex.']=\''.$trans.'\';psNoWrap['.$jindex.']='.$nowrap.';psSpeed['.$jindex.']='.$speed.';/* ]]> */</script>'; } 
			
	$slideshow .= '<div id="slideshow-wrapper'.$i.'" class="slideshow-wrapper">
	';	//wrap the whole thing in a div for styling	
	
		// Navigation

		$ps_nav = '<div class="slideshow-nav'.$i.' slideshow-nav">';
		if ($timeout !=0) { //if autoplay is set
		$ps_nav ='<a class="pause" href="javascript: void(0)">' . __('Pause', 'port_slide') . '</a><a class="play" style="display:none" href="javascript: void(0)">' . __('Play', 'port_slide') . '</a>';} // end autoplay

		$ps_nav .= '<a class="slideshow-prev" href="javascript: void(0)"></a>' . '<span class="slideshow-info'.$i.' slideshow-info"></span>' . '<a class="slideshow-next" href="javascript: void(0)">' . __('', 'port_slide') . '</a>';
		$ps_nav .= '</div>
		';	
	
	if ( !is_feed() && $nav == "top" && $count > 1) { 
		$slideshow .= $ps_nav;
	}
		
	$slideshow .= '<div id="clusterone-slideshow'.$i.'" class="clusterone-slideshow">
	';

	$slideID=1;
	
	if ( !empty( $include ) ) {
		$include = preg_replace( '/[^0-9,]+/', '', $include );
		$attachments = get_posts( array('order'          => 'ASC',
		'orderby' 		 => 'menu_order ID',
		'post_type'      => 'attachment',
		'post_parent'    => $id,
		'post_mime_type' => 'image',
		'post_status'    => null,
		'numberposts'    => -1,
		'size'			 => $size,
		'include'		 => $include) );
		
	} elseif ( !empty( $exclude ) ) {
		$exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
		$attachments = get_posts( array('order'          => 'ASC',
		'orderby' 		 => 'menu_order ID',
		'post_type'      => 'attachment',
		'post_parent'    => $id,
		'post_mime_type' => 'image',
		'post_status'    => null,
		'numberposts'    => -1,
		'size'			 => $size,
		'exclude'		 => $exclude) );
	} else {
		$attachments = get_posts( array('order'          => 'ASC',
		'orderby' 		 => 'menu_order ID',
		'post_type'      => 'attachment',
		'post_parent'    => $id,
		'post_mime_type' => 'image',
		'post_status'    => null,
		'numberposts'    => -1,
		'size'			 => $size) );
	}

	if ( empty($attachments) )
		return '';

	if ($attachments) { //if attachments are found, run the slideshow, otherwise it's  blank
	
		//begin the slideshow loop
		foreach ($attachments as $attachment) {
			
			$slideshow .= '<div class="';
			if ($slideID != "1") {$slideshow .= "not-first ";}
			$slideshow .= 'slideshow-next slideshow-content">
			';
			
			//this section sets up the external links if the option is selected
			
			if ($ps_descriptionisURL=="true") {			
				$imagelink = get_post_meta($attachment->ID, '_ps_image_link', true);
					if (!empty($imagelink)) { $slideshow .= '<a href="'.$imagelink.'" target="_blank">';}				
				} else { $slideshow .= '<a href="javascript: void(0);" class="slideshow-next">';}
			
			//holy smokes, those are the images!
			$slideshow .= wp_get_attachment_image($attachment->ID, $size, false, false);
			
			//don't forget to end the links if we've got them
			if ($ps_descriptionisURL=="true") {			
					if (!empty($imagelink)) { $slideshow .= "</a>";}				
				} else { $slideshow .= "</a>";}				
			
			if ($nav == "middle" && $count > 1) { 
				$slideshow .= $ps_nav;
			}

			//if titles option is selected
			if ($ps_titles=="true") {
			$title = $attachment->post_title;
			if (!empty($title)) { 
				$slideshow .= '<p class="slideshow-title">'.$title.'</p>'; 
			} }
			
			//if captions option is selected
			if ($ps_captions=="true") {			
			$caption = $attachment->post_excerpt;
			if (!empty($caption)) { 
				$slideshow .= '<p class="wp-caption-text">'.$caption.'</p>'; 
			}}
			
			//if descriptions option is selected and we're not using the description field for external links
			if ($ps_descriptions=="true") {			
			$description = $attachment->post_content;
			if (!empty($description)) { 
				$slideshow .= '<p class="slideshow-description">'.$description.'</p>'; 
			}}
			
			$slideshow .= "</div>
			";
			
			$slideID++;
					
		}  // end slideshow loop
	} // end if ($attachments)

	$slideshow .= "</div><!--#clusterone-slideshow-->";
	
	//here come the thumbnails!
	if ( !is_feed() && is_singular() && $thumbs=="true" && $count > 1 || !is_feed() && !is_singular() && $ps_thumbs_hp == "true" && $count > 1) {
		$slideshow .= '<div class="slideshow-thumbs">
							<ul id="slides'.$i.'" class="slides">';
		
		if ( !empty($include) ) {
			$include = preg_replace( '/[^0-9,]+/', '', $include );
			$attachments = get_posts( array('order'          => 'ASC',
			'orderby' 		 => 'menu_order ID',
			'post_type'      => 'attachment',
			'post_parent'    => $id,
			'post_mime_type' => 'image',
			'post_status'    => null,
			'numberposts'    => -1,
			'size'			 => 'thumbnail',
			'include'		 => $include) );
			
		} elseif ( !empty($exclude) ) {
			$exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
			$attachments = get_posts( array('order'          => 'ASC',
			'orderby' 		 => 'menu_order ID',
			'post_type'      => 'attachment',
			'post_parent'    => $id,
			'post_mime_type' => 'image',
			'post_status'    => null,
			'numberposts'    => -1,
			'size'			 => 'thumbnail',
			'exclude'		 => $exclude) );
		} else {
			$attachments = get_posts( array('order'          => 'ASC',
			'orderby' 		 => 'menu_order ID',
			'post_type'      => 'attachment',
			'post_parent'    => $id,
			'post_mime_type' => 'image',
			'post_status'    => null,
			'numberposts'    => -1,
			'size'			 => 'thumbnail') );
		}
	
		if ( empty($attachments) )
			return '';
		
		if ($attachments) {
			foreach ($attachments as $attachment) {
			$slideshow .="<li><a href=\"javascript: void(0)\">";
			$slideshow .= wp_get_attachment_image($attachment->ID, 'thumbnail', false, false);
			$slideshow .= "</a></li>";		
			}
		}
		
		$slideshow .= "</ul></div><!-- end thumbs-->
		<br style=\"clear:both\" />";
	
	}  //end thumbs

	if ( !is_feed() && $nav == "bottom" && $count > 1) { 
		$slideshow .= $ps_nav;
	}

	$slideshow .='</div><!--#slideshow-wrapper-->';
	$i++;
	
	return $slideshow;	

} //ends the slideshow_shortcode function


function slideshow_foot() {
	// Set up js variables
	global $ps_trans, $ps_speed, $ps_timeout, $ps_showhash, $ps_showloader, $ps_nowrap;
	//$ps_showhash should always be false on any non-singular page
	if (!is_singular()) {$ps_showhash = "false";}
echo '<script type="text/javascript">/* <![CDATA[ */var SlideshowOptions = {psHash: \''.$ps_showhash.'\',psLoader: \''.$ps_showloader.'\'};/* ]]> */</script>'; }    

add_action('wp_footer', 'slideshow_foot' );
?>