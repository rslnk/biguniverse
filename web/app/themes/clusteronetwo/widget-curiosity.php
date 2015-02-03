<div id="curiosity-block">

	<div class="head"><h1><strong>Марсоход Curiosity<br /></strong>новости, фото и видео с Марса</h1><div class="split"></div></div>


	<?php query_posts('tag=curiosity&showposts=3'); ?>

		<?php if ( have_posts() ) : ?>
			
			<?php while ( have_posts() ) : the_post(); ?>
				
				<article id="curiosity-post">

					<div class="caption">
						<div class="title"><h2><a href="<?php the_permalink(); ?>" rel="bookmark"><?php custom_title(); ?></a></h2></div>
						<div class="split"></div>									
					</div>

				</article>

			<?php endwhile; ?>	
			
		<?php endif; ?>

	<?php wp_reset_query(); ?>

	<div class="center"><div id="wiki"><a href="<?php echo home_url(); ?>/tag/curiosity" class="button"><span>Все материалы<i class="awesome icon-chevron-right "></i></span></a></div></div>

</div>