<?php
/**
 * ブロックエディターのExampleプレビュー用のHTMLを返すように設定します
 * inviewは使用しないようにしてください
 */

wp_enqueue_style( 'style', get_stylesheet_uri(), array(), version_num() );
wp_enqueue_style( 'responsive', get_template_directory_uri() . '/css/responsive.css', array(), version_num() );

wp_enqueue_script( 'tcd-chart', get_template_directory_uri() . '/js/Chart.min.js', array( 'jquery' ), version_num(), true );
wp_enqueue_script( 'tcd-chart-datalabel', get_template_directory_uri() . '/js/chartjs-plugin-datalabels.js', array(), version_num(), true );
wp_enqueue_script( 'tcd-chart-deferred', get_template_directory_uri() . '/js/chartjs-plugin-deferred.js', array(), version_num(), true );
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

<div class='tcd_chart'>
<div class='chart pie'>
<h4 class='chart_headline inview'>音楽ジャンル</h4>
<div class='chart_area'>
<canvas class='chart_main' id='chart_5471'></canvas>
</div>
<div class='chart_labels inview'>
<div class='item'>
<span class='color' style='background:#cc4f95;'></span>
<span class='label'>ジャズ</span>
</div>
<div class='item'>
<span class='color' style='background:#9fd5d4;'></span>
<span class='label'>邦楽</span>
</div>
<div class='item'>
<span class='color' style='background:#a4ca45;'></span>
<span class='label'>クラブ</span>
</div>
<div class='item'>
<span class='color' style='background:#e56a84;'></span>
<span class='label'>R＆B</span>
</div>
<div class='item'>
<span class='color' style='background:#7fa0d1;'></span>
<span class='label'>ロック</span>
</div>
</div>
<!--
<div class='data_table inview'>
<table>
<tr>
<th>ジャズ</th>
<th>邦楽</th>
<th>クラブ</th>
<th>R＆B</th>
<th>ロック</th>
</tr>
<tr>
<td>25</td>
<td>5</td>
<td>40</td>
<td>15</td>
<td>15</td>
</tr>
</table>
</div>
-->
</div>
</div>

</div>
</div>
<?php wp_footer(); ?>
<script type='text/javascript' id='tcd-chart-deferred-js-after'>
jQuery(function($){
var ctx = document.getElementById('chart_5471');
var myLineChart = new Chart(ctx, {
type: 'pie',
data: {
labels: [
'ジャズ','邦楽','クラブ','R＆B','ロック',],
datasets: [{
borderWidth: 1,
backgroundColor: [
'#cc4f95','#9fd5d4','#a4ca45','#e56a84','#7fa0d1',],
data: [
25,5,40,15,15,],
}]
},
options: {
responsive: true,
maintainAspectRatio: false,
legend: { display:false, },
tooltips: {
callbacks: {
label: function (tooltipItems, data) {
return data.labels[tooltipItems.index] + ' ' + data.datasets[0].data[tooltipItems.index].toLocaleString() + '%'
}
}
},
plugins: {
datalabels: { color:'#ffffff', font: { size:15 }, formatter: (val) => { return val.toLocaleString() + '%' } },
deferred: { yOffset: 300, }
},
}
});
});
</script>
</body>
</html>
