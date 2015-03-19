<div id="sidebar" class="x2">

  <?php if ( !is_single() ) get_template_part('widget', 'side-banner--solar-eclipse-2015'); ?>

  <?php if ( !is_tag('solnechnoe-zatmenie-2015') ) get_template_part('widget', 'eclipse-2015'); ?>

  <ins id="sidebar-ad-1"
  style="display: none;"
  class="adsbygoogle-placeholder"></ins>

  <?php if ( !is_tag('new-horizons') ) get_template_part('widget', 'new-horizons'); ?>

	<?php if ( !is_home() && !is_search() && !is_category('authors') ) get_template_part('widget', 'vk'); ?>

	<?php if ( !is_home() && !is_search() && !is_category('authors') ) get_template_part('widget', 'facebook'); ?>

	<?php if ( !is_home() && !is_category('wiki') ) get_template_part('widget', 'wiki'); ?>


</div>