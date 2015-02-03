<?php get_header(); ?>

<div id="container">
	
	<section id="content" class="single block-full">	
	
	<div class="category ">

		<?php the_post(); ?>
		
		<h1 class="title"><?php the_title(); ?></h1>
		<br />
		<div class="profile-split"></div>
	
	</div>
	
	<br />
	<br />
	
	<div class="post-content"><?php the_content(); ?></div>
	
	</section>

	<div class="clear"></div>	

</div><!-- #container -->

<?php get_footer(); ?>