<?php get_header(); ?>

<div id="container">
	
	<section id="content">

	<div id="extras-block" class="column-1x">

		<div id="projects-block" class="block x1">

				<div class="head">Рубрики</div>

				<?php get_projects ('posts', 12); //hook ?>

		</div> <!-- /projects-block -->

		<div id="authors-block" class="block x1">

			<div class="head">Авторы</div>
			
			<?php get_authors(); // hook ?>

		</div> <!-- /authors-block -->

	</div>	

		<div id="posts-block" class="column-3x listview">	
		
		<?php get_template_part( 'loop' ); ?>
	
	</section>	
	
	<aside id="sidebar">

		<?php get_sidebar(); ?>
	
	</aside>
	
	<div class="clear"></div>

</div><!-- #container -->

<?php get_footer(); ?>