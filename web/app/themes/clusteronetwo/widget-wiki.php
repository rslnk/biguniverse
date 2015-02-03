<div id="wiki-block">

	<div class="head"><i class="awesome icon-book icon-large"></i>Энциклопедия</div>
	<div style="font-size: 24px;">
</div>
	<div class="split"></div>	

	<?php query_posts('category_name=wiki&showposts=1'); ?>

		<?php if ( have_posts() ) : ?>
			
			<?php while ( have_posts() ) : the_post(); ?>
				
				<article id="wiki">

					<div class="caption">
						<div class="preamble"><i class="awesome icon-bookmark"></i><a href="<?php the_permalink(); ?>" rel="bookmark"><?php smart_excerpt(); ?></a></div>											
					</div>

					<a href="<?php the_permalink(); ?>" class="button"><span>Хочу узнать все<i class="awesome icon-chevron-right "></i></span></a>

				</article> <!-- /wiki article --> 

			<?php endwhile; ?>	
			
		<?php endif; ?>

	<?php wp_reset_query(); ?>	



</div>