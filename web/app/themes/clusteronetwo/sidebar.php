<div id="sidebar" class="x2">

  <?php get_template_part('widget', 'sidebar-social--twitter'); ?>

  <?php if ( is_single() ) get_template_part('widget', 'sidebar-ads--telescopes'); ?>

  <?php get_template_part('widget', 'sidebar-ads--solar-eclipse-2015'); ?>

  <?php if ( !is_tag('solnechnoe-zatmenie-2015') ) get_template_part('widget', 'sidebar-posts--solar-eclipse-2015'); ?>

  <?php if ( !is_tag('new-horizons') ) get_template_part('widget', 'sidebar-posts--new-horizons'); ?>

	<?php if ( !is_home() && !is_search() && !is_category('authors') ) get_template_part('widget', 'sidebar-social--vk'); ?>

	<?php if ( !is_home() && !is_search() && !is_category('authors') ) get_template_part('widget', 'sidebar-social--facebook'); ?>

	<?php if ( !is_home() && !is_category('wiki') ) get_template_part('widget', 'sidebar-wiki'); ?>


</div>