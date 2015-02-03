<?php
/**
 * The meta box for post custom title (visual html title).
 * Meta key: custom_title
 *
 * @package WordPress
 * @subpackage Clusterone
 * @since Clusterone 1.8
 */


add_action( 'add_meta_boxes', 'custom_title_meta_box_add' );
function custom_title_meta_box_add()
{
  add_meta_box( 'custom-post-title', 'Заголовок', 'custom_title_meta_box', 'post', 'side', 'high' );
}

function custom_title_meta_box( $post )
{
  $custom_post_value = get_post_custom( $post->ID );
  $custom_title = isset( $custom_post_value['custom_title'] ) ? esc_textarea( $custom_post_value['custom_title'][0] ) : '';
  wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );
  ?>
<p>
  <?php echo '<textarea rows="4" cols="34" name="custom_title" id="custom_title">' . $custom_title . '</textarea>' ?>
  <p>Важная часть заголовка выделяется тегом &#60strong&#62<strong>Например</strong>&#60/strong&#62.</p>
</p>

  <?php 
}

add_action( 'save_post', 'custom_title_meta_box_save' );
function custom_title_meta_box_save( $post_id )
{
  // Bail if we're doing an auto save
  if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
  
  // if our nonce isn't there, or we can't verify it, bail
  if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ) return;
  
  // if our current user can't edit this post, bail
  if( !current_user_can( 'edit_post' ) ) return;   
 
  // Probably a good idea to make sure your data is set
  if( isset( $_POST['custom_title'] ) )
    update_post_meta( $post_id, 'custom_title', $_POST['custom_title'] );
  else 
    delete_post_meta( $post_id, 'custom_title', $_POST['custom_title'] );
}
?>