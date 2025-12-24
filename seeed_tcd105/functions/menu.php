<?php
/**
 * Add data-megamenu attributes to the global navigation
 */
function nano_walker_nav_menu_start_el( $item_output, $item, $depth, $args ) {

  $options = get_design_plus_option();

  if ( 'global-menu' !== $args->theme_location ) return $item_output;

  if ( ! isset( $options['megamenu_new'][$item->ID] ) ) return $item_output;

  if ( 'dropdown' === $options['megamenu_new'][$item->ID] ) return $item_output;

  if ( 'use_megamenu_a' === $options['megamenu_new'][$item->ID] ) {
    return sprintf( '<a href="%s" class="megamenu_button megamenu_type1" data-megamenu="js-megamenu%d">%s</a>', $item->url, $item->ID, $item->title );
  }

  if ( 'use_megamenu_b' === $options['megamenu_new'][$item->ID] ) {
    return sprintf( '<a href="%s" class="megamenu_button megamenu_type1" data-megamenu="js-megamenu%d">%s</a>', $item->url, $item->ID, $item->title );
  }

  if ( 'use_megamenu_c' === $options['megamenu_new'][$item->ID] ) {
    return sprintf( '<a href="%s" class="megamenu_button megamenu_type1" data-megamenu="js-megamenu%d">%s</a>', $item->url, $item->ID, $item->title );
  }

  if ( 'use_megamenu_d' === $options['megamenu_new'][$item->ID] ) {
    return sprintf( '<a href="%s" class="megamenu_button megamenu_type1" data-megamenu="js-megamenu%d">%s</a>', $item->url, $item->ID, $item->title );
  }

}

add_filter( 'walker_nav_menu_start_el', 'nano_walker_nav_menu_start_el', 10, 4 );


// Mega menu A - ブログカルーセル ---------------------------------------------------------------
function render_megamenu_a( $id, $megamenus ) {
  global $post;
  $options = get_design_plus_option();
?>
<div class="megamenu megamenu_a" id="js-megamenu<?php echo esc_attr( $id ); ?>">

 <?php
      $post_type = $options['megamenu_a_post_type'] ? $options['megamenu_a_post_type'] : 'recent_post';
      $post_order = $options['megamenu_a_post_order'] ? $options['megamenu_a_post_order'] : 'date';
      $post_num = $options['megamenu_a_post_num'] ? $options['megamenu_a_post_num'] : '8';
      if($post_type == 'recent_post') {
        $args = array('post_type' => 'post', 'posts_per_page' => $post_num, 'ignore_sticky_posts' => 1, 'orderby' => $post_order);
      } else {
        $args = array('post_type' => 'post', 'posts_per_page' => $post_num, 'ignore_sticky_posts' => 1, 'orderby' => $post_order, 'meta_key' => $post_type, 'meta_value' => 'on');
      }
      $post_list = new wp_query($args);
      if($post_list->have_posts()):
 ?>
 <div class="megamenu_post_carousel swiper">
  <div class="post_list swiper-wrapper">
   <?php
        while( $post_list->have_posts() ) : $post_list->the_post();
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
   ?>
   <div class="item swiper-slide">
    <a class="animate_background" href="<?php the_permalink(); ?>">
     <div class="image_wrap">
      <img class="image" loading="lazy" src="<?php echo esc_attr($image[0]); ?>" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" />
     </div>
     <p class="title"><span><?php the_title(); ?></span></p>
    </a>
   </div>
   <?php endwhile; ?>
  </div>
 </div>
 <?php endif; wp_reset_query(); ?>

 <div class="megamenu_carousel_button_prev swiper-nav-button swiper-button-prev"></div>
 <div class="megamenu_carousel_button_next swiper-nav-button swiper-button-next"></div>

</div><!-- END .megamenu_a -->
<?php
};


// Mega menu B - お知らせカルーセル ---------------------------------------------------------------
function render_megamenu_b( $id, $megamenus ) {
  global $post;
  $options = get_design_plus_option();
?>
<div class="megamenu megamenu_a" id="js-megamenu<?php echo esc_attr( $id ); ?>">

 <?php
      $post_type = $options['megamenu_b_post_type'] ? $options['megamenu_b_post_type'] : 'recent_post';
      $post_order = $options['megamenu_b_post_order'] ? $options['megamenu_b_post_order'] : 'date';
      $post_num = $options['megamenu_b_post_num'] ? $options['megamenu_b_post_num'] : '8';
      if($post_type == 'recent_post') {
        $args = array('post_type' => 'news', 'posts_per_page' => $post_num, 'ignore_sticky_posts' => 1, 'orderby' => $post_order);
      } else {
        $args = array('post_type' => 'news', 'posts_per_page' => $post_num, 'ignore_sticky_posts' => 1, 'orderby' => $post_order, 'meta_key' => $post_type, 'meta_value' => 'on');
      }
      $post_list = new wp_query($args);
      if($post_list->have_posts()):
 ?>
 <div class="megamenu_post_carousel swiper<?php if($options['news_show_image'] == 'hide'){ echo ' no_image'; }; ?>">
  <div class="post_list swiper-wrapper">
   <?php
        while( $post_list->have_posts() ) : $post_list->the_post();
          if($options['news_show_image'] == 'display'){
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
          }
   ?>
   <div class="item swiper-slide">
    <a class="animate_background" href="<?php the_permalink(); ?>">
     <?php if($options['news_show_image'] == 'display'){ ?>
     <div class="image_wrap">
      <img class="image" loading="lazy" src="<?php echo esc_attr($image[0]); ?>" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" />
     </div>
     <?php }; ?>
     <p class="title"><span><?php the_title(); ?></span></p>
    </a>
   </div>
   <?php endwhile; ?>
  </div>
 </div>
 <?php endif; wp_reset_query(); ?>

 <div class="megamenu_carousel_button_prev swiper-nav-button swiper-button-prev"></div>
 <div class="megamenu_carousel_button_next swiper-nav-button swiper-button-next"></div>

</div><!-- END .megamenu_b -->
<?php
};


// Mega menu C - 事例カルーセル ---------------------------------------------------------------
function render_megamenu_c( $id, $megamenus ) {
  global $post;
  $options = get_design_plus_option();
?>
<div class="megamenu megamenu_a" id="js-megamenu<?php echo esc_attr( $id ); ?>">

 <?php
      $post_num = $options['megamenu_c_post_num'] ? $options['megamenu_c_post_num'] : '8';
      $post_order = $options['megamenu_c_post_order'] ? $options['megamenu_c_post_order'] : 'date';
      if($post_order == 'rand') {
        $args = array('post_type' => 'case_study', 'posts_per_page' => $post_num, 'ignore_sticky_posts' => 1, 'orderby' => 'rand');
      } else {
        $args = array('post_type' => 'case_study', 'posts_per_page' => $post_num, 'ignore_sticky_posts' => 1, 'orderby' => array('menu_order' => 'ASC', 'date' => 'DESC'));
      }
      $post_list = new wp_query($args);
      if($post_list->have_posts()):
 ?>
 <div class="megamenu_post_carousel swiper">
  <div class="post_list swiper-wrapper">
   <?php
        while( $post_list->have_posts() ) : $post_list->the_post();
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
   ?>
   <div class="item swiper-slide">
    <a class="animate_background" href="<?php the_permalink(); ?>">
     <div class="image_wrap">
      <img class="image" loading="lazy" src="<?php echo esc_attr($image[0]); ?>" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" />
     </div>
     <p class="title"><span><?php the_title(); ?></span></p>
    </a>
   </div>
   <?php endwhile; ?>
  </div>
 </div>
 <?php endif; wp_reset_query(); ?>

 <div class="megamenu_carousel_button_prev swiper-nav-button swiper-button-prev"></div>
 <div class="megamenu_carousel_button_next swiper-nav-button swiper-button-next"></div>

</div><!-- END .megamenu_c -->
<?php
};


// Mega menu C - サービスカルーセル ---------------------------------------------------------------
function render_megamenu_d( $id, $megamenus ) {
  global $post;
  $options = get_design_plus_option();
?>
<div class="megamenu megamenu_a" id="js-megamenu<?php echo esc_attr( $id ); ?>">

 <?php
      $post_num = $options['megamenu_d_post_num'] ? $options['megamenu_d_post_num'] : '8';
      $post_order = $options['megamenu_d_post_order'] ? $options['megamenu_d_post_order'] : 'date';
      if($post_order == 'rand') {
        $args = array('post_type' => 'service', 'posts_per_page' => $post_num, 'ignore_sticky_posts' => 1, 'orderby' => 'rand');
      } else {
        $args = array('post_type' => 'service', 'posts_per_page' => $post_num, 'ignore_sticky_posts' => 1, 'orderby' => array('menu_order' => 'ASC', 'date' => 'DESC'));
      }
      $post_list = new wp_query($args);
      if($post_list->have_posts()):
 ?>
 <div class="megamenu_post_carousel swiper">
  <div class="post_list swiper-wrapper">
   <?php
        while( $post_list->have_posts() ) : $post_list->the_post();
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
   ?>
   <div class="item swiper-slide">
    <a class="animate_background" href="<?php the_permalink(); ?>">
     <div class="image_wrap">
      <img class="image" loading="lazy" src="<?php echo esc_attr($image[0]); ?>" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" />
     </div>
     <p class="title"><span><?php the_title(); ?></span></p>
    </a>
   </div>
   <?php endwhile; ?>
  </div>
 </div>
 <?php endif; wp_reset_query(); ?>

 <div class="megamenu_carousel_button_prev swiper-nav-button swiper-button-prev"></div>
 <div class="megamenu_carousel_button_next swiper-nav-button swiper-button-next"></div>

</div><!-- END .megamenu_c -->
<?php
};


?>