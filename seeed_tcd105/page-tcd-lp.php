<?php
/*
Template Name:Landing page
*/
__('Landing page', 'tcd-seeed');
     get_header();
     $options = get_design_plus_option();
     $catch = get_post_meta($post->ID, 'lp_catch', true) ?  get_post_meta($post->ID, 'lp_catch', true) : get_the_title();
     $catch_mobile = get_post_meta($post->ID, 'lp_catch_mobile', true);
     $catch_font_type = get_post_meta($post->ID, 'lp_catch_font_type', true) ?  get_post_meta($post->ID, 'lp_catch_font_type', true) : 'type2';
     $image = wp_get_attachment_image_src(get_post_meta($post->ID, 'lp_image', true), 'full');
     $image_mobile = wp_get_attachment_image_src(get_post_meta($post->ID, 'lp_image_mobile', true), 'full');
     $overlay_color = get_post_meta($post->ID, 'lp_header_overlay_color', true) ?  get_post_meta($post->ID, 'lp_header_overlay_color', true) : '#000000';
     $overlay_color = hex2rgb($overlay_color);
     $overlay_color = implode(",",$overlay_color);
     $overlay_opacity = get_post_meta($post->ID, 'lp_header_overlay_color_opacity', true) ?  get_post_meta($post->ID, 'lp_header_overlay_color_opacity', true) : '0.3';
     if($overlay_opacity == 'zero'){
       $overlay_opacity = '0';
     }
     $hide_page_header = get_post_meta($post->ID, 'hide_page_header', true) ?  get_post_meta($post->ID, 'hide_page_header', true) : 'no';
     if($hide_page_header != 'yes'){
?>
<div id="lp_page_header">

 <?php if($catch){ ?>
 <h1 class="catch rich_font_<?php echo esc_attr($catch_font_type); ?>"><?php if($catch_mobile){ echo '<span class="pc">'; }; ?><?php echo wp_kses_post(nl2br($catch)); ?><?php if($catch_mobile){ echo '</span><span class="mobile">' . wp_kses_post(nl2br($catch_mobile)) . '</span>'; }; ?></h1>
 <?php }; ?>

 <div class="overlay" style="background:rgba(<?php echo esc_attr($overlay_color); ?>,<?php echo esc_attr($overlay_opacity); ?>);"></div>
 <?php if($image) { ?>
 <div class="bg_image">
  <picture>
   <?php if($image_mobile) { ?>
   <source media="(max-width: 800px)" srcset="<?php echo esc_attr($image_mobile[0]); ?>">
   <?php }; ?>
   <img src="<?php echo esc_attr($image[0]); ?>" alt="" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>">
  </picture>
 </div>
 <?php }; ?>

</div>
<?php }; ?>

<?php
  $hide_page_header_bar = get_post_meta($post->ID, 'hide_page_header_bar', true) ?  get_post_meta($post->ID, 'hide_page_header_bar', true) : 'no';
  $myClass='';
  if($hide_page_header == 'yes') $myClass .= 'no_page_header ';
  if($hide_page_header_bar == 'yes') $myClass .= 'no_page_header_bar';
?>
<article id="page_contents"<?php if($hide_page_header == 'yes'||$hide_page_header_bar == 'yes'){ echo 'class="'.$myClass.'"'; }; ?>>

 <div class="post_content clearfix">
  <?php
       if($hide_page_header == 'yes'){
  ?>
  <?php if($catch){ ?>
  <h1 class="catch rich_font_<?php echo esc_attr($catch_font_type); ?>"><?php if($catch_mobile){ echo '<span class="pc">'; }; ?><?php echo wp_kses_post(nl2br($catch)); ?><?php if($catch_mobile){ echo '</span><span class="mobile">' . wp_kses_post(nl2br($catch_mobile)) . '</span>'; }; ?></h1>
  <?php }; ?>
  <?php
       }
       the_content();
       if ( ! post_password_required() ) {
         custom_wp_link_pages();
       }
  ?>
 </div>

</article><!-- END #page_contents -->

<?php get_footer(); ?>