<?php
     get_header();
     $options = get_design_plus_option();
     $hide_sidebar = get_post_meta($post->ID, 'hide_sidebar', true) ?  get_post_meta($post->ID, 'hide_sidebar', true) : 'hide';
     $hide_breadcrumb = get_post_meta($post->ID, 'hide_breadcrumb', true) ?  get_post_meta($post->ID, 'hide_breadcrumb', true) : 'no';
     $headline = get_post_meta($post->ID, 'header_headline', true) ?  get_post_meta($post->ID, 'header_headline', true) : get_the_title();
     $image = wp_get_attachment_image_src(get_post_meta($post->ID, 'header_image', true), 'full');
     $overlay_color = get_post_meta($post->ID, 'header_overlay_color', true) ?  get_post_meta($post->ID, 'header_overlay_color', true) : '#000000';
     $overlay_color = hex2rgb($overlay_color);
     $overlay_color = implode(",",$overlay_color);
     $overlay_opacity = get_post_meta($post->ID, 'header_overlay_color_opacity', true) ?  get_post_meta($post->ID, 'header_overlay_color_opacity', true) : '0.3';
     if($overlay_opacity == 'zero'){
       $overlay_opacity = '0';
     }
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

<?php if($hide_breadcrumb != 'yes'){ get_template_part('template-parts/breadcrumb'); }; ?>

<?php if($hide_sidebar == 'hide'){ ?>

<article id="page_contents">

 <div class="post_content clearfix">
  <?php
       the_content();
       if ( ! post_password_required() ) {
         custom_wp_link_pages();
       }
  ?>
 </div>

</article><!-- END #page_contents -->

<?php } else { ?>

<div id="main_content">

 <div id="main_col">

  <article id="article">

   <div class="post_content clearfix">
    <?php
         the_content();
         if ( ! post_password_required() ) {
           custom_wp_link_pages();
         }
    ?>
   </div>

 </div><!-- END #main_col -->

 <?php get_sidebar(); ?>

</div><!-- END #main_contents -->

<?php }; ?>

<?php get_footer(); ?>