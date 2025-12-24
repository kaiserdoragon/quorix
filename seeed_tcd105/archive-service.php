<?php
     get_header();
     $options = get_design_plus_option();
     $headline = $options['archive_service_headline'];
     $image = wp_get_attachment_image_src($options['archive_service_header_image'], 'full');
     $overlay_color = hex2rgb($options['archive_service_overlay_color']);
     $overlay_color = implode(",",$overlay_color);
     $overlay_opacity = $options['archive_service_overlay_opacity'];
     $desc = $options['archive_service_desc'];
     $desc_mobile = $options['archive_service_desc_mobile'];
?>
<div id="page_header">

 <?php if($headline){ ?>
 <h1 class="headline" style="background:rgba(<?php echo esc_attr($overlay_color); ?>,0.3);"><span><?php echo wp_kses_post(nl2br($headline)); ?></span></h1>
 <?php }; ?>

 <?php if(!$image && $desc){ ?>
 <p class="desc<?php if($desc_mobile){ echo ' pc'; }; ?> post_content"><?php echo wp_kses_post(nl2br($desc)); ?></p>
 <?php if($desc_mobile){ ?>
 <p class="desc mobile post_content"><?php echo wp_kses_post(nl2br($desc_mobile)); ?></p>
 <?php }; ?>
 <?php }; ?>

 <?php if($image) { ?>
 <div class="overlay" style="background:rgba(<?php echo esc_attr($overlay_color); ?>,<?php echo esc_attr($overlay_opacity); ?>);"></div>
 <img src="<?php echo esc_attr($image[0]); ?>" alt="" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>">
 <?php }; ?>

</div>

<?php
     if($options['archive_service_list_type'] != 'type3'){

     // アイコン記事一覧 --------------------------------------
     if($options['archive_service_list_type'] != 'type4'){
       $args = array('post_type' => 'service', 'posts_per_page' => -1, 'ignore_sticky_posts' => 1, 'orderby' => array('menu_order' => 'ASC', 'date' => 'DESC'));
       $post_list = new wp_query($args);
       if($post_list->have_posts()):
         $total = $post_list->post_count;
?>
<div id="service_category_list">

 <?php if($desc && $image){ ?>
 <p class="desc<?php if($desc_mobile){ echo ' pc'; }; ?> post_content"><?php echo wp_kses_post(nl2br($desc)); ?></p>
 <?php if($desc_mobile){ ?>
 <p class="desc mobile post_content"><?php echo wp_kses_post(nl2br($desc_mobile)); ?></p>
 <?php }; ?>
 <?php }; ?>

 <?php if($options['service_icon_list_type'] == 'type1'){ ?>

 <ul id="service_icon_list_type1"<?php if($total < 5){ echo ' class="short_size"'; }; ?>>
  <?php
       while ($post_list->have_posts()) : $post_list->the_post();
         $post_id = $post->ID;
         $icon = get_post_meta($post->ID, 'service_icon', true);
         $icon_image = get_post_meta($post->ID, 'service_icon_image', true);
         $icon_image = wp_get_attachment_image_src($icon_image, 'full');
         $title = get_post_meta($post->ID, 'service_sub_title', true) ?  get_post_meta($post->ID, 'service_sub_title', true) : get_the_title();
  ?>
  <li>
   <a href="#service_post<?php echo esc_attr($post_id); ?>">
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
         $post_id = $post->ID;
         $icon = get_post_meta($post->ID, 'service_icon', true);
         $icon_image = get_post_meta($post->ID, 'service_icon_image', true);
         $icon_image = wp_get_attachment_image_src($icon_image, 'full');
         $title = get_post_meta($post->ID, 'service_sub_title', true) ?  get_post_meta($post->ID, 'service_sub_title', true) : get_the_title();
  ?>
  <li>
   <a href="#service_post<?php echo esc_attr($post_id); ?>">
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
         endif;
       wp_reset_query();
     } else {
?>
<div id="service_category_list">

 <?php if($desc && $image){ ?>
 <p class="desc<?php if($desc_mobile){ echo ' pc'; }; ?> post_content"><?php echo wp_kses_post(nl2br($desc)); ?></p>
 <?php if($desc_mobile){ ?>
 <p class="desc mobile post_content"><?php echo wp_kses_post(nl2br($desc_mobile)); ?></p>
 <?php }; ?>
 <?php }; ?>

</div>
<?php
     };
?>

<section id="archive_service"<?php if($options['archive_service_list_type'] == 'type4'){ echo ' class="type4"'; }; ?>>

 <?php if ( have_posts() ) : ?>

 <?php if($options['archive_service_list_type'] == 'type1'){ ?>

 <div id="service_list_type1">
  <?php
       while ( have_posts() ) : the_post();
         if(has_post_thumbnail()) {
           $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size2' );
         } elseif($options['no_image']) {
           $image = wp_get_attachment_image_src( $options['no_image'], 'full' );
         } else {
           $image = array();
           $image[0] = get_bloginfo('template_url') . "/img/no_image2.gif";
           $image[1] = '480';
           $image[2] = '300';
         }
         $desc = get_post_meta($post->ID, 'service_desc', true) ?  get_post_meta($post->ID, 'service_desc', true) : trim_excerpt(200);
  ?>
  <div class="item" id="service_post<?php echo esc_attr($post->ID); ?>">
   <h3 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
   <div class="content">
    <a class="image_link animate_background" href="<?php the_permalink(); ?>">
     <div class="image_wrap">
      <img loading="lazy" class="image" src="<?php echo esc_attr($image[0]); ?>" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" />
     </div>
    </a>
    <p class="desc"><span><?php echo wp_kses_post(nl2br($desc)); ?></span></p>
   </div>
   <div class="link_button">
    <a class="design_button" href="<?php the_permalink(); ?>"><?php _e( 'View more', 'tcd-seeed' ); ?></a>
   </div>
  </div>
  <?php endwhile; ?>
 </div><!-- END .service_list_type1 -->

 <?php } else { ?>

 <div id="service_list_type2">
  <?php
       while ( have_posts() ) : the_post();
         if(has_post_thumbnail()) {
           $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size2' );
         } elseif($options['no_image']) {
           $image = wp_get_attachment_image_src( $options['no_image'], 'full' );
         } else {
           $image = array();
           $image[0] = get_bloginfo('template_url') . "/img/no_image2.gif";
           $image[1] = '480';
           $image[2] = '300';
         }
         $desc = get_post_meta($post->ID, 'service_desc', true) ?  get_post_meta($post->ID, 'service_desc', true) : trim_excerpt(200);
  ?>
  <div class="item" id="service_post<?php echo esc_attr($post->ID); ?>">
   <a class="image_link animate_background" href="<?php the_permalink(); ?>">
    <div class="image_wrap">
     <img loading="lazy" class="image" src="<?php echo esc_attr($image[0]); ?>" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" />
    </div>
   </a>
   <div class="content">
    <h3 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
    <p class="desc"><span><?php echo wp_kses_post(nl2br($desc)); ?></span></p>
    <a class="link" href="<?php the_permalink(); ?>"><?php _e( 'View more', 'tcd-seeed' ); ?></a>
   </div>
  </div>
  <?php endwhile; ?>
 </div><!-- END .service_list_type2 -->

 <?php }; ?>

 <?php if($options['archive_service_list_type'] == 'type4'){ get_template_part('template-parts/navigation'); }; ?>

 <?php else: ?>

 <p id="no_post"><?php _e('There is no registered post.', 'tcd-seeed');  ?></p>

 <?php endif; ?>

</section><!-- END #archive_service -->

<?php } else { ?>

<?php
     // アイコン記事一覧 （サービス一覧タイプ3）--------------------------------------
?>
<div id="service_category_list" class="service_list_type3">

 <?php if(!is_paged() && $desc && $image){ ?>
 <p class="desc<?php if($desc_mobile){ echo ' pc'; }; ?> post_content"><?php echo wp_kses_post(nl2br($desc)); ?></p>
 <?php if($desc_mobile){ ?>
 <p class="desc mobile post_content"><?php echo wp_kses_post(nl2br($desc_mobile)); ?></p>
 <?php }; ?>
 <?php }; ?>

 <?php if ( have_posts() ) : ?>

 <?php if($options['service_icon_list_type'] == 'type1'){ ?>

 <ul id="service_icon_list_type1">
  <?php
       while ( have_posts() ) : the_post();
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

 <ul id="service_icon_list_type2">
  <?php
       while ( have_posts() ) : the_post();
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

 <?php get_template_part('template-parts/navigation'); ?>

 <?php else: ?>

 <p id="no_post"><?php _e('There is no registered post.', 'tcd-seeed');  ?></p>

 <?php endif; ?>

</div>

<?php }; ?>

<?php get_footer(); ?>