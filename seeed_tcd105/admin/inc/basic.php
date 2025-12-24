<?php
/*
 * 基本設定
 */


// Add default values
add_filter( 'before_getting_design_plus_option', 'add_basic_dp_default_options' );


// Add label of basic tab
add_action( 'tcd_tab_labels', 'add_basic_tab_label' );


// Add HTML of basic tab
add_action( 'tcd_tab_panel', 'add_basic_tab_panel' );


// Register sanitize function
add_filter( 'theme_options_validate', 'add_basic_theme_options_validate' );


// タブの名前
function add_basic_tab_label( $tab_labels ) {
	$tab_labels['basic'] = __( 'Basic setting', 'tcd-seeed' );
	return $tab_labels;
}


// 初期値
function add_basic_dp_default_options( $dp_default_options ) {

	// 色の設定
	$dp_default_options['main_color'] = '#0085b2';
	$dp_default_options['content_link_color'] = '#1578d6';
  $main_color = $dp_default_options['main_color'];

	// フォントの種類
	$dp_default_options['content_font_type'] = 'type2';
	$dp_default_options['content_font_size'] = '16';
	$dp_default_options['content_font_size_sp'] = '14';
	$dp_default_options['headline_font_type'] = 'type2';
	$dp_default_options['headline_font_size'] = '38';
	$dp_default_options['headline_font_size_sp'] = '20';
	$dp_default_options['catch_font_type'] = 'type2';
	$dp_default_options['catch_font_size'] = '38';
	$dp_default_options['catch_font_size_sp'] = '20';
	$dp_default_options['single_title_font_type'] = 'type2';
	$dp_default_options['single_title_font_size'] = '28';
	$dp_default_options['single_title_font_size_sp'] = '20';

  //ヘッダーロゴ
	$dp_default_options['header_logo_type'] = 'type1';
	$dp_default_options['header_logo_font_size'] = '26';
	$dp_default_options['header_logo_font_size_sp'] = '20';
	$dp_default_options['header_logo_font_type'] = 'type2';
	$dp_default_options['header_logo_image'] = false;
	$dp_default_options['header_logo_image_mobile'] = false;
	$dp_default_options['header_logo_retina'] = 'no';
	$dp_default_options['footer_logo_image'] = false;
	$dp_default_options['footer_logo_image_mobile'] = false;

	// アニメーションの設定
	$dp_default_options['hover_type'] = 'type1';
	$dp_default_options['hover1_zoom'] = '1.2';
	$dp_default_options['hover2_zoom'] = '1.2';
	$dp_default_options['hover3_direct'] = 'type1';
	$dp_default_options['hover3_opacity'] = '0.5';
	$dp_default_options['hover3_bgcolor'] = '#FFFFFF';
	$dp_default_options['hover4_opacity'] = '0.5';
	$dp_default_options['hover4_bgcolor'] = '#FFFFFF';

	$dp_default_options['no_image'] = false;

	// オリジナルスクリプトの設定
	$dp_default_options['script_code'] = '';
	$dp_default_options['footer_script_code'] = '';
	$dp_default_options['css_code'] = '';

  // ロードアイコンの設定ここから
  $dp_default_options['show_loading'] = '';
  $dp_default_options['loading_type'] = 'type1';
  $dp_default_options['loading_animation_type'] = 'type1';
  $dp_default_options['loading_time'] = '3000';

  // タイプ 1-3
  $dp_default_options['loading_icon_color'] = '#ffffff';

  // ロード画面のロゴ
  $dp_default_options['loading_logo_image'] = '';
  $dp_default_options['loading_logo_image_sp'] = '';
  $dp_default_options['loading_logo_retina'] = 'no';

  // キャッチフレーズ
  $dp_default_options['loading_catch'] = '';
  $dp_default_options['loading_catch_font_type'] = 'type2';
  $dp_default_options['loading_catch_font_size'] = '40';
  $dp_default_options['loading_catch_font_size_sp'] = '20';
  $dp_default_options['loading_catch_font_color'] = '#ffffff';

  // 共通
  $dp_default_options['loading_bg_color1'] = $main_color;
  $dp_default_options['loading_bg_color2'] = '#ffffff';
  $dp_default_options['loading_bg_color3'] = $main_color;
  $dp_default_options['loading_display_page'] = 'type1';
  $dp_default_options['loading_display_time'] = 'type1';

  // ロードアイコンの設定ここまで

	// ソーシャルシェアボタン
	$dp_default_options['sns_share_design_type'] = 'type1';
	$dp_default_options['show_sns_share_twitter'] = 1;
	$dp_default_options['show_sns_share_fblike'] = 1;
	$dp_default_options['show_sns_share_fbshare'] = 1;
	$dp_default_options['show_sns_share_hatena'] = 1;
	$dp_default_options['show_sns_share_pocket'] = 1;
	$dp_default_options['show_sns_share_feedly'] = 1;
	$dp_default_options['show_sns_share_rss'] = 1;
	$dp_default_options['show_sns_share_pinterest'] = 1;
	$dp_default_options['twitter_info'] = '';

  // ソーシャルボタン
	$dp_default_options['sns_button_color_type'] = 'type1';
	$dp_default_options['sns_button_facebook_url'] = '';
	$dp_default_options['sns_button_twitter_url'] = '';
	$dp_default_options['sns_button_instagram_url'] = '';
	$dp_default_options['sns_button_pinterest_url'] = '';
	$dp_default_options['sns_button_youtube_url'] = '';
	$dp_default_options['sns_button_tiktok_url'] = '';
	$dp_default_options['sns_button_contact_url'] = '';
	$dp_default_options['sns_button_show_rss'] = 'hide';

	$dp_default_options['show_sns_footer'] = 'hide';
	$dp_default_options['show_sns_mobile'] = 'hide';

	// 404 ページ
	$dp_default_options['page_404_bg_image'] = false;
	$dp_default_options['page_404_headline'] = '404 NOT FOUND';
	$dp_default_options['page_404_desc'] = __( 'The page you are looking for are not found', 'tcd-seeed' );
	$dp_default_options['page_404_overlay_color'] = '#000000';
	$dp_default_options['page_404_overlay_opacity'] = '0.5';

	// 検索結果 ページ
	$dp_default_options['search_type_post'] = 'yes';
	$dp_default_options['search_type_page'] = 'no';
	$dp_default_options['search_type_news'] = 'no';
	$dp_default_options['search_type_case_study'] = 'no';
	$dp_default_options['search_type_service'] = 'no';
	$dp_default_options['search_result_placeholder'] = __( 'Enter search keyword', 'tcd-seeed' );;

	$dp_default_options['search_result_bg_image'] = false;
	$dp_default_options['search_result_headline'] = __( 'Search result', 'tcd-seeed' );
	$dp_default_options['search_result_desc'] = __( 'The page you are looking for are not found', 'tcd-seeed' );
	$dp_default_options['search_result_overlay_color'] = '#000000';
	$dp_default_options['search_result_overlay_opacity'] = '0.5';
	$dp_default_options['search_result_bg_color'] = '#000000';

  // 目次
  $dp_default_options['toc_title'] = __( 'Table of Contents', 'tcd-seeed' );
  $dp_default_options['active_toc_post_type_post'] = 'hide';
  $dp_default_options['active_toc_post_type_page'] = 'hide';
  $dp_default_options['active_toc_post_type_news'] = 'hide';
  $dp_default_options['active_toc_heading_num'] = '2';
  $dp_default_options['active_toc_heading_type'] = '2-3';
  $dp_default_options['use_toc_theme_style'] = '';

	return $dp_default_options;

}


// 入力欄の出力　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_basic_tab_panel( $options ) {

  global $blog_label, $dp_default_options, $font_type_options, $hover_type_options, $hover3_direct_options, $sns_type_options, $bool_options, $basic_display_options,
         $loading_type, $loading_display_page_options, $loading_display_time_options, $loading_animation_type_options, $time_options, $logo_type_options, $font_direction_options,
         $button_type_options, $button_border_radius_options, $button_size_options, $button_animation_options;

  $news_label = $options['news_label'] ? esc_html( $options['news_label'] ) : __( 'News', 'tcd-seeed' );
  $case_study_label = $options['case_study_label'] ? esc_html( $options['case_study_label'] ) : __( 'Case study', 'tcd-seeed' );
  $service_label = $options['service_label'] ? esc_html( $options['service_label'] ) : __( 'Service', 'tcd-seeed' );
  $main_color = $options['main_color'];
  $hover_color = adjustBrightness($main_color, -50);

?>

<div id="tab-content-basic" class="tab-content">

   <div class="theme_option_message no_arrow" style="margin-top:0;">
    <p><?php _e('In order for your site to display correctly, you must first go through the <a href="options-reading.php">"Reading Settings"</a> in WordPress. Check <a href="https://tcd-theme.com/2022/07/wordpress-homepage.html" target="_blank" rel="nofollow">this TCD blog</a> for instructions on how to set it up.', 'tcd-seeed');  ?></p>
   </div>

   <?php // 色の設定 ----------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Color', 'tcd-seeed');  ?></h3>
    <div class="theme_option_field_ac_content">

     <div id="js-color-preset" class="color_presets">
      <ul class="color_presets_list">
       <?php foreach( TCD_COLOR_PRESET as $label => $colors ): ?>
       <li class="js-color-preset-item color_presets_item" data-color="<?php echo $colors['main']; ?>" data-bg-color="<?php echo $colors['bg']; ?>" style="background:<?php echo $colors['bg']; ?>;">
        <div class="color_presets_color">
         <span class="color_presets_color-main" style="background:<?php echo $colors['main']; ?>;">
          <span class="color_presets_color-copied">&#xe876;</span>
         </span>
        </div>
        <span class="color_presets_label"><?php echo $label; ?></span>
       </li>
       <?php endforeach; ?>
      </ul>
     </div>

     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Accent color', 'tcd-seeed'); ?></span><?php echo tcd_color_option( $options, 'main_color', 'js-color-preset-target--main' ); ?></li>
      <li class="cf"><span class="label"><?php _e('Single page text link color', 'tcd-seeed'); ?></span><?php echo tcd_color_option( $options, 'content_link_color', 'js-color-preset-target--main' ); ?></li>
     </ul>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-seeed' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-seeed' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // フォントの種類 ----------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Font', 'tcd-seeed');  ?></h3>
    <div class="theme_option_field_ac_content">

     <div class="option_with_image_preview">
      <div class="image_area">
       <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/font_image_headline.jpg?2.0" alt="" title="" />
      </div>
      <div class="option_area">
       <h4 class="theme_option_headline2"><?php _e('Headline', 'tcd-seeed'); ?></h4>
       <div class="theme_option_message2">
        <p><?php _e('This settings will be applied to content headline.', 'tcd-seeed'); ?></p>
       </div>
       <ul class="option_list">
        <li class="cf"><span class="label"><?php _e('Font type', 'tcd-seeed'); ?></span><?php echo tcd_basic_radio_button($options, 'headline_font_type', $font_type_options); ?></li>
        <li class="cf"><span class="label"><?php _e('Font size', 'tcd-seeed'); ?></span><?php echo tcd_font_size_option($options, 'headline_font_size'); ?></li>
       </ul>
      </div>
     </div>

     <div class="option_with_image_preview">
      <div class="image_area">
       <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/font_image_catch.jpg?2.0" alt="" title="" />
      </div>
      <div class="option_area">
       <h4 class="theme_option_headline2"><?php _e('Catchphrase', 'tcd-seeed'); ?></h4>
       <div class="theme_option_message2">
        <p><?php _e('It will be reflected to catchphrase on each page.', 'tcd-seeed'); ?></p>
       </div>
       <ul class="option_list">
        <li class="cf"><span class="label"><?php _e('Font type', 'tcd-seeed'); ?></span><?php echo tcd_basic_radio_button($options, 'catch_font_type', $font_type_options); ?></li>
        <li class="cf"><span class="label"><?php _e('Font size', 'tcd-seeed'); ?></span><?php echo tcd_font_size_option($options, 'catch_font_size'); ?></li>
       </ul>
      </div>
     </div>

     <div class="option_with_image_preview">
      <div class="image_area">
       <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/font_image_title.jpg?2.0" alt="" title="" />
      </div>
      <div class="option_area">
       <h4 class="theme_option_headline2"><?php _e('Post title', 'tcd-seeed'); ?></h4>
       <div class="theme_option_message2">
        <p><?php printf(__('This settings will be applied to %s, %s single page post title.', 'tcd-seeed'), $blog_label, $news_label); ?></p>
       </div>
       <ul class="option_list">
        <li class="cf"><span class="label"><?php _e('Font type', 'tcd-seeed'); ?></span><?php echo tcd_basic_radio_button($options, 'single_title_font_type', $font_type_options); ?></li>
        <li class="cf"><span class="label"><?php _e('Font size', 'tcd-seeed'); ?></span><?php echo tcd_font_size_option($options, 'single_title_font_size'); ?></li>
       </ul>
      </div>
     </div>

     <div class="option_with_image_preview">
      <div class="image_area">
       <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/font_image_content.jpg?2.0" alt="" title="" />
      </div>
      <div class="option_area">
       <h4 class="theme_option_headline2"><?php _e('Post content', 'tcd-seeed'); ?></h4>
       <div class="theme_option_message2">
        <p><?php _e( 'This setting will be used in post contents and descriptions.', 'tcd-seeed' ); ?></p>
       </div>
       <ul class="option_list">
        <li class="cf"><span class="label"><?php _e('Font type', 'tcd-seeed'); ?></span><?php echo tcd_basic_radio_button($options, 'content_font_type', $font_type_options); ?></li>
        <li class="cf"><span class="label"><?php _e('Font size', 'tcd-seeed'); ?></span><?php echo tcd_font_size_option($options, 'content_font_size'); ?></li>
       </ul>
      </div>
     </div>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-seeed' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-seeed' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // ロゴ ----------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Logo', 'tcd-seeed');  ?></h3>
    <div class="theme_option_field_ac_content tab_parent">

     <div class="front_page_image">
      <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/logo_image.jpg" alt="" title="" />
     </div>

     <?php echo tcd_admin_image_radio_button($options, 'header_logo_type', $logo_type_options) ?>

     <div id="header_logo_type1_area">
      <h4 class="theme_option_headline2"><?php _e('Site title', 'tcd-seeed');  ?></h4>
      <ul class="option_list">
       <li class="cf"><span class="label"><?php echo tcd_admin_label('font_type'); ?></span><?php echo tcd_basic_radio_button($options, 'header_logo_font_type', $font_type_options); ?></li>
       <li class="cf"><span class="label"><?php _e('Font size', 'tcd-seeed'); ?></span><?php echo tcd_font_size_option($options, 'header_logo_font_size'); ?></li>
      </ul>
     </div>

     <div id="header_logo_type2_area">
      <h4 class="theme_option_headline2"><?php _e('Logo image', 'tcd-seeed');  ?></h4>
      <div class="theme_option_message2">
       <p><?php _e('To avoid blurring images on a Retina display, you must register images that are at least twice the size of the actual image size to be displayed.<br>See the <a href="https://tcd-theme.com/2019/04/retina-display.html" target="_blank">TCD article</a> for more information.','tcd-seeed'); ?></p>
      </div>
      <ul class="option_list">
       <li class="cf">
        <span class="label"><?php _e('Headr image', 'tcd-seeed'); ?></span>
        <div class="image_box cf">
         <div class="cf cf_media_field hide-if-no-js header_logo_image">
          <input type="hidden" value="<?php echo esc_attr( $options['header_logo_image'] ); ?>" id="header_logo_image" name="dp_options[header_logo_image]" class="cf_media_id">
          <div class="preview_field"><?php if($options['header_logo_image']){ echo wp_get_attachment_image($options['header_logo_image'], 'full'); }; ?></div>
          <div class="buttton_area">
           <input type="button" value="<?php _e('Select Image', 'tcd-seeed'); ?>" class="cfmf-select-img button">
           <input type="button" value="<?php _e('Remove Image', 'tcd-seeed'); ?>" class="cfmf-delete-img button <?php if(!$options['header_logo_image']){ echo 'hidden'; }; ?>">
          </div>
         </div>
        </div>
       </li>
       <li class="cf">
        <span class="label"><?php _e('Header image (mobile)', 'tcd-seeed'); ?></span>
        <div class="image_box cf">
         <div class="cf cf_media_field hide-if-no-js header_logo_image_mobile">
          <input type="hidden" value="<?php echo esc_attr( $options['header_logo_image_mobile'] ); ?>" id="header_logo_image_mobile" name="dp_options[header_logo_image_mobile]" class="cf_media_id">
          <div class="preview_field"><?php if($options['header_logo_image_mobile']){ echo wp_get_attachment_image($options['header_logo_image_mobile'], 'full'); }; ?></div>
          <div class="buttton_area">
           <input type="button" value="<?php _e('Select Image', 'tcd-seeed'); ?>" class="cfmf-select-img button">
           <input type="button" value="<?php _e('Remove Image', 'tcd-seeed'); ?>" class="cfmf-delete-img button <?php if(!$options['header_logo_image_mobile']){ echo 'hidden'; }; ?>">
          </div>
         </div>
        </div>
       </li>
       <li class="cf">
        <span class="label">
         <?php _e('Footer image', 'tcd-seeed'); ?>
         <span class="recommend_desc"><?php _e('Header image will be used instead if footer image is not registered.', 'tcd-seeed'); ?></span>
        </span>
        <div class="image_box cf">
         <div class="cf cf_media_field hide-if-no-js footer_logo_image">
          <input type="hidden" value="<?php echo esc_attr( $options['footer_logo_image'] ); ?>" id="footer_logo_image" name="dp_options[footer_logo_image]" class="cf_media_id">
          <div class="preview_field"><?php if($options['footer_logo_image']){ echo wp_get_attachment_image($options['footer_logo_image'], 'full'); }; ?></div>
          <div class="buttton_area">
           <input type="button" value="<?php _e('Select Image', 'tcd-seeed'); ?>" class="cfmf-select-img button">
           <input type="button" value="<?php _e('Remove Image', 'tcd-seeed'); ?>" class="cfmf-delete-img button <?php if(!$options['footer_logo_image']){ echo 'hidden'; }; ?>">
          </div>
         </div>
        </div>
       </li>
       <li class="cf">
        <span class="label"><?php _e('Footer image (mobile)', 'tcd-seeed'); ?></span>
        <div class="image_box cf">
         <div class="cf cf_media_field hide-if-no-js footer_logo_image_mobile">
          <input type="hidden" value="<?php echo esc_attr( $options['footer_logo_image_mobile'] ); ?>" id="footer_logo_image_mobile" name="dp_options[footer_logo_image_mobile]" class="cf_media_id">
          <div class="preview_field"><?php if($options['footer_logo_image_mobile']){ echo wp_get_attachment_image($options['footer_logo_image_mobile'], 'full'); }; ?></div>
          <div class="buttton_area">
           <input type="button" value="<?php _e('Select Image', 'tcd-seeed'); ?>" class="cfmf-select-img button">
           <input type="button" value="<?php _e('Remove Image', 'tcd-seeed'); ?>" class="cfmf-delete-img button <?php if(!$options['footer_logo_image_mobile']){ echo 'hidden'; }; ?>">
          </div>
         </div>
        </div>
       </li>
       <li class="cf"><span class="label"><?php _e('Use retina display image', 'tcd-seeed'); ?></span><?php echo tcd_basic_radio_button($options, 'header_logo_retina', $bool_options); ?></li>
      </ul>
     </div>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-seeed' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-seeed' ); ?></a></li>
     </ul>

    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // ロード画面の設定 ----------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Loading screen', 'tcd-seeed');  ?></h3>
    <div class="theme_option_field_ac_content">

     <input id="show_loading" class="show_checkbox" name="dp_options[show_loading]" type="checkbox" value="1" <?php checked( $options['show_loading'], 1 ); ?>>
     <label for="show_loading"><?php _e( 'Display loading screen', 'tcd-seeed' ); ?></label>

     <div class="show_checkbox_area">

      <div class="theme_option_message2" style="margin-top:20px;">
       <p><?php _e('You can set the load screen displayed during page transition.', 'tcd-seeed');  ?></p>
      </div>

      <input class="tcd_admin_image_radio_button" id="loading_type1" type="radio" name="dp_options[loading_type]" value="type1" <?php checked( $options['loading_type'], 'type1' ); ?>>
      <label for="loading_type1">
       <div class="loading_icon_wrap">
        <div class="circular_loader">
         <svg class="circular" viewBox="25 25 50 50">
          <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
         </svg>
        </div>
       </div>
       <span class="title_wrap"><span class="title"><?php _e( 'Circle', 'tcd-seeed' ); ?></span></span>
      </label>
      <input class="tcd_admin_image_radio_button" id="loading_type2" type="radio" name="dp_options[loading_type]" value="type2" <?php checked( $options['loading_type'], 'type2' ); ?>>
      <label for="loading_type2">
       <div class="loading_icon_wrap">
        <div class="sk-cube-grid">
         <div class="sk-cube sk-cube1"></div><div class="sk-cube sk-cube2"></div><div class="sk-cube sk-cube3"></div><div class="sk-cube sk-cube4"></div><div class="sk-cube sk-cube5"></div><div class="sk-cube sk-cube6"></div><div class="sk-cube sk-cube7"></div><div class="sk-cube sk-cube8"></div><div class="sk-cube sk-cube9"></div></div>
       </div>
       <span class="title_wrap"><span class="title"><?php _e( 'Square', 'tcd-seeed' ); ?></span></span>
      </label>
      <input class="tcd_admin_image_radio_button" id="loading_type3" type="radio" name="dp_options[loading_type]" value="type3" <?php checked( $options['loading_type'], 'type3' ); ?>>
      <label for="loading_type3">
       <div class="loading_icon_wrap">
        <div class="sk-circle">
         <div class="sk-circle1 sk-child"></div><div class="sk-circle2 sk-child"></div><div class="sk-circle3 sk-child"></div><div class="sk-circle4 sk-child"></div><div class="sk-circle5 sk-child"></div><div class="sk-circle6 sk-child"></div><div class="sk-circle7 sk-child"></div><div class="sk-circle8 sk-child"></div><div class="sk-circle9 sk-child"></div><div class="sk-circle10 sk-child"></div><div class="sk-circle11 sk-child"></div><div class="sk-circle12 sk-child"></div>
        </div>
       </div>
       <span class="title_wrap"><span class="title"><?php _e( 'Dot circle', 'tcd-seeed' ); ?></span></span>
      </label>
      <input class="tcd_admin_image_radio_button" id="loading_type4" type="radio" name="dp_options[loading_type]" value="type4" <?php checked( $options['loading_type'], 'type4' ); ?>>
      <label for="loading_type4">
       <span class="image_wrap"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/loading_logo_catch.gif?2.0" alt=""></span>
       <span class="title_wrap"><span class="title" style="font-size:11px;"><?php _e( 'logo and catchphrase', 'tcd-seeed' ); ?></span></span>
      </label>
      <input class="tcd_admin_image_radio_button" id="loading_type5" type="radio" name="dp_options[loading_type]" value="type5" <?php checked( $options['loading_type'], 'type5' ); ?>>
      <label for="loading_type5">
       <span class="image_wrap"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/loading_catch_logo.gif" alt=""></span>
       <span class="title_wrap"><span class="title" style="font-size:11px;"><?php _e( 'Catchphrase and logo<br>in separate screen', 'tcd-seeed' ); ?></span></span>
      </label>

      <?php // type1 - type3 ----------------------------------------- ?>
      <div class="loading_screen_icon_option">
       <h4 class="theme_option_headline2"><?php _e('Icon design', 'tcd-seeed');  ?></h4>
       <ul class="option_list">
        <li class="cf"><span class="label"><?php _e('Icon color', 'tcd-seeed');  ?></span><input type="text" name="dp_options[loading_icon_color]" value="<?php echo esc_attr( $options['loading_icon_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
       </ul>
      </div>

      <?php // type4, type5 ----------------------------------------- ?>
      <div class="loading_screen_logo_option" id="loading_logo_catch_area">
       <div class="option_item">
       <h4 class="theme_option_headline2"><?php _e('Catchphrase', 'tcd-seeed');  ?></h4>
       <ul class="option_list">
        <li class="cf"><span class="label"><?php _e('Catchphrase', 'tcd-seeed'); ?></span><textarea class="full_width" cols="50" rows="2" name="dp_options[loading_catch]"><?php echo esc_textarea( $options['loading_catch'] ); ?></textarea></li>
        <li class="cf"><span class="label"><?php _e('Font type', 'tcd-seeed'); ?></span><?php echo tcd_basic_radio_button($options, 'loading_catch_font_type', $font_type_options); ?></li>
        <li class="cf"><span class="label"><?php _e('Font size', 'tcd-seeed'); ?></span><?php echo tcd_font_size_option($options, 'loading_catch_font_size'); ?></li>
        <li class="cf"><span class="label"><?php _e('Color', 'tcd-seeed'); ?></span><input type="text" name="dp_options[loading_catch_font_color]" value="<?php echo esc_attr( $options['loading_catch_font_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
       </ul>
       </div>
       <div class="option_item">
       <h4 class="theme_option_headline2"><?php _e('Logo', 'tcd-seeed');  ?></h4>
       <div class="theme_option_message2">
        <p><?php _e('To avoid blurring images on a Retina display, you must register images that are at least twice the size of the actual image size to be displayed.<br>See the <a href="https://tcd-theme.com/2019/04/retina-display.html" target="_blank">TCD article</a> for more information.','tcd-seeed'); ?></p>
       </div>
       <ul class="option_list">
        <li class="cf"><span class="label"><?php _e('Image', 'tcd-seeed'); ?></span><?php echo tcd_media_image_uploader($options, 'loading_logo_image', 'full'); ?></li>
        <li class="cf"><span class="label"><?php _e('Image (mobile)', 'tcd-seeed'); ?></span><?php echo tcd_media_image_uploader($options, 'loading_logo_image_sp', 'full'); ?></li>
        <li class="cf"><span class="label"><?php _e('Use retina display image', 'tcd-seeed');  ?></span><?php echo tcd_basic_radio_button($options, 'loading_logo_retina', $bool_options); ?></li>
       </ul>
      </div>
      </div>

      <?php // 共通 ----------------------------------------- ?>
      <h4 class="theme_option_headline2"><?php _e('Other setting', 'tcd-seeed'); ?></h4>
      <ul class="option_list">
       <li class="cf loading_non_type5_option"><span class="label"><?php _e('Background color', 'tcd-seeed'); ?></span><input type="text" name="dp_options[loading_bg_color1]" value="<?php echo esc_attr( $options['loading_bg_color1'] ); ?>" data-default-color="<?php echo esc_attr($main_color); ?>" class="c-color-picker"></li>
       <li class="cf loading_type5_option" style="border:none;"><span class="label"><?php _e('Background color for catchphrase screen', 'tcd-seeed'); ?></span><input type="text" name="dp_options[loading_bg_color2]" value="<?php echo esc_attr( $options['loading_bg_color2'] ); ?>" data-default-color="<?php echo esc_attr($main_color); ?>" class="c-color-picker"></li>
       <li class="cf loading_type5_option"><span class="label"><?php _e('Background color for logo screen', 'tcd-seeed'); ?></span><input type="text" name="dp_options[loading_bg_color3]" value="<?php echo esc_attr( $options['loading_bg_color3'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
       <li class="cf"><span class="label"><?php _e('Animation after load end', 'tcd-seeed'); ?></span>
        <select name="dp_options[loading_animation_type]">
         <?php foreach($loading_animation_type_options as $option ): ?>
         <option value="<?php echo esc_attr($option['value']); ?>" <?php selected( $options['loading_animation_type'], $option['value'] ); ?>><?php echo esc_html($option['label']); ?></option>
         <?php endforeach; ?>
        </select>
       </li>
       <li class="cf loading_non_type5_option"><span class="label"><?php _e('Indication times', 'tcd-seeed'); ?></span>
        <select name="dp_options[loading_time]">
         <?php foreach($time_options as $option ): ?>
         <option value="<?php echo esc_attr($option['value']); ?>" <?php selected( $options['loading_time'], $option['value'] ); ?>><?php echo esc_html($option['label']); ?></option>
         <?php endforeach; ?>
        </select>
       </li>
       <li class="cf"><span class="label"><?php _e('Display pages', 'tcd-seeed'); ?></span><?php echo tcd_basic_radio_button($options, 'loading_display_page', $loading_display_page_options); ?></li>
       <li class="cf"><span class="label"><?php _e('Display times', 'tcd-seeed'); ?></span><?php echo tcd_basic_radio_button($options, 'loading_display_time', $loading_display_time_options); ?></li>
      </ul>

     </div><!-- END .show_checkbox_area -->

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo tcd_admin_label('save'); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo tcd_admin_label('close'); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // アイキャッチ ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Featured image', 'tcd-seeed');  ?></h3>
    <div class="theme_option_field_ac_content">

     <?php // 代替画像 ------------------------ ?>
     <h4 class="theme_option_headline2"><?php _e('Alternate image to be displayed when featured image is not registered', 'tcd-seeed');  ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('If you set image here, you can display alternative image for article which featured image is not set.', 'tcd-seeed');  ?><br>
      <?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-seeed'), '720', '460'); ?></p>
     </div>
     <div class="image_box cf">
      <div class="cf cf_media_field hide-if-no-js no_image">
       <input type="hidden" value="<?php echo esc_attr( $options['no_image'] ); ?>" id="blog_no_image" name="dp_options[no_image]" class="cf_media_id">
       <div class="preview_field"><?php if($options['no_image']){ echo wp_get_attachment_image($options['no_image'], 'medium'); }; ?></div>
       <div class="buttton_area">
        <input type="button" value="<?php _e('Select Image', 'tcd-seeed'); ?>" class="cfmf-select-img button">
        <input type="button" value="<?php _e('Remove Image', 'tcd-seeed'); ?>" class="cfmf-delete-img button <?php if(!$options['no_image']){ echo 'hidden'; }; ?>">
       </div>
      </div>
     </div>

     <h4 class="theme_option_headline2"><?php _e('Hover effect type', 'tcd-seeed'); ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('You can select the featured image hover effect from 4 types.', 'tcd-seeed'); ?></p>
     </div>

     <ul class="design_radio_button">
      <?php foreach ( $hover_type_options as $option ) { ?>
      <li>
       <input type="radio" id="hover_type_<?php esc_attr_e( $option['value'] ); ?>" name="dp_options[hover_type]" value="<?php esc_attr_e( $option['value'] ); ?>" <?php checked( $options['hover_type'], $option['value'] ); ?> />
       <label for="hover_type_<?php esc_attr_e( $option['value'] ); ?>"><?php echo esc_html( $option['label'] ); ?></label>
      </li>
      <?php } ?>
     </ul>

     <div id="hover_type1_area" style="<?php if($options['hover_type'] == 'type1'){ echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <h4 class="theme_option_headline2"><?php _e('Zoom in', 'tcd-seeed'); ?></h4>
      <div class="theme_option_message2">
       <p><?php _e('Please enter a value between 1 (same size) and 1.5.<br>There is no limit to the number you can enter, but we recommend a maximum of 1.5.', 'tcd-seeed'); ?></p>
      </div>
      <ul class="option_list">
       <li class="cf"><span class="label"><?php _e('Magnification rate', 'tcd-seeed'); ?></span><input class="hankaku" style="width:70px;" type="number" max="10" min="1" step="0.1" name="dp_options[hover1_zoom]" value="<?php esc_attr_e( $options['hover1_zoom'] ); ?>" /></li>
      </ul>
     </div>

     <div id="hover_type2_area" style="<?php if($options['hover_type'] == 'type2'){ echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <h4 class="theme_option_headline2"><?php _e('Zoom out', 'tcd-seeed'); ?></h4>
      <div class="theme_option_message2">
       <p><?php _e('Please enter a value between 1 (same size) and 1.5.<br>There is no limit to the number you can enter, but we recommend a maximum of 1.5.', 'tcd-seeed'); ?></p>
      </div>
      <ul class="option_list">
       <li class="cf"><span class="label"><?php _e('Reduction rate', 'tcd-seeed'); ?></span><input class="hankaku" style="width:70px;" type="number" max="10" min="1" step="0.1" name="dp_options[hover2_zoom]" value="<?php esc_attr_e( $options['hover2_zoom'] ); ?>" /></li>
      </ul>
     </div>

     <div id="hover_type3_area" style="<?php if($options['hover_type'] == 'type3'){ echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <h4 class="theme_option_headline2"><?php _e('Slide', 'tcd-seeed'); ?></h4>
      <ul class="option_list">
       <li class="cf"><span class="label"><?php _e('Direction', 'tcd-seeed'); ?></span><?php echo tcd_basic_radio_button($options, 'hover3_direct', $hover3_direct_options); ?></li>
       <li class="cf"><span class="label"><?php _e('Background color', 'tcd-seeed'); ?></span><input type="text" name="dp_options[hover3_bgcolor]" value="<?php echo esc_attr( $options['hover3_bgcolor'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
       <li class="cf">
        <span class="label"><?php _e('Opacity of background color', 'tcd-seeed'); ?></span>
        <input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[hover3_opacity]" value="<?php esc_attr_e( $options['hover3_opacity'] ); ?>" />
        <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
         <p><?php _e('Please specify the number of 0 from 1.0. Overlay color will be more transparent as the number is small.', 'tcd-seeed');  ?></p>
        </div>
       </li>
      </ul>
     </div>

     <div id="hover_type4_area" style="<?php if($options['hover_type'] == 'type4'){ echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <h4 class="theme_option_headline2"><?php _e('Fade', 'tcd-seeed'); ?></h4>
      <ul class="option_list">
       <li class="cf"><span class="label"><?php _e('Background color', 'tcd-seeed'); ?></span><input type="text" name="dp_options[hover4_bgcolor]" value="<?php echo esc_attr( $options['hover4_bgcolor'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
       <li class="cf">
        <span class="label"><?php _e('Opacity of background color', 'tcd-seeed'); ?></span>
        <input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[hover4_opacity]" value="<?php esc_attr_e( $options['hover4_opacity'] ); ?>" />
        <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
         <p><?php _e('Please specify the number of 0 from 1.0. Overlay color will be more transparent as the number is small.', 'tcd-seeed');  ?></p>
        </div>
       </li>
      </ul>
     </div>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-seeed' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-seeed' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // 目次 --------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Table of Contents', 'tcd-seeed');  ?></h3>
    <div class="theme_option_field_ac_content">
     <div class="theme_option_message2">
      <p><?php _e( 'The contents registered here will be applied to all pages displaying the table of contents and to the original <a href="./widgets.php">Table of Contents (tcd ver)</a> widget.', 'tcd-seeed' ); ?></br><?php _e( 'The title of the table of contents can also be set individually from the editing screen of each article.', 'tcd-seeed' ); ?></p>
     </div>

     <h4 class="theme_option_headline2"><?php _e( 'Page to display the table of contents', 'tcd-seeed' ); ?></h4>
     <div class="theme_option_message2">
      <p><?php _e( 'Automatically generates a table of contents on the page of the checked post types.', 'tcd-seeed' ); ?></br><?php _e( 'The display location is before the first h2. If there are no h2 tags, the table of contents will not be displayed.', 'tcd-seeed' ); ?><br><?php _e( 'Only pages displaying a sidebar are eligible (default template only).', 'tcd-seeed' ); ?></p>
     </div>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php echo $blog_label; ?></span><?php echo tcd_basic_radio_button($options, 'active_toc_post_type_post', $basic_display_options); ?></li>
      <li class="cf"><span class="label"><?php echo $news_label; ?></span><?php echo tcd_basic_radio_button($options, 'active_toc_post_type_news', $basic_display_options); ?></li>
      <li class="cf"><span class="label"><?php _e('Page', 'tcd-seeed'); ?></span><?php echo tcd_basic_radio_button($options, 'active_toc_post_type_page', $basic_display_options); ?></li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e( 'Basic setting', 'tcd-seeed' ); ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Created when there are more than X number of headings.', 'tcd-seeed');  ?></span>
       <select name="dp_options[active_toc_heading_num]">
        <?php for($i=2; $i<= 10; $i++): ?>
        <option style="padding-right: 10px;" value="<?php echo esc_attr($i); ?>" <?php selected( $options['active_toc_heading_num'], $i ); ?>><?php echo esc_html($i); ?></option>
        <?php endfor; ?>
       </select>
      </li>
      <li class="cf"><span class="label"><?php _e('Target heading', 'tcd-seeed'); ?></span>
       <select class="index_tab_post_list_type" name="dp_options[active_toc_heading_type]">
        <option style="padding-right: 10px;" value="2" <?php selected( $options['active_toc_heading_type'], '2' ); ?>><?php _e('Only h2', 'tcd-seeed'); ?></option>
        <option style="padding-right: 10px;" value="2-3" <?php selected( $options['active_toc_heading_type'], '2-3' ); ?>>h2〜h3</option>
        <option style="padding-right: 10px;" value="2-4" <?php selected( $options['active_toc_heading_type'], '2-4' ); ?>>h2〜h4</option>
        <option style="padding-right: 10px;" value="2-5" <?php selected( $options['active_toc_heading_type'], '2-5' ); ?>>h2〜h5</option>
       </select>
      </li>
      <li class="cf"><span class="label"><?php _e('Title of the table of contents', 'tcd-seeed'); ?></span><input class="regular-text" type="text" name="dp_options[toc_title]" value="<?php echo esc_attr($options['toc_title']); ?>" /></li>
      <li class="cf" style="display:none;"><span class="label"><?php _e('Don\'t use theme styles', 'tcd-seeed');  ?></span><input name="dp_options[use_toc_theme_style]" type="checkbox" value="1" <?php checked( '1', $options['use_toc_theme_style'] ); ?> /></li>
     </ul>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-seeed' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-seeed' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // SNSボタン  ------------------------------------------------------------------ ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('SNS', 'tcd-seeed');  ?></h3>
    <div class="theme_option_field_ac_content">

     <?php // ソーシャルシェアボタン ------------------------------------------------------------------- ?>
     <div class="sub_box cf"> 
      <h3 class="theme_option_subbox_headline"><?php _e('Share button', 'tcd-seeed');  ?></h3>
      <div class="sub_box_content">

       <div class="theme_option_message2" style="margin-top:20px;">
        <p><?php printf(__('Share button will be displayed in blog article and %s article.', 'tcd-seeed'), $news_label); ?></p>
        <p><?php _e('Display position can be set from each post type.', 'tcd-seeed');  ?></p>
       </div>

       <h4 class="theme_option_headline2"><?php _e('Share button design', 'tcd-seeed');  ?></h4>
       <ul class="design_radio_button image_radio_button cf">
        <?php foreach ( $sns_type_options as $option ) { ?>
        <li>
         <input type="radio" id="sns_share_design_type_<?php esc_attr_e( $option['value'] ); ?>" name="dp_options[sns_share_design_type]" value="<?php esc_attr_e( $option['value'] ); ?>" <?php checked( $options['sns_share_design_type'], $option['value'] ); ?> />
         <label for="sns_share_design_type_<?php esc_attr_e( $option['value'] ); ?>">
          <span><?php echo esc_html($option['label']); ?></span>
          <img src="<?php bloginfo('template_url'); ?>/admin/img/<?php echo esc_attr($option['img']); ?>?2.3" alt="" title="" />
         </label>
        </li>
        <?php } ?>
       </ul>

       <h4 class="theme_option_headline2"><?php _e('Display setting', 'tcd-seeed');  ?></h4>
       <ul>
        <li><label><input name="dp_options[show_sns_share_twitter]" type="checkbox" value="1" <?php checked( '1', $options['show_sns_share_twitter'] ); ?> /> <?php _e('Display X button', 'tcd-seeed');  ?></label></li>
        <li><label><input name="dp_options[show_sns_share_fblike]" type="checkbox" value="1" <?php checked( '1', $options['show_sns_share_fblike'] ); ?> /> <?php _e('Display facebook like button -Button type 5 (Default button) only', 'tcd-seeed');  ?></label></li>
        <li><label><input name="dp_options[show_sns_share_fbshare]" type="checkbox" value="1" <?php checked( '1', $options['show_sns_share_fbshare'] ); ?> /> <?php _e('Display facebook share button', 'tcd-seeed');  ?></label></li>
        <li><label><input name="dp_options[show_sns_share_hatena]" type="checkbox" value="1" <?php checked( '1', $options['show_sns_share_hatena'] ); ?> /> <?php _e('Display hatena button', 'tcd-seeed');  ?></label></li>
        <li><label><input name="dp_options[show_sns_share_pocket]" type="checkbox" value="1" <?php checked( '1', $options['show_sns_share_pocket'] ); ?> /> <?php _e('Display pocket button', 'tcd-seeed');  ?></label></li>
        <li><label><input name="dp_options[show_sns_share_feedly]" type="checkbox" value="1" <?php checked( '1', $options['show_sns_share_feedly'] ); ?> /> <?php _e('Display feedly button', 'tcd-seeed');  ?></label></li>
        <li><label><input name="dp_options[show_sns_share_rss]" type="checkbox" value="1" <?php checked( '1', $options['show_sns_share_rss'] ); ?> /> <?php _e('Display rss button', 'tcd-seeed');  ?></label></li>
        <li><label><input name="dp_options[show_sns_share_pinterest]" type="checkbox" value="1" <?php checked( '1', $options['show_sns_share_pinterest'] ); ?> /> <?php _e('Display pinterest button', 'tcd-seeed');  ?></label></li>
       </ul>

       <h4 class="theme_option_headline2"><?php _e('Setting for the X button', 'tcd-seeed');  ?></h4>
       <label style="margin-top:20px;"><?php _e('Set of X account. (ex.tcd_jp)', 'tcd-seeed');  ?></label>
       <input style="display:block; margin:.6em 0 1em;" id="dp_options[twitter_info]" class="regular-text" type="text" name="dp_options[twitter_info]" value="<?php esc_attr_e( $options['twitter_info'] ); ?>" />

      </div><!-- END .sub_box_content -->
     </div><!-- END .sub_box -->

     <?php // ソーシャルボタン ------------------------------------------------------------------- ?>
     <div class="sub_box cf"> 
      <h3 class="theme_option_subbox_headline"><?php _e('SNS icon', 'tcd-seeed');  ?></h3>
      <div class="sub_box_content">

       <h4 class="theme_option_headline2"><?php _e('SNS icon design', 'tcd-seeed');  ?></h4>
       <ul class="design_radio_button image_radio_button cf">
        <li>
         <input type="radio" id="sns_button_color_type1" name="dp_options[sns_button_color_type]" value="type1" <?php checked( $options['sns_button_color_type'], 'type1' ); ?> />
         <label for="sns_button_color_type1">
          <span><?php _e('Monochrome (TCD ver)', 'tcd-seeed');  ?></span>
          <img src="<?php bloginfo('template_url'); ?>/admin/img/sns_color_type1.png?2.0" alt="" title="" />
         </label>
        </li>
        <li>
         <input type="radio" id="sns_button_color_type2" name="dp_options[sns_button_color_type]" value="type2" <?php checked( $options['sns_button_color_type'], 'type2' ); ?> />
         <label for="sns_button_color_type2">
          <span><?php _e('Official color', 'tcd-seeed');  ?></span>
          <img src="<?php bloginfo('template_url'); ?>/admin/img/sns_color_type2.png?2.0" alt="" title="" />
         </label>
        </li>
       </ul>

       <h4 class="theme_option_headline2"><?php _e('Link', 'tcd-seeed');  ?></h4>
       <div class="theme_option_message2">
        <p><?php _e('Enter url of your SNS. Please leave the field empty if you don\'t want to display certain sns button.', 'tcd-seeed');  ?></p>
       </div>
       <ul class="option_list">
        <li class="cf"><span class="label">Instagram URL</span><input class="full_width" type="text" name="dp_options[sns_button_instagram_url]" value="<?php echo esc_attr( $options['sns_button_instagram_url'] ); ?>"></li>
        <li class="cf"><span class="label">TikTok URL</span><input class="full_width" type="text" name="dp_options[sns_button_tiktok_url]" value="<?php echo esc_attr( $options['sns_button_tiktok_url'] ); ?>"></li>
        <li class="cf"><span class="label">X URL</span><input class="full_width" type="text" name="dp_options[sns_button_twitter_url]" value="<?php echo esc_attr( $options['sns_button_twitter_url'] ); ?>"></li>
        <li class="cf"><span class="label">Facebook URL</span><input class="full_width" type="text" name="dp_options[sns_button_facebook_url]" value="<?php echo esc_attr( $options['sns_button_facebook_url'] ); ?>"></li>
        <li class="cf"><span class="label">Pinterest URL</span><input class="full_width" type="text" name="dp_options[sns_button_pinterest_url]" value="<?php echo esc_attr( $options['sns_button_pinterest_url'] ); ?>"></li>
        <li class="cf"><span class="label">YouTube URL</span><input class="full_width" type="text" name="dp_options[sns_button_youtube_url]" value="<?php echo esc_attr( $options['sns_button_youtube_url'] ); ?>"></li>
        <li class="cf"><span class="label"><?php _e('Contact page (You can use mailto:)', 'tcd-seeed'); ?></span><input class="full_width" type="text" name="dp_options[sns_button_contact_url]" value="<?php echo esc_attr( $options['sns_button_contact_url'] ); ?>"></li>
        <li class="cf"><span class="label">RSS</span><?php echo tcd_basic_radio_button($options, 'sns_button_show_rss', $basic_display_options); ?></li>
       </ul>

       <h4 class="theme_option_headline2"><?php _e('Display setting', 'tcd-seeed');  ?></h4>
       <ul class="option_list">
        <li class="cf"><span class="label"><?php _e('Footer', 'tcd-seeed'); ?></span><?php echo tcd_basic_radio_button($options, 'show_sns_footer', $basic_display_options); ?></li>
        <li class="cf"><span class="label"><?php _e('Drawer menu (mobile)', 'tcd-seeed'); ?></span><?php echo tcd_basic_radio_button($options, 'show_sns_mobile', $basic_display_options); ?></li>
       </ul>

      </div><!-- END .sub_box_content -->
     </div><!-- END .sub_box -->

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-seeed' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-seeed' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // 404・検索結果 ページ ----------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e( '404 page / Search result page', 'tcd-seeed' ); ?></h3>
    <div class="theme_option_field_ac_content tab_parent">

     <div class="sub_box_tab_content active" data-tab-content="tab1">
      <div class="front_page_image">
       <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/404_image.jpg?1.2" alt="" title="" />
      </div>
     </div>

     <div class="sub_box_tab_content" data-tab-content="tab2">
      <div class="front_page_image">
       <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/search_result_image.jpg?1.2" alt="" title="" />
      </div>
     </div>

     <div class="sub_box_tab">
      <div class="tab active" data-tab="tab1"><?php _e('404 page', 'tcd-seeed'); ?></div>
      <div class="tab" data-tab="tab2"><?php _e('Search result page', 'tcd-seeed'); ?></div>
     </div>

     <?php // 404ページ ----------------------- ?>
     <div class="sub_box_tab_content active" data-tab-content="tab1">

     <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
      <p><?php printf(__('You can check 404 page form <a href="%s" target="_blank">this page</a>.', 'tcd-seeed'), esc_url(home_url('check404notfoundpage')) );  ?></p>
     </div>

     <ul class="option_list">
      <li class="cf"><span class="label"><span class="num">1</span><?php _e('Headline', 'tcd-seeed'); ?></span><input class="full_width" type="text" placeholder="<?php _e( 'e.g.', 'tcd-seeed' ); ?>404 NOT FOUND" name="dp_options[page_404_headline]" value="<?php echo esc_attr( $options['page_404_headline'] ); ?>" /></li>
      <li class="cf"><span class="label"><span class="num">2</span><?php _e('Description', 'tcd-seeed'); ?></span><textarea placeholder="<?php _e( 'e.g.', 'tcd-seeed' ); _e( 'The page you are looking for are not found', 'tcd-seeed' ); ?>" class="full_width" cols="50" rows="2" name="dp_options[page_404_desc]"><?php echo esc_textarea( $options['page_404_desc'] ); ?></textarea></li>
      <li class="cf">
       <span class="label">
        <span class="num">3</span>
        <span><?php _e('Background image', 'tcd-seeed'); ?></span>
        <span class="recommend_desc"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-seeed'), '1450', '1100'); ?></span>
       </span>
       <div class="image_box cf">
        <div class="cf cf_media_field hide-if-no-js page_404_bg_image">
         <input type="hidden" value="<?php echo esc_attr( $options['page_404_bg_image'] ); ?>" id="page_404_bg_image" name="dp_options[page_404_bg_image]" class="cf_media_id">
         <div class="preview_field"><?php if ( $options['page_404_bg_image'] ) { echo wp_get_attachment_image( $options['page_404_bg_image'], 'medium' ); } ?></div>
         <div class="button_area">
          <input type="button" value="<?php _e( 'Select Image', 'tcd-seeed' ); ?>" class="cfmf-select-img button">
          <input type="button" value="<?php _e( 'Remove Image', 'tcd-seeed' ); ?>" class="cfmf-delete-img button <?php if ( ! $options['page_404_bg_image'] ) { echo 'hidden'; } ?>">
         </div>
        </div>
       </div>
      </li>
      <li class="cf"><span class="label"><?php _e('Overlay color', 'tcd-seeed'); ?></span><input type="text" name="dp_options[page_404_overlay_color]" value="<?php echo esc_attr( $options['page_404_overlay_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
      <li class="cf">
       <span class="label"><?php _e('Transparency of overlay', 'tcd-seeed'); ?></span>
       <input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[page_404_overlay_opacity]" value="<?php echo esc_attr( $options['page_404_overlay_opacity'] ); ?>" />
       <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
        <p><?php _e('Please specify the number of 0 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-seeed');  ?><br>
        <?php _e('Please enter 0 if you don\'t want to use overlay.', 'tcd-seeed');  ?></p>
       </div>
      </li>
     </ul>

     </div><!-- END .sub_box_tab_content -->

     <?php // 検索結果ページ ----------------------- ?>
     <div class="sub_box_tab_content" data-tab-content="tab2">

     <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
      <p><?php printf(__('You can check search result page form <a href="%s" target="_blank">this page</a>.', 'tcd-seeed'), esc_url(home_url('?s=checksearchresultpage')) );  ?></p>
     </div>

     <ul class="option_list">
      <li class="cf"><span class="label"><span class="num">1</span><?php _e('Headline', 'tcd-seeed'); ?></span><input type="text" placeholder="<?php _e( 'e.g.', 'tcd-seeed' ); _e( 'Search result', 'tcd-seeed' ); ?>" class="full_width" name="dp_options[search_result_headline]" value="<?php echo esc_attr( $options['search_result_headline'] ); ?>" /></li>
      <li class="cf"><span class="label"><span class="num">2</span><?php _e('Description', 'tcd-seeed'); ?></span><textarea placeholder="<?php _e( 'e.g.', 'tcd-seeed' ); _e( 'The page you are looking for are not found', 'tcd-seeed' ); ?>" class="full_width" cols="50" rows="2" name="dp_options[search_result_desc]"><?php echo esc_textarea( $options['search_result_desc'] ); ?></textarea></li>
      <li class="cf"><span class="label"><span class="num">3</span><?php _e('Placeholder for search form', 'tcd-seeed'); ?></span><input type="text" placeholder="<?php _e( 'e.g.', 'tcd-seeed' ); _e( 'Enter search keyword', 'tcd-seeed' ); ?>" class="full_width" name="dp_options[search_result_placeholder]" value="<?php echo esc_attr( $options['search_result_placeholder'] ); ?>" /></li>
      <li class="cf">
       <span class="label">
        <span class="num">4</span>
        <span><?php _e('Background image', 'tcd-seeed'); ?></span>
        <span class="recommend_desc"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-seeed'), '1450', '1100'); ?></span>
       </span>
       <div class="image_box cf">
        <div class="cf cf_media_field hide-if-no-js search_result_bg_image">
         <input type="hidden" value="<?php echo esc_attr( $options['search_result_bg_image'] ); ?>" id="search_result_bg_image" name="dp_options[search_result_bg_image]" class="cf_media_id">
         <div class="preview_field"><?php if ( $options['search_result_bg_image'] ) { echo wp_get_attachment_image( $options['search_result_bg_image'], 'medium' ); } ?></div>
         <div class="button_area">
          <input type="button" value="<?php _e( 'Select Image', 'tcd-seeed' ); ?>" class="cfmf-select-img button">
          <input type="button" value="<?php _e( 'Remove Image', 'tcd-seeed' ); ?>" class="cfmf-delete-img button <?php if ( ! $options['search_result_bg_image'] ) { echo 'hidden'; } ?>">
         </div>
        </div>
       </div>
      </li>
      <li class="cf"><span class="label"><?php _e('Overlay color', 'tcd-seeed'); ?></span><input type="text" name="dp_options[search_result_overlay_color]" value="<?php echo esc_attr( $options['search_result_overlay_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
      <li class="cf">
       <span class="label"><?php _e('Transparency of overlay', 'tcd-seeed'); ?></span>
       <input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[search_result_overlay_opacity]" value="<?php echo esc_attr( $options['search_result_overlay_opacity'] ); ?>" />
       <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
        <p><?php _e('Please specify the number of 0 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-seeed');  ?><br>
        <?php _e('Please enter 0 if you don\'t want to use overlay.', 'tcd-seeed');  ?></p>
       </div>
      </li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Search range', 'tcd-seeed');  ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('This setting will be applied to all search forms, including the search widget. ', 'tcd-seeed');  ?></p>
     </div>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php printf(__('Include %s in search range', 'tcd-seeed'), __('post', 'tcd-seeed') ); ?></span><?php echo tcd_basic_radio_button($options, 'search_type_post', $bool_options); ?></li>
      <li class="cf"><span class="label"><?php printf(__('Include %s in search range', 'tcd-seeed'), __('pages', 'tcd-seeed') ); ?></span><?php echo tcd_basic_radio_button($options, 'search_type_page', $bool_options); ?></li>
      <li class="cf" style="<?php if($options['use_news']){ echo 'display:block;'; } else { echo 'display:none;'; }; ?>"><span class="label"><?php printf(__('Include %s in search range', 'tcd-seeed'), $news_label ); ?></span><?php echo tcd_basic_radio_button($options, 'search_type_news', $bool_options); ?></li>
      <li class="cf" style="<?php if($options['use_case_study']){ echo 'display:block;'; } else { echo 'display:none;'; }; ?>"><span class="label"><?php printf(__('Include %s in search range', 'tcd-seeed'), $case_study_label ); ?></span><?php echo tcd_basic_radio_button($options, 'search_type_case_study', $bool_options); ?></li>
      <li class="cf" style="<?php if($options['use_service']){ echo 'display:block;'; } else { echo 'display:none;'; }; ?>"><span class="label"><?php printf(__('Include %s in search range', 'tcd-seeed'), $service_label ); ?></span><?php echo tcd_basic_radio_button($options, 'search_type_service', $bool_options); ?></li>
     </ul>

     </div><!-- END .sub_box_tab_content -->

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-seeed' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-seeed' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // カスタムスクリプト用の自由記入欄 ----------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Custom CSS and script', 'tcd-seeed');  ?></h3>
    <div class="theme_option_field_ac_content">

     <h4 class="theme_option_headline2"><?php _e('Custom CSS', 'tcd-seeed'); ?></h4>
     <div class="theme_option_message2">
      <p><?php _e( 'This css will be displayed inside &lt;head&gt; tag.<br />You don\'t need to enter &lt;style&gt; tag in this field.', 'tcd-seeed' ); ?></p>
      <p><?php _e('Example:<br><strong>.custom_css { font-size:12px; }</strong>', 'tcd-seeed');  ?></p>
     </div>
     <textarea class="large-text" cols="50" rows="10" name="dp_options[css_code]"><?php echo esc_textarea( $options['css_code'] ); ?></textarea>

     <h4 class="theme_option_headline2"><?php _e('Custom script for header', 'tcd-seeed'); ?></h4>
     <div class="theme_option_message2" style="margin-top:10px;">
      <p><?php _e( 'This script will be displayed inside &lt;head&gt; tag.<br>Please use this option when adding Google Analytics tracking code, etc.', 'tcd-seeed' ); ?></p>
     </div>
     <textarea class="large-text" cols="50" rows="10" name="dp_options[script_code]"><?php echo esc_textarea( $options['script_code'] ); ?></textarea>

     <h4 class="theme_option_headline2"><?php _e('Custom script for footer', 'tcd-seeed'); ?></h4>
     <div class="theme_option_message2" style="margin-top:10px;">
      <p><?php _e( 'This script will be displayed before &lt;/body&gt; tag.<br>Please use this option when adding conversion analysis script. Example: An analysis script installed on a sales page, etc.', 'tcd-seeed' ); ?></p>
     </div>
     <textarea class="large-text" cols="50" rows="10" name="dp_options[footer_script_code]"><?php echo esc_textarea( $options['footer_script_code'] ); ?></textarea>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-seeed' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-seeed' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


</div><!-- END .tab-content -->

<?php
} // END add_basic_tab_panel()


// バリデーション　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_basic_theme_options_validate( $input ) {

  global $dp_default_options, $font_type_options, $hover_type_options, $hover3_direct_options, $sns_type_options, $bool_options,
         $button_type_options, $button_border_radius_options, $button_size_options, $button_animation_options,
         $loading_type, $loading_display_page_options, $loading_display_time_options, $time_options, $logo_type_options;


  // 色の設定
  $input['main_color'] = sanitize_hex_color( $input['main_color'] );
  $input['content_link_color'] = sanitize_hex_color( $input['content_link_color'] );


  // フォントの種類
  if ( ! isset( $input['content_font_type'] ) )
    $input['content_font_type'] = null;
  if ( ! array_key_exists( $input['content_font_type'], $font_type_options ) )
    $input['content_font_type'] = null;
  $input['content_font_size'] = wp_filter_nohtml_kses( $input['content_font_size'] );
  $input['content_font_size_sp'] = wp_filter_nohtml_kses( $input['content_font_size_sp'] );

  if ( ! isset( $input['headline_font_type'] ) )
    $input['headline_font_type'] = null;
  if ( ! array_key_exists( $input['headline_font_type'], $font_type_options ) )
    $input['headline_font_type'] = null;
  $input['headline_font_size'] = wp_filter_nohtml_kses( $input['headline_font_size'] );
  $input['headline_font_size_sp'] = wp_filter_nohtml_kses( $input['headline_font_size_sp'] );

  if ( ! isset( $input['catch_font_type'] ) )
    $input['catch_font_type'] = null;
  if ( ! array_key_exists( $input['catch_font_type'], $font_type_options ) )
    $input['catch_font_type'] = null;
  $input['catch_font_size'] = wp_filter_nohtml_kses( $input['catch_font_size'] );
  $input['catch_font_size_sp'] = wp_filter_nohtml_kses( $input['catch_font_size_sp'] );

  if ( ! isset( $input['single_title_font_type'] ) )
    $input['single_title_font_type'] = null;
  if ( ! array_key_exists( $input['single_title_font_type'], $font_type_options ) )
    $input['single_title_font_type'] = null;
  $input['single_title_font_size'] = wp_filter_nohtml_kses( $input['single_title_font_size'] );
  $input['single_title_font_size_sp'] = wp_filter_nohtml_kses( $input['single_title_font_size_sp'] );


  // ヘッダーロゴ
  if ( ! isset( $input['header_logo_type'] ) )
    $input['header_logo_type'] = null;
  if ( ! array_key_exists( $input['header_logo_type'], $logo_type_options ) )
    $input['header_logo_type'] = null;
  $input['header_logo_font_size'] = wp_filter_nohtml_kses( $input['header_logo_font_size'] );
  $input['header_logo_font_size_sp'] = wp_filter_nohtml_kses( $input['header_logo_font_size_sp'] );
  $input['header_logo_font_type'] = wp_filter_nohtml_kses( $input['header_logo_font_type'] );
  $input['header_logo_image'] = wp_filter_nohtml_kses( $input['header_logo_image'] );
  $input['header_logo_image_mobile'] = wp_filter_nohtml_kses( $input['header_logo_image_mobile'] );
  $input['header_logo_retina'] = wp_filter_nohtml_kses( $input['header_logo_retina'] );
  $input['footer_logo_image'] = wp_filter_nohtml_kses( $input['footer_logo_image'] );
  $input['footer_logo_image_mobile'] = wp_filter_nohtml_kses( $input['footer_logo_image_mobile'] );


  // アニメーションの設定
  if ( ! isset( $input['hover_type'] ) )
    $input['hover_type'] = null;
  if ( ! array_key_exists( $input['hover_type'], $hover_type_options ) )
    $input['hover_type'] = null;
  $input['hover1_zoom'] = wp_filter_nohtml_kses( $input['hover1_zoom'] );
  $input['hover2_zoom'] = wp_filter_nohtml_kses( $input['hover2_zoom'] );
  if ( ! isset( $input['hover3_direct'] ) )
    $input['hover3_direct'] = null;
  if ( ! array_key_exists( $input['hover3_direct'], $hover3_direct_options ) )
    $input['hover3_direct'] = null;
  $input['hover3_opacity'] = wp_filter_nohtml_kses( $input['hover3_opacity'] );
  $input['hover3_bgcolor'] = sanitize_hex_color( $input['hover3_bgcolor'] );
  $input['hover4_opacity'] = wp_filter_nohtml_kses( $input['hover4_opacity'] );
  $input['hover4_bgcolor'] = sanitize_hex_color( $input['hover4_bgcolor'] );

  $input['no_image'] = wp_filter_nohtml_kses( $input['no_image'] );


  // オリジナルスクリプトの設定
  $input['script_code'] = $input['script_code'];
  $input['footer_script_code'] = $input['footer_script_code'];
  $input['css_code'] = $input['css_code'];


  // ロード画面
  $input['show_loading'] = ! empty( $input['show_loading'] ) ? 1 : 0;
  if ( ! isset( $input['loading_type'] ) )
    $input['loading_type'] = null;
  if ( ! array_key_exists( $input['loading_type'], $loading_type ) )
    $input['loading_type'] = null;
  $input['loading_animation_type'] = wp_filter_nohtml_kses( $input['loading_animation_type'] );
  $input['loading_time'] = wp_filter_nohtml_kses( $input['loading_time'] );


  // シンプル
  $input['loading_icon_color'] = sanitize_hex_color( $input['loading_icon_color'] );


  // ロゴ
  $input['loading_logo_image'] = absint( $input['loading_logo_image'] );
  $input['show_loading'] = ! empty( $input['show_loading'] ) ? 1 : 0;
  if ( ! isset( $input['loading_logo_retina'] ) )
    $input['loading_logo_retina'] = null;
  if ( ! array_key_exists( $input['loading_logo_retina'], $bool_options ) )
    $input['loading_logo_retina'] = null;
  $input['loading_logo_image_sp'] = absint( $input['loading_logo_image_sp'] );
  $input['show_loading'] = ! empty( $input['show_loading'] ) ? 1 : 0;


  // キャッチフレーズ
  $input['loading_catch'] = wp_kses_post( $input['loading_catch'] );
  if ( ! isset( $input['loading_catch_font_type'] ) )
    $input['loading_catch_font_type'] = null;
  if ( ! array_key_exists( $input['loading_catch_font_type'], $font_type_options ) )
    $input['loading_catch_font_type'] = null;
  $input['loading_catch_font_size'] = absint( $input['loading_catch_font_size'] );
  $input['loading_catch_font_size_sp'] = absint( $input['loading_catch_font_size_sp'] );
  $input['loading_catch_font_color'] = sanitize_hex_color( $input['loading_catch_font_color'] );


  // 共通
  if ( ! isset( $input['loading_display_page'] ) )
    $input['loading_display_page'] = null;
  if ( ! array_key_exists( $input['loading_display_page'], $font_type_options ) )
    $input['loading_display_page'] = null;
  if ( ! isset( $input['loading_display_time'] ) )
    $input['loading_display_time'] = null;
  if ( ! array_key_exists( $input['loading_display_time'], $loading_display_time_options ) )
    $input['loading_display_time'] = null;
  $input['loading_bg_color1'] = sanitize_hex_color( $input['loading_bg_color1'] );
  $input['loading_bg_color2'] = sanitize_hex_color( $input['loading_bg_color2'] );
  $input['loading_bg_color3'] = sanitize_hex_color( $input['loading_bg_color3'] );

  // ロード画面ここまで


  // ソーシャルシェアボタン
  $input['sns_share_design_type'] = wp_filter_nohtml_kses( $input['sns_share_design_type'] );
  $input['show_sns_share_twitter'] = ! empty( $input['show_sns_share_twitter'] ) ? 1 : 0;
  $input['show_sns_share_fblike'] = ! empty( $input['show_sns_share_fblike'] ) ? 1 : 0;
  $input['show_sns_share_fbshare'] = ! empty( $input['show_sns_share_fbshare'] ) ? 1 : 0;
  $input['show_sns_share_hatena'] = ! empty( $input['show_sns_share_hatena'] ) ? 1 : 0;
  $input['show_sns_share_pocket'] = ! empty( $input['show_sns_share_pocket'] ) ? 1 : 0;
  $input['show_sns_share_feedly'] = ! empty( $input['show_sns_share_feedly'] ) ? 1 : 0;
  $input['show_sns_share_rss'] = ! empty( $input['show_sns_share_rss'] ) ? 1 : 0;
  $input['show_sns_share_pinterest'] = ! empty( $input['show_sns_share_pinterest'] ) ? 1 : 0;
  $input['twitter_info'] = wp_filter_nohtml_kses( $input['twitter_info'] );


  // ソーシャルボタン
  $input['sns_button_color_type'] = wp_filter_nohtml_kses( $input['sns_button_color_type'] );
  $input['sns_button_facebook_url'] = wp_filter_nohtml_kses( $input['sns_button_facebook_url'] );
  $input['sns_button_twitter_url'] = wp_filter_nohtml_kses( $input['sns_button_twitter_url'] );
  $input['sns_button_instagram_url'] = wp_filter_nohtml_kses( $input['sns_button_instagram_url'] );
  $input['sns_button_pinterest_url'] = wp_filter_nohtml_kses( $input['sns_button_pinterest_url'] );
  $input['sns_button_youtube_url'] = wp_filter_nohtml_kses( $input['sns_button_youtube_url'] );
  $input['sns_button_tiktok_url'] = wp_filter_nohtml_kses( $input['sns_button_tiktok_url'] );
  $input['sns_button_contact_url'] = wp_filter_nohtml_kses( $input['sns_button_contact_url'] );
  $input['sns_button_show_rss'] = wp_filter_nohtml_kses( $input['sns_button_show_rss'] );

  $input['show_sns_footer'] = wp_filter_nohtml_kses( $input['show_sns_footer'] );
  $input['show_sns_mobile'] = wp_filter_nohtml_kses( $input['show_sns_mobile'] );


  // 検索結果ページ
  $input['search_type_post'] = wp_filter_nohtml_kses( $input['search_type_post'] );
  $input['search_type_page'] = wp_filter_nohtml_kses( $input['search_type_page'] );
  $input['search_type_news'] = wp_filter_nohtml_kses( $input['search_type_news'] );
  $input['search_type_case_study'] = wp_filter_nohtml_kses( $input['search_type_case_study'] );
  $input['search_type_service'] = wp_filter_nohtml_kses( $input['search_type_service'] );
  $input['search_result_placeholder'] = wp_kses_post( $input['search_result_placeholder'] );

  $input['search_result_headline'] = wp_filter_nohtml_kses( $input['search_result_headline'] );
  $input['search_result_desc'] = wp_kses_post( $input['search_result_desc'] );
  $input['search_result_bg_image'] = wp_filter_nohtml_kses( $input['search_result_bg_image'] );
  $input['search_result_overlay_color'] = wp_filter_nohtml_kses( $input['search_result_overlay_color'] );
  $input['search_result_overlay_opacity'] = wp_filter_nohtml_kses( $input['search_result_overlay_opacity'] );


  // 404 ページ
  $input['page_404_headline'] = wp_filter_nohtml_kses( $input['page_404_headline'] );
  $input['page_404_desc'] = wp_kses_post( $input['page_404_desc'] );
  $input['page_404_bg_image'] = wp_filter_nohtml_kses( $input['page_404_bg_image'] );
  $input['page_404_overlay_color'] = wp_filter_nohtml_kses( $input['page_404_overlay_color'] );
  $input['page_404_overlay_opacity'] = wp_filter_nohtml_kses( $input['page_404_overlay_opacity'] );


  //プラン一覧
  $plan_list = array();
  if ( isset( $input['plan_list'] ) && is_array( $input['plan_list'] ) ) {
    foreach ( $input['plan_list'] as $key => $value ) {
      // 子リピータ
      $item_list = array();
      if ( ! empty( $value['item_list'] ) && is_array( $value['item_list'] ) ) {
        foreach ( array_values( $value['item_list'] ) as $key2 => $value2 ) {
          $item_list[] = array(
            'data_left' => isset( $value2['data_left'] ) ? wp_filter_nohtml_kses( $value2['data_left'] ) : '',
            'data_right' => isset( $value2['data_right'] ) ? wp_filter_nohtml_kses( $value2['data_right'] ) : '',
          );
        }
      }
      $plan_list[] = array(
        'headline' => isset( $input['plan_list'][$key]['headline'] ) ? wp_filter_nohtml_kses( $input['plan_list'][$key]['headline'] ) : '',
        'num' => isset( $input['plan_list'][$key]['num'] ) ? wp_filter_nohtml_kses( $input['plan_list'][$key]['num'] ) : '',
        'unit' => isset( $input['plan_list'][$key]['unit'] ) ? wp_filter_nohtml_kses( $input['plan_list'][$key]['unit'] ) : '',
        'desc' => isset( $input['plan_list'][$key]['desc'] ) ? wp_filter_nohtml_kses( $input['plan_list'][$key]['desc'] ) : '',
        'button' => isset( $input['plan_list'][$key]['button'] ) ? wp_filter_nohtml_kses( $input['plan_list'][$key]['button'] ) : '',
        'url' => isset( $input['plan_list'][$key]['url'] ) ? wp_filter_nohtml_kses( $input['plan_list'][$key]['url'] ) : '',
        'target' => ! empty( $input['plan_list'][$key]['target'] ) ? 1 : 0,
        'active' => ! empty( $input['plan_list'][$key]['active'] ) ? 1 : 0,
        'item_list' => $item_list
      );
    }
  };
  $input['plan_list'] = $plan_list;


  // 目次
  $input['toc_title'] = wp_filter_nohtml_kses( $input['toc_title'] );
  $input['active_toc_post_type_post'] = wp_filter_nohtml_kses( $input['active_toc_post_type_post'] );
  $input['active_toc_post_type_page'] = wp_filter_nohtml_kses( $input['active_toc_post_type_page'] );
  $input['active_toc_post_type_news'] = wp_filter_nohtml_kses( $input['active_toc_post_type_news'] );
  $input['active_toc_heading_num'] = wp_filter_nohtml_kses( $input['active_toc_heading_num'] );
  $input['active_toc_heading_type'] = wp_filter_nohtml_kses( $input['active_toc_heading_type'] );
  $input['use_toc_theme_style'] = ! empty( $input['use_toc_theme_style'] ) ? 1 : 0;


  return $input;

};


?>