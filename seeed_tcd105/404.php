<?php
     get_header();
     $options = get_design_plus_option();
     $bg_image = wp_get_attachment_image_src($options['page_404_bg_image'], 'full');
     $overlay_color = hex2rgb($options['page_404_overlay_color']);
     $overlay_opacity = $options['page_404_overlay_opacity'];
     $overlay_color = implode(",",$overlay_color);
?>

<div id="page_404_header"<?php if(empty($bg_image)){ echo ' class="no_bg_image"'; }; ?>>

 <div class="content inview">
  <h2 class="headline item"><?php if($options['page_404_headline']){ echo nl2br(esc_html($options['page_404_headline'])); } else { echo '404 NOT FOUND'; }; ?></h2>
  <?php if ($options['page_404_desc']) { ?>
  <p class="desc item"><?php echo wp_kses_post(nl2br($options['page_404_desc'])); ?></p>
  <?php } ?>
 </div>

 <?php if($options['page_404_overlay_opacity'] != 0 && !empty($bg_image)){ ?>
 <div class="overlay" style="background-color:rgba(<?php echo esc_attr($overlay_color); ?>,<?php echo esc_attr($overlay_opacity); ?>);"></div>
 <?php }; ?>

 <?php if(!empty($bg_image)) { ?>
 <div class="bg_image" style="background:url(<?php echo esc_attr($bg_image[0]); ?>) no-repeat center top; background-size:cover;"></div>
 <?php }; ?>

</div>

<?php get_footer(); ?>