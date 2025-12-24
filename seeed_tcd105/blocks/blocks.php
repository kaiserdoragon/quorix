<?php

/**
 * Register block category
 */
function add_tcd_block_category( $block_categories, $editor_context ) {
	if ( ! empty( $editor_context->post ) ) {
		array_unshift(
			$block_categories,
			array(
				'slug'  => 'tcd',
				'title' => __( 'TCD', 'tcd-seeed' ),
				'icon'  => null,
			)
		);
	}
	return $block_categories;
}
add_filter( 'block_categories_all', 'add_tcd_block_category', 10, 2 );

/**
 * Include blocks for current theme
 */
get_template_part( 'blocks/build/chart-shortcode/block' );
