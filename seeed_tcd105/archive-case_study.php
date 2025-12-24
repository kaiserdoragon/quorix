<?php
     get_header();
     $options = get_design_plus_option();
     $headline = $options['archive_case_study_headline'];
     $image = wp_get_attachment_image_src($options['archive_case_study_header_image'], 'full');
     $overlay_color = hex2rgb($options['archive_case_study_overlay_color']);
     $overlay_color = implode(",",$overlay_color);
     $overlay_opacity = $options['archive_case_study_overlay_opacity'];
     $desc = $options['archive_case_study_desc'];
     $desc_mobile = $options['archive_case_study_desc_mobile'];
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

<section id="archive_case_study">

 <?php if ( have_posts() ) : ?>

 <div class="case_study_list<?php if ($options['case_study_show_date'] == 'display'){ echo ' show_date'; }; ?>">
  <?php
       while ( have_posts() ) : the_post();
         if(has_post_thumbnail()) {
           $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size4' );
         } elseif($options['no_image']) {
           $image = wp_get_attachment_image_src( $options['no_image'], 'full' );
         } else {
           $image = array();
           $image[0] = get_bloginfo('template_url') . "/img/no_image2.gif";
           $image[1] = '515';
           $image[2] = '320';
         }
         $name = get_post_meta($post->ID, 'case_study_name', true);
         $job = get_post_meta($post->ID, 'case_study_job', true);
  ?>
  <div class="item<?php if ($options['case_study_show_date'] == 'display'){ echo ' show_date'; }; ?>">
   <a class="animate_background" href="<?php the_permalink(); ?>">
    <div class="title_area">
     <?php if ($options['case_study_show_date'] == 'display'){ ?>
     <time class="date entry-date published" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time>
     <?php }; ?>
     <h4 class="title"><span><?php the_title(); ?></span></h4>
    </div>
    <div class="image_wrap">
     <img loading="lazy" class="image" src="<?php echo esc_attr($image[0]); ?>" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" />
    </div>
    <?php if($job || $name){ ?>
    <div class="meta">
     <ul>
      <?php if($job){ ?><li class="job"><?php echo esc_html($job); ?></li><?php }; ?>
      <?php if($name){ ?><li class="name"><?php echo esc_html($name); ?></li><?php }; ?>
     </ul>
    </div>
    <?php }; ?>
   </a>
   <?php
        $category = wp_get_post_terms( $post->ID, 'case_study_category' , array( 'orderby' => 'term_order' ));
        if ( $category && ! is_wp_error($category) ) {
          foreach ( $category as $cat ) :
            $cat_name = $cat->name;
            $cat_id = $cat->term_id;
            break;
          endforeach;
   ?>
   <a class="category case_cat_id<?php echo esc_attr($cat_id); ?>" href="<?php echo esc_url(get_term_link($cat_id,'case_study_category')); ?>"><?php echo esc_html($cat_name); ?></a>
   <?php }; ?>
  </div>
  <?php endwhile; ?>
 </div><!-- END .case_study_list -->

 <?php get_template_part('template-parts/navigation'); ?>

 <?php else: ?>

 <p id="no_post"><?php _e('There is no registered post.', 'tcd-seeed');  ?></p>

 <?php endif; ?>

</section><!-- END #archive_case_study -->

<?php get_footer(); ?>