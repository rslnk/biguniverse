<?php if (have_posts()) : ?>

	<?php while (have_posts()) : the_post(); // main query starting the loop ?>

		<?php if( $wp_query->current_post == 1 && is_paged()) : // conditioning the latest post from the loop ?>

			<article id="cover" class="block">

				<div class="imagewrap">
					<div class="tint">
						<a class="thumbnail" href="<?php the_permalink() ?>"><?php the_post_thumbnail('x2'); ?></a>
					</div>
				</div>
					
				<div class="caption">
					<div class="label"><?php show_subcategory(); ?></div>
					<div class="title"><h2><a href="<?php the_permalink(); ?>" rel="bookmark"><?php custom_title(); ?><?php editingLink(); ?></h2></a></div>
					<div class="meta">
						<span class="author"><a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php the_author(); ?></a></span>
						<span class="date">,  <i class="icon-time">  </i><?php the_russian_time( 'j R Y' ); ?></span>
					</div>
				</div>

			</article> <!-- /cover post-->

		<?php else : // ...and now outputting the rest of the loop ?>

			<article id="post" class="block">							
				<div class="imagewrap">
					<div class="tint">
						<a class="thumbnail" href="<?php the_permalink() ?>"><?php the_post_thumbnail('x1'); ?></a>
					</div>
				</div>

				<div class="caption x2">
					<div class="label"><?php show_subcategory(); ?></div>
					<div class="title"><h2><a href="<?php the_permalink(); ?>" rel="bookmark"><?php custom_title(); //hook ?><?php editingLink(); //hook ?></h2></a></div>												
					<div class="meta">
						<span class="author"><a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php the_author(); ?></a></span>
						<span class="date">,  <i class="icon-time">  </i><?php the_russian_time( 'j R Y' ); ?></span>
					</div>
				</div>

			</article> <!-- /post --> 

		<?php endif; ?>	

	<?php endwhile; ?>
				 
	<?php endif; ?>

	<?php wp_reset_query(); ?>
		
<div class="pagination">

	<?php if (!is_home() && function_exists('pages')) pages(); ?>
	
</div>