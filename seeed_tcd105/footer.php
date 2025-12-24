<?php $options = get_design_plus_option(); ?>

 <?php
      if(is_page()){ 
        $page_hide_footer = get_post_meta($post->ID, 'page_hide_footer', true) ?  get_post_meta($post->ID, 'page_hide_footer', true) : 'no';
      } else {
        $page_hide_footer = 'no';
      }

      if($page_hide_footer != 'yes'){
 ?>

 <?php
      // コンタクトエリア --------------------------------------------------
      if($options['show_footer_contact1'] || $options['show_footer_contact2']){
        $overlay_color = hex2rgb($options['footer_contact_overlay_color']);
        $overlay_color = implode(",",$overlay_color);
        $overlay_opacity = $options['footer_contact_overlay_opacity'];
 ?>
 <div id="footer_contact" class="<?php if(!$options['show_footer_contact1'] || !$options['show_footer_contact2']){ echo 'one_item'; } else { echo 'two_item'; }; if($options['footer_contact_bg_type'] == 'type3'){ echo ' fixed_image'; } elseif($options['footer_contact_bg_type'] == 'none'){ echo ' no_background'; }; ?>">

  <?php if($options['footer_contact_bg_type'] != 'none'){ ?>
  <div class="overlay" style="background:rgba(<?php echo esc_attr($overlay_color); ?>,<?php echo esc_attr($overlay_opacity); ?>);"></div>
  <?php }; ?>

  <?php
       // 画像スライダー -------------------------------------------------------
       if($options['footer_contact_bg_type'] == 'type1'){
         $images = $options['footer_contact_image_slider'];
         $images = $images ? explode( ',', $images ) : array();
         if( !empty( $images ) ){
  ?>
  <div id="footer_image_carousel_wrap">
   <div class='footer_image_carousel'>
    <?php
            foreach( $images as $image_id ):
              $image = wp_get_attachment_image_src( $image_id, 'full' );
              if($image){
    ?>
    <div class="item">
     <img src="<?php echo esc_attr($image[0]); ?>" alt="" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>">
    </div>
    <?php
              };
            endforeach;
    ?>
   </div>
  </div><!-- END #footer_image_carousel -->
  <?php
         };

       // 動画 -------------------------------------------------------
       } elseif($options['footer_contact_bg_type'] == 'type2') {
         $video_url = $options['footer_contact_video'];
         if($video_url){
  ?>
  <div id="footer_video">
   <video src="<?php echo esc_url(wp_get_attachment_url($video_url)); ?>" playsinline autoplay loop muted></video>
  </div>
  <?php
         };
       // 静止画 -------------------------------------------------------
       } elseif($options['footer_contact_bg_type'] == 'type3') {
         $image = wp_get_attachment_image_src($options['footer_contact_image'], 'full');
         if($image){
  ?>
  <img class="bg_image" loading="lazy" src="<?php echo esc_attr($image[0]); ?>" alt="" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>">
  <?php
         };
       };
  ?>

  <?php // ボタンエリア --------------------------------------------- ?>
  <div id="footer_button_area">
   <?php
        for ( $i = 1; $i <= 2; $i++ ) :
          $show_button = $options['show_footer_contact'.$i];
          if($show_button) {
             $title = $options['footer_contact_title'.$i];
             $desc = $options['footer_contact_desc'.$i];
             $url = $options['footer_contact_url'.$i];
             $target = $options['footer_contact_target'.$i];
             $icon = $options['footer_contact_icon'.$i];
             $icon_image = wp_get_attachment_image_src($options['footer_contact_icon_image'.$i], 'full');
   ?>
   <a class="item" href="<?php echo esc_url($url); ?>" <?php if($target){ echo 'target="_blank" rel="nofollow noopener"'; }; ?>>
    <?php if($icon_image) { ?>
    <div class="icon"><img loading="lazy" src="<?php echo esc_attr($icon_image[0]); ?>" alt="" width="<?php echo esc_attr($icon_image[1]); ?>" height="<?php echo esc_attr($icon_image[2]); ?>"></div>
    <?php } else { ?>
    <?php if($icon){ ?><div class="icon"><span>&#x<?php echo esc_attr($icon); ?>;</span></div><?php }; ?>
    <?php }; ?>
    <div class="content">
     <?php if($title){ ?><h4 class="title"><?php echo esc_html($title); ?></h4><?php }; ?>
     <?php if($desc){ ?><p class="desc"><?php echo wp_kses_post(nl2br($desc)); ?></p><?php }; ?>
    </div>
   </a>
   <?php
          };
        endfor;
   ?>
  </div><!-- END #footer_button_area -->

 </div><!-- END #footer_contact -->
 <?php }; ?>

 <?php }; // end hide footer ?>

 <?php
      // ロゴエリア --------------------------------------------------
 ?>

 <?php if($page_hide_footer != 'yes'){ ?>
 <footer id="footer">

  <?php
       // キャッチコピー ----------------------------------------
       if($options['footer_catch']){
  ?>
  <div id="footer_catch">
   <p><?php echo wp_kses_post(nl2br($options['footer_catch'])); ?></p>
  </div>
  <?php }; ?>

  <div id="footer_inner">

   <?php
        // ロゴ ----------------------------------------
        footer_logo();
   ?>

   <?php
        // SNSボタン ------------------------------------
        if($options['show_sns_footer'] == 'display') {
          $facebook = $options['sns_button_facebook_url'];
          $twitter = $options['sns_button_twitter_url'];
          $insta = $options['sns_button_instagram_url'];
          $pinterest = $options['sns_button_pinterest_url'];
          $youtube = $options['sns_button_youtube_url'];
          $tiktok = $options['sns_button_tiktok_url'];
          $contact = $options['sns_button_contact_url'];
          $show_rss = $options['sns_button_show_rss'];
   ?>
   <ul id="footer_sns" class="sns_button_list clearfix color_<?php echo esc_attr($options['sns_button_color_type']); ?>">
    <?php if($insta) { ?><li class="insta"><a href="<?php echo esc_url($insta); ?>" rel="nofollow noopener" target="_blank" title="Instagram"><span>Instagram</span></a></li><?php }; ?>
    <?php if($tiktok) { ?><li class="tiktok"><a href="<?php echo esc_url($tiktok); ?>" rel="nofollow noopener" target="_blank" title="TikTok"><span>TikTok</span></a></li><?php }; ?>
    <?php if($twitter) { ?><li class="twitter"><a href="<?php echo esc_url($twitter); ?>" rel="nofollow noopener" target="_blank" title="X"><span>X</span></a></li><?php }; ?>
    <?php if($facebook) { ?><li class="facebook"><a href="<?php echo esc_url($facebook); ?>" rel="nofollow noopener" target="_blank" title="Facebook"><span>Facebook</span></a></li><?php }; ?>
    <?php if($pinterest) { ?><li class="pinterest"><a href="<?php echo esc_url($pinterest); ?>" rel="nofollow noopener" target="_blank" title="Pinterest"><span>Pinterest</span></a></li><?php }; ?>
    <?php if($youtube) { ?><li class="youtube"><a href="<?php echo esc_url($youtube); ?>" rel="nofollow noopener" target="_blank" title="Youtube"><span>Youtube</span></a></li><?php }; ?>
    <?php if($contact) { ?><li class="contact"><a href="<?php echo esc_url($contact); ?>" rel="nofollow noopener" target="_blank" title="Contact"><span>Contact</span></a></li><?php }; ?>
    <?php if($show_rss == 'display') { ?><li class="rss"><a href="<?php echo esc_url(get_bloginfo('rss2_url')); ?>" rel="nofollow noopener" target="_blank" title="RSS"><span>RSS</span></a></li><?php }; ?>
   </ul>
   <?php }; ?>

  </div>

  <?php
  $menu_name = 'footer-menu'; // メニューのスラッグを指定
  $locations = get_nav_menu_locations();
  $menu = isset($locations[$menu_name]) ? wp_get_nav_menu_object($locations[$menu_name]) : '';
  $menu_items = $menu ? wp_get_nav_menu_items($menu->term_id) : [];
       // メニュー --------------------------------------------
       if (has_nav_menu('footer-menu') && !empty($menu_items)) {
  ?>
  <div id="footer_nav" class="swiper">
   <?php wp_nav_menu( array( 'sort_column' => 'menu_order', 'theme_location' => 'footer-menu' , 'depth' => '1', 'menu_class' => 'swiper-wrapper', 'container' => '', 'add_li_class'  => 'swiper-slide'  ) ); ?>
  </div>
  <?php }; ?>

 </footer>

 <?php }; // hide footer ?>

</div><!-- #container -->

<?php // コピーライト ?>
<p id="copyright"><span><?php echo wp_kses_post($options['copyright']); ?></span></p>

<div id="return_top">
 <a class="no_auto_scroll" href="#body"><span>PAGE TOP</span></a>
</div>

<?php
     // モバイル用ドロワーメニュー --------------------------------------------
     if (has_nav_menu('drawer-menu')) {
?>
<div id="drawer_menu">

 <div class="header">
  <div id="drawer_mneu_close_button"></div>
 </div>

 <?php // メニュー  ?>
 <?php wp_nav_menu( array( 'sort_column' => 'menu_order', 'theme_location' => 'drawer-menu' , 'container' => 'div', 'container_id' => 'mobile_menu'  ) ); ?>

 <?php
      // SNSボタン ------------------------------------
      if($options['show_sns_mobile'] == 'display') {
        $facebook = $options['sns_button_facebook_url'];
        $twitter = $options['sns_button_twitter_url'];
        $insta = $options['sns_button_instagram_url'];
        $pinterest = $options['sns_button_pinterest_url'];
        $youtube = $options['sns_button_youtube_url'];
        $tiktok = $options['sns_button_tiktok_url'];
        $contact = $options['sns_button_contact_url'];
        $show_rss = $options['sns_button_show_rss'];
 ?>
 <ul id="mobile_sns" class="sns_button_list clearfix color_<?php echo esc_attr($options['sns_button_color_type']); ?>">
  <?php if($insta) { ?><li class="insta"><a href="<?php echo esc_url($insta); ?>" rel="nofollow noopener" target="_blank" title="Instagram"><span>Instagram</span></a></li><?php }; ?>
  <?php if($twitter) { ?><li class="twitter"><a href="<?php echo esc_url($twitter); ?>" rel="nofollow noopener" target="_blank" title="X"><span>X</span></a></li><?php }; ?>
  <?php if($facebook) { ?><li class="facebook"><a href="<?php echo esc_url($facebook); ?>" rel="nofollow noopener" target="_blank" title="Facebook"><span>Facebook</span></a></li><?php }; ?>
  <?php if($pinterest) { ?><li class="pinterest"><a href="<?php echo esc_url($pinterest); ?>" rel="nofollow noopener" target="_blank" title="Pinterest"><span>Pinterest</span></a></li><?php }; ?>
  <?php if($youtube) { ?><li class="youtube"><a href="<?php echo esc_url($youtube); ?>" rel="nofollow noopener" target="_blank" title="Youtube"><span>Youtube</span></a></li><?php }; ?>
  <?php if($tiktok) { ?><li class="tiktok"><a href="<?php echo esc_url($tiktok); ?>" rel="nofollow noopener" target="_blank" title="TikTok"><span>TikTok</span></a></li><?php }; ?>
  <?php if($contact) { ?><li class="contact"><a href="<?php echo esc_url($contact); ?>" rel="nofollow noopener" target="_blank" title="Contact"><span>Contact</span></a></li><?php }; ?>
  <?php if($show_rss == 'display') { ?><li class="rss"><a href="<?php echo esc_url(get_bloginfo('rss2_url')); ?>" rel="nofollow noopener" target="_blank" title="RSS"><span>RSS</span></a></li><?php }; ?>
 </ul>
 <?php }; ?>

</div>
<?php }; ?>

<?php
     // フッターバー ----------------------------------------------------------
     do_action( 'tcd_footer_after', $options );
?>
<?php
     // share button ----------------------------------------------------------------------
     if ( (is_singular('post') && $options['single_blog_show_sns'] != 'hide') || (is_singular('news') && $options['single_news_show_sns'] != 'hide') ) :
       if ( $options['sns_share_design_type'] == 'type5') :
         if ( $options['show_sns_share_twitter'] ) :
?>
<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
<?php
         endif;
         if ( $options['show_sns_share_fblike'] || $options['show_sns_share_fbshare'] ) :
?>
<div id="fb-root"></div>
<script>(function(d, s, id) { var js, fjs = d.getElementsByTagName(s)[0]; if (d.getElementById(id)) return; js = d.createElement(s); js.id = id; js.src = "//connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v2.5"; fjs.parentNode.insertBefore(js, fjs); }(document, 'script', 'facebook-jssdk'));</script>
<?php
         endif;
         if ( $options['show_sns_share_hatena'] ) :
?>
<script type="text/javascript" src="//b.st-hatena.com/js/bookmark_button.js" charset="utf-8" async="async"></script>
<?php
         endif;
         if ( $options['show_sns_share_pocket'] ) :
?>
<script type="text/javascript">!function(d,i){if(!d.getElementById(i)){var j=d.createElement("script");j.id=i;j.src="https://widgets.getpocket.com/v1/j/btn.js?v=1";var w=d.getElementById(i);d.body.appendChild(j);}}(document,"pocket-btn-js");</script>
<?php
         endif;
         if ( $options['show_sns_share_pinterest'] ) :
?>
<script async defer src="//assets.pinterest.com/js/pinit.js"></script>
<?php
         endif;
       endif;
     endif;
?>

<?php wp_footer(); ?>
<?php
     // load script -----------------------------------------------------------
    if(
       $options['show_loading'] && is_front_page() && $options['loading_display_page'] == 'type1' && $options['loading_display_time'] == 'type1' && !isset($_COOKIE['first_visit']) ||
       $options['show_loading'] && is_front_page() && $options['loading_display_page'] == 'type1' && $options['loading_display_time'] == 'type2' ||
       $options['show_loading'] && $options['loading_display_page'] == 'type2' && $options['loading_display_time'] == 'type1' && !isset($_COOKIE['first_visit']) ||
       $options['show_loading'] && $options['loading_display_page'] == 'type2' && $options['loading_display_time'] == 'type2'
    ){
       show_loading_screen();
     } else {
       no_loading_screen();
     };

     // カスタムスクリプト--------------------------------------------
     if($options['footer_script_code']) {
       echo $options['footer_script_code'];
     };
     if(is_single() || is_page()) {
       global $post;
       $footer_custom_script = get_post_meta($post->ID, 'footer_custom_script', true);
       if($footer_custom_script) {
         echo $footer_custom_script;
       };
     };
?>
</body>
</html>