<?php
function tcd_toc_meta_box() {
  $options =  get_design_plus_option();
  $post_types = array();
  if($options['active_toc_post_type_post'] == 'display'){
    array_push($post_types,'post');
  }
  if($options['active_toc_post_type_page'] == 'display'){
    array_push($post_types,'page');
  }
  if($options['active_toc_post_type_news'] == 'display'){
    array_push($post_types,'news');
  }
  add_meta_box(
    'tcd_toc',//ID of meta box
    __('Table of Contents setting', 'tcd-seeed'),//label
    'show_tcd_toc_meta_box',//callback function
    $post_types,// post type
    'side',// context
    'low'// priority
  );
}
add_action('add_meta_boxes', 'tcd_toc_meta_box', 998);

function show_tcd_toc_meta_box() {
  global $typenow, $post, $toc_post_names;
  $options =  get_design_plus_option();

  $post_type = $post->post_type;

  $hide_toc = get_post_meta($post->ID, 'hide_toc', true);
  $toc_title = get_post_meta($post->ID, 'toc_title', true);

  $disabled = '';
  foreach ( $toc_post_names as $toc_post_name ){
    if(!$options['active_toc_post_type_'.$toc_post_name] && $typenow == $toc_post_name){
      $disabled = 'disabled';
    }
  };

  echo '<input type="hidden" name="tcd_toc_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

  //入力欄 ***************************************************************************************************************************************************************************************
?>
<div class="tcd_custom_fields">

 <?php if($disabled){ ?>

 <div style="overflow: hidden;">
  <p><?php _e('Table of contents is not enabled for this post type. If you want to use a table of contents, check the target post type in the Table of Contents setting in the TCD Theme Options.', 'tcd-seeed');  ?></p>
  <p><a href="./admin.php?page=theme_options"><?php _e('TCD Theme Options can be accessed here.', 'tcd-seeed');  ?></a></p>
 </div>

 <?php } else { ?>

 <?php if($post_type == 'page'){ ?>
 <p><?php _e('Applies only to page displaying a sidebar.', 'tcd-seeed');  ?></p>
 <?php }; ?>

 <div class="tcd_cf_content">
  <ul>
    <li><label><input type="checkbox" name="hide_toc" value="on" <?php if( $hide_toc == 'on' ) { ?>checked="checked"<?php } ?> />  <?php _e('Hide the table of contents', 'tcd-seeed');  ?></label></li>
  </ul>
  <p><?php _e( 'Table of contents title to be displayed in the sidebar', 'tcd-seeed' ); ?></p>
  <input type="text" name="toc_title" value="<?php if(!empty($toc_title)){ echo esc_attr($toc_title); }; ?>" style="width:100%" />
 </div><!-- END .content -->

 <?php } ?>

</div><!-- END #tcd_custom_fields -->

<?php
}

function save_tcd_toc_meta_box( $post_id ) {

  // verify nonce
  if (!isset($_POST['tcd_toc_meta_box_nonce']) || !wp_verify_nonce($_POST['tcd_toc_meta_box_nonce'], basename(__FILE__))) {
    return $post_id;
  }

  // check autosave
  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return $post_id;
  }

  // save or delete
  $cf_keys = array('hide_toc','toc_title');
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
add_action('save_post', 'save_tcd_toc_meta_box');