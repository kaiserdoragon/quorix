<?php
     get_header();
     $options = get_design_plus_option();
     $query_obj = get_queried_object();
     $current_cat_id = $query_obj->term_id;
     $headline = $options['archive_faq_headline'];
     $image = wp_get_attachment_image_src($options['archive_faq_header_image'], 'full');
     $overlay_color = hex2rgb($options['archive_faq_overlay_color']);
     $overlay_color = implode(",",$overlay_color);
     $overlay_opacity = $options['archive_faq_overlay_opacity'];
     $desc = $options['archive_faq_desc'];
     $desc_mobile = $options['archive_faq_desc_mobile'];
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

<section id="archive_faq">

 <?php
      // カテゴリーソートタブ ----------------------------------------------------------------
      $category = get_terms( 'faq_category', array('orderby' => 'id', 'order' => 'ASC', 'hide_empty' => true) );
      if ($category) {
        $total = count($category);
 ?>
 <div id="faq_sort_button_wrap"<?php if($total < 3){ echo ' class="small_size"'; }; ?>>
  <div id="faq_sort_button_slider" class="swiper">
   <div id="faq_sort_button" class="swiper-wrapper">
    <?php
         $i = 1;
         foreach ( $category as $cat ) :
           $cat_id = $cat->term_id;
    ?>
    <a data-category-id="#ajax_post_cat_<?php echo esc_attr($cat_id); ?>" href="#faq_content<?php echo $i; ?>" class="swiper-slide no_auto_scroll<?php if($cat_id == $current_cat_id){ echo ' active'; }; ?>" data-filter="#faq_content<?php echo $i; ?>"><?php echo esc_html($cat->name); ?></a>
    <?php $i++; endforeach; ?>
   </div>
  </div>
  <div class="faq_sort_button_prev swiper-nav-button swiper-button-prev"></div>
  <div class="faq_sort_button_next swiper-nav-button swiper-button-next"></div>
 </div>
 <?php }; ?>

 <div id="faq_list_wrap">

  <?php
       // コンテンツ ----------------------------------------------------------------
       if(is_mobile()){
         $post_num = $options['archive_faq_num_sp'];
       } else {
         $post_num = $options['archive_faq_num'];
       }
       $i = 1;
       if ($category) {
         foreach ( $category as $cat ) :
           $cat_id = $cat->term_id;
  ?>
  <div class="ajax_post_list_wrap faq_content<?php if($cat_id == $current_cat_id){ echo ' active'; }; ?>" id="ajax_post_cat_<?php echo esc_attr($cat_id); ?>">

   <div class="faq_content_inner">
    <?php
         // 質問一覧
         $args = array( 'order' => 'DESC', 'orderby' => 'date', 'post_status' => 'publish', 'post_type' => 'faq', 'posts_per_page' => $post_num, 'tax_query' => array( array( 'taxonomy' => 'faq_category', 'field' => 'term_id', 'terms' => $cat_id ), ) );
         $post_list = new wp_query($args);
         $all_post_count = $post_list->found_posts;
         if($post_list->have_posts()):
    ?>
    <div class="item_list ajax_post_list">
     <?php while( $post_list->have_posts() ) : $post_list->the_post(); ?>
     <div class="item" style="opacity:1;">
      <h4 class="question"><span class="icon">Q</span><span class="title"><?php the_title(); ?></span></h4>
      <div class="post_content clearfix">
       <?php the_content(); ?>
      </div>
     </div>
     <?php endwhile; wp_reset_query(); ?>
    </div>
    <?php endif; ?>
   </div>

   <?php if($all_post_count > $post_num) { ?>
   <div class="entry-more" data-catid="<?php echo esc_attr($cat_id); ?>" data-offset-post="<?php echo esc_attr($post_num); ?>">
    <span class="design_button"><?php _e( 'Load more', 'tcd-seeed' ); ?></span>
   </div>
   <div class="entry-loading"><?php _e( 'LOADING...', 'tcd-seeed' ); ?></div>
   <?php }; ?>

  </div>
  <?php $i++; endforeach; }; ?>

 </div>

</section><!-- END #archive_faq -->

<?php get_footer(); ?>