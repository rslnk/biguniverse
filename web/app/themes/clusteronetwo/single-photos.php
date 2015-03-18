<?php get_header(); ?>

<div id="container">

	<section id="content">

		<div id="block" class="column-6x">

			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				<article class="post photo-post">

					<div id="post-head">

						<div class="label"><?php show_subcategory(); ?></div>

						<h1 class="post-title"><?php custom_title(); ?></h1>

						<div class="meta">
							<span class="author"><a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php the_author(); ?></a></span>
							<span class="date">,  <i class="icon-time">  </i><?php the_russian_time( 'j R Y' ); ?>  <?php editingLink(); ?></span>
						</div>

						<?php get_template_part( 'share', 'panel' );?>

						<div class="split-top"></div>

						<div class="preamble"><?php the_excerpt(); ?></div>

					</div><!-- post-head -->

					<div class="post-content">

						<?php the_content(); ?>

					</div><!-- #post-content -->

					<div class="post-tags"><?php the_tags( '<strong>' . __('Теги: ', 'clusterone' ) . '</strong>' . '<span class="post-tags">', ", ", "\n\t\t\t\t\t\t\n" . '</span>' ); ?></div>

					<?php get_template_part( 'navigation' , 'post' ); ?>

				</article><!-- #post -->

		</div> <!-- post block -->

	</section>

	<div class="clear"></div>

</div><!-- #container -->

<div id="container">

	<section id="extras-block" class="column-4x">

		<div>
			<h1 class="head">Комментарии</h1>
			<br />
			<div class="split"></div>
		</div>

		<br /><br />

		<div class="split-comments">Комментарии <strong>ВКонтакте</strong></div>

			<div id="vk_comments"></div>
			<script type="text/javascript">
			VK.Widgets.Comments("vk_comments", {limit: 10, width: "650", attach: "*"});
			</script>
			<br /><br />
		<div class="split-comments">Комментарии <strong>Фейсбук</strong></div>
		<div id="fb-root"></div><script src="http://connect.facebook.net/ru_RU/all.js#xfbml=1"></script><fb:comments href="<?php echo get_permalink(); ?>" num_posts="20" width="650"></fb:comments>

	<?php endwhile; ?>

	</section>

	<aside id="sidebar">

		<?php get_template_part('widget','social-media'); ?>

	</aside>

	<div class="clear"></div>

</div><!-- #container -->

<?php get_footer(); ?>