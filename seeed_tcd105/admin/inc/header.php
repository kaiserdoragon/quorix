<?php
/*
 * ヘッダーの設定
 */


// Add default values
add_filter( 'before_getting_design_plus_option', 'add_header_dp_default_options' );


// Add label of logo tab
add_action( 'tcd_tab_labels', 'add_header_tab_label' );


// Add HTML of logo tab
add_action( 'tcd_tab_panel', 'add_header_tab_panel' );


// Register sanitize function
add_filter( 'theme_options_validate', 'add_header_theme_options_validate' );


// タブの名前
function add_header_tab_label( $tab_labels ) {
	$tab_labels['header'] = __( 'Header', 'tcd-seeed' );
	return $tab_labels;
}


// 初期値
function add_header_dp_default_options( $dp_default_options ) {

  $main_color = $dp_default_options['main_color'];

  $dp_default_options['header_type'] = 'type1';

  //ボタン
	$dp_default_options['header_button_label'] = __('Button', 'tcd-seeed');
  $dp_default_options['header_button_url'] = '#';
  $dp_default_options['header_button_target'] = '';

  // メガメニュー
  $dp_default_options['megamenu_new'] = array();
	$dp_default_options['megamenu_a_post_type'] = 'recent_post';
	$dp_default_options['megamenu_a_post_order'] = 'date';
	$dp_default_options['megamenu_a_post_num'] = '6';

	$dp_default_options['megamenu_b_post_type'] = 'recent_post';
	$dp_default_options['megamenu_b_post_order'] = 'date';
	$dp_default_options['megamenu_b_post_num'] = '6';

	$dp_default_options['megamenu_c_post_num'] = '6';
	$dp_default_options['megamenu_c_post_order'] = 'date';

	$dp_default_options['megamenu_d_post_num'] = '6';
	$dp_default_options['megamenu_d_post_order'] = 'date';

  // メッセージ
	$dp_default_options['show_header_message'] = 'hide';
	$dp_default_options['header_message'] = __('Header message', 'tcd-seeed');
  $dp_default_options['header_message_url'] = '';
  $dp_default_options['header_message_target'] = '';
  $dp_default_options['header_message_font_color'] = '#ffffff';
  $dp_default_options['header_message_bg_color'] = $main_color;

	return $dp_default_options;

}


// 入力欄の出力　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_header_tab_panel( $options ) {

  global $blog_label, $dp_default_options, $basic_display_options, $bool_options, $logo_type_options, $font_type_options, $header_type_options;

  $news_label = $options['news_label'] ? esc_html( $options['news_label'] ) : __( 'News', 'tcd-seeed' );
  $case_study_label = $options['case_study_label'] ? esc_html( $options['case_study_label'] ) : __( 'Case study', 'tcd-seeed' );
  $service_label = $options['service_label'] ? esc_html( $options['service_label'] ) : __( 'Service', 'tcd-seeed' );

  $main_color = $options['main_color'];

?>

<div id="tab-content-header" class="tab-content">


   <?php // メッセージ ----------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Header message', 'tcd-seeed');  ?></h3>
    <div class="theme_option_field_ac_content">

     <div class="front_page_image">
      <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/header_message_image.jpg?2.0" alt="" title="" />
     </div>

     <div class="theme_option_message2">
      <p><?php _e('The "header message" is displayed at the top of the site (above the header bar).', 'tcd-seeed'); ?></br>
      <?php _e('If you are using LP template, you can set display setting individually from page edit screen.', 'tcd-seeed'); ?></p>
     </div>

     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Header message', 'tcd-seeed');  ?></span><?php echo tcd_basic_radio_button($options, 'show_header_message', $basic_display_options); ?></li>
      <li class="cf"><span class="label"><?php _e('Message', 'tcd-seeed');  ?></span><textarea class="full_width" cols="50" rows="2" name="dp_options[header_message]"><?php echo esc_textarea( $options['header_message'] ); ?></textarea></li>
      <li class="cf">
       <span class="label"><?php _e('URL', 'tcd-seeed'); ?></span>
       <div class="admin_link_option">
        <input type="text" name="dp_options[header_message_url]" placeholder="https://example.com/" value="<?php echo esc_attr( $options['header_message_url'] ); ?>">
        <input id="header_message_target" class="admin_link_option_target" name="dp_options[header_message_target]" type="checkbox" value="1" <?php checked( $options['header_message_target'], 1 ); ?>>
        <label for="header_message_target">&#xe920;</label>
       </div>
      </li>
      <li class="cf color_picker_bottom"><span class="label"><?php echo tcd_admin_label('color'); ?></span><input type="text" name="dp_options[header_message_font_color]" value="<?php echo esc_attr( $options['header_message_font_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
      <li class="cf color_picker_bottom"><span class="label"><?php echo tcd_admin_label('bg_color'); ?></span><input type="text" name="dp_options[header_message_bg_color]" value="<?php echo esc_attr( $options['header_message_bg_color'] ); ?>" data-default-color="<?php echo esc_attr($main_color); ?>" class="c-color-picker"></li>
     </ul>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo tcd_admin_label('save'); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo tcd_admin_label('close'); ?></a></li>
     </ul>

    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // 基本設定 ----------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Header bar', 'tcd-seeed');  ?></h3>
    <div class="theme_option_field_ac_content tab_parent">

     <?php // デザイン ----------------------------------------------------------------- ?>
     <h4 class="theme_option_headline2"><?php _e( 'Design', 'tcd-seeed' ); ?></h4>
     <?php echo tcd_admin_image_radio_button($options, 'header_type', $header_type_options) ?>

     <?php // ロゴ ----------------------------------------------------------------- ?>
     <h4 class="theme_option_headline2"><?php _e( 'Logo', 'tcd-seeed' ); ?></h4>
     <div class="theme_option_message2">
      <p><?php echo __('You can set logo from "Basic Settings" logo section.', 'tcd-seeed'); ?></p>
     </div>

     <?php // メニュー ----------------------------------------------------------------- ?>
     <h4 class="theme_option_headline2"><?php _e( 'Menu', 'tcd-seeed' ); ?></h4>
     <div class="theme_option_message2">
      <p><?php echo __('You can set menu from <a href="./nav-menus.php">custom menu</a> page.', 'tcd-seeed'); ?></p>
     </div>

     <?php // ボタン ----------------------------------------------------------------- ?>
     <h4 class="theme_option_headline2"><?php _e('Button', 'tcd-seeed');  ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Label', 'tcd-seeed');  ?></span><input class="full_width" type="text" placeholder="<?php _e( 'e.g.', 'tcd-seeed' ); _e( 'Invoice', 'tcd-seeed' ); ?>" name="dp_options[header_button_label]" value="<?php echo esc_textarea( $options['header_button_label'] ); ?>" /></li>
      <li class="cf">
       <span class="label"><?php _e('URL', 'tcd-seeed'); ?></span>
       <div class="admin_link_option">
        <input type="text" name="dp_options[header_button_url]" placeholder="https://example.com/" value="<?php echo esc_attr( $options['header_button_url'] ); ?>">
        <input id="header_button_target" class="admin_link_option_target" name="dp_options[header_button_target]" type="checkbox" value="1" <?php checked( $options['header_button_target'], 1 ); ?>>
        <label for="header_button_target">&#xe920;</label>
       </div>
      </li>
     </ul>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-seeed' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-seeed' ); ?></a></li>
     </ul>

    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // メガメニュー ---------------------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Mega menu', 'tcd-seeed');  ?></h3>
    <div class="theme_option_field_ac_content tab_parent">

     <ul class="megamenu_image clearfix">
      <li>
       <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/megamenu1.jpg" alt="" title="" />
       <p><?php _e('Normal menu', 'tcd-seeed'); ?></p>
      </li>
      <li>
       <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/megamenu2.jpg" alt="" title="" />
       <p><?php _e('Mega menu (carousel)', 'tcd-seeed'); ?></p>
      </li>
     </ul>

     <?php
          $menu_locations = get_nav_menu_locations();
          $nav_menus = wp_get_nav_menus();
          $global_nav_items = array();
          if ( isset( $menu_locations['global-menu'] ) ) {
            foreach ( (array) $nav_menus as $menu ) {
              if ( $menu_locations['global-menu'] === $menu->term_id ) {
                $global_nav_items = wp_get_nav_menu_items( $menu );
                break;
              }
            }
          }
     ?>
     <h4 class="theme_option_headline2 megamenu_option"><?php _e('Menu type', 'tcd-seeed'); ?></h4>
     <div class="theme_option_message2 megamenu_option">
      <p><?php printf(__('Mega menu (carousel) can be activated when the following pages are registered on the <a href="./nav-menus.php" target="_blank">menu screen</a>.<br></br>%s archive page (blog archive page)<br>%s archive page<br>%s archive page<br>%s archive page', 'tcd-seeed'), $blog_label, $news_label, $case_study_label, $service_label); ?></p>
     </div>
     <ul class="option_list megamenu_option">
      <?php
           $i = 1;
           $megamenu_a_flag = true;
           $megamenu_b_flag = true;
           $megamenu_c_flag = true;
           $megamenu_d_flag = true;
           foreach ( $global_nav_items as $item ) :
             if ( $item->menu_item_parent ) continue;
             // ブログ
             if( $megamenu_a_flag && ( $item->url == get_permalink(get_option('page_for_posts')) ) ){
               $value = isset( $options['megamenu_new'][$item->ID] ) ? $options['megamenu_new'][$item->ID] : 'dropdown';
               $megamenu_a_flag = false;
      ?>
      <li class="cf">
       <span class="label"><?php echo esc_html( $item->title ); ?></span>
       <div class="standard_radio_button">
        <input id="use_megamenu_a_no_<?php echo $item->ID . $i; ?>" type="radio" name="dp_options[megamenu_new][<?php echo $item->ID; ?>]" value="dropdown" <?php checked( $value, 'dropdown' ); ?> >
        <label for="use_megamenu_a_no_<?php echo $item->ID . $i; ?>"><?php _e('Normal menu', 'tcd-seeed'); ?></label>
        <input id="use_megamenu_a_yes_<?php echo $item->ID . $i; ?>" type="radio" name="dp_options[megamenu_new][<?php echo $item->ID; ?>]" value="use_megamenu_a" <?php checked( $value, 'use_megamenu_a' ); ?>>
        <label for="use_megamenu_a_yes_<?php echo $item->ID . $i; ?>"><?php _e('Mega menu', 'tcd-seeed'); ?></label>
       </div>
      </li>
      <?php
             // お知らせ
             } elseif( $megamenu_b_flag && ( $item->url == get_post_type_archive_link('news') ) ){
               $value = isset( $options['megamenu_new'][$item->ID] ) ? $options['megamenu_new'][$item->ID] : 'dropdown';
               $megamenu_b_flag = false;
      ?>
      <li class="cf">
       <span class="label"><?php echo esc_html( $item->title ); ?></span>
       <div class="standard_radio_button">
        <input id="use_megamenu_b_no_<?php echo $item->ID . $i; ?>" type="radio" name="dp_options[megamenu_new][<?php echo $item->ID; ?>]" value="dropdown" <?php checked( $value, 'dropdown' ); ?> >
        <label for="use_megamenu_b_no_<?php echo $item->ID . $i; ?>"><?php _e('Normal menu', 'tcd-seeed'); ?></label>
        <input id="use_megamenu_b_yes_<?php echo $item->ID . $i; ?>" type="radio" name="dp_options[megamenu_new][<?php echo $item->ID; ?>]" value="use_megamenu_b" <?php checked( $value, 'use_megamenu_b' ); ?>>
        <label for="use_megamenu_b_yes_<?php echo $item->ID . $i; ?>"><?php _e('Mega menu', 'tcd-seeed'); ?></label>
       </div>
      </li>
      <?php
             // 事例
             } elseif( $megamenu_c_flag && ( $item->url == get_post_type_archive_link('case_study') ) ){
               $value = isset( $options['megamenu_new'][$item->ID] ) ? $options['megamenu_new'][$item->ID] : 'dropdown';
               $megamenu_c_flag = false;
      ?>
      <li class="cf">
       <span class="label"><?php echo esc_html( $item->title ); ?></span>
       <div class="standard_radio_button">
        <input id="use_megamenu_c_no_<?php echo $item->ID . $i; ?>" type="radio" name="dp_options[megamenu_new][<?php echo $item->ID; ?>]" value="dropdown" <?php checked( $value, 'dropdown' ); ?> >
        <label for="use_megamenu_c_no_<?php echo $item->ID . $i; ?>"><?php _e('Normal menu', 'tcd-seeed'); ?></label>
        <input id="use_megamenu_c_yes_<?php echo $item->ID . $i; ?>" type="radio" name="dp_options[megamenu_new][<?php echo $item->ID; ?>]" value="use_megamenu_c" <?php checked( $value, 'use_megamenu_c' ); ?>>
        <label for="use_megamenu_c_yes_<?php echo $item->ID . $i; ?>"><?php _e('Mega menu', 'tcd-seeed'); ?></label>
       </div>
      </li>
      <?php
             // サービス
             } elseif( $megamenu_d_flag && ( $item->url == get_post_type_archive_link('service') ) ){
               $value = isset( $options['megamenu_new'][$item->ID] ) ? $options['megamenu_new'][$item->ID] : 'dropdown';
               $megamenu_d_flag = false;
      ?>
      <li class="cf">
       <span class="label"><?php echo esc_html( $item->title ); ?></span>
       <div class="standard_radio_button">
        <input id="use_megamenu_d_no_<?php echo $item->ID . $i; ?>" type="radio" name="dp_options[megamenu_new][<?php echo $item->ID; ?>]" value="dropdown" <?php checked( $value, 'dropdown' ); ?> >
        <label for="use_megamenu_d_no_<?php echo $item->ID . $i; ?>"><?php _e('Normal menu', 'tcd-seeed'); ?></label>
        <input id="use_megamenu_d_yes_<?php echo $item->ID . $i; ?>" type="radio" name="dp_options[megamenu_new][<?php echo $item->ID; ?>]" value="use_megamenu_d" <?php checked( $value, 'use_megamenu_d' ); ?>>
        <label for="use_megamenu_d_yes_<?php echo $item->ID . $i; ?>"><?php _e('Mega menu', 'tcd-seeed'); ?></label>
       </div>
      </li>
      <?php
             }
             $i++;
           endforeach;
      ?>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Mega menu (carousel)', 'tcd-seeed'); ?></h4>
     <div class="sub_box_tab">
      <div class="tab active" data-tab="tab1"><?php printf(__('%s carousel', 'tcd-seeed'), $blog_label); ?></div>
      <div class="tab" data-tab="tab2"><?php printf(__('%s carousel', 'tcd-seeed'), $news_label); ?></div>
      <div class="tab" data-tab="tab3"><?php printf(__('%s carousel', 'tcd-seeed'), $case_study_label); ?></div>
      <div class="tab" data-tab="tab4"><?php printf(__('%s carousel', 'tcd-seeed'), $service_label); ?></div>
     </div>

     <?php // ブログカルーセル ?>
     <div class="sub_box_tab_content active" data-tab-content="tab1">
     <ul class="option_list">
      <li class="cf">
       <span class="label"><?php _e('Post type', 'tcd-seeed');  ?></span>
       <div class="standard_radio_button">
        <input id="megamenu_a_post_type1" type="radio" name="dp_options[megamenu_a_post_type]" value="recent_post" <?php checked( $options['megamenu_a_post_type'], 'recent_post' ); ?>>
        <label for="megamenu_a_post_type1"><?php _e('Recent post', 'tcd-seeed'); ?></label>
        <input id="megamenu_a_post_type2" type="radio" name="dp_options[megamenu_a_post_type]" value="recommend_post" <?php checked( $options['megamenu_a_post_type'], 'recommend_post' ); ?>>
        <label for="megamenu_a_post_type2"><?php _e('Recommend post', 'tcd-seeed'); ?>1</label>
        <input id="megamenu_a_post_type3" type="radio" name="dp_options[megamenu_a_post_type]" value="recommend_post2" <?php checked( $options['megamenu_a_post_type'], 'recommend_post2' ); ?>>
        <label for="megamenu_a_post_type3"><?php _e('Recommend post', 'tcd-seeed'); ?>2</label>
        <input id="megamenu_a_post_type4" type="radio" name="dp_options[megamenu_a_post_type]" value="recommend_post3" <?php checked( $options['megamenu_a_post_type'], 'recommend_post3' ); ?>>
        <label for="megamenu_a_post_type4"><?php _e('Recommend post', 'tcd-seeed'); ?>3</label>
       </div>
      </li>
      <li class="cf">
       <span class="label"><?php _e('Post order', 'tcd-seeed');  ?></span>
       <div class="standard_radio_button">
        <input id="megamenu_a_post_order1" type="radio" name="dp_options[megamenu_a_post_order]" value="date" <?php checked( $options['megamenu_a_post_order'], 'date' ); ?>>
        <label for="megamenu_a_post_order1"><?php _e('Date', 'tcd-seeed'); ?></label>
        <input id="megamenu_a_post_order2" type="radio" name="dp_options[megamenu_a_post_order]" value="rand" <?php checked( $options['megamenu_a_post_order'], 'rand' ); ?>>
        <label for="megamenu_a_post_order2"><?php _e('Random', 'tcd-seeed'); ?></label>
       </div>
      </li>
      <li class="cf"><span class="label"><?php _e('Number of post to display', 'tcd-seeed'); ?></span><input class="hankaku" style="width:70px;" type="number" step="1" name="dp_options[megamenu_a_post_num]" value="<?php echo esc_attr( $options['megamenu_a_post_num'] ); ?>" /></li>
     </ul>
     </div><!-- END .sub_box_tab_content -->

     <?php // お知らせカルーセル ?>
     <div class="sub_box_tab_content" data-tab-content="tab2">
     <ul class="option_list">
      <li class="cf">
       <span class="label"><?php _e('Post type', 'tcd-seeed');  ?></span>
       <div class="standard_radio_button">
        <input id="megamenu_b_post_type1" type="radio" name="dp_options[megamenu_b_post_type]" value="recent_post" <?php checked( $options['megamenu_b_post_type'], 'recent_post' ); ?>>
        <label for="megamenu_b_post_type1"><?php _e('Recent post', 'tcd-seeed'); ?></label>
        <input id="megamenu_b_post_type2" type="radio" name="dp_options[megamenu_b_post_type]" value="recommend_post" <?php checked( $options['megamenu_b_post_type'], 'recommend_post' ); ?>>
        <label for="megamenu_b_post_type2"><?php _e('Recommend post', 'tcd-seeed'); ?>1</label>
        <input id="megamenu_b_post_type3" type="radio" name="dp_options[megamenu_b_post_type]" value="recommend_post2" <?php checked( $options['megamenu_b_post_type'], 'recommend_post2' ); ?>>
        <label for="megamenu_b_post_type3"><?php _e('Recommend post', 'tcd-seeed'); ?>2</label>
        <input id="megamenu_b_post_type4" type="radio" name="dp_options[megamenu_b_post_type]" value="recommend_post3" <?php checked( $options['megamenu_b_post_type'], 'recommend_post3' ); ?>>
        <label for="megamenu_b_post_type4"><?php _e('Recommend post', 'tcd-seeed'); ?>3</label>
       </div>
      </li>
      <li class="cf">
       <span class="label"><?php _e('Post order', 'tcd-seeed');  ?></span>
       <div class="standard_radio_button">
        <input id="megamenu_b_post_order1" type="radio" name="dp_options[megamenu_b_post_order]" value="date" <?php checked( $options['megamenu_b_post_order'], 'date' ); ?>>
        <label for="megamenu_b_post_order1"><?php _e('Date', 'tcd-seeed'); ?></label>
        <input id="megamenu_b_post_order2" type="radio" name="dp_options[megamenu_b_post_order]" value="rand" <?php checked( $options['megamenu_b_post_order'], 'rand' ); ?>>
        <label for="megamenu_b_post_order2"><?php _e('Random', 'tcd-seeed'); ?></label>
       </div>
      </li>
      <li class="cf"><span class="label"><?php _e('Number of post to display', 'tcd-seeed'); ?></span><input class="hankaku" style="width:70px;" type="number" step="1" name="dp_options[megamenu_b_post_num]" value="<?php echo esc_attr( $options['megamenu_b_post_num'] ); ?>" /></li>
     </ul>
     </div><!-- END .sub_box_tab_content -->

     <?php // 事例カルーセル ?>
     <div class="sub_box_tab_content" data-tab-content="tab3">
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Number of post to display', 'tcd-seeed'); ?></span><input class="hankaku" style="width:70px;" type="number" step="1" name="dp_options[megamenu_c_post_num]" value="<?php echo esc_attr( $options['megamenu_c_post_num'] ); ?>" /></li>
      <li class="cf">
       <span class="label"><?php _e('Post order', 'tcd-seeed');  ?></span>
       <div class="standard_radio_button">
        <input id="megamenu_c_post_order1" type="radio" name="dp_options[megamenu_c_post_order]" value="date" <?php checked( $options['megamenu_c_post_order'], 'date' ); ?>>
        <label for="megamenu_c_post_order1"><?php _e('Normal', 'tcd-seeed'); ?></label>
        <input id="megamenu_c_post_order2" type="radio" name="dp_options[megamenu_c_post_order]" value="rand" <?php checked( $options['megamenu_c_post_order'], 'rand' ); ?>>
        <label for="megamenu_c_post_order2"><?php _e('Random', 'tcd-seeed'); ?></label>
       </div>
       <div class="theme_option_message2" style="clear:both; margin:37px 0 0 0;">
        <p><?php _e('Normal = Management screen order. You can rearrange them by dragging and dropping within the <a href="./edit.php?post_type=case_study" target="_blank">management screen</a>.', 'tcd-seeed'); ?></p>
       </div>
      </li>
     </ul>
     </div><!-- END .sub_box_tab_content -->

     <?php // サービスカルーセル ?>
     <div class="sub_box_tab_content" data-tab-content="tab4">
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Number of post to display', 'tcd-seeed'); ?></span><input class="hankaku" style="width:70px;" type="number" step="1" name="dp_options[megamenu_d_post_num]" value="<?php echo esc_attr( $options['megamenu_d_post_num'] ); ?>" /></li>
      <li class="cf">
       <span class="label"><?php _e('Post order', 'tcd-seeed');  ?></span>
       <div class="standard_radio_button">
        <input id="megamenu_d_post_order1" type="radio" name="dp_options[megamenu_d_post_order]" value="date" <?php checked( $options['megamenu_d_post_order'], 'date' ); ?>>
        <label for="megamenu_d_post_order1"><?php _e('Normal', 'tcd-seeed'); ?></label>
        <input id="megamenu_d_post_order2" type="radio" name="dp_options[megamenu_d_post_order]" value="rand" <?php checked( $options['megamenu_d_post_order'], 'rand' ); ?>>
        <label for="megamenu_d_post_order2"><?php _e('Random', 'tcd-seeed'); ?></label>
       </div>
       <div class="theme_option_message2" style="clear:both; margin:37px 0 0 0;">
        <p><?php _e('Normal = Management screen order. You can rearrange them by dragging and dropping within the <a href="./edit.php?post_type=service" target="_blank">management screen</a>.', 'tcd-seeed'); ?></p>
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


</div><!-- END .tab-content -->

<?php
} // END add_header_tab_panel()


// バリデーション　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_header_theme_options_validate( $input ) {

  global $dp_default_options, $logo_type_options;


  $input['header_type'] = wp_filter_nohtml_kses( $input['header_type'] );


  // ボタン
  $input['header_button_label'] = wp_filter_nohtml_kses( $input['header_button_label'] );
  $input['header_button_url'] = wp_filter_nohtml_kses( $input['header_button_url'] );
  $input['header_button_target'] = wp_filter_nohtml_kses( $input['header_button_target'] );


  // メガメニュー
  $new_megamenu_options = array(
    'dropdown' => array('value' => 'dropdown'),
    'use_megamenu_a' => array('value' => 'use_megamenu_a'),
    'use_megamenu_b' => array('value' => 'use_megamenu_b'),
    'use_megamenu_c' => array('value' => 'use_megamenu_c'),
    'use_megamenu_d' => array('value' => 'use_megamenu_d'),
  );
  foreach ( array_keys( $input['megamenu_new'] ) as $index ) {
    if ( ! array_key_exists( $input['megamenu_new'][$index], $new_megamenu_options ) ) {
      $input['megamenu_new'][$index] = null;
    }
  }

  $input['megamenu_a_post_type'] = wp_filter_nohtml_kses( $input['megamenu_a_post_type'] );
  $input['megamenu_a_post_order'] = wp_filter_nohtml_kses( $input['megamenu_a_post_order'] );
  $input['megamenu_a_post_num'] = wp_filter_nohtml_kses( $input['megamenu_a_post_num'] );

  $input['megamenu_b_post_type'] = wp_filter_nohtml_kses( $input['megamenu_b_post_type'] );
  $input['megamenu_b_post_order'] = wp_filter_nohtml_kses( $input['megamenu_b_post_order'] );
  $input['megamenu_b_post_num'] = wp_filter_nohtml_kses( $input['megamenu_b_post_num'] );

  $input['megamenu_c_post_num'] = wp_filter_nohtml_kses( $input['megamenu_c_post_num'] );
  $input['megamenu_c_post_order'] = wp_filter_nohtml_kses( $input['megamenu_c_post_order'] );

  $input['megamenu_d_post_num'] = wp_filter_nohtml_kses( $input['megamenu_d_post_num'] );
  $input['megamenu_d_post_order'] = wp_filter_nohtml_kses( $input['megamenu_d_post_order'] );


  // メッセージ
  $input['show_header_message'] = wp_filter_nohtml_kses( $input['show_header_message'] );
  $input['header_message'] = wp_filter_nohtml_kses( $input['header_message'] );
  $input['header_message_url'] = wp_filter_nohtml_kses( $input['header_message_url'] );
  $input['header_message_target'] = wp_filter_nohtml_kses( $input['header_message_target'] );
  $input['header_message_font_color'] = sanitize_hex_color( $input['header_message_font_color'] );
  $input['header_message_bg_color'] = sanitize_hex_color( $input['header_message_bg_color'] );


  return $input;

};


?>