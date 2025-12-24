<?php
/*
 * 機能の設定
 */


// Add default values
add_filter( 'before_getting_design_plus_option', 'add_service_dp_default_options' );


// Add label of logo tab
add_action( 'tcd_tab_labels', 'add_service_tab_label' );


// Add HTML of logo tab
add_action( 'tcd_tab_panel', 'add_service_tab_panel' );


// Register sanitize function
add_filter( 'theme_options_validate', 'add_service_theme_options_validate' );


// タブの名前
function add_service_tab_label( $tab_labels ) {
  $options = get_design_plus_option();
  if($options['use_service']){
    $tab_label = $options['service_label'] ? esc_html( $options['service_label'] ) : __( 'Service', 'tcd-seeed' );
  } else {
    $title = $options['service_label'] ? esc_html( $options['service_label'] ) : __( 'Service', 'tcd-seeed' );
    $tab_label = __('(N/A) ', 'tcd-seeed') . $title;
  }
  $tab_labels['function'] = $tab_label;
  return $tab_labels;
}


// 初期値
function add_service_dp_default_options( $dp_default_options ) {

	// 基本設定
	$dp_default_options['use_service'] = '1';
	$dp_default_options['service_label'] = __( 'Service', 'tcd-seeed' );
	$dp_default_options['service_slug'] = 'service';
	$dp_default_options['service_icon_list_type'] = 'type1';

	// アーカイブページ
	$dp_default_options['archive_service_headline'] = __( 'Service', 'tcd-seeed' );
	$dp_default_options['archive_service_desc'] = __( 'Description will be displayed here.', 'tcd-seeed' );
	$dp_default_options['archive_service_desc_mobile'] = '';
	$dp_default_options['archive_service_header_image'] = false;
	$dp_default_options['archive_service_overlay_color'] = '#000000';
	$dp_default_options['archive_service_overlay_opacity'] = '0.3';
	$dp_default_options['archive_service_list_type'] = 'type1';

	$dp_default_options['archive_service_title_font_size'] = '32';
	$dp_default_options['archive_service_title_font_size_sp'] = '20';

	$dp_default_options['archive_service_num'] = '10';
	$dp_default_options['archive_service_num_sp'] = '6';


	// 詳細ページ
	$dp_default_options['service_title_font_size'] = '36';
	$dp_default_options['service_title_font_size_sp'] = '20';

	$dp_default_options['service_related_headline'] = __( 'Service list', 'tcd-seeed' );
	$dp_default_options['service_related_post_order'] = 'date';
	$dp_default_options['service_related_post_num'] = '4';
	$dp_default_options['service_related_post_num_sp'] = '4';

	// 記事ページの追加コンテンツ
	$dp_default_options['single_service_top_ad_code'] = '';
	$dp_default_options['single_service_top_ad_code_mobile'] = '';
	$dp_default_options['single_service_bottom_ad_code'] = '';
	$dp_default_options['single_service_bottom_ad_code_mobile'] = '';

	return $dp_default_options;

}


// 入力欄の出力　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_service_tab_panel( $options ) {

  global $dp_default_options, $basic_display_options, $font_type_options, $service_list_type_options, $service_icon_list_type_options;
  $service_label = $options['service_label'] ? esc_html( $options['service_label'] ) : __( 'Service', 'tcd-seeed' );

?>

<div id="tab-content-function" class="tab-content">


   <?php // 有効化 -------------------------------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac active open custon_post_usage_option">
    <h3 class="theme_option_headline"><?php _e('Validation', 'tcd-seeed');  ?></h3>
    <div class="theme_option_field_ac_content">

     <div class="theme_option_message2 custon_post_usage_option_message" style="<?php if($options['use_service']){ echo 'display:none;'; } else { echo 'display:block;'; }; ?>">
      <p><?php printf(__('Currently, all function related to custom post "%s" have been disabled.<br>All areas that have already been set up will be hidden from the site.<br>Please use this option only if you don\'t want to use the custom post "%s" at all. (No archive page will be generated either).', 'tcd-seeed'), $service_label, $service_label); ?></p>
     </div>
     <div class="theme_option_message2" style="<?php if($options['use_service']){ echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <p><?php printf(__('Please check off the checkbox if you don\'t want to use custom post "%s".', 'tcd-seeed'), $service_label); ?></p>
     </div>
     <p><label><input class="custon_post_usage_option_checkbox" name="dp_options[use_service]" type="checkbox" value="1" <?php checked( 1, $options['use_service'] ); ?>><?php printf(__('Use custom post "%s"', 'tcd-seeed'), $service_label); ?></label></p>

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
     <input type="text" name="dp_options[service_label]" value="<?php echo esc_attr( $options['service_label'] ); ?>" />

     <h4 class="theme_option_headline_number"><span class="num">2</span><?php _e('Slug', 'tcd-seeed');  ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('Please enter word by alphabet only.<br />After changing slug, please update permalink setting form <a href="./options-permalink.php" target="_blank"><strong>permalink option page</strong></a>.', 'tcd-seeed'); ?></p>
     </div>
     <p><input class="hankaku" type="text" name="dp_options[service_slug]" value="<?php echo sanitize_title( $options['service_slug'] ); ?>" /></p>

     <h4 class="theme_option_headline2"><?php _e('Post list layout', 'tcd-seeed'); ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('The functions will depend on the layout you choose. Please change it by the number of articles and with/without icons.<br />TypeC and D are useful when there are many articles.', 'tcd-seeed'); ?></p>
     </div>
     <div id="archive_service_list_type_option">
      <?php echo tcd_admin_image_radio_button($options, 'archive_service_list_type', $service_list_type_options) ?>
     </div>

     <h4 class="theme_option_headline2"><?php _e('Size of icon', 'tcd-seeed'); ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('Icons and text are set for <a href="./edit.php?post_type=service" target="_blank">each article</a>.<br />When you select large size, text area below the icon is also expanded.', 'tcd-seeed'); ?></p>
     </div>
     <p class="service_option_notice service_icon_list_type_option_notice"><?php _e('The following options are not available when TypeD is selected for "Post list layout".', 'tcd-seeed'); ?></p>
     <div class="service_icon_list_type_option">
      <?php echo tcd_admin_image_radio_button($options, 'service_icon_list_type', $service_icon_list_type_options) ?>
     </div>

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
      <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/service_archive_image.jpg" alt="" title="" />
     </div>

     <div class="theme_option_message2" style="margin-top:20px;">
      <p><?php printf(__('Header image also will be displayed in %s page.', 'tcd-seeed'), $service_label); ?></p>
     </div>

     <ul class="option_list">
      <li class="cf"><span class="label"><span class="num">1</span><?php _e('Headline', 'tcd-seeed'); ?></span><input type="text" class="full_width" name="dp_options[archive_service_headline]" value="<?php echo esc_attr($options['archive_service_headline']); ?>" ></li>
      <li class="cf"><span class="label"><span class="num">2</span><?php _e('Description', 'tcd-seeed'); ?></span><textarea class="full_width" cols="50" rows="3" name="dp_options[archive_service_desc]"><?php echo esc_textarea(  $options['archive_service_desc'] ); ?></textarea></li>
      <li class="cf" style="border:none;"><span class="label"><span class="num_space"></span><?php _e('Description (mobile)', 'tcd-seeed'); ?></span><textarea placeholder="<?php _e( 'Please indicate if you would like to display a short text for mobile sizes.', 'tcd-seeed' ); ?>" class="full_width" cols="50" rows="3" name="dp_options[archive_service_desc_mobile]"><?php echo esc_textarea(  $options['archive_service_desc_mobile'] ); ?></textarea></li>
      <li class="cf">
       <span class="label">
        <span class="num">3</span><?php _e('Image', 'tcd-seeed'); ?>
        <span class="recommend_desc space"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-seeed'), '1450', '400'); ?></span>
        <span class="recommend_desc space"><?php _e('This image will also be used in article page.', 'tcd-seeed'); ?></span>
       </span>
       <div class="image_box cf">
        <div class="cf cf_media_field hide-if-no-js archive_service_header_image">
         <input type="hidden" value="<?php echo esc_attr( $options['archive_service_header_image'] ); ?>" id="archive_service_header_image" name="dp_options[archive_service_header_image]" class="cf_media_id">
         <div class="preview_field"><?php if($options['archive_service_header_image']){ echo wp_get_attachment_image($options['archive_service_header_image'], 'medium'); }; ?></div>
         <div class="buttton_area">
          <input type="button" value="<?php _e('Select Image', 'tcd-seeed'); ?>" class="cfmf-select-img button">
          <input type="button" value="<?php _e('Remove Image', 'tcd-seeed'); ?>" class="cfmf-delete-img button <?php if(!$options['archive_service_header_image']){ echo 'hidden'; }; ?>">
         </div>
        </div>
       </div>
      </li>
      <li class="cf" style="border:none;">
       <span class="label"><span class="num_space"></span><?php _e('Color of overlay', 'tcd-seeed'); ?></span><input type="text" name="dp_options[archive_service_overlay_color]" value="<?php echo esc_attr( $options['archive_service_overlay_color'] ); ?>" data-default-color="#000000" class="c-color-picker">
       <div class="theme_option_message2 space" style="clear:both; margin:40px 0 0 0;">
        <p><?php _e('This overlay will also be used in article page.', 'tcd-seeed'); ?></p>
       </div>
      </li>
      <li class="cf" style="border:none;">
       <span class="label"><span class="num_space"></span><?php _e('Transparency of overlay', 'tcd-seeed'); ?></span><input class="hankaku" style="width:70px;" type="number" min="0" max="1" step="0.1" name="dp_options[archive_service_overlay_opacity]" value="<?php echo esc_attr( $options['archive_service_overlay_opacity'] ); ?>" />
       <div class="theme_option_message2 space" style="clear:both; margin:7px 0 0 0;">
        <p><?php _e('Please specify the number of 0 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-seeed');  ?>
        <?php _e('Please enter 0 if you don\'t want to use overlay.', 'tcd-seeed');  ?></p>
       </div>
      </li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Post list', 'tcd-seeed'); ?></h4>
     <ul class="option_list">
      <li class="service_option_notice small service_list_title_font_size_option_notice"><?php _e('The following options are not available when TypeC is selected for "Post list layout".', 'tcd-seeed'); ?></li>
      <li class="cf service_list_title_font_size_option">
       <span class="label"><?php _e('Font size of title', 'tcd-seeed'); ?></span><?php echo tcd_font_size_option($options, 'archive_service_title_font_size'); ?>
      </li>
      <li class="service_option_notice small service_list_post_num_option_notice"><?php _e('The following options are not available when TypeA or B is selected for "Post list layout".', 'tcd-seeed'); ?></li>
      <li class="cf service_list_post_num_option">
       <span class="label"><?php echo tcd_admin_label('article_list_num'); ?></span><?php echo tcd_display_post_num_option_type2($options, 'archive_service_num'); ?>
      </li>
     </ul>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-seeed' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-seeed' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // 詳細ページの設定 -------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php printf(__('%s page', 'tcd-seeed'), $service_label); ?></h3>
    <div class="theme_option_field_ac_content">

     <div class="front_page_image">
      <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/service_main_image.jpg?2.0" alt="" title="" />
     </div>

     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font size of title', 'tcd-seeed'); ?></span><?php echo tcd_font_size_option($options, 'service_title_font_size'); ?></li>
     </ul>

     <h4 class="theme_option_headline2"><?php printf(__('%s carousel', 'tcd-seeed'), $service_label); ?></h4>
     <div class="theme_option_message2">
      <p><?php printf(__('%s carousel will be displayed at bottom of the page..', 'tcd-seeed'), $service_label); ?></p>
     </div>
     <p class="service_option_notice service_related_post_notice"><?php _e('The following options are not available when anything other than TypeD is selected for "Post list layout". All icons will be listed instead.', 'tcd-seeed'); ?></p>
     <div class="service_related_post">
      <ul class="option_list service_related_post">
       <li class="cf"><span class="label"><?php _e('Headline', 'tcd-seeed');  ?></span><input type="text" placeholder="<?php _e( 'e.g.', 'tcd-seeed' ); echo esc_html($service_label); ?>" class="full_width" name="dp_options[service_related_headline]" value="<?php echo esc_textarea(  $options['service_related_headline'] ); ?>" /></li>
       <li class="cf">
        <span class="label"><?php _e('Post order', 'tcd-seeed');  ?></span>
        <div class="standard_radio_button">
         <input id="service_related_post_order1" type="radio" name="dp_options[service_related_post_order]" value="date" <?php checked( $options['service_related_post_order'], 'date' ); ?>>
         <label for="service_related_post_order1"><?php _e('Normal', 'tcd-seeed'); ?></label>
         <input id="service_related_post_order2" type="radio" name="dp_options[service_related_post_order]" value="rand" <?php checked( $options['service_related_post_order'], 'rand' ); ?>>
         <label for="service_related_post_order2"><?php _e('Random', 'tcd-seeed'); ?></label>
        </div>
        <div class="theme_option_message2" style="clear:both; margin:37px 0 0 0;">
         <p><?php _e('Normal = Management screen order. You can rearrange them by dragging and dropping within the <a href="./edit.php?post_type=service" target="_blank">management screen</a>.', 'tcd-seeed'); ?></p>
        </div>
       </li>
       <li class="cf"><span class="label"><?php _e('Number of post to display', 'tcd-seeed');  ?></span><?php echo tcd_display_post_num_option_type2($options, 'service_related_post_num'); ?></li>
      </ul>
     </div>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-seeed' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-seeed' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // 追加コンテンツ -------------------------------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Additional content', 'tcd-seeed'); ?></h3>
    <div class="theme_option_field_ac_content tab_parent">

     <div class="theme_option_message2">
      <p><?php _e('Additional content can be placed above and below all articles. HTML can also be used, so please use it for affiliates as well.', 'tcd-seeed');  ?></p>
     </div>

     <div class="sub_box_tab">
      <div class="tab active" data-tab="tab1"><?php _e('Above main content', 'tcd-seeed'); ?></div>
      <div class="tab" data-tab="tab2"><?php _e('Below main content', 'tcd-seeed'); ?></div>
     </div>

     <?php // メインコンテンツの上部 ----------------------- ?>
     <div class="sub_box_tab_content active" data-tab-content="tab1">

      <h4 class="theme_option_headline2"><?php _e('Free HTML area (PC)', 'tcd-seeed');  ?></h4>
      <div class="theme_option_message2">
       <p><?php _e('This content will be displayed in PC only.', 'tcd-seeed');  ?></p>
      </div>
      <textarea class="full_width" cols="50" rows="10" name="dp_options[single_service_top_ad_code]"><?php echo esc_textarea( $options['single_service_top_ad_code'] ); ?></textarea>

      <h4 class="theme_option_headline2"><?php _e('Free HTML area (mobile)', 'tcd-seeed');  ?></h4>
      <div class="theme_option_message2">
       <p><?php _e('This content will be displayed in mobile device only.', 'tcd-seeed');  ?></p>
      </div>
      <textarea class="full_width" cols="50" rows="10" name="dp_options[single_service_top_ad_code_mobile]"><?php echo esc_textarea( $options['single_service_top_ad_code_mobile'] ); ?></textarea>

     </div><!-- END .sub_box_tab_content -->

     <?php // メインコンテンツの下部 ----------------------- ?>
     <div class="sub_box_tab_content" data-tab-content="tab2">

      <h4 class="theme_option_headline2"><?php _e('Free HTML area (PC)', 'tcd-seeed');  ?></h4>
      <div class="theme_option_message2">
       <p><?php _e('This content will be displayed in PC only.', 'tcd-seeed');  ?></p>
      </div>
      <textarea class="full_width" cols="50" rows="10" name="dp_options[single_service_bottom_ad_code]"><?php echo esc_textarea( $options['single_service_bottom_ad_code'] ); ?></textarea>

      <h4 class="theme_option_headline2"><?php _e('Free HTML area (mobile)', 'tcd-seeed');  ?></h4>
      <div class="theme_option_message2">
       <p><?php _e('This content will be displayed in mobile device only.', 'tcd-seeed');  ?></p>
      </div>
      <textarea class="full_width" cols="50" rows="10" name="dp_options[single_service_bottom_ad_code_mobile]"><?php echo esc_textarea( $options['single_service_bottom_ad_code_mobile'] ); ?></textarea>

     </div><!-- END .sub_box_tab_content -->

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-seeed' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-seeed' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->

</div><!-- END .tab-content -->

<?php
} // END add_service_tab_panel()


// バリデーション　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_service_theme_options_validate( $input ) {

  global $dp_default_options;

  //基本設定
  $input['use_service'] = wp_filter_nohtml_kses( $input['use_service'] );
  $input['service_slug'] = sanitize_title( $input['service_slug'] );
  $input['service_label'] = wp_filter_nohtml_kses( $input['service_label'] );
  $input['service_icon_list_type'] = wp_filter_nohtml_kses( $input['service_icon_list_type'] );

  // アーカイブ
  $input['archive_service_headline'] = wp_filter_nohtml_kses( $input['archive_service_headline'] );
  $input['archive_service_desc'] = wp_kses_post( $input['archive_service_desc'] );
  $input['archive_service_desc_mobile'] = wp_kses_post( $input['archive_service_desc_mobile'] );
  $input['archive_service_header_image'] = wp_filter_nohtml_kses( $input['archive_service_header_image'] );
  $input['archive_service_overlay_color'] = wp_filter_nohtml_kses( $input['archive_service_overlay_color'] );
  $input['archive_service_overlay_opacity'] = wp_filter_nohtml_kses( $input['archive_service_overlay_opacity'] );
  $input['archive_service_list_type'] = wp_filter_nohtml_kses( $input['archive_service_list_type'] );

  $input['archive_service_title_font_size'] = wp_filter_nohtml_kses( $input['archive_service_title_font_size'] );
  $input['archive_service_title_font_size_sp'] = wp_filter_nohtml_kses( $input['archive_service_title_font_size_sp'] );
  $input['archive_service_num'] = wp_filter_nohtml_kses( $input['archive_service_num'] );
  $input['archive_service_num_sp'] = wp_filter_nohtml_kses( $input['archive_service_num_sp'] );


  // 詳細ページ
  $input['service_title_font_size'] = wp_filter_nohtml_kses( $input['service_title_font_size'] );
  $input['service_title_font_size_sp'] = wp_filter_nohtml_kses( $input['service_title_font_size_sp'] );

  $input['service_related_headline'] = wp_filter_nohtml_kses( $input['service_related_headline'] );
  $input['service_related_post_order'] = wp_filter_nohtml_kses( $input['service_related_post_order'] );
  $input['service_related_post_num'] = wp_filter_nohtml_kses( $input['service_related_post_num'] );
  $input['service_related_post_num_sp'] = wp_filter_nohtml_kses( $input['service_related_post_num_sp'] );

  // 記事ページの追加コンテンツ
  $input['single_service_top_ad_code'] = $input['single_service_top_ad_code'];
  $input['single_service_top_ad_code_mobile'] = $input['single_service_top_ad_code_mobile'];
  $input['single_service_bottom_ad_code'] = $input['single_service_bottom_ad_code'];
  $input['single_service_bottom_ad_code_mobile'] = $input['single_service_bottom_ad_code_mobile'];

	return $input;

};


?>