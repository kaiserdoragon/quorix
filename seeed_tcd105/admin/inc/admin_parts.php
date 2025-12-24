<?php

// 管理画面のパーツ

// よく使う翻訳テキスト
function tcd_admin_label($key, $atts = array('','')) {

  $text_domain = 'tcd-seeed';

  $translates = array(

    // 保存ボタン
    'save' => __( 'Save Changes', 'tcd-seeed' ),
    'close' => __( 'Close', 'tcd-seeed' ),

    // 画像
    'select_image' => __( 'Select Image', 'tcd-seeed' ),
    'remove_image' => __( 'Remove Image', 'tcd-seeed' ),

    // ダミーテキスト
    'dummy_desc' => __( 'Description will be displayed here.<br>Description will be displayed here.', 'tcd-seeed' ),

    'basic' => __( 'Basic', 'tcd-seeed' ),

    // ブログ
    'blog' => __( 'Blog', 'tcd-seeed' ),
    'News' => __( 'News', 'tcd-seeed' ),
    'common' => __( 'Common setting', 'tcd-seeed' ),
    'content_name' => __( 'Name of content', 'tcd-seeed' ),
    'use_breadcrumb' => __( 'This name will also be used in breadcrumb link.', 'tcd-seeed' ),
    'archive_page' => __( 'Archive page', 'tcd-seeed' ),
    'header' => __( 'Header', 'tcd-seeed' ),
    'headline' => __( 'Headline', 'tcd-seeed' ),
    'sub_headline' => __( 'Sub headline', 'tcd-seeed' ),
    'desc' => __( 'Description', 'tcd-seeed' ),
    'desc_sp' => __( 'Description (mobile)', 'tcd-seeed' ),
    'article_list' => __( 'Article list', 'tcd-seeed' ),
    'article_list_num' => __( 'Number of article to display per page', 'tcd-seeed' ),
    'font_size_title' => __( 'Font size of title', 'tcd-seeed' ),
    'article_title_area' => __( 'Article title area', 'tcd-seeed' ),
    'display_setting' => __( 'Display setting', 'tcd-seeed' ),
    'related_post' => __( 'Related post', 'tcd-seeed' ),

    'no_image' => __( 'Alternate image to be displayed when featured image is not registered', 'tcd-seeed' ),
    'no_image_desc' => __( 'If you set image here, you can display alternative image for article which featured image is not set.', 'tcd-seeed' ),
    'no_image_desc2' => __( 'This image will be applied with priority over the "Alternate image to be displayed when featured image is not registered" option in the basic setting menu.', 'tcd-seeed' ),

    'recommend_image' => sprintf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-seeed'), $atts[0], $atts[1]),

    'color' => __( 'Font color', 'tcd-seeed' ),
    'bg_color' => __( 'Background color', 'tcd-seeed' ),
    'bg_color_hover' => __( 'Background color on mouseover', 'tcd-seeed' ),
    'border_color' => __( 'Border color', 'tcd-seeed' ),
    'menu' => __( 'Menu', 'tcd-seeed' ),
    'catch' => __( 'Catchphrase', 'tcd-seeed' ),
    'catch_sp' => __( 'Catchphrase (mobile)', 'tcd-seeed' ),
    'font_size' => __( 'Font size', 'tcd-seeed' ),
    'font_type' => __( 'Font type', 'tcd-seeed' ),
    'text_align' => __( 'Text align', 'tcd-seeed' ),
    'font_weight' => __( 'Font weight', 'tcd-seeed' ),

    'content' => __( 'Content', 'tcd-seeed' ),
    'text' => __( 'Text', 'tcd-seeed' ),
    'button' => __( 'Button', 'tcd-seeed' ),
    'button_type' => __( 'Button type', 'tcd-seeed' ),
    'button_label' => __( 'Button label', 'tcd-seeed' ),
    'label' => __( 'Label', 'tcd-seeed' ),
    'display_button' => __( 'Display button', 'tcd-seeed' ),
    'new_open' => __( 'Open link in new window', 'tcd-seeed' ),

    'bg' => __( 'Background', 'tcd-seeed' ),
    'bg_image' => __( 'Background image', 'tcd-seeed' ),
    'bg_image_sp' => __( 'Background image (mobile)', 'tcd-seeed' ),

    'image' => __( 'Image', 'tcd-seeed' ),

    'overlay' => __( 'Overlay', 'tcd-seeed' ),
    'overlay_color' => __( 'Color of overlay', 'tcd-seeed' ),
    'overlay_opacity' => __( 'Transparency of overlay', 'tcd-seeed' ),

    'opacity_desc' => __( 'Please specify the number of 0 from 1.0. Overlay color will be more transparent as the number is small.', 'tcd-seeed' ),
    'device_diff_text' => __( 'If you want to display different text on mobile size, please fill in this field.', 'tcd-seeed' ),

    


    'delete' => __( 'Delete?', 'tcd-seeed' ),
    'delete_item' => __( 'Delete item', 'tcd-seeed' ),
    'new_item' => __( 'New item', 'tcd-seeed' ),
    'add_item' => __( 'Add item', 'tcd-seeed' ),
    'Item' => __( 'Item', 'tcd-seeed' ),




    

  );

  return $translates[$key];
  
}

function tcd_recommend_size($width, $height) {

  $translate = sprintf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-seeed'), $width, $height);
  return $translate;
}

function tcd_get_post_labels($dp_options, $post_type) {
  if($post_type == 'blog'){
    $label = $dp_options['blog_label'] ? esc_html( $dp_options['blog_label'] ) : __( 'Blog', 'tcd-seeed' );
  }elseif($post_type == 'news'){
    $label = $dp_options['news_label'] ? esc_html( $dp_options['news_label'] ) : __( 'News', 'tcd-seeed' );
  }
  return $label;
}









// PCモバイルの文字サイズ専用オプション
function tcd_font_size_option($dp_options, $key, $repeater = false) {

	$html = '<div class="font_size_option">';

  if($repeater == false){
    $name = 'dp_options['.$key.']';
    $name_sp = 'dp_options['.$key.'_sp]';
    $value = esc_attr( $dp_options[$key] );
    $value_sp = esc_attr( $dp_options[$key.'_sp'] );
  }else{
    $name = 'dp_options['.$key[0].']['.$key[1].']['.$key[2].']';
    $name_sp = 'dp_options['.$key[0].']['.$key[1].']['.$key[2].'_sp]';
    $value = esc_attr( $dp_options[$key[2]] );
    $value_sp = esc_attr( $dp_options[$key[2].'_sp'] );
  }

  // PC
	$html .= '<label class="font_size_label number_option">';
	$html .= '<input class="hankaku input_font_size" type="number" name="'.$name.'" value="'.$value.'" />';
	$html .= '<span class="icon icon_pc"></span>';
	$html .= '</label>';

  // SP
  $html .= '<label class="font_size_label number_option">';
	$html .= '<input class="hankaku input_font_size_sp" type="number" name="'.$name_sp.'" value="'.$value_sp.'" />';
	$html .= '<span class="icon icon_sp"></span>';
	$html .= '</label>';


	$html .= '</div>';

	return $html;

}

// CF PCモバイルの文字サイズ専用オプション
function cf_tcd_font_size_option($key, $variable, $variable_sp) {

	$html = '<div class="font_size_option">';

  // PC
  $html .= '<label class="font_size_label number_option">';
	$html .= '<input class="hankaku input_font_size" type="number" name="'.$key.'" value="'.esc_attr( $variable ).'" />';
	$html .= '<span class="icon icon_pc"></span>';
	$html .= '</label>';

  // SP
  $html .= '<label class="font_size_label number_option">';
  $html .= '<input class="hankaku input_font_size_sp" type="number" name="'.$key.'_sp" value="'.esc_attr( $variable_sp ).'" />';
  $html .= '<span class="icon icon_sp"></span>';
  $html .= '</label>';

	$html .= '</div>';

	return $html;

}


// 表示する記事の数
function tcd_display_post_num_option($key, $pc_nums, $sp_nums) {

  $dp_options = get_design_plus_option();

  $html = '<div class="display_post_num_option">';

  // PC
  $min = $pc_nums[0];
  $max = $pc_nums[1];
  $divisible = $pc_nums[2];

  $html .= '<label for="'.$key.'">';
  $html .= '<select id="'.$key.'" name="dp_options['.$key.']">';

  for($i = $min; $i <= $max; $i++):
    if( ($i % $divisible) == 0 )
      $html .= '<option value="'.esc_attr($i).'" '.selected( $dp_options[$key], $i, false ).'>'.esc_html($i).'</option>';
  endfor;

  $html .= '</select>';
  $html .= '<span class="icon icon_pc"></span>';
  $html .= '</label>';

  // SP
  $key_sp = $key.'_sp';
  $min = $sp_nums[0];
  $max = $sp_nums[1];
  $divisible = $sp_nums[2];

  $html .= '<label for="'.$key_sp.'">';
  $html .= '<select id="'.$key_sp.'" name="dp_options['.$key_sp.']">';

  for($i = $min; $i <= $max; $i++):
    if( ($i % $divisible) == 0 )
      $html .= '<option value="'.esc_attr($i).'" '.selected( $dp_options[$key_sp], $i, false ).'>'.esc_html($i).'</option>';
  endfor;

  $html .= '</select>';
  $html .= '<span class="icon icon_sp"></span>';
  $html .= '</label>';

	$html .= '</div>';

	return $html;

}


// 表示する記事の数
function tcd_display_post_num_option_type2( $dp_options, $key, $attr_pc = false, $attr_sp = false ) {

	$html = '<div class="display_post_num_option">';

	// PC
	$html .= '<label for="' . $key . '">';
	$html .= '<input type="number" id="' . $key . '" name="dp_options[' . $key . ']" value="' . absint( $dp_options[ $key ] ) . '" ' . ( $attr_pc ?: 'min="1"' ) . '>';
	$html .= '<span class="icon icon_pc"></span>';
	$html .= '</label>';

	// SP
	$key_sp = $key . '_sp';
	$html  .= '<label for="' . $key_sp . '">';
	$html  .= '<input type="number" id="' . $key_sp . '" name="dp_options[' . $key_sp . ']" value="' . absint( $dp_options[ $key_sp ] ) . '" ' . ( $attr_sp ?: 'min="1"' ) . '>';
	$html  .= '<span class="icon icon_sp"></span>';
	$html  .= '</label>';

	$html .= '</div>';

	return $html;
}





// 横展開のラジオボタン
function tcd_basic_radio_button($dp_options, $key, $options, $repeater = false) {

  // dp
  if($repeater == false){
    $name = 'dp_options['.$key.']';
    $check = $dp_options[$key];
  }else{
    $name = 'dp_options['.$key[0].']['.esc_attr( $key[1] ).']['.$key[2].']';
    $check = $dp_options[$key[2]];
  }

	$html = '<div class="standard_radio_button">';

	foreach ( $options as $option ) {

    if($repeater == false){
      $connect = $key.'_'.esc_attr($option['value']);
    }else{
      $connect = $key[0].$key[1].'_'.$key[2].'_'.esc_attr($option['value']);
    }
		$html .= '<input id="'.$connect.'" type="radio" name="'.$name.'" value="'.esc_attr($option['value']).'"'.checked( $check, esc_attr($option['value']), false ).'>';
		$html .= '<label for="'.$connect.'">'.$option['label'].'</label>';
	}

	$html .= '</div>';

	return $html;

}

// 横展開のラジオボタン
function cf_tcd_basic_radio_button($key, $variable, $options) {

	$html = '<div class="standard_radio_button">';

	foreach ( $options as $option ) {
		$connect = $key.'_'.esc_attr($option['value']);
		$html .= '<input id="'.$connect.'" type="radio" name="'.$key.'" value="'.esc_attr($option['value']).'"'.checked( $variable, esc_attr($option['value']), false ).'>';
		$html .= '<label for="'.$connect.'">'.$option['label'].'</label>';
	}

	$html .= '</div>';

	return $html;

}



// カラーピッカー横のトグルボタン
function admin_cp_toggle_button($dp_options, $key ) {
	$html = '<input class="hide_cp_toggle_button" id="'.$key.'" name="dp_options['.$key.']" type="checkbox" value="1" '.checked( '1', $dp_options[$key], false ).' />';
	$html .= '<label for="'.$key.'"><span></span>'.__('No background color', 'tcd-seeed').'</label>';
	return $html;
}


// 汎用型トグルボタン
function tcd_toggle_button($dp_options, $key, $label ) {
	$html = '<input class="tcd_toggle_button" id="tcd_toggle_button_for_'.$key.'" name="dp_options['.$key.']" type="checkbox" value="1" '.checked( '1', $dp_options[$key], false ).' />';
	$html .= '<label for="tcd_toggle_button_for_'.$key.'"><span></span>'. esc_html($label) .'</label>';
	return $html;
}


// メディアアップローダー
function tcd_media_image_uploader($dp_options, $key, $size = 'full', $repeater = false) {

  if($repeater == false){
    $id = $key;
    $name = 'dp_options['.$key.']';
    $value = $dp_options[$key];
  }else{
    $id = $key[0].$key[1].'_'.$key[2];
    $name = 'dp_options['.$key[0].']['.esc_attr( $key[1] ).']['.$key[2].']';
    $value = $dp_options[$key[2]];
  }

  $html = '<div class="image_box cf">';
  $html .= '<div class="cf cf_media_field hide-if-no-js '.$id.'">';
  $html .= '<input type="hidden" value="'.esc_attr( $value ).'" id="'.$id.'" name="'.$name.'" class="cf_media_id">';
  $html .= '<div class="preview_field">';
  if ( $value ) $html .= wp_get_attachment_image( $value, $size );
  $html .= '</div>';
  $html .= '<div class="button_area">';
  $html .= '<input type="button" value="'.tcd_admin_label('select_image').'" class="cfmf-select-img button" style="margin-right:5px;">';
  $html .= '<input type="button" value="'.tcd_admin_label('remove_image').'" class="cfmf-delete-img button ';
  if ( !$value ) $html .= 'hidden';
  $html .= '">';
  $html .= '</div>';
  $html .= '</div>';
  $html .= '</div>';

  return $html;

}



// 画像付きラジオボタン
function tcd_admin_image_radio_button($dp_options, $key, $options) {

	$i = 0;
	$html = '';
	foreach( $options as $option){
							
		$i++;
		$id = $key.$i;

		$html .= '<input class="tcd_admin_image_radio_button" id="'.$id.'" type="radio" name="dp_options['.$key.']" value="'.esc_attr($option['value']).'" '.checked( $dp_options[$key], esc_attr($option['value']), false ).'>';
		$html .= '<label for="'.$id.'">';
		$html .= '<span class="image_wrap"><img src="'.$option['image'].'" alt=""></span>';
		$html .= '<span class="title_wrap"><span class="title">'.$option['label'].'</span></span>';
		$html .= '</label>';

	}

	return $html;

}


// CF 画像付きラジオボタン
function cf_tcd_admin_image_radio_button($key, $variable, $options) {

	$i = 0;
	$html = '';
	foreach( $options as $option){
							
		$i++;
		$id = $key.$i;

		$html .= '<input class="tcd_admin_image_radio_button" id="'.$id.'" type="radio" name="'.$key.'" value="'.esc_attr($option['value']).'" '.checked( $variable, esc_attr($option['value']), false ).'>';
		$html .= '<label for="'.$id.'">';
		$html .= '<span class="image_wrap"><img src="'.$option['image'].'" alt=""></span>';
		$html .= '<span class="title_wrap"><span class="title">'.$option['label'].'</span></span>';
		$html .= '</label>';

	}

	return $html;

}

// カラーオプション
function tcd_color_option( $dp_options, $key, $class = '' ) {
  global $dp_default_options;

  $output = '<input type="text" name="dp_options['. $key . ']" value="' . esc_attr( $dp_options[$key] ) . '" data-default-color="' . esc_attr( $dp_default_options[$key] ) . '" class="c-color-picker ' . $class . '">';
  return $output;

}


// 画像の複数選択
function tcd_multi_media_uploader( $name, $options ) {
  $display = 'none';
  $image_ids = explode( ',', $options[$name] );
?>
<div class="multi-media-uploader">
 <ul>
  <?php
       if ( $options[$name] && !empty( $image_ids ) ) {
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
 <a id="<?php echo $name; ?>" href="#" class="js-multi-media-upload-button button">
  <?php _e( 'Select Image', 'tcd-seeed' ); ?>
 </a>
 <input type="hidden" class="attechments-ids <?php echo $name; ?>" name="dp_options[<?php echo $name; ?>]" id="<?php echo $name; ?>" value="<?php echo esc_attr( implode( ',', $image_ids ) ); ?>" />
 <a href="#" class="js-multi-media-remove-button button" style="display:<?php echo $display; ?>;">
  <?php _e( 'Delete all images', 'tcd-seeed' ); ?>
 </a>
</div>
<?php
}


?>