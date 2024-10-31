jQuery(document).ready(function(){
	jQuery('ul.tabs li').click(function(){
	    var tab_id = jQuery(this).attr('data-tab');
	    jQuery('ul.tabs li').removeClass('pafw-current');
	    jQuery('.pafw-tab-content').removeClass('pafw-current');  
	    jQuery(this).addClass('pafw-current');
	    jQuery("#"+tab_id).addClass('pafw-current');
	});

    jQuery('#pafw_date_option').on('change', function() {
        if ( this.value == 'specific_date'){
            jQuery("#pafw_date_hide_show").show(200);
        } else {
            jQuery("#pafw_date_hide_show").hide(200);
        }
    });
    if(jQuery("#pafw_date_option").val() == 'specific_date'){
        jQuery("#pafw_date_hide_show").show();
    }
    if(jQuery("#pafw_date_option").val() == 'no'){
        jQuery("#pafw_date_hide_show").hide();
    }

	jQuery("#datepicker").datepicker({
		inline: true,
		changeMonth: true,
		changeYear: true,
		minDate: 0,
		dateFormat: 'yy-mm-dd',
	});

    jQuery('body').on('click', '.pafw_upload_image_button', function(e) {
        e.preventDefault();
 
        var button = jQuery(this),
        custom_uploader = wp.media({
            title: 'Insert image',
            library : { 
                type : ['image', 'video','pdf','Archive']
            },
            button: {
                text: 'Use this image'
            },
            multiple: false
        }).on('select', function() { 
            var attachment = custom_uploader.state().get('selection').first().toJSON();
            if (jQuery(".pafw_pdf_logo_prvw_image").length == 0) {
                jQuery( "<input type='text' name='pafw_pdf_logo_prvw_image' class='pafw_pdf_logo_prvw_image regular-text' readonly value=''>" ).insertAfter( jQuery( ".pafw_upload_image_main" ) );
            }

            if (jQuery(".pafw_remove_image_button").length == 0) {
                jQuery( '<a href="#" class="pafw_remove_image_button button">Remove Attachment</a>' ).insertAfter( jQuery( ".pafw_upload_image_button" ) );
            }

            jQuery('.pafw_pdf_logo_prvw_image').val(attachment.url);
            jQuery(".pafw_pdf_logo_hidden_img").val(attachment.id);
        })
        .open();
    });

    jQuery('body').on('click', '.pafw_remove_image_button', function(e) {
        e.preventDefault();       
        jQuery('.pafw_pdf_logo_prvw_image').remove();
        jQuery('.pafw_remove_image_button').remove();
        jQuery(".pafw_pdf_logo_hidden_img").val('');
    });

    jQuery('#pafw_select_product').select2({
        ajax: {
            url: ajaxurl,
            dataType: 'json',
            allowClear: true,
            data: function (params) {
                return {
                    q: params.term,
                    action: 'pafw_product_ajax'
                };
            },
            processResults: function( data ) {
                var options = [];
                if ( data ) {
                    jQuery.each( data, function( index, text ) { 
                        options.push( { id: text[0], text: text[1], 'price': text[2]} );
                    });
                }
                return {
                    results: options
                };
            },
            cache: true
        },
        minimumInputLength: 3 
    });

    jQuery('#pafw_select_user_role').select2({
        ajax: {
                url: ajaxurl,
                dataType: 'json',
                delay: true,
                data: function (params) {
                    return {
                        q: params.term,
                        action: 'pafw_roles_ajax'
                    };
                },
                processResults: function( data ) {
                var options = [];
                if ( data ) {
 
                    jQuery.each( data, function( index, text ) {
                        options.push( { id: text[0], text: text[1]} );
                    });
 
                }
                return {
                    results: options
                };
            },
            cache: true
        },
        minimumInputLength: 0
    });

    jQuery('#pafw_select_order_status').select2({
        ajax: {
                url: ajaxurl,
                dataType: 'json',
                delay: true,
                data: function (params) {
                    return {
                        q: params.term,
                        action: 'pafw_order_status_ajax'
                    };
                },
                processResults: function( data ) {
                var options = [];
                if ( data ) {
 
                    jQuery.each( data, function( index, text ) {
                        options.push( { id: text[0], text: text[1]} );
                    });
 
                }
                return {
                    results: options
                };
            },
            cache: true
        },
        minimumInputLength: 0
    });

});