jQuery(function($){
	var $imageEditor = $('#tcd-image-editor');
	var $galleryRepeater = $('#gallery_meta_box #gallery_list');
	var $ajax, $repeaterPreviewImage, isUploding = false;
	var $canvas, $canvasImage, caman;

	if (!$imageEditor.length || !$galleryRepeater.length) return;

	// 画像変更イベント
	$galleryRepeater.on('change', '.gallery_item .cf_media_id', function(){
		var $editButton = $(this).closest('.gallery_item').find('.edit_gallery_image');
		if (this.value) {
			$editButton.show();
		} else {
			$editButton.hide();
		}
	});

	// 画像編集クリックイベント
	$galleryRepeater.on('click', '.gallery_item .edit_gallery_image', function(){
		// 記事ID・メディアID・ノンス取得
		var mediaId = $(this).closest('.gallery_item').find('.cf_media_id').val();
		var postId = $galleryRepeater.attr('data-post-id');
		var nonce = $galleryRepeater.attr('data-nonce');
		if (postId && mediaId) {
			$repeaterPreviewImage = $(this).closest('.gallery_item').find('.preview_field .image');
			$imageEditor.addClass('is-ajaxing').show();
			$imageEditor.find('.media-frame-content').html('');

			$ajax = $.ajax({
				url: ajaxurl,
				type: 'POST',
				data: {
					action: 'tcd-image-editor',
					post_id: postId,
					media_id: mediaId,
					_ajax_nonce: nonce,
					do: 'open'
				},
				dataType: 'json',
				success: function(json, textStatus, XMLHttpRequest) {
					if (json.success) {
						$imageEditor.find('.media-frame-content').html(json.html);
						initCanvas(json);
					} else if (json.message) {
						alert(json.message);
						imageEditorClose();
					} else {
						alert(TCD_IMAGE_EDITOR.ajax_error_message);
						imageEditorClose();
					}
				},
				complete: function(XMLHttpRequest, textStatus) {
					if (textStatus != 'success' && textStatus != 'abort') {
						$imageEditor.removeClass('is-ajaxing');
						alert(TCD_IMAGE_EDITOR.ajax_error_message);
						imageEditorClose();
					}
					$ajax = null;
				}
			});
		} else {
			$(this).hide();
		}
		return false;
	});

	// モーダル閉じる
	var imageEditorClose = function(){
		if (!isUploding) {
			if ($ajax) {
				$ajax.abort();
				$ajax = null;
			}
			$imageEditor.hide().find('.media-frame-content').html('');
			$canvas = $canvasImage = caman = null;
		}
	};
	$imageEditor.on('click', '.media-modal-close, .media-modal-backdrop', imageEditorClose);

	// Caman初期化
	var initCanvas = function (data) {
		var $filterInputs = $imageEditor.find('.tcd-image-editor__filter-input');
		var $imgEditInputs = $imageEditor.find('.tcd-image-editor__imgedit-input');
		var $message = $imageEditor.find('.media-toolbar-messege');
		var isProsessing = false;

		$canvasImage = $imageEditor.find('#tcd-image-editor__image');

		// Caman初期化
		var initCaman = function(image_url, replace){
			if (replace) {
				updateCanvas({
					resetPresetFilters: true,
					resetSliderFilters: true,
				});

				if (caman) {
					$canvas = $(caman.canvas);
					var $tempCanvas = $('<canvas />');
					$tempCanvas.attr('id', $canvas.attr('id')).attr('class', $canvas.attr('class')).attr('data-caman-hidpi-disabled', $canvas.attr('data-caman-hidpi-disabled'));;
					$canvas.after($tempCanvas);
					$canvas.remove();
					caman = $canvas = null;
				}
			}

			caman = Caman('#tcd-image-editor__canvas', image_url, function(){
				isProsessing = true;
				$canvas = $(caman.canvas);

				caman.render(function(){
					$canvasImage.attr('src', caman.canvas.toDataURL('image/jpeg', 0.9)).show();
					isProsessing = false;
					$imageEditor.removeClass('is-ajaxing');
					$imageEditor.find('.media-button-save').removeAttr('disabled');
					$message.text('');
				});
			});
		};

		initCaman(data.image_url);

		// canvas更新
		var updateCanvas = function(obj) {
			var didResetRevert = false, imgEdited = false, $input, value;

			if (!obj || typeof obj != 'object') return;

			if (obj.render) {
				isProsessing = true;
			}

			// reset
			if (obj.reset) {
				caman.reset();
				didResetRevert = 'reset';
			}

			// revert
			if (obj.revert === true) {
				caman.revert(true);
				didResetRevert = 'revert';
			} else if (obj.revert === false) {
				caman.revert(false);
				didResetRevert = 'revert';
			}

			// プリセットフィルター変更
			if (obj.setPresetFilters) {
				$imageEditor.find('.button-preset-filters.active').removeClass('active');
				$imageEditor.find('.button-preset-filters[data-preset="' + obj.setPresetFilters + '"]').addClass('active');
				$imageEditor.find('input[name="filter_preset"]').val(obj.setPresetFilters);
				caman[obj.setPresetFilters]();
			}

			// プリセットフィルター適用
			if (obj.applyPresetFilters) {
				var preset = $imageEditor.find('.button-preset-filters.active').attr('data-preset');
				if (preset) {
					caman[preset]();
				}
			}

			// プリセットフィルターリセット
			if (obj.resetPresetFilters) {
				$imageEditor.find('.button-preset-filters.active').removeClass('active');
				$imageEditor.find('input[name="filter_preset"]').val('');
			}

			// スライダーフィルター適用
			if (obj.applySliderFilters) {
				$filterInputs.each(function(){
					var filterMethod = $(this).attr('data-filter');
					var value = this.value * 1;
					var defaultValue = $(this).attr('data-default') * 1;
					if (!filterMethod) {
						filterMethod = this.name.replace('filter_', '');
					}

					// リセット後でデフォルト値の場合はフィルターかけない
					if (didResetRevert && defaultValue === value) {
						return;
					}

					caman[filterMethod](value);
				});
			}

			// スライダーフィルターリセット
			if (obj.resetSliderFilters) {
				$filterInputs.each(function(){
					$(this).val($(this).attr('data-default'));
					$(this).closest('td').find('.tcd-image-editor__filter-value').text($(this).val());
				});
			}

			// render
			if (obj.render) {
				caman.render(function(){
					$canvasImage.attr('src', caman.canvas.toDataURL('image/jpeg', 0.9));
					isProsessing = false;
				});
			}
		};

		// スライダーフィルター変更
		$filterInputs.off('change').on('change', function(){
			if (isProsessing) return false;
			isProsessing = true;

			$(this).closest('td').find('.tcd-image-editor__filter-value').text($(this).val());
			updateCanvas({
				reset: true,
				applyImgEdit: true,
				applyPresetFilters: true,
				applySliderFilters: true,
				render: true
			});
		});
		$imageEditor.find('.tcd-image-editor__filters td .tcd-image-editor__filter-input__decrease').off('click').on('click', function(){
			if (isProsessing) return false;

			var $range = $(this).siblings('input[type="range"]');
			if ($range.length) {
				var range = $range.get(0);
				var val = (range.value * 1) - (range.step * 1);
				if (val < (range.min * 1)) {
					val = range.min * 1;
				}
				$range.val(val).trigger('change');
			}
		});
		$imageEditor.find('.tcd-image-editor__filters td .tcd-image-editor__filter-input__increase').off('click').on('click', function(){
			if (isProsessing) return false;

			var $range = $(this).siblings('input[type="range"]');
			if ($range.length) {
				var range = $range.get(0);
				var val = (range.value * 1) + (range.step * 1);
				if (val > (range.max * 1)) {
					val = range.max * 1;
				}
				$range.val(val).trigger('change');
			}
		});

		// フィルタープリセット
		$imageEditor.find('.button-preset-filters').off('click').on('click', function(){
			var $this = $(this)
			var preset = $this.attr('data-preset');
			if (preset) {
				if (isProsessing) return false;

				isProsessing = true;
				$this.blur();

				if ($this.hasClass('active')) {
					updateCanvas({
						reset: true,
						applyImgEdit: true,
						resetPresetFilters: true,
						applySliderFilters: true,
						render: true
					});
				} else {
					updateCanvas({
						reset: true,
						applyImgEdit: true,
						setPresetFilters: preset,
						resetSliderFilters: true,
						render: true
					});
				}
			}
		});

		// フィルターリセット
		$imageEditor.find('.button-reset-filters').off('click').on('click', function(){
			if (isProsessing) return false;

			updateCanvas({
				reset: true,
				applyImgEdit: true,
				resetPresetFilters: true,
				resetSliderFilters: true,
				render: true
			});
		});

		// 元の画像にリセット
		$imageEditor.find('.button-reset-to-orig').off('click').on('click', function(){
			var $saveButton = $imageEditor.find('.media-button-save');

			if (isProsessing || $imageEditor.hasClass('is-ajaxing')) {
				return false;
			}

			isUploding = true;
			$imageEditor.addClass('is-ajaxing');
			$saveButton.attr('disabled', 'disabled');
			$message.text(TCD_IMAGE_EDITOR.restoring);

			// POST
			$.ajax({
				url: ajaxurl,
				type: 'POST',
				data: {
					action: 'tcd-image-editor',
					post_id: $imageEditor.find('input[name="post_id"]').val(),
					media_id: $imageEditor.find('input[name="media_id"]').val(),
					_ajax_nonce: $imageEditor.find('input[name="_ajax_nonce"]').val(),
					do: 'restore'
				},
				dataType: 'json',
				success: function(json, textStatus, XMLHttpRequest) {
					if (json.success) {
						// フィルター等リセット
						updateCanvas({
							reset: true,
							applyImgEdit: true,
							resetPresetFilters: true,
							resetSliderFilters: true,
							render: false
						});

						// caman画像差し替え
						initCaman(json.image_url, true);

						// リピーターのプレビュー画像を差し替える
						$repeaterPreviewImage.css('backgroundImage', 'url(' + json.image_url + ')');

						data.orig_image_url = null;
						$imageEditor.find('.button-reset-to-orig').hide();
					} else if (json.message) {
						alert(json.message);
					} else {
						alert(TCD_IMAGE_EDITOR.ajax_error_message);
					}
				},
				error: function(XMLHttpRequest, textStatus) {
					alert(TCD_IMAGE_EDITOR.ajax_error_message);
				},
				complete: function(XMLHttpRequest, textStatus) {
					if (isUploding) {
						isUploding = false;
						$imageEditor.removeClass('is-ajaxing');
						$saveButton.removeAttr('disabled');
						$message.text('');
					}
				},
			});
		});
		if (data.orig_image_url) {
			$imageEditor.find('.button-reset-to-orig').show();
		}

		// アップロード保存
		$imageEditor.find('.media-button-save').off('click').on('click', function(){
			var $saveButton = $(this)
			var canvasWidth, canvasHeight, $cloneCanvas, cloneCanvasCtx, base64, blob, formData;

			if ($imageEditor.hasClass('is-ajaxing')) {
				return false;
			}

			isUploding = true;
			$imageEditor.addClass('is-ajaxing');
			$saveButton.attr('disabled', 'disabled');
			$message.text(TCD_IMAGE_EDITOR.saving);

			// canvasクローン
			// sharpenをかける等で生成されるアルファチャンネル対策で背景色を白にする
			$canvas = $(caman.canvas);
			canvasWidth = $canvas.width();
			canvasHeight = $canvas.height();

			$cloneCanvas = $canvas.clone();
			$cloneCanvas.width(canvasWidth).height(canvasHeight);

			cloneCanvasCtx = $cloneCanvas.get(0).getContext('2d');
			cloneCanvasCtx.imageSmoothingEnabled = true;
			cloneCanvasCtx.imageSmoothingQuality = 'high';
			cloneCanvasCtx.fillStyle = 'rgb(255, 255, 255)';
			cloneCanvasCtx.fillRect(0, 0, canvasWidth, canvasHeight);
			cloneCanvasCtx.drawImage(caman.canvas, 0, 0);

			// canvas.toBlob()はブラウザを選ぶためbase64からblob生成
			base64 = $cloneCanvas.get(0).toDataURL('image/jpeg', 0.9);
			blob = base64ToBlob(base64);

			// フォームデータ生成
			formData = new FormData();
			formData.append('file-image-edited', blob, 'image-edited.jpg');
			$imageEditor.find('input').each(function(){
				if (this.name) {
					formData.append(this.name, this.value);
				}
			});

			// POST
			$.ajax({
				url: ajaxurl,
				type: 'POST',
				data: formData,
				dataType: 'json',
				processData: false,
				contentType: false,
				success: function(json, textStatus, XMLHttpRequest) {
					if (json.success) {
						// caman画像差し替え
						initCaman(json.new_image_url, true);

						// リピーターのプレビュー画像を差し替える
						$repeaterPreviewImage.css('backgroundImage', 'url(' + json.new_image_url + ')');

						if (!data.orig_image_url) {
							data.orig_image_url = data.image_url;
							$imageEditor.find('.button-reset-to-orig').show();
						}
					} else if (json.message) {
						alert(json.message);
					} else {
						alert(TCD_IMAGE_EDITOR.ajax_error_message);
					}
				},
				error: function(XMLHttpRequest, textStatus) {
					alert(TCD_IMAGE_EDITOR.ajax_error_message);
				},
				complete: function(XMLHttpRequest, textStatus) {
					if (isUploding) {
						isUploding = false;
						$imageEditor.removeClass('is-ajaxing');
						$saveButton.removeAttr('disabled');
						$message.text('');
					}
				}
			});
		});

		// base64からblob変換
		var base64ToBlob = function(base64) {
			var bin = atob(base64.split('base64,')[1]);
			var len = bin.length;
			var barr = new Uint8Array(len);
			for (var i = 0; i < len; i++) {
				barr[i] = bin.charCodeAt(i);
			}
			return new Blob([barr], {
				type: 'image/jpeg',
			});
		};
	};

});
