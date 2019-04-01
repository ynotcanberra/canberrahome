<?php

if(!function_exists('zuhaus_mikado_design_styles')) {
    /**
     * Generates general custom styles
     */
    function zuhaus_mikado_design_styles() {
	    $font_family = zuhaus_mikado_options()->getOptionValue( 'google_fonts' );
	    if ( ! empty( $font_family ) && zuhaus_mikado_is_font_option_valid( $font_family ) ) {
		    $font_family_selector = array(
			    'body'
		    );
		    echo zuhaus_mikado_dynamic_css( $font_family_selector, array( 'font-family' => zuhaus_mikado_get_font_option_val( $font_family ) ) );
	    }

		$first_main_color = zuhaus_mikado_options()->getOptionValue('first_color');
        if(!empty($first_main_color)) {
            $color_selector = array(
				'a:hover',
				'h1 a:hover',
				'h2 a:hover',
				'h3 a:hover',
				'h5 a:hover',
				'h6 a:hover',
				'p a:hover',
				'.mkdf-comment-holder .mkdf-comment-text .comment-edit-link:hover',
				'.mkdf-comment-holder .mkdf-comment-text .comment-reply-link:hover',
				'.mkdf-comment-holder .mkdf-comment-text .replay:hover',
				'.mkdf-comment-holder .mkdf-comment-text #cancel-comment-reply-link',
				'.mkdf-cf7-newsletter .mkdf-cf7-submit-newsletter:hover',
				'footer .widget ul li a:hover',
				'footer .widget #wp-calendar tfoot a:hover',
				'footer .widget.widget_search .input-holder button:hover',
				'footer .widget.widget_tag_cloud a:hover',
				'.mkdf-side-menu .widget ul li a:hover',
				'.mkdf-side-menu .widget #wp-calendar tfoot a:hover',
				'.mkdf-side-menu .widget.widget_search .input-holder button:hover',
				'.mkdf-side-menu .widget.widget_tag_cloud a:hover',
				'.wpb_widgetised_column .widget.widget_tag_cloud a:hover',
				'aside.mkdf-sidebar .widget.widget_tag_cloud a:hover',
				'.widget.widget_mkdf_twitter_widget .mkdf-twitter-widget.mkdf-twitter-slider li .mkdf-tweet-text a',
				'.widget.widget_mkdf_twitter_widget .mkdf-twitter-widget.mkdf-twitter-slider li .mkdf-tweet-text span',
				'.widget.widget_mkdf_twitter_widget .mkdf-twitter-widget.mkdf-twitter-standard li .mkdf-tweet-text a:hover',
				'.widget.widget_mkdf_twitter_widget .mkdf-twitter-widget.mkdf-twitter-slider li .mkdf-twitter-icon i',
				'.mkdf-blog-holder article.sticky .mkdf-post-title a',
				'.mkdf-blog-holder article .mkdf-post-read-more-button a',
				'.mkdf-blog-holder article .mkdf-post-info-top>div a:hover',
				'.mkdf-author-description .mkdf-author-description-text-holder .mkdf-author-name a:hover',
				'.mkdf-author-description .mkdf-author-description-text-holder .mkdf-author-social-icons a:hover',
				'.mkdf-blog-pagination ul li a.mkdf-pag-active',
				'.mkdf-blog-pagination ul li a:hover',
				'.mkdf-bl-standard-pagination ul li.mkdf-bl-pag-active a',
				'.mkdf-blog-list-holder .mkdf-bli-info>div a:hover',
				'.mkdf-fullscreen-menu-opener.mkdf-fm-opened',
				'nav.mkdf-fullscreen-menu ul li ul li.current-menu-ancestor>a',
				'nav.mkdf-fullscreen-menu ul li ul li.current-menu-item>a',
				'nav.mkdf-fullscreen-menu>ul>li.mkdf-active-item>a',
				'.mkdf-mobile-header .mkdf-mobile-menu-opener.mkdf-mobile-menu-opened a',
				'.mkdf-mobile-header .mkdf-mobile-nav ul li a:hover',
				'.mkdf-mobile-header .mkdf-mobile-nav ul li h6:hover',
				'.mkdf-search-page-holder article.sticky .mkdf-post-title a',
				'.mkdf-title-holder.mkdf-centered-with-breadcrumbs-type .mkdf-breadcrumbs a:hover',
				'.mkdf-title-holder.mkdf-standard-with-breadcrumbs-type .mkdf-breadcrumbs a:hover',
				'.mkdf-testimonials-holder.mkdf-testimonials-standard .mkdf-testimonials-author-holder .mkdf-testimonial-author .mkdf-testimonials-author-job',
				'.mkdf-testimonials-holder.mkdf-testimonials-light .owl-nav .owl-next:hover',
				'.mkdf-testimonials-holder.mkdf-testimonials-light .owl-nav .owl-prev:hover',
				'.mkdf-countdown .countdown-row .countdown-section .countdown-amount',
				'.mkdf-counter-holder .mkdf-counter',
				'.mkdf-iwt .mkdf-iwt-icon',
				'.mkdf-team.main-info-below-image .mkdf-team-social-wrapp .mkdf-icon-shortcode i:hover',
				'.mkdf-team.main-info-below-image .mkdf-team-social-wrapp .mkdf-icon-shortcode span:hover',
				'.mkdf-team.main-info-below-image.info-below-image-boxed .mkdf-team-social-wrapp .mkdf-icon-shortcode .flip-icon-holder .icon-normal span',
				'.mkdf-team.main-info-below-image.info-below-image-standard .mkdf-team-social-wrapp .mkdf-icon-shortcode .flip-icon-holder .icon-flip span',
				'.mkdf-package-list-holder .mkdf-package-price .mkdf-price-value',
				'.mkdf-package-list-holder .mkdf-package-price .mkdf-price-currency',
				'.mkdf-package-list-holder .mkdf-package-icon',
				'.mkdf-property-single-holder .mkdf-property-attachment a',
				'.mkdf-property-basic-info-holder .mkdf-property-price',
				'.mkdf-property-enquiry-inner .mkdf-property-enquiry-form label:after',
				'.mkdf-property-tags .mkdf-tag-item a:hover',
				'.widget.mkdf-contact-property-widget .mkdf-contact-social-icons a:hover',
				'.widget.mkdf-recently-viewed-property-widget article:hover .mkdf-pli-title a',
				'.mkdf-pl-standard-pagination ul li.mkdf-pl-pag-active a',
				'.mkdf-property-list-holder .mkdf-property-list-filter-part .mkdf-filter-type-holder .mkdf-property-type-list-holder .mkdf-ptl-item.active .mkdf-ptl-item-title',
				'.mkdf-property-list-holder.mkdf-pl-layout-simple .mkdf-pl-item .mkdf-property-price',
				'.mkdf-property-search-holder .mkdf-search-type-section .mkdf-property-type-list-holder .mkdf-ptl-item.active .mkdf-ptl-item-title',
				'.dsidx-results .dsidx-prop-summary .dsidx-prop-title b',
				'.dsidx-results .dsidx-prop-summary .dsidx-prop-title b a:hover',
				'#ihf-main-container a:hover',
				'#ihf-main-container .ihf-listing-detail h4.ihf-price .ihf-sold-price',
				'.mkdf-map-marker-holder .mkdf-info-window-inner>a:hover~.mkdf-info-window-details h5',
				'.mkdf-agency-agent-list .mkdf-aal-item-social .mkdf-icon-shortcode a:hover',
				'.mkdf-login-register-content.ui-tabs ul li.ui-state-active a',
				'.mkdf-login-register-content.ui-tabs ul li a:hover',
				'.mkdf-login-register-content.ui-tabs .mkdf-login-form-social-login .mkdf-login-social-link',
				'.mkdf-mobile-header .widget.mkdf-login-register-widget.mkdf-user-not-logged-in .mkdf-login-opener:hover',
				'.mkdf-sidebar .widget.mkdf-login-register-widget.mkdf-user-not-logged-in .mkdf-login-opener:hover',
				'footer .widget.mkdf-login-register-widget.mkdf-user-not-logged-in .mkdf-login-opener:hover',
				'.mkdf-side-menu .widget.mkdf-login-register-widget.mkdf-user-not-logged-in .mkdf-login-opener:hover',
				'.mkdf-login-register-widget.mkdf-user-logged-in .mkdf-user-mobile-icon:hover>span',
                '.mkdf-single-links-pages .mkdf-single-links-pages-inner>a:hover',
                '.mkdf-single-links-pages .mkdf-single-links-pages-inner>span'
            );

            $woo_color_selector = array();
            if(zuhaus_mikado_is_woocommerce_installed()) {
                $woo_color_selector = array(
					'.woocommerce-pagination .page-numbers.current',
					'.woocommerce-pagination .page-numbers:hover',
					'.woocommerce-page .mkdf-content .mkdf-quantity-buttons .mkdf-quantity-minus:hover',
					'.woocommerce-page .mkdf-content .mkdf-quantity-buttons .mkdf-quantity-plus:hover',
					'div.woocommerce .mkdf-quantity-buttons .mkdf-quantity-minus:hover',
					'div.woocommerce .mkdf-quantity-buttons .mkdf-quantity-plus:hover',
					'ul.products>.product .price',
					'.mkdf-woo-single-page .mkdf-single-product-summary .price',
					'.mkdf-woo-single-page .mkdf-single-product-summary .product_meta>span a:hover',
					'.widget.woocommerce.widget_layered_nav ul li.chosen a'
                );
            }

            $color_selector = array_merge($color_selector, $woo_color_selector);

            $background_color_selector = array(
				'.mkdf-st-loader .pulse',
				'.mkdf-st-loader .double_pulse .double-bounce1',
				'.mkdf-st-loader .double_pulse .double-bounce2',
				'.mkdf-st-loader .cube',
				'.mkdf-st-loader .rotating_cubes .cube1',
				'.mkdf-st-loader .rotating_cubes .cube2',
				'.mkdf-st-loader .stripes>div',
				'.mkdf-st-loader .wave>div',
				'.mkdf-st-loader .two_rotating_circles .dot1',
				'.mkdf-st-loader .two_rotating_circles .dot2',
				'.mkdf-st-loader .five_rotating_circles .container1>div',
				'.mkdf-st-loader .five_rotating_circles .container2>div',
				'.mkdf-st-loader .five_rotating_circles .container3>div',
				'.mkdf-st-loader .atom .ball-1:before',
				'.mkdf-st-loader .atom .ball-2:before',
				'.mkdf-st-loader .atom .ball-3:before',
				'.mkdf-st-loader .atom .ball-4:before',
				'.mkdf-st-loader .clock .ball:before',
				'.mkdf-st-loader .mitosis .ball',
				'.mkdf-st-loader .lines .line1',
				'.mkdf-st-loader .lines .line2',
				'.mkdf-st-loader .lines .line3',
				'.mkdf-st-loader .lines .line4',
				'.mkdf-st-loader .fussion .ball',
				'.mkdf-st-loader .fussion .ball-1',
				'.mkdf-st-loader .fussion .ball-2',
				'.mkdf-st-loader .fussion .ball-3',
				'.mkdf-st-loader .fussion .ball-4',
				'.mkdf-st-loader .wave_circles .ball',
				'.mkdf-st-loader .pulse_circles .ball',
				'.mkdf-blog-holder article.format-audio .mkdf-blog-audio-holder .mejs-container .mejs-controls>.mejs-time-rail .mejs-time-total .mejs-time-current',
				'.mkdf-blog-holder article.format-audio .mkdf-blog-audio-holder .mejs-container .mejs-controls>a.mejs-horizontal-volume-slider .mejs-horizontal-volume-current',
				'.mkdf-icon-shortcode.mkdf-circle',
				'.mkdf-icon-shortcode.mkdf-dropcaps.mkdf-circle',
				'.mkdf-icon-shortcode.mkdf-square',
				'.mkdf-property-title-section .mkdf-property-statuses',
				'#dsidx #dsidx-listings li.dsidx-listing-container .dsidx-data .dsidx-primary-data .dsidx-price',
				'#dsidx.dsidx-details #dsidx-header #dsidx-primary-data #dsidx-price td',
				'.widget.dsidx-widget-single-listing-wrap .dsidx-widget-single-listing .dsidx-widget-single-listing-meta .dsidx-widget-single-listing-price',
				'#ihf-main-container .btn-group.open>.dropdown-menu>.active a',
				'#ihf-main-container .btn-group.open>.dropdown-menu>li>a:hover',
				'#ihf-main-container .title-bar-1',
				'#ihf-main-container .ihf-grid-result .ihf-map-icon',
				'#ihf-main-container .ihf-result.row .ihf-map-icon',
				'#ui-datepicker-div .ui-datepicker-header',
				'.mkdf-login-register-content.ui-tabs .mkdf-login-form-social-login .mkdf-login-social-link:after'
            );

            $woo_background_color_selector = array();
            if(zuhaus_mikado_is_woocommerce_installed()) {
                $woo_background_color_selector = array();
            }

            $background_color_selector = array_merge($background_color_selector, $woo_background_color_selector);

            $border_color_selector = array(
				'.mkdf-st-loader .pulse_circles .ball',
				'.mkdf-side-menu .widget.widget_tag_cloud a:hover',
				'.wpb_widgetised_column .widget.widget_tag_cloud a:hover',
				'aside.mkdf-sidebar .widget.widget_tag_cloud a:hover',
				'.widget.widget_tag_cloud a:hover',
				'.mkdf-blog-pagination ul li a.mkdf-pag-active',
				'.mkdf-blog-pagination ul li a:hover',
				'.mkdf-blog-pagination ul li.mkdf-pag-first a:hover',
				'.mkdf-blog-pagination ul li.mkdf-pag-last a:hover',
				'.mkdf-blog-pagination ul li.mkdf-pag-next a:hover',
				'.mkdf-blog-pagination ul li.mkdf-pag-prev a:hover',
				'.mkdf-property-tags .mkdf-tag-item a:hover',
				'.mkdf-mobile-header .widget.mkdf-login-register-widget.mkdf-user-not-logged-in .mkdf-login-opener:hover',
				'.mkdf-sidebar .widget.mkdf-login-register-widget.mkdf-user-not-logged-in .mkdf-login-opener:hover',
				'footer .widget.mkdf-login-register-widget.mkdf-user-not-logged-in .mkdf-login-opener:hover',
				'.mkdf-side-menu .widget.mkdf-login-register-widget.mkdf-user-not-logged-in .mkdf-login-opener:hover',
				'.mkdf-login-register-widget.mkdf-user-logged-in .mkdf-user-mobile-icon:hover>span',
                '.mkdf-single-links-pages .mkdf-single-links-pages-inner>a:hover',
                '.mkdf-single-links-pages .mkdf-single-links-pages-inner>span'
            );

			$woo_border_color_selector = array();
			if(zuhaus_mikado_is_woocommerce_installed()) {
				$woo_border_color_selector = array(
					'.woocommerce-pagination .page-numbers.current',
					'.woocommerce-pagination .page-numbers:hover',
					'.woocommerce-pagination .page-numbers.next:hover',
					'.woocommerce-pagination .page-numbers.prev:hover'
				);
			}

			$border_color_selector = array_merge($border_color_selector, $woo_border_color_selector);

            echo zuhaus_mikado_dynamic_css($color_selector, array('color' => $first_main_color));
	        echo zuhaus_mikado_dynamic_css($background_color_selector, array('background-color' => $first_main_color));
	        echo zuhaus_mikado_dynamic_css($border_color_selector, array('border-color' => $first_main_color));
        }

		$second_main_color = zuhaus_mikado_options()->getOptionValue('second_color');

		if(!empty($second_main_color)) {
			$second_color_selector = array(
				'blockquote:before',
				'.mkdf-cf7-newsletter-footer input[type=submit]:hover',
				'#mkdf-back-to-top>span:hover',
				'.mkdf-main-menu>ul>li.mkdf-active-item>a',
				'.mkdf-main-menu>ul>li>a:hover',
				'.mkdf-light-header .mkdf-page-header>div:not(.mkdf-sticky-header):not(.fixed) .mkdf-main-menu>ul>li.mkdf-active-item>a',
				'.mkdf-light-header .mkdf-page-header>div:not(.mkdf-sticky-header):not(.fixed) .mkdf-main-menu>ul>li>a:hover',
				'.mkdf-mobile-header .mkdf-mobile-nav .mkdf-grid>ul>li.mkdf-active-item>a',
				'.mkdf-mobile-header .mkdf-mobile-nav .mkdf-grid>ul>li.mkdf-active-item>h6',
				'.mkdf-mobile-header .mkdf-mobile-nav ul ul li.current-menu-ancestor>a',
				'.mkdf-mobile-header .mkdf-mobile-nav ul ul li.current-menu-ancestor>h6',
				'.mkdf-mobile-header .mkdf-mobile-nav ul ul li.current-menu-item>a',
				'.mkdf-mobile-header .mkdf-mobile-nav ul ul li.current-menu-item>h6',
				'.mkdf-search-opener:hover',
				'.mkdf-search-cover .mkdf-search-close a:hover',
				'.mkdf-side-menu-button-opener .mkdf-side-menu-icon:hover',
				'.mkdf-side-menu a.mkdf-close-side-menu:hover',
				'.mkdf-btn.mkdf-btn-outline',
				'.mkdf-social-share-holder.mkdf-list li a:hover',
				'.mkdf-property-title-section .mkdf-property-stars',
				'.mkdf-property-list-holder.mkdf-pl-layout-info-over .mkdf-pl-item .mkdf-item-featured',
				'.mkdf-property-list-holder.mkdf-pl-layout-standard .mkdf-pl-item .mkdf-item-featured',
				'.mkdf-property-reviews .mkdf-comment-holder .mkdf-review-rating .mkdf-rating-inner',
				'.mkdf-property-reviews .mkdf-property-stars-wrapper .mkdf-property-stars',
				'.mkdf-property-reviews .mkdf-comment-form-rating .mkdf-comment-rating-box .mkdf-star-rating.active',
				'.mkdf-top-bar .widget.mkdf-login-register-widget.mkdf-user-not-logged-in .mkdf-login-opener:hover',
				'.mkdf-menu-area .widget.mkdf-login-register-widget.mkdf-user-not-logged-in .mkdf-login-opener:hover',
				'.mkdf-sticky-header .widget.mkdf-login-register-widget.mkdf-user-not-logged-in .mkdf-login-opener:hover',
				'.mkdf-menu-area .mkdf-login-register-widget.mkdf-user-logged-in:hover .mkdf-logged-in-user .mkdf-logged-in-user-inner span',
				'.mkdf-sticky-header .mkdf-login-register-widget.mkdf-user-logged-in:hover .mkdf-logged-in-user .mkdf-logged-in-user-inner span',
				'.mkdf-top-bar .mkdf-login-register-widget.mkdf-user-logged-in:hover .mkdf-logged-in-user .mkdf-logged-in-user-inner span'
			);

			$woo_second_color_selector = array();
			if(zuhaus_mikado_is_woocommerce_installed()) {
				$woo_second_color_selector = array(
					'.mkdf-shopping-cart-holder:hover .mkdf-cart-icon'
				);
			}

			$second_color_selector = array_merge($second_color_selector, $woo_second_color_selector);

			$second_color_important_selector = array(
				'.mkdf-menu-area .widget.mkdf-add-property-widget .mkdf-btn:hover',
				'.mkdf-top-bar .widget.mkdf-add-property-widget .mkdf-btn:hover'
			);

			$second_background_color_selector = array(
				'#submit_comment',
				'.post-password-form input[type=submit]',
				'input.wpcf7-form-control.wpcf7-submit',
				'.mkdf-blog-holder article.format-link .mkdf-post-text',
				'.mkdf-blog-holder article.format-quote .mkdf-post-text',
				'.mkdf-testimonials-holder.mkdf-testimonials-standard .mkdf-testimonials-author-holder .mkdf-quotes-holder',
				'.mkdf-btn.mkdf-btn-solid',
				'.mkdf-process-holder .mkdf-process-add-text',
				'.mkdf-progress-bar .mkdf-pb-content-holder .mkdf-pb-content',
				'.mkdf-property-list-holder .mkdf-property-list-filter-part .mkdf-filter-features-holder .mkdf-feature-item input[type=checkbox]+label .mkdf-label-view:after',
				'.mkdf-property-city-list-holder .mkdf-pcl-item-separator span',
				'.mkdf-property-list-holder .mkdf-property-list-filter-part .mkdf-range-slider .ui-slider-range',
				'.mkdf-property-list-holder .mkdf-property-list-filter-part .mkdf-range-slider .ui-slider-handle',
				'.dsidx-resp-search-box input[type=submit]',
				'#dsidx.dsidx-details #dsidx-contact-form #dsidx-contact-form-submit',
				'#ihf-main-container a.btn.btn-default:not(.dropdown-toggle)',
				'#ihf-main-container a.btn.btn-primary',
				'#ihf-main-container button.btn.btn-default:not(.dropdown-toggle)',
				'#ihf-main-container button.btn.btn-primary',
				'#ihf-main-container #ihf-main-search-form #ihf-search-location-tab #areaPickerExpandAllCloseButton span',
				'#ihf-main-container #ihf-main-search-form #ihf-search-location-tab .areaPickerExpandAllElement>div',
				'.mkdf-login-register-content.ui-tabs .mkdf-lost-pass-remember-holder .mkdf-login-remember .mkdf-checkbox-style input[type=checkbox]+label .mkdf-label-view:after',
				'.mkdf-membership-input-holder .mkdf-checkbox-style input[type=checkbox]+label .mkdf-label-view:after'
			);

			$woo_second_background_color_selector = array();
			if(zuhaus_mikado_is_woocommerce_installed()) {
				$woo_second_background_color_selector = array(
					'.woocommerce-page .mkdf-content .wc-forward:not(.added_to_cart):not(.checkout-button)',
					'.woocommerce-page .mkdf-content a.added_to_cart',
					'.woocommerce-page .mkdf-content a.button',
					'.woocommerce-page .mkdf-content button[type=submit]:not(.mkdf-woo-search-widget-button)',
					'.woocommerce-page .mkdf-content input[type=submit]',
					'div.woocommerce .wc-forward:not(.added_to_cart):not(.checkout-button)',
					'div.woocommerce a.added_to_cart',
					'div.woocommerce a.button',
					'div.woocommerce button[type=submit]:not(.mkdf-woo-search-widget-button)',
					'div.woocommerce input[type=submit]',
					'.woocommerce .mkdf-onsale',
					'.woocommerce .mkdf-out-of-stock',
					'.mkdf-shopping-cart-dropdown .mkdf-cart-bottom .mkdf-view-cart',
					'.widget.woocommerce.widget_price_filter .price_slider_wrapper .ui-widget-content .ui-slider-handle',
					'.widget.woocommerce.widget_price_filter .price_slider_wrapper .ui-widget-content .ui-slider-range'
				);
			}

			$second_background_color_selector = array_merge($second_background_color_selector, $woo_second_background_color_selector);

			$second_background_color_important_selector = array(
				'.mkdf-btn.mkdf-btn-outline:not(.mkdf-btn-custom-hover-bg):hover'
			);

			$second_border_color_selector = array(
				'#submit_comment:hover',
				'.post-password-form input[type=submit]:hover',
				'input.wpcf7-form-control.wpcf7-submit:hover',
				'#mkdf-back-to-top>span:hover',
				'.mkdf-search-opener:hover .mkdf-search-opener-wrapper',
				'.mkdf-side-menu-button-opener .mkdf-side-menu-icon:hover',
				'.mkdf-side-menu a.mkdf-close-side-menu:hover',
				'.mkdf-btn.mkdf-btn-outline',
				'.mkdf-tabs.mkdf-tabs-simple .mkdf-tabs-nav li.ui-state-active a',
				'.mkdf-tabs.mkdf-tabs-simple .mkdf-tabs-nav li.ui-state-hover a',
				'.dsidx-resp-search-box input[type=submit]:hover',
				'#dsidx.dsidx-details #dsidx-contact-form #dsidx-contact-form-submit:hover',
				'#ihf-main-container #ihf-main-search-form #ihf-search-location-tab .ihf-one-selectedArea button',
				'#ihf-main-container #ihf-main-search-form #ihf-search-location-tab #areaPickerExpandAllCloseButton:hover span',
				'#ihf-main-container #ihf-main-search-form #ihf-search-location-tab .areaPickerExpandAllElement>div.areaSelected',
				'#ihf-main-container #ihf-main-search-form #ihf-search-location-tab .areaPickerExpandAllElement>div.autocompleteMouseOver',
				'.mkdf-top-bar .widget.mkdf-login-register-widget.mkdf-user-not-logged-in .mkdf-login-opener:hover',
				'.mkdf-menu-area .widget.mkdf-login-register-widget.mkdf-user-not-logged-in .mkdf-login-opener:hover',
				'.mkdf-sticky-header .widget.mkdf-login-register-widget.mkdf-user-not-logged-in .mkdf-login-opener:hover',
				'.mkdf-menu-area .mkdf-login-register-widget.mkdf-user-logged-in:hover .mkdf-logged-in-user .mkdf-logged-in-user-inner span',
				'.mkdf-sticky-header .mkdf-login-register-widget.mkdf-user-logged-in:hover .mkdf-logged-in-user .mkdf-logged-in-user-inner span',
				'.mkdf-top-bar .mkdf-login-register-widget.mkdf-user-logged-in:hover .mkdf-logged-in-user .mkdf-logged-in-user-inner span'
			);

			$woo_second_border_color_selector = array();
			if(zuhaus_mikado_is_woocommerce_installed()) {
				$woo_second_border_color_selector = array(
					'.woocommerce-page .mkdf-content .wc-forward:not(.added_to_cart):not(.checkout-button):hover',
					'.woocommerce-page .mkdf-content a.added_to_cart:hover',
					'.woocommerce-page .mkdf-content a.button:hover',
					'.woocommerce-page .mkdf-content button[type=submit]:not(.mkdf-woo-search-widget-button):hover',
					'.woocommerce-page .mkdf-content input[type=submit]:hover',
					'div.woocommerce .wc-forward:not(.added_to_cart):not(.checkout-button):hover',
					'div.woocommerce a.added_to_cart:hover',
					'div.woocommerce a.button:hover',
					'div.woocommerce button[type=submit]:not(.mkdf-woo-search-widget-button):hover',
					'div.woocommerce input[type=submit]:hover',
					'.mkdf-shopping-cart-holder:hover .mkdf-cart-icon',
					'.mkdf-shopping-cart-dropdown .mkdf-cart-bottom .mkdf-view-cart:hover'
				);
			}

			$second_border_color_selector = array_merge($second_border_color_selector, $woo_second_border_color_selector);

			$second_border_color_important_selector = array(
				'.mkdf-btn.mkdf-btn-solid:not(.mkdf-btn-custom-border-hover):hover',
				'.mkdf-btn.mkdf-btn-outline:not(.mkdf-btn-custom-border-hover):hover'
			);

			echo zuhaus_mikado_dynamic_css($second_color_selector, array('color' => $second_main_color));
			echo zuhaus_mikado_dynamic_css($second_color_important_selector, array('color' => $second_main_color.'!important'));
			echo zuhaus_mikado_dynamic_css($second_background_color_selector, array('background-color' => $second_main_color));
			echo zuhaus_mikado_dynamic_css($second_background_color_important_selector, array('background-color' => $second_main_color.'!important'));
			echo zuhaus_mikado_dynamic_css($second_border_color_selector, array('border-color' => $second_main_color));
			echo zuhaus_mikado_dynamic_css($second_border_color_important_selector, array('border-color' => $second_main_color.'!important'));
		}
	
	    $page_background_color = zuhaus_mikado_options()->getOptionValue( 'page_background_color' );
	    if ( ! empty( $page_background_color ) ) {
		    $background_color_selector = array(
			    'body',
			    '.mkdf-content',
			    '.mkdf-container'
		    );
		    echo zuhaus_mikado_dynamic_css( $background_color_selector, array( 'background-color' => $page_background_color ) );
	    }
	
	    $selection_color = zuhaus_mikado_options()->getOptionValue( 'selection_color' );
	    if ( ! empty( $selection_color ) ) {
		    echo zuhaus_mikado_dynamic_css( '::selection', array( 'background' => $selection_color ) );
		    echo zuhaus_mikado_dynamic_css( '::-moz-selection', array( 'background' => $selection_color ) );
	    }
	
	    $preload_background_styles = array();
	
	    if ( zuhaus_mikado_options()->getOptionValue( 'preload_pattern_image' ) !== "" ) {
		    $preload_background_styles['background-image'] = 'url(' . zuhaus_mikado_options()->getOptionValue( 'preload_pattern_image' ) . ') !important';
	    }
	
	    echo zuhaus_mikado_dynamic_css( '.mkdf-preload-background', $preload_background_styles );
    }

    add_action('zuhaus_mikado_style_dynamic', 'zuhaus_mikado_design_styles');
}

if ( ! function_exists( 'zuhaus_mikado_content_styles' ) ) {
	function zuhaus_mikado_content_styles() {
		$content_style = array();
		
		$padding_top = zuhaus_mikado_options()->getOptionValue( 'content_top_padding' );
		if ( $padding_top !== '' ) {
			$content_style['padding-top'] = zuhaus_mikado_filter_px( $padding_top ) . 'px';
		}
		
		$content_selector = array(
			'.mkdf-content .mkdf-content-inner > .mkdf-full-width > .mkdf-full-width-inner',
		);
		
		echo zuhaus_mikado_dynamic_css( $content_selector, $content_style );
		
		$content_style_in_grid = array();
		
		$padding_top_in_grid = zuhaus_mikado_options()->getOptionValue( 'content_top_padding_in_grid' );
		if ( $padding_top_in_grid !== '' ) {
			$content_style_in_grid['padding-top'] = zuhaus_mikado_filter_px( $padding_top_in_grid ) . 'px';
		}
		
		$content_selector_in_grid = array(
			'.mkdf-content .mkdf-content-inner > .mkdf-container > .mkdf-container-inner',
		);
		
		echo zuhaus_mikado_dynamic_css( $content_selector_in_grid, $content_style_in_grid );
	}
	
	add_action( 'zuhaus_mikado_style_dynamic', 'zuhaus_mikado_content_styles' );
}

if ( ! function_exists( 'zuhaus_mikado_h1_styles' ) ) {
	function zuhaus_mikado_h1_styles() {
		$margin_top    = zuhaus_mikado_options()->getOptionValue( 'h1_margin_top' );
		$margin_bottom = zuhaus_mikado_options()->getOptionValue( 'h1_margin_bottom' );
		
		$item_styles = zuhaus_mikado_get_typography_styles( 'h1' );
		
		if ( $margin_top !== '' ) {
			$item_styles['margin-top'] = zuhaus_mikado_filter_px( $margin_top ) . 'px';
		}
		if ( $margin_bottom !== '' ) {
			$item_styles['margin-bottom'] = zuhaus_mikado_filter_px( $margin_bottom ) . 'px';
		}
		
		$item_selector = array(
			'h1'
		);
		
		if ( ! empty( $item_styles ) ) {
			echo zuhaus_mikado_dynamic_css( $item_selector, $item_styles );
		}
	}
	
	add_action( 'zuhaus_mikado_style_dynamic', 'zuhaus_mikado_h1_styles' );
}

if ( ! function_exists( 'zuhaus_mikado_h2_styles' ) ) {
	function zuhaus_mikado_h2_styles() {
		$margin_top    = zuhaus_mikado_options()->getOptionValue( 'h2_margin_top' );
		$margin_bottom = zuhaus_mikado_options()->getOptionValue( 'h2_margin_bottom' );
		
		$item_styles = zuhaus_mikado_get_typography_styles( 'h2' );
		
		if ( $margin_top !== '' ) {
			$item_styles['margin-top'] = zuhaus_mikado_filter_px( $margin_top ) . 'px';
		}
		if ( $margin_bottom !== '' ) {
			$item_styles['margin-bottom'] = zuhaus_mikado_filter_px( $margin_bottom ) . 'px';
		}
		
		$item_selector = array(
			'h2'
		);
		
		if ( ! empty( $item_styles ) ) {
			echo zuhaus_mikado_dynamic_css( $item_selector, $item_styles );
		}
	}
	
	add_action( 'zuhaus_mikado_style_dynamic', 'zuhaus_mikado_h2_styles' );
}

if ( ! function_exists( 'zuhaus_mikado_h3_styles' ) ) {
	function zuhaus_mikado_h3_styles() {
		$margin_top    = zuhaus_mikado_options()->getOptionValue( 'h3_margin_top' );
		$margin_bottom = zuhaus_mikado_options()->getOptionValue( 'h3_margin_bottom' );
		
		$item_styles = zuhaus_mikado_get_typography_styles( 'h3' );
		
		if ( $margin_top !== '' ) {
			$item_styles['margin-top'] = zuhaus_mikado_filter_px( $margin_top ) . 'px';
		}
		if ( $margin_bottom !== '' ) {
			$item_styles['margin-bottom'] = zuhaus_mikado_filter_px( $margin_bottom ) . 'px';
		}
		
		$item_selector = array(
			'h3'
		);
		
		if ( ! empty( $item_styles ) ) {
			echo zuhaus_mikado_dynamic_css( $item_selector, $item_styles );
		}
	}
	
	add_action( 'zuhaus_mikado_style_dynamic', 'zuhaus_mikado_h3_styles' );
}

if ( ! function_exists( 'zuhaus_mikado_h4_styles' ) ) {
	function zuhaus_mikado_h4_styles() {
		$margin_top    = zuhaus_mikado_options()->getOptionValue( 'h4_margin_top' );
		$margin_bottom = zuhaus_mikado_options()->getOptionValue( 'h4_margin_bottom' );
		
		$item_styles = zuhaus_mikado_get_typography_styles( 'h4' );
		
		if ( $margin_top !== '' ) {
			$item_styles['margin-top'] = zuhaus_mikado_filter_px( $margin_top ) . 'px';
		}
		if ( $margin_bottom !== '' ) {
			$item_styles['margin-bottom'] = zuhaus_mikado_filter_px( $margin_bottom ) . 'px';
		}
		
		$item_selector = array(
			'h4'
		);
		
		if ( ! empty( $item_styles ) ) {
			echo zuhaus_mikado_dynamic_css( $item_selector, $item_styles );
		}
	}
	
	add_action( 'zuhaus_mikado_style_dynamic', 'zuhaus_mikado_h4_styles' );
}

if ( ! function_exists( 'zuhaus_mikado_h5_styles' ) ) {
	function zuhaus_mikado_h5_styles() {
		$margin_top    = zuhaus_mikado_options()->getOptionValue( 'h5_margin_top' );
		$margin_bottom = zuhaus_mikado_options()->getOptionValue( 'h5_margin_bottom' );
		
		$item_styles = zuhaus_mikado_get_typography_styles( 'h5' );
		
		if ( $margin_top !== '' ) {
			$item_styles['margin-top'] = zuhaus_mikado_filter_px( $margin_top ) . 'px';
		}
		if ( $margin_bottom !== '' ) {
			$item_styles['margin-bottom'] = zuhaus_mikado_filter_px( $margin_bottom ) . 'px';
		}
		
		$item_selector = array(
			'h5'
		);
		
		if ( ! empty( $item_styles ) ) {
			echo zuhaus_mikado_dynamic_css( $item_selector, $item_styles );
		}
	}
	
	add_action( 'zuhaus_mikado_style_dynamic', 'zuhaus_mikado_h5_styles' );
}

if ( ! function_exists( 'zuhaus_mikado_h6_styles' ) ) {
	function zuhaus_mikado_h6_styles() {
		$margin_top    = zuhaus_mikado_options()->getOptionValue( 'h6_margin_top' );
		$margin_bottom = zuhaus_mikado_options()->getOptionValue( 'h6_margin_bottom' );
		
		$item_styles = zuhaus_mikado_get_typography_styles( 'h6' );
		
		if ( $margin_top !== '' ) {
			$item_styles['margin-top'] = zuhaus_mikado_filter_px( $margin_top ) . 'px';
		}
		if ( $margin_bottom !== '' ) {
			$item_styles['margin-bottom'] = zuhaus_mikado_filter_px( $margin_bottom ) . 'px';
		}
		
		$item_selector = array(
			'h6'
		);
		
		if ( ! empty( $item_styles ) ) {
			echo zuhaus_mikado_dynamic_css( $item_selector, $item_styles );
		}
	}
	
	add_action( 'zuhaus_mikado_style_dynamic', 'zuhaus_mikado_h6_styles' );
}

if ( ! function_exists( 'zuhaus_mikado_text_styles' ) ) {
	function zuhaus_mikado_text_styles() {
		$item_styles = zuhaus_mikado_get_typography_styles( 'text' );
		
		$item_selector = array(
			'p'
		);
		
		if ( ! empty( $item_styles ) ) {
			echo zuhaus_mikado_dynamic_css( $item_selector, $item_styles );
		}
	}
	
	add_action( 'zuhaus_mikado_style_dynamic', 'zuhaus_mikado_text_styles' );
}

if ( ! function_exists( 'zuhaus_mikado_link_styles' ) ) {
	function zuhaus_mikado_link_styles() {
		$link_styles      = array();
		$link_color       = zuhaus_mikado_options()->getOptionValue( 'link_color' );
		$link_font_style  = zuhaus_mikado_options()->getOptionValue( 'link_fontstyle' );
		$link_font_weight = zuhaus_mikado_options()->getOptionValue( 'link_fontweight' );
		$link_decoration  = zuhaus_mikado_options()->getOptionValue( 'link_fontdecoration' );
		
		if ( ! empty( $link_color ) ) {
			$link_styles['color'] = $link_color;
		}
		if ( ! empty( $link_font_style ) ) {
			$link_styles['font-style'] = $link_font_style;
		}
		if ( ! empty( $link_font_weight ) ) {
			$link_styles['font-weight'] = $link_font_weight;
		}
		if ( ! empty( $link_decoration ) ) {
			$link_styles['text-decoration'] = $link_decoration;
		}
		
		$link_selector = array(
			'a',
			'p a'
		);
		
		if ( ! empty( $link_styles ) ) {
			echo zuhaus_mikado_dynamic_css( $link_selector, $link_styles );
		}
	}
	
	add_action( 'zuhaus_mikado_style_dynamic', 'zuhaus_mikado_link_styles' );
}

if ( ! function_exists( 'zuhaus_mikado_link_hover_styles' ) ) {
	function zuhaus_mikado_link_hover_styles() {
		$link_hover_styles     = array();
		$link_hover_color      = zuhaus_mikado_options()->getOptionValue( 'link_hovercolor' );
		$link_hover_decoration = zuhaus_mikado_options()->getOptionValue( 'link_hover_fontdecoration' );
		
		if ( ! empty( $link_hover_color ) ) {
			$link_hover_styles['color'] = $link_hover_color;
		}
		if ( ! empty( $link_hover_decoration ) ) {
			$link_hover_styles['text-decoration'] = $link_hover_decoration;
		}
		
		$link_hover_selector = array(
			'a:hover',
			'p a:hover'
		);
		
		if ( ! empty( $link_hover_styles ) ) {
			echo zuhaus_mikado_dynamic_css( $link_hover_selector, $link_hover_styles );
		}
		
		$link_heading_hover_styles = array();
		
		if ( ! empty( $link_hover_color ) ) {
			$link_heading_hover_styles['color'] = $link_hover_color;
		}
		
		$link_heading_hover_selector = array(
			'h1 a:hover',
			'h2 a:hover',
			'h3 a:hover',
			'h4 a:hover',
			'h5 a:hover',
			'h6 a:hover'
		);
		
		if ( ! empty( $link_heading_hover_styles ) ) {
			echo zuhaus_mikado_dynamic_css( $link_heading_hover_selector, $link_heading_hover_styles );
		}
	}
	
	add_action( 'zuhaus_mikado_style_dynamic', 'zuhaus_mikado_link_hover_styles' );
}

if ( ! function_exists( 'zuhaus_mikado_smooth_page_transition_styles' ) ) {
	function zuhaus_mikado_smooth_page_transition_styles( $style ) {
		$id            = zuhaus_mikado_get_page_id();
		$loader_style  = array();
		$current_style = '';
		
		$background_color = zuhaus_mikado_get_meta_field_intersect( 'smooth_pt_bgnd_color', $id );
		if ( ! empty( $background_color ) ) {
			$loader_style['background-color'] = $background_color;
		}
		
		$loader_selector = array(
			'.mkdf-smooth-transition-loader'
		);
		
		if ( ! empty( $loader_style ) ) {
			$current_style .= zuhaus_mikado_dynamic_css( $loader_selector, $loader_style );
		}
		
		$spinner_style = array();
		$spinner_color = zuhaus_mikado_get_meta_field_intersect( 'smooth_pt_spinner_color', $id );
		if ( ! empty( $spinner_color ) ) {
			$spinner_style['background-color'] = $spinner_color;
		}
		
		$spinner_selectors = array(
			'.mkdf-st-loader .mkdf-rotate-circles > div',
			'.mkdf-st-loader .pulse',
			'.mkdf-st-loader .double_pulse .double-bounce1',
			'.mkdf-st-loader .double_pulse .double-bounce2',
			'.mkdf-st-loader .cube',
			'.mkdf-st-loader .rotating_cubes .cube1',
			'.mkdf-st-loader .rotating_cubes .cube2',
			'.mkdf-st-loader .stripes > div',
			'.mkdf-st-loader .wave > div',
			'.mkdf-st-loader .two_rotating_circles .dot1',
			'.mkdf-st-loader .two_rotating_circles .dot2',
			'.mkdf-st-loader .five_rotating_circles .container1 > div',
			'.mkdf-st-loader .five_rotating_circles .container2 > div',
			'.mkdf-st-loader .five_rotating_circles .container3 > div',
			'.mkdf-st-loader .atom .ball-1:before',
			'.mkdf-st-loader .atom .ball-2:before',
			'.mkdf-st-loader .atom .ball-3:before',
			'.mkdf-st-loader .atom .ball-4:before',
			'.mkdf-st-loader .clock .ball:before',
			'.mkdf-st-loader .mitosis .ball',
			'.mkdf-st-loader .lines .line1',
			'.mkdf-st-loader .lines .line2',
			'.mkdf-st-loader .lines .line3',
			'.mkdf-st-loader .lines .line4',
			'.mkdf-st-loader .fussion .ball',
			'.mkdf-st-loader .fussion .ball-1',
			'.mkdf-st-loader .fussion .ball-2',
			'.mkdf-st-loader .fussion .ball-3',
			'.mkdf-st-loader .fussion .ball-4',
			'.mkdf-st-loader .wave_circles .ball',
			'.mkdf-st-loader .pulse_circles .ball'
		);
		
		if ( ! empty( $spinner_style ) ) {
			$current_style .= zuhaus_mikado_dynamic_css( $spinner_selectors, $spinner_style );
		}
		
		$current_style = $current_style . $style;
		
		return $current_style;
	}
	
	add_filter( 'zuhaus_mikado_add_page_custom_style', 'zuhaus_mikado_smooth_page_transition_styles' );
}