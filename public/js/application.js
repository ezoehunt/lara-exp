// TO DO:
/*
1. Popover trigger: animate the out click in opposite direction of the animation in.
*/

$(document).ready(function () {
	
	// Animate sidenav + bar bottom for default pages
	if ($('body').hasClass('default')) {
		$('div.gs-sidebar').addClass('animated bounceInDown');
		if ($('body').hasClass('home')) {
			$('div.bar-bottom').addClass('animated bounceInUp');
		}
		else if ($('body').hasClass('about')) {
			$('div.bar-bottom').addClass('animated bounceInDown');
		}
	}
	
	$('#main-content').addClass('animated fadeInUpBig');
	
	var logoColor = 'blue';
//	var myTop = true;

	$('[rel=tooltip]').tooltip();
	
	/* SET UP MOBILE SIDEBAR */
	$('[data-toggle=offcanvas]').click(function() {
		$('.row-offcanvas').toggleClass('active');
	});
	
	/* SET UP STELLAR FOR PARALLAX */
	$(window).stellar();

    var links = $('.para-sidenav').find('li');

	// DELETE ?
	var menulinks = $('.nav-members').find('li');;

    slide = $('.slide');
    button = $('.button');
    mywindow = $(window);
    htmlbody = $('html,body');

	// HACK b/c waypoints.js doesnt allow multiple waypoints
	// need to create different up/down offsets
	$('.slide').waypoint(function (event, direction) {
		dataslide = $(this).attr('data-slide');
//		console.log(dataslide + ' ' + direction);

		if (direction === 'down') {
			$('.para-sidenav .active').removeClass('active');
			$('.para-sidenav li[data-slide="' + dataslide + '"]').addClass('active');
			
			
			$('.nav-members .active').removeClass('active');
			$('.nav-members li[data-slide="' + dataslide + '"]').addClass('active');
		}
		event.stopPropagation();
	}, { offset: '30%' }
	);
	$('.slide-wrapper').waypoint(function (event, direction) {
		dataslide = $('.slide', this).attr('data-slide');

		if (direction === 'up') {
			$('.para-sidenav .active').removeClass('active');
			$('.para-sidenav li[data-slide="' + dataslide + '"]').addClass('active');
			
			$('.nav-members .active').removeClass('active');
			$('.nav-members li[data-slide="' + dataslide + '"]').addClass('active');				
		}
	}, { offset: '-1' }
	);
	// Add active class to Slide 1 when scrolling back to top
    mywindow.scroll(function () {
        if (mywindow.scrollTop() == 0) {
            $('.para-sidenav li[data-slide="1"]').addClass('active');
            $('.para-sidenav li[data-slide="2"]').removeClass('active');
        }
    });
	// Scroll function
    function goToByScroll(dataslide) {
		htmlbody.animate({
           scrollTop: $('.slide[data-slide="' + dataslide + '"]').offset().top
		}, 1200, 'easeInOutQuint');		
    }
	// Go to scroll when links internal to parallax are clicked
    links.click(function (e) {
        e.preventDefault();
        dataslide = $(this).attr('data-slide');
        goToByScroll(dataslide);
    });

	// DELETE ?
	menulinks.click(function (e) {
        e.preventDefault();
        dataslide = $(this).attr('data-slide');
        goToByScroll(dataslide);
    });

    button.click(function (e) {
        e.preventDefault();
        dataslide = $(this).attr('data-slide');
        goToByScroll(dataslide);
    });

	
	/* POPOVERS */
	// HACK fixes Bootstrap (bug?) where popup cant be hidden if animation=false. Animation=false is needed to enable animate.css CSS animations.
	$('body').on('hidden.bs.popover', function() {
	  	$('.popover:not(.in)').hide().detach();
	});

	// Popovers start
	$('.testpopover').popover({ 
		// Remove default Bootstrap animation
		animation : false,
		placement : 'auto bottom',
		html 	  :	true,
		content: function() {		
			var content = $(this).data('content-target');
			try { content = $(content).html() } 
			catch(e) {/* Ignore */}
			return content || $(this).data('content') ;
			}
		}).on('shown.bs.popover', function () {
			var $popup = $(this);
			// Get animation out class
			var classOut = $(this).data('class-out');
			// Find closeit button
			$(this).next('.popover').find('button.closeit').click(function (e) {
				// Add animation out class
				$('.popover').addClass(classOut);
				// Remove animation out class + hide popover
				$('.popover').one('webkitAnimationEnd oanimationend msAnimationEnd animationend',   
				function(e) {
					$('.popover').removeClass(classOut);
					$popup.popover('toggle'); // or hide
			});
		});
	});
	// When popover trigger is clicked
	$('.testpopover').on('click', function(e) {
		e.preventDefault();
		// Close other open popups
		$('.testpopover').not(this).popover('hide');
		// Get animation in class
		var classIn = $(this).data("class-in");
		// Add animation in class
		$('.popover').addClass($(this).data("class-in"));
		// Remove animation in class
		$('.popover').one('webkitAnimationEnd oanimationend msAnimationEnd animationend',   
			function(e) {
				$('.popover').removeClass(classIn);
		});
	});

// end ready
});	


$(function() {
	if (Modernizr.history) {
		var newHash      = "",
	        $mainContent = $("#gs-content"),
	        $pageWrap    = $("#gs-guts"),
	        baseHeight   = 0,
	        $el;

	    $pageWrap.height($pageWrap.height());
	    baseHeight = $pageWrap.height() - $mainContent.height();

// DOESNT HAVE ANY EFFECT - GETSCRIPT DOES IT ALL		
		// Bind to document or parent element to make 
		// links internal to dynamic content clickable
		$(document).on("click", ".nav-link a", function() {
//		$('bottom-bar').on("click", ".nav-link a", function(e) {			
			event.preventDefault();
			_href = $(this).attr("href");
			history.pushState(null, null, _href);
			loadContent(_href);
		});
	
		$(window).bind('popstate', function(){			
		// Links internal to dynamic content r not clickable
		// with below
//			_link = location.pathname.replace(/^.*[\\\/]/, ''); //get filename only
//			loadContent(_link);
			
			$.getScript(location.href);
			// Doesnt work well with anchor links
//			$('#main-content').showDown({
//				duration: 800
//			});
	    });
	} // nothing if no history
	
	function loadContent(href) {
		$mainContent.hideUp({
			duration: 500, complete: function() {
			console.log('main content hiding'); 
				$mainContent.hide().load(href + ' #gs-guts', function() {
					// Scroll to top
					$('html,body').animate({scrollTop: 0},500);
					console.log('scrool to top');
					// Show + animate bar
					$('.animateBar').show();
					console.log('animate bar');							
					// Bring in new content
					$mainContent.showDown({
						duration: 500
					});
					console.log('show down content');
				});
			} 
		});
	}
	
});



/*
$(function () {
	var $body           = $("#gs-content"),
	    $nav            = $(".nav-link"),
	    $guts           = $("#gs-guts");

//	$body.fadeIn('slow'); //Set 'body' in your css to "display: none;" for a full page fade in.

	if (history.pushState) {
	    var everPushed  = false;
		console.log('orig push state is ' + everPushed);

	    $nav.click(function () {
	        var toLoad = $(this).attr("href");
			console.log('var toLoad ' + toLoad);
			
	        history.pushState(null, '', toLoad);
			console.log('history push state ' + history.pushState());	
			
	        everPushed = true;
			console.log('after click push state ' + everPushed);	
				
	        loadContent(toLoad);
	        return false;
	    });

	    $(window).bind('popstate', function () {
	        if (everPushed) {
	            $.getScript(location.href);
				console.log('bind popstate ' + everPushed);	
				console.log(location.href);				
	        }
	        everPushed = true;
	    });
	} // otherwise, history is not supported, so nothing fancy here.

	function loadContent(href) {
	    $guts.hide('slow', function () {
			console.log('hide ocontent ');
			
	        $guts.load(href + ' #gs-guts', function () {
				console.log('load ocontent ');		
	            $guts.show('slow');
				console.log('animate ocontent ');		
	        });
	    });
	}
	return false;
});
*/


/* LOAD CONTENT ON LANDING PAGE */
/*
$(function() {
	var newHash      = '',
        $mainContent = $('#gs-content'),
        $pageWrap    = $('#gs-wrap'),
        baseHeight   = 0,
		$el;

    if(Modernizr.history){
		var everPushed  = false;
		
		$pageWrap.height($pageWrap.height());
	    baseHeight = $pageWrap.height() - $mainContent.height();
    	

// For links in guts, bind document rather than element
		$('body').on('click', '.navanimate-link', function() {			

			_href = $(this).attr('href');
			console.log('clicked nav link ' + _href);

			history.pushState(null, null, _href);
			console.log('history push state is ' + history.pushState());

			everPushed = true;
			console.log('push state is ' + everPushed);

	        animateContent(_href);
	        return false;
	    });


		$(window).bind('popstate', function () {
			
			if (everPushed) {
				_link = location.pathname.replace(/^.*[\\\/]/, ''); 
				animateContent(_link);
				
//				$.getScript(location.href);
				console.log('popped ' + everPushed + ' ');
	        }
	        everPushed = true;
		});
		
	} // otherwise history is not supported, so nothing fancy

	function animateContent(href) {	
		$mainContent.hideUp({ 
			duration: 500, complete: function() {
				$mainContent.hide().load(href + ' #gs-guts', function() {
					// Scroll to top
					$('html,body').animate({scrollTop: 0},500);
					// Show + animate bar
					$('.animateBar').show();
					// Bring in new content
					$mainContent.showDown({
						duration: 500
					});
				});
			} 
		});
	}	
});
*/


/*
$(function() {
	var newHash      = '',
        $mainContent = $('#gs-content'),
        $pageWrap    = $('#gs-guts'),
		$el;

    if(Modernizr.history){
		var everPushed  = false;
		
		$('body').on('click', '.nav-link', function() {			
//		$('.nav-link').on('click', function() {				

			_href = $(this).attr('href');
			console.log('clicked nav link ' + _href);

			history.pushState(null, '', _href);
			console.log('history push state is ' + history.pushState());

			everPushed = true;
			console.log('push state is ' + everPushed);

	        replaceContent(_href);
	        return false;
	    });


		$(window).bind('popstate', function () {
			
			if (everPushed) {
				_href = location.pathname.replace(/^.*[\\\/]/, ''); 
				replaceContent(_href);
				
//				$.getScript(location.href);
				console.log('popped ' + everPushed + ' ' + _href);
	        }
	        everPushed = true;
		});
		
	} // otherwise history is not supported, so nothing fancy

	function replaceContent(href) {	
//		$mainContent.hideUp({ 
//			duration: 500, complete: function() {
				$mainContent.load(href + ' #gs-guts', function() {
					// Scroll to top
					$('html,body').animate({scrollTop: 0},500);
					// Bring in new content
					$mainContent.showDown({
						duration: 500
					});
				});
//			} 
//		});
	}	
});
*/




/* 	BETTER FADE IN/OUT  -  http://webmaestro.fr/blog/fade-a-bit-more-nicely-with-showdown-and-hideup/
*/
$(function() {
    'use strict';
	var getUnqueuedOpts = function (opts) {
		return {
			queue: false,
			duration: opts.duration,
			easing: opts.easing
		};
	};
	$.fn.showDown = function (opts) {
		if (!opts) {
			opts = {};
		}
	$(this).hide().css('opacity', 0).slideDown(opts).animate({
		opacity: 1
		}, getUnqueuedOpts(opts));
	};
	$.fn.hideUp = function (opts) {
		if (!opts) {
			opts = {};
	}
	$(this).show().css('opacity', 1).slideUp(opts).animate({
		opacity: 0
		}, getUnqueuedOpts(opts));
	};
});


/* Remove mobile sidebar active class at +768 */
$(window).resize(function(){	
	if ($('.navbar-header').css('display') == 'none' ){
		$('#row-canvas').removeClass('active');
	}
});
