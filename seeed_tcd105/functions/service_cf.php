<?php
function service_meta_box() {
  $options = get_design_plus_option();
  $service_label = $options['service_label'] ? esc_html( $options['service_label'] ) : __( 'Function', 'tcd-seeed' );
  add_meta_box(
    'service_meta_box',//ID of meta box
    sprintf(__('%s information', 'tcd-seeed'), $service_label),//label
    'show_service_meta_box',//callback function
    'service',// post type
    'normal',// context
    'high'// priority
  );
}
add_action('add_meta_boxes', 'service_meta_box', 998);

function show_service_meta_box() {
  global $post;
  $options =  get_design_plus_option();

  $service_icon = get_post_meta($post->ID, 'service_icon', true);
  $service_sub_title = get_post_meta($post->ID, 'service_sub_title', true);
  $service_desc = get_post_meta($post->ID, 'service_desc', true);
  $service_image_slider = get_post_meta($post->ID, 'service_image_slider', true);
  $display = 'none';
  $image_ids = explode( ',', $service_image_slider );

  echo '<input type="hidden" name="service_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

  //入力欄 ***************************************************************************************************************************************************************************************
?>
<div class="tcd_custom_fields">

 <div class="tcd_cf_content">

  <h3 class="tcd_cf_headline"><?php _e( 'Basic setting', 'tcd-seeed' ); ?></h3>

   <div class="cb_image">
    <div class="item">
     <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/service_info.jpg" alt="" title="" />
    </div>
    <div class="item">
     <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/service_post_list_desc.jpg" alt="" title="" />
    </div>
   </div>

   <ul class="option_list">
    <li class="cf">
     <span class="label"><span class="num">1</span><?php _e('Icon', 'tcd-seeed'); ?></span>
     <input class="full_width material_icon_option" type="text" placeholder="<?php _e( 'ex: e88a', 'tcd-seeed' ); ?>" name="service_icon" value="<?php if(isset($service_icon)){ echo esc_attr( $service_icon ); }; ?>">
     <div class="theme_option_message2 space" style="clear:both; margin:10px 0 0 0;">
      <p><?php _e('Please enter any icon code from Google Fonts.<br><a href="https://fonts.google.com/icons?selected=Material+Symbols+Outlined:redo:FILL@0;wght@400;GRAD@0;opsz@24" target="_blank">Click here for a list of icons from Google Fonts.</a>', 'tcd-seeed'); ?></p>
      <p><?php _e('If you want to use original image for icon, use the option below instead.', 'tcd-seeed'); ?><br>
      <?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-seeed'), '55', '55'); ?></p>
     </div>
    </li>
    <li class="cf" style="border-top:none;">
     <span class="label">
      <span class="num_space"></span>
      <?php _e('Original icon image', 'tcd-seeed'); ?>
     </span>
     <?php mlcf_media_form('service_icon_image', __('Image', 'tcd-seeed')); ?>
    </li>
    <li class="cf">
     <span class="label"><span class="num">2</span><?php _e('Subtitle', 'tcd-seeed'); ?></span>
     <textarea class="full_width" cols="50" rows="2" name="service_sub_title"><?php echo esc_textarea(  $service_sub_title ); ?></textarea>
     <div class="theme_option_message2 space" style="clear:both; margin:10px 0 0 0;">
      <p><?php _e('Title will be displayed instead if this field is blank.', 'tcd-seeed'); ?></p>
     </div>
    </li>
    <li class="cf">
     <span class="label"><span class="num">3</span><?php _e('Description for post list', 'tcd-seeed'); ?></span>
     <textarea class="full_width" cols="50" rows="2" name="service_desc"><?php echo esc_textarea(  $service_desc ); ?></textarea>
     <div class="theme_option_message2 space" style="clear:both; margin:10px 0 0 0;">
      <p><?php _e('Excerpt of main content will be displayed instead if this field is blank.', 'tcd-seeed'); ?></p>
     </div>
    </li>
   </ul>

 </div><!-- END .content -->

 <div class="tcd_cf_content">

  <h3 class="tcd_cf_headline"><?php _e( 'Image slider', 'tcd-seeed' ); ?></h3>

  <div class="cb_image" style="margin-bottom:15px;">
   <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/service_slider.jpg" alt="" title="" />
  </div>

  <div class="theme_option_message2">
   <p><?php _e('Image slider will be display in article page. Featured image will be used for first image.', 'tcd-seeed'); ?><br>
   <?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-seeed'), '800', '500'); ?><br>
   <?php _e('You can register multiple image by clicking images in media library.', 'tcd-seeed'); ?></p>
  </div>

  <div class="multi-media-uploader" style="float:none; width:100%;">
   <ul>
    <?php
         if ( $service_image_slider && !empty( $image_ids ) ) {
           $display = 'inline-block';
           foreach ( $image_ids as $image_id ) {
             if ( $image_attributes = wp_get_attachment_image_src( $image_id, 'thumbnail' ) ) {
    ?>
    <li data-attechment-id="<?php echo $image_id; ?>">
     <img src="<?php echo $image_attributes[0]; ?>" />
     <span class="delete-img"></span>
    </li>
    <?php
            }
          }
        }
    ?>
   </ul>
   <a id="service_image_slider" href="#" class="js-multi-media-upload-button button">
    <?php _e( 'Select Image', 'tcd-seeed' ); ?>
   </a>
   <input type="hidden" class="attechments-ids service_image_slider" name="service_image_slider" value="<?php echo esc_attr( implode( ',', $image_ids ) ); ?>" />
   <a href="#" class="js-multi-media-remove-button button" style="display:<?php echo $display; ?>;">
    <?php _e( 'Delete all images', 'tcd-seeed' ); ?>
   </a>
  </div>

 </div><!-- END .content -->

</div><!-- END #tcd_custom_fields -->

<?php
}

function save_service_meta_box( $post_id ) {

  // verify nonce
  if (!isset($_POST['service_meta_box_nonce']) || !wp_verify_nonce($_POST['service_meta_box_nonce'], basename(__FILE__))) {
    return $post_id;
  }

  // check autosave
  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return $post_id;
  }

  // save or delete
  $cf_keys = array('service_image_slider','service_icon','service_sub_title','service_icon_image','service_desc');
  foreach ($cf_keys as $cf_key) {
    $old = get_post_meta($post_id, $cf_key, true);

    if (isset($_POST[$cf_key])) {
      $new = $_POST[$cf_key];
    } else {
      $new = '';
    }

    if ($new && $new != $old) {
      update_post_meta($post_id, $cf_key, $new);
    } elseif ('' == $new && $old) {
      delete_post_meta($post_id, $cf_key, $old);
    }
  }

}
add_action('save_post', 'save_service_meta_box');


