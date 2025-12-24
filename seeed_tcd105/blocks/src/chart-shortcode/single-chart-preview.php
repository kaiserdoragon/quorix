<?php
/**
 * ブロックプレビュー用のHTMLを返すように設定します
 */

wp_enqueue_style( 'style', get_stylesheet_uri(), array(), version_num() );
wp_enqueue_style( 'responsive', get_template_directory_uri() . '/css/responsive.css', array(), version_num() );
?>
<!DOCTYPE html>
<html class="pc" <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<?php wp_head(); ?>
</head>
<style>
html, body, #chart_check { margin: 0 !important; padding: 0 !important; }
</style>
<body id="body" <?php body_class(); ?>>
<div id="chart_check">
<div class="post_content clearfix">
<?php echo do_shortcode( '[tcd_chart id="' . $post->ID . '"]' ); ?>
</div>
</div>
<?php wp_footer(); ?>
</body>
</html>
