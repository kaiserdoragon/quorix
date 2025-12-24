/**
 * 参考URL https://github.com/WordPress/gutenberg/tree/trunk/packages/block-library/src/embed
 */

/**
 * WordPress dependencies
 */
import { registerBlockType } from '@wordpress/blocks';
import { __ } from '@wordpress/i18n';
import { useState, useEffect, useRef } from '@wordpress/element';
import { useBlockProps, BlockControls } from '@wordpress/block-editor';
import {
	ToolbarGroup,
	ToolbarButton,
	Button,
	Placeholder,
	Spinner,
} from '@wordpress/components';

/**
 * Internal dependencies
 */
import './editor.scss';
import metadata from './block.json';

const iconChartPie = (
	<svg
		xmlns="http://www.w3.org/2000/svg"
		width="24"
		height="24"
		viewBox="0 0 20 20"
		role="img"
		aria-hidden="true"
		focusable="false"
	>
		<path d="M10 10V3c3.87 0 7 3.13 7 7h-7zM9 4v7h7c0 3.87-3.13 7-7 7s-7-3.13-7-7 3.13-7 7-7z" />
	</svg>
);

registerBlockType(metadata, {
	// 翻訳用
	title: __('Chart', 'tcd-seeed'),
	description: __('Add a block that displays the chart.', 'tcd-seeed'),

	// svgアイコン指定
	icon: {
		src: iconChartPie,
	},

	// example
	example: {
		attributes: {
			chart_id: 0,
			forcePreviewUrl: TcdEditorChart.block_example_preview_url,
		},
	},

	edit: (props) => {
		const { attributes, setAttributes } = props;

		const selectRef = useRef();

		// attributesにない変数はuseStateを使う
		const [selectChartId, setSelectChartId] = useState(attributes.chart_id);
		const [previewChartId, setPreviewChartId] = useState(null);
		const [isEditMode, setIsEditMode] = useState(
			!attributes.chart_id && !attributes.forcePreviewUrl
		);
		const [choicesInstance, setChoicesInstance] = useState(null);
		const [chartInstance, setChartInstance] = useState(null);

		const blockProps = useBlockProps();

		let iframeSrc = null;
		if (attributes.forcePreviewUrl) {
			iframeSrc = attributes.forcePreviewUrl;
		} else if (attributes.chart_id > 0) {
			iframeSrc = TcdEditorChart.block_preview_url.replace(
				/%ID%/,
				attributes.chart_id
			);
		}

		// useEffectを使うことでレンダー後に処理される
		// 引数を空配列にすることで初回のみ実行
		useEffect(() => {
			// Choices.js初期化
			// https://github.com/Choices-js/Choices#setup
			if (
				// exampleプレビューではエラー出るので除外する
				!attributes.forcePreviewUrl &&
				!chartInstance &&
				window.Choices &&
				selectRef.current
			) {
				const choices = new Choices(selectRef.current, {
					maxItemCount: 100,
					searchResultLimit: 100,
					searchFields: ['label'],
					shouldSort: false,
					placeholder: true,
					placeholderValue: TcdEditorChart.choices.placeholderValue,
					searchPlaceholderValue:
						TcdEditorChart.choices.searchPlaceholderValue,
					loadingText: TcdEditorChart.choices.loadingText,
					noResultsText: TcdEditorChart.choices.noResultsText,
					itemSelectText: '',
				});
				choices.setChoices(() => {
					// postデータ
					const formData = new FormData();
					formData.append('action', 'tcd-get-chart-list');

					// admin-ajax.phpにPOSTでfetch
					return fetch(ajaxurl, {
						method: 'POST',
						body: formData,
					})
						.then((response) => {
							return response.json();
						})
						.then((data) => {
							data.forEach((v) => {
								if (v.value == attributes.chart_id) {
									v.selected = true;
								}
							});

							if (props.isSelected) {
								choices.showDropdown();
							}

							return data;
						});
				});

				setChoicesInstance(choices);
			}
		}, []);

		return (
			<div {...blockProps}>
				<Placeholder
					icon={iconChartPie}
					label={__('Chart', 'tcd-seeed')}
					className="wp-block-embed"
					style={!isEditMode ? { display: 'none' } : {}}
				>
					<form
						onSubmit={(event) => {
							event.preventDefault();
							if (selectChartId && selectChartId > 0) {
								setAttributes({ chart_id: selectChartId });
								setIsEditMode(false);
							}
						}}
					>
						<select
							className="components-placeholder__input"
							ref={selectRef}
							onChange={(event) =>
								setSelectChartId(
									parseInt(event.target.value, 10)
								)
							}
						/>
						<Button variant="primary" type="submit">
							{__('Embed', 'tcd-seeed')}
						</Button>
						{attributes.chart_id > 0 && (
							<Button
								variant="secondary"
								type="button"
								onClick={(event) => setIsEditMode(false)}
							>
								{__('Cancel', 'tcd-seeed')}
							</Button>
						)}
					</form>
				</Placeholder>

				{!isEditMode && iframeSrc && (
					<iframe
						className="tcd-block-chart-preview"
						src={iframeSrc}
						scrolling="no"
						frameBorder="0"
						onLoad={(event) => {
							event.target.style.height =
								event.target.contentWindow.document.body
									.scrollHeight +
								1 +
								'px';
						}}
					/>
				)}

				{!isEditMode && (
					<BlockControls>
						<ToolbarGroup>
							<ToolbarButton
								label={__('Select chart', 'tcd-seeed')}
								icon={
									<svg
										xmlns="http://www.w3.org/2000/svg"
										width="24"
										height="24"
										viewBox="0 0 24 24"
										role="img"
										aria-hidden="true"
										focusable="false"
									>
										<path d="M20.1 5.1L16.9 2 6.2 12.7l-1.3 4.4 4.5-1.3L20.1 5.1zM4 20.8h8v-1.5H4v1.5z" />
									</svg>
								}
								onClick={() => setIsEditMode(true)}
							/>
						</ToolbarGroup>
					</BlockControls>
				)}
			</div>
		);
	},

	save: (props) => {
		const { attributes } = props;

		const blockProps = useBlockProps.save();

		return (
			<div {...blockProps}>
				[tcd_chart id="{attributes.chart_id > 0 ? attributes.chart_id : null}"]
			</div>
		);
	},
});
