(function($) {
	
    // add to cart modal
    var product_info = null;
    jQuery('body').bind('adding_to_cart', function( button, data , data2 ) {
        product_info = data;
        apus_product_id =  data.data('product_id');
    });

    jQuery('body').bind('added_to_cart', function( fragments, cart_hash ){
        if( apus_product_id ){
            var imgtodrag = $('[data-product-id="'+apus_product_id+'"] .image img').eq(0);
            var cart =  $('#cart');
            if (imgtodrag) {
                var imgclone = imgtodrag.clone()
                    .offset({
                    top: product_info.offset().top-imgtodrag.height(),
                    left: product_info.offset().left
                })
                .css({
                    'opacity': '0.8',
                        'position': 'absolute',
                        'height': '150px',
                        'width': 'auto',
                        'z-index': '100000'
                })
                .appendTo($('body'))
                .animate({
                    'top': cart.offset().top + 10,
                        'left': cart.offset().left + 10,
                        'width': 75,
                        'height': 75
                }, 1000);
            
              	setTimeout(function () {
              		$('.mini-cart').click();
                    cart.stop().animate({'margin-left':10},100).animate( {'margin-left':-10}, 200 ).animate( {'margin-left':0}, 100);

                }, 1500);
            
                imgclone.animate({
                    'width': 0,
                    'height': 0
                }, function () {
                    $(this).detach()
                });
            }
            $("html, body").stop().animate({ scrollTop:  cart.offset().top-50  }, "slow");
        }
    });

	// Ajax QuickView
	jQuery(document).ready(function(){
		jQuery('a.quickview').click(function (e) {
			e.preventDefault();
			var self = $(this);
			self.parent().parent().parent().addClass('loading');
		    var productslug = jQuery(this).data('productslug');
		    var url = goral_ajax.ajaxurl + '?action=goral_quickview_product&productslug=' + productslug;
		    
	    	jQuery.get(url,function(data,status){
		    	$.magnificPopup.open({
					mainClass: 'apus-mfp-zoom-in',
					items    : {
						src : data,
						type: 'inline'
					}
				});
				// variation
                if ( typeof wc_add_to_cart_variation_params !== 'undefined' ) {
                    $( '.variations_form' ).each( function() {
                        $( this ).wc_variation_form().find('.variations select:eq(0)').change();
                    });
                }
                var config = {
                    loop: false,
                    nav: true,
                    dots: false,
                    items: 1,
                    navText: ['<span class="fa fa-angle-left"></span>', '<span class="fa fa-angle-right"></span>'],
                    responsive: {
	                    0:{
	                        items: 1
	                    },
	                    320:{
	                        items: 1
	                    },
	                    768:{
	                        items: 1
	                    },
	                    980:{
	                        items: 1
	                    },
	                    1280:{
	                        items: 1
	                    }
	                }
                };
                $(".quickview-owl").owlCarousel( config );
                
				self.parent().parent().parent().removeClass('loading');
		    });
		});
	});
	
	// thumb image
	$('.lite-carousel-play .thumb-link').each(function(e){
		$(this).hover(function(event){
			event.preventDefault();
			var src = $(this).data('image');
			$('.woocommerce-main-image').attr('href', src);
			$('.woocommerce-main-image').find('img').attr('src', src);
			
			$('.lite-carousel-play .thumb-link').removeClass('active');
			$(this).addClass('active');
			return false;
		});
	});

	$('.user_photo .owl-carousel').each(function(){
        var owl = $(this);
        owl.on('changed.owl.carousel', function(event) {
            setTimeout(function(){
                var index = 0;
                $('.owl-item', owl).each(function(i){
                    if ($(this).hasClass('active')) {
                        index = i;
                    }
                });
                $('.user_photo_thumbs li').removeClass('active');
                $('.user_photo_thumbs li').eq(index).addClass('active');

            }, 30);
        });
    });
	$('.user_photo_thumbs li').each(function(index){
		$(this).click(function(e){
			e.preventDefault();
			$('.user_photo .owl-carousel').trigger('to.owl.carousel', [index,0,true]);
			$('.user_photo_thumbs li').removeClass('active');
			$(this).addClass('active');
		});
	});

	// review
    $('.woocommerce-review-link').click(function(){
        $('.woocommerce-tabs a[href=#tabs-list-reviews]').click();
        $('html, body').animate({
            scrollTop: $("#reviews").offset().top
        }, 1000);
        return false;
    });
    
    if ( $('.comment-form-rating').length > 0 ) {
        var $star = $('.comment-form-rating .filled');
        var $review = $('#rating');
        $star.find('li').on('mouseover',
            function () {
                $(this).nextAll().find('span').removeClass('fa-star').addClass('fa-star-o');
                $(this).prevAll().find('span').removeClass('fa-star-o').addClass('fa-star');
                $(this).find('span').removeClass('fa-star-o').addClass('fa-star');
                $review.val($(this).index() + 1);
            }
        );
    }

    // accessories
    var goralAccessories = {
    	init: function() {
    		var self = this;
    		// check box click
    		$('body').on('click', '.accessoriesproducts .accessory-add-product', function() {
    			self.change_event();
			});
			// check all
			self.check_all_items();
    		// add to cart
    		self.add_to_cart();
    	},
    	add_to_cart: function() {
    		var self = this;
    		$('body').on('click', '.add-all-items-to-cart:not(.loading)', function(e){
    			e.preventDefault();
    			var self_this = $(this);
    			self_this.addClass('loading');
				var all_product_ids = self.get_checked_product_ids();

				if( all_product_ids.length === 0 ) {
					var msg = goral_woo.empty;
				} else {
					for (var i = 0; i < all_product_ids.length; i++ ) {
						$.ajax({
							type: "POST",
							async: false,
							url: goral_ajax.ajaxurl,
							data: {
								'product_id': all_product_ids[i],
								'action': 'woocommerce_add_to_cart'
							},
							success : function( response ) {
								self.refresh_fragments( response );
							}
						});
					}
					var msg = goral_woo.success;
				}
				$( '.goral-wc-message' ).html(msg);
				self_this.removeClass('loading');
			});
    	},
    	change_event: function() {
    		var self = this;
    		$('.accessoriesproducts-wrapper').addClass('loading');
			var total_price = self.get_total_price();
			$.ajax({
				type: "POST",
				async: false,
				url: goral_ajax.ajaxurl,
				data: { 'action': "goral_get_total_price", 'data': total_price  },
				success : function( response ) {
					$( 'span.total-price .amount' ).html( response );
					$( 'span.product-count' ).html( self.product_count() );

					var product_ids = self.get_unchecked_product_ids();
					$( '.accessoriesproducts .list-v2' ).each(function() {
						$(this).parent().removeClass('is-disable');
						for (var i = 0; i < product_ids.length; i++ ) {
							if( $(this).hasClass( 'list-v2-'+product_ids[i] ) ) {
								$(this).parent().addClass('is-disable');
							}
						}
					});
				}
			});
			$('.accessoriesproducts-wrapper').removeClass('loading');
    	},
    	check_all_items: function() {
    		var self = this;
    		$('.check-all-items').click(function(){
    			$('.accessory-add-product:checkbox').not(this).prop('checked', this.checked);
    			if ($(this).is(":checked")) {
					$('.accessory-add-product:checkbox').prop('checked', true);  
				} else {
					$('.accessory-add-product:checkbox').prop("checked", false);
				}

				self.change_event();
    		});
    	},
    	// count product
    	product_count: function(){
			var pcount = 0;
			$('.accessoriesproducts .accessory-add-product').each(function() {
				if ($(this).is(':checked')) {
					pcount++;
				}
			});
			return pcount;
		},
		// get total price
		get_total_price(){
			var tprice = 0;
			$('.accessoriesproducts .accessory-add-product').each(function() {
				if( $(this).is(':checked') ) {
					tprice += parseFloat( $(this).data( 'price' ) );
				}
			});
			return tprice;
		},
		// get checked product ids
		get_checked_product_ids: function(){
			var pids = [];
			$('.accessoriesproducts .accessory-add-product').each(function() {
				if( $(this).is(':checked') ) {
					pids.push( $(this).data( 'id' ) );
				}
			});
			return pids;
		},
		// get unchecked product ids
		get_unchecked_product_ids(){
			var pids = [];
			$('.accessoriesproducts .accessory-add-product').each(function() {
				if( ! $(this).is(':checked') ) {
					pids.push( $(this).data( 'id' ) );
				}
			});
			return pids;
		},
		refresh_fragments: function( response ){
			var frags = response.fragments;

			// Block fragments class
			if ( frags ) {
				$.each( frags, function( key ) {
					$( key ).addClass( 'updating' );
				});
			}
			if ( frags ) {
				$.each( frags, function( key, value ) {
					$( key ).replaceWith( value );
				});
			}
		}
    }
    goralAccessories.init();

})(jQuery)