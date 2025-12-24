<?php
/*
 * ブログの設定
 */


// Add default values
add_filter( 'before_getting_design_plus_option', 'add_blog_dp_default_options' );


//  Add label of blog tab
add_action( 'tcd_tab_labels', 'add_blog_tab_label' );


// Add HTML of blog tab
add_action( 'tcd_tab_panel', 'add_blog_tab_panel' );


// Register sanitize function
add_filter( 'theme_options_validate', 'add_blog_theme_options_validate' );


// タブの名前
function add_blog_tab_label( $tab_labels ) {
	$tab_labels['blog'] = __( 'Post', 'tcd-seeed' );
	return $tab_labels;
}


// 初期値
function add_blog_dp_default_options( $dp_default_options ) {

	// 基本設定
	$dp_default_options['blog_show_date'] = 'display';

	// アーカイブページ
	$dp_default_options['archive_blog_headline'] = __( 'Blog', 'tcd-seeed' );
	$dp_default_options['archive_blog_desc'] = __( 'Description will be displayed here.', 'tcd-seeed' );
	$dp_default_options['archive_blog_desc_mobile'] = '';
	$dp_default_options['archive_blog_header_image'] = false;
	$dp_default_options['archive_blog_overlay_color'] = '#000000';
	$dp_default_options['archive_blog_overlay_opacity'] = '0.3';
    $dp_default_options['archive_blog_show_cat_list'] = 'display';

	// 詳細ページ
	$dp_default_options['single_blog_show_sns'] = 'top';
	$dp_default_options['single_blog_show_copy'] = 'top';
	$dp_default_options['single_blog_show_tag_list'] = 'display';

	// 関連記事
	$dp_default_options['related_post_headline'] = __( 'Related post', 'tcd-seeed' );
	$dp_default_options['related_post_num'] = '3';
	$dp_default_options['related_post_num_sp'] = '3';

	// 記事ページの追加コンテンツ
	$dp_default_options['single_top_ad_code'] = '';
	$dp_default_options['single_top_ad_code_mobile'] = '';
	$dp_default_options['single_bottom_ad_code'] = '';
	$dp_default_options['single_bottom_ad_code_mobile'] = '';

	return $dp_default_options;

}


// 入力欄の出力　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_blog_tab_panel( $options ) {

  global $blog_label, $dp_default_options, $font_type_options, $basic_display_options, $single_page_display_options;

?>

<div id="tab-content-blog" class="tab-content">

   <?php // 基本設定 -------------------------------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Common setting', 'tcd-seeed');  ?></h3>
    <div class="theme_option_field_ac_content">

     <?php
          $blog_page_id = get_option( 'page_for_posts' );
          if($blog_page_id) {
     ?>

     <div class="front_page_image">
      <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/content_name_url.jpg" alt="" title="" />
     </div>

     <h4 class="theme_option_headline_number"><span class="num">1</span><?php _e('Name of content', 'tcd-seeed'); ?></h4>
     <div class="theme_option_message2">
      <p><?php printf(__('Title that are set on the <a href="post.php?post=%s&action=edit" target="_blank">post page</a> will affect to breadcrumb link name.', 'tcd-seeed'), $blog_page_id); ?></p>
     </div>

     <h4 class="theme_option_headline_number"><span class="num">2</span><?php _e('Slug', 'tcd-seeed'); ?></h4>
     <div class="theme_option_message2">
      <p><?php printf(__('Permalinks that are set on the <a href="post.php?post=%s&action=edit" target="_blank">post page</a> will affect to blog page URL.', 'tcd-seeed'), $blog_page_id); ?></p>
     </div>

     <?php } else { ?>

     <div class="theme_option_message2">
      <p><?php _e('After creating the blog page by <a href="./edit.php?post_type=page" target="_blank">WP-page</a>, please register the page as a blog from the <a href="./options-reading.php" target="_blank">display settings page</a>.', 'tcd-seeed'); ?></p>
     </div>

     <?php }; ?>

     <h4 class="theme_option_headline2"><?php _e('Date', 'tcd-seeed');  ?></h4>
     <div class="clearfix"><?php echo tcd_basic_radio_button($options, 'blog_show_date', $basic_display_options); ?></div>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-seeed' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-seeed' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // アーカイブページ ----------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Archive page', 'tcd-seeed'); ?></h3>
    <div class="theme_option_field_ac_content">

     <div class="front_page_image">
      <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/blog_archive_image.jpg" alt="" title="" />
     </div>

     <div class="theme_option_message2" style="margin-top:20px;">
      <?php
           if($blog_page_id) {
             $blog_page_url = get_page_link( $blog_page_id );
             if($blog_page_url){
      ?>
      <p><?php _e('URL of the post archive page:', 'tcd-seeed'); ?><a class="e_link" href="<?php echo esc_url($blog_page_url) ?>" target="_blank"><?php echo esc_url($blog_page_url) ?></a></p>
      <?php
             };
           } else {
      ?>
      <p><?php _e('The page for the post archive page is not set.', 'tcd-seeed'); ?>
         <?php _e('Please refer to the <a href="https://tcd-theme.com/2022/07/wordpress-homepage.html" target="_blank">manual</a> to create and configure.', 'tcd-seeed'); ?></p>
      <?php } ?>
      <p><?php printf(__('The number of posts displayed in %s archive page can be set from "Settings > Display Settings > Maximum number of posts per page".<br>Click <a href="./options-reading.php" target="_blank">here</a> for display settings', 'tcd-seeed'), $blog_label); ?></p>
      <p><?php printf(__('Header image also will be displayed in %s page.', 'tcd-seeed'), $blog_label); ?></p>
     </div>

     <ul class="option_list">
      <li class="cf"><span class="label"><span class="num">1</span><?php _e('Headline', 'tcd-seeed'); ?></span><input type="text" class="full_width" name="dp_options[archive_blog_headline]" value="<?php echo esc_attr($options['archive_blog_headline']); ?>" ></li>
      <li class="cf"><span class="label"><span class="num">2</span><?php _e('Description', 'tcd-seeed'); ?></span><textarea class="full_width" cols="50" rows="3" name="dp_options[archive_blog_desc]"><?php echo esc_textarea(  $options['archive_blog_desc'] ); ?></textarea></li>
      <li class="cf" style="border:none;"><span class="label"><span class="num_space"></span><?php _e('Description (mobile)', 'tcd-seeed'); ?></span><textarea placeholder="<?php _e( 'Please indicate if you would like to display a short text for mobile sizes.', 'tcd-seeed' ); ?>" class="full_width" cols="50" rows="3" name="dp_options[archive_blog_desc_mobile]"><?php echo esc_textarea(  $options['archive_blog_desc_mobile'] ); ?></textarea></li>
      <li class="cf">
       <span class="label">
        <span class="num">3</span><?php _e('Image', 'tcd-seeed'); ?>
        <span class="recommend_desc space"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-seeed'), '1450', '400'); ?></span>
        <span class="recommend_desc space"><?php _e('This image will also be used in article page.', 'tcd-seeed'); ?></span>
       </span>
       <div class="image_box cf">
        <div class="cf cf_media_field hide-if-no-js archive_blog_header_image">
         <input type="hidden" value="<?php echo esc_attr( $options['archive_blog_header_image'] ); ?>" id="archive_blog_header_image" name="dp_options[archive_blog_header_image]" class="cf_media_id">
         <div class="preview_field"><?php if($options['archive_blog_header_image']){ echo wp_get_attachment_image($options['archive_blog_header_image'], 'medium'); }; ?></div>
         <div class="buttton_area">
          <input type="button" value="<?php _e('Select Image', 'tcd-seeed'); ?>" class="cfmf-select-img button">
          <input type="button" value="<?php _e('Remove Image', 'tcd-seeed'); ?>" class="cfmf-delete-img button <?php if(!$options['archive_blog_header_image']){ echo 'hidden'; }; ?>">
         </div>
        </div>
       </div>
      </li>
      <li class="cf" style="border:none;">
       <span class="label"><span class="num_space"></span><?php _e('Color of overlay', 'tcd-seeed'); ?></span><input type="text" name="dp_options[archive_blog_overlay_color]" value="<?php echo esc_attr( $options['archive_blog_overlay_color'] ); ?>" data-default-color="#000000" class="c-color-picker">
       <div class="theme_option_message2 space" style="clear:both; margin:40px 0 0 0;">
        <p><?php _e('This overlay will also be used in article page.', 'tcd-seeed'); ?></p>
       </div>
      </li>
      <li class="cf" style="border:none;">
       <span class="label"><span class="num_space"></span><?php _e('Transparency of overlay', 'tcd-seeed'); ?></span><input class="hankaku" style="width:70px;" type="number" step="0.1" min="0" max="1" name="dp_options[archive_blog_overlay_opacity]" value="<?php echo esc_attr( $options['archive_blog_overlay_opacity'] ); ?>" />
       <div class="theme_option_message2 space" style="clear:both; margin:7px 0 0 0;">
        <p><?php _e('Please specify the number of 0 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-seeed');  ?>
        <?php _e('Please enter 0 if you don\'t want to use overlay.', 'tcd-seeed');  ?></p>
       </div>
      </li>
      <li class="cf"><span class="label"><span class="num">4</span><?php _e('Categories list', 'tcd-seeed');  ?></span><?php echo tcd_basic_radio_button($options, 'archive_blog_show_cat_list', $basic_display_options); ?></li>
     </ul>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-seeed' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-seeed' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // 詳細ページの設定 -------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php printf(__('%s page', 'tcd-seeed'), $blog_label); ?></h3>
    <div class="theme_option_field_ac_content">

     <div class="front_page_image">
      <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/blog_main_image.jpg" alt="" title="" />
     </div>

     <h4 class="theme_option_headline2"><?php _e('Display setting', 'tcd-seeed');  ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('You can set share button design from basic setting menu in theme option page.', 'tcd-seeed');  ?><br>
      <?php _e('The content displayed in the sidebar can be set from Appearance > <a href="./widgets.php" target="_blank">Widgets</a>.', 'tcd-seeed');  ?></p>
     </div>
     <ul class="option_list">
      <li class="cf"><span class="label"><span class="num">1</span><?php _e('Share button', 'tcd-seeed');  ?></span><?php echo tcd_basic_radio_button($options, 'single_blog_show_sns', $single_page_display_options); ?></li>
      <li class="cf"><span class="label"><span class="num">2</span><?php _e('"COPY Title&amp;URL" button', 'tcd-seeed');  ?></span><?php echo tcd_basic_radio_button($options, 'single_blog_show_copy', $single_page_display_options); ?></li>
      <li class="cf"><span class="label"><span class="num">3</span><?php _e('Tag cloud', 'tcd-seeed');  ?></span><?php echo tcd_basic_radio_button($options, 'single_blog_show_tag_list', $basic_display_options); ?></li>
     </ul>

     <?php // 関連記事 ----------------------------- ?>
     <h4 class="theme_option_headline2"><?php _e('Related post', 'tcd-seeed');  ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><span class="num">4</span><?php _e('Headline', 'tcd-seeed');  ?></span><input type="text" placeholder="<?php _e( 'e.g.', 'tcd-seeed' ); _e( 'Related post', 'tcd-seeed' ); ?>" class="full_width" name="dp_options[related_post_headline]" value="<?php echo esc_attr($options['related_post_headline']); ?>"></li>
      <li class="cf"><span class="label"><span class="num">5</span><?php _e('Number of post to display', 'tcd-seeed');  ?></span><?php echo tcd_display_post_num_option_type2($options, 'related_post_num'); ?></li>
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
      <textarea class="full_width" cols="50" rows="10" name="dp_options[single_top_ad_code]"><?php echo esc_textarea( $options['single_top_ad_code'] ); ?></textarea>

      <h4 class="theme_option_headline2"><?php _e('Free HTML area (mobile)', 'tcd-seeed');  ?></h4>
      <div class="theme_option_message2">
       <p><?php _e('This content will be displayed in mobile device only.', 'tcd-seeed');  ?></p>
      </div>
      <textarea class="full_width" cols="50" rows="10" name="dp_options[single_top_ad_code_mobile]"><?php echo esc_textarea( $options['single_top_ad_code_mobile'] ); ?></textarea>

     </div><!-- END .sub_box_tab_content -->

     <?php // メインコンテンツの下部 ----------------------- ?>
     <div class="sub_box_tab_content" data-tab-content="tab2">

      <h4 class="theme_option_headline2"><?php _e('Free HTML area (PC)', 'tcd-seeed');  ?></h4>
      <div class="theme_option_message2">
       <p><?php _e('This content will be displayed in PC only.', 'tcd-seeed');  ?></p>
      </div>
      <textarea class="full_width" cols="50" rows="10" name="dp_options[single_bottom_ad_code]"><?php echo esc_textarea( $options['single_bottom_ad_code'] ); ?></textarea>

      <h4 class="theme_option_headline2"><?php _e('Free HTML area (mobile)', 'tcd-seeed');  ?></h4>
      <div class="theme_option_message2">
       <p><?php _e('This content will be displayed in mobile device only.', 'tcd-seeed');  ?></p>
      </div>
      <textarea class="full_width" cols="50" rows="10" name="dp_options[single_bottom_ad_code_mobile]"><?php echo esc_textarea( $options['single_bottom_ad_code_mobile'] ); ?></textarea>

     </div><!-- END .sub_box_tab_content -->

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-seeed' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-seeed' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


</div><!-- END .tab-content -->

<?php
} // END add_blog_tab_panel()


// バリデーション　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_blog_theme_options_validate( $input ) {

  global $dp_default_options, $font_type_options;

  // 基本設定
  $input['blog_show_date'] = wp_filter_nohtml_kses( $input['blog_show_date'] );


  // アーカイブ
  $input['archive_blog_headline'] = wp_filter_nohtml_kses( $input['archive_blog_headline'] );
  $input['archive_blog_desc'] = wp_kses_post( $input['archive_blog_desc'] );
  $input['archive_blog_desc_mobile'] = wp_kses_post( $input['archive_blog_desc_mobile'] );
  $input['archive_blog_header_image'] = wp_filter_nohtml_kses( $input['archive_blog_header_image'] );
  $input['archive_blog_overlay_color'] = wp_filter_nohtml_kses( $input['archive_blog_overlay_color'] );
  $input['archive_blog_overlay_opacity'] = wp_filter_nohtml_kses( $input['archive_blog_overlay_opacity'] );
  $input['archive_blog_show_cat_list'] = wp_filter_nohtml_kses( $input['archive_blog_show_cat_list'] );


  // 記事ページ
  $input['single_blog_show_sns'] = wp_filter_nohtml_kses( $input['single_blog_show_sns'] );
  $input['single_blog_show_copy'] = wp_filter_nohtml_kses( $input['single_blog_show_copy'] );
  $input['single_blog_show_tag_list'] = wp_filter_nohtml_kses( $input['single_blog_show_tag_list'] );


  // 関連記事
  $input['related_post_headline'] = wp_filter_nohtml_kses( $input['related_post_headline'] );
  $input['related_post_num'] = wp_filter_nohtml_kses( $input['related_post_num'] );
  $input['related_post_num_sp'] = wp_filter_nohtml_kses( $input['related_post_num_sp'] );


  // 記事ページの追加コンテンツ
  $input['single_top_ad_code'] = $input['single_top_ad_code'];
  $input['single_top_ad_code_mobile'] = $input['single_top_ad_code_mobile'];
  $input['single_bottom_ad_code'] = $input['single_bottom_ad_code'];
  $input['single_bottom_ad_code_mobile'] = $input['single_bottom_ad_code_mobile'];


	return $input;

};


?>