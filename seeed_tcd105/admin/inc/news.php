<?php
/*
 * お知らせの設定
 */


// Add default values
add_filter( 'before_getting_design_plus_option', 'add_news_dp_default_options' );


// Add label of logo tab
add_action( 'tcd_tab_labels', 'add_news_tab_label' );


// Add HTML of logo tab
add_action( 'tcd_tab_panel', 'add_news_tab_panel' );


// Register sanitize function
add_filter( 'theme_options_validate', 'add_news_theme_options_validate' );


// タブの名前
function add_news_tab_label( $tab_labels ) {
  $options = get_design_plus_option();
  if($options['use_news']){
    $tab_label = $options['news_label'] ? esc_html( $options['news_label'] ) : __( 'News', 'tcd-seeed' );
  } else {
    $title = $options['news_label'] ? esc_html( $options['news_label'] ) : __( 'News', 'tcd-seeed' );
    $tab_label = __('(N/A) ', 'tcd-seeed') . $title;
  }
  $tab_labels['news'] = $tab_label;
  return $tab_labels;
}


// 初期値
function add_news_dp_default_options( $dp_default_options ) {

	// 基本設定
	$dp_default_options['use_news'] = '1';
	$dp_default_options['news_label'] = __( 'News', 'tcd-seeed' );
	$dp_default_options['news_slug'] = 'news';
	$dp_default_options['news_show_image'] = 'display';

	// アーカイブページ
	$dp_default_options['archive_news_headline'] = __( 'News', 'tcd-seeed' );
	$dp_default_options['archive_news_desc'] = __( 'Description will be displayed here.', 'tcd-seeed' );
	$dp_default_options['archive_news_desc_mobile'] = '';
	$dp_default_options['archive_news_header_image'] = false;
	$dp_default_options['archive_news_overlay_color'] = '#000000';
	$dp_default_options['archive_news_overlay_opacity'] = '0.3';

	$dp_default_options['archive_news_num'] = '10';
	$dp_default_options['archive_news_num_sp'] = '6';

	// 詳細ページ
	$dp_default_options['single_news_show_sns'] = 'top';
	$dp_default_options['single_news_show_copy'] = 'top';

	// 最新のお知らせ一覧
	$dp_default_options['recent_news_headline'] = __( 'Latest news', 'tcd-seeed' );
	$dp_default_options['recent_news_num'] = '3';
	$dp_default_options['recent_news_num_sp'] = '3';

	// 記事ページの追加コンテンツ
	$dp_default_options['single_news_top_ad_code'] = '';
	$dp_default_options['single_news_top_ad_code_mobile'] = '';
	$dp_default_options['single_news_bottom_ad_code'] = '';
	$dp_default_options['single_news_bottom_ad_code_mobile'] = '';

	return $dp_default_options;

}


// 入力欄の出力　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_news_tab_panel( $options ) {

  global $dp_default_options, $font_type_options, $basic_display_options, $single_page_display_options, $custom_post_usage_options;
  $news_label = $options['news_label'] ? esc_html( $options['news_label'] ) : __( 'News', 'tcd-seeed' );

?>

<div id="tab-content-news" class="tab-content">


   <?php // 有効化 -------------------------------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac active open custon_post_usage_option">
    <h3 class="theme_option_headline"><?php _e('Validation', 'tcd-seeed');  ?></h3>
    <div class="theme_option_field_ac_content">

     <div class="theme_option_message2 custon_post_usage_option_message" style="<?php if($options['use_news']){ echo 'display:none;'; } else { echo 'display:block;'; }; ?>">
      <p><?php printf(__('Currently, all function related to custom post "%s" have been disabled.<br>All areas that have already been set up will be hidden from the site.<br>Please use this option only if you don\'t want to use the custom post "%s" at all. (No archive page will be generated either).', 'tcd-seeed'), $news_label, $news_label); ?></p>
     </div>
     <div class="theme_option_message2" style="<?php if($options['use_news']){ echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <p><?php printf(__('Please check off the checkbox if you don\'t want to use custom post "%s".', 'tcd-seeed'), $news_label); ?></p>
     </div>
     <p><label><input class="custon_post_usage_option_checkbox" name="dp_options[use_news]" type="checkbox" value="1" <?php checked( 1, $options['use_news'] ); ?>><?php printf(__('Use custom post "%s"', 'tcd-seeed'), $news_label); ?></label></p>

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

     <h4 class="theme_option_headline_number"><span class="num">1</span><?php _e('Name of content', 'tcd-seeed'); ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('This name will also be used in breadcrumb link.', 'tcd-seeed'); ?></p>
     </div>
     <input type="text" name="dp_options[news_label]" value="<?php echo esc_attr( $options['news_label'] ); ?>" />

     <h4 class="theme_option_headline_number"><span class="num">2</span><?php _e('Slug', 'tcd-seeed'); ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('Please enter word by alphabet only.<br />After changing slug, please update permalink setting form <a href="./options-permalink.php"><strong>permalink option page</strong></a>.', 'tcd-seeed'); ?></p>
     </div>
     <p><input class="hankaku" type="text" name="dp_options[news_slug]" value="<?php echo sanitize_title( $options['news_slug'] ); ?>" /></p>

     <h4 class="theme_option_headline2"><?php _e('Featured image', 'tcd-seeed'); ?></h4>
     <div class="clearfix"><?php echo tcd_basic_radio_button($options, 'news_show_image', $basic_display_options); ?></div>

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
      <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/news_archive_image.jpg" alt="" title="" />
     </div>

     <div class="theme_option_message2" style="margin-top:20px;">
      <p><?php printf(__('Header image also will be displayed in %s page.', 'tcd-seeed'), $news_label); ?></p>
     </div>

     <ul class="option_list">
      <li class="cf"><span class="label"><span class="num">1</span><?php _e('Headline', 'tcd-seeed'); ?></span><input type="text" class="full_width" name="dp_options[archive_news_headline]" value="<?php echo esc_attr($options['archive_news_headline']); ?>" ></li>
      <li class="cf"><span class="label"><span class="num">2</span><?php _e('Description', 'tcd-seeed'); ?></span><textarea class="full_width" cols="50" rows="3" name="dp_options[archive_news_desc]"><?php echo esc_textarea(  $options['archive_news_desc'] ); ?></textarea></li>
      <li class="cf" style="border:none;"><span class="label"><span class="num_space"></span><?php _e('Description (mobile)', 'tcd-seeed'); ?></span><textarea placeholder="<?php _e( 'Please indicate if you would like to display a short text for mobile sizes.', 'tcd-seeed' ); ?>" class="full_width" cols="50" rows="3" name="dp_options[archive_news_desc_mobile]"><?php echo esc_textarea(  $options['archive_news_desc_mobile'] ); ?></textarea></li>
      <li class="cf">
       <span class="label">
        <span class="num">3</span><?php _e('Image', 'tcd-seeed'); ?>
        <span class="recommend_desc space"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-seeed'), '1450', '400'); ?></span>
        <span class="recommend_desc space"><?php _e('This image will also be used in article page.', 'tcd-seeed'); ?></span>
       </span>
       <div class="image_box cf">
        <div class="cf cf_media_field hide-if-no-js archive_news_header_image">
         <input type="hidden" value="<?php echo esc_attr( $options['archive_news_header_image'] ); ?>" id="archive_news_header_image" name="dp_options[archive_news_header_image]" class="cf_media_id">
         <div class="preview_field"><?php if($options['archive_news_header_image']){ echo wp_get_attachment_image($options['archive_news_header_image'], 'medium'); }; ?></div>
         <div class="buttton_area">
          <input type="button" value="<?php _e('Select Image', 'tcd-seeed'); ?>" class="cfmf-select-img button">
          <input type="button" value="<?php _e('Remove Image', 'tcd-seeed'); ?>" class="cfmf-delete-img button <?php if(!$options['archive_news_header_image']){ echo 'hidden'; }; ?>">
         </div>
        </div>
       </div>
      </li>
      <li class="cf" style="border:none;">
       <span class="label"><span class="num_space"></span><?php _e('Color of overlay', 'tcd-seeed'); ?></span><input type="text" name="dp_options[archive_news_overlay_color]" value="<?php echo esc_attr( $options['archive_news_overlay_color'] ); ?>" data-default-color="#000000" class="c-color-picker">
       <div class="theme_option_message2 space" style="clear:both; margin:40px 0 0 0;">
        <p><?php _e('This overlay will also be used in article page.', 'tcd-seeed'); ?></p>
       </div>
      </li>
      <li class="cf" style="border:none;">
       <span class="label"><span class="num_space"></span><?php _e('Transparency of overlay', 'tcd-seeed'); ?></span><input class="hankaku" style="width:70px;" type="number" min="0" max="1" step="0.1" name="dp_options[archive_news_overlay_opacity]" value="<?php echo esc_attr( $options['archive_news_overlay_opacity'] ); ?>" />
       <div class="theme_option_message2 space" style="clear:both; margin:7px 0 0 0;">
        <p><?php _e('Please specify the number of 0 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-seeed');  ?>
        <?php _e('Please enter 0 if you don\'t want to use overlay.', 'tcd-seeed');  ?></p>
       </div>
      </li>
     </ul>

     <h4 class="theme_option_headline2"><?php printf(__('%s list', 'tcd-seeed'), $news_label); ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php echo tcd_admin_label('article_list_num'); ?></span><?php echo tcd_display_post_num_option_type2($options, 'archive_news_num'); ?></li>
     </ul>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-seeed' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-seeed' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // 詳細ページの設定 ----------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php printf(__('%s page', 'tcd-seeed'), $news_label); ?></h3>
    <div class="theme_option_field_ac_content">

     <div class="front_page_image">
      <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/news_main_image.jpg" alt="" title="" />
     </div>

     <h4 class="theme_option_headline2"><?php _e('Display setting', 'tcd-seeed');  ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('You can set share button design from basic setting menu in theme option page.', 'tcd-seeed');  ?><br>
      <?php _e('The content displayed in the sidebar can be set from Appearance > <a href="./widgets.php" target="_blank">Widgets</a>.', 'tcd-seeed');  ?></p>
     </div>
     <ul class="option_list">
      <li class="cf"><span class="label"><span class="num">1</span><?php _e('Share button', 'tcd-seeed');  ?></span><?php echo tcd_basic_radio_button($options, 'single_news_show_sns', $single_page_display_options); ?></li>
      <li class="cf"><span class="label"><span class="num">2</span><?php _e('"COPY Title&amp;URL" button', 'tcd-seeed');  ?></span><?php echo tcd_basic_radio_button($options, 'single_news_show_copy', $single_page_display_options); ?></li>
     </ul>

     <h4 class="theme_option_headline2"><?php printf(__('Recent %s', 'tcd-seeed'), $news_label); ?></h4>
      <ul class="option_list">
       <li class="cf"><span class="label"><span class="num">3</span><?php _e('Headline', 'tcd-seeed');  ?></span><input type="text" placeholder="<?php _e( 'e.g.', 'tcd-seeed' ); _e( 'Latest news', 'tcd-seeed' ); ?>" class="full_width" name="dp_options[recent_news_headline]" value="<?php echo esc_textarea(  $options['recent_news_headline'] ); ?>" /></li>
       <li class="cf"><span class="label"><span class="num">4</span><?php _e('Number of post to display', 'tcd-seeed'); ?></span><?php echo tcd_display_post_num_option_type2($options, 'recent_news_num'); ?></li>
      </ul>

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
      <textarea class="full_width" cols="50" rows="10" name="dp_options[single_news_top_ad_code]"><?php echo esc_textarea( $options['single_news_top_ad_code'] ); ?></textarea>

      <h4 class="theme_option_headline2"><?php _e('Free HTML area (mobile)', 'tcd-seeed');  ?></h4>
      <div class="theme_option_message2">
       <p><?php _e('This content will be displayed in mobile device only.', 'tcd-seeed');  ?></p>
      </div>
      <textarea class="full_width" cols="50" rows="10" name="dp_options[single_news_top_ad_code_mobile]"><?php echo esc_textarea( $options['single_news_top_ad_code_mobile'] ); ?></textarea>

     </div><!-- END .sub_box_tab_content -->

     <?php // メインコンテンツの下部 ----------------------- ?>
     <div class="sub_box_tab_content" data-tab-content="tab2">

      <h4 class="theme_option_headline2"><?php _e('Free HTML area (PC)', 'tcd-seeed');  ?></h4>
      <div class="theme_option_message2">
       <p><?php _e('This content will be displayed in PC only.', 'tcd-seeed');  ?></p>
      </div>
      <textarea class="full_width" cols="50" rows="10" name="dp_options[single_news_bottom_ad_code]"><?php echo esc_textarea( $options['single_news_bottom_ad_code'] ); ?></textarea>

      <h4 class="theme_option_headline2"><?php _e('Free HTML area (mobile)', 'tcd-seeed');  ?></h4>
      <div class="theme_option_message2">
       <p><?php _e('This content will be displayed in mobile device only.', 'tcd-seeed');  ?></p>
      </div>
      <textarea class="full_width" cols="50" rows="10" name="dp_options[single_news_bottom_ad_code_mobile]"><?php echo esc_textarea( $options['single_news_bottom_ad_code_mobile'] ); ?></textarea>

     </div><!-- END .sub_box_tab_content -->

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-seeed' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-seeed' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


</div><!-- END .tab-content -->

<?php
} // END add_news_tab_panel()


// バリデーション　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_news_theme_options_validate( $input ) {

  global $dp_default_options, $no_image_options, $font_type_options;

  //基本設定
  $input['use_news'] = wp_filter_nohtml_kses( $input['use_news'] );
  $input['news_slug'] = sanitize_title( $input['news_slug'] );
  $input['news_label'] = wp_filter_nohtml_kses( $input['news_label'] );
  $input['news_show_image'] = wp_filter_nohtml_kses( $input['news_show_image'] );

  // アーカイブ
  $input['archive_news_headline'] = wp_filter_nohtml_kses( $input['archive_news_headline'] );
  $input['archive_news_desc'] = wp_kses_post( $input['archive_news_desc'] );
  $input['archive_news_desc_mobile'] = wp_kses_post( $input['archive_news_desc_mobile'] );
  $input['archive_news_header_image'] = wp_filter_nohtml_kses( $input['archive_news_header_image'] );
  $input['archive_news_overlay_color'] = wp_filter_nohtml_kses( $input['archive_news_overlay_color'] );
  $input['archive_news_overlay_opacity'] = wp_filter_nohtml_kses( $input['archive_news_overlay_opacity'] );

  $input['archive_news_num'] = wp_filter_nohtml_kses( $input['archive_news_num'] );
  $input['archive_news_num_sp'] = wp_filter_nohtml_kses( $input['archive_news_num_sp'] );


  //詳細ページ
  $input['single_news_show_sns'] = wp_filter_nohtml_kses( $input['single_news_show_sns'] );
  $input['single_news_show_copy'] = wp_filter_nohtml_kses( $input['single_news_show_copy'] );


  // 最新お知らせ一覧
  $input['recent_news_headline'] = wp_filter_nohtml_kses( $input['recent_news_headline'] );
  $input['recent_news_num'] = wp_filter_nohtml_kses( $input['recent_news_num'] );
  $input['recent_news_num_sp'] = wp_filter_nohtml_kses( $input['recent_news_num_sp'] );


  // 記事ページの追加コンテンツ
  $input['single_news_top_ad_code'] = $input['single_news_top_ad_code'];
  $input['single_news_top_ad_code_mobile'] = $input['single_news_top_ad_code_mobile'];
  $input['single_news_bottom_ad_code'] = $input['single_news_bottom_ad_code'];
  $input['single_news_bottom_ad_code_mobile'] = $input['single_news_bottom_ad_code_mobile'];


	return $input;

};


?>