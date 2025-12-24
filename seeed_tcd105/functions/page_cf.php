<?php

/* フォーム用 画像フィールド出力 */
function mlcf_media_form($cf_key, $label) {
	global $post;
	if (empty($cf_key)) return false;
	if (empty($label)) $label = $cf_key;

	$media_id = get_post_meta($post->ID, $cf_key, true);
?>
 <div class="image_box cf">
  <div class="cf cf_media_field hide-if-no-js <?php echo esc_attr($cf_key); ?>">
    <input type="hidden" class="cf_media_id" name="<?php echo esc_attr($cf_key); ?>" id="<?php echo esc_attr($cf_key); ?>" value="<?php echo esc_attr($media_id); ?>" />
    <div class="preview_field"><?php if ($media_id) the_mlcf_image($post->ID, $cf_key); ?></div>
    <div class="buttton_area">
     <input type="button" class="cfmf-select-img button" value="<?php _e('Select Image', 'tcd-seeed'); ?>" />
     <input type="button" class="cfmf-delete-img button<?php if (!$media_id) echo ' hidden'; ?>" value="<?php _e('Remove Image', 'tcd-seeed'); ?>" />
    </div>
  </div>
 </div>
<?php
}




/* 画像フィールドで選択された画像をimgタグで出力 */
function the_mlcf_image($post_id, $cf_key, $image_size = 'medium') {
	echo get_mlcf_image($post_id, $cf_key, $image_size);
}

/* 画像フィールドで選択された画像をimgタグで返す */
function get_mlcf_image($post_id, $cf_key, $image_size = 'medium') {
	global $post;
	if (empty($cf_key)) return false;
	if (empty($post_id)) $post_id = $post->ID;

	$media_id = get_post_meta($post_id, $cf_key, true);
	if ($media_id) {
		return wp_get_attachment_image($media_id, $image_size, $image_size);
	}

	return false;
}

/* 画像フィールドで選択された画像urlを返す */
function get_mlcf_image_url($post_id, $cf_key, $image_size = 'medium') {
	global $post;
	if (empty($cf_key)) return false;
	if (empty($post_id)) $post_id = $post->ID;

	$media_id = get_post_meta($post_id, $cf_key, true);
	if ($media_id) {
		$img = wp_get_attachment_image_src($media_id, $image_size);
		if (!empty($img[0])) {
			return $img[0];
		}
	}

	return false;
}

/* 画像フィールドで選択されたメディアのURLを出力 */
function the_mlcf_media_url($post_id, $cf_key) {
	echo get_mlcf_media_url($post_id, $cf_key);
}

/* 画像フィールドで選択されたメディアのURLを返す */
function get_mlcf_media_url($post_id, $cf_key) {
	global $post;
	if (empty($cf_key)) return false;
	if (empty($post_id)) $post_id = $post->ID;

	$media_id = get_post_meta($post_id, $cf_key, true);
	if ($media_id) {
		return wp_get_attachment_url($media_id);
	}

	return false;
}


// ヘッダーの設定 -------------------------------------------------------

function page_header_meta_box() {
  add_meta_box(
    'tcd_meta_box1',//ID of meta box
    __('Page setting', 'tcd-seeed'),//label
    'show_page_header_meta_box',//callback function
    'page',// post type
    'normal',// context
    'high'// priority
  );
}
add_action('add_meta_boxes', 'page_header_meta_box');

function show_page_header_meta_box() {

  global $post, $font_type_options, $content_direction_options;

  $header_headline = get_post_meta($post->ID, 'header_headline', true);
  $header_overlay_color = get_post_meta($post->ID, 'header_overlay_color', true) ?  get_post_meta($post->ID, 'header_overlay_color', true) : '#000000';
  $header_overlay_color_opacity = get_post_meta($post->ID, 'header_overlay_color_opacity', true) ?  get_post_meta($post->ID, 'header_overlay_color_opacity', true) : '0.3';
  if($header_overlay_color_opacity == 'zero'){
    $header_overlay_color_opacity = '0';
  }

  // 表示設定
  $hide_page_header = get_post_meta($post->ID, 'hide_page_header', true) ?  get_post_meta($post->ID, 'hide_page_header', true) : 'no';
  $hide_sidebar = get_post_meta($post->ID, 'hide_sidebar', true) ?  get_post_meta($post->ID, 'hide_sidebar', true) : 'right';
  $page_hide_footer = get_post_meta($post->ID, 'page_hide_footer', true) ?  get_post_meta($post->ID, 'page_hide_footer', true) : 'no';
  $hide_breadcrumb = get_post_meta($post->ID, 'hide_breadcrumb', true) ?  get_post_meta($post->ID, 'hide_breadcrumb', true) : 'no';

  $hide_page_header_bar = get_post_meta($post->ID, 'hide_page_header_bar', true);
  if(empty($hide_page_header_bar)){
    $hide_page_header_bar = 'no';
  }

  $hide_header_message = get_post_meta($post->ID, 'hide_header_message', true);
  if(empty($hide_header_message)){
    $hide_header_message = 'yes';
  }

  $page_width = get_post_meta($post->ID, 'page_width', true);
  if(empty($page_width)){
    $page_width = 'normal';
  }

  // FAQ
  $faq_list = get_post_meta($post->ID, 'faq_list', true);

  // LPページ用
  $lp_catch = get_post_meta($post->ID, 'lp_catch', true);
  $lp_catch_mobile = get_post_meta($post->ID, 'lp_catch_mobile', true);
  $lp_catch_font_type = get_post_meta($post->ID, 'lp_catch_font_type', true) ?  get_post_meta($post->ID, 'lp_catch_font_type', true) : 'type2';
  $lp_catch_font_size = get_post_meta($post->ID, 'lp_catch_font_size', true) ?  get_post_meta($post->ID, 'lp_catch_font_size', true) : '40';
  $lp_catch_font_size_sp = get_post_meta($post->ID, 'lp_catch_font_size_sp', true) ?  get_post_meta($post->ID, 'lp_catch_font_size_sp', true) : '24';
  $lp_header_overlay_color = get_post_meta($post->ID, 'lp_header_overlay_color', true) ?  get_post_meta($post->ID, 'lp_header_overlay_color', true) : '#000000';
  $lp_header_overlay_color_opacity = get_post_meta($post->ID, 'lp_header_overlay_color_opacity', true) ?  get_post_meta($post->ID, 'lp_header_overlay_color_opacity', true) : '0.3';
  if($lp_header_overlay_color_opacity == 'zero'){
    $lp_header_overlay_color_opacity = '0';
  }

  echo '<input type="hidden" name="page_header_custom_fields_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

  //入力欄 ***************************************************************************************************************************************************************************************
?>

<?php
     // WP5.0対策として隠しフィールドを用意　選択されているページテンプレートによってLPページ用入力欄を表示・非表示する
     if ( count( get_page_templates( $post ) ) > 0 && get_option( 'page_for_posts' ) != $post->ID ) :
       $template = ! empty( $post->page_template ) ? $post->page_template : false;
?>
<select name="hidden_page_template" id="hidden_page_template" style="display:none;">
 <option value="default">Default Template</option>
 <?php page_template_dropdown( $template, 'page' ); ?>
</select>
<?php endif; ?>

<div class="tcd_custom_field_wrap">

  <?php // 基本設定 --------------------------------------------------- ?>
  <div class="theme_option_field cf theme_option_field_ac" id="basic_page_setting">
   <h3 class="theme_option_headline"><?php _e( 'Display setting', 'tcd-seeed' ); ?></h3>
   <div class="theme_option_field_ac_content">

    <div class="theme_option_message2 lp_template_option">
     <p><?php _e('Please set header message from <a href="./wp-admin/admin.php?page=theme_options">theme option page</a>.', 'tcd-seeed'); ?></p>
    </div>

    <ul class="option_list">
     <li class="lp_template_option cf">
      <span class="label"><?php _e('Header message', 'tcd-seeed');  ?></span>
      <div class="standard_radio_button">
       <input type="radio" id="hide_header_message_no" name="hide_header_message" value="no"<?php checked( $hide_header_message, 'no' ); ?>>
       <label for="hide_header_message_no"><?php _e('Display', 'tcd-seeed');  ?></label>
       <input type="radio" id="hide_header_message_yes" name="hide_header_message" value="yes"<?php checked( $hide_header_message, 'yes' ); ?>>
       <label for="hide_header_message_yes"><?php _e('Hide', 'tcd-seeed');  ?></label>
      </div>
     </li>
     <li class="lp_template_option cf">
      <span class="label"><?php _e('Header bar', 'tcd-seeed');  ?></span>
      <div class="standard_radio_button">
       <input type="radio" id="hide_page_header_bar_no" name="hide_page_header_bar" value="no"<?php checked( $hide_page_header_bar, 'no' ); ?>>
       <label for="hide_page_header_bar_no"><?php _e('Display', 'tcd-seeed');  ?></label>
       <input type="radio" id="hide_page_header_bar_yes" name="hide_page_header_bar" value="yes"<?php checked( $hide_page_header_bar, 'yes' ); ?>>
       <label for="hide_page_header_bar_yes"><?php _e('Hide', 'tcd-seeed');  ?></label>
      </div>
     </li>
     <li class="lp_template_option cf">
      <span class="label"><?php _e('Header image', 'tcd-seeed');  ?></span>
      <div class="standard_radio_button">
       <input type="radio" id="hide_page_header_no" name="hide_page_header" value="no"<?php checked( $hide_page_header, 'no' ); ?>>
       <label for="hide_page_header_no"><?php _e('Display', 'tcd-seeed');  ?></label>
       <input type="radio" id="hide_page_header_yes" name="hide_page_header" value="yes"<?php checked( $hide_page_header, 'yes' ); ?>>
       <label for="hide_page_header_yes"><?php _e('Hide', 'tcd-seeed');  ?></label>
      </div>
     </li>
     <li class="lp_template_option cf">
      <span class="label"><?php _e('Footer', 'tcd-seeed');  ?></span>
      <div class="standard_radio_button">
       <input type="radio" id="page_hide_footer_no" name="page_hide_footer" value="no"<?php checked( $page_hide_footer, 'no' ); ?>>
       <label for="page_hide_footer_no"><?php _e('Display', 'tcd-seeed');  ?></label>
       <input type="radio" id="page_hide_footer_yes" name="page_hide_footer" value="yes"<?php checked( $page_hide_footer, 'yes' ); ?>>
       <label for="page_hide_footer_yes"><?php _e('Hide', 'tcd-seeed');  ?></label>
      </div>
     </li>
     <li class="normal_template_option cf" style="border:none;">
      <span class="label"><?php _e('Breadcrumb link', 'tcd-seeed');  ?></span>
      <div class="standard_radio_button">
       <input type="radio" id="hide_breadcrumb_no" name="hide_breadcrumb" value="no"<?php checked( $hide_breadcrumb, 'no' ); ?>>
       <label for="hide_breadcrumb_no"><?php _e('Display', 'tcd-seeed');  ?></label>
       <input type="radio" id="hide_breadcrumb_yes" name="hide_breadcrumb" value="yes"<?php checked( $hide_breadcrumb, 'yes' ); ?>>
       <label for="hide_breadcrumb_yes"><?php _e('Hide', 'tcd-seeed');  ?></label>
      </div>
     </li>
     <li class="normal_template_option cf">
      <span class="label"><?php _e('Sidebar', 'tcd-seeed');  ?></span>
      <div class="standard_radio_button">
       <input type="radio" id="hide_sidebar_left" name="hide_sidebar" value="left"<?php checked( $hide_sidebar, 'left' ); ?>>
       <label for="hide_sidebar_left"><?php _e('Left', 'tcd-seeed');  ?></label>
       <input type="radio" id="hide_sidebar_right" name="hide_sidebar" value="right"<?php checked( $hide_sidebar, 'right' ); ?>>
       <label for="hide_sidebar_right"><?php _e('Right', 'tcd-seeed');  ?></label>
       <input type="radio" id="hide_sidebar_hide" name="hide_sidebar" value="hide"<?php checked( $hide_sidebar, 'hide' ); ?>>
       <label for="hide_sidebar_hide"><?php _e('Hide', 'tcd-seeed');  ?></label>
      </div>
     </li>
     <li class="cf lp_template_option">
      <span class="label"><?php _e('Content width', 'tcd-seeed');  ?></span>
      <div class="standard_radio_button">
       <input type="radio" id="page_width_normal" name="page_width" value="normal"<?php checked( $page_width, 'normal' ); ?>>
       <label for="page_width_normal"><?php _e('Normal', 'tcd-seeed');  ?></label>
       <input type="radio" id="page_width_wide" name="page_width" value="wide"<?php checked( $page_width, 'wide' ); ?>>
       <label for="page_width_wide"><?php _e('Wide', 'tcd-seeed');  ?></label>
      </div>
     </li>
    </ul>

    <ul class="button_list cf">
     <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-seeed' ); ?></a></li>
    </ul>
   </div><!-- END .theme_option_field_ac_content -->
  </div><!-- END .theme_option_field -->


  <?php // ページヘッダーの設定 --------------------------------------------------- ?>
  <div class="theme_option_field cf theme_option_field_ac" id="page_header_setting_area">
   <h3 class="theme_option_headline"><?php _e( 'Header', 'tcd-seeed' ); ?></h3>
   <div class="theme_option_field_ac_content">

    <div class="normal_template_option">

     <div class="cb_image">
      <img src="<?php bloginfo('template_url'); ?>/admin/img/page_header_image.jpg" width="" height="" />
     </div>

     <h4 class="theme_option_headline2"><?php _e('Basic settings', 'tcd-seeed');  ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('Page title will be displayed when headline option is blank.', 'tcd-seeed'); ?></p>
     </div>
     <ul class="option_list">
      <li class="cf"><span class="label"><span class="num">1</span><?php _e('Headline', 'tcd-seeed'); ?></span><input class="full_width" type="text" name="header_headline" value="<?php echo esc_attr($header_headline); ?>" /></li>
      <li class="cf">
       <span class="label">
        <span class="num">2</span>
        <?php _e('Image', 'tcd-seeed'); ?>
        <span class="recommend_desc"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-seeed'), '1450', '600'); ?></span>
       </span>
       <?php mlcf_media_form('header_image', __('Image', 'tcd-seeed')); ?>
      </li>
      <li class="cf"><span class="label"><span class="num">2</span><?php _e('Overlay color of image', 'tcd-seeed'); ?></span><input type="text" name="header_overlay_color" value="<?php echo esc_attr( $header_overlay_color ); ?>" data-default-color="#000000" class="c-color-picker"></li>
      <li class="cf">
       <span class="label"><span class="num">2</span><?php _e('Transparency of overlay', 'tcd-seeed'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="header_overlay_color_opacity" value="<?php echo esc_attr( $header_overlay_color_opacity ); ?>" />
       <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
        <p><?php _e('Please specify the number of 0 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-seeed');  ?><br>
        <?php _e('Please enter 0 if you don\'t want to use overlay.', 'tcd-seeed');  ?></p>
       </div>
      </li>
     </ul>

    </div><!-- END #normal_header -->

    <div class="lp_template_option">

     <div class="cb_image">
      <img src="<?php bloginfo('template_url'); ?>/admin/img/lp_header_image.jpg" width="" height="" />
     </div>

     <h4 class="theme_option_headline2"><?php _e('Basic settings', 'tcd-seeed');  ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><span class="num">1</span><?php _e('Catchphrase', 'tcd-seeed'); ?></span><textarea placeholder="<?php _e( 'If you leave this field blank, the page title will be displayed instead.', 'tcd-seeed' ); ?>" class="full_width" cols="50" rows="2" name="lp_catch"><?php echo esc_textarea(  $lp_catch ); ?></textarea></li>
      <li class="cf"><span class="label"><span class="num">1</span><?php _e('Catchphrase (mobile)', 'tcd-seeed'); ?></span><textarea placeholder="<?php _e( 'Please indicate if you would like to display a short text for mobile sizes.', 'tcd-seeed' ); ?>" class="full_width" cols="50" rows="2" name="lp_catch_mobile"><?php echo esc_textarea(  $lp_catch_mobile ); ?></textarea></li>
      <li class="cf">
       <span class="label"><span class="num">1</span><?php _e('Font type of catchphrase', 'tcd-seeed');  ?></span>
       <div class="standard_radio_button">
        <?php
             foreach ( $font_type_options as $option ) {
               if(strtoupper(get_locale()) == 'JA'){
                 $label = $option['label'];
               } else {
                 $label = $option['label_en'];
               }
        ?>
        <input id="lp_catch_font_type_<?php echo esc_attr($option['value']); ?>" type="radio" name="lp_catch_font_type" value="<?php echo esc_attr($option['value']); ?>"<?php checked( $lp_catch_font_type, $option['value'] ); ?>>
        <label for="lp_catch_font_type_<?php echo esc_attr($option['value']); ?>"><?php echo esc_html($option['label']); ?></label>
        <?php } ?>
       </div>
      </li>
      <li class="cf">
       <span class="label"><span class="num">1</span><?php _e('Font size of catchphrase', 'tcd-seeed'); ?></span>
       <div class="font_size_option">
        <label class="font_size_label number_option">
         <input class="hankaku input_font_size" type="number" name="lp_catch_font_size" value="<?php esc_attr_e( $lp_catch_font_size ); ?>"><span class="icon icon_pc"></span>
        </label>
        <label class="font_size_label number_option">
         <input class="hankaku input_font_size_sp" type="number" name="lp_catch_font_size_sp" value="<?php esc_attr_e( $lp_catch_font_size_sp ); ?>"><span class="icon icon_sp"></span>
        </label>
       </div>
      </li>
      <li class="cf">
       <span class="label">
        <span class="num">2</span>
        <?php _e('Background image', 'tcd-seeed'); ?>
        <span class="recommend_desc"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-seeed'), '1450', '600'); ?></span>
       </span>
       <?php mlcf_media_form('lp_image', __('Background image', 'tcd-seeed')); ?>
      </li>
      <li class="cf">
       <span class="label">
        <span class="num">2</span>
        <?php _e('Background image (mobile)', 'tcd-seeed'); ?>
        <span class="recommend_desc"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-seeed'), '750', '400'); ?></span>
       </span>
       <?php mlcf_media_form('lp_image_mobile', __('Small image', 'tcd-seeed')); ?>
      </li>
      <li class="cf"><span class="label"><span class="num">2</span><?php echo tcd_admin_label('overlay_color'); ?></span><input type="text" name="lp_header_overlay_color" value="<?php echo esc_attr( $lp_header_overlay_color ); ?>" data-default-color="#000000" class="c-color-picker"></li>
      <li class="cf">
       <span class="label"><span class="num">2</span><?php _e('Transparency of overlay', 'tcd-seeed'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="lp_header_overlay_color_opacity" value="<?php echo esc_attr( $lp_header_overlay_color_opacity ); ?>" />
       <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
        <p><?php _e('Please specify the number of 0 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-seeed');  ?><br>
        <?php _e('Please enter 0 if you don\'t want to use overlay.', 'tcd-seeed');  ?></p>
       </div>
      </li>
     </ul>

    </div><!-- END #lp_header -->

    <ul class="button_list cf">
     <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-seeed' ); ?></a></li>
    </ul>
   </div><!-- END .theme_option_field_ac_content -->
  </div><!-- END .theme_option_field -->


  <?php // FAQの設定 --------------------------------------------------- ?>
  <div id="page_faq_option" class="theme_option_field cf theme_option_field_ac">
   <h3 class="theme_option_headline"><?php _e( 'FAQ', 'tcd-seeed' ); ?></h3>
   <div class="theme_option_field_ac_content">

    <div class="cb_image">
     <img src="<?php bloginfo('template_url'); ?>/admin/img/sc_faq.jpg?4.0" width="" height="" />
    </div>

    <div class="theme_option_message2">
     <p><?php _e('Please copy and paste the short code below where you want to display FAQ list.', 'tcd-seeed'); ?></p>
     <p><?php _e( 'Short code', 'tcd-seeed' ); ?> : <input style="background:#fff; width:200px;" onfocus='this.select();' type="text" value="[sc_faq]" readonly></p>
    </div>

    <?php // リスト ------------------------------------------------------------------------- ?>
    <h4 class="theme_option_headline2"><?php _e( 'FAQ list', 'tcd-seeed' ); ?></h4>
    <?php //繰り返しフィールド ----- ?>
    <div class="repeater-wrapper">
     <div class="repeater sortable" data-delete-confirm="<?php echo tcd_admin_label('delete'); ?>">
       <?php
           if ( $faq_list ) :
             foreach ( $faq_list as $key => $value ) :
       ?>
       <div class="sub_box repeater-item repeater-item-<?php echo $key; ?>">
        <h4 class="theme_option_subbox_headline"><?php echo esc_html( ! empty( $faq_list[$key]['question'] ) ? $faq_list[$key]['question'] : tcd_admin_label('new_item') ); ?></h4>
        <div class="sub_box_content">
         <h4 class="theme_option_headline2"><?php _e( 'Question', 'tcd-seeed' ); ?></h4>
         <p><input class="repeater-label full_width" type="text" name="faq_list[<?php echo esc_attr( $key ); ?>][question]" value="<?php echo esc_attr( isset( $faq_list[$key]['question'] ) ? $faq_list[$key]['question'] : '' ); ?>" /></p>
         <h4 class="theme_option_headline2"><?php _e( 'Answer', 'tcd-seeed' ); ?></h4>
         <textarea class="full_width" cols="50" rows="5" name="faq_list[<?php echo esc_attr( $key ); ?>][answer]"><?php echo esc_attr( isset( $faq_list[$key]['answer'] ) ? $faq_list[$key]['answer'] : '' ); ?></textarea>
         <p class="delete-row right-align"><a href="#" class="button button-secondary button-delete-row"><?php echo tcd_admin_label('delete_item'); ?></a></p>
        </div><!-- END .sub_box_content -->
       </div><!-- END .sub_box -->
       <?php
             endforeach;
           endif;
           $key = 'addindex';
           ob_start();
       ?>
       <div class="sub_box repeater-item repeater-item-<?php echo $key; ?>">
        <h4 class="theme_option_subbox_headline"><?php echo esc_html( ! empty( $faq_list[$key]['question'] ) ? $faq_list[$key]['question'] : tcd_admin_label('new_item') ); ?></h4>
        <div class="sub_box_content">
         <h4 class="theme_option_headline2"><?php _e( 'Question', 'tcd-seeed' ); ?></h4>
         <p><input class="repeater-label full_width" type="text" name="faq_list[<?php echo esc_attr( $key ); ?>][question]" value="<?php echo esc_attr( isset( $faq_list[$key]['question'] ) ? $faq_list[$key]['question'] : '' ); ?>" /></p>
         <h4 class="theme_option_headline2"><?php _e( 'Answer', 'tcd-seeed' ); ?></h4>
         <textarea class="full_width" cols="50" rows="5" name="faq_list[<?php echo esc_attr( $key ); ?>][answer]"><?php echo esc_attr( isset( $faq_list[$key]['answer'] ) ? $faq_list[$key]['answer'] : '' ); ?></textarea>
         <p class="delete-row right-align"><a href="#" class="button button-secondary button-delete-row"><?php echo tcd_admin_label('delete_item'); ?></a></p>
        </div><!-- END .sub_box_content -->
       </div><!-- END .sub_box -->
       <?php
           $clone = ob_get_clean();
       ?>
       </div><!-- END .repeater -->
     <a href="#" class="button button-secondary button-add-row" data-clone="<?php echo esc_attr( $clone ); ?>"><?php echo tcd_admin_label('add_item'); ?></a>
    </div><!-- END .repeater-wrapper -->
    <?php //繰り返しフィールドここまで ----- ?>

    <ul class="button_list cf">
      <li><a class="close_ac_content button-ml" href="#"><?php echo tcd_admin_label('close'); ?></a></li>
    </ul>
   </div><!-- END .theme_option_field_ac_content -->
  </div><!-- END .theme_option_field -->


</div><!-- END .tcd_custom_field_wrap -->

<?php
}

function save_page_header_meta_box( $post_id ) {

  // verify nonce
  if (!isset($_POST['page_header_custom_fields_meta_box_nonce']) || !wp_verify_nonce($_POST['page_header_custom_fields_meta_box_nonce'], basename(__FILE__))) {
    return $post_id;
  }

  // check autosave
  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return $post_id;
  }

  // check permissions
  if ('page' == $_POST['post_type']) {
    if (!current_user_can('edit_page', $post_id)) {
      return $post_id;
    }
  } elseif (!current_user_can('edit_post', $post_id)) {
      return $post_id;
  }

  // save or delete
  $cf_keys = array(
    'header_headline','header_image','header_overlay_color','header_overlay_color_opacity',
    'hide_page_header_bar','hide_page_header','hide_sidebar','page_hide_footer','hide_header_message','page_width','hide_breadcrumb',
    'lp_catch','lp_catch_mobile','lp_catch_font_type','lp_catch_font_size','lp_catch_font_size_sp','lp_image','lp_image_mobile','lp_header_overlay_color','lp_header_overlay_color_opacity',
  );
  foreach ($cf_keys as $cf_key) {

    $old = get_post_meta($post_id, $cf_key, true);

    if (isset($_POST[$cf_key])) {
      $new = $_POST[$cf_key];
    } else {
      $new = '';
    }

    if($cf_key == 'header_overlay_color_opacity'){
      if ( $new == '0' ) {
        $new = 'zero';
      }
    }
    if($cf_key == 'lp_header_overlay_color_opacity'){
      if ( $new == '0' ) {
        $new = 'zero';
      }
    }

    if ($new && $new != $old) {
      update_post_meta($post_id, $cf_key, $new);
    } elseif ('' == $new && $old) {
      delete_post_meta($post_id, $cf_key, $old);
    }

  }

  // repeater save or delete
  $cf_keys = array('faq_list');
  foreach ( $cf_keys as $cf_key ) {
    $old = get_post_meta( $post_id, $cf_key, true );

    if ( isset( $_POST[$cf_key] ) && is_array( $_POST[$cf_key] ) ) {
      $new = array_values( $_POST[$cf_key] );
    } else {
      $new = false;
    }

    if ( $new && $new != $old ) {
      update_post_meta( $post_id, $cf_key, $new );
    } elseif ( ! $new && $old ) {
      delete_post_meta( $post_id, $cf_key, $old );
    }
  }

}
add_action('save_post', 'save_page_header_meta_box');



?>