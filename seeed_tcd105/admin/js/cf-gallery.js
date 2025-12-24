jQuery(document).ready(function($) {

  // モーダル ------------------------------------------------------------------

	var media_frame;
	var cfmf_current;
	var cfmf_target_id;
	var cf_gallery_text_title = 'Select image';
	var cf_gallery_text_select = 'Use this image';

	if (typeof cf_gallery_text == 'object') {
		if (typeof cf_gallery_text.image_title == 'string') {
			cf_gallery_text_title = cf_gallery_text.image_title;
		} else if (typeof cf_gallery_text.title == 'string') {
			cf_gallery_text_title = cf_gallery_text.title;
		}
		if (typeof cf_gallery_text.image_button == 'string') {
			cf_gallery_text_select = cf_gallery_text.image_button;
		} else if (typeof cf_gallery_text.button == 'string') {
			cf_gallery_text_select = cf_gallery_text.button;
		}

	}

	// click event
	$(document).on('click', '.open_gallery_modal', function(e){

		cfmf_current = $(this).find('.cf_gallery_field');
		cfmf_target_id = cfmf_current.find('.cf_media_id').attr('id');

		e.preventDefault();
		if (typeof media_frame != 'undefined') {
			media_frame.close();
		}

		// create and open new file frame
		media_frame = wp.media({
			title: cf_gallery_text_title,
			library: {
				type: 'image'
			},
			button: {
				text: cf_gallery_text_select
			},
			multiple: false,
		});

		media_frame.on('open',function(){
			var selection = media_frame.state().get('selection');
			var selected_media_id = cfmf_current.find('.cf_media_id').val();
			if (selected_media_id) {
				selection.add(wp.media.attachment(selected_media_id));
			}
		});

		// callback for selected image
		media_frame.on('select', function(){
			var selection = media_frame.state().get('selection').first();
			$('#'+cfmf_target_id).val(selection.attributes.id).trigger('change');
			cfmf_current.find('.preview_field').html('<div class="image" style="background:url(' + selection.attributes.url + ') no-repeat center center; background-size:cover;"></div>');
      var item_label = cfmf_current.closest('.gallery_item').data('item-label');
      if(selection.attributes.caption){
				cfmf_current.closest('.gallery_item').find('.gallery_item_headline span').text(selection.attributes.caption);
      } else {
				cfmf_current.closest('.gallery_item').find('.gallery_item_headline span').text(item_label);
      }
			cfmf_current = null;
			cfmf_target_id = null;
		});

		// open
		media_frame.open();
	});


  // 繰り返しフィールド --------------------------------------------------------------

  // アイテムを追加
  var gallery_next_index = $('#gallery_list').find(".gallery_item").last().index();
  $("#add_gallery_item").click(function(){
    var clone = $(this).attr("data-clone");
    var $parent = $(this).closest("#gallery_container");
    if (clone && $parent.length) {
      gallery_next_index++;
      clone = clone.replace(/addindex/g, gallery_next_index);
      $parent.find("#gallery_list").append(clone.replace(/addindex/g, gallery_next_index));
    }
    return false;
  });


  // アイテムの並び替え
  $("#gallery_list").sortable({
    helper: "clone",
    placeholder: "gallery_item_placeholder",
    handle: '.gallery_item_headline',
    forceHelperSize: true,
    forcePlaceholderSize: true,
    tolerance: "pointer",
    beforeStop: function (event, ui) {
      $.each($(ui.helper).find(":input:radio:checked"), function () {
        var radio_id = $(this).attr('id');
        $(ui.item).find("#" + radio_id + "").prop("checked", true);
      });
    }
  });


  // アイテムの削除
  $("#gallery_list").on("click", ".delete_gallery_item", function(){
    var del = true;
    var confirm_message = $(this).closest("#gallery_list").attr("data-delete-confirm");
    if (confirm_message) {
      del = confirm(confirm_message);
    }
    if (del) {
      $(this).closest(".gallery_item").remove();
    }
    return false;
  });


  // １行あたりのアイテム数をギャラリー一覧の横幅に合わせて調整
  $(window).on('load',function(){
    chnage_gallery_item_num($('#gallery_list'));
  });
  $(window).on('resize',function(){
    chnage_gallery_item_num($('#gallery_list'));
  });
  function chnage_gallery_item_num(gallery_list){
    var gallery_list_width = gallery_list.width();
    if(gallery_list_width < 460) {
      gallery_list.removeClass('type2');
      gallery_list.addClass('type3');
    } else if(gallery_list_width < 720) {
      gallery_list.removeClass('type3');
      gallery_list.addClass('type2');
    } else {
      gallery_list.removeClass('type2');
      gallery_list.removeClass('type3');
    }
  }


});