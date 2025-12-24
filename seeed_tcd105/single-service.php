<?php
     get_header();
     $options = get_design_plus_option();
     $headline = $options['archive_service_headline'];
     $image = wp_get_attachment_image_src($options['archive_service_header_image'], 'full');
     $overlay_color = hex2rgb($options['archive_service_overlay_color']);
     $overlay_color = implode(",",$overlay_color);
     $overlay_opacity = $options['archive_service_overlay_opacity'];
     if($image){
?>
<div id="page_header">

 <?php if($headline){ ?>
 <h1 class="headline" style="background:rgba(<?php echo esc_attr($overlay_color); ?>,0.3);"><span><?php echo wp_kses_post(nl2br($headline)); ?></span></h1>
 <?php }; ?>

 <?php if($image) { ?>
 <div class="overlay" style="background:rgba(<?php echo esc_attr($overlay_color); ?>,<?php echo esc_attr($overlay_opacity); ?>);"></div>
 <img src="<?php echo esc_attr($image[0]); ?>" alt="" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>">
 <?php }; ?>

</div>
<?php }; ?>

<?php get_template_part('template-parts/breadcrumb'); ?>

<article id="single_service">

 <?php
      if ( have_posts() ) : while ( have_posts() ) : the_post();
 ?>

 <div id="single_service_title_area">
  <h1 class="title entry-title"><?php the_title(); ?></h1>
  <?php
       // 画像スライダー -------------------------------------------------------
       $service_image_slider = get_post_meta($post->ID, 'service_image_slider', true);
       $images = $service_image_slider ? explode( ',', $service_image_slider ) : array();
       if( !empty( $images ) ){
  ?>
  <div id="service_image_carousel_wrap" class="swiper">
   <div id="service_image_carousel" class="swiper-wrapper">
    <?php
         if(has_post_thumbnail()) {
           $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
    ?>
    <div class="item swiper-slide">
     <img src="<?php echo esc_attr($image[0]); ?>" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" />
    </div>
    <?php
         };
         foreach( $images as $image_id ):
           $image = wp_get_attachment_image_src( $image_id, 'full' );
           if($image){
    ?>
    <div class="item swiper-slide">
     <img src="<?php echo esc_attr($image[0]); ?>" alt="" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>">
    </div>
    <?php
           };
         endforeach;
    ?>
   </div>
   <div id="service_image_slider_pagination" class="swiper-pagination"></div>
  </div><!-- END #service_image_carousel_wrap -->
  <?php
       // 通常の画像 -----------------
       } else {
         if(has_post_thumbnail()) {
           $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
  ?>
  <div class="featured_image">
   <img src="<?php echo esc_attr($image[0]); ?>" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" />
  </div>
  <?php
         };
       };
  ?>
 </div>

   <?php
        // 追加コンテンツ（上） ------------------------------------------------------------------------------------------------------------------------
        if(!is_mobile()) {
          if( $options['single_service_top_ad_code']) {
   ?>
   <div id="single_banner_top" class="single_banner">
    <?php echo $options['single_service_top_ad_code']; ?>
   </div><!-- END #single_banner_top -->
   <?php
          };
        } else {
          if( $options['single_service_top_ad_code_mobile']) {
   ?>
   <div id="single_banner_top" class="single_banner">
    <?php echo $options['single_service_top_ad_code_mobile']; ?>
   </div><!-- END #single_banner_top -->
   <?php
          };
        };
   ?>

 <?php // post content ------------------------------------------------------------------------------------------------------------------------ ?>
 <div class="post_content clearfix">
  <?php
       the_content();
       if ( ! post_password_required() ) {
         custom_wp_link_pages();
       }
  ?>
 </div>

 <?php endwhile; endif; ?>

  <?php
       // 追加コンテンツ（下） ------------------------------------------------------------------------------------------------------------------------
       if(!is_mobile()) {
         if( $options['single_service_bottom_ad_code'] ) {
  ?>
  <div id="single_banner_bottom" class="single_banner">
   <?php echo $options['single_service_bottom_ad_code']; ?>
  </div><!-- END #single_banner_bottom -->
  <?php
         };
       } else {
         if( $options['single_service_bottom_ad_code_mobile'] ) {
  ?>
  <div id="single_banner_bottom" class="single_banner">
   <?php echo $options['single_service_bottom_ad_code_mobile']; ?>
  </div><!-- END #single_banner_bottom -->
  <?php
         };
       };
  ?>

</article><!-- END #single_function -->

<?php
     // アイコン記事一覧 --------------------------------------
     if($options['archive_service_list_type'] != 'type4'){
       $args = array('post_type' => 'service', 'posts_per_page' => -1, 'ignore_sticky_posts' => 1, 'orderby' => array('menu_order' => 'ASC', 'date' => 'DESC'));
       $post_list = new wp_query($args);
       if($post_list->have_posts()):
         $total = $post_list->post_count;
?>
<div id="single_service_icon_list">

 <?php if($options['service_icon_list_type'] == 'type1'){ ?>

 <ul id="service_icon_list_type1"<?php if($total < 5){ echo ' class="short_size"'; }; ?>>
  <?php
       while ($post_list->have_posts()) : $post_list->the_post();
         $icon = get_post_meta($post->ID, 'service_icon', true);
         $icon_image = get_post_meta($post->ID, 'service_icon_image', true);
         $icon_image = wp_get_attachment_image_src($icon_image, 'full');
         $title = get_post_meta($post->ID, 'service_sub_title', true) ?  get_post_meta($post->ID, 'service_sub_title', true) : get_the_title();
  ?>
  <li>
   <a href="<?php the_permalink(); ?>">
    <?php if($icon_image) { ?>
    <div class="icon"><img loading="lazy" src="<?php echo esc_attr($icon_image[0]); ?>" alt="" width="<?php echo esc_attr($icon_image[1]); ?>" height="<?php echo esc_attr($icon_image[2]); ?>"></div>
    <?php } else { ?>
    <?php if($icon){ ?><div class="icon"><span>&#x<?php echo esc_attr($icon); ?>;</span></div><?php }; ?>
    <?php }; ?>
    <p class="catch"><span><?php echo wp_kses_post(nl2br($title)); ?></span></p>
   </a>
  </li>
  <?php endwhile; ?>
 </ul>

 <?php } else { ?>

 <ul id="service_icon_list_type2"<?php if($total < 7){ echo ' class="short_size"'; }; ?>>
  <?php
       while ($post_list->have_posts()) : $post_list->the_post();
         $icon = get_post_meta($post->ID, 'service_icon', true);
         $icon_image = get_post_meta($post->ID, 'service_icon_image', true);
         $icon_image = wp_get_attachment_image_src($icon_image, 'full');
         $title = get_post_meta($post->ID, 'service_sub_title', true) ?  get_post_meta($post->ID, 'service_sub_title', true) : get_the_title();
  ?>
  <li>
   <a href="<?php the_permalink(); ?>">
    <?php if($icon_image) { ?>
    <div class="icon"><img loading="lazy" src="<?php echo esc_attr($icon_image[0]); ?>" alt="" width="<?php echo esc_attr($icon_image[1]); ?>" height="<?php echo esc_attr($icon_image[2]); ?>"></div>
    <?php } else { ?>
    <?php if($icon){ ?><div class="icon"><span>&#x<?php echo esc_attr($icon); ?>;</span></div><?php }; ?>
    <?php }; ?>
    <p class="title"><span><?php echo wp_kses_post(nl2br($title)); ?></span></p>
   </a>
  </li>
  <?php endwhile; ?>
 </ul>

 <?php }; ?>

</div>
<?php
       endif; wp_reset_query();

     } else {

       // カルーセル ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
       $post_num = $options['service_related_post_num'];
       if(is_mobile()){
         $post_num = $options['service_related_post_num_sp'];
       }
       if ($options['service_related_post_order'] == 'rand') {
         $args = array( 'post_type' => 'service', 'posts_per_page' => $post_num, 'orderby' => 'rand' );
       } else {
         $args = array( 'post_type' => 'service', 'posts_per_page' => $post_num, 'orderby' => array('menu_order' => 'ASC', 'date' => 'DESC') );
       }
       $related_post_list = new wp_query($args);
       $total = $related_post_list->post_count;
       if($related_post_list->have_posts()):
?>
<div id="related_service"<?php if($total == 1){ echo ' class="one_item"'; }; ?>>

 <?php if($options['service_related_headline']){ ?>
 <h3 class="headline"><?php echo wp_kses_post(nl2br($options['service_related_headline'])); ?></h3>
 <?php }; ?>

 <div id="related_service_slider" class="swiper">
  <div class="post_list swiper-wrapper">
   <?php
        while( $related_post_list->have_posts() ) : $related_post_list->the_post();
          if(has_post_thumbnail()) {
            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size3' );
          } elseif($options['no_image']) {
            $image = wp_get_attachment_image_src( $options['no_image'], 'full' );
          } else {
            $image = array();
            $image[0] = get_bloginfo('template_url') . "/img/no_image2.gif";
            $image[1] = '480';
            $image[2] = '300';
          }
   ?>
   <div class="item swiper-slide<?php if(!$name && !$job){ echo ' no_meta'; }; ?>">
    <a class="image_link animate_background" href="<?php the_permalink(); ?>">
     <div class="image_wrap">
      <img loading="lazy" class="image" src="<?php echo esc_attr($image[0]); ?>" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" />
     </div>
    </a>
    <h4 class="title"><a href="<?php the_permalink(); ?>"><span><?php the_title(); ?></span></a></h4>
   </div>
   <?php endwhile; wp_reset_query(); ?>
  </div><!-- END .post_list -->
 </div><!-- END #related_service_slider -->

 <div id="related_service_slider_pagination" class="swiper-pagination"></div>

</div><!-- END #related_case -->
<?php
       endif;
     };
?>

<?php get_footer(); ?>