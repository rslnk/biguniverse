<?php get_header(); ?>

<div id="container">
	
	<section id="content">

	<div id="extras-block" class="column-1x">

		<div id="projects-block" class="block x1">

				<div class="head">Рубрики</div>

<?php 
// get parent category slug Функция находит родительскую категорию и передает ее в нашу функцию get_projects
foreach((get_the_category()) as $childcat) {
   $parentcat = $childcat->category_parent;
   if ($parentcat) break;  // Save only first parent
}
$category = &get_category($parentcat);

   get_projects($category->slug, 12);
?>

		</div> <!-- /projects-block -->

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