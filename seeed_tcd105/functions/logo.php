<?php

//ヘッダーロゴ　---------------------------------------------------------------------------------------------
function header_logo(){

  global $post;
  $options = get_design_plus_option();

  $pc_image_width = '';
  $pc_image_height = '';

  $logo_image = wp_get_attachment_image_src( $options['header_logo_image'], 'full' );
  if($logo_image) {
    $pc_image_width = $logo_image[1];
    $pc_image_height = $logo_image[2];
    if($options['header_logo_retina'] == 'yes') {
      $pc_image_width = round($pc_image_width / 2);
      $pc_image_height = round($pc_image_height / 2);
    };
  };

  $logo_image_mobile = wp_get_attachment_image_src( $options['header_logo_image_mobile'], 'full' );
  if($logo_image_mobile) {
    $mobile_image_width = $logo_image_mobile[1];
    $mobile_image_height = $logo_image_mobile[2];
    if($options['header_logo_retina'] == 'yes') {
      $mobile_image_width = round($mobile_image_width / 2);
      $mobile_image_height = round($mobile_image_height / 2);
    };
  };

  $title = get_bloginfo('name');
  $url = home_url();

?>
<?php if( !is_front_page() ) { ?>
<p id="header_logo">
<?php } else { ?>
<h1 id="header_logo">
<?php }; ?>
 <a href="<?php echo esc_url($url); ?>/" title="<?php echo esc_attr($title); ?>">
  <?php if( ($options['header_logo_type'] == 'type2') && $logo_image ){ ?>
  <img class="logo_image<?php if($logo_image_mobile){ echo ' pc'; }; ?>" src="<?php echo esc_attr($logo_image[0]); ?>?<?php echo esc_attr(time()); ?>" alt="<?php echo esc_attr($title); ?>" title="<?php echo esc_attr($title); ?>" width="<?php echo esc_attr($pc_image_width); ?>" height="<?php echo esc_attr($pc_image_height); ?>" />
  <?php if($logo_image_mobile){ ?>
  <img class="logo_image mobile" src="<?php echo esc_attr($logo_image_mobile[0]); ?>?<?php echo esc_attr(time()); ?>" alt="<?php echo esc_attr($title); ?>" title="<?php echo esc_attr($title); ?>" width="<?php echo esc_attr($mobile_image_width); ?>" height="<?php echo esc_attr($mobile_image_height); ?>" />
  <?php }; ?>
  <?php } else { ?>
  <span class="logo_text rich_font_<?php echo esc_attr($options['header_logo_font_type']); ?>"><?php echo esc_html($title); ?></span>
  <?php }; ?>
 </a>
<?php if( !is_front_page() ) { ?>
</p>
<?php } else { ?>
</h1>
<?php }; ?>

<?php
}


//フッターロゴ　---------------------------------------------------------------------------------------------
function footer_logo(){

  global $post;
  $options = get_design_plus_option();

  $pc_image_width = '';
  $pc_image_height = '';

  $logo_image = wp_get_attachment_image_src( $options['footer_logo_image'], 'full' );
  if(!$logo_image){
    $logo_image = wp_get_attachment_image_src( $options['header_logo_image'], 'full' );
  }
  if($logo_image) {
    $pc_image_width = $logo_image[1];
    $pc_image_height = $logo_image[2];
    if($options['header_logo_retina'] == 'yes') {
      $pc_image_width = round($pc_image_width / 2);
      $pc_image_height = round($pc_image_height / 2);
    };
  };

  $logo_image_mobile = wp_get_attachment_image_src( $options['footer_logo_image_mobile'], 'full' );
  if(!$logo_image_mobile){
    $logo_image_mobile = wp_get_attachment_image_src( $options['header_logo_image_mobile'], 'full' );
  }
  if($logo_image_mobile) {
    $mobile_image_width = $logo_image_mobile[1];
    $mobile_image_height = $logo_image_mobile[2];
    if($options['header_logo_retina'] == 'yes') {
      $mobile_image_width = round($mobile_image_width / 2);
      $mobile_image_height = round($mobile_image_height / 2);
    };
  };

  $title = get_bloginfo('name');
  $url = home_url();

?>
<p id="footer_logo">
 <a href="<?php echo esc_url($url); ?>/" title="<?php echo esc_attr($title); ?>">
  <?php if( ($options['header_logo_type'] == 'type2') && $logo_image ){ ?>
  <img class="logo_image<?php if($logo_image_mobile){ echo ' pc'; }; ?>" src="<?php echo esc_attr($logo_image[0]); ?>?<?php echo esc_attr(time()); ?>" alt="<?php echo esc_attr($title); ?>" title="<?php echo esc_attr($title); ?>" width="<?php echo esc_attr($pc_image_width); ?>" height="<?php echo esc_attr($pc_image_height); ?>" />
  <?php if($logo_image_mobile){ ?>
  <img class="logo_image mobile" src="<?php echo esc_attr($logo_image_mobile[0]); ?>?<?php echo esc_attr(time()); ?>" alt="<?php echo esc_attr($title); ?>" title="<?php echo esc_attr($title); ?>" width="<?php echo esc_attr($mobile_image_width); ?>" height="<?php echo esc_attr($mobile_image_height); ?>" />
  <?php }; ?>
  <?php } else { ?>
  <span class="logo_text rich_font_<?php echo esc_attr($options['header_logo_font_type']); ?>"><?php echo esc_html($title); ?></span>
  <?php }; ?>
 </a>
</p>

<?php
}


?>