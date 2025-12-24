<?php
function chart_meta_box() {
  add_meta_box(
    'chart_meta_box',//ID of meta box
    __('Chart setting', 'tcd-seeed'),//label
    'show_chart_meta_box',//callback function
    'chart',// post type
    'normal',// context
    'high'// priority
  );
}
add_action('add_meta_boxes', 'chart_meta_box');

function show_chart_meta_box() {

  global $post;

  $options = get_design_plus_option();
  $main_color = $options['main_color'];

  $chart_type = get_post_meta($post->ID, 'chart_type', true) ?  get_post_meta($post->ID, 'chart_type', true) : 'doughnut';
  $chart_unit = get_post_meta($post->ID, 'chart_unit', true);
  $line_color = get_post_meta($post->ID, 'line_color', true) ?  get_post_meta($post->ID, 'line_color', true) : $main_color;
  $max_num = get_post_meta($post->ID, 'max_num', true);
  $bar_width = get_post_meta($post->ID, 'bar_width', true);
  $bar_bg_color = get_post_meta($post->ID, 'bar_bg_color', true) ?  get_post_meta($post->ID, 'bar_bg_color', true) : '#f2f2f2';
  $item_list = get_post_meta($post->ID, 'item_list', true);
  $chart_desc = get_post_meta($post->ID, 'chart_desc', true) ?  get_post_meta($post->ID, 'chart_desc', true) : 'type1';
  $item_desc_list = get_post_meta($post->ID, 'item_desc_list', true);

  $show_table = get_post_meta($post->ID, 'show_table', true) ?  get_post_meta($post->ID, 'show_table', true) : 'hide';
  $show_table_unit = get_post_meta($post->ID, 'show_table_unit', true) ?  get_post_meta($post->ID, 'show_table_unit', true) : 'hide';
  $show_tooltip = get_post_meta($post->ID, 'show_tooltip', true) ?  get_post_meta($post->ID, 'show_tooltip', true) : 'hide';
  $show_title = get_post_meta($post->ID, 'show_title', true) ?  get_post_meta($post->ID, 'show_title', true) : 'show';

  echo '<input type="hidden" name="chart_custom_fields_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

  //入力欄 ***************************************************************************************************************************************************************************************
?>

<div class="tcd_custom_field_wrap">

  <div class="theme_option_field cf theme_option_field_ac open active no_arrow">
   <div class="theme_option_field_ac_content chart_option">

    <?php
         // ショートコード
         global $pagenow;
         if($pagenow != 'post-new.php'){
    ?>
    <h4 class="theme_option_headline2"><?php _e('Short code', 'tcd-seeed');  ?></h4>
    <div class="theme_option_message2">
     <p><?php _e('Please copy and paste this shortcode where you want to display this chart.', 'tcd-seeed');  ?></p>
    </div>
    <input type="text" onclick="this.select()" value='[tcd_chart id="<?php echo esc_attr($post->ID); ?>"]' readonly="readonly">
    <?php }; ?>

    <?php // 基本設定 ?>
    <h4 class="theme_option_headline2"><?php _e('Basic setting', 'tcd-seeed');  ?></h4>
    <ul class="option_list">
     <li class="cf">
      <span class="label"><?php _e('Chart type', 'tcd-seeed'); ?></span>
      <ul id="tcd_chart_type">
       <li class="doughnut active">
        <label for="tcd_chart_doughnut">
         <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/chart_doughnut.gif" alt="" title="" />
         <input type="radio" id="tcd_chart_doughnut" name="chart_type" value="doughnut" <?php checked( $chart_type, 'doughnut' ); ?> />
         <span class="title"><?php _e('Doughnut chart', 'tcd-seeed'); ?></span>
        </label>
       </li>
       <li class="pie">
        <label for="tcd_chart_pie">
         <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/chart_pie.gif" alt="" title="" />
         <input type="radio" id="tcd_chart_pie" name="chart_type" value="pie" <?php checked( $chart_type, 'pie' ); ?> />
         <span class="title"><?php _e('Pie chart', 'tcd-seeed'); ?></span>
        </label>
       </li>
       <li class="bar_vertical">
        <label for="tcd_chart_bar">
         <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/chart_bar_vertical.gif" alt="" title="" />
         <input type="radio" id="tcd_chart_bar" name="chart_type" value="bar" <?php checked( $chart_type, 'bar' ); ?> />
         <span class="title"><?php _e('Bar chart (vertical)', 'tcd-seeed'); ?></span>
        </label>
       </li>
       <li class="bar_horizontal">
        <label for="tcd_chart_horizontalBar">
         <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/chart_bar_horizontal.gif" alt="" title="" />
         <input type="radio" id="tcd_chart_horizontalBar" name="chart_type" value="horizontalBar" <?php checked( $chart_type, 'horizontalBar' ); ?> />
         <span class="title"><?php _e('Bar chart (horizontal)', 'tcd-seeed'); ?></span>
        </label>
       </li>
       <li class="line">
        <label for="tcd_chart_line">
         <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/chart_line.gif" alt="" title="" />
         <input type="radio" id="tcd_chart_line" name="chart_type" value="line" <?php checked( $chart_type, 'line' ); ?> />
         <span class="title"><?php _e('Line chart', 'tcd-seeed'); ?></span>
        </label>
       </li>
      </ul>
     </li>
     <li class="cf">
      <span class="label"><?php _e('Unit of data', 'tcd-seeed'); ?></span>
      <input type="text" style="width:88px;" name="chart_unit" value="<?php echo esc_attr($chart_unit); ?>" />
     </li>
     <li class="cf">
      <span class="label"><?php _e('Title', 'tcd-seeed'); ?></span>
      <div class="standard_radio_button">
       <input type="radio" id="show_title_show" name="show_title" value="show"<?php checked( $show_title, 'show' ); ?>>
       <label for="show_title_show"><?php _e('Display', 'tcd-seeed');  ?></label>
       <input type="radio" id="show_title_hide" name="show_title" value="hide"<?php checked( $show_title, 'hide' ); ?>>
       <label for="show_title_hide"><?php _e('Hide', 'tcd-seeed');  ?></label>
      </div>
     </li>
     <li class="cf chart_tooltip_option">
      <span class="label"><?php _e('Tooltip', 'tcd-seeed'); ?></span>
      <div class="standard_radio_button">
       <input type="radio" id="show_tooltip_show" name="show_tooltip" value="show"<?php checked( $show_tooltip, 'show' ); ?>>
       <label for="show_tooltip_show"><?php _e('Display', 'tcd-seeed');  ?></label>
       <input type="radio" id="show_tooltip_hide" name="show_tooltip" value="hide"<?php checked( $show_tooltip, 'hide' ); ?>>
       <label for="show_tooltip_hide"><?php _e('Hide', 'tcd-seeed');  ?></label>
      </div>
      <div class="theme_option_message2" style="clear:both; margin-top:40px;">
       <p><?php _e('It will be displayed when you move cursor above the chart.', 'tcd-seeed');  ?></p>
      </div>
     </li>
     <li class="cf chart_line_color_option">
      <span class="label"><?php _e('Color of chart line', 'tcd-seeed'); ?></span>
      <input type="text" name="line_color" value="<?php echo esc_attr( $line_color ); ?>" data-default-color="<?php echo esc_attr($main_color); ?>" class="c-color-picker">
     </li>
     <li class="cf chart_max_num_option">
      <span class="label"><?php _e('Maximum value', 'tcd-seeed'); ?></span>
      <input class="full_width hankaku" style="width:88px;" type="number" name="max_num" value="<?php echo esc_attr( $max_num ); ?>" />
      <div class="theme_option_message2" style="clear:both; margin-top:15px;">
       <p><?php _e('To set the maximum value of the graph, enter a numerical number.<br>Example: If you enter 100, the maximum value of the graph will be 100.', 'tcd-seeed');  ?></p>
      </div>
     </li>
     <li class="cf chart_bar_width_option">
      <span class="label"><?php _e('Maximum width of bar', 'tcd-seeed'); ?></span>
      <input class="hankaku" style="width:88px;" type="number" name="bar_width" value="<?php echo esc_attr( $bar_width ); ?>" /><span>px</span>
      <div class="theme_option_message2" style="clear:both; margin-top:15px;">
       <p><?php _e('Normally, the width of the bar is automatically adjusted to fit the width of the chart.<br>If you don\'t want the bar to be wider, please set maximum bar width in this option.', 'tcd-seeed');  ?></p>
      </div>
     </li>
     <li class="cf chart_bar_bg_color_option">
      <span class="label"><?php _e('Background color of bar', 'tcd-seeed'); ?></span>
      <input type="text" name="bar_bg_color" value="<?php echo esc_attr( $bar_bg_color ); ?>" data-default-color="#f2f2f2" class="c-color-picker">
     </li>
     <li class="cf">
      <span class="label"><?php _e('Data table under chart', 'tcd-seeed'); ?></span>
      <div class="standard_radio_button">
       <input type="radio" id="show_table_show" name="show_table" value="show"<?php checked( $show_table, 'show' ); ?>>
       <label for="show_table_show"><?php _e('Display', 'tcd-seeed');  ?></label>
       <input type="radio" id="show_table_hide" name="show_table" value="hide"<?php checked( $show_table, 'hide' ); ?>>
       <label for="show_table_hide"><?php _e('Hide', 'tcd-seeed');  ?></label>
      </div>
     </li>
     <li class="cf data_table_unit">
      <span class="label"><?php _e('Unit on data table under chart', 'tcd-seeed'); ?></span>
      <div class="standard_radio_button">
       <input type="radio" id="show_table_unit_show" name="show_table_unit" value="show"<?php checked( $show_table_unit, 'show' ); ?>>
       <label for="show_table_unit_show"><?php _e('Display', 'tcd-seeed');  ?></label>
       <input type="radio" id="show_table_unit_hide" name="show_table_unit" value="hide"<?php checked( $show_table_unit, 'hide' ); ?>>
       <label for="show_table_unit_hide"><?php _e('Hide', 'tcd-seeed');  ?></label>
      </div>
     </li>
    </ul>

     <?php // チャートここから -------------------------- ?>
     <h4 class="theme_option_headline2"><?php _e('Chart', 'tcd-seeed');  ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('You can set the data of the chart here. Please add an input field from "Add new data" button. Each data can be sorted by dragging headline.', 'tcd-seeed');  ?></p>
     </div>
     <div class="repeater-wrapper">
      <div class="repeater sortable" data-delete-confirm="<?php _e( 'Delete this data?', 'tcd-seeed' ); ?>">
       <?php
            if ( $item_list && is_array( $item_list ) ) :
              foreach ( $item_list as $key => $value ) :
       ?>
       <div class="sub_box repeater-item repeater-item-<?php echo esc_attr( $key ); ?>">
        <h4 class="theme_option_subbox_headline"><?php _e( 'Label', 'tcd-seeed' ); echo esc_html( (int)$key + 1 ); ?></h4>
        <div class="sub_box_content">
         <h4 class="theme_option_headline2"><?php _e( 'Label', 'tcd-seeed' ); ?></h4>
         <input class="repeater-label full_width" type="text" name="item_list[<?php echo esc_attr( $key ); ?>][label]" value="<?php echo esc_attr($item_list[$key]['label']); ?>" />
         <h4 class="theme_option_headline2"><?php _e( 'Numerical value', 'tcd-seeed' ); ?></h4>
         <div class="theme_option_message2">
          <p><?php _e('This field is required. Please enter number only.', 'tcd-seeed');  ?></p>
         </div>
         <input class="full_width hankaku" type="number" name="item_list[<?php echo esc_attr( $key ); ?>][data]" value="<?php echo esc_attr($item_list[$key]['data']); ?>" />
         <div class="chart_color_option">
          <h4 class="theme_option_headline2"><?php _e( 'Color', 'tcd-seeed' ); ?></h4>
          <input type="text" name="item_list[<?php echo esc_attr( $key ); ?>][color]" value="<?php echo esc_attr( isset( $item_list[$key]['color'] ) ? $item_list[$key]['color'] : $main_color ); ?>" data-default-color="<?php echo esc_attr($main_color); ?>" class="c-color-picker">
         </div>
         <ul class="button_list cf">
          <li><a class="close_sub_box button-ml" href="#"><?php echo __( 'Close', 'tcd-seeed' ); ?></a></li>
          <li class="delete-row"><a class="button-delete-row button-ml red_button" href="#"><?php echo __( 'Delete this data', 'tcd-seeed' ); ?></a></li>
         </ul>
        </div><!-- END .sub_box_content -->
       </div><!-- END .sub_box -->
       <?php
              endforeach;
            endif;

            $key = 'addindex';
            $value = array(
              'label' => '',
              'data' => '',
              'color' => $main_color,
            );
            ob_start();
       ?>
       <div class="sub_box repeater-item repeater-item-<?php echo esc_attr( $key ); ?>">
        <h4 class="theme_option_subbox_headline"><?php _e( 'New data', 'tcd-seeed' ); echo esc_html( (int)$key + 1 ); ?></h4>
        <div class="sub_box_content">
         <h4 class="theme_option_headline2"><?php _e( 'Label', 'tcd-seeed' ); ?></h4>
         <input class="repeater-label full_width" type="text" name="item_list[<?php echo esc_attr( $key ); ?>][label]" value="" />
         <h4 class="theme_option_headline2"><?php _e( 'Numerical value', 'tcd-seeed' ); ?></h4>
         <div class="theme_option_message2">
          <p><?php _e('This field is required. Please enter number only.', 'tcd-seeed');  ?></p>
         </div>
         <input class="full_width hankaku" type="number" name="item_list[<?php echo esc_attr( $key ); ?>][data]" value="" />
         <div class="chart_color_option">
          <h4 class="theme_option_headline2"><?php _e( 'Color', 'tcd-seeed' ); ?></h4>
          <input type="text" name="item_list[<?php echo esc_attr( $key ); ?>][color]" value="<?php echo esc_attr($main_color); ?>" data-default-color="<?php echo esc_attr($main_color); ?>" class="c-color-picker">
         </div>
         <ul class="button_list cf">
          <li><a class="close_sub_box button-ml" href="#"><?php echo __( 'Close', 'tcd-seeed' ); ?></a></li>
          <li class="delete-row"><a class="button-delete-row button-ml red_button" href="#"><?php echo __( 'Delete this data', 'tcd-seeed' ); ?></a></li>
         </ul>
        </div><!-- END .sub_box_content -->
       </div><!-- END .sub_box -->
       <?php
            $clone = ob_get_clean();
       ?>
      </div><!-- END .repeater -->
      <a href="#" class="button button-secondary button-add-row" data-clone="<?php echo esc_attr( $clone ); ?>"><?php _e( 'Add new data', 'tcd-seeed' ); ?></a>
     </div><!-- END .repeater-wrapper -->
     <?php // リピーターここまで -------------------------- ?>

     <?php // リピーターここから -------------------------- ?>
     <div class="non_line_chart">

     <h4 class="theme_option_headline2"><?php _e('Data label under chart', 'tcd-seeed');  ?></h4>
     <select class="cb_chart_desc_type" name="chart_desc">
      <option style="padding-right: 10px;" value="type1" <?php selected( $chart_desc, 'type1' ); ?>><?php _e('Don\'t display data label', 'tcd-seeed');  ?></option>
      <option style="padding-right: 10px;" value="type2" <?php selected( $chart_desc, 'type2' ); ?>><?php _e('Display data label automatically from chart data', 'tcd-seeed');  ?></option>
      <option style="padding-right: 10px;" value="type3" <?php selected( $chart_desc, 'type3' ); ?>><?php _e('Display original data label', 'tcd-seeed');  ?></option>
     </select>

     <div class="chart_desc_option">

     <div class="theme_option_message2" style="margin-top:20px;">
      <p><?php _e('You can create original data label by using this option.', 'tcd-seeed'); ?></p>
      <p><?php _e('Please add an input field from "Add new data label" button. Each data label can be sorted by dragging headline.', 'tcd-seeed'); ?></p>
     </div>
     <div class="repeater-wrapper">
      <div class="repeater sortable" data-delete-confirm="<?php _e( 'Delete this data label?', 'tcd-seeed' ); ?>">
       <?php
            if ( $item_desc_list && is_array( $item_desc_list ) ) :
              foreach ( $item_desc_list as $key => $value ) :
       ?>
       <div class="sub_box repeater-item repeater-item-<?php echo esc_attr( $key ); ?>">
        <h4 class="theme_option_subbox_headline"><?php _e( 'Data label', 'tcd-seeed' ); echo esc_html( (int)$key + 1 ); ?></h4>
        <div class="sub_box_content">
         <h4 class="theme_option_headline2"><?php _e( 'Description', 'tcd-seeed' ); ?></h4>
         <input class="repeater-label full_width" type="text" name="item_desc_list[<?php echo esc_attr( $key ); ?>][label]" value="<?php echo esc_attr($item_desc_list[$key]['label']); ?>" />
         <h4 class="theme_option_headline2"><?php _e( 'Display color before description', 'tcd-seeed' ); ?></h4>
         <p class="hidden"><input name="item_desc_list[<?php echo esc_attr( $key ); ?>][display_color]" type="hidden" value="0"></p>
         <p class="displayment_checkbox"><label><input name="item_desc_list[<?php echo esc_attr( $key ); ?>][display_color]" type="checkbox" value="1" <?php checked( $item_desc_list[$key]['display_color'], 1 ); ?>><?php _e( 'Display color', 'tcd-seeed' ); ?></label></p>
         <div class="button_option_area" style="<?php if($item_desc_list[$key]['display_color'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
          <h4 class="theme_option_headline2"><?php _e( 'Color', 'tcd-seeed' ); ?></h4>
          <input type="text" name="item_desc_list[<?php echo esc_attr( $key ); ?>][color]" value="<?php echo esc_attr( isset( $item_list[$key]['color'] ) ? $item_desc_list[$key]['color'] : $main_color ); ?>" data-default-color="<?php echo esc_attr($main_color); ?>" class="c-color-picker">
         </div>
         <ul class="button_list cf">
          <li><a class="close_sub_box button-ml" href="#"><?php echo __( 'Close', 'tcd-seeed' ); ?></a></li>
          <li class="delete-row"><a class="button-delete-row button-ml red_button" href="#"><?php echo __( 'Delete this data label', 'tcd-seeed' ); ?></a></li>
         </ul>
        </div><!-- END .sub_box_content -->
       </div><!-- END .sub_box -->
       <?php
              endforeach;
            endif;

            $key = 'addindex';
            $value = array(
              'label' => '',
              'display_color' => '',
              'color' => $main_color,
            );
            ob_start();
       ?>
       <div class="sub_box repeater-item repeater-item-<?php echo esc_attr( $key ); ?>">
        <h4 class="theme_option_subbox_headline"><?php _e( 'New data label', 'tcd-seeed' ); ?></h4>
        <div class="sub_box_content">
         <h4 class="theme_option_headline2"><?php _e( 'Description', 'tcd-seeed' ); ?></h4>
         <input class="repeater-label full_width" type="text" name="item_desc_list[<?php echo esc_attr( $key ); ?>][label]" value="" />
         <h4 class="theme_option_headline2"><?php _e( 'Display color before description', 'tcd-seeed' ); ?></h4>
         <p class="hidden"><input name="item_desc_list[<?php echo esc_attr( $key ); ?>][display_color]" type="hidden" value="0"></p>
         <p class="displayment_checkbox"><label><input name="item_desc_list[<?php echo esc_attr( $key ); ?>][display_color]" type="checkbox" value="1"><?php _e( 'Display color', 'tcd-seeed' ); ?></label></p>
         <div class="button_option_area" style="display:none;">
          <h4 class="theme_option_headline2"><?php _e( 'Color', 'tcd-seeed' ); ?></h4>
          <input type="text" name="item_desc_list[<?php echo esc_attr( $key ); ?>][color]" value="<?php echo esc_attr($main_color); ?>" data-default-color="<?php echo esc_attr($main_color); ?>" class="c-color-picker">
         </div>
         <ul class="button_list cf">
          <li><a class="close_sub_box button-ml" href="#"><?php echo __( 'Close', 'tcd-seeed' ); ?></a></li>
          <li class="delete-row"><a class="button-delete-row button-ml red_button" href="#"><?php echo __( 'Delete this data label', 'tcd-seeed' ); ?></a></li>
         </ul>
        </div><!-- END .sub_box_content -->
       </div><!-- END .sub_box -->
       <?php
            $clone = ob_get_clean();
       ?>
      </div><!-- END .repeater -->
      <a href="#" class="button button-secondary button-add-row" data-clone="<?php echo esc_attr( $clone ); ?>"><?php _e( 'Add new data label', 'tcd-seeed' ); ?></a>
     </div><!-- END .repeater-wrapper -->
     <?php // リピーターここまで -------------------------- ?>

     </div><!-- END .chart_desc_option -->

     </div><!-- END .non_line_chart -->

   </div><!-- END .theme_option_field_ac_content -->
  </div><!-- END .theme_option_field -->

</div><!-- END .tcd_custom_field_wrap -->

<?php
}

function save_chart_meta_box( $post_id ) {

  // verify nonce
  if (!isset($_POST['chart_custom_fields_meta_box_nonce']) || !wp_verify_nonce($_POST['chart_custom_fields_meta_box_nonce'], basename(__FILE__))) {
    return $post_id;
  }

  // check autosave
  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return $post_id;
  }

  // check permissions
  if ('page' == $_POST['post_type']) {
    if (!current_user_can('edit_page', $post_id)) {
      return $post_id;
    }
  } elseif (!current_user_can('edit_post', $post_id)) {
      return $post_id;
  }

  // save or delete
  $cf_keys = array(
    'chart_type','chart_unit','line_color','max_num','bar_width','bar_bg_color',
    'show_table','show_table_unit','chart_desc','chart_box_desc','show_tooltip','show_title'
  );
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
  $cf_keys = array( 'item_list', 'item_desc_list' );
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
add_action('save_post', 'save_chart_meta_box');


// 以下フロント画面の処理 -----------------------------------------------------------------------------------------------


// ショートコード
function sc_tcd_chart( $atts) {

  $atts = shortcode_atts( array(
    'id' => '',
    'delay' => '',
  ), $atts );

  $html = '';

  if ( $atts['id'] ) {

    $post_id = $atts['id'];
    if ( $atts['delay'] ) {
      $delay_speed = $atts['delay'];
    } else {
      $delay_speed = '200';
    }
    $data_list = get_post_meta($post_id, 'item_list', true);

    if(!empty($data_list)){

      $options = get_design_plus_option();
      $main_color = $options['main_color'];

      $rand = mt_rand( 100000, 999999 );
      $chart_name = wp_kses_post(get_the_title($post_id));
      $chart_type = get_post_meta($post_id, 'chart_type', true) ?  esc_attr(get_post_meta($post_id, 'chart_type', true)) : 'doughnut';
      $chart_unit = esc_attr(get_post_meta($post_id, 'chart_unit', true));
      $line_color = get_post_meta($post_id, 'line_color', true) ?  esc_attr(get_post_meta($post_id, 'line_color', true)) : $main_color;
      $bar_bg_color = get_post_meta($post_id, 'bar_bg_color', true) ?  esc_attr(get_post_meta($post_id, 'bar_bg_color', true)) : '#f2f2f2';
      $bar_width = esc_attr(get_post_meta($post_id, 'bar_width', true));
      $max_num = esc_attr(get_post_meta($post_id, 'max_num', true));
      $chart_desc = get_post_meta($post_id, 'chart_desc', true) ?  esc_attr(get_post_meta($post_id, 'chart_desc', true)) : 'type1';
      $data_desc_list = get_post_meta($post_id, 'item_desc_list', true);

      $show_table = get_post_meta($post_id, 'show_table', true) ?  get_post_meta($post_id, 'show_table', true) : 'hide';
      $show_table_unit = get_post_meta($post_id, 'show_table_unit', true) ?  get_post_meta($post_id, 'show_table_unit', true) : 'hide';
      $show_tooltip = get_post_meta($post_id, 'show_tooltip', true) ?  get_post_meta($post_id, 'show_tooltip', true) : 'hide';
      $show_title = get_post_meta($post_id, 'show_title', true) ?  get_post_meta($post_id, 'show_title', true) : 'show';

      $html .= "<div class='tcd_chart'>\n";
      $html .= "<div class='chart " . $chart_type . "'>\n";
      if($show_title == 'show' && $chart_type != 'doughnut'){
        $html .= "<h4 class='chart_headline inview'>" . $chart_name . "</h4>\n";
      }
      $html .= "<div class='chart_area_wrap'>\n";
      $html .= "<div class='chart_area'>\n";
      if($show_title == 'show' && ($chart_type == 'doughnut') && $chart_name){
        $html .= "<h4 class='chart_headline inview'>" . $chart_name . "</h4>\n";
      }
      $html .= "<canvas class='chart_main' id='chart_" . $post_id . "_". $rand . "'></canvas>\n";

      $html .= "</div><!-- END .chart_area -->\n"; // END .chart_area
      $html .= "</div><!-- END .chart_area_wrap -->\n"; // END .chart_area_wrap
      if($chart_desc != 'type1' && $chart_type != 'line'){ // chart desc -----------------------------------------------------------
        $html .= "<div class='chart_labels inview'>\n";
        if($chart_desc == 'type2'){
          foreach ( $data_list as $key => $value ) :
            $html .= "<div class='item'>\n";
            if($value['color']){
              $html .= "<span class='color' style='background:" . esc_html($value['color']) . ";'></span>\n";
            }
            if($value['label']){
              $html .= "<span class='label'>" . esc_html($value['label']) . "</span>\n";
            }
            $html .= "</div>\n";
          endforeach;
        } else {
          if (!empty($data_desc_list)) {
            foreach ( $data_desc_list as $key => $value ) :
              $html .= "<div class='item'>\n";
              if($value['display_color'] && $value['color']){
                $html .= "<span class='color' style='background:" . esc_html($value['color']) . ";'></span>\n";
              }
              if($value['label']){
                $html .= "<span class='label'>" . esc_html($value['label']) . "</span>\n";
              }
              $html .= "</div>\n";
            endforeach;
          }
        }
        $html .= "</div><!-- END .chart_labels -->\n"; // END .chart_labels
      }
      if($show_table == 'show'){ // chart table -----------------------------------------------------------
        $total_data = count($data_list);
        $html .= "<div class='data_table inview";
        if($total_data > 6){
          $html .= " type2";
        }
        $html .= "'>\n";
        $html .= "<table>\n";
        $html .= "<tr>\n";
        foreach ( $data_list as $key => $value ) {
          if($value['label']){
            $html .= "<th>" . esc_html($value['label']) . "</th>\n";
          }
        }
        $html .= "</tr>\n";
        $html .= "<tr>\n";
        foreach ( $data_list as $key => $value ) {
          if($value['data']){
            if($show_table_unit == 'show' && $chart_unit){
              $html .= "<td>" . esc_html($value['data']) . esc_html($chart_unit) . "</td>\n";
            } else {
              $html .= "<td>" . esc_html($value['data']) . "</td>\n";
            }
          }
        }
        $html .= "</tr>\n";
        $html .= "</table>\n";
        $html .= "</div><!-- END .data_table -->\n"; // END .data_table
      }
      $html .= "</div><!-- END .chart -->\n"; // END .chart
      $html .= "</div><!-- END .tcd_chart -->\n"; // END .tcd_chart

      // javascriptは</body>の直前に挿入する -----------------------------------------------------------
      if ( ! wp_script_is( 'tcd-chart', 'enqueued' ) ) {
        wp_enqueue_script('force-inview', get_template_directory_uri() . '/js/jquery.inview.min.js', array( 'jquery' ), version_num(), true ); // cta機能でも利用中
        wp_enqueue_script('tcd-chart', get_template_directory_uri().'/js/Chart.min.js', array( 'jquery' ), version_num(), true);
        wp_enqueue_script('tcd-chart-datalabel', get_template_directory_uri().'/js/chartjs-plugin-datalabels.js', array( 'jquery' ), version_num(), true);
        wp_enqueue_script('tcd-chart-deferred', get_template_directory_uri().'/js/chartjs-plugin-deferred.js', array( 'jquery' ), version_num(), true);

        if ( function_exists( 'wp_add_inline_script' ) ) {
          // disable chart contextmenu
          wp_add_inline_script('tcd-chart', 'jQuery(function($){$(".chart_main").on("contextmenu", function(event) { event.preventDefault(); })});' ,'after');
        }
      }

      if ( function_exists( 'wp_add_inline_script' ) ) {

        $script = "";
        $script .= "jQuery(function($){\n";
        $script .= "var inviewFlag = true;\n";
        $script .= "$('#chart_" . $post_id . "_" . $rand . "').on('inview', function (event, isInView, visiblePartX, visiblePartY) {\n";
        $script .= "if (isInView && inviewFlag == true) {\n";
        $script .= "setTimeout(function(){";
        $script .= "inviewFlag = false;\n";
        if($chart_type == 'horizontalBar'){ // if horizontal bar draw background
        $script .= <<<EOM
Chart.plugins.register({
  afterDatasetsDraw: function(chartInstance) {
    var ctx = chartInstance.chart.ctx,
        width = chartInstance.chartArea.right;
    chartInstance.data.datasets.forEach(function(dataset, datasetIndex) {
      var datasetMeta = chartInstance.getDatasetMeta(datasetIndex);
      datasetMeta.data.forEach(function(segment, segmentIndex) {
        var height = segment._model.height,
            posX = segment.tooltipPosition().x,
            posY = segment.tooltipPosition().y - (height / 2);
        ctx.save();
        ctx.fillStyle = '{$bar_bg_color}';
        ctx.fillRect(posX, posY, width - posX, height);
        ctx.restore();
      });
    });
  }
});
EOM;
        } // end if horizontal bar
        $script .= "var ctx = document.getElementById('chart_" . $post_id . "_" . $rand . "');\n";
        $script .= "var myLineChart = new Chart(ctx, {\n";
        $script .= "type: '" . $chart_type . "',\n";
        $script .= "data: {\n";
        $script .= "labels: [\n";
        foreach ( $data_list as $key => $value ) {
          $script .= "'" . esc_attr($value['label']) . "',";
        }
        $script .= "],\n";
        $script .= "datasets: [{\n";
        if($chart_type == 'line'){
          $script .= "backgroundColor: ['" . $line_color . "'],\n";
          $script .= "lineTension: 0,\n";
          $script .= "borderColor: '" . $line_color . "',\n";
          $script .= "borderWidth: 2,\n";
          $script .= "fill: false,\n";
        } elseif($chart_type == 'doughnut' || $chart_type == 'pie'){
          if($chart_type == 'pie'){
            $script .= "borderWidth: 0,\n";
          } else {
            $script .= "borderWidth: 1,\n";
          }
          $script .= "backgroundColor: [\n";
          foreach ( $data_list as $key => $value ) {
            $script .= "'" . esc_attr($value['color']) . "',";
          }
          $script .= "],\n";
        } else {
          $script .= "backgroundColor: [\n";
          foreach ( $data_list as $key => $value ) {
            $script .= "'" . esc_attr($value['color']) . "',";
          }
          $script .= "],\n";
        }
        $script .= "data: [\n";
        foreach ( $data_list as $key => $value ) {
          $script .=  esc_attr($value['data']) . ",";
        }
        $script .= "],\n";
        if( ($chart_type == 'bar' && $bar_width) || ($chart_type == 'horizontalBar' && $bar_width) ){
          $script .= "maxBarThickness:" . $bar_width . ",\n";
        }
        $script .= "}]\n";
        $script .= "},\n";
        $script .= "options: {\n";
        $script .= "responsive: true,\n";
        $script .= "maintainAspectRatio: false,\n";
        $script .= "legend: { display:false, },\n";
        if($chart_type == 'bar'){ // if bar chart -------------------------------------------
        $script .= "scales: {\n";
        $script .= "yAxes: [{\n";
        $script .= "gridLines: { color: 'rgba(0, 0, 0, 0)', zeroLineColor: 'transparent', },\n";
        $script .= "ticks: {\n";
        $script .= "beginAtZero: true,\n";
        $script .= "display: false,\n";
        if($max_num){
          $script .= "max:" . $max_num . ",\n";
        } else {
          $value_list = array();
          foreach ( $data_list as $key => $value ) {
            $value_list[] = esc_attr($value['data']);
          };
          if(!empty($value_list)){
            $max_value = max($value_list);
            $script .= "max:" . ($max_value * 1.1) . ",\n";
          }
        }
        $script .= "},\n";
        $script .= "}],\n"; // end yAxes
        $script .= "xAxes: [{ gridLines: { color:'rgba(0, 0, 0, 0)', zeroLineColor: 'transparent', }, ticks: { padding: 8, fontSize: 14, fontFamily: 'ヒラギノ角ゴ ProN, 游ゴシック', fontColor: '#000000' }, }],\n";
        $script .= "},\n"; // end scales
        $script .= "plugins: {\n";
        $script .= "datalabels: { \n";
        $script .= "color:'#000', anchor: 'end', align: 'end', formatter: (val) => { return val.toLocaleString() + '" . $chart_unit . "' }\n";
        $script .= "}\n";
        $script .= "},\n"; // end plugins
        } elseif($chart_type == 'horizontalBar'){ // if horizontal bar chart ----------------------------------------- 
        $script .= "events: [],\n";
        $script .= "plugins: {\n";
        $script .= "datalabels: {\n";
        $script .= "color:'#fff', anchor: 'start', align: 'end', offset: 15, formatter: (val) => { return val.toLocaleString() + '" . $chart_unit . "' }\n";
        $script .= "},\n";
        $script .= "deferred: { yOffset: 300, } \n";
        $script .= "},\n"; // end plugins
        $script .= "scales: {\n";
        $script .= "yAxes: [{\n";
        $script .= "gridLines: {\n";
        $script .= "color: 'rgba(0, 0, 0, 0)',\n";
        $script .= "zeroLineColor: 'transparent',\n";
        if($max_num){
          $script .= "max:" . $max_num . ",\n";
        }
        $script .= "},\n";
        $script .= "ticks: { padding: 8, fontSize: 14, fontFamily: 'ヒラギノ角ゴ ProN, 游ゴシック', fontColor: '#000000' }\n";
        $script .= "}],\n"; // end yAxes
        $script .= "xAxes: [{\n";
        $script .= "gridLines: { color: 'rgba(0, 0, 0, 0)', zeroLineColor: 'transparent', },\n";
        $script .= "ticks: {\n";
        $script .= "beginAtZero: true,\n";
        $script .= "display: false,\n";
        if($max_num){
          $script .= "max:" . $max_num . ",\n";
        }
        $script .= "},\n";
        $script .= "}],\n"; // end xAxes
        $script .= "},\n"; // end scales
        }; // end bar chart
        if($chart_type == 'line'){ // if line chart ----------------------------------------- 
        $script .= "scales: {\n";
        $script .= "yAxes: [{\n";
        $script .= "ticks: {\n";
        $script .= "beginAtZero: true,\n";
        $script .= "padding: 10, fontSize: 11, fontColor: '#000000',\n";
        if($max_num){
          $script .= "max:" . $max_num . ",\n";
        }
        $script .= "userCallback: function(tick) { return tick.toLocaleString() + '" . $chart_unit . "' }\n";
        $script .= "},\n";
        $script .= "}],\n"; // end yAxes
        $script .= "xAxes: [{ ticks: { padding: 8, fontSize: 14, fontFamily: 'ヒラギノ角ゴ ProN, 游ゴシック', fontColor: '#000000' } }], \n";
        $script .= "},\n"; // end scales
        $script .= "plugins: {\n";
        $script .= "datalabels: { display:false, }, deferred: { yOffset: 300, } \n";
        $script .= "},\n";
        }; // end line chart
        if($chart_type == 'doughnut' || $chart_type == 'pie'){ // if doughnut or pie chart ------------------------------------------------------
          if($show_tooltip == 'show'){
            $script .= "tooltips: {\n";
            $script .= "callbacks: {\n";
            $script .= "label: function (tooltipItems, data) {\n";
            $script .= "return data.labels[tooltipItems.index] + ' ' + data.datasets[0].data[tooltipItems.index].toLocaleString() + '" . $chart_unit . "'\n";
            $script .= "}\n";
            $script .= "}\n";
            $script .= "},\n";
          } else {
            $script .= "tooltips: { enabled: false }, hover: { mode: null },\n";
          }
          $script .= "plugins: {\n";
          $script .= "datalabels: { color:'#ffffff', font: function (context) { var width = context.chart.width; var size = Math.round(width / 18); return { size: size, weight: 500, }; }, formatter: (val) => { return val.toLocaleString() + '" . $chart_unit . "' } }, \n";
          $script .= "deferred: { yOffset: 300, }\n";
          $script .= "},\n";
        } else { // end doughnut chart
          $script .= "tooltips: { enabled: false }, hover: { mode: null },\n";
        }
        $script .= "}\n"; // end options
        $script .= "});\n"; // myLineChart
        $script .= "}, " . $delay_speed .");";
        $script .= "}\n"; // end trigger inview
        $script .= "});\n"; // end on inview function
        $script .= "});\n"; // end jquery

        wp_add_inline_script('tcd-chart-deferred', $script ,'after');

      } // end if has wp_add_inline_script

    }; // end if has $data_list

  }; // end if has $atts['id']

  return $html;

}
add_shortcode( 'tcd_chart', 'sc_tcd_chart' );
?>