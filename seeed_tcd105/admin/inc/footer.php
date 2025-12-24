<?php
/*
 * フッターの設定
 */


// Add default values
add_filter( 'before_getting_design_plus_option', 'add_footer_dp_default_options' );


// Add label of footer tab
add_action( 'tcd_tab_labels', 'add_footer_tab_label' );


// Add HTML of footer tab
add_action( 'tcd_tab_panel', 'add_footer_tab_panel' );


// Register sanitize function
add_filter( 'theme_options_validate', 'add_footer_theme_options_validate' );


// タブの名前
function add_footer_tab_label( $tab_labels ) {
	$tab_labels['footer'] = __( 'Footer', 'tcd-seeed' );
	return $tab_labels;
}


// 初期値
function add_footer_dp_default_options( $dp_default_options ) {

	// コンタクトエリア
	for ( $i = 1; $i <= 2; $i++ ) {
		$dp_default_options['show_footer_contact'.$i] = '1';
		$dp_default_options['footer_contact_title'.$i] = __( 'Title', 'tcd-seeed' );
		$dp_default_options['footer_contact_desc'.$i] = __( 'Description will be displayed here.', 'tcd-seeed' );
		$dp_default_options['footer_contact_url'.$i] = '#';
		$dp_default_options['footer_contact_target'.$i] = '';
		$dp_default_options['footer_contact_icon'.$i] = '';
		$dp_default_options['footer_contact_icon_image'.$i] = false;
	}

  $dp_default_options['footer_contact_bg_type'] = 'type3';
  $dp_default_options['footer_contact_image_slider'] = false;
	$dp_default_options['footer_contact_video'] = '';
	$dp_default_options['footer_contact_image'] = '';
	$dp_default_options['footer_contact_overlay_color'] = '#000000';
	$dp_default_options['footer_contact_overlay_opacity'] = '0.3';

	// 住所
  $dp_default_options['footer_catch'] = __( 'Footer information will be display here', 'tcd-seeed' );

  // コピーライト
	$dp_default_options['copyright'] = 'Copyright &copy; ' . date('Y');

	// フッターバー
  $dp_default_options['footer_bar_type'] = 'type1';

  // アイコン付きメニュー
	$dp_default_options['footer_bar_btns'] = array();


	return $dp_default_options;

}


// 入力欄の出力　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_footer_tab_panel( $options ) {

  global $dp_default_options, $footer_bar_button_options, $footer_bar_icon_options, $footer_bar_type_options, $font_type_options, $logo_type_options, $bool_options;

?>

<div id="tab-content-footer" class="tab-content">

   <?php // コンタクトエリアの設定 ------------------------------------------------------------ ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Contact area', 'tcd-seeed');  ?></h3>
    <div class="theme_option_field_ac_content tab_parent">

     <div class="front_page_image">
      <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/footer_carousel.jpg" alt="" title="" />
     </div>

     <div class="sub_box_tab">
      <?php for($i = 1; $i <= 2; $i++) : ?>
      <div class="tab<?php if($i == 1){ echo ' active'; }; ?>" data-tab="tab<?php echo $i; ?>"><?php printf(__('Button%s', 'tcd-seeed'), $i); ?></div>
      <?php endfor; ?>
     </div>

     <?php for($i = 1; $i <= 3; $i++) : ?>
     <div class="sub_box_tab_content<?php if($i == 1){ echo ' active'; }; ?>" data-tab-content="tab<?php echo $i; ?>">

      <p class="displayment_checkbox"><label><input name="dp_options[show_footer_contact<?php echo $i; ?>]" type="checkbox" value="1" <?php checked( $options['show_footer_contact'.$i], 1 ); ?>><?php printf(__('Display button%s', 'tcd-seeed'), $i); ?></label></p>
      <div style="<?php if($options['show_footer_contact'.$i] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">

      <ul class="option_list">
       <li class="cf" style="border-top:1px dotted #ccc;"><span class="label"><span class="num">1</span><?php _e('Title', 'tcd-seeed'); ?></span><input class="tab_label full_width" type="text" name="dp_options[footer_contact_title<?php echo $i; ?>]" value="<?php esc_attr_e( $options['footer_contact_title'.$i] ); ?>" /></li>
       <li class="cf"><span class="label"><span class="num">2</span><?php _e('Description', 'tcd-seeed'); ?></span><textarea class="full_width" cols="50" rows="3" name="dp_options[footer_contact_desc<?php echo $i; ?>]"><?php echo esc_textarea(  $options['footer_contact_desc'.$i] ); ?></textarea></li>
       <li class="cf">
        <span class="label"><span class="num">3</span><?php _e('URL', 'tcd-seeed'); ?></span>
        <div class="admin_link_option">
         <input type="text" name="dp_options[footer_contact_url<?php echo $i; ?>]" placeholder="https://example.com/" value="<?php echo esc_attr( $options['footer_contact_url'.$i] ); ?>">
         <input id="footer_contact_target<?php echo $i; ?>" class="admin_link_option_target" name="dp_options[footer_contact_target<?php echo $i; ?>]" type="checkbox" value="1" <?php checked( $options['footer_contact_target'.$i], 1 ); ?>>
         <label for="footer_contact_target<?php echo $i; ?>">&#xe920;</label>
        </div>
       </li>
       <li class="cf">
        <span class="label"><span class="num">4</span><?php _e('Icon', 'tcd-seeed'); ?></span>
        <input class="full_width material_icon_option" type="text" placeholder="<?php _e( 'ex: e88a', 'tcd-seeed' ); ?>" name="dp_options[footer_contact_icon<?php echo $i; ?>]" value="<?php if(isset($options['footer_contact_icon'.$i])){ echo esc_attr( $options['footer_contact_icon'.$i] ); }; ?>">
        <div class="theme_option_message2 space" style="clear:both; margin:10px 0 -5px 0;">
         <p><?php _e('Please enter any icon code from Google Fonts.<br><a href="https://fonts.google.com/icons?selected=Material+Symbols+Outlined:redo:FILL@0;wght@400;GRAD@0;opsz@24" target="_blank">Click here for a list of icons from Google Fonts.</a>', 'tcd-seeed'); ?></p>
         <p><?php _e('If you want to use original image for icon, use the option below instead.', 'tcd-seeed'); ?><br>
         <?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-seeed'), '35', '35'); ?></p>
        </div>
       </li>
       <li class="cf" style="border-top:none;">
        <span class="label">
         <span class="num_space"></span>
         <?php _e('Original icon image', 'tcd-seeed'); ?>
        </span>
        <div class="image_box cf">
         <div class="cf cf_media_field hide-if-no-js footer_contact_icon_image<?php echo $i; ?>">
          <input type="hidden" value="<?php echo esc_attr( $options['footer_contact_icon_image'.$i] ); ?>" id="footer_contact_icon_image<?php echo $i; ?>" name="dp_options[footer_contact_icon_image<?php echo $i; ?>]" class="cf_media_id">
          <div class="preview_field"><?php if($options['footer_contact_icon_image'.$i]){ echo wp_get_attachment_image($options['footer_contact_icon_image'.$i], 'medium'); }; ?></div>
          <div class="buttton_area">
           <input type="button" value="<?php _e('Select Image', 'tcd-seeed'); ?>" class="cfmf-select-img button">
           <input type="button" value="<?php _e('Remove Image', 'tcd-seeed'); ?>" class="cfmf-delete-img button <?php if(!$options['footer_contact_icon_image'.$i]){ echo 'hidden'; }; ?>">
          </div>
         </div>
        </div>
       </li>
      </ul>

      </div>

     </div><!-- END .sub_box_tab_content -->
     <?php endfor; ?>

     <h4 class="theme_option_headline2"><?php _e( 'Background', 'tcd-seeed' ); ?></h4>
     <ul class="option_list">
      <li class="cf">
       <span class="label"><span class="num">5</span><?php _e('Background type', 'tcd-seeed'); ?></span>
       <div class="standard_radio_button">
        <input id="footer_contact_bg_type3" type="radio" name="dp_options[footer_contact_bg_type]" value="type3" <?php checked( $options['footer_contact_bg_type'], 'type3' ); ?>>
        <label for="footer_contact_bg_type3"><?php _e('Fixed image', 'tcd-seeed'); ?></label>
        <input id="footer_contact_bg_type1" type="radio" name="dp_options[footer_contact_bg_type]" value="type1" <?php checked( $options['footer_contact_bg_type'], 'type1' ); ?>>
        <label for="footer_contact_bg_type1"><?php _e( 'Image slider', 'tcd-seeed' ); ?></label>
        <input id="footer_contact_bg_type2" type="radio" name="dp_options[footer_contact_bg_type]" value="type2" <?php checked( $options['footer_contact_bg_type'], 'type2' ); ?>>
        <label for="footer_contact_bg_type2"><?php _e('Video', 'tcd-seeed'); ?></label>
        <input id="footer_contact_bg_none" type="radio" name="dp_options[footer_contact_bg_type]" value="none" <?php checked( $options['footer_contact_bg_type'], 'none' ); ?>>
        <label for="footer_contact_bg_none"><?php _e('Display none', 'tcd-seeed'); ?></label>
       </div>
      </li>
      <li id="footer_bg_type1_option" class="cf" style="border:none;">
       <span class="label">
        <span class="num_space"></span><?php _e('Image slider', 'tcd-seeed'); ?>
        <span class="recommend_desc space"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-seeed'), '363', '400'); ?></span>
        <span class="recommend_desc space"><?php _e('You can register multiple image by clicking images in media library.', 'tcd-seeed'); ?></span>
        <span class="recommend_desc space"><?php _e('Please register more than 4 images to work image slider fine.', 'tcd-seeed'); ?></span>
       </span>
       <?php echo tcd_multi_media_uploader( 'footer_contact_image_slider', $options ); ?>
      </li>
      <li id="footer_bg_type2_option" class="cf" style="border:none;">
       <span class="label">
        <span class="num_space"></span><?php _e('Video', 'tcd-seeed'); ?>
        <span class="recommend_desc space"><?php _e('Please upload MP4 format file.', 'tcd-seeed');  ?></span>
        <span class="recommend_desc space"><?php _e('Recommended MP4 file size: 10 MB or less.<br>The screen ratio of the video is assumed to be 16:9.', 'tcd-seeed'); ?></span>
       </span>
       <div class="cf cf_media_field hide-if-no-js footer_contact_video video_option">
        <input type="hidden" value="<?php if($options['footer_contact_video']) { echo esc_attr( $options['footer_contact_video'] ); }; ?>" id="footer_contact_video" name="dp_options[footer_contact_video]" class="cf_media_id">
        <div class="preview_field preview_field_video">
         <?php if($options['footer_contact_video']){ ?>
         <p><?php echo esc_url(wp_get_attachment_url($options['footer_contact_video'])); ?></p>
         <?php }; ?>
        </div>
        <div class="buttton_area">
         <input type="button" value="<?php _e('Select MP4 file', 'tcd-seeed'); ?>" class="cfmf-select-video button">
         <input type="button" value="<?php _e('Remove MP4 file', 'tcd-seeed'); ?>" class="cfmf-delete-video button <?php if(!$options['footer_contact_video']){ echo 'hidden'; }; ?>">
        </div>
       </div>
      </li>
      <li id="footer_bg_type3_option" class="cf" style="border:none;">
       <span class="label">
        <span class="num_space"></span><?php _e('Image', 'tcd-seeed'); ?>
        <span class="recommend_desc space"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-seeed'), '1450', '400'); ?></span>
       </span>
       <div class="image_box cf">
        <div class="cf cf_media_field hide-if-no-js footer_contact_image">
         <input type="hidden" value="<?php echo esc_attr( $options['footer_contact_image'] ); ?>" id="footer_contact_image" name="dp_options[footer_contact_image]" class="cf_media_id">
         <div class="preview_field"><?php if($options['footer_contact_image']){ echo wp_get_attachment_image($options['footer_contact_image'], 'medium'); }; ?></div>
         <div class="buttton_area">
          <input type="button" value="<?php _e('Select Image', 'tcd-seeed'); ?>" class="cfmf-select-img button">
          <input type="button" value="<?php _e('Remove Image', 'tcd-seeed'); ?>" class="cfmf-delete-img button <?php if(!$options['footer_contact_image']){ echo 'hidden'; }; ?>">
         </div>
        </div>
       </div>
      </li>
      <li class="cf footer_bg_overlay_option" style="border:none;">
       <span class="label"><span class="num_space"></span><?php _e('Color of overlay', 'tcd-seeed'); ?></span><input type="text" name="dp_options[footer_contact_overlay_color]" value="<?php echo esc_attr( $options['footer_contact_overlay_color'] ); ?>" data-default-color="#000000" class="c-color-picker">
      </li>
      <li class="cf footer_bg_overlay_option" style="border:none;">
       <span class="label"><span class="num_space"></span><?php _e('Transparency of overlay', 'tcd-seeed'); ?></span><input class="hankaku" style="width:70px;" type="number" min="0" max="1" step="0.1" name="dp_options[footer_contact_overlay_opacity]" value="<?php echo esc_attr( $options['footer_contact_overlay_opacity'] ); ?>" />
       <div class="theme_option_message2 space" style="clear:both; margin:7px 0 0 0;">
        <p><?php _e('Please specify the number of 0 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-seeed');  ?>
        <?php _e('Please enter 0 if you don\'t want to use overlay.', 'tcd-seeed');  ?></p>
       </div>
      </li>
     </ul>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-seeed' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-seeed' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // ロゴエリアの設定 ------------------------------------------------------------ ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Logo area', 'tcd-seeed');  ?></h3>
    <div class="theme_option_field_ac_content">

     <div class="front_page_image">
      <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/footer_bottom.jpg" alt="" title="" />
     </div>

     <h4 class="theme_option_headline_number"><span class="num">1</span><?php _e( 'Catchphrase', 'tcd-seeed' ); ?></h4>
     <textarea class="full_width" placeholder="<?php _e( 'Please describe the concept of the site in a straightforward manner.', 'tcd-seeed' ); ?>" cols="50" rows="3" name="dp_options[footer_catch]"><?php echo esc_textarea(  $options['footer_catch'] ); ?></textarea>

     <h4 class="theme_option_headline_number"><span class="num">2</span><?php _e( 'Logo', 'tcd-seeed' ); ?></h4>
     <div class="theme_option_message2">
      <p><?php echo __('You can set logo from "Basic Settings" logo section.', 'tcd-seeed'); ?></p>
     </div>

     <h4 class="theme_option_headline_number"><span class="num">3</span><?php _e( 'SNS icon', 'tcd-seeed' ); ?></h4>
     <div class="theme_option_message2">
      <p><?php _e( 'SNS icons can be set in basic settings. The specifications are displayed in the following locations.<br><br>Footer menu area (PC/Mobile)<br>Lower part of the drawer menu (Mobile only)', 'tcd-seeed' ); ?></p>
     </div>

     <h4 class="theme_option_headline_number"><span class="num">4</span><?php _e( 'Menu', 'tcd-seeed' ); ?></h4>
     <div class="theme_option_message2">
      <p><?php echo __('Please set menu from <a href="./nav-menus.php" target="_blank">"Menu Screen"</a> in theme menu.', 'tcd-seeed'); ?></p>
     </div>

     <h4 class="theme_option_headline_number"><span class="num">5</span><?php _e( 'Copyright', 'tcd-seeed' ); ?></h4>
     <input class="full_width" type="text" placeholder="<?php _e( 'e.g. &copy; 20xx Site name, etc.', 'tcd-seeed' ); ?>" name="dp_options[copyright]" value="<?php echo esc_attr( $options['copyright'] ); ?>" />

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-seeed' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-seeed' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // フッターバーの設定 -------------------------------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e( 'Footer bar (mobile device only)', 'tcd-seeed' ); ?></h3>
    <div class="theme_option_field_ac_content">

      <div class="theme_option_message2">
       <p><?php _e( 'Footer bar will only be displayed at mobile device.', 'tcd-seeed' ); ?></p>
      </div>

      <h4 class="theme_option_headline2"><?php _e('Footer bar type', 'tcd-seeed'); ?></h4>
      <?php echo tcd_admin_image_radio_button($options, 'footer_bar_type', $footer_bar_type_options) ?>

      <div class="theme_option_message2 footer_bar_not_type4_option">
        <p><?php _e( 'You can display the button with icon. (We recommend you to set max 4 buttons.)', 'tcd-seeed' ); ?></p>
      </div>
      <div class="theme_option_message2 footer_bar_type4_option">
        <p><?php _e( 'Simple buttons without icons can be displayed. (We recommend you to set max 2 buttons.)', 'tcd-seeed' ); ?></p>
      </div>

      <h4 class="theme_option_headline2"><?php _e('Settings for the contents of the footer bar', 'tcd-seeed'); ?></h4>
      <div class="theme_option_message" style="margin-top:10px;">
        <p><?php _e( 'Click "Add item", and set the button for footer bar. You can drag the item to change their order.', 'tcd-seeed' ); ?></p>
      </div>
        
      <div class="repeater-wrapper">
        <input type="hidden" name="dp_options[footer_bar_btns]" value="">
        <div class="repeater sortable" data-delete-confirm="<?php _e('Delete?', 'tcd-seeed'); ?>">
          <?php
                if ( $options['footer_bar_btns'] ) :
                  foreach ( $options['footer_bar_btns'] as $key => $value ) :  
          ?>
          <div class="sub_box repeater-item repeater-item-<?php echo esc_attr( $key ); ?>">
            <h4 class="theme_option_subbox_headline"><?php echo esc_attr( $value['label'] ); ?></h4>
            <div class="sub_box_content">

              <h4 class="theme_option_headline2"><?php _e('Button type', 'tcd-seeed'); ?></h4>
              <?php foreach ( $footer_bar_button_options as $option ) { ?>
              <span class="simple_radio_button spacer"></span>
              <input type="radio" id="footer_bar_btns_<?php echo esc_attr( $option['value'] ).'_'.esc_attr( $key ); ?>" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][type]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $value['type'], $option['value'] ); ?> />
              <label for="footer_bar_btns_<?php echo esc_attr( $option['value'] ).'_'.esc_attr( $key ); ?>"><?php echo esc_html( $option['label'] ); ?></label></br>
              <?php } ?>

              <div class="theme_option_message2 footer_bar_btns_type1_option" style="margin-top:20px;">
                <p><?php _e( 'You can set link URL.', 'tcd-seeed' ); ?></p>
              </div>
              
              <div class="theme_option_message2 footer_bar_btns_type2_option" style="margin-top:20px;">
                <p><?php _e( 'Share buttons are displayed if you tap this button.', 'tcd-seeed' ); ?></p>
              </div>
              
              <div class="theme_option_message2 footer_bar_btns_type3_option" style="margin-top:20px;">
                <p><?php _e( 'You can call this number.', 'tcd-seeed' ); ?></p>
              </div>

              <h4 class="theme_option_headline2"><?php _e('Button setting', 'tcd-seeed'); ?></h4>
              <ul class="option_list">
                <li class="cf"><span class="label"><?php _e('Label', 'tcd-seeed'); ?></span><input class="full_width repeater-label" type="text" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][label]" value="<?php echo esc_attr( $value['label'] ); ?>"></li>
                <li class="cf footer_bar_btns_type1_option">
                 <span class="label"><?php _e('URL', 'tcd-seeed'); ?></span>
                 <div class="admin_link_option">
                  <input type="text" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][url]" placeholder="https://example.com/" value="<?php esc_attr_e( $value['url'] ); ?>">
                  <input id="footer_bar_btns_target_<?php echo $key; ?>" class="admin_link_option_target" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][target]" type="checkbox" value="1" <?php checked( $value['target'], 1 ); ?>>
                  <label for="footer_bar_btns_target_<?php echo $key; ?>">&#xe920;</label>
                 </div>
                </li>
                <li class="cf footer_bar_btns_type3_option"><span class="label"><?php _e('Phone number', 'tcd-seeed'); ?></span><input class="full_width" type="text" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][number]" value="<?php echo esc_attr( $value['number'] ); ?>" placeholder="000-0000-0000"></li>
                <li class="cf footer_bar_type4_option"><span class="label"><?php _e('Background color', 'tcd-seeed'); ?></span><input class="c-color-picker" type="text" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][color]" value="<?php echo esc_attr( $value['color'] ); ?>" data-default-color="#000000"></li>
              </ul>

              <div class="footer_bar_not_type4_option footer_bar_icon_option">
               <h4 class="theme_option_headline2"><?php _e('Icon', 'tcd-seeed'); ?></h4>
               <ul class="footer_bar_icon_type">
                <?php
                     foreach( $footer_bar_icon_options as $icon => $values ):
                       $icon_code = '&#x' . $icon;
                ?>
                <li>
                 <label>
                  <input type="radio" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][icon]" value="<?php echo $icon; ?>" <?php checked( $value['icon'], $icon ); ?> />
                  <span class="icon <?php echo esc_attr($values['label']); if($values['type'] == 'google'){ echo ' google_font'; }; ?>"><?php echo $icon_code; ?></span>
                 </label>
                </li>
                <?php endforeach; ?>
                <li class="material_icon"><label><input type="radio" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][icon]" value="material_icon" <?php checked( 'material_icon', $value['icon'] ); ?>><span class="icon_label"><?php _e( 'Others', 'tcd-seeed' ); ?></span></label></li>
               </ul>
               <div class="theme_option_message2 material_icon_option">
                <p><?php _e('Please enter any icon code from Google Fonts.<br><a href="https://fonts.google.com/icons?selected=Material+Symbols+Outlined:redo:FILL@0;wght@400;GRAD@0;opsz@24" target="_blank">Click here for a list of icons from Google Fonts.</a>', 'tcd-seeed'); ?></p>
               </div>
               <input class="full_width material_icon_option" type="text" placeholder="<?php _e( 'ex: e88a', 'tcd-seeed' ); ?>" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][material_icon]" value="<?php if(isset($value['material_icon'])){ echo esc_attr( $value['material_icon'] ); }; ?>">
              </div>

              <ul class="button_list cf">
                <li><a class="close_sub_box button-ml" href="#"><?php _e('Close', 'tcd-seeed'); ?></a></li>
                <li style="float:right; margin:0;" class="delete-row"><a class="button-delete-row button-ml red_button" href="#"><?php _e('Delete item', 'tcd-seeed'); ?></a></li>
              </ul>
            </div>
          </div>
          <?php
                  endforeach;
                endif;
                $key = 'addindex';
                $value = array(
                  'type' => 'type1',
                  'label' => '',
                  'url' => '',
                  'target' => 0,
                  'number' => '',
                  'icon' => 'e80d',
                  'material_icon' => '',
                  'color' => '#000000'
                );
                ob_start();
          ?>
          <div class="sub_box repeater-item repeater-item-<?php echo $key; ?>">
            <h4 class="theme_option_subbox_headline"><?php _e('New item', 'tcd-seeed'); ?></h4>
            <div class="sub_box_content">

              <h4 class="theme_option_headline2"><?php _e('Button type', 'tcd-seeed'); ?></h4>
              <?php foreach ( $footer_bar_button_options as $option ) { ?>
              <span class="simple_radio_button spacer"></span>
              <input type="radio" id="footer_bar_btns_<?php echo esc_attr( $option['value'] ).'_'.esc_attr( $key ); ?>" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][type]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $value['type'], $option['value'] ); ?> />
              <label for="footer_bar_btns_<?php echo esc_attr( $option['value'] ).'_'.esc_attr( $key ); ?>"><?php echo esc_html( $option['label'] ); ?></label></br>
              <?php } ?>

              <div class="theme_option_message2 footer_bar_btns_type1_option" style="margin-top:20px;">
                <p><?php _e( 'You can set link URL.', 'tcd-seeed' ); ?></p>
              </div>
              
              <div class="theme_option_message2 footer_bar_btns_type2_option" style="margin-top:20px;">
                <p><?php _e( 'Share buttons are displayed if you tap this button.', 'tcd-seeed' ); ?></p>
              </div>
              
              <div class="theme_option_message2 footer_bar_btns_type3_option" style="margin-top:20px;">
                <p><?php _e( 'You can call this number.', 'tcd-seeed' ); ?></p>
              </div>

              <h4 class="theme_option_headline2"><?php _e('Button setting', 'tcd-seeed'); ?></h4>
              <ul class="option_list">
                <li class="cf"><span class="label"><?php _e('Label', 'tcd-seeed'); ?></span><input class="full_width repeater-label" type="text" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][label]" value=""></li>
                <li class="cf footer_bar_btns_type1_option">
                 <span class="label"><?php _e('URL', 'tcd-seeed'); ?></span>
                 <div class="admin_link_option">
                  <input type="text" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][url]" placeholder="https://example.com/" value="<?php esc_attr_e( $value['url'] ); ?>">
                  <input id="footer_bar_btns_target_<?php echo $key; ?>" class="admin_link_option_target" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][target]" type="checkbox" value="1" <?php checked( $value['target'], 1 ); ?>>
                  <label for="footer_bar_btns_target_<?php echo $key; ?>">&#xe920;</label>
                 </div>
                </li>
                <li class="cf footer_bar_btns_type3_option"><span class="label"><?php _e('Phone number', 'tcd-seeed'); ?></span><input class="full_width" type="text" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][number]" value="" placeholder="000-0000-0000"></li>
                <li class="cf footer_bar_type4_option"><span class="label"><?php _e('Background color', 'tcd-seeed'); ?></span><input class="c-color-picker" type="text" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][color]" value="<?php echo esc_attr( $value['color'] ); ?>" data-default-color="#000000"></li>
              </ul>

              <div class="footer_bar_not_type4_option footer_bar_icon_option">
               <h4 class="theme_option_headline2"><?php _e('Icon', 'tcd-seeed'); ?></h4>
               <ul class="footer_bar_icon_type">
                <?php
                     foreach( $footer_bar_icon_options as $icon => $values ):
                       $icon_code = '&#x' . $icon;
                ?>
                <li>
                 <label>
                  <input type="radio" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][icon]" value="<?php echo $icon; ?>" <?php checked( $value['icon'], $icon ); ?> />
                  <span class="icon <?php echo esc_attr($values['label']); if($values['type'] == 'google'){ echo ' google_font'; }; ?>"><?php echo $icon_code; ?></span>
                 </label>
                </li>
                <?php endforeach; ?>
                <li class="material_icon"><label><input type="radio" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][icon]" value="material_icon" <?php checked( 'material_icon', $value['icon'] ); ?>><span class="icon_label"><?php _e( 'Others', 'tcd-seeed' ); ?></span></label></li>
               </ul>
               <div class="theme_option_message2 material_icon_option" style="display:none;">
                <p><?php _e('Please enter any icon code from Google Fonts.<br><a href="https://fonts.google.com/icons?selected=Material+Symbols+Outlined:redo:FILL@0;wght@400;GRAD@0;opsz@24" target="_blank">Click here for a list of icons from Google Fonts.</a>', 'tcd-seeed'); ?></p>
               </div>
               <input class="full_width material_icon_option"  style="display:none;" type="text" placeholder="<?php _e( 'ex: e88a', 'tcd-seeed' ); ?>" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][material_icon]" value="<?php if(isset($value['material_icon'])){ echo esc_attr( $value['material_icon'] ); }; ?>">
              </div>

              <ul class="button_list cf">
                <li><a class="close_sub_box button-ml" href="#"><?php _e('Close', 'tcd-seeed'); ?></a></li>
                <li style="float:right; margin:0;" class="delete-row"><a class="button-delete-row button-ml red_button" href="#"><?php _e('Delete item', 'tcd-seeed'); ?></a></li>
              </ul>
            </div>
          </div>
          <?php
                $clone = ob_get_clean();
          ?>
        </div><!-- END .repeater -->
        <a href="#" class="button button-secondary button-add-row" data-clone="<?php echo esc_attr( $clone ); ?>"><?php _e('Add item', 'tcd-seeed'); ?></a>
      </div><!-- END .repeater-wrapper -->

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-seeed' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php _e('Close', 'tcd-seeed'); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->

</div><!-- END .tab-content -->

<?php
} // END add_footer_tab_panel()


// バリデーション　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_footer_theme_options_validate( $input ) {

  global $dp_default_options, $footer_bar_button_options, $footer_bar_icon_options, $footer_bar_type_options, $font_type_options, $logo_type_options;

  // お問い合わせ
  $input['footer_contact_bg_type'] = wp_filter_nohtml_kses( $input['footer_contact_bg_type'] );
  $input['footer_contact_image_slider'] = wp_filter_nohtml_kses( $input['footer_contact_image_slider'] );
  $input['footer_contact_video'] = wp_filter_nohtml_kses( $input['footer_contact_video'] );
  $input['footer_contact_image'] = wp_filter_nohtml_kses( $input['footer_contact_image'] );
  $input['footer_contact_overlay_color'] = wp_filter_nohtml_kses( $input['footer_contact_overlay_color'] );
  $input['footer_contact_overlay_opacity'] = wp_filter_nohtml_kses( $input['footer_contact_overlay_opacity'] );
  for ( $i = 1; $i <= 2; $i++ ) {
    $input['show_footer_contact'.$i] = ! empty( $input['show_footer_contact'.$i] ) ? 1 : 0;
    $input['footer_contact_title'.$i] = wp_filter_nohtml_kses( $input['footer_contact_title'.$i] );
    $input['footer_contact_desc'.$i] = wp_filter_nohtml_kses( $input['footer_contact_desc'.$i] );
    $input['footer_contact_url'.$i] = wp_filter_nohtml_kses( $input['footer_contact_url'.$i] );
    $input['footer_contact_target'.$i] = ! empty( $input['footer_contact_target'.$i] ) ? 1 : 0;
    $input['footer_contact_icon'.$i] = wp_filter_nohtml_kses( $input['footer_contact_icon'.$i] );
    $input['footer_contact_icon_image'.$i] = wp_filter_nohtml_kses( $input['footer_contact_icon_image'.$i] );
  }


  // キャッチコピー
  $input['footer_catch'] = wp_kses_post($input['footer_catch']);


  // コピーライト
  $input['copyright'] = wp_kses_post($input['copyright']);


  // スマホ用固定フッターバーの設定
  if ( ! isset( $input['footer_bar_type'] ) || ! array_key_exists( $input['footer_bar_type'], $footer_bar_type_options ) )
    $input['footer_bar_type'] = $dp_default_options['footer_bar_type'];

  $footer_bar_btns = array();
  if ( isset( $input['footer_bar_btns'] ) && is_array( $input['footer_bar_btns'] ) ) {
    foreach ( $input['footer_bar_btns'] as $key => $value ) {
      $footer_bar_btns[] = array(
        'type' => ( isset( $input['footer_bar_btns'][$key]['type'] ) && array_key_exists( $input['footer_bar_btns'][$key]['type'], $footer_bar_button_options ) ) ? $input['footer_bar_btns'][$key]['type'] : 'type1',
        'label' => isset( $input['footer_bar_btns'][$key]['label'] ) ? wp_filter_nohtml_kses( $input['footer_bar_btns'][$key]['label'] ) : '',
        'url' => isset( $input['footer_bar_btns'][$key]['url'] ) ? wp_filter_nohtml_kses( $input['footer_bar_btns'][$key]['url'] ) : '',
        'target' => ! empty( $input['footer_bar_btns'][$key]['target'] ) ? 1 : 0,
        'number' => isset( $input['footer_bar_btns'][$key]['number'] ) ? wp_filter_nohtml_kses( $input['footer_bar_btns'][$key]['number'] ) : '',
        'color' => isset( $input['footer_bar_btns'][$key]['color'] ) ? sanitize_hex_color( $input['footer_bar_btns'][$key]['color'] ) : '',
        'icon' => isset( $input['footer_bar_btns'][$key]['icon'] ) ? wp_filter_nohtml_kses( $input['footer_bar_btns'][$key]['icon'] ) : 'e80d',
        'material_icon' => isset( $input['footer_bar_btns'][$key]['material_icon'] ) ? wp_filter_nohtml_kses( $input['footer_bar_btns'][$key]['material_icon'] ) : '',
      );
    };
  };
  $input['footer_bar_btns'] = $footer_bar_btns;


	return $input;

};


?>