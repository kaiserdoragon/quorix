<?php

/**
 * TinyMCE チャートプラグイン js,css,フック
 */
function tcd_chart_admin_enqueue_scripts() {
	$current_screen = get_current_screen();

	// 記事編集画面 チャート投稿タイプ以外
	if ( 'post' === $current_screen->base && 'chart' !== $current_screen->id ) {
		// TinyMCE時
		if ( ! $current_screen->is_block_editor && user_can_richedit() ) {
			// chioses
			wp_enqueue_script( 'choices', get_template_directory_uri() . '/admin/js/choices.min.js', array(), '10.0.0', true );
			wp_enqueue_style( 'choices', get_template_directory_uri() . '/admin/css/choices.min.css', array(), '10.0.0' );

			// TinyMCE チャートプラグイン
			wp_enqueue_style( 'tcd-mce-chart', get_template_directory_uri() . '/admin/css/mce-chart.css', array(), version_num() );
			add_filter( 'mce_external_plugins', 'tcd_chart_mce_external_plugins', 11 );
			add_filter( 'mce_buttons', 'tcd_chart_mce_buttons', 11 );
			add_action( 'admin_print_footer_scripts', 'tcd_chart_mce_admin_print_footer_scripts' );
		}
	}
}
add_action( 'admin_enqueue_scripts', 'tcd_chart_admin_enqueue_scripts' );

/**
 * TinyMCE チャートプラグイン追加
 */
function tcd_chart_mce_external_plugins( $plugins ) {
	$plugins['tcd-chart'] = add_query_arg( 'ver', version_num(), get_template_directory_uri() . '/admin/js/mce-chart.js' );
	return $plugins;
}

/**
 * TinyMCE チャートボタン追加
 */
function tcd_chart_mce_buttons( $buttons ) {
	$buttons[] = 'tcd-chart';
	return $buttons;
}

/**
 * TinyMCE チャートプラグイン用データ
 */
function tcd_chart_mce_admin_print_footer_scripts() {
	echo "<script>var TcdEditorChart = " . json_encode( tcd_chart_scripts_data() ) . ";</script>\n";
}

/**
 * Choices.js用翻訳などの配列を返す
 */
function tcd_chart_scripts_data( $is_block_editor = false ) {
	$a = array(
		'button_title' => __( 'Insert chart shrtcode', 'tcd-seeed' ),
		'modal_title' => __( 'Select chart', 'tcd-seeed' ),
		'choices' => array(
			'loadingText' => __( 'Loading...', 'tcd-seeed' ),
			'placeholderValue' => __( '-- Select chart --', 'tcd-seeed' ),
			'searchPlaceholderValue' => __( 'Search...', 'tcd-seeed' ),
			'noChoicesText' => __( 'Chart not found', 'tcd-seeed' ),
			'noResultsText' => __( 'No results found', 'tcd-seeed' )
		)
	);

	if ( $is_block_editor ) {
		$a['block_preview_url'] = add_query_arg( array(
			'p' => '%ID%',
			'post_type' => 'chart',
			'tcd-block-chart-preview' => true
		), home_url( '/' ) );
		$a['block_example_preview_url'] = add_query_arg( array(
			'tcd-block-chart-preview' => 'example'
		), home_url( '/' ) );
	}

	return $a;
}

/**
 * Choice表示用チャートリスト取得Ajax
 */
function tcd_chart_mce_get_chart_list_ajax() {

	$list = array();

	// 選択値
	$selected = null;
	if ( ! empty( $_REQUEST['selected'] ) ) {
		$selected = intval( $_REQUEST['selected'] );
	}

	// チャート取得
	$chart_query = new WP_Query( array(
		'post_type' => 'chart',
		'posts_per_page' => -1,
		'post_status' => 'publish'
	) );

	if ( $chart_query->have_posts() ) {
		foreach( $chart_query->posts as $chart_post ) {
			$a = array(
				'label' => mb_strimwidth( esc_html( $chart_post->post_title ), 0, 300, '…' ),
				'value' => $chart_post->ID
			);
			if ( $chart_post->ID === $selected ) {
				$a['selected'] = true;
			}
			$list[] = $a;
		}
	} else {
		$list[] = array(
			'label' => __( 'Chart not found', 'tcd-seeed' ),
			'value' => '',
			'selected' => true
		);
	}

	// JSON出力
	wp_send_json( $list );
	exit;
}
add_action( 'wp_ajax_tcd-get-chart-list', 'tcd_chart_mce_get_chart_list_ajax' );
