<?php

// カテゴリー編集用入力欄を出力 -------------------------------------------------------
function case_study_category_edit_extra_fields( $term ) {
	$term_meta = get_option( 'taxonomy_' . $term->term_id, array() );
	$term_meta = array_merge( array(
		'desc_mobile' => '',
		'headline' => '',
		'catch' => '',
		'color' => '#000000',
		'header_image' => false,
		'overlay_color' => '#000000',
		'overlay_opacity' => '0.2',
	), $term_meta );

  $options = get_design_plus_option();
?>
<tr class="form-field term-order-wrap">
 <th><label for="term-order"><?php _e('Description(mobile)', 'tcd-seeed'); ?></label></th>
 <td><textarea placeholder="<?php _e( 'Please indicate if you would like to display a short text for mobile sizes.', 'tcd-seeed' ); ?>" cols="50" rows="5" name="term_meta[desc_mobile]"><?php echo esc_textarea(  $term_meta['desc_mobile'] ); ?></textarea></td>
</tr><!-- END .form-field -->
<tr class="form-field">
	<th colspan="2">

<div class="custom_category_meta">
 <h3 class="ccm_headline"><?php _e( 'Basic setting', 'tcd-seeed' ); ?></h3>
 <div class="ccm_content clearfix">
  <div class="input_field">
   <div class="cb_image">
    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/case_study_category_image.jpg?2.0" alt="" title="" />
   </div>
   <ul class="option_list">
    <li class="cf"><span class="label"><span class="num">1</span><?php _e('Headline', 'tcd-seeed'); ?></span><input type="text" class="full_width" name="term_meta[headline]" value="<?php echo esc_html($term_meta['headline'] ); ?>" /></li>
    <li class="cf"><span class="label"><span class="num">2</span><?php _e('Catchphrase', 'tcd-seeed'); ?></span><input type="text" class="full_width" name="term_meta[catch]" value="<?php echo esc_html($term_meta['catch']); ?>" /></li>
    <li class="cf"><span class="label"><span class="num">3</span><?php _e('Color', 'tcd-seeed'); ?></span><input type="text" name="term_meta[color]" value="<?php echo esc_attr( $term_meta['color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
   </ul>
  </div><!-- END input_field -->
 </div><!-- END ccm_content -->

</div><!-- END .custom_category_meta -->

<div class="custom_category_meta">
 <h3 class="ccm_headline"><?php _e( 'Category page header', 'tcd-seeed' ); ?></h3>

 <div class="ccm_content clearfix">
  <div class="input_field">
   <div class="cb_image">
    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/case_study_category_page_image.jpg" alt="" title="" />
   </div>
   <ul class="option_list">
    <li class="cf">
     <span class="label">
      <?php _e('Image', 'tcd-seeed'); ?>
      <span class="recommend_desc"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-seeed'), '1450', '400'); ?></span>
     </span>
     <div class="image_box cf">
      <div class="cf cf_media_field hide-if-no-js header_image">
       <input type="hidden" value="<?php if ( $term_meta['header_image'] ) echo esc_attr( $term_meta['header_image'] ); ?>" id="header_image" name="term_meta[header_image]" class="cf_media_id">
       <div class="preview_field"><?php if ( $term_meta['header_image'] ) echo wp_get_attachment_image( $term_meta['header_image'], 'medium'); ?></div>
       <div class="button_area">
        <input type="button" value="<?php _e( 'Select Image', 'tcd-seeed' ); ?>" class="cfmf-select-img button">
        <input type="button" value="<?php _e( 'Remove Image', 'tcd-seeed' ); ?>" class="cfmf-delete-img button <?php if ( ! $term_meta['header_image'] ) echo 'hidden'; ?>">
       </div>
      </div>
     </div>
    </li>
    <li class="cf"><span class="label"><?php _e('Overlay color', 'tcd-seeed'); ?></span><input type="text" name="term_meta[overlay_color]" value="<?php echo esc_attr( $term_meta['overlay_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
    <li class="cf">
     <span class="label"><?php _e('Transparency of overlay', 'tcd-seeed'); ?></span><input class="hankaku" style="width:70px;" type="number" min="0" max="1" step="0.1" name="term_meta[overlay_opacity]" value="<?php echo esc_attr( $term_meta['overlay_opacity'] ); ?>" />
     <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
      <p><?php _e('Please specify the number of 0 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-seeed');  ?>
      <?php _e('Please enter 0 if you don\'t want to use overlay.', 'tcd-seeed');  ?></p>
     </div>
    </li>
   </ul>

  </div><!-- END input_field -->
 </div><!-- END ccm_content -->

</div><!-- END .custom_category_meta -->

 </th>
</tr><!-- END .form-field -->
<?php
}
add_action( 'case_study_category_edit_form_fields', 'case_study_category_edit_extra_fields' );


// データを保存 -------------------------------------------------------
function case_study_category_save_extra_fileds( $term_id ) {
  $new_meta = array();
  if ( isset( $_POST['term_meta'] ) ) {
		$current_term_id = $term_id;
		$cat_keys = array_keys( $_POST['term_meta'] );
		foreach ( $cat_keys as $key ) {
			if ( isset ( $_POST['term_meta'][$key] ) ) {
				$new_meta[$key] = $_POST['term_meta'][$key];
			}
		}
	}
  update_option( "taxonomy_$current_term_id", $new_meta );
}
add_action( 'edited_case_study_category', 'case_study_category_save_extra_fileds' );


