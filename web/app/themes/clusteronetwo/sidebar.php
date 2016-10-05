<div id="sidebar" class="x2">

    <?php if ( !is_single() ) get_template_part('widget', 'widget-sidebar-teaser--bolshaya-medvedica'); ?>

    <?php if ( !is_tag('juno') ) get_template_part('widget', 'sidebar-posts--juno'); ?>

    <?php if ( !is_tag('rasskazy-o-zvezdah') ) get_template_part('widget', 'sidebar-posts--stars-stories'); ?>

    <?php if ( !is_tag('rasskazy-o-sozvezdiyah') ) get_template_part('widget', 'sidebar-posts--constellations-stories'); ?>

    <?php if ( !is_search() ) get_template_part('widget', 'sidebar-social--twitter'); ?>

    <?php if ( !is_search() ) get_template_part('widget', 'sidebar-social--vk'); ?>

    <?php if ( !is_search() ) get_template_part('widget', 'sidebar-social--facebook'); ?>

    <?php if ( !is_home() && !is_category('wiki') ) get_template_part('widget', 'sidebar-wiki'); ?>

</div>
