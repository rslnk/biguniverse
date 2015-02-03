<?php if (have_posts()) : ?>

				<?php while (have_posts()) : the_post(); // main query starting the loop ?>

					<?php if( $wp_query->current_post == 0 && !is_paged()) : // conditioning the latest post from the loop ?>

						<article id="cover" class="block x2 inline">

							<div class="imagewrap">
								<div class="tint">
									<a class="thumbnail" href="<?php the_permalink() ?>"><?php the_post_thumbnail( 'x1' ); ?></a>
								</div>
							</div>
								
							<div class="caption">
								<div class="label"><?php show_subcategory(); ?></div>
								<div class="title"><h2><a href="<?php the_permalink(); ?>" rel="bookmark"><?php custom_title(); ?><?php editingLink(); ?></h2></a></div>
							</div>

						</article> <!-- /cover post-->

					<?php elseif (in_category('photos')) : // applying photo icon for the articles in the main loop ?>

						<article id="post" class="block x1 inline">
			
							<div class="imagewrap">
								<div class="tint">
									<a class="icon-photo" href="<?php the_permalink() ?>"></a>
									<a class="thumbnail" href="<?php the_permalink() ?>"><?php the_post_thumbnail( 'x1' ); ?></a>		
								</div>
							</div>

							<div class="caption">
								<div class="label"><?php show_subcategory(); ?></div>
								<div class="title"><h2><a href="<?php the_permalink(); ?>" rel="bookmark"><?php custom_title(); ?><?php editingLink(); ?></h2></a></div>
							</div>					

						</article> <!-- /photo post -->

					<?php elseif (in_category('videos')) : // applying photo icon for the articles in the main loop ?>

						<article id="post" class="block x1 inline">
			
							<div class="imagewrap">
								<div class="tint">
									<a class="icon-video" href="<?php the_permalink() ?>"></a>
									<a class="thumbnail" href="<?php the_permalink() ?>"><?php the_post_thumbnail( 'x1' ); ?></a>		
								</div>
							</div>

							<div class="caption">
								<div class="label"><?php show_subcategory(); ?></div>
								<div class="title"><h2><a href="<?php the_permalink(); ?>" rel="bookmark"><?php custom_title(); ?><?php editingLink(); ?></h2></a></div>
							</div>					

						</article> <!-- /video post -->

					<?php else : // ...and now outputting the rest of the loop ?>

						<article id="post" class="block x1 inline">
			
							<div class="imagewrap">
								<div class="tint">
									<a class="thumbnail" href="<?php the_permalink() ?>"><?php the_post_thumbnail( 'x1' ); ?></a>
								</div>
							</div>

							<div class="caption">
								<div class="label"><?php show_subcategory(); ?></div>
								<div class="title"><h2><a href="<?php the_permalink(); ?>" rel="bookmark"><?php custom_title(); ?><?php editingLink(); ?></h2></a></div>	
							</div>					

						</article> <!-- /post -->

					<?php endif; ?>

				<?php endwhile; ?>
							 
	 		<?php endif; ?>

	 		<?php wp_reset_query(); ?>
	 			
<div class="pagination">

	<?php if (!is_home() && function_exists('pages')) pages(); ?>
	
</div>