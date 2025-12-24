<?php

class tcd_toc_widget extends WP_Widget {

  // Constructor //
  function __construct() {
    parent::__construct(
      'tcd_toc_widget',// ID
      __( 'Table of Contents (tcd ver)', 'tcd-seeed' ),
      array(
        'classname' => 'tcd_toc_widget',
        'description' => __('Displays a designed Table of Contents. This widget will be display at the bottom of widget area.', 'tcd-seeed')
      )
    );
  }

 // Extract Args //
 function widget($args, $instance) {

    global $post, $toc_id_name;

    extract( $args );

    $title_type = $instance['title_type'];
    $only_sidebar = $instance['only_sidebar'];
    $content = get_the_content();
    $toc_title = get_toc_title($title_type);
    $headings = get_toc_headings($content);

    if($headings){ // 目次が存在する場合のみ出力

    // Before widget //
    if($only_sidebar){
      $before_widget = str_replace('clearfix', 'clearfix only_sidebar', $before_widget);
    }
    echo $before_widget;

    // Widget output //

    // $id_name = 'index-';
    $toc = create_toc_list($toc_title, $headings, $toc_id_name);
    echo $toc;

    // After widget //
    echo $after_widget;

    } //if $headings

 } // end function widget


 // Update Settings //
 function update($new_instance, $old_instance) {

   $instance['title_type'] = $new_instance['title_type'];
   $instance['only_sidebar'] = $new_instance['only_sidebar'];

   return $instance;
 }

 // Widget Control Panel //
 function form($instance) {
   $defaults = array( 'title_type' => 'type1', 'only_sidebar' => '');
   $instance = wp_parse_args( (array) $instance, $defaults );
?>

<div class="theme_option_message2" style="margin-top:20px; margin-bottom:20px;">
 <p><?php _e('This widget will be display at the bottom of widget area.', 'tcd-seeed'); ?></p>
</div>

<div class="tcd_widget_content">
 <h3 class="tcd_widget_headline"><?php _e('Title type', 'tcd-seeed'); ?></h3>
 <select name="<?php echo $this->get_field_name('title_type'); ?>" class="widefat" style="width:100%;">
  <option value="type1" <?php selected('type1', $instance['title_type']); ?>><?php _e('Use the table of contents title in the theme options', 'tcd-seeed'); ?></option>
  <option value="type2" <?php selected('type2', $instance['title_type']); ?>><?php _e('Use the article title', 'tcd-seeed'); ?></option>
 </select>
</div>
<div class="tcd_widget_content">
 <h3 class="tcd_widget_headline"><?php _e('Display setting', 'tcd-seeed'); ?></h3>
 <p>
  <input id="<?php echo $this->get_field_id('only_sidebar'); ?>" name="<?php echo $this->get_field_name('only_sidebar'); ?>" type="checkbox" value="1" <?php checked( '1', $instance['only_sidebar'] ); ?> />
  <label for="<?php echo $this->get_field_id('only_sidebar'); ?>"><?php _e('Display the table of contents only in the sidebar', 'tcd-seeed'); ?></label>
 </p>
</div>
<?php

 } // end function form
} // end class

function register_tcd_toc_widget() {
	register_widget( 'tcd_toc_widget' );
}
add_action( 'widgets_init', 'register_tcd_toc_widget' );


?>
