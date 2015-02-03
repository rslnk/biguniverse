<?php
/**
 * The meta box for post SEO keywords and description.
 * Meta key-1: post_seo_keywords
 * Meta key-2: post_seo_description
 *
 * @package WordPress
 * @subpackage Clusterone
 * @since Clusterone 1.8
 */


add_action( 'add_meta_boxes', 'seo_meta_box_add' );
function seo_meta_box_add()
{
  add_meta_box( 'post-seo-keywords-and-description', 'SEO', 'seo_meta_box', 'post', 'advanced', 'core' );
}

function seo_meta_box( $post )
{
  $post_seo_values = get_post_custom( $post->ID );
  $post_keywords = isset( $post_seo_values['post_seo_keywords'] ) ? esc_attr( $post_seo_values['post_seo_keywords'][0] ) : '';
  $post_description = isset( $post_seo_values['post_seo_description'] ) ? esc_attr( $post_seo_values['post_seo_description'][0] ) : '';
  wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );
  ?>

  <SCRIPT LANGUAGE="JavaScript">
      <!-- Begin
      function countChars(field,cntfield) {
      cntfield.value = field.value.length;
      }
      //  End -->
  </script>

  <span>
    <label for="post_seo_keywords"><strong>Ключевые слова</strong></label>
    <input type="text" name="post_seo_keywords" id="post_seo_keywords" value="<?php echo $post_keywords; ?>" style="width:100%; margin-bottom:8px; margin-top:5px" />

    <label for="post_seo_description"><strong>Описание</strong><input readonly type="text" name="length1" size="2" maxlength="3" value=" " style="background:none; border:none;" /></label>
    <?php echo '<textarea rows="1" name="post_seo_description" id="post_seo_description" style="width:100%; margin-top:1px" onKeyDown="countChars(document.post.post_seo_description,document.post.length1)" onKeyUp="countChars(document.post.post_seo_description,document.post.length1)">' . $post_description . '</textarea>' ?>
  </span>
  <?php 
}


add_action( 'save_post', 'seo_meta_box_save' );
function seo_meta_box_save( $post_id )
{
  // Bail if we're doing an auto save
  if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
  
  // if our nonce isn't there, or we can't verify it, bail
  if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ) return;
  
  // if our current user can't edit this post, bail
  if( !current_user_can( 'edit_post' ) ) return;   
 
  // Probably a good idea to make sure your data is set
  if( isset( $_POST['post_seo_keywords'] ) )
    update_post_meta( $post_id, 'post_seo_keywords', esc_attr( $_POST['post_seo_keywords'] ) );
  else 
    delete_post_meta( $post_id, 'post_seo_keywords', $post_keywords );
  
  // Probably a good idea to make sure your data is set
  if( isset( $_POST['post_seo_description'] ) )
    update_post_meta( $post_id, 'post_seo_description', esc_attr( $_POST['post_seo_description'] ) );
  else 
    delete_post_meta( $post_id, 'post_seo_description', $post_description );  

}
?>