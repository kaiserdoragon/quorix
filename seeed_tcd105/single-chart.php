<?php
     get_header();
     $options = get_design_plus_option();
     if ( have_posts() ) : while ( have_posts() ) : the_post();
?>
<div id="chart_check">

 <div class="post_content clearfix">
  <?php echo do_shortcode('[tcd_chart id="' . $post->ID. '"]'); ?>
 </div>

</div><!-- END #chart_check -->
<?php endwhile; endif; ?>

<?php get_footer(); ?>