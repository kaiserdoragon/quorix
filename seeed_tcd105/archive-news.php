<?php
     get_header();
     $options = get_design_plus_option();
     $headline = $options['archive_news_headline'];
     $image = wp_get_attachment_image_src($options['archive_news_header_image'], 'full');
     $overlay_color = hex2rgb($options['archive_news_overlay_color']);
     $overlay_color = implode(",",$overlay_color);
     $overlay_opacity = $options['archive_news_overlay_opacity'];
     $desc = $options['archive_news_desc'];
     $desc_mobile = $options['archive_news_desc_mobile'];
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

<?php if(!is_paged() && $desc && $image){ ?>
<div id="archive_desc">
 <p class="desc<?php if($desc_mobile){ echo ' pc'; }; ?> post_content"><?php echo wp_kses_post(nl2br($desc)); ?></p>
 <?php if($desc_mobile){ ?>
 <p class="desc mobile post_content"><?php echo wp_kses_post(nl2br($desc_mobile)); ?></p>
 <?php }; ?>
</div>
<?php }; ?>

<section id="archive_news">

 <?php if ( have_posts() ) : ?>

 <div class="news_list">
  <?php
       while ( have_posts() ) : the_post();
         if($options['news_show_image'] == 'display'){
           if(has_post_thumbnail()) {
             $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size1' );
           } elseif($options['no_image']) {
             $image = wp_get_attachment_image_src( $options['no_image'], 'full' );
           } else {
             $image = array();
             $image[0] = get_bloginfo('template_url') . "/img/no_image1.gif";
             $image[1] = '210';
             $image[2] = '210';
           }
         };
  ?>
  <div class="item">
   <?php if($options['news_show_image'] == 'display'){ ?>
   <a class="image_link animate_background" href="<?php the_permalink(); ?>">
    <div class="image_wrap">
     <img loading="lazy" class="image" src="<?php echo esc_attr($image[0]); ?>" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" />
    </div>
   </a>
   <?php }; ?>
   <div class="content">
    <time class="date entry-date published" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time>
    <h4 class="title"><a href="<?php the_permalink(); ?>"><span><?php the_title(); ?></span></a></h4>
   </div>
  </div>
  <?php endwhile; ?>
 </div><!-- END .news_list -->

 <?php get_template_part('template-parts/navigation'); ?>

 <?php else: ?>

 <p id="no_post"><?php _e('There is no registered post.', 'tcd-seeed');  ?></p>

 <?php endif; ?>

</section><!-- END #archive_news -->

<?php get_footer(); ?>