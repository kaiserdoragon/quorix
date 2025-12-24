<?php
/*
 * FAQの設定
 */


// Add default values
add_filter( 'before_getting_design_plus_option', 'add_faq_dp_default_options' );


// Add label of logo tab
add_action( 'tcd_tab_labels', 'add_faq_tab_label' );


// Add HTML of logo tab
add_action( 'tcd_tab_panel', 'add_faq_tab_panel' );


// Register sanitize function
add_filter( 'theme_options_validate', 'add_faq_theme_options_validate' );


// タブの名前
function add_faq_tab_label( $tab_labels ) {
  $options = get_design_plus_option();
  if($options['use_faq']){
    $tab_label = $options['faq_label'] ? esc_html( $options['faq_label'] ) : __( 'FAQ', 'tcd-seeed' );
  } else {
    $title = $options['faq_label'] ? esc_html( $options['faq_label'] ) : __( 'FAQ', 'tcd-seeed' );
    $tab_label = __('(N/A) ', 'tcd-seeed') . $title;
  }
  $tab_labels['faq'] = $tab_label;
  return $tab_labels;
}


// 初期値
function add_faq_dp_default_options( $dp_default_options ) {

	// 基本設定
	$dp_default_options['use_faq'] = '1';
	$dp_default_options['faq_label'] = __( 'FAQ', 'tcd-seeed' );
	$dp_default_options['faq_slug'] = 'faq';

	// アーカイブページ
	$dp_default_options['archive_faq_headline'] = __( 'FAQ', 'tcd-seeed' );
	$dp_default_options['archive_faq_desc'] = __( 'Description will be displayed here.', 'tcd-seeed' );
	$dp_default_options['archive_faq_desc_mobile'] = '';
	$dp_default_options['archive_faq_header_image'] = false;
	$dp_default_options['archive_faq_overlay_color'] = '#000000';
	$dp_default_options['archive_faq_overlay_opacity'] = '0.3';
	$dp_default_options['archive_faq_num'] = '5';
	$dp_default_options['archive_faq_num_sp'] = '5';


	return $dp_default_options;

}


// 入力欄の出力　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_faq_tab_panel( $options ) {

  global $dp_default_options, $basic_display_options;
  $faq_label = $options['faq_label'] ? esc_html( $options['faq_label'] ) : __( 'FAQ', 'tcd-seeed' );

?>

<div id="tab-content-faq" class="tab-content">


   <?php // 有効化 -------------------------------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac active open custon_post_usage_option">
    <h3 class="theme_option_headline"><?php _e('Validation', 'tcd-seeed');  ?></h3>
    <div class="theme_option_field_ac_content">

     <div class="theme_option_message2 custon_post_usage_option_message" style="<?php if($options['use_faq']){ echo 'display:none;'; } else { echo 'display:block;'; }; ?>">
      <p><?php printf(__('Currently, all function related to custom post "%s" have been disabled.<br>All areas that have already been set up will be hidden from the site.<br>Please use this option only if you don\'t want to use the custom post "%s" at all. (No archive page will be generated either).', 'tcd-seeed'), $faq_label, $faq_label); ?></p>
     </div>
     <div class="theme_option_message2" style="<?php if($options['use_faq']){ echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <p><?php printf(__('Please check off the checkbox if you don\'t want to use custom post "%s".', 'tcd-seeed'), $faq_label); ?></p>
     </div>
     <p><label><input class="custon_post_usage_option_checkbox" name="dp_options[use_faq]" type="checkbox" value="1" <?php checked( 1, $options['use_faq'] ); ?>><?php printf(__('Use custom post "%s"', 'tcd-seeed'), $faq_label); ?></label></p>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-seeed' ); ?>" /></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // 基本設定 -------------------------------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Common setting', 'tcd-seeed');  ?></h3>
    <div class="theme_option_field_ac_content">

     <div class="front_page_image">
      <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/content_name_url.jpg" alt="" title="" />
     </div>

     <h4 class="theme_option_headline_number"><span class="num">1</span><?php _e('Name of content', 'tcd-seeed');  ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('This name will be used in administration screen and the text link to the archive page.', 'tcd-seeed'); ?></p>
     </div>
     <input type="text" name="dp_options[faq_label]" value="<?php echo esc_attr( $options['faq_label'] ); ?>" />

     <h4 class="theme_option_headline_number"><span class="num">2</span><?php _e('Slug', 'tcd-seeed');  ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('Please enter word by alphabet only.<br />After changing slug, please update permalink setting form <a href="./options-permalink.php" target="_blank"><strong>permalink option page</strong></a>.', 'tcd-seeed'); ?></p>
     </div>
     <p><input class="hankaku" type="text" name="dp_options[faq_slug]" value="<?php echo sanitize_title( $options['faq_slug'] ); ?>" /></p>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-seeed' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-seeed' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // アーカイブページ ----------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Archive page', 'tcd-seeed'); ?></h3>
    <div class="theme_option_field_ac_content">

     <div class="front_page_image">
      <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/faq_archive_image.jpg" alt="" title="" />
     </div>

     <div class="theme_option_message2">
      <p><?php printf(__('Single page will not be created in "%s".', 'tcd-seeed'), $faq_label); ?><br /><?php printf(__('All titles (questions) and bodies (answers) registered on <a href="./edit.php?post_type=faq" target="_blank">the edit screen</a> will appear on the <a href="%s" target="_blank">archive page</a>.', 'tcd-seeed'), esc_url(get_post_type_archive_link('faq'))); ?></p>
     </div>

     <ul class="option_list">
      <li class="cf"><span class="label"><span class="num">1</span><?php _e('Headline', 'tcd-seeed'); ?></span><input type="text" class="full_width" name="dp_options[archive_faq_headline]" value="<?php echo esc_attr($options['archive_faq_headline']); ?>" ></li>
      <li class="cf"><span class="label"><span class="num">2</span><?php _e('Description', 'tcd-seeed'); ?></span><textarea class="full_width" cols="50" rows="3" name="dp_options[archive_faq_desc]"><?php echo esc_textarea(  $options['archive_faq_desc'] ); ?></textarea></li>
      <li class="cf" style="border:none;"><span class="label"><span class="num_space"></span><?php _e('Description (mobile)', 'tcd-seeed'); ?></span><textarea placeholder="<?php _e( 'Please indicate if you would like to display a short text for mobile sizes.', 'tcd-seeed' ); ?>" class="full_width" cols="50" rows="3" name="dp_options[archive_faq_desc_mobile]"><?php echo esc_textarea(  $options['archive_faq_desc_mobile'] ); ?></textarea></li>
      <li class="cf">
       <span class="label">
        <span class="num">3</span><?php _e('Image', 'tcd-seeed'); ?>
        <span class="recommend_desc space"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-seeed'), '1450', '400'); ?></span>
        <span class="recommend_desc space"><?php _e('This image will also be used in article page.', 'tcd-seeed'); ?></span>
       </span>
       <div class="image_box cf">
        <div class="cf cf_media_field hide-if-no-js archive_faq_header_image">
         <input type="hidden" value="<?php echo esc_attr( $options['archive_faq_header_image'] ); ?>" id="archive_faq_header_image" name="dp_options[archive_faq_header_image]" class="cf_media_id">
         <div class="preview_field"><?php if($options['archive_faq_header_image']){ echo wp_get_attachment_image($options['archive_faq_header_image'], 'medium'); }; ?></div>
         <div class="buttton_area">
          <input type="button" value="<?php _e('Select Image', 'tcd-seeed'); ?>" class="cfmf-select-img button">
          <input type="button" value="<?php _e('Remove Image', 'tcd-seeed'); ?>" class="cfmf-delete-img button <?php if(!$options['archive_faq_header_image']){ echo 'hidden'; }; ?>">
         </div>
        </div>
       </div>
      </li>
      <li class="cf" style="border:none;">
       <span class="label"><span class="num_space"></span><?php _e('Color of overlay', 'tcd-seeed'); ?></span><input type="text" name="dp_options[archive_faq_overlay_color]" value="<?php echo esc_attr( $options['archive_faq_overlay_color'] ); ?>" data-default-color="#000000" class="c-color-picker">
       <div class="theme_option_message2 space" style="clear:both; margin:40px 0 0 0;">
        <p><?php _e('This overlay will also be used in article page.', 'tcd-seeed'); ?></p>
       </div>
      </li>
      <li class="cf" style="border:none;">
       <span class="label"><span class="num_space"></span><?php _e('Transparency of overlay', 'tcd-seeed'); ?></span><input class="hankaku" style="width:70px;" type="number" min="0" max="1" step="0.1" name="dp_options[archive_faq_overlay_opacity]" value="<?php echo esc_attr( $options['archive_faq_overlay_opacity'] ); ?>" />
       <div class="theme_option_message2 space" style="clear:both; margin:7px 0 0 0;">
        <p><?php _e('Please specify the number of 0 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-seeed');  ?>
        <?php _e('Please enter 0 if you don\'t want to use overlay.', 'tcd-seeed');  ?></p>
       </div>
      </li>
     </ul>

     <h4 class="theme_option_headline2"><?php printf(__('%s list', 'tcd-seeed'), $faq_label); ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('This setting is also linked to the number of additional articles to be loaded by load button in archive page.', 'tcd-seeed'); ?></p>
     </div>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php echo tcd_admin_label('article_list_num'); ?></span><?php echo tcd_display_post_num_option_type2($options, 'archive_faq_num'); ?></li>
     </ul>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-seeed' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-seeed' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


</div><!-- END .tab-content -->

<?php
} // END add_faq_tab_panel()


// バリデーション　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_faq_theme_options_validate( $input ) {

  global $dp_default_options;

  //基本設定
  $input['use_faq'] = wp_filter_nohtml_kses( $input['use_faq'] );
  $input['faq_slug'] = sanitize_title( $input['faq_slug'] );
  $input['faq_label'] = wp_filter_nohtml_kses( $input['faq_label'] );


  // アーカイブ
  $input['archive_faq_headline'] = wp_filter_nohtml_kses( $input['archive_faq_headline'] );
  $input['archive_faq_desc'] = wp_kses_post( $input['archive_faq_desc'] );
  $input['archive_faq_desc_mobile'] = wp_kses_post( $input['archive_faq_desc_mobile'] );
  $input['archive_faq_header_image'] = wp_filter_nohtml_kses( $input['archive_faq_header_image'] );
  $input['archive_faq_overlay_color'] = wp_filter_nohtml_kses( $input['archive_faq_overlay_color'] );
  $input['archive_faq_overlay_opacity'] = wp_filter_nohtml_kses( $input['archive_faq_overlay_opacity'] );

  $input['archive_faq_num'] = wp_filter_nohtml_kses( $input['archive_faq_num'] );
  $input['archive_faq_num_sp'] = wp_filter_nohtml_kses( $input['archive_faq_num_sp'] );

	return $input;

};


?>