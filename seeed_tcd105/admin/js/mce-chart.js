(function() {
	if (!window.TcdEditorChart || !window.Choices) {
		return;
	}

	// プラグイン登録
	tinymce.PluginManager.add('tcd-chart', function(editor, url) {
		// ボタン
		editor.addButton('tcd-chart', {
			title: TcdEditorChart.button_title,
			icon: 'tcd-chart',
			onclick: function() {
				var selectedCartId = null;

				// ダイアログ表示
				editor.windowManager.open({
					title: TcdEditorChart.modal_title,
					id: 'tcd-chart-dialog',
					body: [
						{
							type: 'container',
							html: '<select id="tcd-chart-select"></select>',
						}
					],
					onOpen: function(e) {
						var sel = document.getElementById('tcd-chart-select');
						sel.addEventListener(
							'change',
							function(event) {
								selectedCartId = this.value;
							},
							false
						);

						// init Choices.js
						// https://github.com/Choices-js/Choices#setup
						var choicesInstance = new Choices(sel, {
							maxItemCount: 100,
							searchResultLimit: 100,
							searchFields: ['label'],
							shouldSort: false,
							placeholder: true,
							placeholderValue: TcdEditorChart.choices.placeholderValue,
							searchPlaceholderValue: TcdEditorChart.choices.searchPlaceholderValue,
							loadingText: TcdEditorChart.choices.loadingText,
							noResultsText: TcdEditorChart.choices.noResultsText,
							itemSelectText: ''
						});
						choicesInstance.setChoices(function() {
							// postデータ
							const formData = new FormData();
							formData.append('action', 'tcd-get-chart-list');

							// admin-ajax.phpにPOSTでfetch
							return fetch(ajaxurl, {
									method: 'POST',
									body: formData
								})
								.then(function(response) {
									return response.json();
					            })
								.then(function(data) {
									choicesInstance.showDropdown();
									return data;
					            });
						});
					},
					onsubmit: function(e) {
						selectedCartId = parseInt(selectedCartId, 10);
						if (selectedCartId > 0) {
							editor.insertContent('<p>[tcd_chart id="' + selectedCartId + '"]</p>');
						}
					}
				});
			}
		});
	});
})();
