'use strict';

(function ($) {

	/**
	 * Add 'mobile' class on Responsive Mode
	 * @type {Window}
	 */

	 $(window).on('load resize', function () {
		var viewportWidth = $(window).width();
		
		var siteHeader = $('.site-header');

		var isMobile = siteHeader.hasClass('mobile');

		
		if (viewportWidth < 1008) {
			if (!isMobile) {
				siteHeader.addClass('mobile');
				$('body').addClass('mobile');
			}
		} else {
			if (isMobile) {
				siteHeader.removeClass('mobile');
				$('body').removeClass('mobile');
			}
		}
	});



	 
	$(document).ready(function() {

		/**
		 * AOS Animate Init
		 */
		$(document).imagesLoaded(function () {
			AOS.init($('body').hasClass('aos_disabled') ? {disable: 'mobile'} : {});
		});

		// add custom CSS for mobile padding & margin
		var custom_css = '';
		$('.vc_row, .vc_column-inner').each(function(){
			var item_class = $(this).attr('class');
			var item_id = '';
			item_class = item_class.split(' ');
			for(var i = 0; i < item_class.length; i++){
				if(item_class[i].indexOf('vc_custom_') >= 0){
					item_id = '.' + item_class[i];
				}
			}
			
			if(item_id != ''){
				if($(this).attr('data-mobile-padding')){
					custom_css += '.mobile ' + item_id + '{padding: ' + $(this).attr('data-mobile-padding') + ' !important}';
				}
				
				if($(this).attr('data-mobile-margin')){
					custom_css += '.mobile ' + item_id + '{margin: ' + $(this).attr('data-mobile-margin') + ' !important}';
				}
			}
			
		});

		if (custom_css != '') {
			var style = document.createElement('style');
			style.type = 'text/css';
			style.innerHTML = custom_css;
			document.getElementsByTagName('head')[0].appendChild(style);
		}


		/**
		 * Sticky Menu
		 * @type {Window}
		 */

		var stickyNavigation = $('.main__menu').length > 0 ? $('.main__menu').offset().top : 0; 
		var cloneHeader = $("<div>", {
			class: "clone-header"
		})
		$(cloneHeader).insertBefore(".main__menu");
		var navigationHeight = $('.main__menu').outerHeight(true);
		/**
		 * Compare scrollTop position to add .sticky class
		 */
		var felis_need_add_sticky = function(){
			var scrollTop = $(window).scrollTop();
			if (scrollTop - stickyNavigation > 750 && $("body").hasClass("sticky-enabled")) {
				// $(cloneHeader).insertBefore(".main__menu");
				$(cloneHeader).css('height', navigationHeight);
				$('.main__menu').addClass('sticky');
				$('body').addClass('sticky__active');
				// $('.main__menu').fadeIn(300, 'linear');
			}
			else if (scrollTop - stickyNavigation <= navigationHeight + 5  && $("body").hasClass("sticky-enabled")) {
				// $(cloneHeader).remove();		
				$(cloneHeader).css('height', 0);		
				$('.main__menu').removeClass('sticky');
				$('body').removeClass('sticky__active');
				// $('.mmain__menu').css('display', '');
				$('.main__menu').removeClass('max-top');
				// $('.main__menu').fadeOut(300, 'linear');
			}
			if (scrollTop <= navigationHeight + 15){
				$('.main__menu').addClass('max-top');
			}
		}

		/**
		 * Detect scrolling up or down, to add .sticky class
		 */
		var stickyNav = function () {
			if ( typeof stickyNav.x == 'undefined' ) {
				stickyNav.x = window.pageXOffset;
				stickyNav.y = window.pageYOffset;
			};

			var diffX = stickyNav.x - window.pageXOffset;
			var diffY = stickyNav.y - window.pageYOffset;


			if(diffX < 0) {
				// Scroll right
			}else if( diffX > 0 ) {
				// Scroll left
			}else if( diffY < 0 ) {
				// Scroll down
				if($('body').hasClass('sticky-style-2')){
					$('.main__menu').removeClass('sticky');
					$('body').removeClass('sticky__active');
					// $('.clone-header').remove();
					$('.clone-header').css('height', 0);
					// $('.main__menu').css('display', '');
					$('.main__menu').removeClass('max-top')

				} else {
					felis_need_add_sticky();
				}
			}else if( diffY > 0 ) {
				// Scroll up				

				felis_need_add_sticky();
			}else {
				// First scroll event
			}

			stickyNav.x = window.pageXOffset;
			stickyNav.y = window.pageYOffset;
		};

		if($('body').hasClass('sticky-enabled')){
			$(window).on('scroll', function () {
				stickyNav();
			});
		}
		

		$('.main-menu-search .open-search-main-menu').on('click', function() {
		   var $this = jQuery(this);
			if ($this.hasClass('search-open')) {
				$this.parents('.main-menu-search').find('.search-main-menu').removeClass('active');
				setTimeout(function() {
					$this.parents('.navbar-default').find('.search-main-menu').find('input[type="text"]').blur();
				}, 200);
				$this.removeClass('search-open');
			} else {
				$this.parents('.main-menu-search').find('.search-main-menu').addClass('active');
				setTimeout(function() {
					$this.parents('.main-menu-search').find('.search-main-menu').find('input[type="text"]').focus();
				}, 200);
				$this.addClass('search-open');
			};
		});
		$(document).on("touchend click", function(e) {
		  if (!$(e.target).hasClass('open-search-main-menu') && !$(e.target).closest('.search-main-menu').hasClass('active')) {
				$('.open-search-main-menu').removeClass('search-open');
				$('.search-main-menu').removeClass('active');
		  }
		});
		/*grid*/
		var Shuffle = window.shuffle;

		var C_grid = function(element) {
			this.element = element;

			// Log out events.
			this.addShuffleEventListeners();

			this.shuffle = new Shuffle(element, {
				itemSelector: '.grid-item',
				sizer: element.querySelector('.sizer-element'),
			});

			this._activeFilters = [];

			this.addFilterButtons();
			this.addSorting();
			this.addSearchFilter();

			this.mode = 'exclusive';
		};

		C_grid.prototype.toArray = function(arrayLike) {
			return Array.prototype.slice.call(arrayLike);
		};

		C_grid.prototype.toggleMode = function() {
			if (this.mode === 'additive') {
				this.mode = 'exclusive';
			} else {
				this.mode = 'additive';
			}
		};

		/**
		 * Shuffle uses the CustomEvent constructor to dispatch events. You can listen
		 * for them like you normally would (with jQuery for example). The extra event
		 * data is in the `detail` property.
		 */
		C_grid.prototype.addShuffleEventListeners = function() {
			var handler = function(event) {
				// console.log('type: %s', event.type, 'detail:', event.detail);
			};

			this.element.addEventListener(Shuffle.EventType.LAYOUT, handler, false);
			this.element.addEventListener(Shuffle.EventType.REMOVED, handler, false);
		};

		C_grid.prototype.addFilterButtons = function() {
			var options = jQuery('.filter-options', jQuery(this.element).closest('.c-grid')).get(0) /*document.querySelector('.filter-options')*/ ;

			if (!options) {
				return;
			}

			var filterButtons = this.toArray(
				options.children
			);

			filterButtons.forEach(function(button) {
				button.addEventListener('click', this._handleFilterClick.bind(this), false);
			}, this);
		};

		C_grid.prototype._handleFilterClick = function(evt) {
			var btn = evt.currentTarget;
			var isActive = btn.classList.contains('active');
			var btnGroup = btn.getAttribute('data-group');

			// You don't need _both_ of these modes. This is only for the C_grid.

			// For this custom 'additive' mode in the C_grid, clicking on filter buttons
			// doesn't remove any other filters.
			if (this.mode === 'additive') {
				// If this button is already active, remove it from the list of filters.
				if (isActive) {
					this._activeFilters.splice(this._activeFilters.indexOf(btnGroup));
				} else {
					this._activeFilters.push(btnGroup);
				}

				btn.classList.toggle('active');

				// Filter elements
				this.shuffle.filter(this._activeFilters);

				// 'exclusive' mode lets only one filter button be active at a time.
			} else {
				this._removeActiveClassFromChildren(btn.parentNode);

				var filterGroup;
				if (isActive) {
					btn.classList.remove('active');
					filterGroup = Shuffle.ALL_ITEMS;
				} else {
					btn.classList.add('active');
					filterGroup = btnGroup;
				}

				this.shuffle.filter(filterGroup);
			}
		};

		C_grid.prototype._removeActiveClassFromChildren = function(parent) {
			var children = parent.children;
			for (var i = children.length - 1; i >= 0; i--) {
				children[i].classList.remove('active');
			}
		};

		C_grid.prototype.addSorting = function() {
			var menu = jQuery('.sort-options', jQuery(this.element).closest('.c-grid')).get(0) /*document.querySelector('.sort-options')*/ ;

			if (!menu) {
				return;
			}

			menu.addEventListener('change', this._handleSortChange.bind(this));
		};

		C_grid.prototype._handleSortChange = function(evt) {
			var value = evt.target.value;
			var options = {};

			function sortByDate(element) {
				return element.getAttribute('data-created');
			}

			function sortByTitle(element) {
				return element.getAttribute('data-title').toLowerCase();
			}

			if (value === 'date-created') {
				options = {
					reverse: true,
					by: sortByDate,
				};
			} else if (value === 'title') {
				options = {
					by: sortByTitle,
				};
			}

			this.shuffle.sort(options);
		};

		// Advanced filtering
		C_grid.prototype.addSearchFilter = function() {
			var searchInput = jQuery('.js-shuffle-search', jQuery(this.element).closest('.c-grid')).get(0) /*document.querySelector('.js-shuffle-search')*/ ;

			if (!searchInput) {
				return;
			}

			searchInput.addEventListener('keyup', this._handleSearchKeyup.bind(this));
		};

		/**
		 * Filter the shuffle instance by items with a title that matches the search input.
		 * @param {Event} evt Event object.
		 */
		C_grid.prototype._handleSearchKeyup = function(evt) {
			var searchText = evt.target.value.toLowerCase();

			this.shuffle.filter(function(element, shuffle) {

				// If there is a current filter applied, ignore elements that don't match it.
				if (shuffle.group !== Shuffle.ALL_ITEMS) {
					// Get the item's groups.
					var groups = JSON.parse(element.getAttribute('data-groups'));
					var isElementInCurrentGroup = groups.indexOf(shuffle.group) !== -1;

					// Only search elements in the current group
					if (!isElementInCurrentGroup) {
						return false;
					}
				}
				var titleElement = element.querySelector('.grid-item__title');
				if (titleElement != undefined || titleElement != null) { /*add new function 22/5*/
					var titleText = titleElement.textContent.toLowerCase().trim();

					return titleText.indexOf(searchText) !== -1;
				}

			});
		};

		$('.c-thumb-inner ').imagesLoaded( function() {
			// C_grid.layout()
		// jQuery(document).imagesLoaded(function () {

			var __Shuffle = document.getElementsByClassName('c-grid__wrap');
			// console.log(__Shuffle);
			if (__Shuffle != null) {
				for (var i = 0; i < __Shuffle.length; i++) {
					new C_grid(__Shuffle[i]);
					// console.log(__Shuffle);
				}
			}
		});

		/*menu off-canvas*/

		jQuery(".off-canvas ul > li.menu-item-has-children").addClass("hiden-sub-canvas");
		jQuery(".off-canvas ul >li.menu-item-has-children").append('<i class="fa fa-caret-right" aria-hidden="true"></i>');
		var menu_open = $('.menu_icon__open');
		var menu_close = $('.menu_icon__close');
		var menu_slide = $('.off-canvas');
		// var
		menu_open.on('click',function () {   
			menu_open.addClass("active");
			menu_slide.addClass("active");
			$('body').addClass('open_canvas');
		});
		menu_close.on('click',function () {
			menu_open.removeClass("active");
			menu_slide.removeClass('active');
			$('body').removeClass('open_canvas');
		});
		$(".off-canvas ul >li.menu-item-has-children > i").on('click', function() {
			var $this = $(this).parent("li");
			$this.toggleClass("active").children("ul").slideToggle();
			return false;
		});
		$(document).on(" touchend click", function(e) {
		  if (!$(e.target).hasClass('menu_icon__open') && !$(e.target).closest('.off-canvas').hasClass('active')) {
			menu_slide.removeClass('active');
			menu_open.removeClass("active");
			$('body').removeClass('open_canvas');
		  }
		});
		// });

		// accordion 
		jQuery(".c-accordions_wrap ul.accordions_list li.has-child").append('<i class="icon ion-ios-plus-empty"></i>');
		$(".accordion-target").on('click', function(event) {
			event.preventDefault();
			/* Act on the event */
			$(this).parent('li.has-child').toggleClass("active").children(".c-accordions_content").slideToggle(300);
			return false;
		});
		// tooltip-bootstrap
		$('[data-toggle="tooltip"]').tooltip();
		// check all check box
		$("#checkall").click(function() {
			$('.c-checkall-wrap input:checkbox').not(this).prop('checked', this.checked);
		});
		/*menu icon*/
		var btn__menu = $('.c-hamburger')
		btn__menu.on('click', function() {
			$this = $(this);
			$this.toggleClass('active');
		});
		/* end menu icon*/

		/*Swipebox fix multi video autoplay*/

		var autoplaySlide = function() {
		var $slider = jQuery('#swipebox-slider');
		var $slide = $slider.children('.slide.current');

		var $iframe = $slide.find('iframe');
		if ( $iframe.length > 0 ) {
			if ( $iframe.attr('src').indexOf('youtu') >= 0 ) {
				if ( $iframe.attr('src').indexOf('autoplay=') >= 0 ) {
					$iframe.attr('src', function() { return jQuery(this).attr('src').replace('autoplay=0', 'autoplay=1'); });
				}else{
					$iframe.attr('src', function() { return jQuery(this).attr('src') + '&autoplay=1' });
				}
			}
		}

		// Stop other slides
		$slider.children('.slide').not('.current').each(function() {
				var $iframe = jQuery(this).find('iframe');

				if ( $iframe.length > 0 && $iframe.attr('src').indexOf('youtu') >= 0 ) {
					if ( $iframe.attr('src').indexOf('autoplay=') >= 0 ) {
						$iframe.attr('src', function() { return jQuery(this).attr('src').replace('autoplay=1', 'autoplay=0'); });
					}else{
						$iframe.attr('src', function() { return jQuery(this).attr('src') + '&autoplay=0' });
					}
				}
			});
		};


		/*Swipebox*/
		$( '.swipebox' ).swipebox();
		$( '.swipebox-video' ).swipebox( {autoplayVideos: false, // This function is broken, we're doing our own
		nextSlide : autoplaySlide,
		prevSlide : autoplaySlide,
		afterOpen : autoplaySlide} );


		/*Testimonials*/
			/*js Testimonials move to shortcode*/
		/*end Testimonials*/

		/*slider*/

		$('.c-slider__inner').on('init', function(e, slick) {
            var $firstAnimatingElements = $('div.c-slider_item:first-child').find('[data-animation]');
            doAnimations($firstAnimatingElements);
        });
        $('.c-slider__inner').on('beforeChange', function(e, slick, currentSlide, nextSlide) {
            var $animatingElements = $('div.c-slider_item[data-slick-index="' + nextSlide + '"]').find('[data-animation]');
            doAnimations($animatingElements);
        });

        jQuery(".c-slider__inner").each(function() {
            var $this = $(this);
            var style = $this.parents(".c-slider_wrap").attr('data-style');
            var slide_item = $this.parents(".c-slider_wrap").data('count');
            var scroll_item = slide_item;
            var rows_item = $this.parents(".c-slider_wrap").data('rows');
            var fade = $this.parents(".c-slider_wrap").data('fade');
            var dots = $this.parents(".c-slider_wrap").data('dots');
            var arrows = $this.parents(".c-slider_wrap").data('arrows');
            var check_rtl = (jQuery("body").css('direction') === "rtl");
            var autoplay = $this.parents(".c-slider_wrap").data('autoplay');
            if (slide_item <= 1 || slide_item == '') {
                $this.slick({
                    dots: dots ? true : false,
                    autoplay: autoplay ? true : false,
                    arrows: arrows ? true : false,
                    speed: 1500,
                    autoplaySpeed: 5000,
                    slidesToShow: slide_item,
                    fade: fade ? true : false,
                    infinite: true,
                    slidesToScroll: scroll_item,
                    rtl: check_rtl,
                    responsive: [{
                        breakpoint: 992,
                        settings: {
                            dots:false,
                            arrows:false,
                        }
                    }],
                    customPaging : function(slider, i) {
                        var thumb = jQuery(slider.$slides[i]).data();
                        // return '<a>'+(i+1)+'</a>'; // <-- old
                        return '<button>'+('0'+(i+1)).slice(-2)+'</button>'; // <-- new
                    }
                });
            } else if (slide_item >= 2 && slide_item <= 3) {
                $this.slick({
                    autoplay: autoplay ? true : false,
                    dots: dots ? true : false,
                    arrows: arrows ? true : false,
                    speed: 300,
                    slidesToShow: slide_item,
                    infinite: true,
                    slidesToScroll: scroll_item,
                    rows:rows_item ? rows_item : 1,
                    rtl: check_rtl,
                    responsive: [{
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2,
                            rows:1,
                        }
                    }, {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            rows:1,
                            dots: true,
                        }
                    },{
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            rows:1,
                            dots: false,
                        }
                    }]
                });
            } else {
                $this.slick({
                    autoplay: autoplay ? true : false,
                    dots: dots ? true : false,
                    arrows: arrows ? true : false,
                    speed: 300,
                    slidesToShow:slide_item,
                    infinite: true,
                    slidesToScroll: scroll_item,
                    rows:rows_item ? rows_item : 1,
                    rtl: check_rtl,
                    // slidesPerRow
                    responsive: [{
                        breakpoint: 1400,
                        settings: {
                            autoplay: autoplay ? true : false,
                            slidesToShow: 3,
                            slidesToScroll: 3,
                            infinite: true,
                            dots: dots ? true : false,
                        }
                    }, {
                        breakpoint: 1200,
                        settings: {
                            autoplay: autoplay ? true : false,
                            slidesToShow: 2,
                            slidesToScroll: 2,
                            infinite: true,
                            dots: dots ? true : false,
                        }
                    }, {
                        breakpoint: 992,
                        settings: {
                            autoplay: autoplay ? true : false,
                            slidesToShow: 2,
                            slidesToScroll: 2,
                            rows:1,
                            dots: dots ? true : false,
                        }
                    }, {
                        breakpoint: 768,
                        settings: {
                            autoplay: autoplay ? true : false,
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            rows:1,
                            dots: true,
                        }
                    },{
                        breakpoint: 600,
                        settings: {
                            autoplay: autoplay ? true : false,
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            rows:1,
                            dots: false,
                        }
                    }]
                });
            }
        });

		function doAnimations(elements) {
			var animationEndEvents = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
			elements.each(function() {
				var $this = $(this);
				var $animationDelay = $this.data('delay');
				var $animationType = 'animated ' + $this.data('animation');
				$this.css({
					'animation-delay': $animationDelay,
					'-webkit-animation-delay': $animationDelay
				});
				$this.addClass($animationType).one(animationEndEvents, function() {
					$this.removeClass($animationType);
				});
			});
		}
		
		/*end-slider*/

		/*woo*/
	   
		
		function felis_updated_cart_totals(elements) {
			jQuery('.quantity').each(function() {
				var spinner = jQuery(this),
					input = spinner.find('input[type="number"]'),
					btnUp = spinner.find('.quantity-up'),
					btnDown = spinner.find('.quantity-down'),
					min = input.attr('min'),
					max = input.attr('max');
				btnUp.click(function() {
					var oldValue = parseFloat(input.val());
					if (max == undefined || max == '' || oldValue < max) {
						var newVal = oldValue + 1;
					} else if (oldValue >= max) {
						var newVal = oldValue;
					}
					spinner.find("input").val(newVal);
					spinner.find("input").trigger("change");
				});

				btnDown.click(function() {
					var oldValue = parseFloat(input.val());
					if (oldValue <= min) {
						var newVal = oldValue;
					} else {
						var newVal = oldValue - 1;
					}
					spinner.find("input").val(newVal);
					spinner.find("input").trigger("change");
				});
			});
		}
		$('<div class="quantity-nav"><div class="quantity-button quantity-up">+</div><div class="quantity-button quantity-down">-</div></div>').insertAfter('.quantity input');
		felis_updated_cart_totals();
		

		$( document.body ).on( 'updated_cart_totals', function() {
			$('<div class="quantity-nav"><div class="quantity-button quantity-up">+</div><div class="quantity-button quantity-down">-</div></div>').insertAfter('.quantity input');
			felis_updated_cart_totals();
		}); 

		/**/
		$('.product.style-1 .c-accordions_wrap .accordion-target').on('click',function() {
			var w_width = $(window).outerWidth();
			var height_wrap;
			var offset_entry = $('.product.style-1 .product-summary').offset().top;
			var height_footer;
			var height_related_product =$('.product .related.products').offset().top;
			var entry_position;
			var stop_float;
			var height_posotion;
			setTimeout(function () {
				var w_height =$(document).height();
				height_wrap = $('.product.style-1 .product-summary').outerHeight();
				entry_position = offset_entry + height_wrap;
				stop_float = (w_height - entry_position + 50);

			if(w_width > 975 && height_wrap >= 900 ){
				$('.product.style-1 .product-summary .entry-summary').addClass('active').affix({offset: {top: offset_entry, bottom: stop_float} });
			}
			else{
				$('.product.style-1 .product-summary .entry-summary').removeClass('active');
			}
			}, 310)
		})


		$(document.body)
		.on('click touchend', '#swipebox-slider .current > *', function(e) {
			return false;
		})
		.on('click touchend', '#swipebox-slider .current', function(e) {
			$('#swipebox-close').trigger('click');
		});
	});

	$(window).on("load resize", function() {
		if ($(window).width() < 975) {
			$('.product.style-1 .product-summary .entry-summary').removeClass('active');
		}else{
			$('.product.style-1 .product-summary').outerHeight();
			var height_wrap = $('.product.style-1 .product-summary').outerHeight();
			var w_height =$(document).height();
			if( height_wrap >= 900 ){

				var offset_entry = $('.product.style-1 .product-summary').offset().top;
				var entry_position = offset_entry + height_wrap;
				var stop_float = (w_height - entry_position);
				$('.product.style-1 .product-summary .entry-summary').addClass('active').affix({offset: {top: offset_entry, bottom: stop_float} });

			}
		}

		if ($('.sidebar-sticky').length !== 0) {
			var length = $('.sidebar-sticky').height() - $('.sidebar-wrap').height() + $('.sidebar-sticky').offset().top;
			var _view_port = $(window).height();
			var _get_height_body = $('body').height();
			if (_get_height_body < _view_port) {
				$('.sidebar-sticky').css({ 'position': 'relative' });
				$('.sidebar-wrap').css({ 'position': 'relative' });
			} else {
				$('.sidebar-sticky').css({ 'position': 'absolute' });
				$('.sidebar-wrap').css({ 'position': 'absolute' });
			}
			$(window).scroll(function() {

				var scroll = $(this).scrollTop();
				var height = $('.sidebar-wrap').height() + 'px';

				if (scroll < $('.sidebar-sticky').offset().top) {

					$('.sidebar-wrap').css({
						'position': 'absolute',
						'top': '0'
					});

				} else if (scroll > length) {

					$('.sidebar-wrap').css({
						'position': 'absolute',
						'bottom': '0',
						'top': 'auto'
					});

				} else {

					$('.sidebar-wrap').css({
						'position': 'fixed',
						'top': '0',
						'height': height
					});
				}
			});
		}
		/*scroll-page*/
        var s = $(".c-page-scroll");	   
		var windowh = $(window).height();
		$(document).on("scroll", onScroll);
		
		$('a[href^="#"]').on('click', function (e) {
	        if ($(this).parents('#menu-center').length) {
	        	e.preventDefault();
		        $(document).off("scroll");
		        
		        $('a').each(function () {
		            $(this).removeClass('active');
		        })
		        $(this).addClass('active');
		      	
		        var target = this.hash,
		            menu = target;
		        var $target = $(target);
		        $('html, body').stop().animate({
		            'scrollTop': $target.offset().top
		        }, 500, function () {
		            window.location.hash = target;
		            $(document).on("scroll", onScroll);
		        });
	        }else {
	        	e.preventDefault();
	        }
	    });

	    $('.c-page-scroll .c-scroll-item').each(function(i, e){
	    	var $this = $(this);
		    var win = $(window);
		    var viewport = {
		        top : win.scrollTop(),
		        left : win.scrollLeft()
		    };
		    viewport.right = viewport.left + win.width();
		    viewport.bottom = viewport.top + win.height();
		    
		    var bounds = $this.offset();
		    bounds.right = bounds.left + $this.outerWidth();
		    bounds.bottom = bounds.top + $this.outerHeight();
		    
		    if( (!(viewport.right < bounds.left || viewport.left > bounds.right || viewport.bottom < bounds.top || viewport.top > bounds.bottom))){
		    	$this.addClass('active');
		    	if(i !== 0 && i !== ($('.c-page-scroll .c-scroll-item').length - 1)){
			    	$("#menu-center").addClass('active');
			    }
		    }
		    
	    });
		function onScroll(event) {
			if($('body').has('.c-page-scroll').length){

			var windowpos = $(window).scrollTop();
			var s_nav = $("#menu-center");
			var height_s = s.height()
			var pos = s.offset();	
			var po_height_s =	height_s + pos.top;
			if (windowpos >= pos.top && windowpos <= (po_height_s - windowh)) { 		/*control wrap-scroll*/
				s.addClass("stick");
			} else {
				s.removeClass("stick");	
			}
			$('.c-page-scroll .c-scroll-item').each(function(i, e){						/*control item-scroll*/
				var $this = $(this);
				var item_po=$this.offset().top ;
				var item_he=$this.height();
				var item_hepo = item_po + item_he;
				if(i==0 && windowpos >= (item_po - windowh)) {							/*first*/
					if(windowpos >= (item_hepo - (windowh / 2))){
						$this.removeClass("active");
					}else{
						$this.addClass("active");
					}
																						/*end*/
				}else if(i == ($('.c-page-scroll .c-scroll-item').length - 1)&& windowpos >= (item_po)&& windowpos <= (item_hepo )) {

					$this.addClass("active");
				}
				else if (windowpos >= (item_po - (windowh / 2)) && windowpos <= (item_hepo - (windowh / 2))) {
					$this.addClass("active");
				} else {
					$this.removeClass("active");
				}		
			});
			$('#menu-center a').each(function () {										/*control nav-scroll*/
		        var currLink = $(this);
		        var refElement = $(currLink.attr("href"));
		        if ((refElement.offset().top) - (windowh / 2) <= windowpos && refElement.offset().top + ((refElement.height()) - (windowh / 2)) > windowpos) {
		            $('#menu-center ul li a').removeClass("active");
		            currLink.addClass("active");
		        }
		        else{
		            currLink.removeClass("active");
		        }
		    });

		    if(windowpos >= pos.top && windowpos <= (po_height_s - (windowh - 2))){				/*control nav-scroll active*/
		    	s_nav.addClass('active');
		    } else {
				s_nav.removeClass("active");	
			}
			}
		};
	});

	$('.plus-toogle').on('click', function(event) {
		event.preventDefault();
		/* Act on the event */
		$('.felis-product-categories').slideToggle();
		$(this).toggleClass('active');
	});

	$('.felis-product-categories .cat-parent i').on('click', function(event) {
		event.preventDefault();
		/* Act on the event */
		var $t = $(this).siblings('.children');


		if ( $t.is(':visible') ) {
			
			$t.slideUp( function() {
				$(this).parent('li').toggleClass('active');
			});
			
		} else {
			$(this).parent('li').toggleClass('active');
			$t.slideDown();
		}
		
			
		$(this).toggleClass('fa-caret-down');
		$(this).toggleClass('fa-caret-up');

	});

	$('.ib2-item').on('hover', function(event) {
		event.preventDefault();
		/* Act on the event */
		var $this = $(this);
		$this.toggleClass('active');
		$('.ib2-image .replace-image').show('slow/400/fast', function() {
			$(this).attr( 'src', $this.data('img') );
		});;

	});




})(jQuery);