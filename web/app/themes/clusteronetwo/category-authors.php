<?php get_header(); ?>

<div id="container">
	
	<section id="content">

	<div id="extras-block" class="column-1x">

		<div id="projects-block" class="block x1">

				<div id="category" class="photos avatar"><i class="awesome icon-pencil"></i></div>

				<div class="head">Рубрики</div>

				<?php get_projects('posts', 8); //hook ?>

		</div> <!-- /projects-block -->

	</div>		

	<div id="authors-block" class="column-3x">

		<?php get_authors(); // hook ?>

	</div> <!-- /authors-block -->

	</section>	
	
	<aside id="sidebar">

		<?php get_sidebar(); ?>
	
	</aside>
	
	<div class="clear"></div>

</div><!-- #container -->

<?php get_footer(); ?>