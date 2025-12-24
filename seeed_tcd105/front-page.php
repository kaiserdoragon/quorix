<?php
     $options = get_design_plus_option();
     get_header();
?>
<?php
     // 通常のコンテンツを読み込む ------------------------------------------------------------------------------
     if($options['index_content_type'] == 'type2'){
       if ( have_posts() ) : while ( have_posts() ) : the_post();
       $page_content_width = $options['page_content_width_type'] ?  $options['page_content_width_type'] : 'type1';
       if($page_content_width == 'type2'){
         $page_content_width_size = 'auto';
       } else {
         $page_content_width_size = $options['page_content_width'] . 'px';
       }
?>
<article id="front_page_contents" style="max-width:<?php echo esc_html($page_content_width_size); ?>;<?php if($page_content_width == 'type2'){ echo ' margin:0 !important;'; }; ?>">
 <div class="post_content clearfix">
  <?php
       the_content();
       if ( ! post_password_required() ) {
         custom_wp_link_pages();
       }
  ?>
 </div>
</div><!-- END #page_contents -->
<?php
        endwhile; endif;
     } else {
?>
<div id="content_builder">
<?php
     // コンテンツビルダー
     if ($options['contents_builder']) :
       $content_count = 1;
       $contents_builder = $options['contents_builder'];
       foreach($contents_builder as $content) :

         // デザインカルーセル --------------------------------------------------------------------------------
         if ( $content['type'] == 'image_slider' && $content['show_content'] ) {
           $catch = $content['catch'];
           $desc = $content['desc'];
           $desc_mobile = $content['desc_mobile'];
           $button_label = $content['button_label'];
           $button_url = $content['button_url'];
           $button_target = $content['button_target'];
           $images = $content['image_slider'];
?>
<section class="cb_design_carousel cb_white_bg num<?php echo $content_count; ?>" id="<?php echo 'cb_content_' . $content_count; ?>">

 <?php if($catch || $desc){ ?>
 <div class="design_header cb_design_header">
  <?php if($catch){ ?>
  <h2 class="catch rich_font"><?php echo wp_kses_post(nl2br($catch)); ?></h2>
  <?php }; ?>
  <?php if($desc){ ?>
  <div class="desc">
   <p<?php if($desc_mobile){ echo ' class="pc"'; }; ?>><?php echo wp_kses_post(nl2br($desc)); ?></p>
   <?php if($desc_mobile){ ?>
   <p class="mobile"><?php echo wp_kses_post(nl2br($desc_mobile)); ?></p>
   <?php }; ?>
  </div>
  <?php }; ?>
 </div>
 <?php }; ?>

 <?php
      $images = $images ? explode( ',', $images ) : array();
      if( !empty( $images ) ){
 ?>
 <div class="cb_image_slider_wrap">
  <div class='cb_image_slider'>
   <?php
           foreach( $images as $image_id ):
             $image = wp_get_attachment_image_src( $image_id, 'full' );
             if($image){
               $caption = get_post( $image_id )->post_excerpt ? get_post( $image_id )->post_excerpt : '';
   ?>
   <div class="item">
    <div class="image">
     <img src="<?php echo esc_attr($image[0]); ?>" alt="" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>">
    </div>
    <?php if($caption){ ?>
    <p class="title"><span><?php echo wp_kses_post(nl2br($caption)); ?></span></p>
    <?php }; ?>
   </div>
   <?php
             };
           endforeach;
   ?>
  </div>
 </div>
 <?php }; ?>

 <?php if($button_label && $button_url){ ?>
 <div class="link_button">
  <a class="design_button" href="<?php echo esc_url($button_url); ?>"<?php if($button_target){ echo ' target="_blank"'; }; ?>><?php echo esc_html($button_label); ?></a>
 </div>
 <?php }; ?>

</section><!-- END .cb_design_carousel -->

<?php
         // セールスポイント --------------------------------------------------------------------------------
         } elseif ( $content['type'] == 'selling_point' && $content['show_content'] ) {
           $catch = $content['catch'];
           $desc = $content['desc'];
           $desc_mobile = $content['desc_mobile'];
           $point_label = $content['point_label'];
?>
<section id="<?php echo 'cb_content_' . $content_count; ?>" class="cb_selling_point num<?php echo $content_count; ?><?php if(!$catch && !$desc){ echo ' no_header'; }; ?>">

 <?php if($catch || $desc){ ?>
 <div class="design_header cb_design_header">
  <?php if($catch){ ?>
  <h2 class="catch rich_font"><?php echo wp_kses_post(nl2br($catch)); ?></h2>
  <?php }; ?>
  <?php if($desc){ ?>
  <div class="desc">
   <p<?php if($desc_mobile){ echo ' class="pc"'; }; ?>><?php echo wp_kses_post(nl2br($desc)); ?></p>
   <?php if($desc_mobile){ ?>
   <p class="mobile"><?php echo wp_kses_post(nl2br($desc_mobile)); ?></p>
   <?php }; ?>
  </div>
  <?php }; ?>
 </div>
 <?php }; ?>

 <?php
      // コンテンツ一覧
      $item_list = isset($content['item_list']) ?  $content['item_list'] : '';
      if (!empty($item_list)) {
 ?>
 <div class="sp_content_list">
  <?php
       $point_num = 1;
       $item_num = 1;
       foreach ( $item_list as $key => $value ) :

         $display_left_content = 1;
         $display_right_content = isset($value['display_right_content']) ?  $value['display_right_content'] : '';
  ?>
  <div id="<?php echo 'cb_content_' . $content_count.'_list_'.esc_attr($item_num); ?>" class="sp_content_wrap<?php if($display_left_content == 1 && $display_right_content == 1){ echo ' display_two_content'; }; ?>">
   <?php
         for ( $i = 1; $i <= 2; $i++ ):

         $layout = isset($value['layout'.$i]) ?  $value['layout'.$i] : 'type2';
         $position = isset($value['position'.$i]) ?  $value['position'.$i] : 'type1';
         $catch = isset($value['catch'.$i]) ?  $value['catch'.$i] : '';
         $desc = isset($value['desc'.$i]) ?  $value['desc'.$i] : '';
         $list_button_label = isset($value['button_label'.$i]) ?  $value['button_label'.$i] : '';
         $list_button_url = isset($value['button_url'.$i]) ?  $value['button_url'.$i] : '';
         $list_button_target = isset($value['button_url_target'.$i]) ?  $value['button_url_target'.$i] : '';
         $bg_image = isset($value['bg_image'.$i]) ?  wp_get_attachment_image_src($value['bg_image'.$i], 'full') : '';
         $bg_image_mobile = isset($value['bg_image_mobile'.$i]) ?  wp_get_attachment_image_src($value['bg_image_mobile'.$i], 'full') : '';
         $overlay_color = isset($value['bg_image'.$i.'_overlay_color']) ?  $value['bg_image'.$i.'_overlay_color'] : '#000000';
         $overlay_color = hex2rgb($overlay_color);
         $overlay_color = implode(",",$overlay_color);
         if($value['bg_image'.$i.'_overlay_opacity'] == 'zero'){
           $overlay_opacity = 0;
         } else {
           $overlay_opacity = $value['bg_image'.$i.'_overlay_opacity'];
         }
         $sub_content_type = isset($value['sub_content_type'.$i]) ?  $value['sub_content_type'.$i] : 'type1';
         $image = isset($value['image'.$i]) ?  wp_get_attachment_image_src($value['image'.$i], 'full') : '';
         $chart = isset($value['chart'.$i]) ?  $value['chart'.$i] : '';
         if($i == 1){
           $chart_delay_time = 0;
         } else {
           $chart_delay_time = 600;
         }
   ?>

   <?php if($i == 1 && $display_left_content == 1 || $i == 2 && $display_right_content == 1){ ?>

   <div class="sp_content num<?php echo esc_attr($item_num); ?> layout_<?php echo esc_attr($layout); ?> position_<?php echo esc_attr($position); ?>">

    <div class="sp_content_inner">

     <div class="main_content">
      <div class="mobile_content">
       <?php if($i == 1 && $point_label){ ?>
       <div class="point"><span class="label"><?php echo esc_html($point_label); ?></span><span class="num"><?php echo esc_html($point_num); ?></span></div>
       <?php }; ?>
       <?php if($catch){ ?>
       <h3 class="catch"><?php echo wp_kses_post(nl2br($catch)); ?></h3>
       <?php }; ?>
      </div>
      <?php if($desc){ ?>
      <p class="desc"><?php echo wp_kses_post(nl2br($desc)); ?></p>
      <?php }; ?>
      <?php if($list_button_label && $list_button_url){ ?>
      <a class="design_button" href="<?php echo esc_url($list_button_url); ?>"<?php if($list_button_target){ echo ' target="_blank"'; }; ?>><?php echo esc_html($list_button_label); ?></a>
      <?php }; ?>
     </div>

     <?php if($layout == 'type2'){ ?>
     <div class="sub_content">
      <?php if($sub_content_type == 'type1'){ ?>
      <div class="image">
       <?php if($image) { ?>
       <img src="<?php echo esc_attr($image[0]); ?>" alt="" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>">
       <?php }; ?>
      </div>
      <?php } else { ?>
      <div class="chart">
       <?php if($chart) { echo do_shortcode('[tcd_chart id="' . esc_attr($chart) . '" delay="' . $chart_delay_time . '"]'); }; ?>
      </div>
      <?php }; ?>
     </div>
     <?php }; ?>

     <div class="switch mobile"></div>

    </div><!-- END .sp_content_inner -->

    <div class="switch pc"></div>

    <?php if($layout == 'type1'){ ?>
    <?php if($overlay_color) { ?>
    <div class="overlay" style="background:rgba(<?php echo esc_attr($overlay_color); ?>,<?php echo esc_attr($overlay_opacity); ?>);"></div>
    <?php }; ?>
    <?php if($bg_image) { ?>
    <img class="bg_image<?php if($bg_image_mobile) { echo ' pc'; }; ?>" src="<?php echo esc_attr($bg_image[0]); ?>" alt="" width="<?php echo esc_attr($bg_image[1]); ?>" height="<?php echo esc_attr($bg_image[2]); ?>">
    <?php if($bg_image_mobile) { ?>
    <img class="bg_image mobile" src="<?php echo esc_attr($bg_image_mobile[0]); ?>" alt="" width="<?php echo esc_attr($bg_image_mobile[1]); ?>" height="<?php echo esc_attr($bg_image_mobile[2]); ?>">
    <?php }; ?>
    <?php }; ?>
    <?php }; ?>

   </div><!-- END .sp_content -->

   <?php }; ?>

   <?php
         $item_num++;
         endfor;
   ?>
  </div><!-- END .sp_content_wrap -->
  <?php
         $point_num++;
       endforeach;
  ?>
 </div><!-- END .sp_content_list -->
 <?php }; ?>

</section><!-- END .cb_selling_point -->

<?php
         // サービス一覧 --------------------------------------------------------------------------------
         } elseif ( $content['type'] == 'service_list' && $content['show_content']  && $options['use_service']) {
           $catch = $content['catch'];
           $desc = $content['desc'];
           $desc_mobile = $content['desc_mobile'];
           $button_label = $content['button_label'];
?>
<section class="cb_service_list cb_white_bg num<?php echo $content_count; ?>" id="<?php echo 'cb_content_' . $content_count; ?>">

 <?php if($catch || $desc){ ?>
 <div class="design_header cb_design_header">
  <?php if($catch){ ?>
  <h2 class="catch rich_font"><?php echo wp_kses_post(nl2br($catch)); ?></h2>
  <?php }; ?>
  <?php if($desc){ ?>
  <div class="desc">
   <p<?php if($desc_mobile){ echo ' class="pc"'; }; ?>><?php echo wp_kses_post(nl2br($desc)); ?></p>
   <?php if($desc_mobile){ ?>
   <p class="mobile"><?php echo wp_kses_post(nl2br($desc_mobile)); ?></p>
   <?php }; ?>
  </div>
  <?php }; ?>
 </div>
 <?php }; ?>

 <?php
      // アイコン一覧
      if($options['archive_service_list_type'] != 'type4'){
        if(is_mobile()){
          $post_num = $content['post_num_sp'];
        } else {
          $post_num = $content['post_num'];
        };
        $args = array('post_type' => 'service', 'posts_per_page' => $post_num, 'ignore_sticky_posts' => 1, 'orderby' => array('menu_order' => 'ASC', 'date' => 'DESC'));
        $post_list = new wp_query($args);
        if($post_list->have_posts()):
          $total = $post_list->post_count;
 ?>

 <?php if($options['service_icon_list_type'] == 'type1'){ ?>

 <ul id="service_icon_list_type1"<?php if($total < 5){ echo ' class="short_size"'; }; ?>>
  <?php
       while ($post_list->have_posts()) : $post_list->the_post();
         $post_id = $post->ID;
         $icon = get_post_meta($post->ID, 'service_icon', true);
         $icon_image = get_post_meta($post->ID, 'service_icon_image', true);
         $icon_image = wp_get_attachment_image_src($icon_image, 'full');
         $title = get_post_meta($post->ID, 'service_sub_title', true) ?  get_post_meta($post->ID, 'service_sub_title', true) : get_the_title();
  ?>
  <li>
   <a href="<?php the_permalink(); ?>">
    <?php if($icon_image) { ?>
    <div class="icon"><img loading="lazy" src="<?php echo esc_attr($icon_image[0]); ?>" alt="" width="<?php echo esc_attr($icon_image[1]); ?>" height="<?php echo esc_attr($icon_image[2]); ?>"></div>
    <?php } else { ?>
    <?php if($icon){ ?><div class="icon"><span>&#x<?php echo esc_attr($icon); ?>;</span></div><?php }; ?>
    <?php }; ?>
    <p class="catch"><span><?php echo wp_kses_post(nl2br($title)); ?></span></p>
   </a>
  </li>
  <?php endwhile; ?>
 </ul>

 <?php } else { ?>

 <ul id="service_icon_list_type2"<?php if($total < 7){ echo ' class="short_size"'; }; ?>>
  <?php
       while ($post_list->have_posts()) : $post_list->the_post();
         $post_id = $post->ID;
         $icon = get_post_meta($post->ID, 'service_icon', true);
         $icon_image = get_post_meta($post->ID, 'service_icon_image', true);
         $icon_image = wp_get_attachment_image_src($icon_image, 'full');
         $title = get_post_meta($post->ID, 'service_sub_title', true) ?  get_post_meta($post->ID, 'service_sub_title', true) : get_the_title();
  ?>
  <li>
   <a href="<?php the_permalink(); ?>">
    <?php if($icon_image) { ?>
    <div class="icon"><img loading="lazy" src="<?php echo esc_attr($icon_image[0]); ?>" alt="" width="<?php echo esc_attr($icon_image[1]); ?>" height="<?php echo esc_attr($icon_image[2]); ?>"></div>
    <?php } else { ?>
    <?php if($icon){ ?><div class="icon"><span>&#x<?php echo esc_attr($icon); ?>;</span></div><?php }; ?>
    <?php }; ?>
    <p class="title"><?php echo wp_kses_post(nl2br($title)); ?></p>
   </a>
  </li>
  <?php endwhile; ?>
 </ul>

 <?php }; ?>

 <?php endif; wp_reset_query(); ?>

 <?php
      // 通常記事一覧
      } else {
        if(is_mobile()){
          $post_num = $content['post_num_sp'];
        } else {
          $post_num = $content['post_num'];
        };
        $args = array('post_type' => 'service', 'posts_per_page' => $post_num, 'ignore_sticky_posts' => 1, 'orderby' => array('menu_order' => 'ASC', 'date' => 'DESC'));
        $post_list = new wp_query($args);
        if($post_list->have_posts()):
 ?>
 <div id="service_list_type2">
  <?php
       while ($post_list->have_posts()) : $post_list->the_post();
         if(has_post_thumbnail()) {
           $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size3' );
         } elseif($options['no_image']) {
           $image = wp_get_attachment_image_src( $options['no_image'], 'full' );
         } else {
           $image = array();
           $image[0] = get_bloginfo('template_url') . "/img/no_image2.gif";
           $image[1] = '480';
           $image[2] = '300';
         }
         $desc = get_post_meta($post->ID, 'service_desc', true) ?  get_post_meta($post->ID, 'service_desc', true) : trim_excerpt(200);
  ?>
  <div class="item" id="service_post<?php echo esc_attr($post->ID); ?>">
   <a class="image_link animate_background" href="<?php the_permalink(); ?>">
    <div class="image_wrap">
     <img loading="lazy" class="image" src="<?php echo esc_attr($image[0]); ?>" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" />
    </div>
   </a>
   <div class="content">
    <h3 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
    <p class="desc"><span><?php echo wp_kses_post(nl2br($desc)); ?></span></p>
    <a class="link" href="<?php the_permalink(); ?>"><?php _e( 'View more', 'tcd-seeed' ); ?></a>
   </div>
  </div>
  <?php endwhile; ?>
 </div><!-- END .service_list_type2 -->
 <?php
        endif; wp_reset_query();
      };
 ?>

 <?php if($button_label){ ?>
 <div class="link_button">
  <a class="design_button" href="<?php echo esc_url(get_post_type_archive_link('service')); ?>"><?php echo esc_html($button_label); ?></a>
 </div>
 <?php }; ?>

</section><!-- END .cb_service_category -->

<?php
         // 事例一覧 --------------------------------------------------------------------------------
         } elseif ( $content['type'] == 'case_study_list' && $content['show_content']  && $options['use_case_study']) {
           $catch = $content['catch'];
           $desc = $content['desc'];
           $desc_mobile = $content['desc_mobile'];
           $button_label = $content['button_label'];
?>
<section class="cb_case_study_list cb_white_bg num<?php echo $content_count; ?>" id="<?php echo 'cb_content_' . $content_count; ?>">

 <?php if($catch || $desc){ ?>
 <div class="design_header cb_design_header">
  <?php if($catch){ ?>
  <h2 class="catch rich_font"><?php echo wp_kses_post(nl2br($catch)); ?></h2>
  <?php }; ?>
  <?php if($desc){ ?>
  <div class="desc">
   <p<?php if($desc_mobile){ echo ' class="pc"'; }; ?>><?php echo wp_kses_post(nl2br($desc)); ?></p>
   <?php if($desc_mobile){ ?>
   <p class="mobile"><?php echo wp_kses_post(nl2br($desc_mobile)); ?></p>
   <?php }; ?>
  </div>
  <?php }; ?>
 </div>
 <?php }; ?>

 <?php
      if(is_mobile()){
        $post_num = $content['post_num_sp'];
      } else {
        $post_num = $content['post_num'];
      };
      $args = array('post_type' => 'case_study', 'posts_per_page' => $post_num, 'ignore_sticky_posts' => 1, 'orderby' => array('menu_order' => 'ASC', 'date' => 'DESC'));
      $post_list = new wp_query($args);
      if($post_list->have_posts()):
        $total = $post_list->post_count;
 ?>
 <div class="cb_case_study_slider_wrap<?php if($total == 1){ echo ' one_item'; }; ?>">
  <div class="cb_case_study_slider<?php if ($options['case_study_show_date'] == 'display'){ echo ' show_date'; }; ?> swiper">
   <div class="case_study_list<?php if ($options['case_study_show_date'] == 'display'){ echo ' show_date'; }; ?> swiper-wrapper">
  <?php
       while ($post_list->have_posts()) : $post_list->the_post();
         if(has_post_thumbnail()) {
           $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size4' );
         } elseif($options['no_image']) {
           $image = wp_get_attachment_image_src( $options['no_image'], 'full' );
         } else {
           $image = array();
           $image[0] = get_bloginfo('template_url') . "/img/no_image2.gif";
           $image[1] = '515';
           $image[2] = '320';
         }
         $name = get_post_meta($post->ID, 'case_study_name', true);
         $job = get_post_meta($post->ID, 'case_study_job', true);
  ?>
  <div class="item swiper-slide">
   <a class="animate_background" href="<?php the_permalink(); ?>">
    <div class="title_area">
     <?php if ($options['case_study_show_date'] == 'display'){ ?>
     <time class="date entry-date published" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time>
     <?php }; ?>
     <h4 class="title"><span><?php the_title(); ?></span></h4>
    </div>
    <div class="image_wrap">
     <img loading="lazy" class="image" src="<?php echo esc_attr($image[0]); ?>" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" />
    </div>
    <?php if($job || $name){ ?>
    <div class="meta">
     <ul>
      <?php if($job){ ?><li class="job"><?php echo esc_html($job); ?></li><?php }; ?>
      <?php if($name){ ?><li class="name"><?php echo esc_html($name); ?></li><?php }; ?>
     </ul>
    </div>
    <?php }; ?>
   </a>
   <?php
        $category = wp_get_post_terms( $post->ID, 'case_study_category' , array( 'orderby' => 'term_order' ));
        if ( $category && ! is_wp_error($category) ) {
          foreach ( $category as $cat ) :
            $cat_name = $cat->name;
            $cat_id = $cat->term_id;
            break;
          endforeach;
   ?>
   <a class="category case_cat_id<?php echo esc_attr($cat_id); ?>" href="<?php echo esc_url(get_term_link($cat_id,'case_study_category')); ?>"><?php echo esc_html($cat_name); ?></a>
   <?php }; ?>
  </div>
  <?php endwhile; ?>
   </div><!-- END .case_study_list -->
  </div><!-- END .case_study_list_slider -->
 </div><!-- END .case_study_list_slider_wrap -->
 <div class="cb_case_study_slider_pagination swiper-pagination"></div>
 <?php endif; wp_reset_query(); ?>

 <?php if($button_label){ ?>
 <div class="link_button">
  <a class="design_button" href="<?php echo esc_url(get_post_type_archive_link('case_study')); ?>"><?php echo esc_html($button_label); ?></a>
 </div>
 <?php }; ?>

</section><!-- END .cb_case_study_list -->

<?php
         // ブログ記事一覧 --------------------------------------------------------------------------------
         } elseif ( $content['type'] == 'blog_list' && $content['show_content'] ) {
           $catch = $content['catch'];
           $desc = $content['desc'];
           $desc_mobile = $content['desc_mobile'];
           $button_label = $content['button_label'];
?>
<section class="cb_blog_list cb_white_bg num<?php echo $content_count; ?>" id="<?php echo 'cb_content_' . $content_count; ?>">

 <?php if($catch || $desc){ ?>
 <div class="design_header cb_design_header">
  <?php if($catch){ ?>
  <h2 class="catch rich_font"><?php echo wp_kses_post(nl2br($catch)); ?></h2>
  <?php }; ?>
  <?php if($desc){ ?>
  <div class="desc">
   <p<?php if($desc_mobile){ echo ' class="pc"'; }; ?>><?php echo wp_kses_post(nl2br($desc)); ?></p>
   <?php if($desc_mobile){ ?>
   <p class="mobile"><?php echo wp_kses_post(nl2br($desc_mobile)); ?></p>
   <?php }; ?>
  </div>
  <?php }; ?>
 </div>
 <?php }; ?>

 <?php
      if(is_mobile()){
        $post_num = $content['post_num_sp'];
      } else {
        $post_num = $content['post_num'];
      };
      $post_type = $content['post_type'] ? $content['post_type'] : 'recent_post';
      $post_order = $content['post_order'] ? $content['post_order'] : 'date';
      if($post_type == 'recent_post') {
        $args = array('post_type' => 'post', 'posts_per_page' => $post_num, 'ignore_sticky_posts' => 1, 'orderby' => $post_order);
      } else {
        $args = array('post_type' => 'post', 'posts_per_page' => $post_num, 'ignore_sticky_posts' => 1, 'orderby' => $post_order, 'meta_key' => $post_type, 'meta_value' => 'on');
      }
      $post_list = new wp_query($args);
      if($post_list->have_posts()):
 ?>
 <div class="cb_blog_list_slider_wrap">
  <div class="cb_blog_list_slider swiper">
   <div class="blog_list swiper-wrapper">
    <?php
         while ($post_list->have_posts()) : $post_list->the_post();
           if(has_post_thumbnail()) {
             $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size2' );
           } elseif($options['no_image']) {
             $image = wp_get_attachment_image_src( $options['no_image'], 'full' );
           } else {
             $image = array();
             $image[0] = get_bloginfo('template_url') . "/img/no_image2.gif";
             $image[1] = '720';
             $image[2] = '460';
           }
    ?>
    <div class="item swiper-slide">
     <a class="image_link animate_background" href="<?php the_permalink(); ?>">
      <div class="image_wrap">
       <img loading="lazy" class="image" src="<?php echo esc_attr($image[0]); ?>" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" />
      </div>
     </a>
     <?php
          if(!is_category()) {
            $category = wp_get_post_terms( $post->ID, 'category' , array( 'orderby' => 'term_order' ));
            if ( $category && ! is_wp_error($category) ) {
              foreach ( $category as $cat ) :
                $cat_name = $cat->name;
                $cat_id = $cat->term_id;
                break;
              endforeach;
     ?>
     <a class="category_button" href="<?php echo esc_url(get_term_link($cat_id,'category')); ?>"><?php echo esc_html($cat_name); ?></a>
     <?php
            };
          };
     ?>
     <div class="content">
      <h4 class="title"><a href="<?php the_permalink(); ?>"><span><?php the_title(); ?></span></a></h4>
      <?php if ($options['blog_show_date'] == 'display'){ ?>
      <time class="date entry-date published" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time>
      <?php }; ?>
     </div>
    </div>
    <?php endwhile; ?>
   </div><!-- END .blog_list -->
  </div><!-- END .cb_blog_list_slider -->
 </div><!-- END .cb_blog_list_slider_wrap -->
 <?php endif; wp_reset_query(); ?>

 <?php if($button_label){ ?>
 <div class="link_button">
  <a class="design_button" href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>"><?php echo esc_html($button_label); ?></a>
 </div>
 <?php }; ?>

</section><!-- END .cb_blog_list -->

<?php
         // お知らせ記事一覧 --------------------------------------------------------------------------------
         } elseif ( $content['type'] == 'news_list' && $content['show_content'] && $options['use_news']) {
           $catch = $content['catch'];
           $desc = $content['desc'];
           $desc_mobile = $content['desc_mobile'];
           $button_label = $content['button_label'];
?>
<section class="cb_news_list cb_white_bg num<?php echo $content_count; ?>" id="<?php echo 'cb_content_' . $content_count; ?>">

 <?php if($catch || $desc){ ?>
 <div class="design_header cb_design_header">
  <?php if($catch){ ?>
  <h2 class="catch rich_font"><?php echo wp_kses_post(nl2br($catch)); ?></h2>
  <?php }; ?>
  <?php if($desc){ ?>
  <div class="desc">
   <p<?php if($desc_mobile){ echo ' class="pc"'; }; ?>><?php echo wp_kses_post(nl2br($desc)); ?></p>
   <?php if($desc_mobile){ ?>
   <p class="mobile"><?php echo wp_kses_post(nl2br($desc_mobile)); ?></p>
   <?php }; ?>
  </div>
  <?php }; ?>
 </div>
 <?php }; ?>

 <?php
      if(is_mobile()){
        $post_num = $content['post_num_sp'];
      } else {
        $post_num = $content['post_num'];
      };
      $args = array('post_type' => 'news', 'posts_per_page' => $post_num, 'ignore_sticky_posts' => 1);
      $post_list = new wp_query($args);
      if($post_list->have_posts()):
 ?>
 <div class="cb_news_list_slider_wrap">
  <div class="cb_news_list_slider swiper">
   <div class="news_list swiper-wrapper">
    <?php
         while ($post_list->have_posts()) : $post_list->the_post();
           if($options['news_show_image'] == 'display'){
             if(has_post_thumbnail()) {
               $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size1' );
             } elseif($options['no_image']) {
               $image = wp_get_attachment_image_src( $options['no_image'], 'full' );
             } else {
               $image = array();
               $image[0] = get_bloginfo('template_url') . "/img/no_image1.gif";
               $image[1] = '210';
               $image[2] = '210';
             }
           };
    ?>
    <div class="item swiper-slide">
     <?php if($options['news_show_image'] == 'display'){ ?>
     <a class="image_link animate_background" href="<?php the_permalink(); ?>">
      <div class="image_wrap">
       <img loading="lazy" class="image" src="<?php echo esc_attr($image[0]); ?>" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" />
      </div>
     </a>
     <?php }; ?>
     <div class="content">
      <time class="date entry-date published" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time>
      <h4 class="title"><a href="<?php the_permalink(); ?>"><span><?php the_title(); ?></span></a></h4>
     </div>
    </div>
    <?php endwhile; ?>
   </div><!-- END .news_list -->
  </div><!-- END .cb_news_list_slider -->
 </div><!-- END .cb_news_list_slider_wrap -->
 <?php endif; wp_reset_query(); ?>

 <?php if($button_label){ ?>
 <div class="link_button">
  <a class="design_button" href="<?php echo esc_url(get_post_type_archive_link('news')); ?>"><?php echo esc_html($button_label); ?></a>
 </div>
 <?php }; ?>

</section><!-- END .cb_blog_list -->

<?php
         // フリースペース -----------------------------------------------------
         } elseif ( $content['type'] == 'free_space' && $content['show_content'] ) {
           $catch = $content['catch'];
           $desc = $content['desc'];
           $desc_mobile = $content['desc_mobile'];
           $bg_color = $content['bg_color'] ?  $content['bg_color'] : '#ffffff';
?>
<section class="cb_free_space num<?php echo $content_count; ?><?php if($bg_color == '#ffffff'){ echo ' cb_white_bg'; }; if($content['content_width'] == 'type2'){ echo ' wide_content'; }; ?>" id="<?php echo 'cb_content_' . $content_count; ?>"<?php echo ' style="background:' . esc_attr($bg_color) . ';"'; ?>>

 <?php if($catch || $desc){ ?>
 <div class="design_header cb_design_header">
  <?php if($catch){ ?>
  <h2 class="catch rich_font"><?php echo wp_kses_post(nl2br($catch)); ?></h2>
  <?php }; ?>
  <?php if($desc){ ?>
  <div class="desc">
   <p<?php if($desc_mobile){ echo ' class="pc"'; }; ?>><?php echo wp_kses_post(nl2br($desc)); ?></p>
   <?php if($desc_mobile){ ?>
   <p class="mobile"><?php echo wp_kses_post(nl2br($desc_mobile)); ?></p>
   <?php }; ?>
  </div>
  <?php }; ?>
 </div>
 <?php }; ?>

 <?php if($content['free_space']){ ?>
 <div class="post_content clearfix">
  <?php echo apply_filters('the_content', $content['free_space'] ); ?>
 </div>
 <?php }; ?>

</section><!-- END .cb_free_space -->
<?php
         };
       $content_count++;
       endforeach;
     endif;

// コンテンツビルダーここまで
?>
</div><!-- END #content_builder -->
<?php
      }; // END index_content_type
?>

<?php get_footer(); ?>