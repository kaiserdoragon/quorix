<?php

/**
 * ギャラリー画像編集 js and css
 */
function tcd_image_editor_enqueue_script() {
	global $pagenow, $typenow;

	if ( $typenow !== 'gallery' && ! in_array( $pagenow, array( 'post.php', 'post-new.php' ), true ) ) {
		return;
	}

	wp_enqueue_script( 'caman', get_template_directory_uri() . '/admin/js/caman.full.pack.js', array(), version_num() );
	wp_enqueue_style( 'tcd-image-editor', get_template_directory_uri() . '/admin/css/image-editor.css', array(), version_num() );
	wp_enqueue_script( 'tcd-image-editor', get_template_directory_uri() . '/admin/js/image-editor.js', array( 'jquery' ), version_num() );
	wp_localize_script(
		'tcd-image-editor',
		'TCD_IMAGE_EDITOR',
		array(
			'ajax_error_message' => __( 'Error was occurred. Please retry again.', 'tcd-seeed' ),
			'saving'             => __( 'Saving', 'tcd-seeed' ),
			'restoring'          => __( 'Restoring', 'tcd-seeed' ),
		)
	);
}
add_action( 'admin_enqueue_scripts', 'tcd_image_editor_enqueue_script' );

/**
 * モーダルhtml出力
 */
function render_tcd_image_editor_modal() {
	global $pagenow, $typenow;

	if ( $typenow !== 'gallery' && ! in_array( $pagenow, array( 'post.php', 'post-new.php' ), true ) ) {
		return;
	}
	?>
<div id="tcd-image-editor" class="tcd-image-editor">
	<div tabindex="0" class="media-modal wp-core-ui">
		<button type="button" class="media-modal-close"><span class="media-modal-icon"><span class="screen-reader-text"><?php _e( 'Close media panel', 'tcd-seeed' ); ?></span></span></button>
		<div class="media-modal-content">
			<div class="media-frame wp-core-ui hide-menu hide-router">
				<div class="media-frame-menu"></div>
				<div class="media-frame-title"><h1><?php _e( 'Image Edit', 'tcd-seeed' ); ?></h1></div>
				<div class="media-frame-router"></div>
				<div class="media-frame-content"></div>
				<div class="media-frame-toolbar">
					<div class="media-toolbar">
						<div class="media-toolbar-secondary">
							<div class="media-toolbar-messege"></div>
						</div>
						<div class="media-toolbar-primary">
							<button type="button" class="button media-button button-primary button-large media-button-save" disabled="disabled"><?php _e( 'Save Image', 'tcd-seeed' ); ?></button>
							<span class="spinner"></span>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="tcd-image-editor__loading"><span class="spinner"></span></div>
	</div>
	<div class="media-modal-backdrop"></div>
</div>
	<?php
}
add_action( 'admin_footer', 'render_tcd_image_editor_modal' );

/**
 * ajax処理
 */
function tcd_image_editor_ajax() {
	$json = array(
		'success' => false,
	);

	if ( ! isset( $_POST['post_id'], $_POST['media_id'], $_POST['_ajax_nonce'], $_POST['do'] ) ) {
		$json['message'] = __( 'Invalid request.', 'tcd-seeed' );
	} else {
		$post_id  = intval( $_POST['post_id'] );
		$media_id = intval( $_POST['media_id'] );
		$post     = get_post( $post_id );
		$image    = wp_get_attachment_image_src( $media_id, 'full' );

		if ( empty( $post->post_type ) ) {
			$json['message'] = __( 'Invalid post id.', 'tcd-seeed' );
		} elseif ( ! current_user_can( 'edit_post', $post_id ) ) {
			$json['message'] = __( 'You do not have permission to edit this post.', 'tcd-seeed' );
		} elseif ( ! $image ) {
			$json['message'] = __( 'Invalid media id.', 'tcd-seeed' );
		} elseif ( ! current_user_can( 'edit_post', $media_id ) ) {
			$json['message'] = __( 'You do not have permission to edit this image.', 'tcd-seeed' );
		} elseif ( 'open' === $_POST['do'] ) {
			// エディター表示

			if ( ! check_ajax_referer( 'tcd-image-edit-' . $post_id, '_ajax_nonce', false ) ) {
				$json['message'] = __( 'Invalid nonce.', 'tcd-seeed' );
			} else {
				$results = get_tcd_image_editor_data( $media_id, $post_id );
				if ( $results && is_array( $results ) ) {
					$json            = $results;
					$json['success'] = true;

					ob_start();
					render_tcd_image_editor( $json );
					$json['html'] = ob_get_clean();
				} elseif ( $results && is_string( $results ) ) {
					$json['message'] = $results;
				} else {
					$json['message'] = __( 'Failed to get image data.', 'tcd-seeed' );
				}
			}
		} elseif ( 'save' === $_POST['do'] ) {
			// 保存

			if ( ! check_ajax_referer( 'tcd-image-edit-save-' . $media_id, '_ajax_nonce', false ) ) {
				$json['message'] = __( 'Invalid nonce.', 'tcd-seeed' );
			} else {
				$results = save_tcd_image_editor_data( $media_id );
				$image   = wp_get_attachment_image_src( $media_id, 'full' );
				if ( true === $results && $image ) {
					$json['success']          = true;
					$json['new_image_url']    = $image[0];
					$json['new_image_width']  = $image[1];
					$json['new_image_height'] = $image[2];
				} elseif ( $results && is_string( $results ) ) {
					$json['message'] = $results;
				} else {
					$json['message'] = __( 'Failed to save image data.', 'tcd-seeed' );
				}
			}
		} elseif ( 'restore' === $_POST['do'] ) {
			// 元の画像にリセット

			if ( ! check_ajax_referer( 'tcd-image-edit-save-' . $media_id, '_ajax_nonce', false ) ) {
				$json['message'] = __( 'Invalid nonce.', 'tcd-seeed' );
			} else {
				if ( ! function_exists( 'wp_restore_image' ) ) {
					include_once ABSPATH . 'wp-admin/includes/image-edit.php';
				}

				$restore_image = wp_restore_image( $media_id );
				if ( isset( $restore_image->msg ) ) {
					// 復元成功
					$json['success'] = true;

					$results = get_tcd_image_editor_data( $media_id, $post_id );
					if ( $results && is_array( $results ) ) {
						$json            = $results;
						$json['success'] = true;

						ob_start();
						render_tcd_image_editor( $json );
						$json['html'] = ob_get_clean();
					} elseif ( $results && is_string( $results ) ) {
						$json['message']  = __( 'Failed to restore image.', 'tcd-seeed' );
						$json['message'] .= $results;
					} else {
						$json['message']  = __( 'Failed to restore image.', 'tcd-seeed' );
						$json['message'] .= __( 'Failed to get image data.', 'tcd-seeed' );
					}
				} elseif ( isset( $restore_image->error ) ) {
					$json['message'] = $restore_image->error;
				} else {
					$json['message'] = __( 'Failed to restore image.', 'tcd-seeed' );
				}
			}
		} else {
			$json['message'] = __( 'Invalid request.', 'tcd-seeed' );
		}
	}

	// JSON出力
	wp_send_json( $json );
	exit;
}
add_action( 'wp_ajax_tcd-image-editor', 'tcd_image_editor_ajax' );

/**
 * 画像エディター用のデフォルトデータ取得
 */
function get_tcd_image_editor_default_data() {
	return array(
		// 基本データ
		'post_id'           => null,
		'media_id'          => null,
		'image_url'         => null,
		'image_width'       => null,
		'image_height'      => null,

		// フィルターデータ
		'filter_brightness' => 0,
		'filter_contrast'   => 0,
		'filter_saturation' => 0,
		'filter_hue'        => 0,
		'filter_sepia'      => 0,
		'filter_sharpen'    => 0,
		'filter_preset'     => '',
	);
}

/**
 * 画像エディター用の各種データ取得
 */
function get_tcd_image_editor_data( $media_id, $post_id ) {
	$image = wp_get_attachment_image_src( $media_id, 'full' );
	if ( ! $image ) {
		return false;
	}

	// デフォルトデータ取得
	$data = get_tcd_image_editor_default_data();

	// 代入
	$data['media_id']     = $media_id;
	$data['post_id']      = $post_id;
	$data['image_url']    = $image[0];
	$data['image_width']  = $image[1];
	$data['image_height'] = $image[2];

	// メタ取得
	$meta                  = wp_get_attachment_metadata( $media_id );
	$backup_sizes          = get_post_meta( $media_id, '_wp_attachment_backup_sizes', true );
	$tcd_image_editor_meta = get_post_meta( $media_id, '_tcd_image_editor', true );
	if ( ! $meta || ! is_array( $meta ) ) {
		return __( 'Image data does not exist. Please re-upload the image.', 'tcd-seeed' );
	}

	// 編集済みの場合、オリジナル画像も代入
	if ( isset( $backup_sizes['full-orig'] ) && $backup_sizes['full-orig']['file'] != basename( $image[0] ) ) {
		$data['orig_image_url']    = str_replace( basename( $image[0] ), $backup_sizes['full-orig']['file'], $image[0] );
		$data['orig_image_width']  = $backup_sizes['full-orig']['width'];
		$data['orig_image_height'] = $backup_sizes['full-orig']['height'];
	}

	return $data;
}

/**
 * 画像エディターHTML出力
 */
function render_tcd_image_editor( $data ) {
	?>
<div class="tcd-image-editor__image-container">
	<img id="tcd-image-editor__image" class="tcd-image-editor__image" alt="" style="display: none;">
</div>
<div class="tcd-image-editor__canvas-container hidden">
	<?php // data-caman-hidpi-disabled がないとretina対応mac等でcanvasが大きく描画される ?>
	<canvas id="tcd-image-editor__canvas" class="tcd-image-editor__canvas" data-caman-hidpi-disabled></canvas>
</div>
<h2 class="tcd-image-editor__filters-headline"><?php _e( 'Filters', 'tcd-seeed' ); ?></h2>
<table class="tcd-image-editor__filters">
	<tr>
		<th><?php _e( 'Brightness', 'tcd-seeed' ); ?></th>
		<td>
			<button class="tcd-image-editor__filter-input__decrease">-</button><input type="range" class="tcd-image-editor__filter-input" name="filter_brightness" min="-100" max="100" step="1" value="<?php echo esc_attr( $data['filter_brightness'] ); ?>" data-default="0"><button class="tcd-image-editor__filter-input__increase">+</button>
			<span class="tcd-image-editor__filter-value"><?php echo esc_attr( $data['filter_brightness'] ); ?></span>
		</td>
		<th><?php _e( 'Contrast', 'tcd-seeed' ); ?></th>
		<td>
			<button class="tcd-image-editor__filter-input__decrease">-</button><input type="range" class="tcd-image-editor__filter-input" name="filter_contrast" min="-100" max="100" step="1" value="<?php echo esc_attr( $data['filter_contrast'] ); ?>" data-default="0"><button class="tcd-image-editor__filter-input__increase">+</button>
			<span class="tcd-image-editor__filter-value"><?php echo esc_html( $data['filter_contrast'] ); ?></span>
		</td>
	</tr>
	<tr>
		<th><?php _e( 'Saturation', 'tcd-seeed' ); ?></th>
		<td>
			<button class="tcd-image-editor__filter-input__decrease">-</button><input type="range" class="tcd-image-editor__filter-input" name="filter_saturation" min="-100" max="100" step="1" value="<?php echo esc_attr( $data['filter_saturation'] ); ?>" data-default="0"><button class="tcd-image-editor__filter-input__increase">+</button>
			<span class="tcd-image-editor__filter-value"><?php echo esc_html( $data['filter_saturation'] ); ?></span>
		</td>
		<th><?php _e( 'Hue', 'tcd-seeed' ); ?></th>
		<td>
			<button class="tcd-image-editor__filter-input__decrease">-</button><input type="range" class="tcd-image-editor__filter-input" name="filter_hue" min="0" max="100" step="1" value="<?php echo esc_attr( $data['filter_hue'] ); ?>" data-default="0"><button class="tcd-image-editor__filter-input__increase">+</button>
			<span class="tcd-image-editor__filter-value"><?php echo esc_html( $data['filter_hue'] ); ?></span>
		</td>
	</tr>
	<tr>
		<th><?php _e( 'Sepia', 'tcd-seeed' ); ?></th>
		<td>
			<button class="tcd-image-editor__filter-input__decrease">-</button><input type="range" class="tcd-image-editor__filter-input" name="filter_sepia" min="0" max="100" step="1" value="<?php echo esc_attr( $data['filter_sepia'] ); ?>" data-default="0"><button class="tcd-image-editor__filter-input__increase">+</button>
			<span class="tcd-image-editor__filter-value"><?php echo esc_html( $data['filter_sepia'] ); ?></span>
		</td>
		<th><?php _e( 'Sharpen', 'tcd-seeed' ); ?></th>
		<td>
			<button class="tcd-image-editor__filter-input__decrease">-</button><input type="range" class="tcd-image-editor__filter-input" name="filter_sharpen" min="0" max="100" step="1" value="<?php echo esc_attr( $data['filter_sharpen'] ); ?>" data-default="0"><button class="tcd-image-editor__filter-input__increase">+</button>
			<span class="tcd-image-editor__filter-value"><?php echo esc_html( $data['filter_sharpen'] ); ?></span>
		</td>
	</tr>
</table>
<h2 class="tcd-image-editor__preset-filters-headline"><?php _e( 'Preset filters', 'tcd-seeed' ); ?></h2>
<p>
	<?php
	foreach ( array(
		'clarity'   => __( 'Clarity', 'tcd-seeed' ),
		'nostalgia' => __( 'Nostalgia', 'tcd-seeed' ),
		'lomo'      => __( 'Lomo', 'tcd-seeed' ),
		'pinhole'   => __( 'Pin Hole', 'tcd-seeed' ),
		'oldBoot'   => __( 'Old Boot', 'tcd-seeed' ),
		'hazyDays'  => __( 'Hazy Days', 'tcd-seeed' ),
	) as $key => $label ) :
		echo "\t" . '<button type="button" class="button button-secondary button-preset-filters' . ( $key === $data['filter_preset'] ? ' active' : '' ) . '" data-preset="' . esc_attr( $key ) . '">' . esc_attr( $label ) . '</button>' . "\n";
	endforeach;
	?>
</p>
<h2 class="tcd-image-editor__reset-headline"><?php _e( 'Reset', 'tcd-seeed' ); ?></h2>
<p>
	<button type="button" class="button button-secondary button-reset-filters"><?php echo _e( 'Reset Filters', 'tcd-seeed' ); ?></button>
	<button type="button" class="button button-secondary button-reset-to-orig hidden"><?php echo _e( 'Reset to Original Image', 'tcd-seeed' ); ?></button>
</p>
<input type="hidden" name="action" value="tcd-image-editor">
<input type="hidden" name="do" value="save">
<input type="hidden" name="post_id" value="<?php echo esc_attr( $data['post_id'] ); ?>">
<input type="hidden" name="media_id" value="<?php echo esc_attr( $data['media_id'] ); ?>">
<input type="hidden" name="_ajax_nonce" value="<?php echo esc_attr( wp_create_nonce( 'tcd-image-edit-save-' . $data['media_id'] ) ); ?>">
<input type="hidden" name="filter_preset" value="<?php echo esc_attr( $data['filter_preset'] ); ?>">
	<?php
}

/**
 * 画像エディター保存
 */
function save_tcd_image_editor_data( $media_id ) {
	global $tcd_image_editor_vars;
	$tcd_image_editor_vars = array();

	// アップロードファイルチェック
	if ( empty( $_FILES['file-image-edited']['tmp_name'] ) ) {
		return __( 'Empty upload image file.', 'tcd-seeed' );
	}

	// メタ取得
	$meta         = $old_meta = wp_get_attachment_metadata( $media_id );
	$backup_sizes = $old_backup_sizes = get_post_meta( $media_id, '_wp_attachment_backup_sizes', true );

	if ( ! $meta || ! is_array( $meta ) ) {
		return __( 'Image data does not exist. Please re-upload the image.', 'tcd-seeed' );
	}

	if ( ! is_array( $backup_sizes ) ) {
		$backup_sizes = array();
	}

	// パス関連
	$path     = get_attached_file( $media_id );
	$basename = pathinfo( $path, PATHINFO_BASENAME );
	$dirname  = pathinfo( $path, PATHINFO_DIRNAME );

	// オリジナル画像のファイル名・サブフォルダ
	$tcd_image_editor_vars['basename']          = preg_replace( '/-e[0-9]+\./', '.', $basename );
	$tcd_image_editor_vars['upload_dir_subdir'] = '/' . trim( dirname( $meta['file'] ), '/' );

	// アップロードフォルダフィルター追加
	add_filter( 'upload_dir', '_filter_tcd_image_editor_upload_dir', 999 );

	$uploads = wp_upload_dir();

	// アップロード
	if ( ! function_exists( 'wp_handle_upload' ) ) {
		require_once ABSPATH . 'wp-admin/includes/file.php';
	}
	$wp_handle_upload = wp_handle_upload(
		$_FILES['file-image-edited'],
		array(
			'mimes'                    => array(
				'jpg|jpeg|jpe' => 'image/jpeg',
				'gif'          => 'image/gif',
				'png'          => 'image/png',
			),
			'test_form'                => false,
			'unique_filename_callback' => '_tcd_image_editor_unique_filename_callback',
		)
	);

	// フィルター削除
	remove_filter( 'upload_dir', '_filter_tcd_image_editor_upload_dir', 999 );

	// アップロードファイルエラー
	if ( ! empty( $wp_handle_upload['error'] ) ) {
		return $wp_handle_upload['error'];
	} elseif ( empty( $wp_handle_upload['file'] ) || empty( $wp_handle_upload['url'] ) ) {
		return __( 'Failed to upload edited image file.', 'tcd-seeed' );
	}

	// $backup_sizesが空なら生成
	if ( ! isset( $backup_sizes['full-orig'] ) ) {
		$backup_sizes['full-orig'] = array(
			'width'  => $meta['width'],
			'height' => $meta['height'],
			'file'   => $basename,
		);

		if ( ! empty( $meta['sizes'] ) ) {
			foreach ( $meta['sizes'] as $size => $value ) {
				$backup_sizes[ $size . '-org' ] = $value;
			}
		}
	} else {
		// 編集済みファイルがあればファイル削除
		if ( preg_match( '/-e[0-9]{13}\./', $basename ) ) {
			wp_delete_file( path_join( $dirname, $basename ) );
		}
		if ( ! empty( $meta['sizes'] ) ) {
			foreach ( $meta['sizes'] as $size ) {
				if ( ! empty( $size['file'] ) && preg_match( '/-e[0-9]{13}-/', $size['file'] ) ) {
					wp_delete_file( path_join( $dirname, $size['file'] ) );
				}
			}
		}
	}

	// メタデータを生成（サムネイルもここで生成される）
	$new_meta = wp_generate_attachment_metadata( $media_id, $wp_handle_upload['file'] );
	// image_metaは旧データのを上書き
	if ( isset( $meta['image_meta'] ) ) {
		$new_meta['image_meta'] = $meta['image_meta'];
	}

	// メタ保存 _wp_attachment_metadata
	wp_update_attachment_metadata( $media_id, $new_meta );

	// メタ保存 _wp_attached_file
	$wp_attached_file = ltrim( str_replace( $uploads['basedir'], '', $wp_handle_upload['file'] ), '/' );
	update_attached_file( $media_id, $wp_attached_file );

	// メタ保存 _wp_attachment_backup_sizes
	update_post_meta( $media_id, '_wp_attachment_backup_sizes', $backup_sizes );

	return true;
}

/**
 * アップロードフォルダフィルター
 */
function _filter_tcd_image_editor_upload_dir( $uploads ) {
	global $tcd_image_editor_vars;

	if ( ! empty( $tcd_image_editor_vars['upload_dir_subdir'] ) ) {
		$uploads['subdir'] = $tcd_image_editor_vars['upload_dir_subdir'];
		$uploads['path']   = $uploads['basedir'] . $uploads['subdir'];
		$uploads['url']    = $uploads['baseurl'] . $uploads['subdir'];
	}

	return $uploads;
}

/**
 * ユニークファイル名コールバック
 */
function _tcd_image_editor_unique_filename_callback( $dir, $name, $ext ) {
	global $tcd_image_editor_vars;

	if ( ! empty( $tcd_image_editor_vars['basename'] ) ) {
		$filename     = substr( $tcd_image_editor_vars['basename'], 0, strlen( $ext ) * -1 );
		$suffix       = time() . rand( 100, 999 );
		$new_filename = $filename . '-e' . $suffix . $ext;

		while ( file_exists( $dir . '/' . $new_filename ) ) {
			$suffix++;
			$new_filename = $filename . '-e' . $suffix . $ext;
		}

		return $new_filename;
	} else {
		do {
			// ランダム文字列生成 (英小文字+数字)
			$randname = strtolower( wp_generate_password( 8, false, false ) );
		} while ( file_exists( $dir . '/' . $randname . $ext ) );

		return $randname . $ext;
	}
}
