<?php
function case_study_meta_box() {
  $options = get_design_plus_option();
  $case_study_label = $options['case_study_label'] ? esc_html( $options['case_study_label'] ) : __( 'Case study', 'tcd-seeed' );
  add_meta_box(
    'case_study_meta_box',//ID of meta box
    sprintf(__('%s information', 'tcd-seeed'), $case_study_label),//label
    'show_case_study_meta_box',//callback function
    'case_study',// post type
    'normal',// context
    'high'// priority
  );
}
add_action('add_meta_boxes', 'case_study_meta_box', 998);

function show_case_study_meta_box() {
  global $post;
  $options =  get_design_plus_option();

  $case_study_name = get_post_meta($post->ID, 'case_study_name', true);
  $case_study_job = get_post_meta($post->ID, 'case_study_job', true);
  $case_study_data_list = get_post_meta($post->ID, 'case_study_data_list', true);
  $case_study_data_list_default_check = get_post_meta($post->ID, 'case_study_data_list_default_check', true);
  if( empty($case_study_data_list) && empty($case_study_data_list_default_check) ){
    $case_study_data_list = array(
      array(
            "headline" => __( 'Company name', 'tcd-seeed' ),
            "content" => '',
      ),
      array(
            "headline" => __( 'Business activities', 'tcd-seeed' ),
            "content" => '',
      ),
      array(
            "headline" => __( 'Plan', 'tcd-seeed' ),
            "content" => '',
      ),
      array(
            "headline" => __( 'Website', 'tcd-seeed' ),
            "content" => '',
      )
    );
  } else {
    $case_study_data_list = get_post_meta($post->ID, 'case_study_data_list', true);
  }

  echo '<input type="hidden" name="case_study_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

  //入力欄 ***************************************************************************************************************************************************************************************
?>
<div class="tcd_custom_fields">

 <div class="tcd_cf_content">
  <h3 class="tcd_cf_headline"><?php _e( 'Name', 'tcd-seeed' ); ?></h3>
  <input type="text" name="case_study_name" value="<?php if(!empty($case_study_name)){ echo esc_attr($case_study_name); }; ?>" style="width:100%" />
 </div><!-- END .content -->

 <div class="tcd_cf_content">
  <h3 class="tcd_cf_headline"><?php _e( 'Job / Corporate name, etc.', 'tcd-seeed' ); ?></h3>
  <input type="text" name="case_study_job" value="<?php if(!empty($case_study_job)){ echo esc_attr($case_study_job); }; ?>" style="width:100%" />
 </div><!-- END .content -->

 <div class="tcd_cf_content">
  <h3 class="tcd_cf_headline"><?php _e( 'Data list', 'tcd-seeed' ); ?></h3>
  <div class="theme_option_message2">
   <p><?php _e('Please copy and paste the short code below where you want to display data list.', 'tcd-seeed'); ?></p>
   <p><?php _e( 'Short code', 'tcd-seeed' ); ?> : <input style="background:#fff; width:200px;" type="text" value="[sc_data_list]" readonly></p>
  </div>
  <?php //繰り返しフィールド ----- ?>
  <input type="hidden" name="case_study_data_list_default_check" value="no" />
  <div class="data_list_repeater_wrap">
   <div class="data_list_repeater sortable" data-delete-confirm="<?php _e( 'Delete this row?', 'tcd-seeed' ); ?>">
    <?php
        if ( $case_study_data_list ) :
          foreach ( $case_study_data_list as $key => $value ) :
    ?>
    <div class="repeater_item repeater_item_<?php echo $key; ?>">
     <div class="repeater_handler"><span class="c-icon">&#xe25d;</span></div>
     <div class="repeater_data1">
      <input type="text" placeholder="<?php _e( 'Headline', 'tcd-seeed' ); ?>" name="case_study_data_list[<?php echo esc_attr( $key ); ?>][headline]" value="<?php echo esc_attr( isset( $case_study_data_list[$key]['headline'] ) ? $case_study_data_list[$key]['headline'] : '' ); ?>" />
     </div>
     <div class="repeater_data2">
      <textarea cols="50" rows="1" placeholder="<?php _e( 'Content', 'tcd-seeed' ); ?>" name="case_study_data_list[<?php echo esc_attr( $key ); ?>][content]"><?php echo esc_attr( isset( $case_study_data_list[$key]['content'] ) ? $case_study_data_list[$key]['content'] : '' ); ?></textarea>
     </div>
     <a href="#" class="repeater_delete_row"><span class="c-icon">&#xe872;</span></a>
    </div><!-- END .repeater-item -->
    <?php
          endforeach;
        endif;
        $key = 'addindex';
        ob_start();
    ?>
    <div class="repeater_item repeater_item_<?php echo $key; ?>">
     <div class="repeater_handler"><span class="c-icon">&#xe25d;</span></div>
     <div class="repeater_data1">
      <input type="text" placeholder="<?php _e( 'Headline', 'tcd-seeed' ); ?>" name="case_study_data_list[<?php echo esc_attr( $key ); ?>][headline]" value="<?php echo esc_attr( isset( $case_study_data_list[$key]['headline'] ) ? $case_study_data_list[$key]['headline'] : '' ); ?>" />
     </div>
     <div class="repeater_data2">
      <textarea cols="50" rows="1" placeholder="<?php _e( 'Content', 'tcd-seeed' ); ?>" name="case_study_data_list[<?php echo esc_attr( $key ); ?>][content]"><?php echo esc_attr( isset( $case_study_data_list[$key]['content'] ) ? $case_study_data_list[$key]['content'] : '' ); ?></textarea>
     </div>
     <a href="#" class="repeater_delete_row"><span class="c-icon">&#xe872;</span></a>
    </div><!-- END .repeater-item -->
    <?php
        $clone = ob_get_clean();
    ?>
   </div><!-- END .repeater -->
   <a href="#" class="button button-secondary repeater_add_row" data-clone="<?php echo esc_attr( $clone ); ?>"><?php _e( 'Add new row', 'tcd-seeed' ); ?></a>
  </div><!-- END .repeater-wrapper -->
  <?php //繰り返しフィールドここまで ----- ?>
 </div><!-- END .content -->

</div><!-- END #tcd_custom_fields -->

<?php
}

function save_case_study_meta_box( $post_id ) {

  // verify nonce
  if (!isset($_POST['case_study_meta_box_nonce']) || !wp_verify_nonce($_POST['case_study_meta_box_nonce'], basename(__FILE__))) {
    return $post_id;
  }

  // check autosave
  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return $post_id;
  }

  // save or delete
  $cf_keys = array('case_study_name','case_study_job','case_study_data_list_default_check');
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

  // repeater save or delete
  $cf_keys = array('case_study_data_list');
  foreach ( $cf_keys as $cf_key ) {
    $old = get_post_meta( $post_id, $cf_key, true );

    if ( isset( $_POST[$cf_key] ) && is_array( $_POST[$cf_key] ) ) {
      $new = array_values( $_POST[$cf_key] );
    } else {
      $new = false;
    }

    if ( $new && $new != $old ) {
      update_post_meta( $post_id, $cf_key, $new );
    } elseif ( ! $new && $old ) {
      delete_post_meta( $post_id, $cf_key, $old );
    }
  }

}
add_action('save_post', 'save_case_study_meta_box');


