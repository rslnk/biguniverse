<div id="sidebar" class="x2">

  <?php get_template_part('widget', 'sidebar-social--twitter'); ?>

  <?php if ( !is_tag('rasskazy-o-zvezdah') ) get_template_part('widget', 'sidebar-posts--stars-stories'); ?>

  <?php if ( !is_tag('new-horizons') ) get_template_part('widget', 'sidebar-posts--new-horizons'); ?>

  <?php if ( !is_tag('kometa-67p-churyumov-gerasimenko') ) get_template_part('widget', 'sidebar-posts--churyumov-gerasimenko'); ?>

  <?php if ( !is_tag('tserera') ) get_template_part('widget', 'sidebar-posts--tserera'); ?>

	<?php if ( !is_home() && !is_search() && !is_category('authors') ) get_template_part('widget', 'sidebar-social--vk'); ?>

	<?php if ( !is_home() && !is_search() && !is_category('authors') ) get_template_part('widget', 'sidebar-social--facebook'); ?>

	<?php if ( !is_home() && !is_category('wiki') ) get_template_part('widget', 'sidebar-wiki'); ?>

</div>
