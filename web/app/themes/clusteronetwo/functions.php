<?php

if (!defined('__DIR__')) define('__DIR__', dirname(__FILE__));

require_once locate_template('/setup/site-activation.php');  	// activation
require_once locate_template('/setup/site-cleanup.php');  		// cleanup
require_once locate_template('/setup/content-shortcodes.php');  // shortcodes
require_once locate_template('/setup/content-slideshow.php');  	// slideshow
require_once locate_template('/setup/content-hooks.php');  		// hooks

require_once locate_template('/controls/admin-setup.php');  	// admin

require_once locate_template('/controls/control-page-onair.php');  	// admin
//require_once locate_template('/controls/control-page-ads.php');  	// admin
//require_once locate_template('/controls/control-page-seo.php');  	// admin

require_once locate_template('/controls/post-metabox-custom-title.php');  	// admin
require_once locate_template('/controls/post-meta-box-layout.php');  	// admin
require_once locate_template('/controls/post-meta-box-seo.php');  	// admin

?>