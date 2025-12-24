<?php
/*
 * オプションの設定
 */

//フォントの縦方向
global $font_direction_options;
$font_direction_options = array(
  'type1' => array('value' => 'type1','label' => __( 'Horizontal', 'tcd-seeed' )),
  'type2' => array('value' => 'type2','label' => __( 'Vertical', 'tcd-seeed' )),
);


// コンテンツの方向
global $content_direction_options;
$content_direction_options = array(
 'type1' => array('value' => 'type1', 'label' => __( 'Align left', 'tcd-seeed' )),
 'type2' => array('value' => 'type2', 'label' => __( 'Align center', 'tcd-seeed' )),
 'type3' => array('value' => 'type3', 'label' => __( 'Align right', 'tcd-seeed' ))
);


// コンテンツの方向（縦方向）
global $content_direction_options2;
$content_direction_options2 = array(
 'type1' => array('value' => 'type1', 'label' => __( 'Align top', 'tcd-seeed' )),
 'type2' => array('value' => 'type2', 'label' => __( 'Align middle', 'tcd-seeed' )),
 'type3' => array('value' => 'type3', 'label' => __( 'Align bottom', 'tcd-seeed' ))
);


// hover effect
global $hover_type_options;
$hover_type_options = array(
  'type1' => array('value' => 'type1','label' => __( 'Zoom in', 'tcd-seeed' )),
  'type2' => array('value' => 'type2','label' => __( 'Zoom out', 'tcd-seeed' )),
  'type3' => array('value' => 'type3','label' => __( 'Slide', 'tcd-seeed' )),
  'type4' => array('value' => 'type4','label' => __( 'Fade', 'tcd-seeed' )),
  'type5' => array('value' => 'type5','label' => __( 'No animation', 'tcd-seeed' ))
);
global $hover3_direct_options;
$hover3_direct_options = array(
  'type2' => array('value' => 'type2','label' => __( 'Right to Left', 'tcd-seeed' )),
  'type1' => array('value' => 'type1','label' => __( 'Left to Right', 'tcd-seeed' )),
);


//フォントタイプ
global $font_type_options;
$font_type_options = array(
  'type1' => array('value' => 'type1','label' => __( 'Meiryo', 'tcd-seeed' ),'label_en' => 'Arial'),
  'type2' => array('value' => 'type2','label' => __( 'YuGothic', 'tcd-seeed' ),'label_en' => 'San Serif'),
  'type3' => array('value' => 'type3','label' => __( 'YuMincho', 'tcd-seeed' ),'label_en' => 'Times New Roman')
);


// ソーシャルボタンの設定
global $sns_type_options;
$sns_type_options = array(
  'type1' => array( 'value' => 'type1', 'label' => __( 'Type1 (color)', 'tcd-seeed' ), 'img' => 'share_type1.jpg'),
  'type2' => array( 'value' => 'type2', 'label' => __( 'Type2 (mono)', 'tcd-seeed' ), 'img' => 'share_type2.jpg'),
  'type3' => array( 'value' => 'type3', 'label' => __( 'Type3 (4 column - color)', 'tcd-seeed' ), 'img' => 'share_type3.jpg'),
  'type4' => array( 'value' => 'type4', 'label' => __( 'Type4 (4 column - mono)', 'tcd-seeed' ), 'img' => 'share_type4.jpg'),
  'type5' => array( 'value' => 'type5', 'label' => __( 'Type5 (official design)', 'tcd-seeed' ), 'img' => 'share_type5.jpg')
);


// ロゴに画像を使うか否か
global $logo_type_options;
$logo_type_options = array(
  'type1' => array(
    'value' => 'type1',
    'label' => __( 'Use text for logo', 'tcd-seeed' ),
    'image' => get_template_directory_uri() . '/admin/img/header_logo_type1.gif'
  ),
  'type2' => array(
    'value' => 'type2',
    'label' => __( 'Use image for logo', 'tcd-seeed' ),
    'image' => get_template_directory_uri() . '/admin/img/header_logo_type2.gif'
  )
);


// Google Maps
global $gmap_marker_type_options;
$gmap_marker_type_options = array(
  'type1' => array( 'value' => 'type1', 'label' => __( 'Use default marker', 'tcd-seeed' ), 'img' => 'gmap_marker_type1.jpg'),
  'type2' => array( 'value' => 'type2', 'label' => __( 'Use custom marker', 'tcd-seeed' ), 'img' => 'gmap_marker_type2.jpg' )
);
global $gmap_custom_marker_type_options;
$gmap_custom_marker_type_options = array(
  'type1' => array( 'value' => 'type1', 'label' => __( 'Text', 'tcd-seeed' ) ),
  'type2' => array( 'value' => 'type2', 'label' => __( 'Image', 'tcd-seeed' ) )
);


// アイテムのタイプ
global $item_type_options;
$item_type_options = array(
  'type1' => array('value' => 'type1','label' => __( 'Image', 'tcd-seeed' )),
  'type2' => array('value' => 'type2','label' => __( 'Video', 'tcd-seeed' )),
  'type3' => array('value' => 'type3','label' => __( 'Youtube', 'tcd-seeed' )),
);


// スライダーのコンテンツタイプ
global $index_slider_content_type_options;
$index_slider_content_type_options = array(
  'type1' => array('value' => 'type1','label' => __( 'Same as PC setting', 'tcd-seeed' )),
  'type2' => array('value' => 'type2','label' => __( 'Display diffrent content in mobile size', 'tcd-seeed' )),
);


// 表示設定
global $basic_display_options;
$basic_display_options = array(
	'display' => array(
		'value' => 'display',
		'label' => __( 'Display', 'tcd-seeed' ),
	),
	'hide' => array(
		'value' => 'hide',
		'label' => __( 'Hide', 'tcd-seeed' ),
	)
);


// 表示設定
global $single_page_display_options;
$single_page_display_options = array(
	'top' => array(
		'value' => 'top',
		'label' => __( 'Above post', 'tcd-seeed' ),
	),
	'bottom' => array(
		'value' => 'bottom',
		'label' => __( 'Under post', 'tcd-seeed' ),
	),
	'both' => array(
		'value' => 'both',
		'label' => __( 'Both above and bottom', 'tcd-seeed' ),
	),
	'hide' => array(
		'value' => 'hide',
		'label' => __( 'Hide', 'tcd-seeed' ),
	),
);


// クイックタグ関連 -------------------------------------------------------------------------------------------


// テキストの方向（クイックタグで利用中）
global $text_align_options;
$text_align_options = array(
 'left' => array('value' => 'left', 'label' => __( 'Align left', 'tcd-seeed' )),
 'center' => array('value' => 'center', 'label' => __( 'Align center', 'tcd-seeed' )),
);


// 見出し
global $font_weight_options;
$font_weight_options = array(
	'400' => array('value' => '400','label' => __( 'Normal', 'tcd-seeed' )),
	'600' => array('value' => '600','label' => __( 'Bold', 'tcd-seeed' ))
);
global $border_potition_options;
$border_potition_options = array(
	'left' => array('value' => 'left','label' => __( 'Left', 'tcd-seeed' )),
	'top' => array('value' => 'top','label' => __( 'Top', 'tcd-seeed' )),
	'bottom' => array('value' => 'bottom','label' => __( 'Bottom', 'tcd-seeed' )),
	'right' => array('value' => 'right','label' => __( 'Right', 'tcd-seeed' ))
);
global $border_style_options;
$border_style_options = array(
	'solid' => array('value' => 'solid','label' => __( 'Solid line', 'tcd-seeed' )),
	'dotted' => array('value' => 'dotted','label' => __( 'Dot line', 'tcd-seeed' )),
	'double' => array('value' => 'double','label' => __( 'Double line', 'tcd-seeed' ))
);


// ボタン
global $button_type_options;
$button_type_options = array(
	'type1' => array('value' => 'type1','label' => __( 'Normal', 'tcd-seeed' )),
	'type2' => array('value' => 'type2','label' => __( 'Ghost', 'tcd-seeed' )),
	'type3' => array('value' => 'type3','label' => __( 'Reverse', 'tcd-seeed' ))
);
global $button_border_radius_options;
$button_border_radius_options = array(
	'flat' => array('value' => 'flat','label' => __( 'Square', 'tcd-seeed' )),
	'rounded' => array('value' => 'rounded','label' => __( 'Rounded', 'tcd-seeed' )),
	'oval' => array('value' => 'oval','label' => __( 'Pill', 'tcd-seeed' ))
);
global $button_size_options;
$button_size_options = array(
	'small' => array('value' => 'small','label' => __( 'Small', 'tcd-seeed' )),
	'medium' => array('value' => 'medium','label' => __( 'Medium', 'tcd-seeed' )),
	'large' => array('value' => 'large','label' => __( 'Large', 'tcd-seeed' ))
);
global $button_animation_options;
$button_animation_options = array(
	'animation_type1' => array('value' => 'animation_type1','label' => __( 'Fade', 'tcd-seeed' )),
	'animation_type2' => array('value' => 'animation_type2','label' => __( 'Swipe', 'tcd-seeed' )),
	'animation_type3' => array('value' => 'animation_type3','label' => __( 'Diagonal swipe', 'tcd-seeed' ))
);


// 囲み枠
global $flame_border_radius_options;
$flame_border_radius_options = array(
	'0' => array('value' => '0','label' => __( 'Square', 'tcd-seeed' )),
	'10' => array('value' => '10','label' => __( 'Rounded', 'tcd-seeed' ))
);


// アンダーライン
global $bool_options;
$bool_options = array(
	'yes' => array('value' => 'yes','label' => __( 'Yes', 'tcd-seeed' )),
	'no' => array('value' => 'no','label' => __( 'No', 'tcd-seeed' ))
);


// Google Map
global $google_map_design_options;
$google_map_design_options = array(
	'default' => array('value' => 'default','label' => __( 'Default', 'tcd-seeed' )),
	'monochrome' => array('value' => 'monochrome','label' => __( 'Monochrome', 'tcd-seeed' ))
);
global $google_map_marker_options;
$google_map_marker_options = array(
	'type1' => array('value' => 'type1','label' => __( 'Default', 'tcd-seeed' )),
	'type2' => array('value' => 'type2','label' => __( 'Text', 'tcd-seeed' )),
	'type3' => array('value' => 'type3','label' => __( 'Image', 'tcd-seeed' ))
);



// ロード画面関連 -------------------------------------------------------------------------------------------


// ロードアイコンの表示時間
global $time_options;
$time_options = array(
  '1000' => array('value' => '1000','label' => sprintf(__('%s second', 'tcd-seeed'), 1)),
  '2000' => array('value' => '2000','label' => sprintf(__('%s second', 'tcd-seeed'), 2)),
  '3000' => array('value' => '3000','label' => sprintf(__('%s second', 'tcd-seeed'), 3)),
  '4000' => array('value' => '4000','label' => sprintf(__('%s second', 'tcd-seeed'), 4)),
  '5000' => array('value' => '5000','label' => sprintf(__('%s second', 'tcd-seeed'), 5)),
);


// ローディングアイコンの種類の設定
global $loading_type;
$loading_type = array(
	'type1' => array(
		'value' => 'type1',
		'label' => __( 'Circle', 'tcd-seeed' ),
		'image' => get_template_directory_uri() . '/admin/img/load_smaple.jpg'
	),
	'type2' => array(
		'value' => 'type2',
		'label' => __( 'Square', 'tcd-seeed' ),
		'image' => get_template_directory_uri() . '/admin/img/load_smaple.jpg'
	),
	'type3' => array(
		'value' => 'type3',
		'label' => __( 'Dot circle', 'tcd-seeed' ),
		'image' => get_template_directory_uri() . '/admin/img/load_smaple.jpg'
	),
	'type4' => array(
		'value' => 'type4',
		'label' => __( 'Logo', 'tcd-seeed' ),
		'image' => get_template_directory_uri() . '/admin/img/load_smaple.jpg'
	),
	'type5' => array(
		'value' => 'type5',
		'label' => __( 'Catchphrase', 'tcd-seeed' ),
		'image' => get_template_directory_uri() . '/admin/img/load_smaple.jpg'
	)
);


global $loading_display_page_options;
$loading_display_page_options = array(
 'type1' => array('value' => 'type1','label' => __( 'Front page', 'tcd-seeed' )),
 'type2' => array('value' => 'type2','label' => __( 'All pages', 'tcd-seeed' ))
);


global $loading_display_time_options;
$loading_display_time_options = array(
 'type1' => array('value' => 'type1','label' => __( 'Only once', 'tcd-seeed' )),
 'type2' => array('value' => 'type2','label' => __( 'Every time', 'tcd-seeed' ))
);


global $loading_animation_type_options;
$loading_animation_type_options = array(
  'type1' => array('value' => 'type1','label' => __( 'Fade', 'tcd-seeed' )),
  'type2' => array('value' => 'type2','label' => __( 'Float', 'tcd-seeed' )),
  'type3' => array('value' => 'type3','label' => sprintf( __( 'Slides(%s)', 'tcd-seeed' ), '&#x2192;' ) ),
  'type4' => array('value' => 'type4','label' => sprintf( __( 'Slides(%s)', 'tcd-seeed' ), '&#x2191;' ) ),
);


// フッター関連 -------------------------------------------------------------------------------------------
global $footer_bar_type_options;
$footer_bar_type_options = array(
	'type1' => array(
		'value' => 'type1',
		'label' => __( 'Hide', 'tcd-seeed' ),
		'image' => get_template_directory_uri() . '/admin/img/footer_bar_type1.jpg'
	),
	'type2' => array(
		'value' => 'type2',
		'label' => __( 'Button with icon (Dark color)', 'tcd-seeed' ),
		'image' => get_template_directory_uri() . '/admin/img/footer_bar_type2.jpg'
	),
	'type3' => array(
		'value' => 'type3',
		'label' => __( 'Button with icon (Light color)', 'tcd-seeed' ),
		'image' => get_template_directory_uri() . '/admin/img/footer_bar_type3.jpg'
	),
	'type4' => array(
		'value' => 'type4',
		'label' => __( 'Button without icon', 'tcd-seeed' ),
		'image' => get_template_directory_uri() . '/admin/img/footer_bar_type4.jpg'
	)
);


// フッターの固定メニュー ボタンのタイプ
global $footer_bar_button_options;
$footer_bar_button_options = array(
  'type1' => array('value' => 'type1', 'label' => __( 'Default', 'tcd-seeed' )),
  'type2' => array('value' => 'type2', 'label' => __( 'Share', 'tcd-seeed' )),
  'type3' => array('value' => 'type3', 'label' => __( 'Telephone', 'tcd-seeed' ))
);

// フッターの固定メニューのアイコン
global $footer_bar_icon_options;
$footer_bar_icon_options = array(
  // ブログ
	'e80d' =>  array( 'type' => 'google', 'label' => 'Share' ), // シェア
	'e8dc' =>  array( 'type' => 'google', 'label' => 'Thumb Up' ), // いいね
	// 汎用
	'e5d2' =>  array( 'type' => 'google', 'label' => 'Menu' ), // メニュー
	'e5ca' =>  array( 'type' => 'google', 'label' => 'Check' ), // チェック
	'e838' =>  array( 'type' => 'google', 'label' => 'Star' ), // スター
	'e87d' =>  array( 'type' => 'google', 'label' => 'Favorite' ), // ハート
	'eafb' =>  array( 'type' => 'google', 'label' => 'Currency Yen' ), // 円
	'e894' =>  array( 'type' => 'google', 'label' => 'Language' ), // 言語
	'e7fd' =>  array( 'type' => 'google', 'label' => 'Person' ), // ユーザー
	'ebcc' =>  array( 'type' => 'google', 'label' => 'Calendar Month' ), // カレンダー
	'e8b5' =>  array( 'type' => 'google', 'label' => 'Schedule' ), // スケジュール
	'e0f0' =>  array( 'type' => 'google', 'label' => 'Lightbulb' ), // ヒント
	'e158' =>  array( 'type' => 'google', 'label' => 'Mail' ), // メール
	'e7f4' =>  array( 'type' => 'google', 'label' => 'Notifications' ), // おしらせ
	'e0b0' =>  array( 'type' => 'google', 'label' => 'Call' ), // 電話
	'e0b7' =>  array( 'type' => 'google', 'label' => 'Chat' ), // チャット
	'e3c9' =>  array( 'type' => 'google', 'label' => 'Edit' ), // 執筆
	'e413' =>  array( 'type' => 'google', 'label' => 'Photo Library' ), // ギャラリー
	'e873' =>  array( 'type' => 'google', 'label' => 'Description' ), // ノート
	'f0e2' =>  array( 'type' => 'google', 'label' => 'Support Agent' ), // ヘッドフォン
	'e869' =>  array( 'type' => 'google', 'label' => 'Build' ), // 修理
	'e80b' =>  array( 'type' => 'google', 'label' => 'Public' ), // 地球
	// 食事
	'e88a' =>  array( 'type' => 'google', 'label' => 'Home' ), // Home
	'e56c' =>  array( 'type' => 'google', 'label' => 'Restaurant' ), // レストラン
	'ea61' =>  array( 'type' => 'google', 'label' => 'Lunch Dining' ), // ランチ
	'ea64' =>  array( 'type' => 'google', 'label' => 'Ramen Dining' ), // 麺類
	'e541' =>  array( 'type' => 'google', 'label' => 'Local Cafe' ), // カフェ
	'e91d' =>  array( 'type' => 'google', 'label' => 'Pets' ), // ペット	
  // アクセス
	'e55b' =>  array( 'type' => 'google', 'label' => 'Map' ), // マップ
	'e0c8' =>  array( 'type' => 'google', 'label' => 'Location On' ), // マップアイコン
	'e539' =>  array( 'type' => 'google', 'label' => 'Flight' ), // 飛行機
	'e532' =>  array( 'type' => 'google', 'label' => 'Directions Boat' ), // 船
	'e570' =>  array( 'type' => 'google', 'label' => 'Train' ), // 電車
	'e531' =>  array( 'type' => 'google', 'label' => 'Directions Car' ), // 車
	'eb29' =>  array( 'type' => 'google', 'label' => 'Pedal Bike' ), // 自転車
	'e536' =>  array( 'type' => 'google', 'label' => 'Directions Walk' ), // 徒歩
	// SNS
	'ea92' =>  array( 'type' => 'sns', 'label' => 'Instagram' ), // Instagram
	'e94d' =>  array( 'type' => 'sns', 'label' => 'TikTok' ), // TikTok
	'e950' =>  array( 'type' => 'sns', 'label' => 'Twitter' ), // Twitter
	'e944' =>  array( 'type' => 'sns', 'label' => 'Facebook' ), // Facebook
	'ea9d' =>  array( 'type' => 'sns', 'label' => 'YouTube' ), // YouTube
	'e909' =>  array( 'type' => 'sns', 'label' => 'Line' ), // Line
);


// 新規追加 -------------------------------------------------------------------------------------------


// カラープリセット
define( 'TCD_COLOR_PRESET', array(
	__('Blue', 'tcd-seeed') => array(
		'main' => '#0085B2',
		'bg' => '#fafafa'
	),
	__('Orange', 'tcd-seeed') => array(
		'main' => '#FF5C26',
		'bg' => '#fafafa'
	),
	__('Red', 'tcd-seeed') => array(
		'main' => '#D90000',
		'bg' => '#fafafa'
	),
	__('Green', 'tcd-seeed') => array(
		'main' => '#00B200',
		'bg' => '#fafafa'
	),
	__('Dark blue', 'tcd-seeed') => array(
		'main' => '#0059B2',
		'bg' => '#fafafa'
	)
) );


// ツイッターのサムネイルサイズ
$twitter_image_options = array(
	'summary' => array('value' => 'summary','label' => __( 'Normal', 'tcd-seeed' )),
	'summary_large_image' => array('value' => 'summary_large_image','label' => __( 'Largish', 'tcd-seeed' ))
);


// サービス記事一覧タイプ
global $service_list_type_options;
$service_list_type_options = array(
  'type1' => array(
    'value' => 'type1',
    'label' => __( 'TypeA<br><span style="font-size:12px;">(Click icon to scroll)</span>', 'tcd-seeed' ),
    'image' => get_template_directory_uri() . '/admin/img/service_post_list_type1.jpg'
  ),
  'type2' => array(
    'value' => 'type2',
    'label' => __( 'TypeB<br><span style="font-size:12px;">(Click icon to scroll)</span>', 'tcd-seeed' ),
    'image' => get_template_directory_uri() . '/admin/img/service_post_list_type2.jpg'
  ),
  'type3' => array(
    'value' => 'type3',
    'label' => __( 'TypeC<br><span style="font-size:12px;">(Click icon to link to corresponding article page)</span>', 'tcd-seeed' ),
    'image' => get_template_directory_uri() . '/admin/img/service_post_list_type3.jpg'
  ),
  'type4' => array(
    'value' => 'type4',
    'label' => __( 'TypeD<br><span style="font-size:12px;">(List without icons)</span>', 'tcd-seeed' ),
    'image' => get_template_directory_uri() . '/admin/img/service_post_list_type4.jpg'
  ),
);


// サービスカテゴリー一覧タイプ
global $service_icon_list_type_options;
$service_icon_list_type_options = array(
  'type1' => array(
    'value' => 'type1',
    'label' => __( 'Large size', 'tcd-seeed' ),
    'image' => get_template_directory_uri() . '/admin/img/service_icon_list_type1.jpg'
  ),
  'type2' => array(
    'value' => 'type2',
    'label' => __( 'Small size', 'tcd-seeed' ),
    'image' => get_template_directory_uri() . '/admin/img/service_icon_list_type2.jpg'
  ),
);


// ヘッダータイプ
global $header_type_options;
$header_type_options = array(
  'type1' => array(
    'value' => 'type1',
    'label' => __( 'Type1', 'tcd-seeed' ),
    'image' => get_template_directory_uri() . '/admin/img/header_type1.jpg'
  ),
  'type2' => array(
    'value' => 'type2',
    'label' => __( 'Type2', 'tcd-seeed' ),
    'image' => get_template_directory_uri() . '/admin/img/header_type2.jpg'
  )
);


// リスト用　カラープリセット
define( 'TCD_COLOR_PRESET_FOR_LIST', array(
	'color1' => array(
		'main' => '#eeeeee',
	),
	'color2' => array(
		'main' => '#63A9D7',
	),
	'color3' => array(
		'main' => '#8F92E0',
	),
	'color4' => array(
		'main' => '#2CAEB3',
	),
	'color5' => array(
		'main' => '#F99643',
	),
	'color6' => array(
		'main' => '#F6909C',
	)
) );

?>