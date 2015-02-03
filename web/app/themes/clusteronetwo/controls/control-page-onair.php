<?php


function onair_options() {
   add_theme_page('Ads options', 'Прямой эфир', 'manage_options', 'onair_options', 'onair_options_page');
}

add_action('admin_menu', 'onair_options', 2);
function onair_options_page() {
		?>
<div class="wrap">
		<div id="icon-themes" class="icon32"><br /></div>
		<h2>Прямой эфир</h2>
		<br /><br />

<form action="" method="post"><?php wp_nonce_field( 'update_seo_options', 'seo_options_nonce' ); ?>


<table class="form-table">
	<tbody>
		<tr valign="top">
			<th scope="row">Enable seo</th>
			<td><input type="checkbox" name="auto_enable_seo" <?php if(get_option('auto_enable_seo')) echo 'checked="checked"'; ?> value="yes" />
			</td>
		</tr>
		<tr valign="top">
			<th scope="row"><h3>Главная страница</h3></th>
			<td></td>
		</tr>
		<tr valign="top">
			<th scope="row">Название сайта (title)</th>
			<td><input type="text" name="home_title" class="regular-text" value="<?php echo get_option('home_title'); ?>" /></td>
		</tr>
		<tr valign="top">
			<th scope="row">Описание</th>
			<td><textarea name="home_desc" class="large-text"><?php echo get_option('home_desc'); ?></textarea></td>
		</tr>
		<tr valign="top">
			<th scope="row">Ключевые слова</th>
			<td><input type="text" name="home_keywords" class="regular-text" value="<?php echo get_option('home_keywords'); ?>" /></td>
		</tr>
		<tr valign="top">
			<th scope="row">Робот</th>
			<td>
			<select name="home_meta_robot">
			 <?php $options_array = array('index,follow', 'noindex,follow', 'noindex,nofollow', 'all');
				foreach($options_array as $op_value) {
					$is_selected = ($op_value == get_option('home_meta_robot')) ? 'selected="selected"' : '';
					echo '<option value="'.$op_value.'" '.$is_selected.'>'.$op_value.'</option>';
				}
			  ?>
			</select>
			</td>
		</tr>
	</tbody>
</table>
<br /><br />
<input type="hidden" name="update_seo_options" value="abx" />
<input class="button-primary" type="submit" name="submit" value="<?php _e('Save Changes') ?>" />

</form>

</div>
<?php 
}

if(isset($_POST['update_onair_options']) && $_POST['update_onair_options'] == 'abx' ) {
	//update_option('auto_enable_seo', $_POST['auto_enable_seo']);
}
?>