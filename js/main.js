(function ($) {
	$(document).ready(function () {
		$("body").queryLoader2({
			barColor: "#06c",
			backgroundColor: "#3399cc",
			percentage: true,
			barHeight: 1,
			completeAnimation: "grow",
			minimumTime: 100
		});
	});
	toggle();
	$(window).scroll(function(){
		if ($(this).scrollTop() > 100) {
			$('.scrollup').fadeIn();
		} else {
			$('.scrollup').fadeOut();
		}
	});
	
	$('.scrollup').click(function(){
		$("html, body").animate({ scrollTop: 0 }, 1000);
		return false;
	});
	
	// local scroll
	jQuery('.pageScrollerNav, .page-scroll').localScroll({
		hash:true
		,offset:{top: 0}
		,duration: 1200
		,easing:'easeInOutExpo'
	});

	// fancybox
	jQuery(".fancybox").fancybox({
		padding : 0
		,helpers : {
			overlay : {
				css : {
					'background' : 'rgba(0, 0, 0, 0.9)'
				}
			}
		}
		,beforeShow:function(){
			$(".fancybox-skin").css("backgroundColor","transparent");
		}
	});

	if (Modernizr.mq("screen and (max-width:1024px)")) {
		jQuery("body").toggleClass("body");
	} else {
		var s = skrollr.init({
			mobileDeceleration: 1
			,edgeStrategy: 'set'
			,forceHeight: true
			,smoothScrolling: true
			,smoothScrollingDuration: 300
			,easing: {
				WTF: Math.random
				,inverted: function(p) {
					return 1-p;
				}
			}
		});	
	}

	//scroll menu
	jQuery('.appear').appear();
	jQuery(".appear").on("appear", function(data) {
		var id = $(this).closest("section").attr("id");
		jQuery('.pageScrollerNav li').removeClass('active');
		jQuery(".pageScrollerNav a[href='#" + id + "']").parent().addClass("active");					
	});
	
	$(function(){
		if (typeof(soundManager) != "undefined") {
			soundManager.setup({
				// path to directory containing SM2 SWF
				url: 'js/soundmanager/swf/'
			});

			threeSixtyPlayer.config.scaleFont = (navigator.userAgent.match(/msie/i)?false:true);
			threeSixtyPlayer.config.showHMSTime = true;

			// enable some spectrum stuffs
			threeSixtyPlayer.config.useWaveformData = true;
			threeSixtyPlayer.config.useEQData = true;

			// enable this in SM2 as well, as needed
			if (threeSixtyPlayer.config.useWaveformData) {
			  soundManager.flash9Options.useWaveformData = true;
			}
			if (threeSixtyPlayer.config.useEQData) {
			  soundManager.flash9Options.useEQData = true;
			}
			if (threeSixtyPlayer.config.usePeakData) {
			  soundManager.flash9Options.usePeakData = true;
			}
			if (threeSixtyPlayer.config.useWaveformData || threeSixtyPlayer.flash9Options.useEQData || threeSixtyPlayer.flash9Options.usePeakData) {
			  // even if HTML5 supports MP3, prefer flash so the visualization features can be used.
			  soundManager.preferFlash = true;
			}
			// favicon is expensive CPU-wise, but can be used.
			if (window.location.href.match(/hifi/i)) {
			  threeSixtyPlayer.config.useFavIcon = true;
			}
			if (window.location.href.match(/html5/i)) {
			  // for testing IE 9, etc.
			  soundManager.useHTML5Audio = true;
			}
		}

	});
	
	jQuery(function($) {
		$('#contactForm').on('submit', function(event){
			var $form = $(this);
			var $btn = $('#contactFormSubmit');
			$btn.button('loading');
			$.ajax({
				type:"POST"
				,url:"proceso/contactenos/"
				,data:$form.serialize()
				,dataType:"json"
				,success:function(data){
					if(data.success){
						$.fancybox.close();
						if (data.modal) {
							$("#modal-success-msg").html(data.msg);
							$('#sucessModal').modal('show');
						};
						$form[0].reset();
						//window.location.replace(data.url);
					}
					else{
						$.fancybox.close();
						$("#modal-error-msg").html(data.errors.reason);
						$('#errorModal').modal('show');
					}
				}
			}).always(function(){
				$btn.button('reset');
			});
	 
			event.preventDefault();
		});
	});
	
	
})(jQuery);

function toggle() {

	var $_t = this,
		previewParClosedHeight = 25;

	jQuery("div.toggle.active > p").addClass("preview-active");
	jQuery("div.toggle.active > div.toggle-content").slideDown(400);
	jQuery("div.toggle > label").click(function(e) {

		var parentSection 	= jQuery(this).parent(),
			parentWrapper 	= jQuery(this).parents("div.toogle"),
			previewPar 		= false,
			isAccordion 	= parentWrapper.hasClass("toogle-accordion");

		if(isAccordion && typeof(e.originalEvent) != "undefined") {
			parentWrapper.find("div.toggle.active > label").trigger("click");
		}

		parentSection.toggleClass("active");

		if(parentSection.find("> p").get(0)) {

			previewPar 					= parentSection.find("> p");
			var previewParCurrentHeight = previewPar.css("height");
			var previewParAnimateHeight = previewPar.css("height");
			previewPar.css("height", "auto");
			previewPar.css("height", previewParCurrentHeight);

		}

		var toggleContent = parentSection.find("> div.toggle-content");

		if(parentSection.hasClass("active")) {

			jQuery(previewPar).animate({height: previewParAnimateHeight}, 350, function() {jQuery(this).addClass("preview-active");});
			toggleContent.slideDown(350);

		} else {

			jQuery(previewPar).animate({height: previewParClosedHeight}, 350, function() {jQuery(this).removeClass("preview-active");});
			toggleContent.slideUp(350);

		}

	});
}

