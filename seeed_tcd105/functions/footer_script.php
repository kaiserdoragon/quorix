<?php
     // 共通のスクリプト --------------------------------------------------------------------------
     function footer_common_script(){
       global $post;
       $options = get_design_plus_option();
?>
<?php
     // スマホでhoverエフェクトを無効化する :hoverのcssが読み込まれなくなるため注意 --------------------------------
     if(is_mobile()) {
?>
jQuery(window).bind("pageshow", function(event) {
  if (event.originalEvent.persisted) {
    window.location.reload();
  }
});
var touch = 'ontouchstart' in document.documentElement || navigator.maxTouchPoints > 0 || navigator.msMaxTouchPoints > 0;
if(touch) {
  try {
    for (var si in document.styleSheets) {
      var styleSheet = document.styleSheets[si];
      if (!styleSheet.rules) continue;
      for (var ri = styleSheet.rules.length - 1; ri >= 0; ri--) {
        if (!styleSheet.rules[ri].selectorText) continue;
        if (styleSheet.rules[ri].selectorText.match(':hover')) {
          styleSheet.deleteRule(ri);
        }
      }
    }
  } catch (ex) {}
}
<?php }; ?>

<?php // プラン一覧のスクロール --------------------------------- ?>
(function($) {
  if( $('.design_plan_list_slider.swiper').length ){
    let design_price_list_wrap = new Swiper(".design_plan_list_slider", {
      slidesPerView: "auto",
      freeMode: {
        enabled: true,
        sticky: false,
        momentumBounce: false,
      },
      navigation: {
        nextEl: ".plan_list_button_next",
        prevEl: ".plan_list_button_prev",
      },
      scrollbar: {
        el: ".plan_list_scrollbar",
        hide: false,
        draggable: true,
        dragSize: 200,
      },
      grabCursor: true,
      breakpoints: {
        1060: {
          freeMode: {
            enabled: false,
            sticky: false,
            momentumBounce: false,
          },
        }
      }
    });
  };
})(jQuery);


<?php // メガメニューのカルーセル --------------------------------- ?>
(function($) {

  if( $('.megamenu_post_carousel').length ){
    let megamenu_post_carousel = new Swiper(".megamenu_post_carousel", {
      loop: true,
      speed: 600,
      slidesPerView: 2,
      autoplay: {
        delay: 5000,
        disableOnInteraction: false,
      },
      navigation: {
        nextEl: ".megamenu_carousel_button_next",
        prevEl: ".megamenu_carousel_button_prev",
      },
    });
  };

})(jQuery);

<?php
     // 目次 -------------------------------------
     if( (is_singular('post') && $options['active_toc_post_type_post'] == 'display') || (is_singular('news') && $options['active_toc_post_type_news'] == 'display') || (is_page() && $options['active_toc_post_type_page'] == 'display') ){
       if(!is_front_page()){
         if(is_singular('post') && check_if_toc_only_sidebar()){
           $scroll_trigger = '#single_post_header';
         } elseif(is_singular('news') && check_if_toc_only_sidebar()){
           $scroll_trigger = '#single_news_header';
         } elseif(is_page() && check_if_toc_only_sidebar()){
           $scroll_trigger = '#header';
         } else {
           global $post;
           $content = $post->post_content;
           if ( preg_match( '/<h2.*?>/i', $content, $h2s) ) {
             $scroll_trigger = '#tcd_toc';
           } else {
             $scroll_trigger = '#page_header';
           }
         }
?>
(function($) {
  if( $('#tcd_toc').length || $('.toc_widget_wrap').length ){
    $("<div id='tcd_toc_modal'><div id='close_tcd_toc_modal'></div></div><div id='tcd_toc_modal_overlay'></div><div id='open_tcd_toc_modal'></div>").insertAfter("#container");
    if( $('#tcd_toc').length ){
      $('#tcd_toc').clone().prependTo('#tcd_toc_modal');
      $('#tcd_toc_modal #tcd_toc').attr('id','tcd_toc_modal_content');
    } else {
      $('.toc_widget_wrap').clone().prependTo('#tcd_toc_modal');
      $('#tcd_toc_modal .toc_widget_wrap').removeClass('toc_widget_wrap').attr('id','tcd_toc_modal_content');
    }
    $('body').addClass('using_tcd_toc');
    $(document).on('click', '#open_tcd_toc_modal', function(event){
      $('body').addClass('open_tcd_toc_modal');
    });
    $(document).on('click', '#close_tcd_toc_modal, #tcd_toc_modal_overlay', function(event){
      $('body').removeClass('open_tcd_toc_modal');
    });
    $(window).on('scroll load', function(i) {
      var scTop = $(this).scrollTop();
      var tocTop = $('<?php echo esc_attr($scroll_trigger); ?>').offset().top;
      var tocBottom = tocTop + $('<?php echo esc_attr($scroll_trigger); ?>').innerHeight();
      if ( scTop > tocBottom - 90) {
        $('body').addClass('show_tcd_toc_modal_button');
      } else {
        $('body').removeClass('show_tcd_toc_modal_button');
      }
    });
  }
})(jQuery);
<?php
       };
     }; // 目次ここまで

     // トップページ ------------------------------
     if(is_front_page()) {

       // コンテンツビルダー ------------------------
       if ($options['contents_builder']) :
         $content_count = 1;
         $show_design_carousel = true;
         $show_case_study_list = true;
         $show_blog_list = true;
         $show_news_list = true;
         $contents_builder = $options['contents_builder'];
         foreach($contents_builder as $content) :

           // デザインカルーセル ------------------------
           if ( $content['type'] == 'image_slider' && $content['show_content'] ) {
             $show_design_carousel = false;
             $images = $content['image_slider'];
             $images = $images ? explode( ',', $images ) : array();
             if( !empty( $images ) ){
?>
(function($) {

  if( $('#cb_content_<?php echo $content_count; ?> .cb_image_slider_wrap').length ){
    var slider = $('#cb_content_<?php echo $content_count; ?> .cb_image_slider');
    var item_num = $('#cb_content_<?php echo $content_count; ?> .cb_image_slider .item').length;
    var animation_time = 30 * item_num;
    slider.clone().insertBefore(slider);
    slider.clone().insertAfter(slider);
    $('#cb_content_<?php echo $content_count; ?> .cb_image_slider').css('animation-duration', animation_time + 's');
    $('#cb_content_<?php echo $content_count; ?> .cb_image_slider:nth-child(2)').css('animation-delay', -animation_time  / 1.5 + 's');
    $('#cb_content_<?php echo $content_count; ?> .cb_image_slider:last-child').css('animation-delay', -animation_time / 3 + 's');
  };

})(jQuery);
<?php
             };

           // 事例一覧 ------------------------
           } elseif (  $options['use_case_study'] && ($show_case_study_list == true) && $content['type'] == 'case_study_list' && $content['show_content'] ) {
             $show_case_study_list = false;
?>
(function($) {

  if( $('.cb_case_study_slider').length ){
    let cb_case_study_slider = new Swiper(".cb_case_study_slider", {
      speed: 600,
      slidesPerView: "auto",
      freeMode: {
        enabled: true,
        sticky: false,
        momentumBounce: false,
      },
      pagination: {
        el: '.cb_case_study_slider_pagination',
        clickable: true,
      },
      autoplay: {
        enabled: false,
      },
      breakpoints: {
        800: {
          slidesPerView: 2,
          resistanceRatio: 0,
          freeMode: {
            enabled: false,
            sticky: false,
            momentumBounce: false,
          },
          autoplay: {
            enabled: true,
            delay: 5000,
          },
        },
      }
    });
  }

})(jQuery);
<?php
           // ブログ一覧 ------------------------
           } elseif ( $show_blog_list == true && $content['type'] == 'blog_list' && $content['show_content'] ) {
             $show_blog_list = false;
?>
(function($) {

  if( $('.cb_blog_list_slider').length ){
    let cb_blog_list_slider = new Swiper(".cb_blog_list_slider", {
     slidesPerView: "auto",
     freeMode: {
       enabled: true,
       sticky: false,
       momentumBounce: false,
     }
   });
  }

})(jQuery);
<?php
           // お知らせ一覧 ------------------------
           } elseif ( $show_news_list == true && $content['type'] == 'news_list' && $content['show_content'] ) {
             $show_news_list = false;
?>
(function($) {

  if( $('.cb_news_list_slider').length ){
    let cb_blog_list_slider = new Swiper(".cb_news_list_slider", {
     slidesPerView: "auto",
     freeMode: {
       enabled: true,
       sticky: false,
       momentumBounce: false,
     }
   });
  }

})(jQuery);
<?php
           };
           $content_count++;
         endforeach;
       endif; // END コンテンツビルダーここまで

       // ニュースティッカー
       if($options['show_header_news']){
?>
(function($) {

  if( $('#news_ticker').length ){
    let news_ticker = new Swiper("#news_ticker", {
      loop: true,
      direction: 'vertical',
      slidesPerView: 1,
      speed: 600,
      autoplay: {
        delay: 5000
      }
    });
  }


})(jQuery);
<?php
        };

     };// END トップページ
?>

<?php
     // おすすめ記事ウィジェット --------------------
     if ( (is_single() && is_active_widget(false, false, 'post_slider_widget', true)) || (is_page() && is_active_widget(false, false, 'post_slider_widget', true)) ) {
?>
(function($) {

  if( $('.post_slider_widget .post_slider_wrap').length ){
    let post_slider_widget = new Swiper(".post_slider_widget .post_slider_wrap", {
      loop: true,
      speed: 600,
      autoplay: {
        delay: 5000,
        disableOnInteraction: false,
      },
      pagination: {
        el: '.post_slider_widget_pagination',
        // clickable: true,
      },
    });
  }


})(jQuery);
<?php } ?>

<?php
     // ブログ詳細ページ, お知らせ詳細ページの関連記事 ------------------------------
     if(is_singular('post') || is_singular('news')) {
?>
(function($) {

  if( $('.related_post_carousel').length ){
    let related_post_carousel = new Swiper(".related_post_carousel", {
      slidesPerView: 2,
      resistanceRatio: 0,
      autoplay: {
        enabled: true,
        delay: 5000,
      },
      breakpoints: {
        800: {
          slidesPerView: 3,
        }
      }
    });
  };

})(jQuery);
<?php
     };
?>

<?php
     // ブログ、カテゴリーアーカイブ ------------------------------
     if(is_home() || is_category()) {
?>
(function($) {

  if( $('.category_sort_button_slider').length ){
    let category_sort_button_slider = new Swiper(".category_sort_button_slider", {
      slidesPerView: "auto",
      grabCursor: true,
      resistanceRatio: 0,
      freeMode: {
        enabled: true,
        sticky: true,
      },
      navigation: {
        nextEl: ".category_sort_button_next",
        prevEl: ".category_sort_button_prev",
      },
    });
  };

})(jQuery);
<?php
     };
?>

<?php
     // サービスアーカイブページ -----------------------------------------------------------------------------
     if(is_post_type_archive('service')) {
       if($options['archive_service_list_type'] == 'type1' || $options['archive_service_list_type'] == 'type2'){
?>
(function($) {

  $("#service_icon_list_type1 a, #service_icon_list_type2 a").on('click',function() {
    $(this).parent().siblings().removeClass('active');
    $(this).parent().addClass('active');
    return false;
  });

})(jQuery);
<?php }; }; ?>

<?php
     // サービス詳細ページ --------------------
     if ( is_singular('service') ) {
       $service_image_slider = get_post_meta($post->ID, 'service_image_slider', true);
       if(!empty($service_image_slider)){
?>
(function($) {
  let service_image_carousel = new Swiper("#service_image_carousel_wrap", {
    centeredSlides: false,
    slidesPerView: "auto",
    grabCursor: true,
    freeMode: {
      enabled: false,
      sticky: false,
      momentumBounce: false,
    },
    pagination: {
      el: '#service_image_slider_pagination',
      clickable: true,
    },
    breakpoints: {
      800: {
        freeMode: {
          enabled: true,
          sticky: false,
          momentumBounce: false,
        },
      }
    }
  });
})(jQuery);
<?php
       }

       // 関連記事
       if($options['archive_service_list_type'] == 'type4'){
?>
(function($) {
  if( $('#related_service_slider').length ){
    let related_service_slider = new Swiper("#related_service_slider", {
      speed: 600,
      slidesPerView: 1,
      resistanceRatio: 0,
      autoplay: {
        delay: 5000,
        disableOnInteraction: false,
      },
      pagination: {
        el: '#related_service_slider_pagination',
        clickable: true,
      },
      breakpoints: {
        600: {
          slidesPerView: 2,
        }
      }
    });
  }
})(jQuery);
<?php
       }

     }
?>

<?php
     // 事例カテゴリーページ -------------------------
     if(is_tax('case_study_category')) {
?>
(function($) {
  if( $('#case_study_category_list_slider').length ){
    let case_study_category_list_slider = new Swiper("#case_study_category_list_slider", {
      slidesPerView: "auto",
      freeMode: {
        enabled: true,
        sticky: false,
        momentumBounce: false,
      },
      navigation: {
        nextEl: ".case_study_category_list_next",
        prevEl: ".case_study_category_list_prev",
      },
      breakpoints: {
        1000: {
          resistanceRatio: 0,
          freeMode: {
            enabled: false,
            sticky: false,
            momentumBounce: false,
          },
        }
      }
    });
  }
})(jQuery);
<?php }; ?>

<?php
     // 事例詳細ページ --------------------
     if ( is_singular('case_study') ) {
?>
(function($) {

  if( $('#case_study_slider').length ){
    let case_study_slider = new Swiper("#case_study_slider", {
      speed: 600,
      slidesPerView: 1,
      resistanceRatio: 0,
      autoplay: {
        delay: 5000,
        disableOnInteraction: false,
      },
      pagination: {
        el: '#case_study_slider_pagination',
        clickable: true,
      },
      breakpoints: {
        600: {
          slidesPerView: 2,
        }
      }
    });
  }

<?php
     // カテゴリー一覧
?>
  if( $('#case_study_category_list_slider').length ){
    let case_study_category_list_slider = new Swiper("#case_study_category_list_slider", {
      slidesPerView: "auto",
      freeMode: {
        enabled: true,
        sticky: false,
        momentumBounce: false,
      },
      navigation: {
        nextEl: ".case_study_category_list_next",
        prevEl: ".case_study_category_list_prev",
      },
      breakpoints: {
        1000: {
          resistanceRatio: 0,
          freeMode: {
            enabled: false,
            sticky: false,
            momentumBounce: false,
          },
        }
      }
    });
  }
<?php ?>


})(jQuery);
<?php } ?>

<?php
     // FAQアーカイブページ -----------------------------------------------------------------------------
     if(is_post_type_archive('faq') || is_tax('faq_category')) {
       $ajax_item = 'get_faq_items';
?>
(function($) {

  $("#faq_sort_button a").on('click',function() {
    $(this).siblings().removeClass('active');
    $(this).addClass('active');
    var target_content = $(this).data('filter');
    $(".faq_content").removeClass('active');
    $(target_content).addClass('active');
    var faq_category_id = $(this).data('category-id');
    if(faq_category_id){
      $('.item_list').find('.item').removeClass('animate').removeAttr('style');
      $('.ajax_post_list_wrap').removeClass('active');
      $(faq_category_id).addClass('active');
      $(faq_category_id).find(".item").each(function(i){
        $(this).delay(i * 300).queue(function(next) {
          $(this).addClass('animate');
          next();
        });
      });
    }
    $(window).trigger('resize');
    return false;
  });

  var load_hash_tab = function(){
    if (!location.hash) return;
    var active_button = location.hash;
    $(active_button+"_button").trigger("click");
  };
  load_hash_tab();

  if( $('#faq_sort_button_slider').length ){
    let faq_sort_button_slider = new Swiper("#faq_sort_button_slider", {
      slidesPerView: "auto",
      resistanceRatio: 0,
    });
  };

  <?php
       // AJAXを使って記事をロードする ------------------------
       if(is_mobile()){
         $post_num = $options['archive_faq_num_sp'];
       } else {
         $post_num = $options['archive_faq_num'];
       }
  ?>

  var offsetPost = '',
      catid = '',
      flag = false;

  $(document).on("click", ".entry-more", function() {
    offsetPost = $(this).data('offset-post');
    catid = $(this).data('catid');
    current_button = $(this);
    if (!flag) {
      entry_loading = current_button.closest('.ajax_post_list_wrap').find('.entry-loading');
      item_list = current_button.closest('.ajax_post_list_wrap').find('.item_list');
      current_button.addClass("is-hide");
      entry_loading.addClass("is-show");
      flag = true;
      $.ajax({
        type: "POST",
        url: "<?php echo admin_url( 'admin-ajax.php' ); ?>",
        data: {
          action: '<?php echo esc_attr($ajax_item); ?>',
          offset_post_num: offsetPost,
          post_cat_id: catid
        },
        dataType: 'json'
      }).done(function(data, textStatus, jqXHR) {
        if (data.html) {
          item_list.append(data.html);
          $(".ajax_item",item_list).each(function(i) {
            $(this).css('opacity','0').show();
            $(this).delay(i * 300).queue(function(next) {
              $(this).addClass('animate').fadeIn();
              $(this).removeClass('ajax_item');
              next();
            });
          });
        }
        entry_loading.removeClass("is-show");
        if (data.remain) {
          current_button.removeClass("is-hide");
        }
        offsetPost += <?php echo esc_attr($post_num); ?>;
        current_button.attr('data-offset-post',offsetPost);
        current_button.data('offset-post',offsetPost);
        flag = false;
      }).fail(function(jqXHR, textStatus, errorThrown) {
        entry_loading.removeClass("is-show");
        // console.log('fail loading');
      });
    }
  });

})(jQuery);
<?php }; ?>

<?php
  $menu_name = 'footer-menu'; // メニューのスラッグを指定
  $locations = get_nav_menu_locations();
  $menu = isset($locations[$menu_name]) ? wp_get_nav_menu_object($locations[$menu_name]) : '';
  $menu_items = $menu ? wp_get_nav_menu_items($menu->term_id) : [];
       // メニュー --------------------------------------------
       if (has_nav_menu('footer-menu') && !empty($menu_items)) {
?>
(function($) {

  if( $('#footer_nav').length ){
    let footer_nav = new Swiper("#footer_nav", {
      loop: false,
      centeredSlides: false,
      slidesPerView: "auto",
      grabCursor: true,
      freeMode: {
        enabled: true,
        sticky: false,
        momentumBounce: false,
      },
    });
  };

})(jQuery);
<?php }; ?>

<?php
     // フッター画像スライダー -------------------------------------------------------
     if($options['footer_contact_bg_type'] == 'type1'){
       $images = $options['footer_contact_image_slider'];
       $images = $images ? explode( ',', $images ) : array();
       if( !empty( $images ) ){
?>
(function($) {

  if( $('#footer_image_carousel_wrap').length ){
    var slider = $('.footer_image_carousel');
    var item_num = $('.footer_image_carousel .item').length;
    var animation_time = 30 * item_num;
    slider.clone().insertBefore(slider);
    slider.clone().insertAfter(slider);
    $('.footer_image_carousel').css('animation-duration', animation_time + 's');
    $('.footer_image_carousel:nth-child(2)').css('animation-delay', -animation_time  / 1.5 + 's');
    $('.footer_image_carousel:last-child').css('animation-delay', -animation_time / 3 + 's');
  };

})(jQuery);
<?php
       };
     };
?>

<?php
     }; // END footer common script

     //  ブラウザのスクロールに合わせたアニメーション -----------------------
     function inview_animaton(){
       global $post;
?>

  const targets = document.querySelectorAll('.inview');
  const options = {
    root: null,
    rootMargin: '-100px 0px',
    threshold: 0
  };
  const observer = new IntersectionObserver(intersect, options);
  targets.forEach(target => {
    observer.observe(target);
  });
  function intersect(entries) {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        $(entry.target).addClass('animate');
        $(".item",entry.target).each(function(i){
          $(this).delay(i * 300).queue(function(next) {
            $(this).addClass('animate');
            next();
          });
        });
        observer.unobserve(entry.target);
      }
    });
  }


<?php
     };

     // ロード画面を表示する場合 -----------------------------------------------------------------
     function show_loading_screen(){
       $options = get_design_plus_option();
?>
<script>

<?php footer_common_script(); ?>

function after_load() {
  (function($) {

  $('body').addClass('end_loading');
  setTimeout(function(){
    $('html').addClass('end_loading_show_scroll_bar');
  }, 100);

  setTimeout(function(){
    <?php inview_animaton(); ?>
  }, 1200);

  <?php
       // トップページのヘッダースライダー -----------------------------------
       if(is_front_page()) {
  ?>
  setTimeout(function(){
<?php if($options['index_header_content_catch_animation_type'] == 'type1'){ ?>
    var total_word = $('.typewritter_animation .item').length;
    $('.typewritter_animation .item').each(function(i){
      $(this).delay(i *120).queue(function(next) {
        $(this).addClass('animate');
        if(i == total_word - 1){
          $(this).addClass('last_animate');
          $('#header_slider_wrap').addClass('start_slide');
          setTimeout(function(){
            $('.counter').counterUp({
              delay: 10,
              time: 1000
            });
          },700);
        }
        next();
      });
    });
<?php } else { ?>
    $('#header_slider_wrap').addClass('start_slide');
    setTimeout(function(){
      $('.counter').counterUp({
        delay: 10,
        time: 1000
      });
    },1500);
<?php }; ?>
  }, 1000);
  window.dispatchEvent(new Event('initHeaderSlider'));
  <?php }; ?>

  })( jQuery );
}

(function($) {

  <?php if ( $options['loading_display_time'] == 'type1' && !isset($_COOKIE['first_visit']) ) { ?>
  $.cookie('first_visit', 'on', {
    path:'/'
  });
  <?php }; ?>

  $('#site_loader_overlay').addClass('start_loading');

  <?php if ($options['loading_type'] == 'type5') { ?>

  $('#site_loader_overlay_for_catchphrase').addClass('start_loading');

  setTimeout(function(){
    $('#site_loader_overlay_for_catchphrase').addClass('active');
    $('#site_loader_overlay').addClass('active');
  }, 2000);
  setTimeout(function(){
    after_load();
  }, 5000);

  <?php } else { ?>

  setTimeout(function(){
    after_load();
  }, <?php echo esc_attr($options['loading_time']); ?>);

  <?php }; ?>

})( jQuery );

</script>
<?php
     };

     // ロード画面を表示しない場合 ------------------------------------------------------------------------------------------------------------------
     function no_loading_screen(){
       $options = get_design_plus_option();
?>
<script>

<?php footer_common_script(); ?>

(function($) {

  <?php inview_animaton(); ?>

  <?php
       // トップページのヘッダースライダー -----------------------------------
       if(is_front_page()) {
  ?>
  setTimeout(function(){
<?php if($options['index_header_content_catch_animation_type'] == 'type1'){ ?>
    var total_word = $('.typewritter_animation .item').length;
    $('.typewritter_animation .item').each(function(i){
      $(this).delay(i *120).queue(function(next) {
        $(this).addClass('animate');
        if(i == total_word - 1){
          $(this).addClass('last_animate');
          $('#header_slider_wrap').addClass('start_slide');
          setTimeout(function(){
            $('.counter').counterUp({
              delay: 10,
              time: 1000
            });
          }, 700);
        }
        next();
      });
    });
<?php } else { ?>
  $('#header_slider_wrap').addClass('start_slide');
  setTimeout(function(){
    $('.counter').counterUp({
      delay: 10,
      time: 1000
    });
  }, 1500);
<?php }; ?>
  }, 400);
  window.dispatchEvent(new Event('initHeaderSlider'));
  <?php }; ?>

})( jQuery );

</script>
<?php } ?>