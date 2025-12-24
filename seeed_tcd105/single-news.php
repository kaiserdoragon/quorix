<?php
     get_header();
     $options = get_design_plus_option();
     $headline = $options['archive_news_headline'];
     $image = wp_get_attachment_image_src($options['archive_news_header_image'], 'full');
     $overlay_color = hex2rgb($options['archive_news_overlay_color']);
     $overlay_color = implode(",",$overlay_color);
     $overlay_opacity = $options['archive_news_overlay_opacity'];
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

<div id="main_content">

 <div id="main_col">

  <article id="article">

   <?php
        if ( have_posts() ) : while ( have_posts() ) : the_post();
   ?>

   <?php if($page == '1') { // 1ページ目のみ表示 ?>

   <div id="single_news_header"<?php if(!has_post_thumbnail()) { echo ' class="no_image"'; }; ?>>
    <div class="title_area">
     <div class="meta">
      <time class="date entry-date published" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time>
      <?php
           $post_date = get_the_time('Ymd');
           $modified_date = get_the_modified_date('Ymd');
           if($post_date < $modified_date){
      ?>
      <time class="update entry-date updated" datetime="<?php the_modified_time('c'); ?>"><?php the_modified_date('Y.m.d'); ?></time>
      <?php }; ?>
     </div>
     <h1 class="title entry-title"><?php the_title(); ?></h1>
    </div>
    <?php
         if(has_post_thumbnail() && $options['news_show_image'] == 'display') {
           $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size2' );
    ?>
    <div class="image">
     <img src="<?php echo esc_attr($image[0]); ?>" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" />
    </div>
    <?php }; ?>
   </div>

   <?php
        // sns button top ------------------------------------------------------------------------------------------------------------------------
       if($options['single_news_show_sns'] == 'top' || $options['single_news_show_sns'] == 'both') {
   ?>
   <div class="single_share" id="single_share_top">
    <?php get_template_part('template-parts/share_button'); ?>
   </div>
   <?php }; ?>

   <?php
        // copy title&url button ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        if($options['single_news_show_copy'] == 'top' || $options['single_news_show_copy'] == 'both') {
   ?>
   <div class="single_copy_title_url" id="single_copy_title_url_top">
    <button class="single_copy_title_url_btn" data-clipboard-text="<?php echo esc_attr( strip_tags( get_the_title() ) . ' ' . get_permalink() ); ?>" data-clipboard-copied="<?php echo esc_attr( __( 'COPIED TITLE &amp; URL', 'tcd-seeed' ) ); ?>"><?php _e( 'COPY TITLE &amp; URL', 'tcd-seeed' ); ?></button>
   </div>
   <?php }; ?>

   <?php
        // 追加コンテンツ（上） ------------------------------------------------------------------------------------------------------------------------
        if(!is_mobile()) {
          if( $options['single_news_top_ad_code']) {
   ?>
   <div id="single_banner_top" class="single_banner">
    <?php echo $options['single_news_top_ad_code']; ?>
   </div><!-- END #single_banner_top -->
   <?php
          };
        } else {
          if( $options['single_news_top_ad_code_mobile']) {
   ?>
   <div id="single_banner_top" class="single_banner">
    <?php echo $options['single_news_top_ad_code_mobile']; ?>
   </div><!-- END #single_banner_top -->
   <?php
          };
        };
   ?>

   <?php }; // 1ページ目のみ表示ここまで ?>

   <?php // post content ------------------------------------------------------------------------------------------------------------------------ ?>
   <div class="post_content clearfix">
    <?php
         the_content();
         if ( ! post_password_required() ) {
           custom_wp_link_pages();
         }
    ?>
   </div>

   <?php
        // copy title&url button ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        if($options['single_news_show_copy'] == 'bottom' || $options['single_news_show_copy'] == 'both') {
   ?>
   <div class="single_copy_title_url" id="single_copy_title_url_btm">
    <button class="single_copy_title_url_btn" data-clipboard-text="<?php echo esc_attr( strip_tags( get_the_title() ) . ' ' . get_permalink() ); ?>" data-clipboard-copied="<?php echo esc_attr( __( 'COPIED TITLE &amp; URL', 'tcd-seeed' ) ); ?>"><?php _e( 'COPY TITLE &amp; URL', 'tcd-seeed' ); ?></button>
   </div>
   <?php }; ?>

   <?php
        // sns button ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        if($options['single_news_show_sns'] == 'bottom' || $options['single_news_show_sns'] == 'both') {
   ?>
   <div class="single_share" id="single_share_bottom">
    <?php get_template_part('template-parts/share_button'); ?>
   </div>
   <?php }; ?>

   <?php
        // page nav ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
   ?>
   <div id="next_prev_post" class="clearfix">
    <?php next_prev_post_link(); ?>
   </div>

   <?php endwhile; endif; ?>

  </article><!-- END #article -->

  <?php
       // 追加コンテンツ（下） ------------------------------------------------------------------------------------------------------------------------
       if(!is_mobile()) {
         if( $options['single_news_bottom_ad_code'] ) {
  ?>
  <div id="single_banner_bottom" class="single_banner">
   <?php echo $options['single_news_bottom_ad_code']; ?>
  </div><!-- END #single_banner_bottom -->
  <?php
         };
       } else {
         if( $options['single_news_bottom_ad_code_mobile'] ) {
  ?>
  <div id="single_banner_bottom" class="single_banner">
   <?php echo $options['single_news_bottom_ad_code_mobile']; ?>
  </div><!-- END #single_banner_bottom -->
  <?php
         };
       };
  ?>

  <?php
       // recent post ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
         $post_num = $options['recent_news_num'];
         if(is_mobile()){
           $post_num = $options['recent_news_num_sp'];
         }
         $args =  array('post_type' => 'news', 'posts_per_page' => $post_num, 'ignore_sticky_posts' => 1);
         $recent_post_list = new wp_query($args);
         if($recent_post_list->have_posts()):
           $total = $recent_post_list->post_count;
  ?>
  <div id="related_post">

   <h3 class="headline"><?php echo wp_kses_post(nl2br($options['recent_news_headline'])); ?></h3>

   <div class="related_post_carousel swiper<?php if($total < 3){ echo ' small_size'; }; ?>">
    <div class="post_list swiper-wrapper">
     <?php
          while( $recent_post_list->have_posts() ) : $recent_post_list->the_post();
            if($options['news_show_image'] == 'display'){
              if(has_post_thumbnail()) {
                $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size3' );
              } elseif($options['no_image']) {
                $image = wp_get_attachment_image_src( $options['no_image'], 'full' );
              } else {
                $image = array();
                $image[0] = get_bloginfo('template_url') . "/img/no_image2.gif";
                $image[1] = '480';
                $image[2] = '306';
              }
            }
     ?>
     <a class="item animate_background swiper-slide" href="<?php the_permalink(); ?>">
      <?php if($options['news_show_image'] == 'display'){ ?>
      <div class="image_wrap">
       <img loading="lazy" class="image" src="<?php echo esc_attr($image[0]); ?>" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" />
      </div>
      <?php }; ?>
      <div class="content">
       <time class="date entry-date published" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time>
       <h4 class="title"><span><?php the_title(); ?></span></h4>
      </div>
     </a>
     <?php endwhile; wp_reset_query(); ?>
    </div><!-- END .post_list -->
   </div><!-- END .related_post_carousel -->

  </div><!-- END #related_post -->
  <?php
         endif;
  ?>

 </div><!-- END #main_col -->

 <?php
      // widget ------------------------
      get_sidebar();
 ?>

</div><!-- END #main_content -->

<?php get_footer(); ?>