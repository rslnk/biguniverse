<?php
/**
 * The meta box for post item layout, size and on cover options
 * Meta key-1: post-size
 * Meta key-2: post_on_cover
 *
 * @package WordPress
 * @subpackage Clusterone
 * @since Clusterone 1.0
 */


add_action( 'add_meta_boxes', 'layout_meta_box_add' );
function layout_meta_box_add()
{
	add_meta_box( 'size-and-post-on-cover', 'Верстка', 'layout_meta_box', 'post', 'side', 'default' );
}

function layout_meta_box( $post )
{
	$values = get_post_custom( $post->ID );
	//$text = isset( $values['my_meta_box_text'] ) ? esc_attr( $values['my_meta_box_text'][0] ) : '';
	$selected = isset( $values['post-size'] ) ? esc_attr( $values['post-size'][0] ) : '';
	$check = isset( $values['post_on_cover'] ) ? esc_attr( $values['post_on_cover'][0] ) : '';
	wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );
	?>
	<p>
		<label for="post-size">Размер ячейки</label>
		<select name="post-size" id="post-size">
			<option value="x1" <?php selected( $selected, 'x1' ); ?>>120x120</option>
			<option value="x2" <?php selected( $selected, 'x2' ); ?>>300x80</option>
		</select>
	</p>
	<p>
		<input type="checkbox" name="post_on_cover" id="post_on_cover" <?php checked( $check, 'on' ); ?> />
		<label for="post_on_cover">Поместить на обложку.</label>
	</p>	

	<?php	
}

add_action( 'save_post', 'layout_meta_box_save' );
function layout_meta_box_save( $post_id )
{
	// Bail if we're doing an auto save
	if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	
	// if our nonce isn't there, or we can't verify it, bail
	if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ) return;
	
	// if our current user can't edit this post, bail
	if( !current_user_can( 'edit_post' ) ) return;
		
	// saving post-size value
	if( isset( $_POST['post-size'] ) )
		update_post_meta( $post_id, 'post-size', esc_attr( $_POST['post-size'] ) );

	// saving post_on_cover value
		$chk = ( isset( $_POST['post_on_cover'] ) && $_POST['post_on_cover'] ) ? 'on' : 'off';
		update_post_meta( $post_id, 'post_on_cover', $chk ); 
}
?>