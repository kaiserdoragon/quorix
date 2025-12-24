<?php
     $options = get_design_plus_option();

     if(is_mobile()){
       $post_num = $options['archive_faq_num_sp'];
     } else {
       $post_num = $options['archive_faq_num'];
     }

     $def_offset = $post_num;
     $offset = isset( $_POST['offset_post_num'] ) ? $_POST['offset_post_num'] : $def_offset;
     $post_cat_id = isset( $_POST['post_cat_id'] ) ? $_POST['post_cat_id'] : '';
     $next_load_num = $post_num;
     $posts_per_page = $next_load_num;

     if($post_cat_id){
       $all_query = new WP_Query( array('post_type' => 'faq', 'post_status' => 'publish', 'posts_per_page' => -1, 'orderby' => array('menu_order' => 'ASC', 'date' => 'DESC'), 'tax_query' => array( array( 'taxonomy' => 'faq_category', 'field' => 'term_id', 'terms' => $post_cat_id ) )) );
       $all_post_count = $all_query->found_posts;
       $args = array( 'post_type' => 'faq', 'post_status' => 'publish', 'posts_per_page' => $posts_per_page, 'orderby' => array('menu_order' => 'ASC', 'date' => 'DESC'), 'offset' => $offset, 'tax_query' => array( array( 'taxonomy' => 'faq_category', 'field' => 'term_id', 'terms' => $post_cat_id ) ) );
     } else {
       $all_query = new WP_Query( array('post_type' => 'faq', 'post_status' => 'publish', 'posts_per_page' => -1, 'orderby' => array('menu_order' => 'ASC', 'date' => 'DESC')) );
       $all_post_count = $all_query->found_posts;
       $args = array( 'post_type' => 'faq', 'post_status' => 'publish', 'posts_per_page' => $posts_per_page, 'orderby' => array('menu_order' => 'ASC', 'date' => 'DESC'), 'offset' => $offset );
     }

     $post_list = new wp_query($args);
     if($post_list->have_posts()):
       $entry_item = '';
       ob_start();
       while ( $post_list->have_posts() ) : $post_list->the_post();
?>
   <div class="item ajax_item offset_<?php echo $offset; ?>" style="opacity:0; display:none;">
    <h4 class="question"><span class="icon">Q</span><span class="title"><?php the_title(); ?></span></h4>
    <div class="post_content clearfix">
     <?php the_content(); ?>
    </div>
   </div>
<?php
       endwhile;
       $entry_item .= ob_get_contents();
       ob_end_clean();
     endif;

     wp_send_json( array(
       'html' => $entry_item,
       'remain' => $all_post_count - ( $offset + $post_list->post_count )
     ) );
?>