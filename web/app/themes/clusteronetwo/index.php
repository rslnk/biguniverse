<?php get_header(); ?>

<div id="container">
	
	<section id="content">

		<div id="posts-block" class="column-2x">

		<?php loop_filter (); // hook отфилтровываем статьи из категории «видео» и wiki, кол-во постов = 9 ?>

		<?php get_template_part( 'loop', 'tiles' ); ?>

		</div> <!-- /posts-block column -->

		<div id="extras-block" class="column-2x">

			<div id="videos-block">

				<?php query_posts('category_name=videos&showposts=3'); // показываем последние 3 поста из категории «видео» ?>

					<?php if ( have_posts() ) : ?>
						
						<?php while ( have_posts() ) : the_post(); ?>
							
							<article id="video" class="block x2 inline">
												
								<div class="imagewrap">
									<div class="tint">
										<a class="thumbnail" href="<?php the_permalink() ?>"><i class="icon-video"></i><?php the_post_thumbnail( 'x1' ); ?></a>
									</div>
								</div>

								<div class="caption x1">
									<div class="title"><h2><a href="<?php the_permalink(); ?>" rel="bookmark"> <?php custom_title(); //hook ?><?php editingLink(); //hook ?></h2></a></div>												
								</div>

							</article> <!-- /video --> 

						<?php endwhile; ?>	
						
					<?php endif; ?>

				<?php wp_reset_query(); ?>	


			</div> <!-- /videos-block -->
		
			<div id="projects-block" class="block x1 inline">

				<div class="head">Рубрики</div>

				<?php get_projects('posts', 8); //hook ?>

			</div> <!-- /projects-block -->

			<div id="authors-block" class="block x1 inline">

				<div class="head">Авторы</div>
				<?php get_authors(); // hook ?>

			</div> <!-- /authors-block -->

		</div><!-- / extras block (videos, projects, authors -->
	
	</section>
	
	<aside id="sidebar">

		<?php get_sidebar(); ?>
	
	</aside>
	
	<div class="clear"></div>
		
</div>

<?php get_footer(); ?>