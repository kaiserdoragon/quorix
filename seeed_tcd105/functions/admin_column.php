<?php
/**
 * Add custom columns (ID, thumbnails)
 */
function manage_columns( $columns ) {

  global $post_type;

  // Make new column array with ID column and featured image column
  $new_columns = array();

  foreach ( $columns as $column_name => $column_display_name ) {

    // タイトルの前にIDを追加
    if ( isset( $columns['title'] ) && $column_name == 'title' ) {
      $new_columns['post_id'] = 'ID';
    }

    // 日付の前に以下の項目を追加
    if ( isset( $columns['date'] ) && $column_name == 'date' ) {

      if( $post_type === 'news' ){
        $new_columns['recommend_news'] = __( 'Recommend post', 'tcd-seeed' );
      }

      if( $post_type != 'faq' && $post_type != 'chart'){
        $new_columns['new_post_thumb'] = __( 'Featured Image', 'tcd-seeed' );
      }

      if( $post_type === 'faq' ){
        $new_columns['faq_category'] = __( 'Category', 'tcd-seeed' );
      }

      if( $post_type === 'voice' ){
        $new_columns['voice_category'] = __( 'Category', 'tcd-seeed' );
      }

      if( $post_type === 'case_study' ){
        $new_columns['case_study_name'] = __( 'Name', 'tcd-seeed' );
        $new_columns['case_study_category'] = __( 'Category', 'tcd-seeed' );
      }

      if( $post_type === 'chart' ){
        $new_columns['short_code'] = __( 'Short code', 'tcd-seeed' );
        $new_columns['chart_type'] = __( 'Chart type', 'tcd-seeed' );
        $new_columns['chart_used_page'] = __( 'Used page ID', 'tcd-seeed' );
      }

    }

    $new_columns[$column_name] = $column_display_name;

  }

  return $new_columns;
}
add_filter( 'manage_posts_columns', 'manage_columns', 5 ); // For post, news, event and special


/**
 * おすすめ記事を追加
 */
function manage_post_posts_columns( $columns ) {

  $new_columns = array();
  foreach ( $columns as $column_name => $column_display_name ) {
    if ( isset( $columns['new_post_thumb'] ) && $column_name == 'new_post_thumb' ) {
      $new_columns['recommend_post'] = __( 'Recommend post', 'tcd-seeed' );
    }
    $new_columns[$column_name] = $column_display_name;
  }
  return $new_columns;

}
add_filter( 'manage_post_posts_columns', 'manage_post_posts_columns' ); // Only for post


/**
 * Output the content of custom columns (ID, featured image, recommend post and event date)
 */
function add_column( $column_name, $post_id ) {

  $options = get_design_plus_option();

  switch ( $column_name ) {

    case 'new_post_thumb' : // アイキャッチ画像
      $post_thumbnail_id = get_post_thumbnail_id( $post_id );
      if ( $post_thumbnail_id ) {
        $post_thumbnail_img = wp_get_attachment_image_src( $post_thumbnail_id, 'size1' );
        echo '<img width="70" src="' . esc_attr( $post_thumbnail_img[0] ) . '">';
      }
      break;

    case 'recommend_post' : // おすすめ記事
      if ( get_post_meta( $post_id, 'recommend_post', true ) ) { echo '<p>' . __( 'Recommend post', 'tcd-seeed' ) . '1</p>'; }
      if ( get_post_meta( $post_id, 'recommend_post2', true ) ) { echo '<p>' . __( 'Recommend post', 'tcd-seeed' ) . '2</p>'; }
      if ( get_post_meta( $post_id, 'recommend_post3', true ) ) { echo '<p>' . __( 'Recommend post', 'tcd-seeed' ) . '3</p>'; }
      break;

    case 'recommend_news' : // おすすめ記事 お知らせ用
      if ( get_post_meta( $post_id, 'recommend_post', true ) ) { echo '<p>' . __( 'Recommend post', 'tcd-seeed' ) . '1</p>'; }
      if ( get_post_meta( $post_id, 'recommend_post2', true ) ) { echo '<p>' . __( 'Recommend post', 'tcd-seeed' ) . '2</p>'; }
      if ( get_post_meta( $post_id, 'recommend_post3', true ) ) { echo '<p>' . __( 'Recommend post', 'tcd-seeed' ) . '3</p>'; }
      break;

    case 'faq_category' :
      if ( $faq_category = get_the_terms( $post_id, 'faq_category' ) ) {
        foreach ( $faq_category as $cats ) {
          printf( '<a href="%s">%s</a>', esc_url( get_edit_term_link( $cats, 'faq_category' ) ), $cats->name );
        }
      }
      break;

    case 'voice_category' :
      if ( $voice_category = get_the_terms( $post_id, 'voice_category' ) ) {
        foreach ( $voice_category as $cats ) {
          printf( '<a href="%s">%s</a>', esc_url( get_edit_term_link( $cats, 'voice_category' ) ), $cats->name );
        }
      }
      break;

    case 'case_study_name' :
      if ( get_post_meta( $post_id, 'case_study_name', true ) ) { echo esc_html(get_post_meta( $post_id, 'case_study_name', true )); }
      break;

    case 'case_study_category' :
      if ( $case_study_category = get_the_terms( $post_id, 'case_study_category' ) ) {
        foreach ( $case_study_category as $cats ) {
          printf( '<a href="%s">%s</a>', esc_url( get_edit_term_link( $cats, 'case_study_category' ) ), $cats->name );
        }
      }
      break;

    case 'short_code' :
      echo "<input type='text' onfocus='this.select();' readonly='readonly' value='[tcd_chart id=" . '"' . esc_attr($post_id) . '"' . "]'>";
      break;

    case 'chart_type' :
      $chart_type = get_post_meta($post_id, 'chart_type', true) ?  get_post_meta($post_id, 'chart_type', true) : 'doughnut';
      if($chart_type == 'bar'){
        $chart_type = 'bar_vertical';
      } elseif($chart_type == 'horizontalBar'){
        $chart_type = 'bar_horizontal';
      }
      echo '<img style="max-width:100px; height:auto;" src="' . esc_url(get_template_directory_uri()) . '/admin/img/chart_' . esc_attr($chart_type) . '.gif" alt="" title="" />';
      break;

    case 'chart_used_page' :
      global $wpdb;
      $sql = "SELECT ID FROM {$wpdb->posts} WHERE post_content LIKE '%[tcd\_chart id=\"%d\"]%' AND ( post_status = 'publish' OR ( post_status != 'trash' AND post_author = %d ) ) ORDER BY ID ASC";
      $results = $wpdb->get_results( $wpdb->prepare( $sql, $post_id, get_current_user_id() ) );
      if($results){
        foreach ( $results as $results ) :
          echo '<p><a href="' . esc_url(get_edit_post_link($results->ID)) . '" target="_blank">' . esc_html($results->ID) . '</a></p>';
        endforeach;
      }
      break;

  }

}
add_action( 'manage_posts_custom_column', 'add_column', 10, 2 ); // For post
add_action( 'manage_pages_custom_column', 'add_column', 10, 2 ); // For page


/**
 * Enable sorting of the ID column
 */
function custom_quick_edit_sortable_columns( $sortable_columns ) {
  $sortable_columns['post_id'] = 'ID';
  return $sortable_columns;
}
//add_filter( 'manage_edit-post_sortable_columns', 'custom_quick_edit_sortable_columns' ); // For post
//add_filter( 'manage_edit-news_sortable_columns', 'custom_quick_edit_sortable_columns' ); // For news
add_filter( 'manage_edit-page_sortable_columns', 'custom_quick_edit_sortable_columns' ); // For page





?>