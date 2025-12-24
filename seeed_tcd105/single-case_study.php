<?php
     get_header();
     $options = get_design_plus_option();
     $headline = $options['archive_case_study_headline'];
     $image = wp_get_attachment_image_src($options['archive_case_study_header_image'], 'full');
     $overlay_color = hex2rgb($options['archive_case_study_overlay_color']);
     $overlay_color = implode(",",$overlay_color);
     $overlay_opacity = $options['archive_case_study_overlay_opacity'];
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

<article id="single_case">

 <?php
      if ( have_posts() ) : while ( have_posts() ) : the_post();
        $category = wp_get_post_terms( $post->ID, 'case_study_category' , array( 'orderby' => 'term_order' ));
        if ( $category && ! is_wp_error($category) ) {
          foreach ( $category as $cat ) :
            $cat_name = $cat->name;
            $cat_id = $cat->term_id;
            $cat_url = get_term_link($cat_id,'case_study_category');
            break;
          endforeach;
        };
        $name = get_post_meta($post->ID, 'case_study_name', true);
        $job = get_post_meta($post->ID, 'case_study_job', true);
 ?>

 <div id="single_case_header">
  <?php if ( $category && ! is_wp_error($category) ) { ?>
  <div class="category">
   <?php
        foreach ( $category as $cat ) :
          $cat_name = $cat->name;
          $cat_id = $cat->term_id;
          $cat_url = get_term_link($cat_id,'case_study_category');
   ?>
   <a class="case_cat_id<?php echo esc_attr($cat_id); ?>" href="<?php echo esc_url($cat_url); ?>"><?php echo esc_html($cat_name); ?></a>
   <?php endforeach; ?>
  </div>
  <?php }; ?>
  <div class="meta">
   <?php if($job){ ?>
   <p class="job"><?php echo esc_html($job); ?></p>
   <?php }; ?>
   <?php if($name){ ?>
   <p class="name"><?php echo esc_html($name); ?></p>
   <?php }; ?>
  </div>
 </div>

 <div id="single_case_title_area">
  <?php if ($options['case_study_show_date'] == 'display'){ ?>
  <time class="date entry-date published" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time>
  <?php }; ?>
  <h1 class="title entry-title"><?php the_title(); ?></h1>
  <?php
       if(has_post_thumbnail()) {
         $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size4' );
  ?>
  <div class="image">
   <img src="<?php echo esc_attr($image[0]); ?>" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" />
  </div>
  <?php }; ?>
 </div>

   <?php
        // 追加コンテンツ（上） ------------------------------------------------------------------------------------------------------------------------
        if(!is_mobile()) {
          if( $options['single_case_study_top_ad_code']) {
   ?>
   <div id="single_banner_top" class="single_banner">
    <?php echo $options['single_case_study_top_ad_code']; ?>
   </div><!-- END #single_banner_top -->
   <?php
          };
        } else {
          if( $options['single_case_study_top_ad_code_mobile']) {
   ?>
   <div id="single_banner_top" class="single_banner">
    <?php echo $options['single_case_study_top_ad_code_mobile']; ?>
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
         if( $options['single_case_study_bottom_ad_code'] ) {
  ?>
  <div id="single_banner_bottom" class="single_banner">
   <?php echo $options['single_case_study_bottom_ad_code']; ?>
  </div><!-- END #single_banner_bottom -->
  <?php
         };
       } else {
         if( $options['single_case_study_bottom_ad_code_mobile'] ) {
  ?>
  <div id="single_banner_bottom" class="single_banner">
   <?php echo $options['single_case_study_bottom_ad_code_mobile']; ?>
  </div><!-- END #single_banner_bottom -->
  <?php
         };
       };
  ?>

 <?php
      // 関連記事 ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
      $post_num = $options['related_case_study_num'];
      if(is_mobile()){
        $post_num = $options['related_case_study_num_sp'];
      }
      if ($category) {
        $args = array( 'post_type' => 'case_study', 'posts_per_page' => $post_num, 'post__not_in' => array($post->ID), 'orderby' => array('menu_order' => 'ASC', 'date' => 'DESC'), 'tax_query' => array( array( 'taxonomy' => 'case_study_category', 'field' => 'id', 'terms' => $cat_id)) );
      } else {
        $args = array( 'post_type' => 'case_study', 'posts_per_page' => $post_num, 'post__not_in' => array($post->ID), 'orderby' => array('menu_order' => 'ASC', 'date' => 'DESC') );
      }
      $related_post_list = new wp_query($args);
      $total = $related_post_list->post_count;
      if($related_post_list->have_posts()):
 ?>
 <div id="related_case"<?php if($total == 1){ echo ' class="one_item"'; }; ?>>

  <?php if($options['related_case_study_headline']){ ?>
  <h3 class="headline"><?php echo wp_kses_post(nl2br($options['related_case_study_headline'])); ?></h3>
  <?php }; ?>

  <div id="case_study_slider" class="swiper<?php if ($options['case_study_show_date'] == 'display'){ echo ' show_date'; }; ?>">
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
             $image[2] = '306';
           }
           $name = get_post_meta($post->ID, 'case_study_name', true);
           $job = get_post_meta($post->ID, 'case_study_job', true);
    ?>
    <div class="item swiper-slide<?php if(!$name && !$job){ echo ' no_meta'; }; if ($options['case_study_show_date'] == 'display'){ echo ' show_date'; }; ?>">
     <a class="image_link animate_background" href="<?php the_permalink(); ?>">
      <div class="image_wrap">
       <img loading="lazy" class="image" src="<?php echo esc_attr($image[0]); ?>" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" />
      </div>
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
     <h4 class="title">
      <?php if ($options['case_study_show_date'] == 'display'){ ?>
      <time class="date entry-date published" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time>
      <?php }; ?>
      <a href="<?php the_permalink(); ?>"><span><?php the_title(); ?></span></a>
     </h4>
     <?php if($job || $name){ ?>
     <div class="meta">
      <ul>
       <?php if($job){ ?><li class="job"><?php echo esc_html($job); ?></li><?php }; ?>
       <?php if($name){ ?><li class="name"><?php echo esc_html($name); ?></li><?php }; ?>
      </ul>
     </div>
     <?php }; ?>
    </div>
    <?php endwhile; wp_reset_query(); ?>
   </div><!-- END .post_list -->
  </div><!-- END #case_study_slider -->

  <div id="case_study_slider_pagination" class="swiper-pagination"></div>

 </div><!-- END #related_case -->
 <?php
      endif;
 ?>

</article><!-- END #single_case -->

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