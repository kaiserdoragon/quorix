<?php

function next_prev_post_link() {

  $options = get_design_plus_option();
  $prev_post = get_adjacent_post(false, '', true);
  $next_post = get_adjacent_post(false, '', false);

  if ($prev_post) {
    $post_id = $prev_post->ID;
?>
<a class="item prev_post" href="<?php echo get_permalink($post_id); ?>">
 <p class="title"><span><?php the_title_attribute('post='.$post_id); ?></span></p>
 <p class="nav"><?php echo __('Prev post', 'tcd-seeed'); ?></p>
</a>
<?php
  };
  if ($next_post) {
    $post_id = $next_post->ID;
?>
<a class="item next_post" href="<?php echo get_permalink($post_id); ?>">
 <p class="title"><span><?php the_title_attribute('post='.$post_id); ?></span></p>
 <p class="nav"><?php echo __('Next post', 'tcd-seeed'); ?></p>
</a>
<?php
  };

}


// 声専用
function next_prev_post_link2() {

  $options = get_design_plus_option();
  $prev_post = get_adjacent_post(false, '', false);
  $next_post = get_adjacent_post(false, '', true);

  if ($prev_post) {
    $post_id = $prev_post->ID;
    if(has_post_thumbnail($post_id)) {
      $image = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'size1' );
    }
    $catch = get_the_title($post_id);
?>
<a class="item prev_post animate_background<?php if(!has_post_thumbnail($post_id)) { echo ' no_image'; }; ?>" href="<?php echo get_permalink($post_id); ?>">
 <?php if(has_post_thumbnail($post_id)) { ?>
 <div class="image_wrap">
  <img loading="lazy" class="image" src="<?php echo esc_attr($image[0]); ?>" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" />
 </div>
 <?php }; ?>
 <div class="content">
  <p class="title"><span><?php echo wp_kses_post($catch); ?></span></p>
  <p class="nav"><?php echo __('Prev post', 'tcd-seeed'); ?></p>
 </div>
</a>
<?php
  };
  if ($next_post) {
    $post_id = $next_post->ID;
    if(has_post_thumbnail($post_id)) {
      $image = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'size1' );
    }
    $catch = get_the_title($post_id);
?>
<a class="item next_post animate_background<?php if(!has_post_thumbnail($post_id)) { echo ' no_image'; }; ?>" href="<?php echo get_permalink($post_id); ?>">
 <?php if(has_post_thumbnail($post_id)) { ?>
 <div class="image_wrap">
  <img loading="lazy" class="image" src="<?php echo esc_attr($image[0]); ?>" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" />
 </div>
 <?php }; ?>
 <div class="content">
  <p class="title"><span><?php echo wp_kses_post($catch); ?></span></p>
  <p class="nav"><?php echo __('Next post', 'tcd-seeed'); ?></p>
 </div>
</a>
<?php
  };

}


// add class to posts_nav_link()
add_filter('next_posts_link_attributes', 'posts_link_attributes_1');
add_filter('previous_posts_link_attributes', 'posts_link_attributes_2');

function posts_link_attributes_1() {
    return 'class="next"';
}
function posts_link_attributes_2() {
    return 'class="prev"';
}


?>