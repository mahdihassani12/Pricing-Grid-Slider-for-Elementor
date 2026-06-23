(function ($) {
    'use strict';

    var toPx = function (value, context) {
        if (value === undefined || value === null || value === '') {
            return null;
        }

        if (typeof value === 'number') {
            return value;
        }

        value = String(value).trim();

        if (!value) {
            return null;
        }

        if (value.indexOf('px') > -1 || /^-?\d+(\.\d+)?$/.test(value)) {
            return parseFloat(value) || 0;
        }

        var test = document.createElement('div');
        test.style.position = 'absolute';
        test.style.visibility = 'hidden';
        test.style.width = value;
        (context || document.body).appendChild(test);
        var px = parseFloat(window.getComputedStyle(test).width) || 0;
        test.parentNode.removeChild(test);

        return px;
    };

    var configGap = function (slider, config, key, fallback) {
        var value = toPx(config[key], slider);
        return value === null ? fallback : value;
    };

    var viewportGap = function (slider, config) {
        var desktopGap = configGap(slider, config, 'gap', 24);
        var tabletGap = configGap(slider, config, 'gapTablet', desktopGap);
        var mobileGap = configGap(slider, config, 'gapMobile', tabletGap);
        var width = window.innerWidth || document.documentElement.clientWidth;

        if (width < 768) {
            return mobileGap;
        }

        if (width < 1025) {
            return tabletGap;
        }

        return desktopGap;
    };

    var cssGap = function (slider, fallback) {
        var wrapper = slider.closest('.mpp-pricing-wrapper') || slider;
        var raw = window.getComputedStyle(wrapper).getPropertyValue('--mpp-slider-gap');
        var value = toPx(raw, wrapper);
        return value === null ? fallback : value;
    };

    var setSwiperGap = function (swiper, slider, config) {
        if (!swiper || typeof swiper.update !== 'function') {
            return;
        }

        var desktopGap = configGap(slider, config, 'gap', 24);
        var tabletGap = configGap(slider, config, 'gapTablet', desktopGap);
        var mobileGap = configGap(slider, config, 'gapMobile', tabletGap);
        var activeGap = cssGap(slider, viewportGap(slider, config));

        swiper.params.spaceBetween = activeGap;
        swiper.params.breakpoints = swiper.params.breakpoints || {};
        swiper.params.breakpoints[0] = swiper.params.breakpoints[0] || {};
        swiper.params.breakpoints[768] = swiper.params.breakpoints[768] || {};
        swiper.params.breakpoints[1025] = swiper.params.breakpoints[1025] || {};
        swiper.params.breakpoints[0].spaceBetween = mobileGap;
        swiper.params.breakpoints[768].spaceBetween = tabletGap;
        swiper.params.breakpoints[1025].spaceBetween = desktopGap;

        if (swiper.originalParams) {
            swiper.originalParams.spaceBetween = activeGap;
        }

        slider.mppLastGap = activeGap;
        swiper.update();
    };

    var watchEditorGap = function (slider, config) {
        if (typeof elementorFrontend === 'undefined' || !elementorFrontend.isEditMode || !elementorFrontend.isEditMode()) {
            return;
        }

        if (slider.mppGapWatcher) {
            window.clearInterval(slider.mppGapWatcher);
        }

        slider.mppGapWatcher = window.setInterval(function () {
            if (!document.body.contains(slider)) {
                window.clearInterval(slider.mppGapWatcher);
                return;
            }

            var currentGap = cssGap(slider, viewportGap(slider, config));

            if (currentGap !== slider.mppLastGap) {
                setSwiperGap(slider.mppSwiper, slider, config);
            }
        }, 250);
    };

    var finalizeSwiper = function (slider, instance, config) {
        slider.mppSwiper = instance;
        setSwiperGap(instance, slider, config);
        watchEditorGap(slider, config);
    };

    var createSwiper = function (slider, options, config) {
        if (typeof elementorFrontend !== 'undefined' && elementorFrontend.utils && elementorFrontend.utils.swiper) {
            var swiperPromise = new elementorFrontend.utils.swiper(slider, options);

            if (swiperPromise && typeof swiperPromise.then === 'function') {
                swiperPromise.then(function (instance) {
                    finalizeSwiper(slider, instance, config);
                });
                return;
            }

            finalizeSwiper(slider, swiperPromise, config);
            return;
        }

        if (typeof Swiper !== 'undefined') {
            finalizeSwiper(slider, new Swiper(slider, options), config);
        }
    };

    var initPricingSlider = function ($scope) {
        var $sliders = $scope.find('.mpp-pricing-slider');

        if (!$sliders.length) {
            return;
        }

        $sliders.each(function () {
            var slider = this;
            var $slider = $(slider);
            var config = $slider.data('mpp-slider') || {};
            var desktopGap = configGap(slider, config, 'gap', 24);
            var tabletGap = configGap(slider, config, 'gapTablet', desktopGap);
            var mobileGap = configGap(slider, config, 'gapMobile', tabletGap);

            if (slider.mppGapWatcher) {
                window.clearInterval(slider.mppGapWatcher);
            }

            if (slider.mppSwiper && typeof slider.mppSwiper.destroy === 'function') {
                slider.mppSwiper.destroy(true, true);
            }

            var options = {
                slidesPerView: config.slidesPerView || 3,
                spaceBetween: cssGap(slider, viewportGap(slider, config)),
                loop: !!config.loop,
                watchOverflow: true,
                observer: true,
                observeParents: true,
                resizeObserver: true,
                updateOnWindowResize: true,
                autoplay: config.autoplay ? {
                    delay: 3500,
                    disableOnInteraction: false
                } : false,
                navigation: config.arrows ? {
                    nextEl: $slider.find('.mpp-swiper-next')[0],
                    prevEl: $slider.find('.mpp-swiper-prev')[0]
                } : false,
                pagination: config.dots ? {
                    el: $slider.find('.mpp-swiper-pagination')[0],
                    clickable: true
                } : false,
                breakpoints: {
                    0: {
                        slidesPerView: config.slidesPerViewMobile || 1,
                        spaceBetween: mobileGap
                    },
                    768: {
                        slidesPerView: config.slidesPerViewTablet || 2,
                        spaceBetween: tabletGap
                    },
                    1025: {
                        slidesPerView: config.slidesPerView || 3,
                        spaceBetween: desktopGap
                    }
                }
            };

            createSwiper(slider, options, config);
        });
    };

    $(window).on('resize orientationchange', function () {
        $('.mpp-pricing-slider').each(function () {
            var config = $(this).data('mpp-slider') || {};
            setSwiperGap(this.mppSwiper, this, config);
        });
    });

    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/mahdi_pricing_plans.default', initPricingSlider);
    });
})(jQuery);
