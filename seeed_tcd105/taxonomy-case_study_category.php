<?php
     get_header();
     $options = get_design_plus_option();

     $query_obj = get_queried_object();
     $current_cat_id = $query_obj->term_id;
     $term_meta = get_option( 'taxonomy_' . $current_cat_id, array() );
     $headline = single_cat_title('', false);
     $image = !empty($term_meta['header_image']) ? $term_meta['header_image'] : $options['archive_case_study_header_image'];
     $image = wp_get_attachment_image_src($image, 'full');
     if(!empty($term_meta['header_image'])){
       $overlay_color = !empty($term_meta['overlay_color']) ? $term_meta['overlay_color'] : '#000000';
       $overlay_color = hex2rgb($overlay_color);
       $overlay_opacity = !empty($term_meta['overlay_opacity']) ? $term_meta['overlay_opacity'] : '0.2';
     } else {
       $overlay_color = hex2rgb($options['archive_case_study_overlay_color']);
       $overlay_opacity = $options['archive_case_study_overlay_opacity'];
     }
     $overlay_color = implode(",",$overlay_color);
     $desc = term_description( $current_cat_id, 'case_study_category' );
     $desc_mobile = !empty($term_meta['desc_mobile']) ? $term_meta['desc_mobile'] : '';
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

<?php if(!is_paged() && $desc){ ?>
<div id="archive_desc">
 <div class="desc<?php if($desc_mobile){ echo ' pc'; }; ?> post_content"><?php echo wp_kses_post($desc); ?></div>
 <?php if($desc_mobile){ ?>
 <div class="desc mobile post_content"><?php echo wp_kses_post($desc_mobile); ?></div>
 <?php }; ?>
</div>
<?php }; ?>

<section id="archive_case_study">

 <?php if ( have_posts() ) : ?>

 <div class="case_study_list">
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
  </div>
  <?php endwhile; ?>
 </div><!-- END .case_study_list -->

 <?php get_template_part('template-parts/navigation'); ?>

 <?php else: ?>

 <p id="no_post"><?php _e('There is no registered post.', 'tcd-seeed');  ?></p>

 <?php endif; ?>

</section><!-- END #archive_case_study -->

<?php
     // カテゴリー一覧 --------------------------------------
     if($options['show_case_study_category_list']){
       $case_study_category_list = get_terms( 'case_study_category', array( 'hide_empty' => true ) );
       if ( $case_study_category_list && ! is_wp_error( $case_study_category_list ) ) {
         $total = count($case_study_category_list);
?>
<div id="case_study_category_list_area">

 <div id="case_study_category_list_slider_wrap"<?php if($total == 2){ echo ' class="two_item"'; } elseif($total == 1){ echo ' class="one_item"'; }; ?>>
  <div id="case_study_category_list_slider" class="swiper">
   <div id="case_study_category_list" class="swiper-wrapper">
    <?php
         foreach ( $case_study_category_list as $cat ):
           $cat_id = $cat->term_id;
           $cat_url = get_term_link($cat_id,'case_study_category');
           $term_meta = get_option( 'taxonomy_' . $cat_id, array() );
           $headline = !empty($term_meta['headline']) ? $term_meta['headline'] : '';
           $catch = !empty($term_meta['catch']) ? $term_meta['catch'] : $cat->name;
           $desc = term_description( $cat_id, 'case_study_category' );
    ?>
    <a class="item swiper-slide" href="<?php echo esc_url($cat_url); ?>">
     <div class="catch_area case_cat_id<?php echo esc_attr($cat_id); ?>">
      <?php if($headline){ ?>
      <h4 class="headline"><?php echo wp_kses_post(nl2br($headline)); ?></h4>
      <?php }; ?>
      <h5 class="catch"><?php echo wp_kses_post(nl2br($catch)); ?></h5>
     </div>
     <?php if($desc){ ?>
     <div class="desc">
      <div class="desc_inner"><?php echo apply_filters('the_content', $desc ); ?></div>
     </div>
     <?php }; ?>
    </a>
    <?php endforeach; ?>
   </div>
  </div>
  <div class="case_study_category_list_prev swiper-nav-button swiper-button-prev"></div>
  <div class="case_study_category_list_next swiper-nav-button swiper-button-next"></div>
 </div>

</div>
<?php }; }; ?>

<?php get_footer(); ?>