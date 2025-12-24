<?php

/**
 * Register block
 * カスタムブロックカテゴリー及び$postを使っているのでinitフックだと動作しない
 */
function tcd_register_block_type_chart_shortcode() {
	global $post;

	// detect singular
	if ( is_admin() ) {
		// detect post type
		if ( ! $post || 'chart' === $post->post_type ) {
			return;
		}
	} elseif ( ! is_singular() ) {
		return;
	}

	// Chioses.js
	wp_enqueue_script( 'choices', get_template_directory_uri() . '/admin/js/choices.min.js', array(), '10.0.0', true );
	wp_enqueue_style( 'choices', get_template_directory_uri() . '/admin/css/choices.min.css', array(), '10.0.0' );

	// block
	$block_handle  = basename( __DIR__ );
	$block_dir     = get_template_directory() . '/blocks/build/' . $block_handle;
	$block_dir_uri = get_template_directory_uri() . '/blocks/build/' . $block_handle;
	$lang_dir      = get_template_directory() . '/languages';

	// editor script
	$index_asset = include $block_dir . '/editor.asset.php';
	wp_register_script(
		'tcd-block-' . $block_handle . '-editor',
		$block_dir_uri . '/editor.js',
		$index_asset['dependencies'],
		$index_asset['version'],
		true
	);
	wp_set_script_translations( 'tcd-block-' . $block_handle . '-editor', 'tcd-seeed', $lang_dir );
	wp_localize_script( 'tcd-block-' . $block_handle . '-editor', 'TcdEditorChart', tcd_chart_scripts_data( true ) );

	// editor style
	wp_register_style(
		'tcd-block-' . $block_handle . '-editor',
		$block_dir_uri . '/editor.css',
		array( 'choices' ),
		filemtime( $block_dir . '/editor.css' )
	);

	// registger block type
	register_block_type_from_metadata(
		__DIR__,
		! empty( $GLOBALS['wp_version'] ) && version_compare( $GLOBALS['wp_version'], '6.5', '>=' )
			? array(
				'editorScript' => 'tcd-block-' . $block_handle . '-editor',
				'editorStyle'  => 'tcd-block-' . $block_handle . '-editor',
			)
			: array(
				'editor_script' => 'tcd-block-' . $block_handle . '-editor',
				'editor_style'  => 'tcd-block-' . $block_handle . '-editor',
			)
	);
}
add_action( 'enqueue_block_editor_assets', 'tcd_register_block_type_chart_shortcode' );

/**
 * ブロックエディター内プレビュー用
 */
function tcd_block_chart_preview_wp() {
	// ブロックエディター内プレビュー判別 exampleプレビュー含む
	if (
		! empty( $_GET['tcd-block-chart-preview'] ) &&
		( is_singular( 'chart' ) || 'example' === $_GET['tcd-block-chart-preview'] ) &
		( current_user_can( 'edit_posts' ) || current_user_can( 'edit_pages' ) )
	) {
		// アドミンバー非表示
		add_filter( 'show_admin_bar', '__return_false' );

		// redirect_canonicalを無効にする
		remove_action( 'template_redirect', 'redirect_canonical' );

		// テンプレート変更アクション
		add_action( 'template_include', 'tcd_block_chart_preview_template_include', 9999 );
	}
}
function tcd_block_chart_preview_template_include( $template ) {
	if ( ! empty( $_GET['tcd-block-chart-preview'] ) && 'example' === $_GET['tcd-block-chart-preview'] ) {
		// ブロックエディター exampleプレビュー用テンプレートパス
		$chart_block_preview_template = __DIR__ . DIRECTORY_SEPARATOR . 'example.php';
	} else {
		// ブロックエディター内プレビュー用テンプレートパス
		$chart_block_preview_template = __DIR__ . DIRECTORY_SEPARATOR . 'single-chart-preview.php';
	}
	if ( file_exists( $chart_block_preview_template ) ) {
		return $chart_block_preview_template;
	}

	return $template;
}
add_action( 'wp', 'tcd_block_chart_preview_wp' );
