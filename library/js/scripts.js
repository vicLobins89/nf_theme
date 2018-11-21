/*
 * Scripts File
 * Author: Vic Lobins
 *
*/
var doc = document.documentElement;
doc.setAttribute('data-useragent', navigator.userAgent);

/*
 * Get Viewport Dimensions
*/
function updateViewportDimensions() {
	"use strict";
	var w=window,d=document,e=d.documentElement,g=d.getElementsByTagName('body')[0],x=w.innerWidth||e.clientWidth||g.clientWidth,y=w.innerHeight||e.clientHeight||g.clientHeight;
	return { width:x,height:y };
}
// setting the viewport width
var viewport = updateViewportDimensions();


/*
 * Throttle Resize-triggered Events
*/
var waitForFinalEvent = (function () {
	"use strict";
	var timers = {};
	return function (callback, ms, uniqueId) {
		if (!uniqueId) { uniqueId = "Don't call this twice without a uniqueId"; }
		if (timers[uniqueId]) { clearTimeout (timers[uniqueId]); }
		timers[uniqueId] = setTimeout(callback, ms);
	};
})();
var timeToWaitForLast = 100;


jQuery(document).ready(function($) {
	
	"use strict";
	
	viewport = updateViewportDimensions();
	
	// Menu Functions
	
	$('li.menu-item-has-children > a').on('click', function(e){
		$('li.menu-item-has-children a').not(this).removeClass('active');
		$(this).toggleClass('active');
		e.preventDefault();
	});
  
	$('.menu-button').on('click', function(e){
		$(this).parents('.header').toggleClass('menu-active');
		e.preventDefault();
	});
	
	$('.sub-menu .current-page-ancestor').parent().prev('a').css('color', '#e67410');
	
	
	// Vacancies filter
	
	var cont = $(".vacancies-wrapper"),
		arr = $.makeArray(cont.children(".vacancies")),
		$vacancies = $('.vacancies'),
		$filtersLocation = $('.filter li[data-location]'),
		$filtersType = $('.filter li[data-type]'),
		filterLocation,
		filterType;
	
	
	//// Sorting
	$('select.sort-by').on('change', function() {
		if(this.value === 'new') {
			sortByDate('desc');
		} else {
			sortByDate('asc');
		}
	});
	
	function sortByDate(direction) {
		arr.sort(function(a, b) {
			var textA = +$(a).data('date');
			var textB = +$(b).data('date');
			
			if( direction === 'asc' ) {
				if (textA < textB) { return -1; }
				if (textA > textB) { return 1; }
			} else {
				if (textA < textB) { return 1; }
				if (textA > textB) { return -1; }
			}

			return 0;
		});

		cont.empty();

		$.each(arr, function() {
			cont.append(this);
		});
	}
	
	sortByDate('desc');
	
	
	//// Filtering
	if($vacancies.length) {
		$filtersLocation.on('click', function(){
			$(this).toggleClass('active');
			$filtersLocation.not(this).removeClass('active');
			
			if( $(this).hasClass('active') ) { filterLocation = $(this).data('location'); }
			else { filterLocation = undefined; }
			
			checkFilter(filterLocation, filterType);
		});
		
		$filtersType.on('click', function(){
			$(this).toggleClass('active');
			$filtersType.not(this).removeClass('active');
			
			if( $(this).hasClass('active') ) { filterType = $(this).data('type'); }
			else { filterType = undefined; }
			
			checkFilter(filterLocation, filterType);
		});
	}
	
	function checkFilter(location, type) {	
		var $vacanciesLocations = $('.vacancies[data-location="'+location+'"]');
		var $vacanciesTypes = $('.vacancies[data-type="'+type+'"]');
		
		if( location ) {
			$vacancies.not($vacanciesLocations).hide();
			$vacanciesLocations.show();
			
			if( type ) {
				$vacancies.not($vacanciesTypes).hide();
			}
		} else if( type ) {
			$vacancies.not($vacanciesTypes).hide();
			$vacanciesTypes.show();
			
			if( location ) {
				$vacancies.not($vacanciesLocations).hide();
			}
		} else if ( location === undefined && type === undefined  ) {
			$vacancies.show();
		}
	}
	
	// Slider link
	
	if( $('.metaslider').length ) {
		$('.slides li a').each(function(){
			var link = $(this).attr('href');
			$(this).next().find('h1, span').wrapInner('<a href="'+link+'"></a>');
		});
	}
	
	// Locations
	
	$('.location-cat a').on('click', function(){
		var linkClass = $(this).attr('class');
		if( linkClass === 'agriculture') {
			$('.locations-map .st0').addClass('active');
		} else {
			$('.locations-map .st0').removeClass('active');
			$('.locations-map .'+linkClass).addClass('active');
		}
		
		$('.location-cat a').not(this).parent().removeClass('active');
		$(this).parent().toggleClass('active');
	});
	
	function onLoadAndResize() {
		viewport = updateViewportDimensions();
		
		if( viewport.width < 768 ) {
			$('.socket-nav').detach().addClass('cloned').appendTo( $('.main-nav') );
			$('li.current-menu-parent > a').addClass('active');
		} else {
			$('.socket-nav').detach().prependTo( $('#inner-header') );
			$('.header').removeClass('menu-active');
			
			// Zoom
			$("#zoom_05").elevateZoom({
				zoomType: "inner",
				cursor: "crosshair"
			});
		}
		
		// News page title
		var postDataHeight = $('.post.featured .post-data').outerHeight();
		if( viewport.width >= 768 ) {
			$('.post.featured .post-data').css('margin-bottom', -postDataHeight/2);
			
			//Menu fix
			$('.sub-menu').each(function() {
				var $this = $(this);
				if ($this.find('li').length < 3) {
					$this.find('li').css('width', 50+'%');
					$this.find('img').css('width', 20+'%');
				}
			});
		} else {
			$('.post.featured .post-data').css('margin-bottom', 'auto');
		}
	}
	
	onLoadAndResize();
	
	$(window).resize(function () {
		waitForFinalEvent( function() {
			viewport = updateViewportDimensions();

			onLoadAndResize();

		}, timeToWaitForLast, "mobile-menu-fix");
	});


}); /* end of as page load scripts */