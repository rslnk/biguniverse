<?php get_header(); ?>

<div id="container">
	
	<section id="content">

	<div id="extras-block" class="column-1x">

		<div id="projects-block" class="block x1">

				<div id="category" class="videos avatar"><i class="awesome icon-play-circle"></i></div>

				<div class="head">Рубрики</div>

				<?php get_projects('videos', 8); //hook ?>

		</div> <!-- /projects-block -->

	</div>	

		<div id="posts-block" class="column-3x">	
		
		<?php get_template_part( 'loop', 'tiles' ); ?>
	
	</section>	
	
	<aside id="sidebar">

		<?php get_sidebar(); ?>
	
	</aside>
	
	<div class="clear"></div>

</div><!-- #container -->

<?php get_footer(); ?>