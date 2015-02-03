<?php get_header(); ?>

<div id="container">
	
	<section id="content">

	<div id="extras-block" class="column-1x">

		<div id="category" class="wiki avatar"><i class="awesome icon-book"></i></div>

		<div id="projects-block" class="block x1">

				<div class="head">Рубрики</div>

				<?php get_projects ('wiki', 12); //hook ?>

		</div> <!-- /projects-block -->	

	</div>	

		<div id="posts-block" class="column-3x compact listview">	

		 	<?php while (have_posts()) : the_post(); // main query starting the loop ?>

						<article id="wiki" class="block">
							<div class="caption x3">
								<div class="label"><i class="awesome icon-bookmark"></i><?php show_subcategory(); ?></div>
								<div class="title"><h2><a href="<?php the_permalink(); ?>" rel="bookmark"><?php custom_title(); ?><?php editingLink(); ?></h2></a></div>
								<div class="meta">
									<span class="author"><a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php the_author(); ?></a></span>
									<span class="date">,  <i class="icon-time">  </i><?php the_russian_time( 'j R Y' ); ?></span>
								</div>
							</div>

						</article> <!-- /wiki post-->

			<?php endwhile; ?>

		</div>
	

			<?php wp_reset_query(); ?>

	</section>	
	
	<aside id="sidebar">

		<?php get_sidebar(); ?>
	
	</aside>
	
	<div class="clear"></div>

</div><!-- #container -->

<?php get_footer(); ?>