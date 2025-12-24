<?php
     get_header();
     $options = get_design_plus_option();
     $headline = $options['archive_blog_headline'];
     $image = wp_get_attachment_image_src($options['archive_blog_header_image'], 'full');
     $overlay_color = hex2rgb($options['archive_blog_overlay_color']);
     $overlay_color = implode(",",$overlay_color);
     $overlay_opacity = $options['archive_blog_overlay_opacity'];
     $desc = $options['archive_blog_desc'];
     $desc_mobile = $options['archive_blog_desc_mobile'];
     if (is_category()) {
       $query_obj = get_queried_object();
       $current_cat_id = $query_obj->term_id;
       $term_meta = get_option( 'taxonomy_' . $current_cat_id, array() );
       $headline = $query_obj->name;
       $desc = $query_obj->description;
       $desc_mobile = !empty($term_meta['desc_mobile']) ? $term_meta['desc_mobile'] : '';
     } elseif(is_tag()) {
       $query_obj = get_queried_object();
       $current_cat_id = $query_obj->term_id;
       $term_meta = get_option( 'taxonomy_' . $current_cat_id, array() );
       $headline = $query_obj->name;
       $desc = $query_obj->description;
       $desc_mobile = !empty($term_meta['desc_mobile']) ? $term_meta['desc_mobile'] : '';
     } elseif ( is_day() ) {
       $headline = sprintf( __( 'Archive for %s', 'tcd-seeed' ), get_the_time( __( 'F jS, Y', 'tcd-seeed' ) ) );
       $desc = '';
       $desc_mobile = '';
     } elseif ( is_month() ) {
       $headline = sprintf( __( 'Archive for %s', 'tcd-seeed' ), get_the_time( __( 'F, Y', 'tcd-seeed') ) );
       $desc = '';
       $desc_mobile = '';
     } elseif ( is_year() ) {
       $headline = sprintf( __( 'Archive for %s', 'tcd-seeed' ), get_the_time( __( 'Y', 'tcd-seeed') ) );
       $desc = '';
       $desc_mobile = '';
     }
?>

<div id="page_header">

 <?php if($headline){ ?>
 <h1 class="headline" style="background:rgba(<?php echo esc_attr($overlay_color); ?>,0.3);"><?php echo esc_html($headline); ?></h1>
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
if(is_category() && $options['archive_blog_show_cat_list']!='hide'){
  get_template_part('template-parts/breadcrumb');
}; ?>

<?php if(!is_paged() && $desc && $image){ ?>
<div id="archive_desc">
 <p class="desc<?php if($desc_mobile){ echo ' pc'; }; ?> post_content"><?php echo wp_kses_post(nl2br($desc)); ?></p>
 <?php if($desc_mobile){ ?>
 <p class="desc mobile post_content"><?php echo wp_kses_post(nl2br($desc_mobile)); ?></p>
 <?php }; ?>
</div>
<?php }; ?>

<?php
if(is_category() && $options['archive_blog_show_cat_list']!='hide'){
  $parent_category_id = $query_obj->parent;
  $children_category = get_term_children($current_cat_id, 'category');
  if(empty($children_category)){
    $ancestors = get_ancestors($current_cat_id, 'category');
    if ($ancestors) {
      $ancestor_id = $ancestors[0];
    } else {
      $ancestor_id = $current_cat_id;
    }
  } else {
    $ancestor_id = $current_cat_id;
  }
  $args  = array('parent'  => $ancestor_id, 'orderby' => 'term_order', 'order' => 'ASC');
  $terms = get_terms('category', $args);
}elseif(is_home() && $options['archive_blog_show_cat_list']!='hide') {
  $terms = get_categories(array('parent'=>0));
  $current_cat_id = 0;
}else{
  $terms = false;
}
if($terms && $options['archive_blog_show_cat_list']!='hide'){
?>
 <div class="category_sort_button_wrap inview">
  <div class="category_sort_button_slider swiper">
   <div class="category_sort_button swiper-wrapper">
  <?php
       foreach($terms as $term):
         $term_name = $term->name;
         $term_link = get_term_link($term->slug, 'category');
  ?>
  <div class="item swiper-slide<?php if ($current_cat_id == $term->term_id) { echo ' active_menu'; }; ?>"><a href="<?php echo esc_url($term_link); ?>"><?php echo esc_html($term_name); ?></a></div>
  <?php endforeach; ?>
   </div>
  </div>
  <div class="category_sort_button_prev swiper-nav-button type2 swiper-button-prev"></div>
  <div class="category_sort_button_next swiper-nav-button type2 swiper-button-next"></div>
 </div>
<?php }; ?>

<section id="archive_blog">

 <?php if ( have_posts() ) : ?>

 <div class="blog_list">
  <?php
       while ( have_posts() ) : the_post();
         if(has_post_thumbnail()) {
           $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size2' );
         } elseif($options['no_image']) {
           $image = wp_get_attachment_image_src( $options['no_image'], 'full' );
         } else {
           $image = array();
           $image[0] = get_bloginfo('template_url') . "/img/no_image2.gif";
           $image[1] = '720';
           $image[2] = '460';
         }
  ?>
  <div class="item">
   <a class="image_link animate_background" href="<?php the_permalink(); ?>">
    <div class="image_wrap">
     <img loading="lazy" class="image" src="<?php echo esc_attr($image[0]); ?>" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" />
    </div>
   </a>
   <?php
        if(!is_category()) {
          $category = wp_get_post_terms( $post->ID, 'category' , array( 'orderby' => 'term_order' ));
          if ( $category && ! is_wp_error($category) ) {
            foreach ( $category as $cat ) :
              $cat_name = $cat->name;
              $cat_id = $cat->term_id;
              break;
            endforeach;
   ?>
   <a class="category_button" href="<?php echo esc_url(get_term_link($cat_id,'category')); ?>"><?php echo esc_html($cat_name); ?></a>
   <?php
          };
        };
   ?>
   <div class="content">
    <h4 class="title"><a href="<?php the_permalink(); ?>"><span><?php the_title(); ?></span></a></h4>
    <?php if ($options['blog_show_date'] == 'display'){ ?>
    <time class="date entry-date published" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time>
    <?php }; ?>
   </div>
  </div>
  <?php endwhile; ?>
 </div><!-- END .blog_list -->

 <?php get_template_part('template-parts/navigation'); ?>

 <?php else: ?>

 <p id="no_post"><?php _e('There is no registered post.', 'tcd-seeed');  ?></p>

 <?php endif; ?>

</section><!-- END #archive_blog -->

<?php get_footer(); ?>