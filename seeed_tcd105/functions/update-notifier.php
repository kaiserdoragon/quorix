<?php
/**
 * Provides a notification everytime the theme is updated.
 *
 * @package TCD
 */

define(
	'TCD_UPDATE_NOTIFIER_XML_URL',
	'http://design-plus1.com/notifier_seeed.xml'
);

/**
 * Admin menu.
 *
 * @return void
 */
function tcd_update_notifier_admin_menu() {
	// Get xml.
	$xml = get_tcd_update_notifier_xml();
	if ( ! $xml || empty( $xml->latest ) ) {
		return;
	}

	// Get theme data.
	$theme_data = wp_get_theme();

	// Has newer version.
	if ( version_compare( $theme_data['Version'], $xml->latest, '<' ) ) {
		add_dashboard_page(
			$theme_data['Name'] . ' Theme Updates',
			__( 'Theme Update', 'tcd-seeed' ) . '<span class="update-plugins count-1"><span class="update-count">1</span></span>',
			'administrator',
			'design-plus-updates',
			'tcd_update_notifier_content'
		);
	}
}
add_action( 'admin_menu', 'tcd_update_notifier_admin_menu' );

/**
 * Render the content.
 *
 * @return void
 */
function tcd_update_notifier_content() {
	// Get xml.
	$xml = get_tcd_update_notifier_xml();
	if ( ! $xml || empty( $xml->latest ) ) {
		return;
	}

	// Get theme data.
	$theme_data = wp_get_theme();
	?>
	<style>
	.update-nag {
		display: none;
	}
	.tcd-update-info {
		background: #fff;
		border: 1px solid #ccc;
		border-radius: 5px;
		float: left;
		width: 400px;
		margin: 0 20px 20px 0;
	}
	.tcd-update-info h3 {
		background: #f2f2f2;
		background: linear-gradient(to bottom, #fff, #eee);
		border-bottom: 1px solid #ccc;
		border-radius: 5px 5px 0 0;
		font-size: 14px;
		margin: 0 0 15px 0;
		padding: 15px 15px 12px;
	}
	.tcd-update-info dl {
		font-size: 12px;
		margin: 0 15px 5px 15px;
	}
	.tcd-update-info dt {
		font-weight: 700;
		margin: 0 0 2px 0;
	}
	.tcd-update-info dd {
		margin: 0 0 15px 0;
	}
	.tcd-update-theme-thumbnail {
		border:1px solid #ccc;
		display: block;
		height: auto;
		max-width: 100%;
		width: 600px;
	}
	</style>
	<div class="wrap">
		<div id="icon-tools" class="icon32"></div>
		<h2>
			<?php echo esc_html( $theme_data['Name'] ); ?>
			<?php esc_html_e( 'Theme Update Information', 'tcd-seeed' ); ?>
		</h2>
		<div id="message" class="updated below-h2">
			<p>
				<strong>
					<?php
						printf(
							/* translators: %s: Theme name. */
							esc_html__( 'The latest version of %s is released.', 'tcd-seeed' ),
							esc_html( $theme_data['Name'] )
						);
					?>
				</strong>
				<?php
					printf(
						/* translators: 1: Current version, 2: Latest version. */
						esc_html__( 'Current version is %1$s. You can update to the latest version, %2$s.', 'tcd-seeed' ),
						esc_html( $theme_data['Version'] ),
						esc_html( $xml->latest )
					);
				?>
			</p>
		</div>
		<div class="tcd-update-instructions wp-clearfix">
			<h3><?php esc_html_e( 'Note: Please be sure to backup your theme before you update to the latest version.', 'tcd-seeed' ); ?></h3>
			<p style="font-size:16px;">
				【 <a href="https://tcd.style/login" rel="noopener" target="_blank"><?php esc_html_e( 'Download the latest theme from My Page', 'tcd-seeed' ); ?></a> 】<br>
				<span style="font-size:14px;">
					<?php
						_e( // phpcs:ignore WordPress.Security.EscapeOutput
							'Click <a href="https://tcd-theme.com/2017/01/theme_update.html" rel="noopener" target="_blank">here</a> to find out how to update the theme.',
							'tcd-seeed'
						);
					?>
				</span>
			</p>
			<div class="tcd-update-info">
				<h3><?php esc_html_e( 'Changelog', 'tcd-seeed' ); ?></h3>
				<?php echo $xml->changelog; // phpcs:ignore WordPress.Security.EscapeOutput ?>
			</div>
			<img class="tcd-update-theme-thumbnail" src="<?php echo esc_url( (string) $theme_data->get_screenshot() ); ?>" alt="">
		</div>
	</div>
	<?php
}

/**
 * Get the remote xml file.
 *
 * @return SimpleXMLElement|false
 */
function get_tcd_update_notifier_xml() {
	if ( ! defined( 'TCD_UPDATE_NOTIFIER_XML_URL' ) ) {
		return;
	}

	// Load cache.
	$cache_key  = 'tcd_notifier_' . md5( TCD_UPDATE_NOTIFIER_XML_URL );
	$cache_data = get_transient( $cache_key );

	// No cache or expired.
	if ( false === $cache_data ) {
		// Get remote xml.
		$response = wp_safe_remote_get( TCD_UPDATE_NOTIFIER_XML_URL );

		if (
			! is_wp_error( $response ) &&
			! empty( $response['response']['code'] ) &&
			200 === $response['response']['code'] &&
			! empty( $response['body'] )
		) {
			$cache_data = $response['body'];
		} else {
			$cache_data = null;
		}

		// Save cache.
		set_transient( $cache_key, $cache_data, HOUR_IN_SECONDS * 6 );
	}

	if ( $cache_data ) {
		$xml = simplexml_load_string( $cache_data );
		return $xml;
	}

	return false;
}
