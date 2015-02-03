<?php if (have_posts()) : ?>

				<?php while (have_posts()) : the_post(); // main query starting the loop ?>

					<?php if (in_category('photos')) : // applying photo icon for the articles in the main loop ?>

						<article id="post" class="block search">

							<div class="imagewrap">
								<div class="tint">
									<a class="thumbnail" href="<?php the_permalink() ?>"><?php the_post_thumbnail('x1'); ?></a>
								</div>
							</div>
								
							<div class="caption x2">
								<div class="label"><i class="awesome icon-camera"></i><?php show_subcategory(); ?></div>
								<div class="title"><h2><a href="<?php the_permalink(); ?>" rel="bookmark"><?php custom_title(); ?><?php editingLink(); ?></h2></a></div>
								<div class="meta">
									<span class="author"><a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php the_author(); ?></a></span>
									<span class="date">,  <i class="icon-time">  </i><?php the_russian_time( 'j R Y г.' ); ?></span>
								</div>
							</div>

						</article> <!-- /photo post-->

					<?php elseif (in_category('videos')) : // applying video icon for the articles in the main loop ?>

						<article id="post" class="block">

							<div class="imagewrap">
								<div class="tint">
									<a class="thumbnail" href="<?php the_permalink() ?>"><?php the_post_thumbnail('x1'); ?></a>
								</div>
							</div>
								
							<div class="caption x2">
								<div class="label"><i class="awesome icon-play-circle"></i><?php show_subcategory(); ?></div>
								<div class="title"><h2><a href="<?php the_permalink(); ?>" rel="bookmark"><?php custom_title(); ?><?php editingLink(); ?></h2></a></div>
								<div class="meta">
									<span class="author"><a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php the_author(); ?></a></span>
									<span class="date">,  <i class="icon-time">  </i><?php the_russian_time( 'j R Y г.' ); ?></span>
								</div>
							</div>

						</article> <!-- /video post-->

					<?php elseif (in_category('wiki')) : // applying video icon for the articles in the main loop ?>

						<article id="post" class="block">

							<div class="imagewrap">
								<div class="tint">
									<a class="thumbnail" href="<?php the_permalink() ?>"><?php the_post_thumbnail('x1'); ?></a>
								</div>
							</div>
								
							<div class="caption x2">
								<div class="label"><i class="awesome icon-book"></i><?php show_subcategory(); ?></div>
								<div class="title"><h2><a href="<?php the_permalink(); ?>" rel="bookmark"><?php custom_title(); ?><?php editingLink(); ?></h2></a></div>
								<div class="meta">
									<span class="author"><a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php the_author(); ?></a></span>
									<span class="date">,  <i class="icon-time">  </i><?php the_russian_time( 'j R Y г.' ); ?></span>
								</div>
							</div>

						</article> <!-- /wiki post-->

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
									<span class="date">,  <i class="icon-time">  </i><?php the_russian_time( 'j R Y г.' ); ?></span>
								</div>
							</div>

						</article> <!-- /post --> 
						
					<?php endif; ?>

				<?php endwhile; ?>
							
		<?php endif; ?>

<div class="pagination"><?php if (function_exists('pages')) pages(); ?></div>
<?php wp_reset_query(); ?>