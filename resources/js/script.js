/*jshint jquery:true */
/*global $:true */

var $ = jQuery.noConflict();

$(document).ready(function ($) {
	"use strict";

	/*-------------------------------------------------*/
	/* =  portfolio isotope
	/*-------------------------------------------------*/

	var winDow = $(window);
	// Needed variables
	var $container = $('.portfolio-box, .blog-box, .search-box');
	var $searchContainer = $('.search-box1');
	var $filter = $('.filter');

	try {
		$container.imagesLoaded(function () {
			$container.show();
			$searchContainer.show();
			$container.isotope({
				filter: '*',
				layoutMode: 'fitRows',
				fitRows: {
					equalheight: true
				},
				animationOptions: {
					duration: 750,
					easing: 'linear'
				}
			});

			$searchContainer.isotope({
				filter: '*',
				layoutMode: 'packery',
				animationOptions: {
					duration: 750,
					easing: 'linear'
				}
			});
		});
	} catch (err) {
		console.log(err);
	}

	winDow.bind('resize', function () {
		var selector = $filter.find('a.active').attr('data-filter');

		try {
			$container.isotope({
				filter: selector,
				animationOptions: {
					duration: 750,
					easing: 'linear',
					queue: false,
				}
			});
		} catch (err) {
			console.log(err);
		}

		return false;
	});

	/*-------------------------------------------------*/
	/* =  preloader function
	/*-------------------------------------------------*/
	var body = $('body');
	body.addClass('active');

	winDow.load(function () {
		var mainDiv = $('#container'),
			preloader = $('.preloader');

		preloader.fadeOut(400, function () {
			mainDiv.delay(400).addClass('active');
			body.delay(400).css('background', '#b4b7b8');
		});
	});

	/*-------------------------------------------------*/
	/* =  header height fix
	/*-------------------------------------------------*/
	var content = $('#content');
	content.imagesLoaded(function () {
		var bodyHeight = $(window).outerHeight(),
			containerHeight = $('.inner-content').outerHeight(),
			headerHeight = $('header');

		if (bodyHeight > containerHeight) {
			headerHeight.css('height', bodyHeight);
		} else {
			headerHeight.css('height', containerHeight);
		}
	});

	winDow.bind('resize', function () {
		var bodyHeight = $(window).outerHeight(),
			containerHeight = $('.inner-content').outerHeight(),
			headerHeight = $('header');

		if (bodyHeight > containerHeight) {
			headerHeight.css('height', bodyHeight);
		} else {
			headerHeight.css('height', containerHeight);
		}
	});

	/* ---------------------------------------------------------------------- */
	/*	menu responsive
	/* ---------------------------------------------------------------------- */
	var menuClick = $('a.elemadded'),
		navbarVertical = $('.menu-box');

	menuClick.on('click', function (e) {
		e.preventDefault();

		if (navbarVertical.hasClass('active')) {
			navbarVertical.slideUp(300).removeClass('active');
		} else {
			navbarVertical.slideDown(300).addClass('active');
		}
	});

	winDow.bind('resize', function () {
		if (winDow.width() > 768) {
			navbarVertical.slideDown(300).removeClass('active');
		} else {
			navbarVertical.slideUp(300).removeClass('active');
		}
	});

	var lg = document.getElementById('brochure_gallery');

	try {
		lightGallery(lg, {
			thumbnail: false,
			download: false,
			zoomFromOrigin: true,
			customSlideName: true,
			plugins: [lgZoom, lgHash],
		});

		lg.addEventListener('lgAfterSlide', function (event) {
			const { index, prevIndex } = event.detail;

			ga_send_event('click', 'custom_events', 'swipe_page', index);
		}, false);
	} catch (err) {
		console.log(err);
	}
});

/**
 * @param category
 * @param action
 * @param label
 * @param value
 */
function ga_send_event(action, category, label, value) {
	console.log({
		event: action,
		category: category,
		label: label,
		value: value
	});

	if (window.gtag) {
		gtag('event', action, {
			'event_category': category,
			'event_label': label,
			'value': value
		});
	}
}