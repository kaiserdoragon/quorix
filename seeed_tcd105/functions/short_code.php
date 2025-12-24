<?php
/**
 * 吹き出しクイックタグ用ショートコード
 */
function tcd_shortcode_speech_balloon( $atts, $content, $tag ) {
	global $dp_options;
	if ( ! $dp_options ) $dp_options = get_design_plus_option();

	$atts = shortcode_atts( array(
		'user_image_url' => '',
		'user_name' => ''
	), $atts );

	// user_image_urlが指定されていればメディアID取得・差し替えを試みる
	$user_image_url = $atts['user_image_url'];
	if ( $atts['user_image_url'] ) {
		$attachment_id = attachment_url_to_postid( $atts['user_image_url'] );
		if ( $attachment_id ) {
			$user_image = wp_get_attachment_image_src( $attachment_id, array( 300, 300, true ) );
			if ( $user_image ) {
				$atts['user_image_url'] = $user_image[0];
			}
		}
	}

	$html = '<div class="speach_balloon ' . esc_attr( $tag ) . '">'
		  . '<div class="speach_balloon_user">';

	if ( $atts['user_image_url'] ) {
		$html .= '<img class="speach_balloon_user_image" src="' . esc_attr( $atts['user_image_url'] ) . '" alt="' . esc_attr( $atts['user_image_url'] ) . '">';
	}

	$html .= '<div class="speach_balloon_user_name">' . esc_html( $atts['user_name'] ) . '</div>'
		  . '</div>'
		  . '<div class="speach_balloon_text">' .  wpautop( $content )   . '</div>'
		  .  '</div>';

	return $html;
}
// add_shortcode( 'speech_balloon_left1', 'tcd_shortcode_speech_balloon' );
// add_shortcode( 'speech_balloon_left2', 'tcd_shortcode_speech_balloon' );
// add_shortcode( 'speech_balloon_right1', 'tcd_shortcode_speech_balloon' );
// add_shortcode( 'speech_balloon_right2', 'tcd_shortcode_speech_balloon' );


function speech_balloon_template( $content, $i, $type = 'left' ) {

  $options = get_design_plus_option();

  $image = get_template_directory_uri().'/img/no_avatar.png';
  if($options['qt_speech_balloon'.$i.'_user_image']){
    $image = wp_get_attachment_image_src( $options['qt_speech_balloon'.$i.'_user_image'], array( 300, 300, true ) );
    if(!empty($image)) $image = $image[0];
  }
  $name = $options['qt_speech_balloon'.$i.'_user_name'];

  $html = '<div class="speech_balloon '.$type.'">'."\n";
  $html .= '<div class="speech_balloon_user">'."\n";
	$html .= '<img class="speech_balloon_user_image" src="'.esc_attr($image).'" alt="">'."\n";
  if($name) $html .= '<div class="speech_balloon_user_name">' . esc_html($name) . '</div>'."\n";
  $html .= '</div>'."\n";
  $html .= '<div class="speech_balloon_text speech_balloon'.$i.'">'."\n";
  $html .= '<span class="before"></span>';
  $html .= '<div class="speech_balloon_text_inner">'.wpautop( $content ).'</div>'."\n";
  $html .= '<span class="after"></span>';
  $html .= '</div>'."\n";
  $html .= '</div>'."\n";

  return $html;

}


function tcd_speech_balloon1( $attr, $content ) {
  return speech_balloon_template($content, 1, 'left');
}
add_shortcode( 'speech_balloon_left1', 'tcd_speech_balloon1' );

function tcd_speech_balloon2( $attr, $content ) {
  return speech_balloon_template($content, 2, 'left');
}
add_shortcode( 'speech_balloon_left2', 'tcd_speech_balloon2' );

function tcd_speech_balloon3( $attr, $content ) {
  return speech_balloon_template($content, 3, 'right');
}
add_shortcode( 'speech_balloon_right1', 'tcd_speech_balloon3' );

function tcd_speech_balloon4( $attr, $content ) {
  return speech_balloon_template($content, 4, 'right');
}
add_shortcode( 'speech_balloon_right2', 'tcd_speech_balloon4' );





/**
 * 吹き出しクイックタグ用ショートコード（フリー）
 */
function tcd_shortcode_speech_balloon_free( $atts, $content ) {

	$atts = shortcode_atts( array(
		'image' => '',
		'name' => '',
    'type' => 'left',
    'color' => '',
    'bg_color' => '',
    'border_color' => ''
	), $atts );

	// user_image_urlが指定されていればメディアID取得・差し替えを試みる
  $image = get_template_directory_uri().'/img/no_avatar.png';
	$user_image_url = $atts['image'];
	if ( $atts['image'] ) {
		$attachment_id = attachment_url_to_postid( $atts['image'] );
		if ( $attachment_id ) {
			$user_image = wp_get_attachment_image_src( $attachment_id, array( 300, 300, true ) );
			if ( $user_image ) {
				$image = esc_attr($user_image[0]);
			}
		}
	}

  $name = esc_html($atts['name']);
  $type = esc_attr($atts['type']);
  $color = ($atts['color']) ? 'color:'.esc_attr($atts['color']).';' : '';
  $bg_color = ($atts['bg_color']) ? 'background-color:'.esc_attr($atts['bg_color']).';' : '';
  $border_color = ($atts['border_color']) ? 'border-color:'.esc_attr($atts['border_color']).';' : '';

  $border_right_color = ($atts['bg_color']) ? 'border-right-color:'.esc_attr($atts['bg_color']).';' : '';
  $border_left_color = ($atts['border_color']) ? 'border-left-color:'.esc_attr($atts['border_color']).';' : '';

	$html = '<div class="speech_balloon '.$type.'">'."\n";
  $html .= '<div class="speech_balloon_user">'."\n";
	$html .= '<img class="speech_balloon_user_image" src="'.$image.'" alt="">'."\n";
  if($name) $html .= '<div class="speech_balloon_user_name">' . $name . '</div>'."\n";
  $html .= '</div>'."\n";
  $html .= '<div class="speech_balloon_text">' ."\n";
  $html .= '<span class="before" style="'.$border_left_color.'"></span>';
  $html .= '<div class="speech_balloon_text_inner" style="'.$color.$bg_color.$border_color.'">' .  wpautop( $content )   . '</div>'."\n";
  $html .= '<span class="after" style="'.$border_right_color.'"></span>';
  $html .= '</div>'."\n";
  $html .= '</div>'."\n";

	return $html;
}
add_shortcode( 'speech_balloon_free', 'tcd_shortcode_speech_balloon_free' );




/**
 * Google Map用ショートコード
 */
function tcd_google_map($atts) {
  global $options;
  if ( ! $options ) $options = get_design_plus_option();

  $atts = shortcode_atts( array(
    'address' => '',
  ), $atts );

  $html = '';

  if ( $atts['address'] ) {

    $use_custom_overlay = 'type1' !== $options['qt_gmap_marker_type'] ? 1 : 0;
    $custom_marker_type = $options['qt_gmap_marker_type'] ? $options['qt_gmap_marker_type'] : 'type2';

    $marker_img = $options['qt_gmap_marker_img'] ? wp_get_attachment_url( $options['qt_gmap_marker_img'] ) : get_template_directory_uri().'/img/gmap_no_image.png';
    if(($custom_marker_type == 'type3') && !empty($marker_img)) {
      $marker_text = '';
    } else {
      $marker_text = $options['qt_gmap_marker_text'];
    }
    if($options['qt_access_saturation'] == 'default'){
      $access_saturation = 0;
    }else{
      $access_saturation = -100;
    }
    $rand = rand();

    $html .= "<div class='qt_google_map'>\n";
    $html .= " <div class='qt_googlemap clearfix'>\n";
    $html .= "  <div id='qt_google_map" . $rand . "' class='qt_googlemap_embed'></div>\n";
    $html .= " </div>\n";
    $html .= " <script>\n";
    $html .= " jQuery(window).on('load', function() {\n";
    $html .= "  initMap('qt_google_map" . $rand . "', '" . esc_js( $atts['address'] ) . "', " . esc_js( $access_saturation ) . ", " . esc_js( $use_custom_overlay ) . ", '" . esc_js( $marker_img ) . "', '" . esc_js( $marker_text ) . "');\n";
    $html .= " });\n";
    $html .= " </script>\n";
    $html .= "</div>\n";

    if ( ! wp_script_is( 'qt_google_map_api', 'enqueued' ) ) {
      wp_enqueue_script( 'qt_google_map_api', 'https://maps.googleapis.com/maps/api/js?key=' . esc_attr( $options['qt_gmap_api_key'] ), array(), version_num(), true );
      wp_enqueue_script( 'qt_google_map', get_template_directory_uri() . '/js/googlemap.js', array(), version_num(), true );
    }
  }

	return $html;
}
add_shortcode( 'qt_google_map', 'tcd_google_map' );




/**
 * FAQ用ショートコード
 */
function tcd_faq($atts) {
  global $post;

  $faq_list = get_post_meta($post->ID, 'faq_list', true);

  $html = '';

  if ( $faq_list ) {
    $html .= "<div class='faq_list inview slide_up_animation'>\n";
    foreach ( $faq_list as $key => $value ) :
      $question = $value['question'];
      $answer = $value['answer'];
      if ( $question && $answer) {
        $html .= "<div class='item'>\n";
        $html .= '<h4 class="title no_editor_style"><span>' . esc_html($question) . "</span></h4>\n";
        $html .= '<div class="desc_area"><p class="desc no_editor_style"><span>' . wp_kses_post(nl2br($answer)) . "</span></p></div>\n";
        $html .= "</div>\n";
      }
    endforeach;
    $html .= "</div>\n";
  }

	return $html;
}
add_shortcode( 'sc_faq', 'tcd_faq' );


/**
 * プラン一覧
 */
function sc_tcd_plan_list($atts) {

  $options = get_design_plus_option();

  $html = '';

  if($options['plan_list']){

    $plan_list = $options['plan_list'];
    $total_plan = 0;
    foreach ( $plan_list as $key => $value ) :
      if($value['headline']){
        $total_plan++;
      }
    endforeach;

    $html .= "<div class='design_plan_list_wrap'>\n";

    if($total_plan == 1){
      $html .= "<div class='design_plan_list_slider swiper'>\n";
      $html .= "<div class='design_plan_list swiper-wrapper one_item'>\n";
    } elseif($total_plan == 2){
      $html .= "<div class='design_plan_list_slider swiper'>\n";
      $html .= "<div class='design_plan_list swiper-wrapper two_item'>\n";
    } else {
      $html .= "<div class='design_plan_list_slider swiper'>\n";
      $html .= "<div class='design_plan_list swiper-wrapper'>\n";
    }

    foreach ( $plan_list as $key => $value ) :

      if($value['headline']){

        if($value['active']){
          $html .= "<div class='list swiper-slide active'>\n";
        } else {
          $html .= "<div class='list swiper-slide'>\n";
        }

        $html .= "<div class='col top'>\n";

        if($value['headline']){
          $html .= "<h4 class='headline'>" . esc_html($value['headline']) . "</h4>\n";
        }

        if($value['num']){
          $html .= "<p class='price'>\n";
          $html .= "<span class='num'>" . $value['num'] . "</span>\n";
          if($value['unit']){
            $html .= "<span class='unit'>" . esc_html($value['unit']) . "</span>\n";
          }
          $html .= "</p>\n";
        } else {
          $html .= "<p class='price'>\n";
          $html .= "<span class='num'>0</span>\n";
          if($value['unit']){
            $html .= "<span class='unit'>" . esc_html($value['unit']) . "</span>\n";
          }
          $html .= "</p>\n";
        }

        if($value['desc']){
          $html .= "<p class='desc'>" . wp_kses_post(nl2br($value['desc'])) . "</p>\n";
        }

        if($value['button'] && $value['url']){
          if($value['target']){
            $html .= "<a class='button' target='_blank' rel='nofollow noopener' href='" . esc_url($value['url']) . "'>" . esc_html($value['button']) . "</a>\n";
          } else {
            $html .= "<a class='button' href='" . esc_url($value['url']) . "'>" . esc_html($value['button']) . "</a>\n";
          }
        }

        $html .= "</div>\n";

        foreach ( $value['item_list'] as $key2 => $value2 ) :

          $html .= "<div class='col row-". $key2."'>\n";

          if($value2['data_left']){
            $html .= "<p class='label'>" . esc_html($value2['data_left']) . "</p>\n";
          }

          if($value2['data_right']){
            $html .= "<p class='num'>" . esc_html($value2['data_right']) . "</p>\n";
          }

          if(!$value2['data_left'] && !$value2['data_right']){
            $html .= "<p class='empty_data'>&nbsp;</p>\n";
          }

          $html .= "</div>\n";

        endforeach;

        $html .= "</div>\n";

      };

    endforeach;

    $html .= "</div>\n";

    $html .= "</div>\n";

    $html .= "<div class='plan_list_button_prev swiper-nav-button swiper-button-prev'></div>\n";
    $html .= "<div class='plan_list_button_next swiper-nav-button swiper-button-next'></div>\n";
    $html .= "<div class='plan_list_scrollbar swiper-scrollbar'></div>\n";

    $html .= "</div>";

  };

	return $html;

}
add_shortcode( 'tcd_price_table', 'sc_tcd_plan_list' );


/**
 * データ一覧ショートコード
 */
function tcd_data_list($atts) {
  global $post;

  $case_study_data_list = get_post_meta($post->ID, 'case_study_data_list', true);

  $html = '';

  if ( $case_study_data_list ) {
    $html .= "<div class='case_study_info_wrap'>\n";
    $html .= "<div class='case_study_info'>\n";
    $html .= "<dl>\n";
    foreach ( $case_study_data_list as $key => $value ) :
      $headline = $value['headline'];
      $content = $value['content'];
      if ( $headline && $content) {
        $html .= '<dt>' . esc_html($headline) . "</dt>\n";
        $html .= '<dd>' . wp_kses_post(nl2br($content)) . "</dd>\n";
      }
    endforeach;
    $html .= "</dl>\n";
    $html .= "</div>\n";
    $html .= "</div>\n";
  }

	return $html;
}
add_shortcode( 'sc_data_list', 'tcd_data_list' );


/**
 * タブコンテンツ
 */
function qt_tab_content($atts) {

  $atts = shortcode_atts( array(
    'tab1' => '',
    'img1' => '',
    'tab2' => '',
    'img2' => '',
  ), $atts );


  $html = '';

  if ( $atts['tab1'] || $atts['tab2']) {

  $html .= "<div class='qt_tab_content_wrap'>\n";

  $html .= "<div class='qt_tab_content_header'>\n";

  if ( $atts['tab1'] ) {
    $html .= '<div class="item active" data-tab-target=".qt_tab_content1">' . esc_html($atts['tab1']) . "</div>\n";
  }
  if ( $atts['tab2'] ) {
    $html .= '<div class="item" data-tab-target=".qt_tab_content2">' . esc_html($atts['tab2']) . "</div>\n";
  }

  $html .= "</div>\n";

  $html .= "<div class='qt_tab_content_main'>\n";

  if ( $atts['img1'] ) {
    $html .= '<div class="qt_tab_content active qt_tab_content1">' . "\n";
    if ( $atts['img1'] ) {
      $html .= '<img src="' . esc_url($atts['img1']) . '" title="" alt="">' . "\n";
      $image_id = attachment_url_to_postid($atts['img1']);
      $image_caption = $image_id ?  get_post($image_id)->post_excerpt : '';
      if ($image_caption) {
        $html .= '<p class="desc">' . wp_kses_post($image_caption) . "</p>\n";
      }
    }
    $html .= "</div>\n";
  }

  if ( $atts['img2'] ) {
    $html .= '<div class="qt_tab_content qt_tab_content2">' . "\n";
    if ( $atts['img2'] ) {
      $html .= '<img src="' . esc_url($atts['img2']) . '" title="" alt="">' . "\n";
      $image_id = attachment_url_to_postid($atts['img2']);
      $image_caption = $image_id ?  get_post($image_id)->post_excerpt : '';
      if ($image_caption) {
        $html .= '<p class="desc">' . wp_kses_post($image_caption) . "</p>\n";
      }
    }
    $html .= "</div>\n";
  }

  $html .= "</div>\n";

  $html .= "</div>\n";

  };

	return $html;
}
add_shortcode( 'tcd_tab', 'qt_tab_content' );


/**
 * データ用ショートコード
 */
function tcd_numeric_data( $atts) {
  global $options;
  if ( ! $options ) $options = get_design_plus_option();

  $atts = shortcode_atts( array(
    'headline' => '',
    'num' => '',
    'unit' => '',
    'desc' => '',
  ), $atts );

  $html = '';

  if ( $atts['num'] ) {

    $rand = rand();

    $html .= "<div class='ac_data'>\n";
    if($atts['headline']){
      $html .= "<h3 class='headline'>" . esc_html($atts['headline']) . "</h3>\n";
    }
    $html .= "<p class='num_area'>";
    if($atts['num'] || $atts['num'] == 0){
      $html .= "<span class='num counter" . esc_attr($rand) . "'>" . number_format($atts['num']) . "</span>";
    }
    if($atts['unit']){
      $html .= "<span class='unit'>" . esc_html($atts['unit']) . "</span>";
    }
    $html .= "</p>\n";
    if($atts['desc']){
      $html .= "<p class='desc'>" . esc_html($atts['desc']) . "</p>\n";
    }
    $html .= "</div>\n";

    if ( function_exists( 'wp_add_inline_script' ) ) {
      $script  = '';
      $script  .= "jQuery(document).ready(function($){\n";
      $script  .= "  $('.counter" . esc_attr($rand) . "').counterUp({\n";
      $script  .= "    delay: 10,\n";
      $script  .= "    time: 1000\n";
      $script  .= "  });\n";
      $script  .= "});\n";
      wp_add_inline_script('counter', $script ,'after');
    }

  }

	return $html;
}
add_shortcode( 'sc_numeric_data', 'tcd_numeric_data' );


?>