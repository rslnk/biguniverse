<div class="post-navigation">

	<div class="next">

	<div class="post-thumbnail">
	<?php $nextPost = get_next_post(true); if($nextPost) { $nextThumbnail = get_the_post_thumbnail($nextPost->ID, 'x1'); } ?><?php if($nextPost) next_post_link( '%link', $nextThumbnail); ?>
	</div>
	
	<?php if ($nextPost) { $nextCustomTitle = get_post_meta($nextPost->ID, 'custom_title', true); } // getting custom_title value from the next post ?>
	<?php 
	if ($nextPost && $nextCustomTitle) { ?>
			<div class="post-navigation-next"><?php  next_post_link( '%link', $nextCustomTitle, true );?> </div>
		<?php } else { // if post custom_title is not set fallback to original post title ?>
			<div class="post-navigation-next"><?php  next_post_link( '%link', '%title', true );?> </div>
	<?php } ?>
		<?php if($nextPost) next_post_link( '%link', '<span class="post-navigation-larr"></span>' ); // left arrow with link ?>

	</div>
	
	
	<div class="previous">
	<?php $prevPost = get_previous_post(true); if($prevPost) previous_post_link( '%link', '<span class="post-navigation-rarr"></span>' ); // right arrow with link ?>

	<?php if ($prevPost) { $prevCustomTitle = get_post_meta($prevPost->ID, 'custom_title', true); } // getting custom_title value from the previous post ?>
	<?php 
	if ($prevPost && $prevCustomTitle) { ?>
			<div class="post-navigation-previous"><?php  previous_post_link( '%link', $prevCustomTitle, true );?> </div>
		<?php } else { // if post custom_title is not set fallback to original post title ?>
			<div class="post-navigation-previous"><?php  previous_post_link( '%link', '%title', true );?> </div>
	<?php } ?>
	
	<div class="post-thumbnail">
	<?php if($prevPost) { $prevThumbnail = get_the_post_thumbnail($prevPost->ID, 'x1'); } ?><?php if($prevPost) previous_post_link( '%link', $prevThumbnail); ?>
	</div>
	</div>

</div>