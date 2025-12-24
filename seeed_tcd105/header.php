<?php $options = get_design_plus_option(); ?>
<!DOCTYPE html>
<html class="pc" <?php language_attributes(); ?>>
<?php if($options['use_ogp']) { ?>
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb#">
<?php } else { ?>
<head>
<?php }; ?>
<meta charset="<?php bloginfo('charset'); ?>">
<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"><![endif]-->
<meta name="viewport" content="width=device-width">
<meta name="description" content="<?php echo get_seo_description(); ?>">
<?php if(is_attachment() && (get_option( 'blog_public' ) != 0)) { ?>
<meta name='robots' content='noindex, nofollow' />
<?php }; ?>
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
<?php wp_head(); ?>
</head>
<body id="body" <?php body_class(); ?>>
<div id="js-body-start"></div>

<?php
     // ロード画面 --------------------------------------------------------------------
     if(
       $options['show_loading'] && is_front_page() && $options['loading_display_page'] == 'type1' && $options['loading_display_time'] == 'type1' && !isset($_COOKIE['first_visit']) ||
       $options['show_loading'] && is_front_page() && $options['loading_display_page'] == 'type1' && $options['loading_display_time'] == 'type2' ||
       $options['show_loading'] && $options['loading_display_page'] == 'type2' && $options['loading_display_time'] == 'type1' && !isset($_COOKIE['first_visit']) ||
       $options['show_loading'] && $options['loading_display_page'] == 'type2' && $options['loading_display_time'] == 'type2'
     ){
       load_icon();
     };

     // メッセージ --------------------------------------------------------------------
     if(!(is_404() || (is_search() && ( !have_posts() || empty( get_search_query() ))))) {
       if((is_front_page() && $options['show_header_message'] == 'display') || (!is_page() && $options['show_header_message'] == 'display') || (is_page() && !is_page_template('page-tcd-lp.php') && $options['show_header_message'] == 'display') || (is_page() && is_page_template('page-tcd-lp.php') && (get_post_meta($post->ID, 'hide_header_message', true)) == 'no') ) {
         $message = $options['header_message'];
         $url = $options['header_message_url'];
         $target = $options['header_message_target'];
         $font_color = $options['header_message_font_color'];
         $bg_color = $options['header_message_bg_color'];
         if($message){
?>
<div id="header_message" style="color:<?php esc_attr_e($font_color); ?>;background-color:<?php esc_attr_e($bg_color); ?>;">
 <?php if($url){ ?>
 <a href="<?php echo esc_url($url); ?>" <?php if($target){ echo 'target="_blank" rel="nofollow noopener"'; }; ?> class="label"><?php echo wp_kses_post(nl2br($message)); ?></a>
 <?php }else{ ?>
 <p class="label"><?php echo wp_kses_post(nl2br($message)); ?></p>
 <?php } ?>
</div>
<?php
         };
       };
     };
?>

<?php
     // ヘッダー ----------------------------------------------------------------------
      if(is_page_template('page-tcd-lp.php')){ 
        $hide_page_header_bar = get_post_meta($post->ID, 'hide_page_header_bar', true) ?  get_post_meta($post->ID, 'hide_page_header_bar', true) : 'no';
      } else {
        $hide_page_header_bar = 'no';
      }
      if( $hide_page_header_bar != 'yes' ) {
?>
<header id="header">
 <?php
      // ロゴ ----------------------------------------
      header_logo();

      // グローバルメニュー ----------------------------------------------------------------
      if ( has_nav_menu('global-menu') ) {
 ?>
 <?php if ( has_nav_menu('drawer-menu') ) { ?><div id="drawer_menu_button"><span></span><span></span><span></span></div><?php }; ?>
 <?php wp_nav_menu( array( 'sort_column' => 'menu_order', 'theme_location' => 'global-menu' , 'container' => 'nav', 'container_id' => 'global_menu'  ) ); ?>
 <?php
      };

      // ボタン --------------------------------------------------------------------
      if($options['header_button_url']) {
 ?>
 <a id="header_button" href="<?php echo esc_url($options['header_button_url']); ?>" <?php if($options['header_button_target']){ echo 'target="_blank" rel="nofollow noopener"'; }; ?> class="label"><?php echo esc_html($options['header_button_label']); ?></a>
 <?php }; ?>

 <?php get_template_part( 'template-parts/megamenu' ); ?>

</header>
<?php }; ?>

<div id="container">

 <?php
      //  トップページ -------------------------------------------------------------------------
      if(is_front_page()) {

        //  ヘッダースライダー -------------------------------------------------------------------------
       $catch_animation_type = $options['index_header_content_catch_animation_type'];
 ?>
 <div id="header_slider_wrap" class="catch_animation_<?php echo esc_attr($catch_animation_type); ?><?php if(!$options['show_header_news']){ echo ' no_header_news'; }; ?>">

  <?php
       // キャッチフレーズエリア -----------------
       $catch = $options['index_header_content_catch'];
       $catch_mobile = $options['index_header_content_catch_mobile'];
       $catch_font_type = $options['index_header_content_catch_font_type'];
       $button_label = $options['index_header_content_button_label'];
       $button_url = $options['index_header_content_button_url'];
       $button_target = $options['index_header_content_button_target'];
  ?>
  <div id="header_slider_content">
   <div class="content">
    <?php
         if($catch){
           if($catch_animation_type == 'type1'){
    ?>
    <h2 class="catch rich_font_<?php echo esc_attr($catch_font_type); ?> typewritter_animation"><span class="item"></span><?php if(is_mobile() && $catch_mobile) { echo sepText($catch_mobile); } else { echo sepText($catch); }; ?></h2>
    <?php } else { ?>
    <h2 class="catch rich_font_<?php echo esc_attr($catch_font_type); ?> fade"><?php if(is_mobile() && $catch_mobile) { echo wp_kses_post(nl2br($catch_mobile)); } else { echo wp_kses_post(nl2br($catch)); }; ?></h2>
    <?php
           };
         };
    ?>
    <?php if($button_label) { ?>
    <div class="link_button">
     <a href="<?php echo esc_url($button_url); ?>" <?php if($button_target){ echo 'target="_blank" rel="nofollow noopener"'; }; ?> class="label"><?php echo esc_html($button_label); ?></a>
    </div>
    <?php }; ?>
   </div>
  </div>

  <?php
       // スライダーエリア -----------------
        $index_header_content_type = $options['index_header_content_type'];
        $overlay = hex2rgb($options['index_header_content_overlay_color']);
        $overlay = implode(",",$overlay);
        $overlay_opacity = $options['index_header_content_overlay_opacity'];
        $animation_type = $options['index_image_slider_animation_type'] ?  $options['index_image_slider_animation_type'] : 'slide';
  ?>
  <div id="header_slider" class="swiper animation_type_<?php echo esc_attr($animation_type); ?>" data-fade_speed="<?php if($animation_type == 'slide'){ echo '1500'; } else { echo '2000'; }; ?>">
   <div class="swiper-wrapper">
    <?php
         // 画像スライダー
         if($index_header_content_type == 'type1'){
           $i = 1;
           $images = $options['index_slider_image'];
           if(is_mobile()){
             $images = $options['index_slider_image_sp'] ?  $options['index_slider_image_sp'] : $options['index_slider_image'];
           }
           $images = $images ? explode( ',', $images ) : array();
           if( !empty( $images ) ){
    ?>
    <div class="overlay" style="background:rgba(<?php echo esc_attr($overlay); ?>,<?php echo esc_attr($overlay_opacity); ?>);"></div>
    <?php
             foreach( $images as $image_id ):
               $image = wp_get_attachment_image_src( $image_id, 'full' );
               if( $image ){
    ?>
    <div class="swiper-slide item item<?php echo $i; if($i == 1){ echo ' first_item'; }; ?>" data-item-type="type1">
     <div class="item-inner">
      <div class="bg_image">
       <img src="<?php echo esc_attr($image[0]); ?>" alt="" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>">
      </div>
     </div>
    </div><!-- END .item -->
    <?php
               };
               $i++;
             endforeach;
           };

         // 動画
         } elseif($index_header_content_type == 'type2') {
           $video_url = $options['index_header_content_video'];
           if($video_url){
    ?>
    <div class="swiper-slide item item first_item" data-item-type="type2">
     <div class="item-inner">
      <div class="overlay" style="background:rgba(<?php echo esc_attr($overlay); ?>,<?php echo esc_attr($overlay_opacity); ?>);"></div>
      <video class="bg_video" src="<?php echo esc_url(wp_get_attachment_url($video_url)); ?>" playsinline muted></video>
     </div>
    </div><!-- END .item -->
    <?php
           };

         // YouTube
         } elseif($index_header_content_type == 'type3') {
           if ( $options['index_header_content_youtube'] && preg_match( '%(?:youtube(?:-nocookie)?\.com/(?:[\w\-?&!#=,;]+/[\w\-?&!#=/,;]+/|(?:v|e(?:mbed)?)/|[\w\-?&!#=,;]*[?&]v=)|youtu\.be/)([\w-]{11})(?:[^\w-]|\Z)%i', $options['index_header_content_youtube'], $matches ) ) {
             $youtube_id = $matches[1];
    ?>
    <div class="swiper-slide item item first_item" data-item-type="type3">
     <div class="item-inner">
      <div class="overlay" style="background:rgba(<?php echo esc_attr($overlay); ?>,<?php echo esc_attr($overlay_opacity); ?>);"></div>
      <div class="bg_youtube" data-video-id="<?php echo esc_attr( $youtube_id ); ?>"></div>
     </div>
    </div><!-- END .item -->
    <?php
           };
         };
    ?>
   </div>
  </div><!-- END #header_slider -->

  <?php
       // 実績 ---------------------------
       if($options['show_index_achievements']){
  ?>
  <div id="index_achievements">
   <div class="content">
    <?php if($options['index_achievements_headline']) { ?>
    <h3 class="headline"><?php echo esc_html($options['index_achievements_headline']); ?></h3>
    <?php }; ?>
    <?php if($options['index_achievements_num'] || $options['index_achievements_num'] == 0) { ?>
    <p class="num_area"><span class="num counter"><?php echo number_format($options['index_achievements_num']); ?></span><?php if($options['index_achievements_unit']) { ?><span class="unit"><?php echo esc_html($options['index_achievements_unit']); ?></span><?php }; ?></p>
    <?php }; ?>
    <?php if($options['index_achievements_desc']) { ?>
    <p class="desc"><?php echo esc_html($options['index_achievements_desc']); ?></p>
    <?php }; ?>
   </div>
  </div>
  <?php }; ?>

 </div><!-- END #header_slider_wrap -->

 <?php
      // ニュースティッカー
      if($options['show_header_news']){
        $post_num = 5;
        $post_type = $options['header_news_post_type'];
        $post_order = $options['header_news_post_order'];
        $args = array( 'post_type' => $post_type, 'posts_per_page' => $post_num, 'orderby' => $post_order );
        $post_list = new wp_query($args);
        if($post_list->have_posts()):
 ?>
 <div id="news_ticker" class="swiper post_type_<?php echo esc_attr($post_type); ?>">
  <div class="post_list swiper-wrapper">
   <?php while( $post_list->have_posts() ) : $post_list->the_post(); ?>
   <a class="item swiper-slide" href="<?php the_permalink(); ?>">
    <time class="date entry-date published" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time>
    <p class="title"><?php the_title_attribute(); ?></p>
   </a>
   <?php endwhile; wp_reset_query(); ?>
  </div>
 </div>
 <?php
        endif;
      };
 ?>

 <?php
      }; // END front page

