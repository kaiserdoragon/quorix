<?php
/*
 * トップページの設定
 */

// Add default values
add_filter( 'before_getting_design_plus_option', 'add_front_page_dp_default_options' );


// Add label of front page tab
add_action( 'tcd_tab_labels', 'add_front_page_tab_label' );


// Add HTML of front page tab
add_action( 'tcd_tab_panel', 'add_front_page_tab_panel' );


// Register sanitize function
add_filter( 'theme_options_validate', 'add_front_page_theme_options_validate' );


// タブの名前
function add_front_page_tab_label( $tab_labels ) {
	$tab_labels['front_page'] = __( 'Front page', 'tcd-seeed' );
	return $tab_labels;
}


// 初期値
function add_front_page_dp_default_options( $dp_default_options ) {

  // ヘッダーコンテンツ
	$dp_default_options['index_header_content_type'] = 'type1';

  // 画像スライダー
  $dp_default_options['index_slider_image'] = false;
  $dp_default_options['index_slider_image_sp'] = false;
	$dp_default_options['index_image_slider_animation_type'] = 'slide';

  // 動画・YouTube
	$dp_default_options['index_header_content_video'] = '';
	$dp_default_options['index_header_content_youtube'] = '';
	$dp_default_options['index_header_content_overlay_color'] = '#000000';
	$dp_default_options['index_header_content_overlay_opacity'] = '0.1';
	$dp_default_options['index_header_content_catch'] = __( 'Catchphrase', 'tcd-seeed' );
	$dp_default_options['index_header_content_catch_mobile'] = '';
	$dp_default_options['index_header_content_catch_font_type'] = 'type2';
	$dp_default_options['index_header_content_catch_font_size'] = '46';
	$dp_default_options['index_header_content_catch_font_size_sp'] = '24';
	$dp_default_options['index_header_content_catch_animation_type'] = 'type1';
	$dp_default_options['index_header_content_button_label'] = __( 'Button', 'tcd-seeed' );
  $dp_default_options['index_header_content_button_url'] = '#';
  $dp_default_options['index_header_content_button_target'] = '';

	// 実績の設定
	$dp_default_options['show_index_achievements'] = '1';
	$dp_default_options['index_achievements_headline'] = __( 'Headline', 'tcd-seeed' );
	$dp_default_options['index_achievements_num'] = '123456';
	$dp_default_options['index_achievements_unit'] = __( 'people', 'tcd-seeed' );
	$dp_default_options['index_achievements_desc'] = __( 'Description will be displayed here.', 'tcd-seeed' );

	// ニュースティッカーの設定
	$dp_default_options['show_header_news'] = '1';
	$dp_default_options['header_news_post_type'] = 'news';
	$dp_default_options['header_news_post_order'] = 'date';

  // コンテンツビルダー
	$dp_default_options['page_content_width_type'] = 'type1';
	$dp_default_options['page_content_width'] = '1030';
	$dp_default_options['index_content_type'] = 'type1';

	$dp_default_options['contents_builder'] = array(
		array(
            "type" => "service_list",
            "show_content" => 1,
            "catch" => __( 'Service', 'tcd-seeed' ),
            "desc" => __( 'Description will be displayed here.', 'tcd-seeed' ),
            "desc_mobile" => "",
            "button_label" => __( 'Link button', 'tcd-seeed' ),
            "post_type" => "type1",
            "post_num" => "4",
            "post_num_sp" => "4",
		),
		array(
            "type" => "selling_point",
            "show_content" => 1,
            "catch" => __( 'Catchphrase', 'tcd-seeed' ),
            "desc" => __( 'Description will be displayed here.', 'tcd-seeed' ),
            "desc_mobile" => "",
            "point_label" => "POINT",
            "item_list" => array(
              array(
                "layout1" => "type2",
                "button_target1" => "0",
                "position1" => "type1",
                "catch1" => __( 'Catchphrase', 'tcd-seeed' ),
                "desc1" => __( 'Description will be displayed here.', 'tcd-seeed' ),
                "button_label1" => "",
                "button_url1" => "",
                "font_color1" => "#ffffff",
                "bg_color1" => "#0085b2",
                "sub_content_type1" => "type1",
                "image1" => "",
                "chart1" => "",
                "bg_image1_overlay_opacity" => "0.3",
                "bg_image1" => "",
                "bg_image_mobile1" => "",
                "bg_image1_overlay_color" => "#000000",
                "display_right_content" => "1",
                "layout2" => "type1",
                "button_target2" => "0",
                "position2" => "type2",
                "catch2" => "",
                "desc2" => __( 'Description will be displayed here.', 'tcd-seeed' ),
                "button_label2" => __( 'Link button', 'tcd-seeed' ),
                "button_url2" => "#",
                "font_color2" => "#000000",
                "bg_color2" => "#ffffff",
                "sub_content_type2" => "type1",
                "image2" => "",
                "chart2" => "",
                "bg_image2_overlay_opacity" => "0.3",
                "bg_image2" => "",
                "bg_image_mobile2" => "",
                "bg_image2_overlay_color" => "#0085b2",
              ),
            ),
		),
		array(
            "type" => "case_study_list",
            "show_content" => 1,
            "catch" => __( 'Case study', 'tcd-seeed' ),
            "desc" => __( 'Description will be displayed here.', 'tcd-seeed' ),
            "desc_mobile" => "",
            "button_label" => __( 'Link button', 'tcd-seeed' ),
            "post_num" => "4",
            "post_num_sp" => "4",
		),
		array(
            "type" => "blog_list",
            "show_content" => 1,
            "catch" => __( 'Blog', 'tcd-seeed' ),
            "desc" => __( 'Description will be displayed here.', 'tcd-seeed' ),
            "desc_mobile" => "",
            "button_label" => __( 'Link button', 'tcd-seeed' ),
            "post_type" => "recent_post",
            "post_order" => "date",
            "post_num" => "6",
            "post_num_mobile" => "4",
		)
  );

	return $dp_default_options;

}

// 入力欄の出力　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_front_page_tab_panel( $options ) {

  global $blog_label, $dp_default_options, $item_type_options, $font_type_options, $bool_options, $basic_display_options;
  $news_label = $options['news_label'] ? esc_html( $options['news_label'] ) : __( 'News', 'tcd-seeed' );
  $service_label = $options['service_label'] ? esc_html( $options['service_label'] ) : __( 'Service', 'tcd-seeed' );
  $case_study_label = $options['case_study_label'] ? esc_html( $options['case_study_label'] ) : __( 'Case study', 'tcd-seeed' );

?>

<div id="tab-content-front-page" class="tab-content">

   <?php // ヘッダーコンテンツ ---------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Header content', 'tcd-seeed');  ?></h3>
    <div class="theme_option_field_ac_content header_content_setting_area tab_parent">

     <h4 class="theme_option_headline2"><?php _e('Background type', 'tcd-seeed'); ?></h4>
     <ul class="design_radio_button horizontal clearfix">
      <li class="index_header_content_type1">
       <input type="radio" id="index_header_content_type1" name="dp_options[index_header_content_type]" value="type1" <?php checked( $options['index_header_content_type'], 'type1' ); ?> />
       <label for="index_header_content_type1"><?php _e('Image slider', 'tcd-seeed');  ?></label>
      </li>
      <li class="index_header_content_type2">
       <input type="radio" id="index_header_content_type2" name="dp_options[index_header_content_type]" value="type2" <?php checked( $options['index_header_content_type'], 'type2' ); ?> />
       <label for="index_header_content_type2"><?php _e('Video', 'tcd-seeed');  ?></label>
      </li>
      <li class="index_header_content_type3">
       <input type="radio" id="index_header_content_type3" name="dp_options[index_header_content_type]" value="type3" <?php checked( $options['index_header_content_type'], 'type3' ); ?> />
       <label for="index_header_content_type3"><?php _e('YouTube', 'tcd-seeed');  ?></label>
      </li>
     </ul>

     <div class="sub_box_tab">
      <div class="tab active" data-tab="tab1"><?php _e('Content', 'tcd-seeed'); ?></div>
      <div class="tab" data-tab="tab2"><span class="index_header_content_type1_option"><?php _e('Image slider', 'tcd-seeed'); ?></span><span class="index_header_content_type2_option"><?php _e('Video', 'tcd-seeed'); ?></span><span class="index_header_content_type3_option"><?php _e('YouTube', 'tcd-seeed'); ?></span></div>
     </div>

     <?php // コンテンツ ?>
     <div class="sub_box_tab_content active" data-tab-content="tab1">

     <h4 class="theme_option_headline2"><?php _e('Catchphrase', 'tcd-seeed'); ?></h4>
     <div class="front_page_image middle">
      <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/index_content.jpg" alt="" title="" />
     </div>
     <ul class="option_list">
      <li class="cf"><span class="label"><span class="num">1</span><?php _e('Catchphrase', 'tcd-seeed'); ?></span><textarea class="full_width" cols="50" rows="3" name="dp_options[index_header_content_catch]"><?php echo esc_textarea(  $options['index_header_content_catch'] ); ?></textarea></li>
      <li class="cf" style="border:none;"><span class="label"><span class="num_space"></span><?php _e('Catchphrase (mobile)', 'tcd-seeed'); ?></span><textarea class="full_width" cols="50" rows="3" placeholder="<?php _e( 'Please indicate if you would like to display a short text for mobile sizes.', 'tcd-seeed' ); ?>" name="dp_options[index_header_content_catch_mobile]"><?php echo esc_textarea(  $options['index_header_content_catch_mobile'] ); ?></textarea></li>
      <li class="cf" style="border:none;"><span class="label"><span class="num_space"></span><?php _e('Font type of catchphrase', 'tcd-seeed'); ?></span><?php echo tcd_basic_radio_button($options, 'index_header_content_catch_font_type', $font_type_options); ?></li>
      <li class="cf" style="border:none;"><span class="label"><span class="num_space"></span><?php _e('Font size of catchphrase', 'tcd-seeed'); ?></span><?php echo tcd_font_size_option($options, 'index_header_content_catch_font_size'); ?></li>
      <li class="cf" style="border:none;">
       <span class="label"><span class="num_space"></span><?php _e('Animation of catchphrase', 'tcd-seeed'); ?></span>
       <div class="standard_radio_button">
        <input id="index_header_content_catch_animation_type1" type="radio" name="dp_options[index_header_content_catch_animation_type]" value="type1" <?php checked( $options['index_header_content_catch_animation_type'], 'type1' ); ?>>
        <label for="index_header_content_catch_animation_type1"><?php _e('Typewritter', 'tcd-seeed'); ?></label>
        <input id="index_header_content_catch_animation_type2" type="radio" name="dp_options[index_header_content_catch_animation_type]" value="type2" <?php checked( $options['index_header_content_catch_animation_type'], 'type2' ); ?>>
        <label for="index_header_content_catch_animation_type2"><?php _e('Fade', 'tcd-seeed'); ?></label>
       </div>
      </li>
      <li class="cf"><span class="label"><span class="num">2</span><?php _e('Label of button', 'tcd-seeed');  ?></span><input class="full_width" type="text" name="dp_options[index_header_content_button_label]" value="<?php echo esc_textarea( $options['index_header_content_button_label'] ); ?>" /></li>
      <li class="cf">
       <span class="label"><span class="num">2</span><?php _e('URL of button', 'tcd-seeed'); ?></span>
       <div class="admin_link_option">
        <input type="text" name="dp_options[index_header_content_button_url]" placeholder="https://example.com/" value="<?php echo esc_attr( $options['index_header_content_button_url'] ); ?>">
        <input id="index_header_content_button_target" class="admin_link_option_target" name="dp_options[index_header_content_button_target]" type="checkbox" value="1" <?php checked( $options['index_header_content_button_target'], 1 ); ?>>
        <label for="index_header_content_button_target">&#xe920;</label>
       </div>
      </li>
     </ul>

     <?php // 実績 ?>
     <h4 class="theme_option_headline2"><?php _e('Achievements', 'tcd-seeed'); ?></h4>
     <p class="displayment_checkbox"><label><input name="dp_options[show_index_achievements]" type="checkbox" value="1" <?php checked( $options['show_index_achievements'], 1 ); ?>><?php _e( 'Display achievements', 'tcd-seeed' ); ?></label></p>
     <div style="<?php if($options['show_index_achievements'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <div class="front_page_image middle">
       <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/index_achive.jpg" alt="" title="" />
      </div>
      <ul class="option_list">
       <li class="cf"><span class="label"><span class="num">1</span><?php _e('Headline', 'tcd-seeed'); ?></span><input type="text" class="full_width" name="dp_options[index_achievements_headline]" value="<?php echo esc_html($options['index_achievements_headline']); ?>" ></li>
       <li class="cf"><span class="label"><span class="num">2</span><?php _e('Numbers', 'tcd-seeed'); ?></span><input type="number" class="hankaku" style="width:100px;" name="dp_options[index_achievements_num]" value="<?php echo esc_attr($options['index_achievements_num']); ?>" ></li>
       <li class="cf"><span class="label"><span class="num">3</span><?php _e('Unit', 'tcd-seeed'); ?></span><input type="text" style="width:100px;" name="dp_options[index_achievements_unit]" value="<?php echo esc_attr($options['index_achievements_unit']); ?>" ></li>
       <li class="cf"><span class="label"><span class="num">4</span><?php _e('Description', 'tcd-seeed'); ?></span><input type="text" class="full_width" name="dp_options[index_achievements_desc]" value="<?php echo esc_html($options['index_achievements_desc']); ?>"></li>
      </ul>
     </div><!-- END .displayment_checkbox -->

     </div><!-- END .sub_box_tab_content -->

     <?php // 背景画像 ----------------------- ?>
     <div class="sub_box_tab_content" data-tab-content="tab2">

     <?php // 画像スライダー ----------------------- ?>
     <div class="index_header_content_type1_option">

      <h4 class="theme_option_headline2"><?php _e('Image slider', 'tcd-seeed'); ?></h4>
      <ul class="option_list">
       <li class="cf">
        <span class="label"><?php _e( 'Image', 'tcd-seeed' ); ?>
          <span class="recommend_desc"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-seeed'), '1450', '850'); ?></span>
          <span class="recommend_desc"><?php _e('You can register multiple image by clicking images in media library.', 'tcd-seeed'); ?></span>
        </span>
        <?php echo tcd_multi_media_uploader( 'index_slider_image', $options ); ?>
       </li>
       <li class="cf">
        <span class="label"><?php _e( 'Image (mobile)', 'tcd-seeed' ); ?>
         <span class="recommend_desc"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-seeed'), '750', '1050'); ?></span>
        </span>
        <?php echo tcd_multi_media_uploader( 'index_slider_image_sp', $options ); ?>
       </li>
       <li class="cf">
        <span class="label"><?php _e('Animation type', 'tcd-seeed');  ?>
         <span class="recommend_desc"><?php _e('Applies when multiple images are set.', 'tcd-seeed'); ?></span>
        </span>
        <div class="standard_radio_button">
         <input id="index_header_slide_type1" type="radio" name="dp_options[index_image_slider_animation_type]" value="slide" <?php checked( $options['index_image_slider_animation_type'], 'slide' ); ?>>
         <label for="index_header_slide_type1"><?php _e('Slide', 'tcd-seeed'); ?></label>
         <input id="index_header_slide_type2" type="radio" name="dp_options[index_image_slider_animation_type]" value="fade" <?php checked( $options['index_image_slider_animation_type'], 'fade' ); ?>>
         <label for="index_header_slide_type2"><?php _e('Fade', 'tcd-seeed'); ?></label>
        </div>
       </li>
      </ul>

     </div><!-- END .index_header_content_type1_option -->

     <?php // 動画 --------------------------------------- ?>
     <div class="index_header_content_type2_option">

      <h4 class="theme_option_headline2"><?php _e('Video', 'tcd-seeed'); ?></h4>
      <div class="theme_option_message2" style="margin-top:25px;">
       <p><?php _e('Please upload MP4 format file.', 'tcd-seeed');  ?><br>
       <?php _e('Web browser takes few second to load the data of video so we recommend to use loading screen if you want to display video.', 'tcd-seeed'); ?><br>
       <?php _e('Recommended MP4 file size: 10 MB or less.<br>The screen ratio of the video is assumed to be 16:9.', 'tcd-seeed'); ?></p>
      </div>
      <div class="cf cf_media_field hide-if-no-js index_header_content_video">
       <input type="hidden" value="<?php if($options['index_header_content_video']) { echo esc_attr( $options['index_header_content_video'] ); }; ?>" id="index_header_content_video" name="dp_options[index_header_content_video]" class="cf_media_id">
       <div class="preview_field preview_field_video">
        <?php if($options['index_header_content_video']){ ?>
        <h4><?php _e( 'Uploaded MP4 file', 'tcd-seeed' ); ?></h4>
        <p><?php echo esc_url(wp_get_attachment_url($options['index_header_content_video'])); ?></p>
        <?php }; ?>
       </div>
       <div class="buttton_area">
        <input type="button" value="<?php _e('Select MP4 file', 'tcd-seeed'); ?>" class="cfmf-select-video button">
        <input type="button" value="<?php _e('Remove MP4 file', 'tcd-seeed'); ?>" class="cfmf-delete-video button <?php if(!$options['index_header_content_video']){ echo 'hidden'; }; ?>">
       </div>
      </div>

     </div><!-- END .index_header_content_type2_option -->

     <?php // YouTube --------------------------------------- ?>
     <div class="index_header_content_type3_option">

      <h4 class="theme_option_headline2"><?php _e('YouTube', 'tcd-seeed'); ?></h4>
      <div class="theme_option_message2">
       <p><?php _e('Please enter YouTube URL.', 'tcd-seeed');  ?></p>
       <p><?php _e('Web browser takes few second to load the data of video so we recommend to use loading screen if you want to display video.', 'tcd-seeed'); ?></p>
      </div>
      <input class="full_width" type="text" name="dp_options[index_header_content_youtube]" value="<?php echo esc_attr( $options['index_header_content_youtube'] ); ?>">

     </div><!-- END .index_header_content_type3_option -->

     <?php // オーバーレイ（共通） ?>
     <h4 class="theme_option_headline2"><?php _e('Overlay', 'tcd-seeed'); ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Color', 'tcd-seeed'); ?></span><input type="text" name="dp_options[index_header_content_overlay_color]" value="<?php echo esc_attr( $options['index_header_content_overlay_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
      <li class="cf">
       <span class="label"><?php _e('Transparency of overlay', 'tcd-seeed'); ?></span><input class="hankaku" style="width:70px;" type="number" min="0" max="1" step="0.1" name="dp_options[index_header_content_overlay_opacity]" value="<?php echo esc_attr( $options['index_header_content_overlay_opacity'] ); ?>" />
       <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
        <p><?php _e('Please specify the number of 0 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-seeed');  ?>
        <?php _e('Please enter 0 if you don\'t want to use overlay.', 'tcd-seeed');  ?></p>
       </div>
      </li>
     </ul>

     </div><!-- END .sub_box_tab_content -->

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-seeed' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-seeed' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // ニュースティッカー設定 ----------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('News ticker', 'tcd-seeed');  ?></h3>
    <div class="theme_option_field_ac_content">

     <div class="front_page_image">
      <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/index_news.jpg" alt="" title="" />
     </div>

     <p class="displayment_checkbox"><label><input name="dp_options[show_header_news]" type="checkbox" value="1" <?php checked( $options['show_header_news'], 1 ); ?>><?php _e( 'Display news ticker', 'tcd-seeed' ); ?></label></p>
     <div style="<?php if($options['show_header_news'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <ul class="option_list">
       <li class="cf" style="border-top:1px dotted #ccc;">
        <span class="label"><?php _e('Post type', 'tcd-seeed');  ?></span>
        <div class="standard_radio_button">
         <input id="header_news_post_type_post" type="radio" name="dp_options[header_news_post_type]" value="post" <?php checked( $options['header_news_post_type'], 'post' ); ?>>
         <label for="header_news_post_type_post"><?php echo esc_html($blog_label); ?></label>
         <input id="header_news_post_type_news" type="radio" name="dp_options[header_news_post_type]" value="news" <?php checked( $options['header_news_post_type'], 'news' ); ?>>
         <label for="header_news_post_type_news"><?php echo esc_html($news_label); ?></label>
        </div>
       </li>
       <li class="cf">
        <span class="label"><?php _e('Post order', 'tcd-seeed');  ?></span>
        <div class="standard_radio_button">
         <input id="header_news_post_order_date" type="radio" name="dp_options[header_news_post_order]" value="date" <?php checked( $options['header_news_post_order'], 'date' ); ?>>
         <label for="header_news_post_order_date"><?php _e('Date', 'tcd-seeed'); ?></label>
         <input id="header_news_post_order_rand" type="radio" name="dp_options[header_news_post_order]" value="rand" <?php checked( $options['header_news_post_order'], 'rand' ); ?>>
         <label for="header_news_post_order_rand"><?php _e('Random', 'tcd-seeed'); ?></label>
        </div>
       </li>
      </ul>
     </div><!-- END .displayment_checkbox -->

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-seeed' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-seeed' ); ?></a></li>
     </ul>

    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // コンテンツビルダー ここから ■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■ ?>
   <div class="theme_option_field theme_option_field_ac open active">
    <h3 class="theme_option_headline"><?php _e('Content builder', 'tcd-seeed');  ?></h3>
    <div class="theme_option_field_ac_content">

     <ul class="design_radio_button" style="margin-bottom:25px;">
      <li class="index_content_type1_button">
       <input type="radio" id="index_content_type1" name="dp_options[index_content_type]" value="type1" <?php checked( $options['index_content_type'], 'type1' ); ?> />
       <label for="index_content_type1"><?php _e('Use content builder', 'tcd-seeed');  ?></label>
      </li>
      <li class="index_content_type2_button">
       <input type="radio" id="index_content_type2" name="dp_options[index_content_type]" value="type2" <?php checked( $options['index_content_type'], 'type2' ); ?> />
       <label for="index_content_type2"><?php _e('Use page content instead of content builder', 'tcd-seeed');  ?></label>
      </li>
     </ul>

     <?php
          // コンテンツビルダーの代わりに使う固定ページのコンテンツ
          $front_page_id = get_option('page_on_front');
          if($front_page_id){
     ?>
     <div class="index_content_type2_option" style="<?php if($options['index_content_type'] == 'type2') { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <div class="theme_option_message2">
       <p><?php printf(__('Please set content from <a href="post.php?post=%s&action=edit" target="_blank">Front page edit screen</a>.', 'tcd-seeed'), $front_page_id); ?></p>
      </div>
      <h4 class="theme_option_headline2"><?php _e('Content width', 'tcd-seeed');  ?></h4>
      <ul class="option_list">
       <li class="cf">
        <span class="label"><?php _e('Content width type', 'tcd-seeed'); ?></span>
        <div class="standard_radio_button">
         <input id="page_content_width_type1" type="radio" name="dp_options[page_content_width_type]" value="type1" <?php checked( $options['page_content_width_type'], 'type1' ); ?>>
         <label for="page_content_width_type1"><?php _e('Any width', 'tcd-seeed'); ?></label>
         <input id="page_content_width_type2" type="radio" name="dp_options[page_content_width_type]" value="type2" <?php checked( $options['page_content_width_type'], 'type2' ); ?>>
         <label for="page_content_width_type2"><?php _e('Full screen width', 'tcd-seeed'); ?></label>
        </div>
       </li>
       <li class="cf page_content_width_type1_option" style="<?php if($options['page_content_width_type'] == 'type1'){ echo 'display:block;'; } else {  echo 'display:none;'; }; ?>">
        <span class="label"><?php _e('Content width', 'tcd-seeed'); ?></span><input class="hankaku page_content_width_input" style="width:100px;" type="number" name="dp_options[page_content_width]" value="<?php echo esc_attr($options['page_content_width']); ?>" /><span>px</span>
       </li>
      </ul>
     </div>
     <?php }; ?>

     <?php // コンテンツビルダー ------------------------------------------------------------------------------------- ?>
     <div class="index_content_type1_option" style="<?php if($options['index_content_type'] == 'type1') { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">

      <h4 class="theme_option_headline2"><?php _e( 'Contents Builder', 'tcd-seeed' ); ?></h4>

      <div class="js-contents-builder admin-contents-builder">
       <input type="hidden" name="dp_options[contents_builder]" value="">
       <div class="admin-contents-builder__list js-contents-builder-list">
        <?php
             if ( !empty( $options['contents_builder'] ) ) {
               foreach( $options['contents_builder'] as $key => $values ) :
                 admin_contents_builder_start( $key, $values );
                 switch( true ){
                   case $values['type'] == 'image_slider' :
                     admin_contents_builder_image_slider( $key, $values );
                     break;
                   case $values['type'] == 'selling_point' :
                     admin_contents_builder_selling_point( $key, $values );
                     break;
                   case $values['type'] == 'case_study_list' :
                     admin_contents_builder_case_study_list( $key, $values );
                     break;
                   case $values['type'] == 'service_list':
                     admin_contents_builder_service_list( $key, $values );
                     break;
                   case $values['type'] == 'blog_list' :
                     admin_contents_builder_blog_list( $key, $values );
                     break;
                   case $values['type'] == 'news_list' :
                     admin_contents_builder_news_list( $key, $values );
                     break;
                   case $values['type'] == 'free_space' :
                     admin_contents_builder_free_space( $key, $values );
                     break;
                 }
                 admin_contents_builder_end();
               endforeach;
             }
        ?>
       </div>
       <div class="admin-contents-builder__add">
        <div class="admin-contents-builder__add-info">
         <span><?php _e( 'Additional Items', 'tcd-seeed' ); ?></span>
         <p><?php _e( 'The following items can be added by clicking on them', 'tcd-seeed' ); ?></p>
        </div>
        <div class="admin-contents-builder__add-list">
         <?php
              $content_types = array('image_slider', 'selling_point', 'case_study_list', 'service_list', 'blog_list', 'news_list', 'free_space');
              foreach( $content_types as $type ){
                ob_start();
                $key = 'cb-index';
                admin_contents_builder_start( $key, array( 'type' => $type ) );
                switch( true ){
                  case $type == 'image_slider' :
                    $title = __( 'Image carousel', 'tcd-seeed' );
                    $is_active = 'is-active';
                    $image_name = 'image_slider';
                    admin_contents_builder_image_slider( $key, array() );
                    break;
                  case $type == 'selling_point' :
                    $title = __( 'Selling content', 'tcd-seeed' );
                    $is_active = 'is-active';
                    $image_name = 'selling_point';
                    admin_contents_builder_selling_point( $key, array() );
                    break;
                  case $type == 'case_study_list':
                    $title = sprintf(__('%s list', 'tcd-seeed'), $case_study_label);
                    $is_active = $options['use_case_study'] ? 'is-active' : '';
                    $image_name = 'case_study_list';
                    admin_contents_builder_case_study_list( $key, array() );
                    break;
                  case $type == 'service_list' :
                    $title = sprintf(__('%s list', 'tcd-seeed'), $service_label);
                    $is_active = $options['use_service'] ? 'is-active' : '';
                    if($options['archive_service_list_type'] != 'type4'){
                      $image_name = 'service_list';
                    } else {
                      $image_name = 'service_post_list';
                    }
                    admin_contents_builder_service_list( $key, array() );
                    break;
                  case $type == 'blog_list' :
                    $title = sprintf(__('%s list', 'tcd-seeed'), $blog_label);
                    $is_active = 'is-active';
                    $image_name = 'blog_list';
                    admin_contents_builder_blog_list( $key, array() );
                    break;
                  case $type == 'news_list':
                    $title = sprintf(__('%s list', 'tcd-seeed'), $news_label);
                    $is_active = $options['use_news'] ? 'is-active' : '';
                    $image_name = 'news_list';
                    admin_contents_builder_news_list( $key, array() );
                    break;
                  case $type == 'free_space' :
                    $title = __( 'Free space', 'tcd-seeed' );
                    $is_active = 'is-active';
                    $image_name = 'free_space';
                    admin_contents_builder_free_space( $key, array() );
                    break;
                }
                admin_contents_builder_end();
                $clone = ob_get_clean();
         ?>
         <div class="admin-contents-builder__add-item js-contents-builder-add <?php echo $is_active; ?>" data-clone="<?php echo esc_attr( $clone ); ?>">
          <div class="admin-contents-builder__add-item__inner">
           <div class="admin-contents-builder__add-item__overlay">
            <?php if( $is_active ){ ?>
            <span class="admin-contents-builder__add-item__icon c-icon">&#xe145;</span>
            <?php _e( 'Add this item', 'tcd-seeed' ); ?>
            <?php } else { ?>
            <?php _e( 'Not available now', 'tcd-seeed' ); ?>
            <?php } ?>
           </div>
           <img class="admin-contents-builder__add-item__image" src="<?php echo get_template_directory_uri() . '/admin/img/cb_' . $image_name . '.jpg?2.2'; ?>" width="" height="" />
          </div>
          <span class="admin-contents-builder__add-item__label"><?php echo $title; ?></span>
         </div>
         <?php
              } // END foreach
         ?>
        </div><!-- END .admin-contents-builder__add-list -->
       </div><!-- END .admin-contents-builder__add -->
      </div><!-- END .admin-contents-builder -->

     </div><!-- END .index_content_type1_option -->

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-seeed' ); ?>" /></li>
     </ul>

    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->

</div><!-- END .tab-content -->

<?php
} // END add_front_page_tab_panel()


// バリデーション　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_front_page_theme_options_validate( $input ) {

  global $dp_default_options, $item_type_options, $font_type_options;


  // ヘッダーコンテンツ
  $input['index_header_content_type'] = wp_filter_nohtml_kses( $input['index_header_content_type'] );

  // 画像スライダーの設定
  $input['index_slider_image'] = wp_filter_nohtml_kses( $input['index_slider_image'] );
  $input['index_slider_image_sp'] = wp_filter_nohtml_kses( $input['index_slider_image_sp'] );
  $input['index_image_slider_animation_type'] = wp_filter_nohtml_kses( $input['index_image_slider_animation_type'] );

  // 動画・YouTube
  $input['index_header_content_video'] = wp_filter_nohtml_kses( $input['index_header_content_video'] );
  $input['index_header_content_youtube'] = wp_filter_nohtml_kses( $input['index_header_content_youtube'] );

  $input['index_header_content_catch'] = wp_kses_post( $input['index_header_content_catch'] );
  $input['index_header_content_catch_mobile'] = wp_kses_post( $input['index_header_content_catch_mobile'] );
  $input['index_header_content_catch_font_type'] = wp_filter_nohtml_kses( $input['index_header_content_catch_font_type'] );
  $input['index_header_content_catch_font_size'] = wp_filter_nohtml_kses( $input['index_header_content_catch_font_size'] );
  $input['index_header_content_catch_font_size_sp'] = wp_filter_nohtml_kses( $input['index_header_content_catch_font_size_sp'] );
  $input['index_header_content_catch_animation_type'] = wp_filter_nohtml_kses( $input['index_header_content_catch_animation_type'] );
  $input['index_header_content_button_label'] = wp_filter_nohtml_kses( $input['index_header_content_button_label'] );
  $input['index_header_content_button_url'] = wp_filter_nohtml_kses( $input['index_header_content_button_url'] );
  $input['index_header_content_button_target'] = wp_filter_nohtml_kses( $input['index_header_content_button_target'] );

  $input['index_header_content_overlay_color'] = wp_filter_nohtml_kses( $input['index_header_content_overlay_color'] );
  $input['index_header_content_overlay_opacity'] = wp_filter_nohtml_kses( $input['index_header_content_overlay_opacity'] );


  // 実績の設定
  $input['show_index_achievements'] = ! empty( $input['show_index_achievements'] ) ? 1 : 0;
  $input['index_achievements_headline'] = wp_filter_nohtml_kses( $input['index_achievements_headline'] );
  $input['index_achievements_num'] = wp_filter_nohtml_kses( $input['index_achievements_num'] );
  $input['index_achievements_unit'] = wp_kses_post( $input['index_achievements_unit'] );
  $input['index_achievements_desc'] = wp_filter_nohtml_kses( $input['index_achievements_desc'] );


  // ニュースティッカーの設定
  $input['show_header_news'] = ! empty( $input['show_header_news'] ) ? 1 : 0;
  $input['header_news_post_type'] = wp_kses_post( $input['header_news_post_type'] );
  $input['header_news_post_order'] = wp_filter_nohtml_kses( $input['header_news_post_order'] );


  // コンテンツビルダーの代わりに使う固定ページのコンテンツ
  $input['index_content_type'] = wp_filter_nohtml_kses( $input['index_content_type'] );
  $input['page_content_width'] = wp_filter_nohtml_kses( $input['page_content_width'] );


  // コンテンツビルダー -----------------------------------------------------------------------------
  $contents_builder = array();
  if ( isset( $input['contents_builder'] ) && is_array( $input['contents_builder'] ) ) {
    foreach ( $input['contents_builder'] as $key => $value ) {

      if( !isset( $value['type'] ) || !$value['type'] )
        continue;

      switch( $value['type'] ){

        case 'image_slider' :
          $contents_builder[] = array(
            'type' => $value['type'],
            'show_content' => ! empty( $input['contents_builder'][$key]['show_content'] ) ? 1 : 0,
            'catch' => isset( $input['contents_builder'][$key]['catch'] ) ? wp_kses_post( $input['contents_builder'][$key]['catch'] ) : '',
            'desc' => isset( $input['contents_builder'][$key]['desc'] ) ? wp_kses_post( $input['contents_builder'][$key]['desc'] ) : '',
            'desc_mobile' => isset( $input['contents_builder'][$key]['desc_mobile'] ) ? wp_kses_post( $input['contents_builder'][$key]['desc_mobile'] ) : '',
            'button_label' => isset( $input['contents_builder'][$key]['button_label'] ) ? wp_kses_post( $input['contents_builder'][$key]['button_label'] ) : '',
            'button_url' => isset( $input['contents_builder'][$key]['button_url'] ) ? wp_kses_post( $input['contents_builder'][$key]['button_url'] ) : '',
            'button_target' => ! empty( $input['contents_builder'][$key]['button_target'] ) ? 1 : 0,
            'image_slider' => isset( $input['contents_builder'][$key]['image_slider'] ) ? wp_kses_post( $input['contents_builder'][$key]['image_slider'] ) : '',
          );
          break;

        case 'selling_point' :
          $contents_builder[] = array(
            'type' => $value['type'],
            'show_content' => ! empty( $input['contents_builder'][$key]['show_content'] ) ? 1 : 0,
            'catch' => isset( $input['contents_builder'][$key]['catch'] ) ? wp_kses_post( $input['contents_builder'][$key]['catch'] ) : '',
            'desc' => isset( $input['contents_builder'][$key]['desc'] ) ? wp_kses_post( $input['contents_builder'][$key]['desc'] ) : '',
            'desc_mobile' => isset( $input['contents_builder'][$key]['desc_mobile'] ) ? wp_kses_post( $input['contents_builder'][$key]['desc_mobile'] ) : '',
            'point_label' => isset( $input['contents_builder'][$key]['point_label'] ) ? wp_kses_post( $input['contents_builder'][$key]['point_label'] ) : 'POINT',
            'item_list' => isset( $input['contents_builder'][$key]['item_list'] ) ? $input['contents_builder'][$key]['item_list'] : '',
          );
          break;

        case 'case_study_list' :
          $contents_builder[] = array(
            'type' => $value['type'],
            'show_content' => ! empty( $input['contents_builder'][$key]['show_content'] ) ? 1 : 0,
            'catch' => isset( $input['contents_builder'][$key]['catch'] ) ? wp_kses_post( $input['contents_builder'][$key]['catch'] ) : '',
            'desc' => isset( $input['contents_builder'][$key]['desc'] ) ? wp_kses_post( $input['contents_builder'][$key]['desc'] ) : '',
            'desc_mobile' => isset( $input['contents_builder'][$key]['desc_mobile'] ) ? wp_kses_post( $input['contents_builder'][$key]['desc_mobile'] ) : '',
            'button_label' => isset( $input['contents_builder'][$key]['button_label'] ) ? wp_kses_post( $input['contents_builder'][$key]['button_label'] ) : '',
            'post_num' => isset( $input['contents_builder'][$key]['post_num'] ) ? wp_kses_post( $input['contents_builder'][$key]['post_num'] ) : '6',
            'post_num_sp' => isset( $input['contents_builder'][$key]['post_num_sp'] ) ? wp_kses_post( $input['contents_builder'][$key]['post_num_sp'] ) : '6',
          );
          break;

        case 'service_list' :
          $contents_builder[] = array(
            'type' => $value['type'],
            'show_content' => ! empty( $input['contents_builder'][$key]['show_content'] ) ? 1 : 0,
            'catch' => isset( $input['contents_builder'][$key]['catch'] ) ? wp_kses_post( $input['contents_builder'][$key]['catch'] ) : '',
            'desc' => isset( $input['contents_builder'][$key]['desc'] ) ? wp_kses_post( $input['contents_builder'][$key]['desc'] ) : '',
            'desc_mobile' => isset( $input['contents_builder'][$key]['desc_mobile'] ) ? wp_kses_post( $input['contents_builder'][$key]['desc_mobile'] ) : '',
            'button_label' => isset( $input['contents_builder'][$key]['button_label'] ) ? wp_kses_post( $input['contents_builder'][$key]['button_label'] ) : '',
            'post_type' => isset( $input['contents_builder'][$key]['post_type'] ) ? wp_kses_post( $input['contents_builder'][$key]['post_type'] ) : 'type1',
            'post_num' => isset( $input['contents_builder'][$key]['post_num'] ) ? wp_kses_post( $input['contents_builder'][$key]['post_num'] ) : '3',
            'post_num_sp' => isset( $input['contents_builder'][$key]['post_num_sp'] ) ? wp_kses_post( $input['contents_builder'][$key]['post_num_sp'] ) : '3',
          );
          break;

        case 'blog_list' :
          $contents_builder[] = array(
            'type' => $value['type'],
            'show_content' => ! empty( $input['contents_builder'][$key]['show_content'] ) ? 1 : 0,
            'catch' => isset( $input['contents_builder'][$key]['catch'] ) ? wp_kses_post( $input['contents_builder'][$key]['catch'] ) : '',
            'desc' => isset( $input['contents_builder'][$key]['desc'] ) ? wp_kses_post( $input['contents_builder'][$key]['desc'] ) : '',
            'desc_mobile' => isset( $input['contents_builder'][$key]['desc_mobile'] ) ? wp_kses_post( $input['contents_builder'][$key]['desc_mobile'] ) : '',
            'button_label' => isset( $input['contents_builder'][$key]['button_label'] ) ? wp_kses_post( $input['contents_builder'][$key]['button_label'] ) : '',
            'post_num' => isset( $input['contents_builder'][$key]['post_num'] ) ? wp_kses_post( $input['contents_builder'][$key]['post_num'] ) : '6',
            'post_num_sp' => isset( $input['contents_builder'][$key]['post_num_sp'] ) ? wp_kses_post( $input['contents_builder'][$key]['post_num_sp'] ) : '6',
            'post_type' => isset( $input['contents_builder'][$key]['post_type'] ) ? wp_kses_post( $input['contents_builder'][$key]['post_type'] ) : 'recent_post',
            'post_order' => isset( $input['contents_builder'][$key]['post_order'] ) ? wp_kses_post( $input['contents_builder'][$key]['post_order'] ) : 'date',
          );
          break;

        case 'news_list' :
          $contents_builder[] = array(
            'type' => $value['type'],
            'show_content' => ! empty( $input['contents_builder'][$key]['show_content'] ) ? 1 : 0,
            'catch' => isset( $input['contents_builder'][$key]['catch'] ) ? wp_kses_post( $input['contents_builder'][$key]['catch'] ) : '',
            'desc' => isset( $input['contents_builder'][$key]['desc'] ) ? wp_kses_post( $input['contents_builder'][$key]['desc'] ) : '',
            'desc_mobile' => isset( $input['contents_builder'][$key]['desc_mobile'] ) ? wp_kses_post( $input['contents_builder'][$key]['desc_mobile'] ) : '',
            'button_label' => isset( $input['contents_builder'][$key]['button_label'] ) ? wp_kses_post( $input['contents_builder'][$key]['button_label'] ) : '',
            'post_num' => isset( $input['contents_builder'][$key]['post_num'] ) ? wp_kses_post( $input['contents_builder'][$key]['post_num'] ) : '6',
            'post_num_sp' => isset( $input['contents_builder'][$key]['post_num_sp'] ) ? wp_kses_post( $input['contents_builder'][$key]['post_num_sp'] ) : '6',
          );
          break;

        case 'free_space' :
          $contents_builder[] = array(
            'type' => $value['type'],
            'show_content' => ! empty( $input['contents_builder'][$key]['show_content'] ) ? 1 : 0,
            'catch' => isset( $input['contents_builder'][$key]['catch'] ) ? wp_kses_post( $input['contents_builder'][$key]['catch'] ) : '',
            'desc' => isset( $input['contents_builder'][$key]['desc'] ) ? wp_kses_post( $input['contents_builder'][$key]['desc'] ) : '',
            'desc_mobile' => isset( $input['contents_builder'][$key]['desc_mobile'] ) ? wp_kses_post( $input['contents_builder'][$key]['desc_mobile'] ) : '',
            'content_width' => isset( $input['contents_builder'][$key]['content_width'] ) ? wp_kses_post( $input['contents_builder'][$key]['content_width'] ) : 'type1',
            'free_space' => isset( $input['contents_builder'][$key]['free_space'] ) ? $input['contents_builder'][$key]['free_space'] : '',
            'bg_color' => isset( $input['contents_builder'][$key]['bg_color'] ) ? wp_kses_post( $input['contents_builder'][$key]['bg_color'] ) : '#ffffff',
          );
          break;

      }

    }
  };
  $input['contents_builder'] = $contents_builder;


  return $input;

};


/**
 * コンテンツビルダー用 コンテンツ設定　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
 */
// コンテンツビルダー
function admin_contents_builder_start( $key, $values = array() ){

  global $blog_label, $font_type_options, $button_type_options, $button_border_radius_options, $button_size_options, $button_animation_options, $post;
  $options = get_design_plus_option();
  $news_label = $options['news_label'] ? esc_html( $options['news_label'] ) : __( 'News', 'tcd-seeed' );
  $service_label = $options['service_label'] ? esc_html( $options['service_label'] ) : __( 'Service', 'tcd-seeed' );
  $case_study_label = $options['case_study_label'] ? esc_html( $options['case_study_label'] ) : __( 'Case study', 'tcd-seeed' );

  $title = '';
  switch( $values['type'] ?? '' ){

    case 'image_slider' :
      $title = __( 'Image carousel', 'tcd-seeed' );
      break;
    case 'selling_point' :
      $title = __( 'Selling content', 'tcd-seeed' );
      break;
    case 'case_study_list' :
      if($options['use_case_study']){
        $title = sprintf(__('%s list', 'tcd-seeed'), $case_study_label);
      } else {
        $title = __('(N/A) ', 'tcd-seeed') . sprintf(__('%s list', 'tcd-seeed'), $case_study_label);
      }
      break;
    case 'service_list' :
      if($options['use_service']){
        $title = sprintf(__('%s list', 'tcd-seeed'), $service_label);
      } else {
        $title = __('(N/A) ', 'tcd-seeed') . sprintf(__('%s list', 'tcd-seeed'), $service_label);
      }
      break;
    case 'blog_list' :
      $title = sprintf(__('%s list', 'tcd-seeed'), $blog_label);
      break;
    case 'news_list' :
      if($options['use_news']){
        $title = sprintf(__('%s list', 'tcd-seeed'), $news_label);
      } else {
        $title = __('(N/A) ', 'tcd-seeed') . sprintf(__('%s list', 'tcd-seeed'), $news_label);
      }
      break;
    case 'free_space' :
      $title = __( 'Free space', 'tcd-seeed' );
      break;

  }

?>
<div class="js-contents-builder-item admin-contents-builder__item">
 <div class="admin-contents-builder__item-headline">
  <span class="admin-contents-builder__item-headline__handle c-icon js-contents-builder-handle">&#xe25d;</span>
  <label class="admin-contents-builder__item-headline__status">
   <input class="js-contents-builder-status" name="dp_options[contents_builder][<?php echo esc_attr( $key ); ?>][show_content]" type="checkbox" value="1" <?php checked( $values['show_content'] ?? 1, 1 ); ?> style="display:none;">
  </label>
  <h4 class="admin-contents-builder__item-headline__label"><?php echo $title; ?></h4>
  <p class="admin-contents-builder__item-headline__info js-contents-builder-item-label-target"><?php echo isset( $values['catch'] ) ? esc_html($values['catch']) : ''; ?></p>
  <span class="admin-contents-builder__item-headline__delete c-icon js-contents-builder-delete" data-alert-msg="<?php _e( 'Are you sure you want to delete this content?', 'tcd-seeed' ); ?>">&#xe872;</span>
  <span class="admin-contents-builder__item-headline__arrow c-icon" style="margin-right:10px;">&#xe5cf;</span>
 </div>
 <div class="admin-contents-builder__item-content">
  <div class="admin-contents-builder__item-content__inner">
<?php

}

function admin_contents_builder_end(){

?>
   <ul class="button_list cf">
    <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-seeed' ); ?>" /></li>
   </ul>
  </div>
 </div>
</div>
<?php
}

// デザインカルーセル
function admin_contents_builder_image_slider( $key, $values ){

  $values = !empty( $values ) ? $values : array(
    'catch' => '',
    'desc' => '',
    'desc_mobile' => '',
    'button_label' => '',
    'button_url' => '',
    'button_target' => '',
    'image_slider' => '',
  );

?>
   <input type="hidden" name="dp_options[contents_builder][<?php echo esc_attr( $key ); ?>][type]" value="image_slider">

   <div class="cb_image">
    <img src="<?php bloginfo('template_url'); ?>/admin/img/cb_image_slider2.jpg" width="" height="" />
   </div>

   <div class="theme_option_message2">
    <p><?php _e('Multiple images are displayed in a carousel. Images and captions are displayed in groups.', 'tcd-seeed'); ?></p>
   </div>

   <h4 class="theme_option_headline2"><?php _e('Basic settings', 'tcd-seeed');  ?></h4>
   <ul class="option_list">
    <li class="cf"><span class="label"><span class="num">1</span><?php _e('Catchphrase', 'tcd-seeed'); ?></span><textarea class="js-contents-builder-item-label full_width" cols="50" rows="3" name="dp_options[contents_builder][<?php echo $key; ?>][catch]"><?php echo esc_textarea($values['catch']); ?></textarea></li>
    <li class="cf"><span class="label"><span class="num">2</span><?php _e('Description', 'tcd-seeed'); ?></span><textarea class="full_width" cols="50" rows="3" name="dp_options[contents_builder][<?php echo $key; ?>][desc]"><?php echo esc_textarea($values['desc']); ?></textarea></li>
    <li class="cf" style="border:none;"><span class="label"><span class="num_space"></span><?php _e('Description (mobile)', 'tcd-seeed'); ?></span><textarea placeholder="<?php _e( 'Please indicate if you would like to display a short text for mobile sizes.', 'tcd-seeed' ); ?>" class="full_width" cols="50" rows="3" name="dp_options[contents_builder][<?php echo $key; ?>][desc_mobile]"><?php echo esc_textarea($values['desc_mobile']); ?></textarea></li>
    <li class="cf">
     <span class="label">
      <span class="num">3</span><?php _e('Link button label', 'tcd-seeed'); ?>
      <span class="recommend_desc space"><?php _e('Leave this field blank if you don\'t want to display button.', 'tcd-seeed'); ?></span>
     </span>
     <input type="text" class="full_width" name="dp_options[contents_builder][<?php echo $key; ?>][button_label]" value="<?php echo esc_attr($values['button_label']); ?>" />
    </li>
    <li class="cf" style="border:none;">
     <span class="label"><span class="num_space"></span><?php _e('Link button URL', 'tcd-seeed'); ?></span>
     <div class="admin_link_option">
      <input class="full_width" type="text" name="dp_options[contents_builder][<?php echo $key; ?>][button_url]" placeholder="https://example.com/" value="<?php echo esc_attr( $values['button_url'] ); ?>">
      <input id="button_target<?php echo $key; ?>" name="dp_options[contents_builder][<?php echo $key; ?>][button_target]" type="checkbox" value="1" <?php checked( $values['button_target'], 1 ); ?>>
      <label for="button_target<?php echo $key; ?>">&#xe920;</label>
     </div>
    </li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Carousel', 'tcd-seeed');  ?></h4>
   <div class="theme_option_message2">
    <p><?php _e('Please register more than 4 images and be sure to register an even number of images to work image carousel fine.<br>If you have registered a caption for the image in media library, caption will be displayed on image carousel.', 'tcd-seeed'); ?><br>
    <?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-seeed'), '310', '440'); ?></p>
   </div>
   <div class="multi-media-uploader" style="float:none; width:100%;">
    <ul>
     <?php
          $image_slider = $values['image_slider'];
          $image_ids = explode( ',', $image_slider );
          $display = 'none';
          if ( $image_slider && !empty( $image_ids ) ) {
            $display = 'inline-block';
            foreach ( $image_ids as $image_id ) {
              if ( $image_attributes = wp_get_attachment_image_src( $image_id, 'thumbnail' ) ) {
     ?>
     <li data-attechment-id="<?php echo $image_id; ?>">
      <img src="<?php echo $image_attributes[0]; ?>" />
      <span class="delete-img"></span>
     </li>
     <?php
             }
           }
         }
     ?>
    </ul>
    <a id="image_slider<?php echo $key; ?>" href="#" class="js-multi-media-upload-button button">
     <?php _e( 'Select Image', 'tcd-seeed' ); ?>
    </a>
    <input type="hidden" class="attechments-ids image_slider<?php echo $key; ?>" name="dp_options[contents_builder][<?php echo $key; ?>][image_slider]" value="<?php echo esc_attr( implode( ',', $image_ids ) ); ?>" />
    <a href="#" class="js-multi-media-remove-button button" style="display:<?php echo $display; ?>;">
     <?php _e( 'Delete all images', 'tcd-seeed' ); ?>
    </a>
   </div>

<?php
}

// セールスポイント
function admin_contents_builder_selling_point( $key, $values ){
  global $post;

  $values = !empty( $values ) ? $values : array(
    'catch' => '',
    'desc' => '',
    'desc_mobile' => '',
    'point_label' => 'POINT',
    'item_list' => array(),
  );

?>
   <input type="hidden" name="dp_options[contents_builder][<?php echo esc_attr( $key ); ?>][type]" value="selling_point">

   <div class="cb_image">
    <img src="<?php bloginfo('template_url'); ?>/admin/img/cb_selling_point2.jpg?2.0" width="" height="" />
   </div>

   <div class="theme_option_message2">
    <p><?php _e('This content display images and charts to promote the strengths of the service. You can create multiple contents that slide left and right.', 'tcd-seeed'); ?></p>
   </div>

   <h4 class="theme_option_headline2"><?php _e('Basic settings', 'tcd-seeed');  ?></h4>
   <ul class="option_list">
    <li class="cf"><span class="label"><span class="num">1</span><?php _e('Catchphrase', 'tcd-seeed'); ?></span><textarea class="js-contents-builder-item-label full_width" cols="50" rows="3" name="dp_options[contents_builder][<?php echo $key; ?>][catch]"><?php echo esc_textarea($values['catch']); ?></textarea></li>
    <li class="cf"><span class="label"><span class="num">2</span><?php _e('Description', 'tcd-seeed'); ?></span><textarea class="full_width" cols="50" rows="3" name="dp_options[contents_builder][<?php echo $key; ?>][desc]"><?php echo esc_textarea($values['desc']); ?></textarea></li>
    <li class="cf" style="border:none;"><span class="label"><span class="num_space"></span><?php _e('Description (mobile)', 'tcd-seeed'); ?></span><textarea placeholder="<?php _e( 'Please indicate if you would like to display a short text for mobile sizes.', 'tcd-seeed' ); ?>" class="full_width" cols="50" rows="3" name="dp_options[contents_builder][<?php echo $key; ?>][desc_mobile]"><?php echo esc_textarea($values['desc_mobile']); ?></textarea></li>
   </ul>

   <?php // リピーターここから -------------------------- ?>
   <h4 class="theme_option_headline2"><?php _e('Content list', 'tcd-seeed');  ?></h4>
   <ul class="option_list">
    <li class="cf">
     <span class="label">
      <span class="num">3</span><?php _e('Point label', 'tcd-seeed'); ?>
      <span class="recommend_desc space"><?php _e('A label is displayed for each item added. Leave this field blank if you don\'t want to display point label.', 'tcd-seeed'); ?></span>
     </span>
     <input type="text" class="full_width" name="dp_options[contents_builder][<?php echo $key; ?>][point_label]" value="<?php echo esc_attr($values['point_label']); ?>" placeholder="POINT" />
    </li>
   </ul>
   <div class="theme_option_message2">
    <p><?php _e('Click add item button to start this option.<br />You can change order by dragging each headline of option field.', 'tcd-seeed');  ?></p>
   </div>
   <div class="repeater-wrapper">
    <div class="repeater sortable" data-delete-confirm="<?php _e( 'Delete?', 'tcd-seeed' ); ?>">
     <?php
          if ( $values['item_list'] && is_array( $values['item_list'] ) ) :
            foreach ( $values['item_list'] as $repeater_key => $repeater_value ) :
     ?>
     <div class="sub_box repeater-item repeater-item-<?php echo esc_attr( $repeater_key ); ?>">
      <h4 class="theme_option_subbox_headline"><?php _e( 'Content', 'tcd-seeed' ); ?></h4>
      <div class="sub_box_content tab_parent">

       <div class="sub_box_tab">
        <div class="tab active" data-tab="tab1"><?php _e('Default', 'tcd-seeed'); ?></div>
        <div class="tab" data-tab="tab2"><?php _e('Post-slide', 'tcd-seeed'); ?></div>
       </div>

       <?php for ( $i = 1; $i <= 2; $i++ ): ?>

       <div class="sub_box_tab_content<?php if($i == 1){ echo ' active'; }; ?>" data-tab-content="tab<?php echo $i; ?>">

       <?php if($i == 2){ ?>
       <input type="hidden" name="dp_options[contents_builder][<?php echo $key; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][display_right_content]" value="0">
       <p class="displayment_checkbox"><label><input name="dp_options[contents_builder][<?php echo $key; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][display_right_content]" type="checkbox" value="1" <?php checked( $repeater_value['display_right_content'], 1 ); ?>><?php _e( 'Display Post-slide content', 'tcd-seeed' ); ?></label></p>
       <div style="<?php if($repeater_value['display_right_content'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
       <?php }; ?>

       <h4 class="theme_option_headline2"><?php if($i == 1){ _e('Default layout', 'tcd-seeed'); } else { _e('Post-slide layout', 'tcd-seeed'); }; ?></h4>
       <div class="cb_image middle">
        <img class="one_column_option" src="<?php bloginfo('template_url'); ?>/admin/img/cb_selling_point_layout1.jpg" width="" height="" />
        <img class="two_column_option" src="<?php bloginfo('template_url'); ?>/admin/img/cb_selling_point_layout2.jpg" width="" height="" />
       </div>
       <div class="theme_option_message2" style="margin-top:20px;">
        <p><?php _e('TypeA: Background image can be set for the main content.<br>TypeB: Background color can be set instead of a background image. Main content and sub content (image or chart) can be set.', 'tcd-seeed'); ?></p>
       </div>
       <ul class="option_list">
        <li class="cf">
         <span class="label"><?php _e('Layout', 'tcd-seeed');  ?></span>
         <div class="standard_radio_button">
          <input class="sp_layout_type1" id="sp_layout_type1_<?php echo $i; ?>_<?php echo $key; ?>_<?php echo esc_attr( $repeater_key ); ?>" type="radio" name="dp_options[contents_builder][<?php echo $key; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][layout<?php echo $i; ?>]" value="type1" <?php checked( $repeater_value['layout'.$i], 'type1' ); ?>>
          <label for="sp_layout_type1_<?php echo $i; ?>_<?php echo $key; ?>_<?php echo esc_attr( $repeater_key ); ?>"><?php _e('Type A', 'tcd-seeed'); ?></label>
          <input class="sp_layout_type2" id="sp_layout_type2_<?php echo $i; ?>_<?php echo $key; ?>_<?php echo esc_attr( $repeater_key ); ?>" type="radio" name="dp_options[contents_builder][<?php echo $key; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][layout<?php echo $i; ?>]" value="type2" <?php checked( $repeater_value['layout'.$i], 'type2' ); ?>>
          <label for="sp_layout_type2_<?php echo $i; ?>_<?php echo $key; ?>_<?php echo esc_attr( $repeater_key ); ?>"><?php _e('Type B', 'tcd-seeed'); ?></label>
         </div>
        </li>
       </ul>

       <h4 class="theme_option_headline2"><?php if($i == 1){ _e('Default main content', 'tcd-seeed'); } else { _e('Post-slide main content', 'tcd-seeed'); };  ?></h4>
       <input type="hidden" name="dp_options[contents_builder][<?php echo $key; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][button_target<?php echo $i; ?>]" value="0">
       <ul class="option_list">
        <li class="cf">
         <span class="label"><?php _e('Position', 'tcd-seeed');  ?></span>
         <div class="standard_radio_button">
          <input id="sp_position_type1_<?php echo $i; ?>_<?php echo $key; ?>_<?php echo esc_attr( $repeater_key ); ?>" type="radio" name="dp_options[contents_builder][<?php echo $key; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][position<?php echo $i; ?>]" value="type1" <?php checked( $repeater_value['position'.$i], 'type1' ); ?>>
          <label for="sp_position_type1_<?php echo $i; ?>_<?php echo $key; ?>_<?php echo esc_attr( $repeater_key ); ?>"><?php _e('Left', 'tcd-seeed'); ?></label>
          <input id="sp_position_type3_<?php echo $i; ?>_<?php echo $key; ?>_<?php echo esc_attr( $repeater_key ); ?>" type="radio" name="dp_options[contents_builder][<?php echo $key; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][position<?php echo $i; ?>]" value="type3" <?php checked( $repeater_value['position'.$i], 'type3' ); ?>>
          <label class="one_column_option" for="sp_position_type3_<?php echo $i; ?>_<?php echo $key; ?>_<?php echo esc_attr( $repeater_key ); ?>"><?php _e('Center', 'tcd-seeed'); ?></label>
          <input id="sp_position_type2_<?php echo $i; ?>_<?php echo $key; ?>_<?php echo esc_attr( $repeater_key ); ?>" type="radio" name="dp_options[contents_builder][<?php echo $key; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][position<?php echo $i; ?>]" value="type2" <?php checked( $repeater_value['position'.$i], 'type2' ); ?>>
          <label for="sp_position_type2_<?php echo $i; ?>_<?php echo $key; ?>_<?php echo esc_attr( $repeater_key ); ?>"><?php _e('Right', 'tcd-seeed'); ?></label>
         </div>
        </li>
        <li class="cf"><span class="label"><?php _e('Catchphrase', 'tcd-seeed'); ?></span><textarea class="<?php if($i ==1){ echo 'repeater-label '; }; ?>full_width" cols="50" rows="2" name="dp_options[contents_builder][<?php echo $key; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][catch<?php echo $i; ?>]"><?php echo esc_textarea($repeater_value['catch'.$i]); ?></textarea></li>
        <li class="cf"><span class="label"><?php _e('Description', 'tcd-seeed'); ?></span><textarea class="full_width" cols="50" rows="3" name="dp_options[contents_builder][<?php echo $key; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][desc<?php echo $i; ?>]"><?php echo esc_textarea($repeater_value['desc'.$i]); ?></textarea></li>
        <li class="cf">
         <span class="label">
          <?php _e('Link button label', 'tcd-seeed'); ?>
          <span class="recommend_desc"><?php _e('Leave this field blank if you don\'t want to display button.', 'tcd-seeed'); ?></span>
         </span>
         <input type="text" class="full_width" name="dp_options[contents_builder][<?php echo $key; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][button_label<?php echo $i; ?>]" value="<?php echo esc_attr($repeater_value['button_label'.$i]); ?>" />
        </li>
        <li class="cf">
         <span class="label"><?php _e('Link button URL', 'tcd-seeed'); ?></span>
         <div class="admin_link_option">
          <input class="full_width" type="text" name="dp_options[contents_builder][<?php echo $key; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][button_url<?php echo $i; ?>]" placeholder="https://example.com/" value="<?php echo esc_attr( $repeater_value['button_url'.$i] ); ?>">
          <input id="sp_button_target<?php echo $i; ?>_<?php echo $key; ?>_<?php echo esc_attr( $repeater_key ); ?>" name="dp_options[contents_builder][<?php echo $key; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][button_target<?php echo $i; ?>]" type="checkbox" value="1" <?php checked( $repeater_value['button_target'.$i], 1 ); ?>>
          <label for="sp_button_target<?php echo $i; ?>_<?php echo $key; ?>_<?php echo esc_attr( $repeater_key ); ?>">&#xe920;</label>
         </div>
        </li>
        <li class="cf two_column_option"><span class="label"><?php _e('Font color', 'tcd-seeed'); ?></span><input type="text" name="dp_options[contents_builder][<?php echo $key; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][font_color<?php echo $i; ?>]" value="<?php echo esc_attr( $repeater_value['font_color'.$i] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
        <li class="cf two_column_option">
         <span class="label"><?php _e('Background color', 'tcd-seeed'); ?></span>
         <div class="color_presets">
          <ul class="color_presets_list">
           <?php foreach( TCD_COLOR_PRESET_FOR_LIST as $label => $colors ): ?>
           <li class="js-color-preset-item-for-list color_presets_item" data-color="<?php echo $colors['main']; ?>">
            <div class="color_presets_color">
             <span class="color_presets_color-main" style="background:<?php echo $colors['main']; ?>;">
              <span class="color_presets_color-copied">&#xe876;</span>
             </span>
            </div>
           </li>
           <?php endforeach; ?>
          </ul>
          <input type="text" name="dp_options[contents_builder][<?php echo $key; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][bg_color<?php echo $i; ?>]" value="<?php echo esc_attr( $repeater_value['bg_color'.$i] ); ?>" data-default-color="#ffffff" class="c-color-picker js-color-preset-target--main">
         </div>
        </li>
       </ul>

       <div class="two_column_option">
       <h4 class="theme_option_headline2"><?php if($i == 1){ _e('Default sub content', 'tcd-seeed'); } else { _e('Post-slide sub content', 'tcd-seeed'); };  ?></h4>
       <ul class="option_list">
        <li class="cf">
         <span class="label"><?php _e('Sub content type', 'tcd-seeed');  ?></span>
         <div class="standard_radio_button">
          <input class="sp_sub_content_type_type1" id="sp_sub_content_type_type1_<?php echo $i; ?>_<?php echo $key; ?>_<?php echo esc_attr( $repeater_key ); ?>" type="radio" name="dp_options[contents_builder][<?php echo $key; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][sub_content_type<?php echo $i; ?>]" value="type1" <?php checked( $repeater_value['sub_content_type'.$i], 'type1' ); ?>>
          <label for="sp_sub_content_type_type1_<?php echo $i; ?>_<?php echo $key; ?>_<?php echo esc_attr( $repeater_key ); ?>"><?php _e('Image', 'tcd-seeed'); ?></label>
          <input class="sp_sub_content_type_type2" id="sp_sub_content_type_type2_<?php echo $i; ?>_<?php echo $key; ?>_<?php echo esc_attr( $repeater_key ); ?>" type="radio" name="dp_options[contents_builder][<?php echo $key; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][sub_content_type<?php echo $i; ?>]" value="type2" <?php checked( $repeater_value['sub_content_type'.$i], 'type2' ); ?>>
          <label for="sp_sub_content_type_type2_<?php echo $i; ?>_<?php echo $key; ?>_<?php echo esc_attr( $repeater_key ); ?>"><?php _e('Chart', 'tcd-seeed'); ?></label>
         </div>
        </li>
        <li class="cf sub_content_type1_option">
         <span class="label">
          <?php _e('Image', 'tcd-seeed'); ?>
          <span class="recommend_desc"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-seeed'), '500', '500'); ?></span>
         </span>
         <div class="image_box cf">
          <div class="cf cf_media_field hide-if-no-js sp_image_<?php echo $i; ?>_<?php echo $key; ?>_<?php echo esc_attr( $repeater_key ); ?>">
           <input type="hidden" value="<?php if ( isset($repeater_value['image'.$i]) ) echo esc_attr( $repeater_value['image'.$i] ); ?>" id="sp_image_<?php echo $i; ?>_<?php echo $key; ?>_<?php echo esc_attr( $repeater_key ); ?>" name="dp_options[contents_builder][<?php echo $key; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][image<?php echo $i; ?>]" class="cf_media_id">
           <div class="preview_field"><?php if ( isset($repeater_value['image'.$i]) ) echo wp_get_attachment_image( $repeater_value['image'.$i], 'medium'); ?></div>
           <div class="button_area">
            <input type="button" value="<?php _e( 'Select Image', 'tcd-seeed' ); ?>" class="cfmf-select-img button">
            <input type="button" value="<?php _e( 'Remove Image', 'tcd-seeed' ); ?>" class="cfmf-delete-img button <?php if ( isset($repeater_value['image'.$i]) && !$repeater_value['image'.$i] ) echo 'hidden'; ?>">
           </div>
          </div>
         </div>
        </li>
        <li class="cf sub_content_type2_option">
         <span class="label">
          <?php _e('Chart', 'tcd-seeed'); ?>
         </span>
         <?php
              $args = array('post_type' => 'chart', 'posts_per_page' => -1, 'ignore_sticky_posts' => 1);
              $post_list = new wp_query($args);
              if($post_list->have_posts()):
         ?>
         <select name="dp_options[contents_builder][<?php echo $key; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][chart<?php echo $i; ?>]">
          <?php
               while ($post_list->have_posts()) : $post_list->the_post();
                 $chart_type = get_post_meta($post->ID, 'chart_type', true) ?  get_post_meta($post->ID, 'chart_type', true) : 'doughnut';
                 if($chart_type == 'doughnut'){ $chart_name = __('Doughnut chart', 'tcd-seeed'); }
                 elseif($chart_type == 'pie'){ $chart_name = __('Pie chart', 'tcd-seeed'); }
                 elseif($chart_type == 'bar'){ $chart_name = __('Bar chart (vertical)', 'tcd-seeed'); }
                 elseif($chart_type == 'horizontalBar'){ $chart_name = __('Bar chart (horizontal)', 'tcd-seeed'); }
                 elseif($chart_type == 'line'){ $chart_name = __('Line chart', 'tcd-seeed'); };
          ?>
          <option value="<?php echo esc_attr($post->ID); ?>" <?php selected($post->ID, $repeater_value['chart'.$i]); ?>><?php the_title_attribute(); echo '(' . esc_attr($chart_name) . ')'; ?></option>
          <?php endwhile; ?>
         </select>
         <?php endif; ?>
        </li>
       </ul>
       </div>

       <div class="one_column_option">
       <h4 class="theme_option_headline2"><?php if($i == 1){ _e('Default background image', 'tcd-seeed'); } else { _e('Post-slide background image', 'tcd-seeed'); }; ?></h4>
       <input type="hidden" name="dp_options[contents_builder][<?php echo $key; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][bg_image<?php echo $i; ?>_overlay_opacity]" value="zero">
       <?php
            if($repeater_value['bg_image'.$i.'_overlay_opacity'] == 'zero'){
              $overlay_opacity = 0;
            } else {
              $overlay_opacity = $repeater_value['bg_image'.$i.'_overlay_opacity'];
            }
       ?>
       <ul class="option_list">
        <li class="cf">
         <span class="label">
          <?php _e('Background image', 'tcd-seeed'); ?>
          <span class="recommend_desc"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-seeed'), '1450', '500'); ?></span>
         </span>
         <div class="image_box cf">
          <div class="cf cf_media_field hide-if-no-js sp_bg_image_<?php echo $i; ?>_<?php echo $key; ?>_<?php echo esc_attr( $repeater_key ); ?>">
           <input type="hidden" value="<?php if ( isset($repeater_value['bg_image'.$i]) ) echo esc_attr( $repeater_value['bg_image'.$i] ); ?>" id="sp_bg_image_<?php echo $i; ?>_<?php echo $key; ?>_<?php echo esc_attr( $repeater_key ); ?>" name="dp_options[contents_builder][<?php echo $key; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][bg_image<?php echo $i; ?>]" class="cf_media_id">
           <div class="preview_field"><?php if ( isset($repeater_value['bg_image'.$i]) ) echo wp_get_attachment_image( $repeater_value['bg_image'.$i], 'medium'); ?></div>
           <div class="button_area">
            <input type="button" value="<?php _e( 'Select Image', 'tcd-seeed' ); ?>" class="cfmf-select-img button">
            <input type="button" value="<?php _e( 'Remove Image', 'tcd-seeed' ); ?>" class="cfmf-delete-img button <?php if ( isset($repeater_value['bg_image'.$i])  && !$repeater_value['bg_image'.$i] ) echo 'hidden'; ?>">
           </div>
          </div>
         </div>
        </li>
        <li class="cf">
         <span class="label">
          <?php _e('Background image (mobile)', 'tcd-seeed'); ?>
          <span class="recommend_desc"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-seeed'), '1160', '720'); ?></span>
         </span>
         <div class="image_box cf">
          <div class="cf cf_media_field hide-if-no-js sp_bg_image_mobile_<?php echo $i; ?>_<?php echo $key; ?>_<?php echo esc_attr( $repeater_key ); ?>">
           <input type="hidden" value="<?php if ( isset($repeater_value['bg_image_mobile'.$i]) ) echo esc_attr( $repeater_value['bg_image_mobile'.$i] ); ?>" id="sp_bg_image_mobile_<?php echo $i; ?>_<?php echo $key; ?>_<?php echo esc_attr( $repeater_key ); ?>" name="dp_options[contents_builder][<?php echo $key; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][bg_image_mobile<?php echo $i; ?>]" class="cf_media_id">
           <div class="preview_field"><?php if ( isset($repeater_value['bg_image_mobile'.$i]) ) echo wp_get_attachment_image( $repeater_value['bg_image_mobile'.$i], 'medium'); ?></div>
           <div class="button_area">
            <input type="button" value="<?php _e( 'Select Image', 'tcd-seeed' ); ?>" class="cfmf-select-img button">
            <input type="button" value="<?php _e( 'Remove Image', 'tcd-seeed' ); ?>" class="cfmf-delete-img button <?php if ( isset($repeater_value['bg_image_mobile'.$i]) && !$repeater_value['bg_image_mobile'.$i] ) echo 'hidden'; ?>">
           </div>
          </div>
         </div>
        </li>
        <li class="cf">
         <span class="label"><?php _e('Color of overlay', 'tcd-seeed'); ?></span><input type="text" name="dp_options[contents_builder][<?php echo $key; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][bg_image<?php echo $i; ?>_overlay_color]" value="<?php if ( $repeater_value['bg_image'.$i.'_overlay_color'] ) echo esc_attr( $repeater_value['bg_image'.$i.'_overlay_color'] ); ?>" data-default-color="#000000" class="c-color-picker">
        </li>
        <li class="cf">
         <span class="label"><?php _e('Transparency of overlay', 'tcd-seeed'); ?></span><input class="hankaku" style="width:70px;" type="number" min="0" max="1" step="0.1" name="dp_options[contents_builder][<?php echo $key; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][bg_image<?php echo $i; ?>_overlay_opacity]" value="<?php echo esc_attr($overlay_opacity); ?>" />
         <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
          <p><?php _e('Please specify the number of 0 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-seeed');  ?>
          <?php _e('Please enter 0 if you don\'t want to use overlay.', 'tcd-seeed');  ?></p>
         </div>
        </li>
       </ul>
       </div>

       <?php if($i == 2){ ?>
       </div>
       <?php }; ?>

       </div><!-- END .sub_box_tab_content -->

       <?php endfor; ?>

       <ul class="button_list cf">
        <li><a class="close_sub_box button-ml" href="#"><?php echo __( 'Close', 'tcd-seeed' ); ?></a></li>
        <li class="delete-row"><a class="button-delete-row button-ml red_button" href="#"><?php echo __( 'Delete item', 'tcd-seeed' ); ?></a></li>
       </ul>
      </div><!-- END .sub_box_content -->
     </div><!-- END .sub_box -->
     <?php
            endforeach;
          endif;

          $repeater_key = 'addindex';
          $repeater_value = array(
            'layout1' => 'type1',
            'position1' => 'type1',
            'catch1' => '',
            'desc1' => '',
            'button_label1' => '',
            'button_url1' => '',
            'button_target1' => '',
            'bg_image1' => '',
            'bg_image_mobile1' => '',
            'bg_image1_overlay_color' => '#000000',
            'bg_image1_overlay_opacity' => '0.2',
            'sub_content_type1' => 'type1',
            'image1' => '',
            'chart1' => '',
            'font_color1' => '#000000',
            'bg_color1' => '#ffffff',
            'display_right_content' => '',
            'layout2' => 'type2',
            'position2' => 'type1',
            'catch2' => '',
            'desc2' => '',
            'button_label2' => '',
            'button_url2' => '',
            'button_target2' => '',
            'bg_image2' => '',
            'bg_image_mobile2' => '',
            'bg_image2_overlay_color' => '#000000',
            'bg_image2_overlay_opacity' => '0.2',
            'sub_content_type2' => 'type1',
            'image2' => '',
            'chart2' => '',
            'font_color2' => '#000000',
            'bg_color2' => '#ffffff',
          );
          ob_start();
     ?>
     <!-- repeater start -->
     <div class="sub_box repeater-item repeater-item-<?php echo esc_attr( $repeater_key ); ?>">
      <h4 class="theme_option_subbox_headline"><?php _e( 'New content', 'tcd-seeed' ); ?></h4>
      <div class="sub_box_content tab_parent">

       <div class="sub_box_tab">
        <div class="tab active" data-tab="tab1"><?php _e('Default content', 'tcd-seeed'); ?></div>
        <div class="tab" data-tab="tab2"><?php _e('Post-slide content', 'tcd-seeed'); ?></div>
       </div>

       <?php for ( $i = 1; $i <= 2; $i++ ): ?>

       <div class="sub_box_tab_content<?php if($i == 1){ echo ' active'; }; ?>" data-tab-content="tab<?php echo $i; ?>">

       <?php if($i == 2){ ?>
       <input type="hidden" name="dp_options[contents_builder][<?php echo $key; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][display_right_content]" value="0">
       <p class="displayment_checkbox"><label><input name="dp_options[contents_builder][<?php echo $key; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][display_right_content]" type="checkbox" value="1" <?php checked( $repeater_value['display_right_content'], 1 ); ?>><?php _e( 'Display Post-slide content', 'tcd-seeed' ); ?></label></p>
       <div style="display:none;">
       <?php }; ?>

       <h4 class="theme_option_headline2"><?php if($i == 1){ _e('Default layout', 'tcd-seeed'); } else { _e('Post-slide layout', 'tcd-seeed'); }; ?></h4>
       <div class="cb_image middle">
        <img class="one_column_option" src="<?php bloginfo('template_url'); ?>/admin/img/cb_selling_point_layout1.jpg" width="" height="" />
        <img class="two_column_option" style="display:none;" src="<?php bloginfo('template_url'); ?>/admin/img/cb_selling_point_layout2.jpg" width="" height="" />
       </div>
       <div class="theme_option_message2" style="margin-top:20px;">
        <p><?php _e('TypeA: Background image can be set for the main content.<br>TypeB: Background color can be set instead of a background image. Main content and sub content (image or chart) can be set.', 'tcd-seeed'); ?></p>
       </div>
       <ul class="option_list">
        <li class="cf">
         <span class="label"><?php _e('Layout', 'tcd-seeed');  ?></span>
         <div class="standard_radio_button">
          <input class="sp_layout_type1" id="sp_layout_type1_<?php echo $i; ?>_<?php echo $key; ?>_<?php echo esc_attr( $repeater_key ); ?>" type="radio" name="dp_options[contents_builder][<?php echo $key; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][layout<?php echo $i; ?>]" value="type1" <?php checked( $repeater_value['layout'.$i], 'type1' ); ?>>
          <label for="sp_layout_type1_<?php echo $i; ?>_<?php echo $key; ?>_<?php echo esc_attr( $repeater_key ); ?>"><?php _e('Type A', 'tcd-seeed'); ?></label>
          <input class="sp_layout_type2" id="sp_layout_type2_<?php echo $i; ?>_<?php echo $key; ?>_<?php echo esc_attr( $repeater_key ); ?>" type="radio" name="dp_options[contents_builder][<?php echo $key; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][layout<?php echo $i; ?>]" value="type2" <?php checked( $repeater_value['layout'.$i], 'type2' ); ?>>
          <label for="sp_layout_type2_<?php echo $i; ?>_<?php echo $key; ?>_<?php echo esc_attr( $repeater_key ); ?>"><?php _e('Type B', 'tcd-seeed'); ?></label>
         </div>
        </li>
       </ul>

       <h4 class="theme_option_headline2"><?php if($i == 1){ _e('Default main content', 'tcd-seeed'); } else { _e('Post-slide main content', 'tcd-seeed'); };  ?></h4>
       <input type="hidden" name="dp_options[contents_builder][<?php echo $key; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][button_target<?php echo $i; ?>]" value="0">
       <ul class="option_list">
        <li class="cf">
         <span class="label"><?php _e('Position', 'tcd-seeed');  ?></span>
         <div class="standard_radio_button">
          <input id="sp_position_type1_<?php echo $i; ?>_<?php echo $key; ?>_<?php echo esc_attr( $repeater_key ); ?>" type="radio" name="dp_options[contents_builder][<?php echo $key; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][position<?php echo $i; ?>]" value="type1" <?php checked( $repeater_value['position'.$i], 'type1' ); ?>>
          <label for="sp_position_type1_<?php echo $i; ?>_<?php echo $key; ?>_<?php echo esc_attr( $repeater_key ); ?>"><?php _e('Left', 'tcd-seeed'); ?></label>
          <input id="sp_position_type3_<?php echo $i; ?>_<?php echo $key; ?>_<?php echo esc_attr( $repeater_key ); ?>" type="radio" name="dp_options[contents_builder][<?php echo $key; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][position<?php echo $i; ?>]" value="type3" <?php checked( $repeater_value['position'.$i], 'type3' ); ?>>
          <label class="one_column_option" for="sp_position_type3_<?php echo $i; ?>_<?php echo $key; ?>_<?php echo esc_attr( $repeater_key ); ?>"><?php _e('Center', 'tcd-seeed'); ?></label>
          <input id="sp_position_type2_<?php echo $i; ?>_<?php echo $key; ?>_<?php echo esc_attr( $repeater_key ); ?>" type="radio" name="dp_options[contents_builder][<?php echo $key; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][position<?php echo $i; ?>]" value="type2" <?php checked( $repeater_value['position'.$i], 'type2' ); ?>>
          <label for="sp_position_type2_<?php echo $i; ?>_<?php echo $key; ?>_<?php echo esc_attr( $repeater_key ); ?>"><?php _e('Right', 'tcd-seeed'); ?></label>
         </div>
        </li>
        <li class="cf"><span class="label"><?php _e('Catchphrase', 'tcd-seeed'); ?></span><textarea class="<?php if($i ==1){ echo 'repeater-label '; }; ?>full_width" cols="50" rows="2" name="dp_options[contents_builder][<?php echo $key; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][catch<?php echo $i; ?>]"><?php echo esc_textarea($repeater_value['catch'.$i]); ?></textarea></li>
        <li class="cf"><span class="label"><?php _e('Description', 'tcd-seeed'); ?></span><textarea class="full_width" cols="50" rows="3" name="dp_options[contents_builder][<?php echo $key; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][desc<?php echo $i; ?>]"><?php echo esc_textarea($repeater_value['desc'.$i]); ?></textarea></li>
        <li class="cf">
         <span class="label">
          <?php _e('Link button label', 'tcd-seeed'); ?>
          <span class="recommend_desc"><?php _e('Leave this field blank if you don\'t want to display button.', 'tcd-seeed'); ?></span>
         </span>
         <input type="text" class="full_width" name="dp_options[contents_builder][<?php echo $key; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][button_label<?php echo $i; ?>]" value="<?php echo esc_attr($repeater_value['button_label'.$i]); ?>" />
        </li>
        <li class="cf">
         <span class="label"><?php _e('Link button URL', 'tcd-seeed'); ?></span>
         <div class="admin_link_option">
          <input class="full_width" type="text" name="dp_options[contents_builder][<?php echo $key; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][button_url<?php echo $i; ?>]" placeholder="https://example.com/" value="<?php echo esc_attr( $repeater_value['button_url'.$i] ); ?>">
          <input id="sp_button_target<?php echo $i; ?>_<?php echo $key; ?>_<?php echo esc_attr( $repeater_key ); ?>" name="dp_options[contents_builder][<?php echo $key; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][button_target<?php echo $i; ?>]" type="checkbox" value="1" <?php checked( $repeater_value['button_target'.$i], 1 ); ?>>
          <label for="sp_button_target<?php echo $i; ?>_<?php echo $key; ?>_<?php echo esc_attr( $repeater_key ); ?>">&#xe920;</label>
         </div>
        </li>
        <li class="cf two_column_option" style="display:none;"><span class="label"><?php _e('Font color', 'tcd-seeed'); ?></span><input type="text" name="dp_options[contents_builder][<?php echo $key; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][font_color<?php echo $i; ?>]" value="<?php echo esc_attr( $repeater_value['font_color'.$i] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
        <li class="cf two_column_option" style="display:none;">
         <span class="label"><?php _e('Background color', 'tcd-seeed'); ?></span>
         <div class="color_presets">
          <ul class="color_presets_list">
           <?php foreach( TCD_COLOR_PRESET_FOR_LIST as $label => $colors ): ?>
           <li class="js-color-preset-item-for-list color_presets_item" data-color="<?php echo $colors['main']; ?>">
            <div class="color_presets_color">
             <span class="color_presets_color-main" style="background:<?php echo $colors['main']; ?>;">
              <span class="color_presets_color-copied">&#xe876;</span>
             </span>
            </div>
           </li>
           <?php endforeach; ?>
          </ul>
          <input type="text" name="dp_options[contents_builder][<?php echo $key; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][bg_color<?php echo $i; ?>]" value="<?php echo esc_attr( $repeater_value['bg_color'.$i] ); ?>" data-default-color="#ffffff" class="c-color-picker js-color-preset-target--main">
         </div>
        </li>
       </ul>

       <div class="two_column_option" style="display:none;">
       <h4 class="theme_option_headline2"><?php if($i == 1){ _e('Default sub content', 'tcd-seeed'); } else { _e('Post-slide sub content', 'tcd-seeed'); };  ?></h4>
       <ul class="option_list">
        <li class="cf">
         <span class="label"><?php _e('Sub content type', 'tcd-seeed');  ?></span>
         <div class="standard_radio_button">
          <input class="sp_sub_content_type_type1" id="sp_sub_content_type_type1_<?php echo $i; ?>_<?php echo $key; ?>_<?php echo esc_attr( $repeater_key ); ?>" type="radio" name="dp_options[contents_builder][<?php echo $key; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][sub_content_type<?php echo $i; ?>]" value="type1" <?php checked( $repeater_value['sub_content_type'.$i], 'type1' ); ?>>
          <label for="sp_sub_content_type_type1_<?php echo $i; ?>_<?php echo $key; ?>_<?php echo esc_attr( $repeater_key ); ?>"><?php _e('Image', 'tcd-seeed'); ?></label>
          <input class="sp_sub_content_type_type2" id="sp_sub_content_type_type2_<?php echo $i; ?>_<?php echo $key; ?>_<?php echo esc_attr( $repeater_key ); ?>" type="radio" name="dp_options[contents_builder][<?php echo $key; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][sub_content_type<?php echo $i; ?>]" value="type2" <?php checked( $repeater_value['sub_content_type'.$i], 'type2' ); ?>>
          <label for="sp_sub_content_type_type2_<?php echo $i; ?>_<?php echo $key; ?>_<?php echo esc_attr( $repeater_key ); ?>"><?php _e('Chart', 'tcd-seeed'); ?></label>
         </div>
        </li>
        <li class="cf sub_content_type1_option">
         <span class="label">
          <?php _e('Image', 'tcd-seeed'); ?>
          <span class="recommend_desc"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-seeed'), '500', '500'); ?></span>
         </span>
         <div class="image_box cf">
          <div class="cf cf_media_field hide-if-no-js sp_image_<?php echo $i; ?>_<?php echo $key; ?>_<?php echo esc_attr( $repeater_key ); ?>">
           <input type="hidden" value="<?php if ( isset($repeater_value['image'.$i]) ) echo esc_attr( $repeater_value['image'.$i] ); ?>" id="sp_image_<?php echo $i; ?>_<?php echo $key; ?>_<?php echo esc_attr( $repeater_key ); ?>" name="dp_options[contents_builder][<?php echo $key; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][image<?php echo $i; ?>]" class="cf_media_id">
           <div class="preview_field"><?php if ( isset($repeater_value['image'.$i]) ) echo wp_get_attachment_image( $repeater_value['image'.$i], 'medium'); ?></div>
           <div class="button_area">
            <input type="button" value="<?php _e( 'Select Image', 'tcd-seeed' ); ?>" class="cfmf-select-img button">
            <input type="button" value="<?php _e( 'Remove Image', 'tcd-seeed' ); ?>" class="cfmf-delete-img button <?php if ( isset($repeater_value['image'.$i]) && !$repeater_value['image'.$i] ) echo 'hidden'; ?>">
           </div>
          </div>
         </div>
        </li>
        <li class="cf sub_content_type2_option" style="display:none;">
         <span class="label">
          <?php _e('Chart', 'tcd-seeed'); ?>
         </span>
         <?php
              $args = array('post_type' => 'chart', 'posts_per_page' => -1, 'ignore_sticky_posts' => 1);
              $post_list = new wp_query($args);
              if($post_list->have_posts()):
         ?>
         <select name="dp_options[contents_builder][<?php echo $key; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][chart<?php echo $i; ?>]">
          <?php while ($post_list->have_posts()) : $post_list->the_post(); ?>
          <option value="<?php echo esc_attr($post->ID); ?>" <?php selected($post->ID, $repeater_value['chart'.$i]); ?>><?php the_title_attribute(); ?></option>
          <?php endwhile; ?>
         </select>
         <?php endif; ?>
        </li>
       </ul>
       </div>

       <div class="one_column_option">
       <h4 class="theme_option_headline2"><?php if($i == 1){ _e('Default background image', 'tcd-seeed'); } else { _e('Post-slide background image', 'tcd-seeed'); }; ?></h4>
       <input type="hidden" name="dp_options[contents_builder][<?php echo $key; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][bg_image<?php echo $i; ?>_overlay_opacity]" value="zero">
       <?php
            if($repeater_value['bg_image'.$i.'_overlay_opacity'] == 'zero'){
              $overlay_opacity = 0;
            } else {
              $overlay_opacity = $repeater_value['bg_image'.$i.'_overlay_opacity'];
            }
       ?>
       <ul class="option_list">
        <li class="cf">
         <span class="label">
          <?php _e('Background image', 'tcd-seeed'); ?>
          <span class="recommend_desc"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-seeed'), '1450', '500'); ?></span>
         </span>
         <div class="image_box cf">
          <div class="cf cf_media_field hide-if-no-js sp_bg_image_<?php echo $i; ?>_<?php echo $key; ?>_<?php echo esc_attr( $repeater_key ); ?>">
           <input type="hidden" value="<?php if ( isset($repeater_value['bg_image'.$i]) ) echo esc_attr( $repeater_value['bg_image'.$i] ); ?>" id="sp_bg_image_<?php echo $i; ?>_<?php echo $key; ?>_<?php echo esc_attr( $repeater_key ); ?>" name="dp_options[contents_builder][<?php echo $key; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][bg_image<?php echo $i; ?>]" class="cf_media_id">
           <div class="preview_field"><?php if ( isset($repeater_value['bg_image'.$i]) ) echo wp_get_attachment_image( $repeater_value['bg_image'.$i], 'medium'); ?></div>
           <div class="button_area">
            <input type="button" value="<?php _e( 'Select Image', 'tcd-seeed' ); ?>" class="cfmf-select-img button">
            <input type="button" value="<?php _e( 'Remove Image', 'tcd-seeed' ); ?>" class="cfmf-delete-img button <?php if ( isset($repeater_value['bg_image'.$i])  && !$repeater_value['bg_image'.$i] ) echo 'hidden'; ?>">
           </div>
          </div>
         </div>
        </li>
        <li class="cf">
         <span class="label">
          <?php _e('Background image (mobile)', 'tcd-seeed'); ?>
          <span class="recommend_desc"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-seeed'), '1160', '720'); ?></span>
         </span>
         <div class="image_box cf">
          <div class="cf cf_media_field hide-if-no-js sp_bg_image_mobile_<?php echo $i; ?>_<?php echo $key; ?>_<?php echo esc_attr( $repeater_key ); ?>">
           <input type="hidden" value="<?php if ( isset($repeater_value['bg_image_mobile'.$i]) ) echo esc_attr( $repeater_value['bg_image_mobile'.$i] ); ?>" id="sp_bg_image_mobile_<?php echo $i; ?>_<?php echo $key; ?>_<?php echo esc_attr( $repeater_key ); ?>" name="dp_options[contents_builder][<?php echo $key; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][bg_image_mobile<?php echo $i; ?>]" class="cf_media_id">
           <div class="preview_field"><?php if ( isset($repeater_value['bg_image_mobile'.$i]) ) echo wp_get_attachment_image( $repeater_value['bg_image_mobile'.$i], 'medium'); ?></div>
           <div class="button_area">
            <input type="button" value="<?php _e( 'Select Image', 'tcd-seeed' ); ?>" class="cfmf-select-img button">
            <input type="button" value="<?php _e( 'Remove Image', 'tcd-seeed' ); ?>" class="cfmf-delete-img button <?php if ( isset($repeater_value['bg_image_mobile'.$i]) && !$repeater_value['bg_image_mobile'.$i] ) echo 'hidden'; ?>">
           </div>
          </div>
         </div>
        </li>
        <li class="cf">
         <span class="label"><?php _e('Color of overlay', 'tcd-seeed'); ?></span><input type="text" name="dp_options[contents_builder][<?php echo $key; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][bg_image<?php echo $i; ?>_overlay_color]" value="<?php if ( $repeater_value['bg_image'.$i.'_overlay_color'] ) echo esc_attr( $repeater_value['bg_image'.$i.'_overlay_color'] ); ?>" data-default-color="#000000" class="c-color-picker">
        </li>
        <li class="cf">
         <span class="label"><?php _e('Transparency of overlay', 'tcd-seeed'); ?></span><input class="hankaku" style="width:70px;" type="number" min="0" max="1" step="0.1" name="dp_options[contents_builder][<?php echo $key; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][bg_image<?php echo $i; ?>_overlay_opacity]" value="<?php echo esc_attr($overlay_opacity); ?>" />
         <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
          <p><?php _e('Please specify the number of 0 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-seeed');  ?>
          <?php _e('Please enter 0 if you don\'t want to use overlay.', 'tcd-seeed');  ?></p>
         </div>
        </li>
       </ul>
       </div>

       <?php if($i == 2){ ?>
       </div>
       <?php }; ?>

       </div><!-- END .sub_box_tab_content -->

       <?php endfor; ?>

       <ul class="button_list cf">
        <li><a class="close_sub_box button-ml" href="#"><?php echo __( 'Close', 'tcd-seeed' ); ?></a></li>
        <li class="delete-row"><a class="button-delete-row button-ml red_button" href="#"><?php echo __( 'Delete item', 'tcd-seeed' ); ?></a></li>
       </ul>
      </div><!-- END .sub_box_content -->
     </div><!-- END .sub_box -->
     <!-- repeater end -->
     <?php
          $repeater_content_clone = ob_get_clean();
     ?>
    </div><!-- END .repeater -->
    <a href="#" class="button button-secondary button-add-row" data-clone="<?php echo esc_attr( $repeater_content_clone ); ?>"><?php _e( 'Add item', 'tcd-seeed' ); ?></a>
   </div><!-- END .repeater-wrapper -->
   <?php // リピーターここまで -------------------------- ?>

<?php
}

// 事例一覧
function admin_contents_builder_case_study_list( $key, $values ){

  $options = get_design_plus_option();
  $case_study_label = $options['case_study_label'] ? esc_html( $options['case_study_label'] ) : __( 'Case study', 'tcd-seeed' );

  $values = !empty( $values ) ? $values : array(
    'catch' => '',
    'desc' => '',
    'desc_mobile' => '',
    'button_label' => '',
    'post_num' => '6',
    'post_num_sp' => '6',
  );

?>
   <input type="hidden" name="dp_options[contents_builder][<?php echo esc_attr( $key ); ?>][type]" value="case_study_list">

   <div class="cb_image">
    <img src="<?php bloginfo('template_url'); ?>/admin/img/cb_case_study_list2.jpg" width="" height="" />
   </div>

   <div class="theme_option_message2">
    <p><?php printf(__('Displays content created with the custom post type "<a href="./edit.php?post_type=case_study" target="_blank">%s</a>" in a carousel format.', 'tcd-seeed'), $case_study_label); ?></p>
   </div>

   <h4 class="theme_option_headline2"><?php _e('Basic settings', 'tcd-seeed');  ?></h4>
   <ul class="option_list">
    <li class="cf"><span class="label"><span class="num">1</span><?php _e('Catchphrase', 'tcd-seeed'); ?></span><textarea class="js-contents-builder-item-label full_width" cols="50" rows="3" name="dp_options[contents_builder][<?php echo $key; ?>][catch]"><?php echo esc_textarea($values['catch']); ?></textarea></li>
    <li class="cf"><span class="label"><span class="num">2</span><?php _e('Description', 'tcd-seeed'); ?></span><textarea class="full_width" cols="50" rows="3" name="dp_options[contents_builder][<?php echo $key; ?>][desc]"><?php echo esc_textarea(  $values['desc'] ); ?></textarea></li>
    <li class="cf" style="border:none;"><span class="label"><span class="num_space"></span><?php _e('Description (mobile)', 'tcd-seeed'); ?></span><textarea placeholder="<?php _e( 'Please indicate if you would like to display a short text for mobile sizes.', 'tcd-seeed' ); ?>" class="full_width" cols="50" rows="3" name="dp_options[contents_builder][<?php echo $key; ?>][desc_mobile]"><?php echo esc_textarea(  $values['desc_mobile'] ); ?></textarea></li>
    <li class="cf">
     <span class="label">
      <span class="num">3</span><?php _e('Link button label', 'tcd-seeed'); ?>
      <span class="recommend_desc space"><?php _e('Leave this field blank if you don\'t want to display button.', 'tcd-seeed'); ?></span>
     </span>
     <input type="text" class="full_width" name="dp_options[contents_builder][<?php echo $key; ?>][button_label]" value="<?php echo esc_attr($values['button_label']); ?>" />
    </li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Post list', 'tcd-seeed');  ?></h4>
   <ul class="option_list">
    <li class="cf">
     <span class="label"><?php _e('Number of post to display', 'tcd-seeed'); ?></span>
     <div class="display_post_num_option">
      <label for="cb_case_study_list_post_num_<?php echo $key; ?>"><input type="number" id="cb_case_study_list_post_num_<?php echo $key; ?>" name="dp_options[contents_builder][<?php echo $key; ?>][post_num]" value="<?php echo esc_attr($values['post_num']); ?>"><span class="icon icon_pc"></span></label>
      <label for="cb_case_study_list_post_num_sp_<?php echo $key; ?>"><input type="number" id="cb_case_study_list_post_num_sp_<?php echo $key; ?>" name="dp_options[contents_builder][<?php echo $key; ?>][post_num_sp]" value="<?php echo esc_attr($values['post_num_sp']); ?>"><span class="icon icon_sp"></span></label>
     </div>
    </li>
   </ul>

<?php
}

// サービス一覧
function admin_contents_builder_service_list( $key, $values ){

  $options = get_design_plus_option();
  $service_label = $options['service_label'] ? esc_html( $options['service_label'] ) : __( 'Service', 'tcd-seeed' );

  $values = !empty( $values ) ? $values : array(
    'catch' => '',
    'desc' => '',
    'desc_mobile' => '',
    'button_label' => '',
    'post_num' => '3',
    'post_num_sp' => '3',
  );

?>
   <input type="hidden" name="dp_options[contents_builder][<?php echo esc_attr( $key ); ?>][type]" value="service_list">

   <div class="cb_image">
    <img class="cb_service_list_type1_option" style="<?php if($options['archive_service_list_type'] != 'type4') { echo 'display:block;'; } else { echo 'display:none;'; }; ?>" src="<?php bloginfo('template_url'); ?>/admin/img/cb_service_list2.jpg?2.1" width="" height="" />
    <img class="cb_service_list_type2_option" style="<?php if($options['archive_service_list_type'] == 'type4') { echo 'display:block;'; } else { echo 'display:none;'; }; ?>" src="<?php bloginfo('template_url'); ?>/admin/img/cb_service_post_list2.jpg?2.1" width="" height="" />
   </div>

   <div class="theme_option_message2">
    <p><?php printf(__('List content created with the custom post type "<a href="./edit.php?post_type=service" target="_blank">%s</a>" with icons.', 'tcd-seeed'), $service_label); ?></p>
    <p class="cb_service_list_type1_option" style="<?php if($options['archive_service_list_type'] != 'type4') { echo 'display:block;'; } else { echo 'display:none;'; }; ?>"><?php printf(__('If you want to display a normal article list instead of icons, change to TypeD in "%s > Common setting > Post list layout".', 'tcd-seeed'), $service_label); ?></p>
   </div>


   <h4 class="theme_option_headline2"><?php _e('Basic settings', 'tcd-seeed');  ?></h4>
   <ul class="option_list">
    <li class="cf"><span class="label"><span class="num">1</span><?php _e('Catchphrase', 'tcd-seeed'); ?></span><textarea class="js-contents-builder-item-label full_width" cols="50" rows="3" name="dp_options[contents_builder][<?php echo $key; ?>][catch]"><?php echo esc_textarea($values['catch']); ?></textarea></li>
    <li class="cf"><span class="label"><span class="num">2</span><?php _e('Description', 'tcd-seeed'); ?></span><textarea class="full_width" cols="50" rows="3" name="dp_options[contents_builder][<?php echo $key; ?>][desc]"><?php echo esc_textarea(  $values['desc'] ); ?></textarea></li>
    <li class="cf" style="border:none;"><span class="label"><span class="num_space"></span><?php _e('Description (mobile)', 'tcd-seeed'); ?></span><textarea placeholder="<?php _e( 'Please indicate if you would like to display a short text for mobile sizes.', 'tcd-seeed' ); ?>" class="full_width" cols="50" rows="3" name="dp_options[contents_builder][<?php echo $key; ?>][desc_mobile]"><?php echo esc_textarea(  $values['desc_mobile'] ); ?></textarea></li>
    <li class="cf">
     <span class="label"><span class="num">3</span><?php _e('Number of post to display', 'tcd-seeed'); ?></span>
     <div class="display_post_num_option">
      <label for="cb_service_list_post_num_<?php echo $key; ?>"><input type="number" id="cb_service_list_post_num_<?php echo $key; ?>" name="dp_options[contents_builder][<?php echo $key; ?>][post_num]" value="<?php echo esc_attr($values['post_num']); ?>"><span class="icon icon_pc"></span></label>
      <label for="cbservice_list_post_num_sp_<?php echo $key; ?>"><input type="number" id="cb_service_list_post_num_sp_<?php echo $key; ?>" name="dp_options[contents_builder][<?php echo $key; ?>][post_num_sp]" value="<?php echo esc_attr($values['post_num_sp']); ?>"><span class="icon icon_sp"></span></label>
     </div>
    </li>
    <li class="cf">
     <span class="label">
      <span class="num">4</span><?php _e('Link button label', 'tcd-seeed'); ?>
      <span class="recommend_desc space"><?php _e('Leave this field blank if you don\'t want to display button.', 'tcd-seeed'); ?></span>
     </span>
     <input type="text" class="full_width" name="dp_options[contents_builder][<?php echo $key; ?>][button_label]" value="<?php echo esc_attr($values['button_label']); ?>" />
    </li>
   </ul>

<?php
}

// ブログ一覧
function admin_contents_builder_blog_list( $key, $values ){

  $values = !empty( $values ) ? $values : array(
    'catch' => '',
    'desc' => '',
    'desc_mobile' => '',
    'button_label' => '',
    'post_num' => '6',
    'post_num_sp' => '6',
    'post_type' => 'recent_post',
    'post_order' => 'date',
  );

?>
   <input type="hidden" name="dp_options[contents_builder][<?php echo esc_attr( $key ); ?>][type]" value="blog_list">

   <div class="cb_image">
    <img src="<?php bloginfo('template_url'); ?>/admin/img/cb_blog_list2.jpg" width="" height="" />
   </div>

   <div class="theme_option_message2">
    <p><?php _e('Display <a href="./edit.php?post_type=post" target="_blank">post article</a> by list.', 'tcd-seeed'); ?></p>
   </div>


   <h4 class="theme_option_headline2"><?php _e('Basic settings', 'tcd-seeed');  ?></h4>
   <ul class="option_list">
    <li class="cf"><span class="label"><span class="num">1</span><?php _e('Catchphrase', 'tcd-seeed'); ?></span><textarea class="js-contents-builder-item-label full_width" cols="50" rows="3" name="dp_options[contents_builder][<?php echo $key; ?>][catch]"><?php echo esc_textarea($values['catch']); ?></textarea></li>
    <li class="cf"><span class="label"><span class="num">2</span><?php _e('Description', 'tcd-seeed'); ?></span><textarea class="full_width" cols="50" rows="3" name="dp_options[contents_builder][<?php echo $key; ?>][desc]"><?php echo esc_textarea(  $values['desc'] ); ?></textarea></li>
    <li class="cf" style="border:none;"><span class="label"><span class="num_space"></span><?php _e('Description (mobile)', 'tcd-seeed'); ?></span><textarea placeholder="<?php _e( 'Please indicate if you would like to display a short text for mobile sizes.', 'tcd-seeed' ); ?>" class="full_width" cols="50" rows="3" name="dp_options[contents_builder][<?php echo $key; ?>][desc_mobile]"><?php echo esc_textarea(  $values['desc_mobile'] ); ?></textarea></li>
    <li class="cf">
     <span class="label">
      <span class="num">3</span><?php _e('Link button label', 'tcd-seeed'); ?>
      <span class="recommend_desc space"><?php _e('Leave this field blank if you don\'t want to display button.', 'tcd-seeed'); ?></span>
     </span>
     <input type="text" class="full_width" name="dp_options[contents_builder][<?php echo $key; ?>][button_label]" value="<?php echo esc_attr($values['button_label']); ?>" />
    </li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Post list', 'tcd-seeed');  ?></h4>
   <ul class="option_list">
    <li class="cf">
     <span class="label"><?php _e('Post type', 'tcd-seeed');  ?></span>
     <div class="standard_radio_button">
      <input id="carousel_post_type_recent_post_<?php echo $key; ?>" type="radio" name="dp_options[contents_builder][<?php echo $key; ?>][post_type]" value="recent_post" <?php checked( $values['post_type'], 'recent_post' ); ?>>
      <label for="carousel_post_type_recent_post_<?php echo $key; ?>"><?php _e('Recent post', 'tcd-seeed'); ?></label>
      <input id="carousel_post_type_recommend_post_<?php echo $key; ?>" type="radio" name="dp_options[contents_builder][<?php echo $key; ?>][post_type]" value="recommend_post" <?php checked( $values['post_type'], 'recommend_post' ); ?>>
      <label for="carousel_post_type_recommend_post_<?php echo $key; ?>"><?php _e('Recommend post', 'tcd-seeed'); ?>1</label>
      <input id="carousel_post_type_recommend2_post_<?php echo $key; ?>" type="radio" name="dp_options[contents_builder][<?php echo $key; ?>][post_type]" value="recommend_post2" <?php checked( $values['post_type'], 'recommend_post2' ); ?>>
      <label for="carousel_post_type_recommend2_post_<?php echo $key; ?>"><?php _e('Recommend post', 'tcd-seeed'); ?>2</label>
      <input id="carousel_post_type_recommend3_post_<?php echo $key; ?>" type="radio" name="dp_options[contents_builder][<?php echo $key; ?>][post_type]" value="recommend_post3" <?php checked( $values['post_type'], 'recommend_post3' ); ?>>
      <label for="carousel_post_type_recommend3_post_<?php echo $key; ?>"><?php _e('Recommend post', 'tcd-seeed'); ?>3</label>
     </div>
    </li>
    <li class="cf">
     <span class="label"><?php _e('Post order', 'tcd-seeed');  ?></span>
     <div class="standard_radio_button">
      <input id="carousel_post_order_date_<?php echo $key; ?>" type="radio" name="dp_options[contents_builder][<?php echo $key; ?>][post_order]" value="date" <?php checked( $values['post_order'], 'date' ); ?>>
      <label for="carousel_post_order_date_<?php echo $key; ?>"><?php _e('Date', 'tcd-seeed'); ?></label>
      <input id="carousel_post_order_rand_<?php echo $key; ?>" type="radio" name="dp_options[contents_builder][<?php echo $key; ?>][post_order]" value="rand" <?php checked( $values['post_order'], 'rand' ); ?>>
      <label for="carousel_post_order_rand_<?php echo $key; ?>"><?php _e('Random', 'tcd-seeed'); ?></label>
     </div>
    </li>
    <li class="cf">
     <span class="label"><?php _e('Number of post to display', 'tcd-seeed'); ?></span>
     <div class="display_post_num_option">
      <label for="cb_post_list_post_num_<?php echo $key; ?>"><input type="number" id="cb_post_list_post_num_<?php echo $key; ?>" name="dp_options[contents_builder][<?php echo $key; ?>][post_num]" value="<?php echo esc_attr($values['post_num']); ?>"><span class="icon icon_pc"></span></label>
      <label for="cb_post_list_post_num_sp_<?php echo $key; ?>"><input type="number" id="cb_post_list_post_num_sp_<?php echo $key; ?>" name="dp_options[contents_builder][<?php echo $key; ?>][post_num_sp]" value="<?php echo esc_attr($values['post_num_sp']); ?>"><span class="icon icon_sp"></span></label>
     </div>
    </li>
   </ul>

<?php
}

// お知らせ一覧
function admin_contents_builder_news_list( $key, $values ){

  $options = get_design_plus_option();
  $news_label = $options['news_label'] ? esc_html( $options['news_label'] ) : __( 'News', 'tcd-seeed' );

  $values = !empty( $values ) ? $values : array(
    'catch' => '',
    'desc' => '',
    'desc_mobile' => '',
    'button_label' => '',
    'post_num' => '6',
    'post_num_sp' => '6',
  );

?>
   <input type="hidden" name="dp_options[contents_builder][<?php echo esc_attr( $key ); ?>][type]" value="news_list">

   <div class="cb_image">
    <img src="<?php bloginfo('template_url'); ?>/admin/img/cb_news_list2.jpg" width="" height="" />
   </div>

   <div class="theme_option_message2">
    <p><?php printf(__('Displays post list created with the custom post type "<a href="./edit.php?post_type=news" target="_blank">%s</a>".', 'tcd-seeed'), $news_label); ?></p>
   </div>

   <h4 class="theme_option_headline2"><?php _e('Basic settings', 'tcd-seeed');  ?></h4>
   <ul class="option_list">
    <li class="cf"><span class="label"><span class="num">1</span><?php _e('Catchphrase', 'tcd-seeed'); ?></span><textarea class="js-contents-builder-item-label full_width" cols="50" rows="3" name="dp_options[contents_builder][<?php echo $key; ?>][catch]"><?php echo esc_textarea($values['catch']); ?></textarea></li>
    <li class="cf"><span class="label"><span class="num">2</span><?php _e('Description', 'tcd-seeed'); ?></span><textarea class="full_width" cols="50" rows="3" name="dp_options[contents_builder][<?php echo $key; ?>][desc]"><?php echo esc_textarea(  $values['desc'] ); ?></textarea></li>
    <li class="cf" style="border:none;"><span class="label"><span class="num_space"></span><?php _e('Description (mobile)', 'tcd-seeed'); ?></span><textarea placeholder="<?php _e( 'Please indicate if you would like to display a short text for mobile sizes.', 'tcd-seeed' ); ?>" class="full_width" cols="50" rows="3" name="dp_options[contents_builder][<?php echo $key; ?>][desc_mobile]"><?php echo esc_textarea(  $values['desc_mobile'] ); ?></textarea></li>
    <li class="cf">
     <span class="label">
      <span class="num">3</span><?php _e('Link button label', 'tcd-seeed'); ?>
      <span class="recommend_desc space"><?php _e('Leave this field blank if you don\'t want to display button.', 'tcd-seeed'); ?></span>
     </span>
     <input type="text" class="full_width" name="dp_options[contents_builder][<?php echo $key; ?>][button_label]" value="<?php echo esc_attr($values['button_label']); ?>" />
    </li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Post list', 'tcd-seeed');  ?></h4>
   <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
    <p><?php printf(__('Thumbnail display settings reflect the settings in "%s" > "Common Settings".', 'tcd-seeed'), $news_label); ?></p>
   </div>
   <ul class="option_list">
    <li class="cf">
     <span class="label"><?php _e('Number of post to display', 'tcd-seeed'); ?></span>
     <div class="display_post_num_option">
      <label for="cb_news_list_post_num_<?php echo $key; ?>"><input type="number" id="cb_news_list_post_num_<?php echo $key; ?>" name="dp_options[contents_builder][<?php echo $key; ?>][post_num]" value="<?php echo esc_attr($values['post_num']); ?>"><span class="icon icon_pc"></span></label>
      <label for="cb_news_list_post_num_sp_<?php echo $key; ?>"><input type="number" id="cb_news_list_post_num_sp_<?php echo $key; ?>" name="dp_options[contents_builder][<?php echo $key; ?>][post_num_sp]" value="<?php echo esc_attr($values['post_num_sp']); ?>"><span class="icon icon_sp"></span></label>
     </div>
    </li>
   </ul>

<?php
}

// フリースペース
function admin_contents_builder_free_space( $key, $values ){

  $values = !empty( $values ) ? $values : array(
    'catch' => '',
    'desc' => '',
    'desc_mobile' => '',
    'free_space' => '',
    'content_width' => 'type1',
    'bg_color' => '#ffffff',
  );

?>
   <input type="hidden" name="dp_options[contents_builder][<?php echo esc_attr( $key ); ?>][type]" value="free_space">

   <div class="cb_image">
    <img src="<?php bloginfo('template_url'); ?>/admin/img/cb_free_space2.jpg" width="" height="" />
   </div>

   <div class="theme_option_message2">
    <p><?php _e('You can create free content using the WordPress Classic Editor.<br>The above example shows the Quick Tag "Plan List". You can register plan list from "Quick Tags > Plans List".', 'tcd-seeed'); ?></p>
   </div>

   <h4 class="theme_option_headline2"><?php _e('Basic setting', 'tcd-seeed'); ?></h4>
   <ul class="option_list">
    <li class="cf"><span class="label"><span class="num">1</span><?php _e('Catchphrase', 'tcd-seeed'); ?></span><textarea class="js-contents-builder-item-label full_width" cols="50" rows="3" name="dp_options[contents_builder][<?php echo $key; ?>][catch]"><?php echo esc_textarea($values['catch']); ?></textarea></li>
    <li class="cf"><span class="label"><span class="num">2</span><?php _e('Description', 'tcd-seeed'); ?></span><textarea class="full_width" cols="50" rows="3" name="dp_options[contents_builder][<?php echo $key; ?>][desc]"><?php echo esc_textarea(  $values['desc'] ); ?></textarea></li>
    <li class="cf" style="border:none;"><span class="label"><span class="num_space"></span><?php _e('Description (mobile)', 'tcd-seeed'); ?></span><textarea placeholder="<?php _e( 'Please indicate if you would like to display a short text for mobile sizes.', 'tcd-seeed' ); ?>" class="full_width" cols="50" rows="3" name="dp_options[contents_builder][<?php echo $key; ?>][desc_mobile]"><?php echo esc_textarea(  $values['desc_mobile'] ); ?></textarea></li>
    <li class="cf">
     <span class="label"><span class="num">3</span><?php _e('Content width', 'tcd-seeed'); ?></span>
     <div class="standard_radio_button">
      <input id="cb_content_width_type1_<?php echo $key; ?>" type="radio" name="dp_options[contents_builder][<?php echo $key; ?>][content_width]" value="type1" <?php checked( $values['content_width'], 'type1' ); ?>>
      <label for="cb_content_width_type1_<?php echo $key; ?>">1030px</label>
      <input id="cb_content_width_type2_<?php echo $key; ?>" type="radio" name="dp_options[contents_builder][<?php echo $key; ?>][content_width]" value="type2" <?php checked( $values['content_width'], 'type2' ); ?>>
      <label for="cb_content_width_type2_<?php echo $key; ?>"><?php _e('Full size', 'tcd-seeed'); ?></label>
     </div>
    </li>
    <li class="cf">
     <span class="label"><?php _e('Background color', 'tcd-seeed'); ?></span>
     <div class="color_presets">
      <ul class="color_presets_list">
       <?php foreach( TCD_COLOR_PRESET_FOR_LIST as $label => $colors ): ?>
       <li class="js-color-preset-item-for-list color_presets_item" data-color="<?php echo $colors['main']; ?>">
        <div class="color_presets_color">
         <span class="color_presets_color-main" style="background:<?php echo $colors['main']; ?>;">
          <span class="color_presets_color-copied">&#xe876;</span>
         </span>
        </div>
       </li>
       <?php endforeach; ?>
      </ul>
      <input type="text" name="dp_options[contents_builder][<?php echo $key; ?>][bg_color]" value="<?php echo esc_attr( $values['bg_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker js-color-preset-target--main">
     </div>
    </li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Content', 'tcd-seeed');  ?></h4>
   <?php
        wp_editor(
          $values['free_space'],
          'cb_wysiwyg_editor-' . $key,
          array (
            'textarea_name' => 'dp_options[contents_builder][' . $key . '][free_space]',
            //'editor_class' => 'js-contents-builder-item-label'
          )
       );
   ?>

<?php
}

?>