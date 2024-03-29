$(document).ready(function() {
    $(".vertical-menu").height($("#wrapper").height() + 200);
  $('#pm-addthis').scrollToFixed({ 
	  preFixed: function() { $('.addthis_floating_style').css({ 'opacity':'0.7' }); },
	  postFixed: function() { $('.addthis_floating_style').css({ 'opacity':'1.0' }); }
  });	

  $('#sticky').scrollToFixed();
  $('.sticky_ads').scrollToFixed();


	$('ul.nav li.dropdown').hover(function() {
		$(this).find('.dropdown-menu').stop(true, true).delay(100).fadeIn(50);
	}, function() {
		$(this).find('.dropdown-menu').stop(true, true).delay(100).fadeOut();
	});
  $("#back-top").scrollToFixed( {
	  bottom: 0,
	  limit: 760,
	  zIndex: 9999,
	  preFixed: function() { $(this).css('display','none'); },
	  postFixed: function() { $(this).fadeIn(200); }
  });

  $('.btn')
  .click(function () {
	  var btn = $(this)
	  btn.button('')
	  setTimeout(function () {
		  btn.button('reset')
	  }, 900)
  });
  
  $("input:file").uniform();
});

$(document).ready(function() {
    $("#back-top").click(function() {
      $("body,html").animate({scrollTop:0}, 800);
      return false
    })
});


$(document).ready(function() {
/* iOS touch fix for BootStrap */
$('body').on('touchstart.dropdown', '.dropdown-menu', function (e) { e.stopPropagation(); });
/*
$(document).ready(function(){
        $('#secondary') .css({'height': (($('#wrapper').height()))+'px'});
});*/
$("a.video-thumb").hover(
  function () {
    $(this).addClass("video");
  },
  function () {
    $(this).removeClass("video");
  }
);
//li with fade class
});

$(document).ready(function() {
  $("#lights-overlay").css("height", $(document).height()).hide();
  $(".lightOn").click(function() {
    $("#lights-overlay").toggle();
    if($("#lights-overlay").is(":hidden")) {
      $(this).html(pm_lang.lights_off).removeClass("lightOff")
    }else {
      $(this).html(pm_lang.lights_on).addClass("lightOff")
    }
    return false
  })
});


$(document).ready(function() {
	$("#register-form").validate({
		rules: {
			name: {
				required: true,
				minlength: 2
			},
			username: {
				required: true,
				minlength: 2
			},
			pass: {
				required: true,
				minlength: 5
			},
			confirm_pass: {
				required: true,
				minlength: 5,
				equalTo: "#register-form #pass"
			},
			imagetext: {
				required: true
			},
			email: {
				required: true,
				email: true	
			},
			agree: "required"
		},
		messages: {
			name: {
				required: pm_lang.validate_name,
				minlength: pm_lang.validate_name_long
			},
			username: {
				required: pm_lang.validate_username,
				minlength: pm_lang.validate_username_long
			},
			pass: {
				required: pm_lang.validate_pass, 
				minlength: pm_lang.validate_pass_long
			},
			confirm_pass: {
				required: pm_lang.validate_pass,
				minlength: pm_lang.validate_pass_long,
				equalTo: pm_lang.validate_confirm_pass_long
			},
			imagetext: {
				required: pm_lang.validate_captcha
			},
			email: pm_lang.validate_email,
			agree: pm_lang.validate_agree
		},
		errorClass: "error"
	});
});

$(function() {
	var cc = $.cookie('list_grid');
	if (cc == 'g') {
		$('#pm-grid').addClass('grid');
	} else {
		$('#pm-grid').removeClass('grid');
	}
});
$(document).ready(function() {
	$('#grid').click(function() {
		$('#pm-grid').fadeOut(200, function() {
			$(this).addClass('grid').fadeIn(200);
			$.cookie('list_grid', 'g');
		});
		return false;
	});
	
	$('#list').click(function() {
		$('#pm-grid').fadeOut(200, function() {
			$(this).removeClass('grid').fadeIn(200);
			$.cookie('list_grid', null);
		});
		return false;
	});
});
$('#pm-vc-playlists').click(function() { $('#pm-vc-playlists-content').slideToggle('fast', function() {}); });
$('#pm-vc-report').click(function() { $('#pm-vc-report-content').slideToggle('fast', function() {}); });
$('#pm-vc-share').click(function() { $('#pm-vc-share-content').slideToggle('fast', function() {}); });
$('#pm-vc-embed').click(function() { $('#pm-vc-embed-content').slideToggle('fast', function() {}); });
$('#pm-vc-email').click(function() { $('#pm-vc-email-content').slideToggle('fast', function() { $('#pm-vc-embed-content').slideUp(); }); });
$('#c_comment_txt').click(function() { $('#pm-comment-form').slideDown(); });

$(document).ready(function()
{

	$("li.dropdown-submenu").find("ul.dropdown-menu").css('visibility','hidden');
		$('li.dropdown-submenu').hover(function(){

		$(this).find("ul:first").css('visibility','visible');
		// if ( ! $('ul', this).hasClass('dropdown-menu')) {
		// 	//$('ul', this).stop().delay(700).slideDown('fast');
		// 	$('ul', this).stop().doTimeout( 'hover', 350, 'slideDown', '' );
		// }

	}, function(){
		$(this).find("ul").css('visibility','hidden');

		// if ( ! $('ul', this).hasClass('dropdown-menu')) {
		// 	//$('ul', this).stop().slideUp(150);
		// 	$('ul', this).stop().doTimeout( 'hover', 0, 'slideUp', 200 );
		// }
	});
		
	// $(".pm-browse-ul-subcats ul.hidden_li").hide();

	// $('.pm-browse-ul-subcats li.topcat').hover(function(){
	// 	if ( ! $('ul', this).hasClass('visible_li')) {
	// 		//$('ul', this).stop().delay(700).slideDown('fast');
	// 		$('ul', this).stop().doTimeout( 'hover', 350, 'slideDown', '' );
	// 	}
	// }, function(){
	// 	if ( ! $('ul', this).hasClass('visible_li')) {
	// 		//$('ul', this).stop().slideUp(150);
	// 		$('ul', this).stop().doTimeout( 'hover', 0, 'slideUp', 200 );
	// 	}
	// });

/*	Remove comment to enable drop-downs in the nav menu
	$('ul.nav li.topcat').hover(function(){
		$('ul.hidden_li', this).show();
	}, function(){
		$('ul.hidden_li', this).hide();

	});
*/
});

$('.ajax-modal').click(function(e) {
    e.preventDefault();
    var href = $(e.target).attr('href');
    if (href.indexOf('#') == 0) {
        $(href).modal('open');
    } else {
        $.get(href, function(data) {
            $('<div class="modal" id="uploadForm">' + data + '</div>').modal({keyboard: true});
        });
    }
});
$(document).ready(function() {
$("#to_modal").live('click', function() {
    var url = $(this).attr('url');
    var modal_id = $(this).attr('data-controls-modal');
    $("#" + modal_id).load(url);
  });
});

$('#tags_suggest').tagsInput({
	'removeWithBackspace' : true,
	'height':'auto',
	'width':'auto',
	'defaultText':'',
	'minChars' : 3,
	'maxChars' : 30
});
$('#tags_upload').tagsInput({
	'removeWithBackspace' : true,
	'height':'auto',
	'width':'auto',
	'defaultText':'',
	'minChars' : 3,
	'maxChars' : 30
});


$("[rel=tooltip]").tooltip();
	
$('#myModal').modal({
  keyboard: true,
  show: false
});
$(document).ready(function() {
	var input = document.createElement( 'input' ),
	    comment = jQuery( '#comment' );

	if ( 'placeholder' in input ) {
		comment.attr( 'placeholder', jQuery( '.comment-textarea label' ).remove().text() );
	}

	// Expando Mode: start small, then auto-resize on first click + text length
	jQuery( '#comment-form-identity' ).hide();
	jQuery( '#commentform .form-submit' ).hide();

	comment.css( { 'height':'120px' } ).one( 'focus', function() {
		jQuery( '#comment-form-identity' ).slideDown();
		jQuery( '#commentform .form-submit' ).slideDown();
	});
});

/* language selector */
$(document).ready(function() {
$(".lang_selected").click( 
 function() {
	var submenu = $(".lang_submenu");
	if( submenu.css("display") == "block" )
	{
		submenu.css( "display", "none" );
		$(this).removeClass();
		$(this).addClass("lang_selected");
	}
	else
	{
		submenu.css( "display", "block" );
		$(this).removeClass();
		$(this).addClass("lang_selected_onclick");
	}
 } 
);

$("a[id^='lang_select_']").each(
 function() {
  var id = parseInt( this.name );
  var lang = $('#lang_select_' + id);
  lang.click(
	function()
	{
	 $.post( MELODYURL2+"/index.php", { select_language: 1, lang_id: id }, function() { window.location.reload(); }, '');
	});
 });
});

$(document).ready(function() {
    $("#pm_sources").change(function () {
        var str = $("select option:selected").attr('value');
        $("#pm_sources_ex").text(str);
    })
    .change();
	var $el, $ps, $up, totalHeight;
	$(".text-exp .show-now").click(function() {
	  totalHeight = 0;
	  $el = $(this);
	  $p = $el.parent();
	  $up = $p.parent();
	  $ps = $up.find("p:not('.show-more')");
	  // measure how tall inside should be by adding together heights of all inside paragraphs (except read-more paragraph)
	  $ps.each(function() {
		totalHeight += $(this).outerHeight()
	  });
	  // Set height to prevent instant jumpdown when max height is removed
	  totalHeight += 90;
	  $up.css({"height":$up.height(), "max-height":9999, "overflow-y":"auto"}).animate({"height":totalHeight});
	  $p.fadeOut();
	  return false;
	});
});

$(function() {
	var input = document.createElement("input");
	if(('placeholder' in input)==false) { 
		$('[placeholder]').focus(function() {
			var i = $(this);
			if(i.val() == i.attr('placeholder')) {
				i.val('').removeClass('placeholder');
				if(i.hasClass('password')) {
					i.removeClass('password');
					this.type='password';
				}			
			}
		}).blur(function() {
			var i = $(this);	
			if(i.val() == '' || i.val() == i.attr('placeholder')) {
				if(this.type=='password') {
					i.addClass('password');
					this.type='text';
				}
				i.addClass('placeholder').val(i.attr('placeholder'));
			}
		}).blur().parents('form').submit(function() {
			$(this).find('[placeholder]').each(function() {
				var i = $(this);
				if(i.val() == i.attr('placeholder'))
					i.val('');
			})
		});
	}
});

function SelectAll(id)
{
	document.getElementById(id).focus();
	document.getElementById(id).select();
}
