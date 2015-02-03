<?php get_header(); ?>

<div id="container">
	
	<section id="content">

	<div id="extras-block" class="column-1x">

			<div id="authors-block" class="block x1 inline">

				<article id="author">
						<div class="imagewrap">
				            <?php echo '<span class="thumbnail"><img src="' . get_template_directory_uri() . '/images/authors/' . $authordata->user_login . '.jpg"></span>'; ?>
				         </div>

				         <div class="caption">
				            <div class="head"><?php echo $authordata->display_name; ?><div class="split"></div></div>
				            <div class="bio"><?php $authordesc = $authordata->user_description; if ( !empty($authordesc) ) echo apply_filters( 'archive_meta', $authordesc ); ?></div>
				        	<div class="web">
				            	<?php $authorurl = get_the_author_meta('user_url'); ?>

								<?php if( !empty($authorurl) ) : ?>
								Сайт: 
								<a href="<?php the_author_meta('user_url'); ?>"><?php the_author_meta('user_url'); ?></a>
								
								<?php endif; ?>

								<?php rewind_posts(); ?>
							<div>
						</div>

				         </div>
			        </div>
			    </article>

		</div> <!-- /projects-block -->	

	</div>	

		<div id="posts-block" class="column-3x compact listview">	

			<?php get_template_part('loop', 'compact'); ?>

		</div>
	

			<?php wp_reset_query(); ?>

	</section>	
	
	<aside id="sidebar">

		<?php get_sidebar(); ?>
	
	</aside>
	
	<div class="clear"></div>

</div><!-- #container -->

<?php get_footer(); ?>