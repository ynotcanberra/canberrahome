(function($) {
    'use strict';

    var property = {};
    mkdf.modules.property = property;

    property.mkdfPropertyAddToWishlist = mkdfPropertyAddToWishlist;
    property.mkdfShowHideEnquiryForm = mkdfShowHideEnquiryForm;
    property.mkdfSubmitEnquiryForm = mkdfSubmitEnquiryForm;
    property.mkdfMortgageCalculator = mkdfMortgageCalculator;

    property.mkdfOnDocumentReady = mkdfOnDocumentReady;
    property.mkdfOnWindowLoad = mkdfOnWindowLoad;
    property.mkdfOnWindowResize = mkdfOnWindowResize;
    property.mkdfOnWindowScroll = mkdfOnWindowScroll;

    $(document).ready(mkdfOnDocumentReady);
    $(window).load(mkdfOnWindowLoad);
    $(window).resize(mkdfOnWindowResize);
    $(window).scroll(mkdfOnWindowScroll);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
        mkdfPropertyAddToWishlist();
        mkdfShowHideEnquiryForm();
        mkdfSubmitEnquiryForm();
        mkdfAddEditProperty();
        mkdfMortgageCalculator();
        mkdfDeleteProperty();
    }

    /*
     All functions to be called on $(window).load() should be in this function
     */
    function mkdfOnWindowLoad() {

    }

    /*
     All functions to be called on $(window).resize() should be in this function
     */
    function mkdfOnWindowResize() {

    }

    /*
     All functions to be called on $(window).scroll() should be in this function
     */
    function mkdfOnWindowScroll() {

    }

    function mkdfPropertyAddToWishlist(){

        $('.mkdf-property-whishlist').on('click',function(e) {
            e.preventDefault();
            var property = $(this),
                propertyId;

            if(typeof property.data('property-id') !== 'undefined' && mkdf.body.hasClass('logged-in')) {
                propertyId = property.data('property-id');
                mkdfPropertyWhishlistAdding(property, propertyId);
            } else {
                // Trigger event.
                $( document.body ).trigger( 'open_user_login_trigger' );
            }
        });

    }

    function mkdfPropertyWhishlistAdding(property, propertyId){

        var ajaxData = {
            action: 'mkdf_re_add_property_to_wishlist',
            property_id : propertyId
        };

        $.ajax({
            type: 'POST',
            data: ajaxData,
            url: mkdfGlobalVars.vars.mkdfAjaxUrl,
            success: function (data) {
                var response = JSON.parse(data);
                if(response.status == 'success'){
                    if(!property.hasClass('mkdf-icon-only')) {
                        property.find('span').text(response.data.message);
                    }
                    property.find('i').removeClass('fa-heart fa-heart-o').addClass(response.data.icon);
                }
            }
        });

        return false;

    }

    function mkdfShowHideEnquiryForm(){

        var single = $('.mkdf-property-single-holder'),
            enquiryHolder = $('.mkdf-property-enquiry-holder'),
            button = single.find('.mkdf-property-single-action'),
            buttonClose = $('.mkdf-property-enquiry-close');

        button.on('click', function() {
            enquiryHolder.fadeIn(300);
            enquiryHolder.addClass('opened');
        });

        enquiryHolder.add(buttonClose).on('click', function() {
            if(enquiryHolder.hasClass('opened')){
                enquiryHolder.fadeOut(300);
                enquiryHolder.removeClass('opened');
            }
        });

        $(".mkdf-property-enquiry-inner").click(function(e) {
            e.stopPropagation();
        });
        // on esc too
        $(window).on('keyup', function(e){
            if ( enquiryHolder.hasClass( 'opened' ) && e.keyCode == 27 ) {
                enquiryHolder.fadeOut(300);
                enquiryHolder.removeClass('opened');
            }
        });

    }

    function mkdfSubmitEnquiryForm(){
        var enquiryHolder = $('.mkdf-property-enquiry-holder'),
            enquiryMessageHolder = $('.mkdf-property-enquiry-response'),
            enquiryForm = enquiryHolder.find('.mkdf-property-enquiry-form');


        enquiryForm.on('submit', function(e){
            e.preventDefault();
            enquiryMessageHolder.empty();
            var enquiryData = {
                name: enquiryForm.find('#enquiry-name').val(),
                email: enquiryForm.find('#enquiry-email').val(),
                message: enquiryForm.find('#enquiry-message').val(),
                itemId: enquiryForm.find('#property-item-id').val(),
                nonce: enquiryForm.find('#mkdf_re_nonce_property_item_enquiry').val()
            };

            var requestData = {
                action: 'mkdf_re_send_property_enquiry',
                data: enquiryData
            };

            $.ajax({
                type: "POST",
                url: mkdfGlobalVars.vars.mkdfAjaxUrl,
                data: requestData,
                success: function (data) {
                    var response = JSON.parse(data);
                    if(response.status == 'error'){
                        enquiryMessageHolder.html(response.message);
                        //error handler
                    }else{
                        enquiryMessageHolder.html(response.message);
                        enquiryForm.fadeOut(300);
                        setTimeout(function(){
                            enquiryHolder.remove();
                        }, 2000);
                    }
                }
            });
        });

    }

    function mkdfMortgageCalculator(){
        var calculator = $('.mkdf-mortgage-calculator-holder');
        if(calculator.length) {
            calculator.each(function() {
               var thisCalc = $(this);
               var calcForm = thisCalc.find('form');
                var resultHolder = thisCalc.find('.mkdf-mc-result-holder');
                calcForm.on('submit', function(e) {
                    e.preventDefault();
                    var price = calcForm.find('#price').val().replace(/,/g, ''),
                        interestRate = parseFloat(calcForm.find('#interest-rate').val()),
                        termYears = parseInt(calcForm.find('#term-years').val(), 10),
                        downPayment = calcForm.find('#down-payment').val().replace(/,/g, '');

                    var amountFinanced = price - downPayment;
                    var term = termYears * 12; //12 is number of months in year
                    var monthInterest = interestRate / (12 * 100);
                    var interval = Math.pow( 1 + monthInterest, -term );
                    var mortgagePay = amountFinanced * (monthInterest / (1 - interval));
                    var annualCost = mortgagePay * 12;

                    resultHolder.find('.mkdf-mc-payment-value').html((Math.round(mortgagePay * 100)) / 100 + '$');
                    resultHolder.find('.mkdf-mc-amount-financed-value').html((Math.round(amountFinanced * 100)) / 100 + '$');
                    resultHolder.find('.mkdf-mc-mortgage-payments-value').html((Math.round(mortgagePay * 100)) / 100 + '$');
                    resultHolder.find('.mkdf-mc-annual-costs-value').html((Math.round(annualCost * 100)) / 100 + '$');

                    resultHolder.slideDown();
                });
            });
        }
    }

    /**
     * Add/Edit Property
     */
    function mkdfAddEditProperty() {
        var submitForm = $('#mkdf-re-add-property-form, #mkdf-re-edit-property-form');


        if ( submitForm.length ) {
            var btnText = submitForm.find('button'),
                updatingBtnText = btnText.data('updating-text'),
                updatedBtnText = btnText.data('updated-text');

            submitForm.on('submit', function (e) {
                e.preventDefault();
                var prevBtnText = btnText.html(),
                	gallery = $(this).find('.mkdf-membership-gallery-upload-hidden'),
                	namesArray = [],
                	action = '';

                btnText.html(updatingBtnText);

                //get data
                var formData = new FormData();

                //get files
                gallery.each(function(){
                	var thisGallery = $(this),
                		thisName = thisGallery.attr('name'),
                		thisRepeaterID = thisGallery.parents('.mkdf-membership-repeater-field').attr('id'),
                		thisFiles = thisGallery[0].files,
                		newName;

                	//this part is needed for repeater with image uploads
            		if (thisName.indexOf("[]") != "-1") {
            			newName = thisName.substring(0,thisName.length - 2)+'_mkdf_regarray_';

            			var lastIndex = thisRepeaterID.lastIndexOf('-');
            			var index = thisRepeaterID.substring(lastIndex+1);

            			namesArray.push(newName);
            			newName = newName + index + '_';
            		} else {
            			newName = thisName + '_mkdf_reg_';
            		}

            		//if file not sent, send dummy file - so repeater fields are sent
            		if (thisFiles.length == 0){
            			formData.append(newName, new File([""], "mkdf-dummy-file.txt", {
							type: "text/plain",
						}));
            		}
	
	                for (var i = 0; i < thisFiles.length; i++) {
		                var allowedTypes = ['image/png','image/jpg','image/jpeg','application/pdf'];
		                //security purposed - check if there is more than one dot in file name, also check whether the file type is in allowed types
		                if (thisFiles[i].name.match(/\./g).length == 1 && $.inArray(thisFiles[i].type, allowedTypes) !== -1) {
			                formData.append(newName + i, thisFiles[i]);
		                }
	                }
                });

				if (submitForm.attr('id') == 'mkdf-re-add-property-form'){
					action = 'adding';
					formData.append('action', 'mkdf_re_add_property');
				} else {
					action = 'editing';
					formData.append('action', 'mkdf_re_edit_property');
				}
                
				//get data from form
				var otherData = $(this).serialize();
				formData.append('data',otherData);

                $.ajax({
                    type: 'POST',
                    data: formData,
			        contentType: false,
			        processData: false,
                    url: mkdfGlobalVars.vars.mkdfAjaxUrl,
                    success: function (data) {
                        var response;
                        response = JSON.parse(data);

                        // append ajax response html
                        mkdf.modules.socialLogin.mkdfRenderAjaxResponseMessage(response);
                        if (response.status == 'success') {
                            btnText.html(updatedBtnText);
                            window.location = response.redirect;
                        } else {
                            btnText.html(prevBtnText);
                        }
                    }
                });
                return false;
            });
        }
    }

    function mkdfDeleteProperty(){
    	var deleteButtons = $('.mkdf-property-item-delete');

    	if (deleteButtons.length){
    		deleteButtons.each(function(){
    			var thisDeleteButton = $(this),
    				propertyId = thisDeleteButton.data('property-id'),
    				confirmText = thisDeleteButton.data('confirm-text'),
    				property = thisDeleteButton.parents('.mkdf-re-profile-property-item');

    			thisDeleteButton.on('click', function(e){
    				e.preventDefault();

    				var confirmDelete = confirm(confirmText);

    				if (confirmDelete) {

	    				var dataForm = {
	    					'action' : 'mkdf_re_delete_property',
	    					'property_id' : propertyId
	    				}

	    				$.ajax({
		                    type: 'POST',
		                    data: dataForm,
		                    url: mkdfGlobalVars.vars.mkdfAjaxUrl,
		                    success: function (data) {
		                        var response;
		                        response = JSON.parse(data);

		                        if (response.status == 'success') {
		                            property.fadeOut( function(){
				                        property.remove();
				                    });	                            
		                        }
		                    }
	    				});
	    			}
    			});
    		});
    	}
    }

})(jQuery);
(function($) {
    "use strict";

    var compareProperties = {};
    mkdf.modules.compareProperties = compareProperties;
    compareProperties.mkdfHandleAddToCompare = mkdfHandleAddToCompare;

    compareProperties.mkdfOnDocumentReady = mkdfOnDocumentReady;

    $(document).ready(mkdfOnDocumentReady);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
        mkdfCompareHolder();
        mkdfCompareHolderScroll();
        mkdfHandleAddToCompare();
    }

    /**
     * Show/hide side area
     */
    function mkdfCompareHolder() {
        var compareHolder = $('.mkdf-re-compare-holder');

        if(compareHolder.length) {
            var wrapper                 = $('.mkdf-wrapper'),
                compareHolderButtonOpen = $('a.mkdf-re-compare-holder-opener'),
                closePopupButton        = $('.mkdf-re-compare-popup-close'),
                doCompareButton         = $('.mkdf-re-compare-do-compare'),
                doResetButton           = $('.mkdf-re-compare-do-reset'),
                cssClass                = 'mkdf-re-ch-opened';

            var cover = $('.mkdf-cover');
            if (!cover.length) {
                wrapper.prepend('<div class="mkdf-cover"/>');
            }

            compareHolderButtonOpen.on('click', function (e) {
                e.preventDefault();

                if (!compareHolderButtonOpen.hasClass('opened')) {
                    compareHolderButtonOpen.addClass('opened');
                    mkdf.body.addClass(cssClass);

                    $('.mkdf-wrapper .mkdf-cover').on('click', function () {
                        mkdf.body.removeClass(cssClass);
                        compareHolderButtonOpen.removeClass('opened');
                    });
                } else {
                    compareHolderButtonOpen.removeClass('opened');
                    mkdf.body.removeClass(cssClass);
                }
            });

            doCompareButton.on('click', function (e) {
                e.preventDefault();
                mkdfInitItemsComparingPopup();
                compareHolderButtonOpen.trigger("click");
            });

            closePopupButton.on('click', function (e) {
                e.preventDefault();
                mkdfInitComparePopupClose();
            });

            doResetButton.on('click', function (e) {
                e.preventDefault();
                mkdfInitItemsReset();
                closePopupButton.trigger("click");
            });
        }
    }

    /*
     **  Smooth scroll functionality for Compare Holder area
     */
    function mkdfCompareHolderScroll(){
        var compareHolderScroll = $('.mkdf-re-compare-holder .mkdf-re-compare-holder-scroll');
        if(compareHolderScroll.length){
            compareHolderScroll.perfectScrollbar({
                wheelSpeed: 0.6,
                suppressScrollX: true
            });
        }
    }

    function mkdfHandleAddToCompare() {
        var addToCompare = $('.mkdf-re-add-to-compare');
        if(addToCompare.length) {
            addToCompare.each(function() {
               var thisCompare = $(this);
               if(!thisCompare.hasClass('mkdf-init-compare')) {
                   thisCompare.on('click', function () {
                       var id = $(this).data('item-id');
                       mkdfInitAddToCompareClick(id);
                   });
                   thisCompare.addClass('mkdf-init-compare');
               }
            });
        }
    }

    function mkdfInitAddToCompareClick(id) {
        var ajaxData = {
            action: 'mkdf_re_handle_add_to_compare',
            item_id: id
        };

        $.ajax({
            type: 'POST',
            data: ajaxData,
            url: mkdfGlobalVars.vars.mkdfAjaxUrl,
            success: function (data) {
                var responseObject = JSON.parse(data);
                var dataReceived = responseObject.data;
                var action = dataReceived.action;
                var buttonText = dataReceived.button_text;
                if(action == 'removed') {
                    mkdfRemoveCompareFromList(id);
                    mkdfRefreshComparePopup();
                    mkdfRefreshOpenIcon(dataReceived.items_no);
                    mkdfCompareHolderScroll();
	                mkdfRefreshCompareButtonText(id, buttonText);
                }
                else if(action == 'error') {
                    alert(dataReceived.message)
                }
                else if(action == 'added') {
                    mkdfAddCompareToList(dataReceived.item);
                    mkdfRefreshComparePopup();
                    mkdfRefreshOpenIcon(dataReceived.items_no);
                    mkdfCompareHolderScroll();
	                mkdfRefreshCompareButtonText(id, buttonText);
                }
            }
        });
    }

    function mkdfRemoveCompareFromList(id) {
        var compareItemsHolder = $('.mkdf-re-compare-items-holder');
        if(compareItemsHolder.length) {
            var itemToRemove = compareItemsHolder.find(".mkdf-ci-item[data-item-id='" + id + "']");
            itemToRemove.addClass('mkdf-with-opacity');
            itemToRemove.remove();
        }
    }

    function mkdfAddCompareToList(item) {
        var compareItemsHolder = $('.mkdf-re-compare-items-holder');
        if(compareItemsHolder.length) {
            compareItemsHolder.append(item);
            mkdfHandleAddToCompare();
        }
    }

    function mkdfInitItemsComparingPopup() {
        var comparePopupHolder = $('.mkdf-re-compare-popup');
        if(comparePopupHolder.length) {
            if(!comparePopupHolder.hasClass('mkdf-re-popup-opened')){
                comparePopupHolder.addClass('mkdf-re-popup-opened');
                mkdf.modules.common.mkdfDisableScroll();
	            mkdfInitComparePopupScroll();
            }
        }
    }

    function mkdfInitComparePopupScroll(){
        var comparePopupHolder = $('.mkdf-re-compare-popup'),
            itemsHolder = comparePopupHolder.find('#mkdf-re-popup-items');
        itemsHolder.perfectScrollbar({
            wheelSpeed: 0.6,
            suppressScrollX: true
        });
    }

    function mkdfInitComparePopupClose(){
        var comparePopupHolder = $('.mkdf-re-compare-popup');
        comparePopupHolder.removeClass('mkdf-re-popup-opened');
	    mkdf.modules.common.mkdfEnableScroll();
    }

    function mkdfInitItemsReset() {
        var compareItemsHolder = $('.mkdf-re-compare-items-holder');
        if(compareItemsHolder.length) {
            var ajaxData = {
                action: 'mkdf_re_handle_clear_compare_list'
            };

            $.ajax({
                type: 'POST',
                data: ajaxData,
                url: mkdfGlobalVars.vars.mkdfAjaxUrl,
                success: function (data) {
                    var responseObject = JSON.parse(data);
                    var status = responseObject.status;
                    if(status == 'success') {
                        var returnData = responseObject.data;
                        var buttonText = returnData.button_text;
                        compareItemsHolder.empty();
                        mkdfRefreshComparePopup();
                        mkdfRefreshOpenIcon(0);
	                    mkdfRefreshCompareButtonText(0,buttonText);
                    }
                }
            });
        }
    }

    function mkdfRefreshComparePopup() {
        var itemsHolder = $('.mkdf-re-popup-items-holder');
        itemsHolder.find('ul').addClass('mkdf-with-opacity');
        if (itemsHolder.length) {
            var ajaxData = {
                action: 'mkdf_re_refresh_compare_popup'
            };
            $.ajax({
                type: 'POST',
                data: ajaxData,
                url: mkdfGlobalVars.vars.mkdfAjaxUrl,
                success: function (data) {
                    var responseObject = JSON.parse(data);
                    var status = responseObject.status;
                    if(status == 'success') {
                        itemsHolder.html(responseObject.data);
                        mkdfHandleAddToCompare();
                    }
                }
            });
        }
    }

    function mkdfRefreshOpenIcon(items_no) {
        var itemsHolder = $('.mkdf-re-compare-holder');
        var compareHolderButtonOpen = $('a.mkdf-re-compare-holder-opener');
        if (itemsHolder.length) {
            if(items_no == 0) {
                if(!itemsHolder.hasClass('mkdf-compare-empty')) {
                    itemsHolder.addClass('mkdf-compare-empty');
                }
                if (compareHolderButtonOpen.hasClass('opened')) {
                    compareHolderButtonOpen.trigger('click');
                }
                mkdfInitComparePopupClose();
            } else if(items_no > 0) {
                if(itemsHolder.hasClass('mkdf-compare-empty')) {
                    itemsHolder.removeClass('mkdf-compare-empty');
                }
            }
        }
    }
	
	function mkdfRefreshCompareButtonText(id, text) {
        if(id == 0) {
	        var addToCompareAll = $('.mkdf-re-add-to-compare');
	        if(addToCompareAll.length) {
		        addToCompareAll.each(function() {
			        $(this).find('.mkdf-re-add-to-compare-text').text(text);
		        });
	        }
        } else {
	        var addToCompareID = $('.mkdf-re-add-to-compare[data-item-id="' + id + '"]');
	        if (addToCompareID.length) {
		        addToCompareID.each(function () {
			        $(this).find('.mkdf-re-add-to-compare-text').text(text);
		        });
	        }
        }
    }

})(jQuery);

(function ($) {
    'use strict';

    var propertyProfile = {};
    mkdf.modules.propertyProfile = propertyProfile;

    propertyProfile.mkdfOnDocumentReady = mkdfOnDocumentReady;

    $(document).ready(mkdfOnDocumentReady);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
        mkdfInitSavedSearchesRemove();
    }

    function mkdfInitSavedSearchesRemove() {
        var searchesTab = $('.mkdf-re-profile-searches-holder');
        if(searchesTab.length) {
            var removeQueryButton = searchesTab.find('.mkdf-undo-query-save');
            removeQueryButton.click(function() {
                if(!confirm('Are you sure you want to remove this search?')) {
                    return;
                }

                var thisButton = $(this);
                thisButton.html('<span class="fa fa-spinner fa-spin" aria-hidden="true"></span>');

                var ajaxData = {
                    action: 'mkdf_re_property_ajax_remove_query',
                    query_id: thisButton.data('query-id')
                };

                $.ajax({
                    type: 'POST',
                    data: ajaxData,
                    url: mkdfGlobalVars.vars.mkdfAjaxUrl,
                    success: function (data) {
                        var response;
                        response = JSON.parse(data);
                        if(response.status == 'success') {
                            thisButton.closest('tr').remove();
                        } else if(response.status == 'error') {
                            thisButton.html('<i class="fa fa-times" aria-hidden="true"></i>');
                        }
                    }
                });
            });
        }
    }

})(jQuery);
(function($) {
    'use strict';

    var propertyList = {};
    mkdf.modules.propertyList = propertyList;

    propertyList.mkdfOnDocumentReady = mkdfOnDocumentReady;
    propertyList.mkdfOnWindowLoad = mkdfOnWindowLoad;
    propertyList.mkdfOnWindowResize = mkdfOnWindowResize;
    propertyList.mkdfOnWindowScroll = mkdfOnWindowScroll;

    $(document).ready(mkdfOnDocumentReady);
    $(window).load(mkdfOnWindowLoad);
    $(window).resize(mkdfOnWindowResize);
    $(window).scroll(mkdfOnWindowScroll);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
        mkdfInitRangeSlider();
        mkdfInitQuantityButtons();
    }

    /*
     All functions to be called on $(window).load() should be in this function
     */
    function mkdfOnWindowLoad() {
        mkdfInitPropertyListMasonry();
        mkdfInitPropertyListFilter();
        mkdfBindListTitlesAndMap();
        mkdfInitPropertyListPagination().init();
    }

    /*
     All functions to be called on $(window).resize() should be in this function
     */
    function mkdfOnWindowResize() {
        mkdfInitPropertyListMasonry();
    }

    /*
     All functions to be called on $(window).scroll() should be in this function
     */
    function mkdfOnWindowScroll() {
        mkdfInitPropertyListPagination().scroll();
    }

    /**
     * Initializes property masonry list
     */
    function mkdfInitPropertyListMasonry(){
        var propertyList = $('.mkdf-property-list-holder.mkdf-pl-masonry');
        if(propertyList.length){
            propertyList.each(function(){
                var thisPropertyList = $(this),
                    masonry = thisPropertyList.find('.mkdf-pl-inner'),
                    size = thisPropertyList.find('.mkdf-pl-grid-sizer').width();

                mkdfResizePropertyItems(size, thisPropertyList);

                masonry.isotope({
                    layoutMode: 'packery',
                    itemSelector: 'article',
                    percentPosition: true,
                    packery: {
                        gutter: '.mkdf-pl-grid-gutter',
                        columnWidth: '.mkdf-pl-grid-sizer'
                    }
                });

                setTimeout(function () {
                    mkdf.modules.common.mkdfInitParallax();
                }, 600);

                masonry.css('opacity', '1');
            });
        }
    }

    /**
     * Init Resize Property List Items
     */
    function mkdfResizePropertyItems(size,container){
        if(container.hasClass('mkdf-pl-images-fixed')) {
            var padding = parseInt(container.find('article').css('padding-left')),
                defaultMasonryItem = container.find('.mkdf-pl-masonry-default'),
                largeWidthMasonryItem = container.find('.mkdf-pl-masonry-large-width'),
                largeHeightMasonryItem = container.find('.mkdf-pl-masonry-large-height'),
                largeWidthHeightMasonryItem = container.find('.mkdf-pl-masonry-large-width-height');

            if (mkdf.windowWidth > 680) {
                defaultMasonryItem.css('height', size - 2 * padding);
                largeHeightMasonryItem.css('height', Math.round(2 * size) - 2 * padding);
                largeWidthHeightMasonryItem.css('height', Math.round(2 * size) - 2 * padding);
                largeWidthMasonryItem.css('height', size - 2 * padding);
            } else {
                defaultMasonryItem.css('height', size);
                largeHeightMasonryItem.css('height', size);
                largeWidthHeightMasonryItem.css('height', size);
                largeWidthMasonryItem.css('height', Math.round(size / 2));
            }
        }
    }

    function mkdfBindListTitlesAndMap() {
        var propertyList = $('.mkdf-property-list-holder');
        if(propertyList.length){
            propertyList.each(function(){
                var thisPropertyList = $(this),
                    itemsHolder = thisPropertyList.find('.mkdf-pl-inner'),
                    listItems = thisPropertyList.find('article'),
                    map = thisPropertyList.find('.mkdf-property-list-map-part');

                if(map.length) {
                    listItems.each(function() {
                        var listItem = $(this);
                        if(!listItem.hasClass("mkdf-init")) {
                            listItem.mouseenter(function () {
                                var itemId = listItem.attr('id');
                                var markersHolder = $('.mkdf-map-marker-holder:not(.mapActive)');
                                if (markersHolder.length) {
                                    markersHolder.removeClass('active');
                                    $('#' + itemId + '.mkdf-map-marker-holder').addClass('active');
                                }
                            });
                            listItem.addClass("mkdf-init")
                        }
                    });
                    itemsHolder.mouseleave(function () {
                        $('.mkdf-map-marker-holder').each(function() {
                           if(!$(this).hasClass('mapActive')) {
                               $(this).removeClass('active');
                            }
                        });
                    });
                }
            });
        }
    }


    function mkdfInitRangeSlider(){

        var selectorHolder =  $('.mkdf-property-list-filter-part .mkdf-filter-price-holder');
        var slider = selectorHolder.find('.mkdf-range-slider');
        var outputMin = selectorHolder.find('#mkdf-min-price-value');
        var valueMin = outputMin.data('min-price');
        var outputMax = selectorHolder.find('#mkdf-max-price-value');
        var valueMax = outputMax.data('max-price');

        var priceLabelSetting = selectorHolder.data('price-label-setting');
        var maxPriceSetting = selectorHolder.data('max-price-setting');
        // Basic rangeslider initialization
        slider.slider({
            range: true,
            animate: true,
            min: 0,
            max: maxPriceSetting,
            step: 25,
            values: [ valueMin, valueMax],
            create: function() {

            },
            slide: function( event, ui ) {
                outputMin.html(priceLabelSetting + ui.values[0] );
                outputMax.html(priceLabelSetting + ui.values[1] );
            },
            change: function( event, ui ) {
                outputMin.data('min-price', ui.values[0] );
                outputMax.data('max-price', ui.values[1] );
            }
        });

        $(document).on('property_list_filter_reset', slider, function (e) {
            slider.slider("values", 0, 0);
            slider.slider("values", 1, maxPriceSetting);
            outputMin.html(priceLabelSetting + 0 );
            outputMax.html(priceLabelSetting + maxPriceSetting );
            outputMin.data('min-price', 0 );
            outputMax.data('max-price', maxPriceSetting );
        });
    }

    /*
     ** Init quantity buttons to increase/decrease specification values
     */
    function mkdfInitQuantityButtons() {
        $(document).on('click', '.mkdf-spec-quantity-minus, .mkdf-spec-quantity-plus', function (e) {
            e.stopPropagation();

            var button = $(this),
                inputField = button.siblings('.mkdf-spec-quantity-input'),
                step = parseFloat(inputField.data('step')),
                max = parseFloat(inputField.data('max')),
                minus = false,
                inputValue = parseFloat(inputField.val()),
                newInputValue;

            if (button.hasClass('mkdf-spec-quantity-minus')) {
                minus = true;
            }

            if (minus) {
                newInputValue = inputValue - step;
                if (newInputValue >= 1) {
                    inputField.val(newInputValue);
                } else {
                    inputField.val(0);
                }
            } else {
                newInputValue = inputValue + step;
                if (max === undefined) {
                    inputField.val(newInputValue);
                } else {
                    if (newInputValue >= max) {
                        inputField.val(max);
                    } else {
                        inputField.val(newInputValue);
                    }
                }
            }
        });
    }

    /**
     * Initializes property list pagination functions
     */
    function mkdfInitPropertyListPagination(){
        var propertyList = $('.mkdf-property-list-holder');

        var initStandardPagination = function(thisPropertyList) {
            var standardLink = thisPropertyList.find('.mkdf-pl-standard-pagination li');

            if(standardLink.length) {
                standardLink.each(function(){
                    var thisLink = $(this).children('a'),
                        pagedLink = 1;

                    thisLink.on('click', function(e) {
                        e.preventDefault();
                        e.stopPropagation();

                        if (typeof thisLink.data('paged') !== 'undefined' && thisLink.data('paged') !== false) {
                            pagedLink = thisLink.data('paged');
                        }

                        initMainPagFunctionality(thisPropertyList, pagedLink);
                    });
                });
            }
        };

        var initLoadMorePagination = function(thisPropertyList) {
            var loadMoreButton = thisPropertyList.find('.mkdf-pl-load-more a');

            loadMoreButton.on('click', function(e) {
                e.preventDefault();
                e.stopPropagation();

                initMainPagFunctionality(thisPropertyList);
            });
        };

        var initInifiteScrollPagination = function(thisPropertyList) {
            var propertyListHeight = thisPropertyList.outerHeight(),
                propertytListTopOffest = thisPropertyList.offset().top,
                propertyListPosition = propertyListHeight + propertytListTopOffest - mkdfGlobalVars.vars.mkdfAddForAdminBar;

            if(!thisPropertyList.hasClass('mkdf-pl-infinite-scroll-started') && mkdf.scroll + mkdf.windowHeight > propertyListPosition) {
                initMainPagFunctionality(thisPropertyList);
            }
        };

        var initMainPagFunctionality = function(thisPropertyList, pagedLink) {
            var thisPropertyListInner = thisPropertyList.find('.mkdf-pl-inner'),
                nextPage,
                maxNumPages;
            if (typeof thisPropertyList.data('max-num-pages') !== 'undefined' && thisPropertyList.data('max-num-pages') !== false) {
                maxNumPages = thisPropertyList.data('max-num-pages');
            }

            if(thisPropertyList.hasClass('mkdf-pl-pag-standard')) {
                thisPropertyList.data('next-page', pagedLink);
            }

            if(thisPropertyList.hasClass('mkdf-pl-pag-infinite-scroll')) {
                thisPropertyList.addClass('mkdf-pl-infinite-scroll-started');
            }

            if(pagedLink == 1) {
                thisPropertyList.data('next-page', pagedLink);
            }

            var loadMoreData = mkdf.modules.common.getLoadMoreData(thisPropertyList),
                loadingItem = thisPropertyList.find('.mkdf-pl-loading'),
                filterLoadingItem = thisPropertyList.find('.mkdf-pl-filter-loading');

            nextPage = loadMoreData.nextPage;
            if(nextPage <= maxNumPages || maxNumPages == 0){
                if(nextPage == 1) {
                    filterLoadingItem.addClass('mkdf-showing');
                } else {
                    if (thisPropertyList.hasClass('mkdf-pl-pag-standard')) {
                        loadingItem.addClass('mkdf-showing mkdf-standard-pag-trigger');
                        thisPropertyList.addClass('mkdf-pl-pag-standard-animate');
                    } else {
                        loadingItem.addClass('mkdf-showing');
                    }
                }

                var ajaxData = mkdf.modules.common.setLoadMoreAjaxData(loadMoreData, 'mkdf_re_property_ajax_load_more');

                $.ajax({
                    type: 'POST',
                    data: ajaxData,
                    url: mkdfGlobalVars.vars.mkdfAjaxUrl,
                    success: function (data) {
                        if(!thisPropertyList.hasClass('mkdf-pl-pag-standard')) {
                            nextPage++;
                        }

                        thisPropertyList.data('next-page', nextPage);

                        var response = $.parseJSON(data),
                            responseHtml =  response.html;

                        //get map items
                        var mapObjs = response.mapAddresses;
                        var mapAddresses = '';
                        if(mapObjs !== null && mapObjs["addresses"] != undefined){
                            mapAddresses = mapObjs['addresses'];
                        }

                        if(thisPropertyList.hasClass('mkdf-pl-pag-standard')  || pagedLink == 1) {
                            mkdfInitStandardPaginationLinkChanges(thisPropertyList, maxNumPages, nextPage);

                            thisPropertyList.waitForImages(function(){
                                if(thisPropertyList.hasClass('mkdf-pl-masonry')){
                                    mkdfInitHtmlIsotopeNewContent(thisPropertyList, thisPropertyListInner, loadingItem, filterLoadingItem, responseHtml, mapAddresses);
                                } else if (thisPropertyList.hasClass('mkdf-pl-gallery') && thisPropertyList.hasClass('mkdf-pl-has-filter')) {
                                    mkdfInitHtmlIsotopeNewContent(thisPropertyList, thisPropertyListInner, loadingItem, filterLoadingItem, responseHtml, mapAddresses);
                                } else {
                                    mkdfInitHtmlGalleryNewContent(thisPropertyList, thisPropertyListInner, loadingItem, filterLoadingItem, responseHtml, mapAddresses);
                                }
                            });
                        } else {
                            thisPropertyList.waitForImages(function(){
                                if(thisPropertyList.hasClass('mkdf-pl-masonry')){
                                    if(pagedLink == 1) {
                                        mkdfInitHtmlIsotopeNewContent(thisPropertyList, thisPropertyListInner, loadingItem, filterLoadingItem, responseHtml, mapAddresses);
                                    } else {
                                        mkdfInitAppendIsotopeNewContent(thisPropertyList, thisPropertyListInner, loadingItem, filterLoadingItem, responseHtml, mapAddresses);
                                    }
                                } else if (thisPropertyList.hasClass('mkdf-pl-gallery') && thisPropertyList.hasClass('mkdf-pl-has-filter') && pagedLink != 1) {
                                    mkdfInitAppendIsotopeNewContent(thisPropertyList, thisPropertyListInner, loadingItem, filterLoadingItem, responseHtml, mapAddresses);
                                } else {
                                    mkdfInitAppendGalleryNewContent(thisPropertyList, thisPropertyListInner, loadingItem, filterLoadingItem, responseHtml, mapAddresses);
                                }
                            });
                        }

                        if(thisPropertyList.hasClass('mkdf-pl-infinite-scroll-started')) {
                            thisPropertyList.removeClass('mkdf-pl-infinite-scroll-started');
                        }
                    }
                });
            }

            if(pagedLink == 1) {
                thisPropertyList.find('.mkdf-pl-load-more-holder').show();
            }

            if(nextPage === maxNumPages){
                thisPropertyList.find('.mkdf-pl-load-more-holder').hide();
            }
        };

        var mkdfInitStandardPaginationLinkChanges = function(thisPropertyList, maxNumPages, nextPage) {
            var standardPagHolder = thisPropertyList.find('.mkdf-pl-standard-pagination'),
                standardPagNumericItem = standardPagHolder.find('li.mkdf-pl-pag-number'),
                standardPagPrevItem = standardPagHolder.find('li.mkdf-pl-pag-prev a'),
                standardPagNextItem = standardPagHolder.find('li.mkdf-pl-pag-next a');

            standardPagNumericItem.removeClass('mkdf-pl-pag-active');
            standardPagNumericItem.eq(nextPage-1).addClass('mkdf-pl-pag-active');

            standardPagPrevItem.data('paged', nextPage-1);
            standardPagNextItem.data('paged', nextPage+1);

            if(nextPage > 1) {
                standardPagPrevItem.css({'opacity': '1'});
            } else {
                standardPagPrevItem.css({'opacity': '0'});
            }

            if(nextPage === maxNumPages) {
                standardPagNextItem.css({'opacity': '0'});
            } else {
                standardPagNextItem.css({'opacity': '1'});
            }
        };

        var mkdfInitHtmlIsotopeNewContent = function(thisPropertyList, thisPropertyListInner, loadingItem, filterLoadingItem, responseHtml, mapAddresses) {
            thisPropertyListInner.find('article').remove();
            thisPropertyListInner.append(responseHtml);
            if(thisPropertyList.hasClass('mkdf-pl-with-map')) {
                if(mapAddresses !== ''){
                    mkdf.modules.realEstateMaps.mkdfReinitMultipleGoogleMaps(mapAddresses, 'append');
                    mkdfBindListTitlesAndMap();
                }
            }
            mkdfResizePropertyItems(thisPropertyListInner.find('.mkdf-pl-grid-sizer').width(), thisPropertyList);
            thisPropertyListInner.isotope('reloadItems').isotope({sortBy: 'original-order'});
            loadingItem.removeClass('mkdf-showing mkdf-standard-pag-trigger');
            filterLoadingItem.removeClass('mkdf-showing');
            thisPropertyList.removeClass('mkdf-pl-pag-standard-animate');

            setTimeout(function() {
                thisPropertyListInner.isotope('layout');
                //mkdfInitPropertyListAnimation();
                mkdf.modules.common.mkdfInitParallax();
            }, 600);
        };

        var mkdfInitHtmlGalleryNewContent = function(thisPropertyList, thisPropertyListInner, loadingItem, filterLoadingItem, responseHtml, mapAddresses) {
            loadingItem.removeClass('mkdf-showing mkdf-standard-pag-trigger');
            filterLoadingItem.removeClass('mkdf-showing');
            thisPropertyList.removeClass('mkdf-pl-pag-standard-animate');
            thisPropertyListInner.html(responseHtml);
            if(thisPropertyList.hasClass('mkdf-pl-with-map')) {
                if(mapAddresses !== ''){
                    mkdf.modules.realEstateMaps.mkdfReinitMultipleGoogleMaps(mapAddresses, 'replace');
                    mkdfBindListTitlesAndMap();
                }
            }

            mkdf.modules.common.mkdfInitParallax();
        };

        var mkdfInitAppendIsotopeNewContent = function(thisPropertyList, thisPropertyListInner, loadingItem, filterLoadingItem, responseHtml, mapAddresses) {
            thisPropertyListInner.append(responseHtml);
            mkdfResizePropertyItems(thisPropertyListInner.find('.mkdf-pl-grid-sizer').width(), thisPropertyList);
            thisPropertyListInner.isotope('reloadItems').isotope({sortBy: 'original-order'});
            if(thisPropertyList.hasClass('mkdf-pl-with-map')) {
                if(mapAddresses !== ''){
                    mkdf.modules.realEstateMaps.mkdfReinitMultipleGoogleMaps(mapAddresses, 'append');
                    mkdfBindListTitlesAndMap();
                }
            }
            loadingItem.removeClass('mkdf-showing');
            filterLoadingItem.removeClass('mkdf-showing');

            setTimeout(function() {
                thisPropertyListInner.isotope('layout');
                //mkdfInitPropertyListAnimation();
                mkdf.modules.common.mkdfInitParallax();
            }, 600);
        };

        var mkdfInitAppendGalleryNewContent = function(thisPropertyList, thisPropertyListInner, loadingItem, filterLoadingItem, responseHtml, mapAddresses) {
            loadingItem.removeClass('mkdf-showing');
            filterLoadingItem.removeClass('mkdf-showing');
            thisPropertyListInner.append(responseHtml);
            if(thisPropertyList.hasClass('mkdf-pl-with-map')) {
                if(mapAddresses !== ''){
                    mkdf.modules.realEstateMaps.mkdfReinitMultipleGoogleMaps(mapAddresses, 'append');
                    mkdfBindListTitlesAndMap();
                }
            }
            //mkdfInitPropertyListAnimation();
            mkdf.modules.common.mkdfInitParallax();
        };

        return {
            init: function() {
                if(propertyList.length) {
                    propertyList.each(function() {
                        var thisPortList = $(this);

                        if(thisPortList.hasClass('mkdf-pl-pag-standard')) {
                            initStandardPagination(thisPortList);
                        }

                        if(thisPortList.hasClass('mkdf-pl-pag-load-more')) {
                            initLoadMorePagination(thisPortList);
                        }

                        if(thisPortList.hasClass('mkdf-pl-pag-infinite-scroll')) {
                            initInifiteScrollPagination(thisPortList);
                        }
                    });
                }
            },
            scroll: function() {
                if(propertyList.length) {
                    propertyList.each(function() {
                        var thisPropertyList = $(this);

                        if(thisPropertyList.hasClass('mkdf-pl-pag-infinite-scroll')) {
                            initInifiteScrollPagination(thisPropertyList);
                        }
                    });
                }
            },
            getMainPagFunction: function(thisPropertyList, paged) {
                initMainPagFunctionality(thisPropertyList, paged);
            }
        };
    }

    function mkdfInitPropertyListFilter() {
        var filters = $('.mkdf-property-list-filter-part');
        if(filters.length) {
            filters.each(function() {
                var thisFilter = $(this),
                    thisPropertyList    = thisFilter.parents('.mkdf-property-list-holder'),
                    button              = thisFilter.find('.mkdf-property-filter-button'),
                    status              = thisFilter.find('.mkdf-filter-status-holder'),
                    type                = thisFilter.find('.mkdf-filter-type-holder'),
                    city                = thisFilter.find('.mkdf-filter-city-holder'),
                    minPrice            = thisFilter.find('#mkdf-min-price-value'),
                    maxPrice            = thisFilter.find('#mkdf-max-price-value'),
                    minSize             = thisFilter.find('.mkdf-min-size'),
                    maxSize             = thisFilter.find('.mkdf-max-size'),
                    bedrooms            = thisFilter.find('#mkdf-specification-bedrooms'),
                    bathrooms           = thisFilter.find('#mkdf-specification-bathrooms');


                //INIT STATUS FIELD
                if(status.length > 0) {
                    initSelect2Field(status, 'status');
                }
                if(city.length > 0) {
                    initSelect2Field(city, 'city');
                }

                if(type.length > 0) {
                    initTypesField(type, 'type');
                }

                button.click(function() {
                   var statusValue      = status.data('status'),
                       typeValue        = type.data('type'),
                       cityValue        = city.data('city'),
                       minPriceValue    = minPrice.data('min-price'),
                       maxPriceValue    = maxPrice.data('max-price'),
                       minSizeValue     = minSize.val(),
                       maxSizeValue     = maxSize.val(),
                       bedroomsValue    = bedrooms.val(),
                       bathroomsValue   = bathrooms.val();
                    var features = [];
                    $("input[name='mkdf-features[]']:checked").each(function (){
                        features.push(parseInt($(this).data('id')));
                    });
                    features = features.join(',');

                    thisPropertyList.data('property-status', statusValue);
                    thisPropertyList.data('property-type', typeValue);
                    thisPropertyList.data('property-city', cityValue);
                    thisPropertyList.data('property-min-price', minPriceValue);
                    thisPropertyList.data('property-max-price', maxPriceValue);
                    thisPropertyList.data('property-min-size', minSizeValue);
                    thisPropertyList.data('property-max-size', maxSizeValue);
                    thisPropertyList.data('property-bedrooms', bedroomsValue);
                    thisPropertyList.data('property-bathrooms', bathroomsValue);
                    thisPropertyList.data('property-features', features);

                    mkdfInitPropertyListPagination().getMainPagFunction(thisPropertyList, 1);
                });

                //INIT SAVE QUERY
                var queryHolder = thisPropertyList.find('.mkdf-property-query-section');
                if(queryHolder.length) {
                    var saveQueryButton = queryHolder.find('.mkdf-property-save-search-button');
                    var resultHolder = queryHolder.find('.mkdf-query-result');

                    saveQueryButton.click(function() {
                        if(mkdf.body.hasClass('logged-in')) {
                            resultHolder.html('<span class="fa fa-spinner fa-spin" aria-hidden="true"></span>');

                            var statusValue = status.data('status'),
                                typeValue = type.data('type'),
                                cityValue = city.data('city'),
                                minPriceValue = minPrice.data('min-price'),
                                maxPriceValue = maxPrice.data('max-price'),
                                minSizeValue = minSize.val(),
                                maxSizeValue = maxSize.val(),
                                bedroomsValue = bedrooms.val(),
                                bathroomsValue = bathrooms.val();
                            var features = [];
                            $("input[name='mkdf-features[]']:checked").each(function () {
                                features.push(parseInt($(this).data('id')));
                            });
                            features = features.join(',');

                            var ajaxData = {
                                action: 'mkdf_re_property_ajax_save_query',
                                status: statusValue,
                                type: typeValue,
                                city: cityValue,
                                minPrice: minPriceValue,
                                maxPrice: maxPriceValue,
                                minSize: minSizeValue,
                                maxSize: maxSizeValue,
                                bedrooms: bedroomsValue,
                                bathrooms: bathroomsValue,
                                features: features
                            };

                            $.ajax({
                                type: 'POST',
                                data: ajaxData,
                                url: mkdfGlobalVars.vars.mkdfAjaxUrl,
                                success: function (data) {
                                    var response;
                                    response = JSON.parse(data);
                                    resultHolder.html('<span class="mkdf-result-message">' + response.message + '</span>');
                                    resultHolder.append(response.data);
                                    mkdfInitUndoQueryButton(queryHolder);
                                }
                            });
                        } else {
                            // Trigger event.
                            $( document.body ).trigger( 'open_user_login_trigger' );
                        }
                    });
                }

                //INIT RESET FILTER
                var resetButton = thisPropertyList.find('.mkdf-property-filter-reset-button');
                if (resetButton.length) {
                    resetButton.click(function(e) {
                       e.preventDefault();
                        var featuresList = thisPropertyList.find('.mkdf-feature-cb');
                        $( document.body ).trigger( 'property_list_filter_reset' );
                        minSize.val('');
                        maxSize.val('');
                        bedrooms.val(0);
                        bathrooms.val(0);
                        featuresList.each(function() {
                           $(this).prop('checked', false);
                        });
                        resetSelect2Field(status, 'status', status.data('default-status'));
                        resetSelect2Field(city, 'city', city.data('default-city'));
                        setTypesValue(type, 'type', type.data('default-type'));
                        button.trigger('click');
                    });
                }
            })
        }

        function initSelect2Field(selectElement, paramName) {
            var select2Field = selectElement.find('select');
            if(select2Field.length) {
                select2Field.select2({
                    minimumResultsForSearch: -1
                }).on('select2:select', function (e) {
                    var selectedElement = $(e.currentTarget);
                    var selectVal = selectedElement.val();
                    selectElement.data(paramName, selectVal);
                });
            }
        }

        function resetSelect2Field(selectElement, selectParam, selectValue) {
            var select2Field = selectElement.find('select');
            select2Field.val(selectValue).trigger('change');
            selectElement.data(selectParam, selectValue);
        }

        function initTypesField(typeElement, paramName) {
            var typeItems = typeElement.find('.mkdf-ptl-item');
            typeItems.click(function (e) {
                e.preventDefault();
                var selectedItem = $(this);
                setTypesValue(typeElement, paramName, selectedItem.data('id'));
            })
        }

        function setTypesValue(typeElement, typeParam, typeValue) {
            var typeItems = typeElement.find('.mkdf-ptl-item');
            if(typeValue == '') {
                typeItems.removeClass('active');
                typeElement.data(typeParam, '');
            }
            else {
                var item = typeElement.find('.mkdf-ptl-item[data-id=' + typeValue +']');
                if(item.hasClass('active')) {
                    item.removeClass('active');
                    typeElement.data(typeParam, '');
                } else {
                    typeItems.removeClass('active');
                    item.addClass('active');
                    typeElement.data(typeParam, typeValue);
                }
            }
        }
    }

    function mkdfInitUndoQueryButton(queryHolder) {
        var undoQueryButton = queryHolder.find('.mkdf-undo-query-save');
        var resultHolder = queryHolder.find('.mkdf-query-result');
        undoQueryButton.click(function() {
            resultHolder.html('<span class="fa fa-spinner fa-spin" aria-hidden="true"></span>');

            var ajaxData = {
                action: 'mkdf_re_property_ajax_remove_query',
                query_id: undoQueryButton.data('query-id')
            };

            $.ajax({
                type: 'POST',
                data: ajaxData,
                url: mkdfGlobalVars.vars.mkdfAjaxUrl,
                success: function (data) {
                    var response;
                    response = JSON.parse(data);
                    resultHolder.html('<span class="mkdf-result-message">' + response.message + '</span>');
                    resultHolder.append(response.data);
                }
            });
        });
    }

})(jQuery);
(function($) {
    'use strict';

    var propertySearch = {};
    mkdf.modules.propertySearch = propertySearch;

    propertySearch.mkdfOnDocumentReady = mkdfOnDocumentReady;
    propertySearch.mkdfOnWindowLoad = mkdfOnWindowLoad;
    propertySearch.mkdfOnWindowResize = mkdfOnWindowResize;
    propertySearch.mkdfOnWindowScroll = mkdfOnWindowScroll;

    $(document).ready(mkdfOnDocumentReady);
    $(window).load(mkdfOnWindowLoad);
    $(window).resize(mkdfOnWindowResize);
    $(window).scroll(mkdfOnWindowScroll);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
        initSearchParams();
    }

    /*
     All functions to be called on $(window).load() should be in this function
     */
    function mkdfOnWindowLoad() {

    }

    /*
     All functions to be called on $(window).resize() should be in this function
     */
    function mkdfOnWindowResize() {

    }

    /*
     All functions to be called on $(window).scroll() should be in this function
     */
    function mkdfOnWindowScroll() {

    }

    function initSearchParams() {
        var searchHolder = $('.mkdf-property-search-holder');
        if(searchHolder.length) {
            searchHolder.each(function() {
               var thisSearch = $(this);

                //INIT STATUS FIELD
                var status = thisSearch.find('.mkdf-search-status-section');
                if(status.length) {
                    status.each(function() {
                        var selectStatus = status.find('select');
                        if(selectStatus.length) {
                            selectStatus.select2({
                                minimumResultsForSearch: -1
                            }).on('select2:select', function (e) {

                            });
                        }
                    });
                }

                //INIT TYPE FIELD
                var type = thisSearch.find('.mkdf-search-type-section');
                if(type.length) {
                    type.each(function() {
                        var thisTypeSection = $(this),
                            thisTypeInput = thisTypeSection.find('input[name=mkdf-search-type]'),
                            typeItems = thisTypeSection.find('.mkdf-ptl-item');
                        typeItems.click(function (e) {
                            e.preventDefault();
                            var selectedItem = $(this);
                            if(selectedItem.hasClass('active')) {
                                thisTypeInput.val('');
                                selectedItem.removeClass('active');
                            } else {
                                typeItems.removeClass('active');
                                selectedItem.addClass('active');
                                thisTypeInput.val(selectedItem.data('id'));
                            }
                        })
                    });
                }

                //INIT CITY FIELD
                var city = thisSearch.find('.mkdf-search-city-section');
                if(city.length) {
                    city.each(function() {
                        var selectCity = city.find('select');
                        if (selectCity.length) {
                            selectCity.select2({
                                minimumResultsForSearch: -1
                            }).on('select2:select', function (e) {

                            });
                        }
                    });
                }
            });
        }
    }

})(jQuery);
(function($) {
    'use strict';

    var idxpress = {};
    mkdf.modules.idxpress = idxpress;

    idxpress.mkdfOnWindowLoad = mkdfOnWindowLoad;

    $(window).load(mkdfOnWindowLoad);

    /*
     All functions to be called on $(window).load() should be in this function
     */
    function mkdfOnWindowLoad() {
        mkdfInitIDXSelect2();
    }

    /*
     ** Init select2 script for select html dropdowns
     */
    function mkdfInitIDXSelect2() {
        var idxSelect = $('.dsidx-resp-search-form select');
        if (idxSelect.length) {
            idxSelect.each(function() {
               var thisSelect = $(this);

                thisSelect.select2({
                    minimumResultsForSearch: Infinity
                });
            });
        }

        var idxSort = $('.dsidx-sorting-control select');
        if(idxSort.length) {
            idxSort.each(function() {
               var thisSort = $(this);

                thisSort.select2({
                    minimumResultsForSearch: Infinity
                });
            });
        }

        var idxSchedule = $('.dsidx-contact-form-schedule-date-row select');
        if(idxSchedule.length) {
            idxSchedule.each(function() {
                var thisSchedule = $(this);

                thisSchedule.select2({
                    minimumResultsForSearch: Infinity
                });
            });
        }
    }

})(jQuery);
(function($) {
    'use strict';

    var ihomeFinder = {};
    mkdf.modules.ihomeFinder = ihomeFinder;

    ihomeFinder.mkdfOnWindowLoad = mkdfOnWindowLoad;

    $(window).load(mkdfOnWindowLoad);

    /*
     All functions to be called on $(window).load() should be in this function
     */
    function mkdfOnWindowLoad() {
        mkdfInitIHomeFinderSelect2();
    }

    /*
     ** Init select2 script for select html dropdowns
     */
    function mkdfInitIHomeFinderSelect2() {
        var iHomeFinderSelect = $('#ihf-main-container select');
        if (iHomeFinderSelect.length) {
            iHomeFinderSelect.each(function() {
                var thisSelect = $(this);

                thisSelect.select2({
                    minimumResultsForSearch: Infinity
                });
            });
        }
    }

})(jQuery);
var j = jQuery.noConflict();
function CustomMarker( options ) {
    this.latlng = new google.maps.LatLng({lat: options.position.lat, lng: options.position.lng});
    this.setMap(options.map);
    this.templateData = options.templateData;
    this.markerData = {
        pin : options.markerPin
    };
}


CustomMarker.prototype = new google.maps.OverlayView();

CustomMarker.prototype.draw = function() {

    var self = this;

    var div = this.div;

    if (!div) {

        div = this.div = document.createElement('div');
        var id = this.templateData.itemId;
        div.className = 'mkdf-map-marker-holder';
        div.setAttribute("id", id);

        var markerInfoTemplate = _.template( j('.mkdf-info-window-template').html() );
        markerInfoTemplate = markerInfoTemplate( self.templateData );

        var markerTemplate = _.template( j('.mkdf-marker-template').html() );
        markerTemplate = markerTemplate( self.markerData );

        j(div).append(markerInfoTemplate);
        j(div).append(markerTemplate);

        div.style.position = 'absolute';
        div.style.cursor = 'pointer';

        var panes = this.getPanes();
        panes.overlayImage.appendChild(div);
    }

    var point = this.getProjection().fromLatLngToDivPixel(this.latlng);

    if (point) {
        div.style.left = (point.x) + 'px';
        div.style.top = (point.y) + 'px';
    }
};

CustomMarker.prototype.remove = function() {
    if (this.div) {
        this.div.parentNode.removeChild(this.div);
        this.div = null;
    }
};

CustomMarker.prototype.getPosition = function() {
    return this.latlng;
};
(function($) {
    "use strict";

    var realEstateMaps = {};
    mkdf.modules.realEstateMaps = realEstateMaps;
    realEstateMaps.mkdfInitMultipleRealEstateMap = mkdfInitMultipleRealEstateMap;
    realEstateMaps.mkdfInitSingleRealEstateMap = mkdfInitSingleRealEstateMap;
    realEstateMaps.mkdfInitMobileMap = mkdfInitMobileMap;
    realEstateMaps.mkdfReinitMultipleGoogleMaps = mkdfReinitMultipleGoogleMaps;
    realEstateMaps.mkdfGoogleMaps = {};

    $(document).ready(mkdfOnDocumentReady);
    $(window).load(mkdfOnWindowLoad);
    $(window).resize(mkdfOnWindowResize);
    $(window).scroll(mkdfOnWindowScroll);

    function mkdfOnDocumentReady() {}

    function mkdfOnWindowLoad() {
        mkdfInitSingleRealEstateMap();
        mkdfInitMultipleRealEstateMap();
        mkdfInitMobileMap();
    }

    function mkdfOnWindowResize() {}

    function mkdfOnWindowScroll() {}

    function mkdfInitSingleRealEstateMap() {
        var mapHolder = $('#mkdf-re-single-map-holder');
        if ( mapHolder.length ) {
            mkdf.modules.realEstateMaps.mkdfGoogleMaps.getDirectoryItemAddress({
                mapHolder: 'mkdf-re-single-map-holder'
            });
        }
    }

    function mkdfInitMultipleRealEstateMap() {
        var mapHolder = $('#mkdf-re-multiple-map-holder');
        if ( mapHolder.length ) {
            mkdf.modules.realEstateMaps.mkdfGoogleMaps.getDirectoryItemsAddresses({
                mapHolder: 'mkdf-re-multiple-map-holder',
                hasFilter: true
            });
        }
    }

    realEstateMaps.mkdfGoogleMaps = {

        //Object varibles
        mapHolder : {},
        map : {},
        markers : {},
        radius : {},

        /**
         * Returns map with single address
         *
         * @param options
         */
        getDirectoryItemAddress : function( options ) {
            /**
             * use mkdfMapsVars to get variables for address, latitude, longitude by default
             */
            var defaults = {
                location : mkdfSingleMapVars.single['currentRealEstate'].location,
                zoom : 16,
                mapHolder : '',
                draggable : mkdfMapsVars.global.draggable,
                mapTypeControl : mkdfMapsVars.global.mapTypeControl,
                scrollwheel : mkdfMapsVars.global.scrollable,
                streetViewControl : mkdfMapsVars.global.streetViewControl,
                zoomControl : mkdfMapsVars.global.zoomControl,
                title : mkdfSingleMapVars.single['currentRealEstate'].title,
                itemId : mkdfSingleMapVars.single['currentRealEstate'].itemId,
                content : '',
                styles: mkdfMapsVars.global.mapStyle,
                markerPin : mkdfSingleMapVars.single['currentRealEstate'].markerPin,
                featuredImage : mkdfSingleMapVars.single['currentRealEstate'].featuredImage,
                itemUrl : mkdfSingleMapVars.single['currentRealEstate'].itemUrl
            };
            var settings = $.extend( {}, defaults, options );

            //Save variables for later usage
            this.mapHolder = settings.mapHolder;

            //Get map holder
            var mapHolder = document.getElementById( settings.mapHolder );

            //Initialize map
            var map = new google.maps.Map( mapHolder, {
                zoom : settings.zoom,
                draggable : settings.draggable,
                mapTypeControl : settings.mapTypeControl,
                scrollwheel : settings.scrollwheel,
                streetViewControl : settings.streetViewControl,
                zoomControl : settings.zoomControl
            });

            //Set map style
            map.setOptions({
                styles: settings.styles
            });

            //Try to locate by latitude and longitude
            if ( typeof settings.location !== 'undefined' && settings.location !== null) {
                var latLong = {
                    lat : parseFloat(settings.location.latitude),
                    lng : parseFloat(settings.location.longitude)
                };
                //Set map center to location
                map.setCenter(latLong);
                //Add marker to map

                var templateData = {
                    title : settings.title,
                    itemId : settings.itemId,
                    address : settings.location.address,
                    featuredImage : settings.featuredImage,
                    itemUrl : settings.itemUrl
                };

                var customMarker = new CustomMarker({
                    map : map,
                    position : latLong,
                    templateData : templateData,
                    markerPin : settings.markerPin
                });

                this.initMarkerInfo();

            }

        },

        /**
         * Returns map with multiple addresses
         *
         * @param options
         */
        getDirectoryItemsAddresses : function( options ) {
            var defaults = {
                geolocation : false,
                mapHolder : 'mkdf-re-multiple-map-holder',
                addresses : mkdfMultipleMapVars.multiple.addresses,
                draggable : mkdfMapsVars.global.draggable,
                mapTypeControl : mkdfMapsVars.global.mapTypeControl,
                scrollwheel : mkdfMapsVars.global.scrollable,
                streetViewControl : mkdfMapsVars.global.streetViewControl,
                zoomControl : mkdfMapsVars.global.zoomControl,
                zoom : 16,
                styles: mkdfMapsVars.global.mapStyle,
                radius : 50, //radius for marker visibility, in km
                hasFilter : false
            };
            var settings = $.extend({}, defaults, options );

            //Get map holder
            var mapHolder = document.getElementById( settings.mapHolder );

            //Initialize map
            var map = new google.maps.Map( mapHolder, {
                zoom : settings.zoom,
                draggable : settings.draggable,
                mapTypeControl : settings.mapTypeControl,
                scrollwheel : settings.scrollwheel,
                streetViewControl : settings.streetViewControl,
                zoomControl : settings.zoomControl
            });

            //Save variables for later usage
            this.mapHolder = settings.mapHolder;
            this.map = map;
            this.radius = settings.radius;

            //Set map style
            map.setOptions({
                styles: settings.styles
            });

            //If geolocation enabled set map center to user location
            if ( navigator.geolocation && settings.geolocation ) {
                this.centerOnCurrentLocation();
            }

            //Filter addresses, remove items without latitude and longitude
            var addresses = [],
                addressesLength = settings.addresses.length;
            if(settings.addresses.length !== null){
                for ( var i = 0; i < addressesLength; i++ ) {
                    var location = settings.addresses[i].location;
                    if ( typeof location !== 'undefined' && location !== null ) {

                        if ( location.latitude !== '' && location.longitude !== '' ) {
                            addresses.push(settings.addresses[i]);
                        }
                    }
                }
            }


            //Center map and set borders of map
            this.setMapBounds( addresses );

            //Add markers to the map
            this.addMultipleMarkers( addresses );

        },

        /**
         * Add multiple markers to map
         */
        addMultipleMarkers : function( markersData ) {

            var map = this.map;

            var markers = [];
            //Loop through markers
            var len = markersData.length;
            for ( var i = 0; i < len; i++ ) {

                var latLng = {
                    lat: parseFloat(markersData[i].location.latitude),
                    lng: parseFloat(markersData[i].location.longitude)
                };

                //Custom html markers
                //Insert marker data into info window template
                var templateData = {
                    title : markersData[i].title,
                    itemId : markersData[i].itemId,
                    address : markersData[i].location.address,
                    featuredImage : markersData[i].featuredImage,
                    itemUrl : markersData[i].itemUrl
                };

                var customMarker = new CustomMarker({
                    position : latLng,
                    map : map,
                    templateData : templateData,
                    markerPin : markersData[i].markerPin
                });

                markers.push(customMarker);

            }

            this.markers = markers;

            //Init map clusters ( Grouping map markers at small zoom values )
            this.initMapClusters();

            //Init marker info
            this.initMarkerInfo();

            //Init visible circle area around center of map
            var that = this;
            google.maps.event.addListener(map, 'idle', function(){
                var visibleRadius = new google.maps.Circle({
                    strokeColor: '#FF0000',
                    strokeOpacity: 0,
                    strokeWeight: 0,
                    fillColor: '#FF0000',
                    fillOpacity: 0,
                    map: map,
                    center: map.getCenter(),
                    radius: that.radius * 1000 //in meters
                });
                //Display only markers in circle
                //that.refreshCircleAreaMarkers( visibleRadius.getBounds() );
            });

        },

        /**
         * Set map bounds for Map with multiple markers
         *
         * @param addressesArray
         */
        setMapBounds : function( addressesArray ) {

            var bounds = new google.maps.LatLngBounds();
            for ( var i = 0; i < addressesArray.length; i++ ) {
                bounds.extend( new google.maps.LatLng( parseFloat(addressesArray[i].location.latitude), parseFloat(addressesArray[i].location.longitude) ) );
            }

            this.map.fitBounds( bounds );

        },

        /**
         * Init map clusters for grouping markers on small zoom values
         */
        initMapClusters : function() {

            //Activate clustering on multiple markers
            var markerClusteringOptions = {
                minimumClusterSize: 2,
                maxZoom: 12,
                styles : [{
                    width: 50,
                    height: 60,
                    url: '',
                    textSize: 12
                }]
            };
            var markerClusterer = new MarkerClusterer(this.map, this.markers, markerClusteringOptions);

        },

        initMarkerInfo : function() {

            $(document).off('click', '.mkdf-map-marker');
            $(document).on('click', '.mkdf-map-marker', function() {
                var self = $(this),
                    markerHolders = $('.mkdf-map-marker-holder'),
                    infoWindows = $('.mkdf-info-window'),
                    markerHolder = self.parent('.mkdf-map-marker-holder'),
                    infoWindow = self.siblings('.mkdf-info-window');

                if ( markerHolder.hasClass('active mapActive') ) {
                    markerHolder.removeClass( 'active mapActive' );
                    infoWindow.fadeOut(0);
                } else {
                    markerHolders.removeClass('active mapActive');
                    infoWindows.fadeOut(0);
                    markerHolder.addClass('active mapActive');
                    infoWindow.fadeIn(300);
                }

            });

        },
        /**
         * Info Window for displaying data on map markers
         *
         * @returns {google.maps.InfoWindow}
         */
        addInfoWindow : function() {

            var contentString = '';
            var infoWindow = new google.maps.InfoWindow({
                content: contentString
            });
            return infoWindow;

        },

        /**
         * If geolocation enabled center map on users current position
         */
        centerOnCurrentLocation : function() {
            var map = this.map;
            navigator.geolocation.getCurrentPosition(
                function(position){
                    var center = {
                        lat : position.coords.latitude,
                        lng : position.coords.longitude
                    };
                    map.setCenter(center);
                }
            );
        },

        /**
         * Refresh area for visible markers
         *
         * @param circleArea
         */
        refreshCircleAreaMarkers : function( circleArea ) {

            var length = this.markers.length;
            for ( var i = 0; i < length; i++ ) {
                if ( circleArea.contains( this.markers[i].getPosition() ) ) {
                    this.markers[i].setVisible(true);
                } else {
                    this.markers[i].setVisible(false);
                }
            }

        },

    };

    function mkdfInitMobileMap() {

        var mapOpener = $('.mkdf-re-view-larger-map a'),
            mapOpenerIcon = mapOpener.children('i'),
            mapHolder = $('.mkdf-map-holder');
        if (mapOpener.length) {
            mapOpener.click(function(e){
                e.preventDefault();
                if (mapHolder.hasClass('mkdf-fullscreen-map')) {
                    mapHolder.removeClass('mkdf-fullscreen-map');
                    mapOpenerIcon.removeClass('icon-basic-magnifier-minus');
                    mapOpenerIcon.addClass('icon-basic-magnifier-plus');
                } else {
                    mapHolder.addClass('mkdf-fullscreen-map');
                    mapOpenerIcon.removeClass('icon-basic-magnifier-plus');
                    mapOpenerIcon.addClass('icon-basic-magnifier-minus');
                }
                mkdf.modules.realEstateMaps.mkdfGoogleMaps.getDirectoryItemsAddresses();
            });
        }
    }

    function mkdfReinitMultipleGoogleMaps(addresses, action){

        if(action === 'append'){

            var mapObjs = mkdfMultipleMapVars.multiple.addresses;
            mapObjs = mkdfMultipleMapVars.multiple.addresses.concat(addresses);
            mkdfMultipleMapVars.multiple.addresses = mapObjs;

            mkdf.modules.realEstateMaps.mkdfGoogleMaps.getDirectoryItemsAddresses({
                addresses: mapObjs
            });
        }
        else if(action === 'replace'){

            mkdfMultipleMapVars.multiple.addresses = addresses;
            mkdf.modules.realEstateMaps.mkdfGoogleMaps.getDirectoryItemsAddresses({
                addresses: addresses
            });

        }
    }

})(jQuery);
/**
 * @name MarkerClusterer for Google Maps v3
 * @version version 1.0
 * @author Luke Mahe
 * @fileoverview
 * The library creates and manages per-zoom-level clusters for large amounts of
 * markers.
 * <br/>
 * This is a v3 implementation of the
 * <a href="http://gmaps-utility-library-dev.googlecode.com/svn/tags/markerclusterer/"
 * >v2 MarkerClusterer</a>.
 */

/**
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */


/**
 * A Marker Clusterer that clusters markers.
 *
 * @param {google.maps.Map} map The Google map to attach to.
 * @param {Array.<google.maps.Marker>=} opt_markers Optional markers to add to
 *   the cluster.
 * @param {Object=} opt_options support the following options:
 *     'gridSize': (number) The grid size of a cluster in pixels.
 *     'maxZoom': (number) The maximum zoom level that a marker can be part of a
 *                cluster.
 *     'zoomOnClick': (boolean) Whether the default behaviour of clicking on a
 *                    cluster is to zoom into it.
 *     'averageCenter': (boolean) Wether the center of each cluster should be
 *                      the average of all markers in the cluster.
 *     'minimumClusterSize': (number) The minimum number of markers to be in a
 *                           cluster before the markers are hidden and a count
 *                           is shown.
 *     'styles': (object) An object that has style properties:
 *       'url': (string) The image url.
 *       'height': (number) The image height.
 *       'width': (number) The image width.
 *       'anchor': (Array) The anchor position of the label text.
 *       'textColor': (string) The text color.
 *       'textSize': (number) The text size.
 *       'backgroundPosition': (string) The position of the backgound x, y.
 *       'iconAnchor': (Array) The anchor position of the icon x, y.
 * @constructor
 * @extends google.maps.OverlayView
 */
function MarkerClusterer(map, opt_markers, opt_options) {
    // MarkerClusterer implements google.maps.OverlayView interface. We use the
    // extend function to extend MarkerClusterer with google.maps.OverlayView
    // because it might not always be available when the code is defined so we
    // look for it at the last possible moment. If it doesn't exist now then
    // there is no point going ahead :)
    this.extend(MarkerClusterer, google.maps.OverlayView);
    this.map_ = map;

    /**
     * @type {Array.<google.maps.Marker>}
     * @private
     */
    this.markers_ = [];

    /**
     *  @type {Array.<Cluster>}
     */
    this.clusters_ = [];

    this.sizes = [53, 56, 66, 78, 90];

    /**
     * @private
     */
    this.styles_ = [];

    /**
     * @type {boolean}
     * @private
     */
    this.ready_ = false;

    var options = opt_options || {};

    /**
     * @type {number}
     * @private
     */
    this.gridSize_ = options['gridSize'] || 60;

    /**
     * @private
     */
    this.minClusterSize_ = options['minimumClusterSize'] || 2;


    /**
     * @type {?number}
     * @private
     */
    this.maxZoom_ = options['maxZoom'] || null;

    this.styles_ = options['styles'] || [];

    /**
     * @type {string}
     * @private
     */
    this.imagePath_ = options['imagePath'] ||
        this.MARKER_CLUSTER_IMAGE_PATH_;

    /**
     * @type {string}
     * @private
     */
    this.imageExtension_ = options['imageExtension'] ||
        this.MARKER_CLUSTER_IMAGE_EXTENSION_;

    /**
     * @type {boolean}
     * @private
     */
    this.zoomOnClick_ = true;

    if (options['zoomOnClick'] != undefined) {
        this.zoomOnClick_ = options['zoomOnClick'];
    }

    /**
     * @type {boolean}
     * @private
     */
    this.averageCenter_ = false;

    if (options['averageCenter'] != undefined) {
        this.averageCenter_ = options['averageCenter'];
    }

    this.setupStyles_();

    this.setMap(map);

    /**
     * @type {number}
     * @private
     */
    this.prevZoom_ = this.map_.getZoom();

    // Add the map event listeners
    var that = this;
    google.maps.event.addListener(this.map_, 'zoom_changed', function() {
        var zoom = that.map_.getZoom();

        if (that.prevZoom_ != zoom) {
            that.prevZoom_ = zoom;
            that.resetViewport();
        }
    });

    google.maps.event.addListener(this.map_, 'idle', function() {
        that.redraw();
    });

    // Finally, add the markers
    if (opt_markers && opt_markers.length) {
        this.addMarkers(opt_markers, false);
    }
}


/**
 * The marker cluster image path.
 *
 * @type {string}
 * @private
 */
MarkerClusterer.prototype.MARKER_CLUSTER_IMAGE_PATH_ =
    'https://google-maps-utility-library-v3.googlecode.com/svn/trunk/markerclusterer/' +
    'images/m';


/**
 * The marker cluster image path.
 *
 * @type {string}
 * @private
 */
MarkerClusterer.prototype.MARKER_CLUSTER_IMAGE_EXTENSION_ = 'png';


/**
 * Extends a objects prototype by anothers.
 *
 * @param {Object} obj1 The object to be extended.
 * @param {Object} obj2 The object to extend with.
 * @return {Object} The new extended object.
 * @ignore
 */
MarkerClusterer.prototype.extend = function(obj1, obj2) {
    return (function(object) {
        for (var property in object.prototype) {
            this.prototype[property] = object.prototype[property];
        }
        return this;
    }).apply(obj1, [obj2]);
};


/**
 * Implementaion of the interface method.
 * @ignore
 */
MarkerClusterer.prototype.onAdd = function() {
    this.setReady_(true);
};

/**
 * Implementaion of the interface method.
 * @ignore
 */
MarkerClusterer.prototype.draw = function() {};

/**
 * Sets up the styles object.
 *
 * @private
 */
MarkerClusterer.prototype.setupStyles_ = function() {
    if (this.styles_.length) {
        return;
    }

    for (var i = 0, size; size = this.sizes[i]; i++) {
        this.styles_.push({
            url: this.imagePath_ + (i + 1) + '.' + this.imageExtension_,
            height: size,
            width: size
        });
    }
};

/**
 *  Fit the map to the bounds of the markers in the clusterer.
 */
MarkerClusterer.prototype.fitMapToMarkers = function() {
    var markers = this.getMarkers();
    var bounds = new google.maps.LatLngBounds();
    for (var i = 0, marker; marker = markers[i]; i++) {
        bounds.extend(marker.getPosition());
    }

    this.map_.fitBounds(bounds);
};


/**
 *  Sets the styles.
 *
 *  @param {Object} styles The style to set.
 */
MarkerClusterer.prototype.setStyles = function(styles) {
    this.styles_ = styles;
};


/**
 *  Gets the styles.
 *
 *  @return {Object} The styles object.
 */
MarkerClusterer.prototype.getStyles = function() {
    return this.styles_;
};


/**
 * Whether zoom on click is set.
 *
 * @return {boolean} True if zoomOnClick_ is set.
 */
MarkerClusterer.prototype.isZoomOnClick = function() {
    return this.zoomOnClick_;
};

/**
 * Whether average center is set.
 *
 * @return {boolean} True if averageCenter_ is set.
 */
MarkerClusterer.prototype.isAverageCenter = function() {
    return this.averageCenter_;
};


/**
 *  Returns the array of markers in the clusterer.
 *
 *  @return {Array.<google.maps.Marker>} The markers.
 */
MarkerClusterer.prototype.getMarkers = function() {
    return this.markers_;
};


/**
 *  Returns the number of markers in the clusterer
 *
 *  @return {Number} The number of markers.
 */
MarkerClusterer.prototype.getTotalMarkers = function() {
    return this.markers_.length;
};


/**
 *  Sets the max zoom for the clusterer.
 *
 *  @param {number} maxZoom The max zoom level.
 */
MarkerClusterer.prototype.setMaxZoom = function(maxZoom) {
    this.maxZoom_ = maxZoom;
};


/**
 *  Gets the max zoom for the clusterer.
 *
 *  @return {number} The max zoom level.
 */
MarkerClusterer.prototype.getMaxZoom = function() {
    return this.maxZoom_;
};


/**
 *  The function for calculating the cluster icon image.
 *
 *  @param {Array.<google.maps.Marker>} markers The markers in the clusterer.
 *  @param {number} numStyles The number of styles available.
 *  @return {Object} A object properties: 'text' (string) and 'index' (number).
 *  @private
 */
MarkerClusterer.prototype.calculator_ = function(markers, numStyles) {
    var index = 0;
    var count = markers.length;
    var dv = count;
    while (dv !== 0) {
        dv = parseInt(dv / 10, 10);
        index++;
    }

    index = Math.min(index, numStyles);
    return {
        text: count,
        index: index
    };
};


/**
 * Set the calculator function.
 *
 * @param {function(Array, number)} calculator The function to set as the
 *     calculator. The function should return a object properties:
 *     'text' (string) and 'index' (number).
 *
 */
MarkerClusterer.prototype.setCalculator = function(calculator) {
    this.calculator_ = calculator;
};


/**
 * Get the calculator function.
 *
 * @return {function(Array, number)} the calculator function.
 */
MarkerClusterer.prototype.getCalculator = function() {
    return this.calculator_;
};


/**
 * Add an array of markers to the clusterer.
 *
 * @param {Array.<google.maps.Marker>} markers The markers to add.
 * @param {boolean=} opt_nodraw Whether to redraw the clusters.
 */
MarkerClusterer.prototype.addMarkers = function(markers, opt_nodraw) {
    for (var i = 0, marker; marker = markers[i]; i++) {
        this.pushMarkerTo_(marker);
    }
    if (!opt_nodraw) {
        this.redraw();
    }
};


/**
 * Pushes a marker to the clusterer.
 *
 * @param {google.maps.Marker} marker The marker to add.
 * @private
 */
MarkerClusterer.prototype.pushMarkerTo_ = function(marker) {
    marker.isAdded = false;
    if (marker['draggable']) {
        // If the marker is draggable add a listener so we update the clusters on
        // the drag end.
        var that = this;
        google.maps.event.addListener(marker, 'dragend', function() {
            marker.isAdded = false;
            that.repaint();
        });
    }
    this.markers_.push(marker);
};


/**
 * Adds a marker to the clusterer and redraws if needed.
 *
 * @param {google.maps.Marker} marker The marker to add.
 * @param {boolean=} opt_nodraw Whether to redraw the clusters.
 */
MarkerClusterer.prototype.addMarker = function(marker, opt_nodraw) {
    this.pushMarkerTo_(marker);
    if (!opt_nodraw) {
        this.redraw();
    }
};


/**
 * Removes a marker and returns true if removed, false if not
 *
 * @param {google.maps.Marker} marker The marker to remove
 * @return {boolean} Whether the marker was removed or not
 * @private
 */
MarkerClusterer.prototype.removeMarker_ = function(marker) {
    var index = -1;
    if (this.markers_.indexOf) {
        index = this.markers_.indexOf(marker);
    } else {
        for (var i = 0, m; m = this.markers_[i]; i++) {
            if (m == marker) {
                index = i;
                break;
            }
        }
    }

    if (index == -1) {
        // Marker is not in our list of markers.
        return false;
    }

    marker.setMap(null);

    this.markers_.splice(index, 1);

    return true;
};


/**
 * Remove a marker from the cluster.
 *
 * @param {google.maps.Marker} marker The marker to remove.
 * @param {boolean=} opt_nodraw Optional boolean to force no redraw.
 * @return {boolean} True if the marker was removed.
 */
MarkerClusterer.prototype.removeMarker = function(marker, opt_nodraw) {
    var removed = this.removeMarker_(marker);

    if (!opt_nodraw && removed) {
        this.resetViewport();
        this.redraw();
        return true;
    } else {
        return false;
    }
};


/**
 * Removes an array of markers from the cluster.
 *
 * @param {Array.<google.maps.Marker>} markers The markers to remove.
 * @param {boolean=} opt_nodraw Optional boolean to force no redraw.
 */
MarkerClusterer.prototype.removeMarkers = function(markers, opt_nodraw) {
    var removed = false;

    for (var i = 0, marker; marker = markers[i]; i++) {
        var r = this.removeMarker_(marker);
        removed = removed || r;
    }

    if (!opt_nodraw && removed) {
        this.resetViewport();
        this.redraw();
        return true;
    }
};


/**
 * Sets the clusterer's ready state.
 *
 * @param {boolean} ready The state.
 * @private
 */
MarkerClusterer.prototype.setReady_ = function(ready) {
    if (!this.ready_) {
        this.ready_ = ready;
        this.createClusters_();
    }
};


/**
 * Returns the number of clusters in the clusterer.
 *
 * @return {number} The number of clusters.
 */
MarkerClusterer.prototype.getTotalClusters = function() {
    return this.clusters_.length;
};


/**
 * Returns the google map that the clusterer is associated with.
 *
 * @return {google.maps.Map} The map.
 */
MarkerClusterer.prototype.getMap = function() {
    return this.map_;
};


/**
 * Sets the google map that the clusterer is associated with.
 *
 * @param {google.maps.Map} map The map.
 */
MarkerClusterer.prototype.setMap = function(map) {
    this.map_ = map;
};


/**
 * Returns the size of the grid.
 *
 * @return {number} The grid size.
 */
MarkerClusterer.prototype.getGridSize = function() {
    return this.gridSize_;
};


/**
 * Sets the size of the grid.
 *
 * @param {number} size The grid size.
 */
MarkerClusterer.prototype.setGridSize = function(size) {
    this.gridSize_ = size;
};


/**
 * Returns the min cluster size.
 *
 * @return {number} The grid size.
 */
MarkerClusterer.prototype.getMinClusterSize = function() {
    return this.minClusterSize_;
};

/**
 * Sets the min cluster size.
 *
 * @param {number} size The grid size.
 */
MarkerClusterer.prototype.setMinClusterSize = function(size) {
    this.minClusterSize_ = size;
};


/**
 * Extends a bounds object by the grid size.
 *
 * @param {google.maps.LatLngBounds} bounds The bounds to extend.
 * @return {google.maps.LatLngBounds} The extended bounds.
 */
MarkerClusterer.prototype.getExtendedBounds = function(bounds) {
    var projection = this.getProjection();

    // Turn the bounds into latlng.
    var tr = new google.maps.LatLng(bounds.getNorthEast().lat(),
        bounds.getNorthEast().lng());
    var bl = new google.maps.LatLng(bounds.getSouthWest().lat(),
        bounds.getSouthWest().lng());

    // Convert the points to pixels and the extend out by the grid size.
    var trPix = projection.fromLatLngToDivPixel(tr);
    trPix.x += this.gridSize_;
    trPix.y -= this.gridSize_;

    var blPix = projection.fromLatLngToDivPixel(bl);
    blPix.x -= this.gridSize_;
    blPix.y += this.gridSize_;

    // Convert the pixel points back to LatLng
    var ne = projection.fromDivPixelToLatLng(trPix);
    var sw = projection.fromDivPixelToLatLng(blPix);

    // Extend the bounds to contain the new bounds.
    bounds.extend(ne);
    bounds.extend(sw);

    return bounds;
};


/**
 * Determins if a marker is contained in a bounds.
 *
 * @param {google.maps.Marker} marker The marker to check.
 * @param {google.maps.LatLngBounds} bounds The bounds to check against.
 * @return {boolean} True if the marker is in the bounds.
 * @private
 */
MarkerClusterer.prototype.isMarkerInBounds_ = function(marker, bounds) {
    return bounds.contains(marker.getPosition());
};


/**
 * Clears all clusters and markers from the clusterer.
 */
MarkerClusterer.prototype.clearMarkers = function() {
    this.resetViewport(true);

    // Set the markers a empty array.
    this.markers_ = [];
};


/**
 * Clears all existing clusters and recreates them.
 * @param {boolean} opt_hide To also hide the marker.
 */
MarkerClusterer.prototype.resetViewport = function(opt_hide) {
    // Remove all the clusters
    for (var i = 0, cluster; cluster = this.clusters_[i]; i++) {
        cluster.remove();
    }

    // Reset the markers to not be added and to be invisible.
    for (var i = 0, marker; marker = this.markers_[i]; i++) {
        marker.isAdded = false;
        if (opt_hide) {
            marker.setMap(null);
        }
    }

    this.clusters_ = [];
};

/**
 *
 */
MarkerClusterer.prototype.repaint = function() {
    var oldClusters = this.clusters_.slice();
    this.clusters_.length = 0;
    this.resetViewport();
    this.redraw();

    // Remove the old clusters.
    // Do it in a timeout so the other clusters have been drawn first.
    window.setTimeout(function() {
        for (var i = 0, cluster; cluster = oldClusters[i]; i++) {
            cluster.remove();
        }
    }, 0);
};


/**
 * Redraws the clusters.
 */
MarkerClusterer.prototype.redraw = function() {
    this.createClusters_();
};


/**
 * Calculates the distance between two latlng locations in km.
 * @see http://www.movable-type.co.uk/scripts/latlong.html
 *
 * @param {google.maps.LatLng} p1 The first lat lng point.
 * @param {google.maps.LatLng} p2 The second lat lng point.
 * @return {number} The distance between the two points in km.
 * @private
 */
MarkerClusterer.prototype.distanceBetweenPoints_ = function(p1, p2) {
    if (!p1 || !p2) {
        return 0;
    }

    var R = 6371; // Radius of the Earth in km
    var dLat = (p2.lat() - p1.lat()) * Math.PI / 180;
    var dLon = (p2.lng() - p1.lng()) * Math.PI / 180;
    var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
        Math.cos(p1.lat() * Math.PI / 180) * Math.cos(p2.lat() * Math.PI / 180) *
        Math.sin(dLon / 2) * Math.sin(dLon / 2);
    var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
    var d = R * c;
    return d;
};


/**
 * Add a marker to a cluster, or creates a new cluster.
 *
 * @param {google.maps.Marker} marker The marker to add.
 * @private
 */
MarkerClusterer.prototype.addToClosestCluster_ = function(marker) {
    var distance = 40000; // Some large number
    var clusterToAddTo = null;
    var pos = marker.getPosition();
    for (var i = 0, cluster; cluster = this.clusters_[i]; i++) {
        var center = cluster.getCenter();
        if (center) {
            var d = this.distanceBetweenPoints_(center, marker.getPosition());
            if (d < distance) {
                distance = d;
                clusterToAddTo = cluster;
            }
        }
    }

    if (clusterToAddTo && clusterToAddTo.isMarkerInClusterBounds(marker)) {
        clusterToAddTo.addMarker(marker);
    } else {
        var cluster = new Cluster(this);
        cluster.addMarker(marker);
        this.clusters_.push(cluster);
    }
};


/**
 * Creates the clusters.
 *
 * @private
 */
MarkerClusterer.prototype.createClusters_ = function() {
    if (!this.ready_) {
        return;
    }

    // Get our current map view bounds.
    // Create a new bounds object so we don't affect the map.
    var mapBounds = new google.maps.LatLngBounds(this.map_.getBounds().getSouthWest(),
        this.map_.getBounds().getNorthEast());
    var bounds = this.getExtendedBounds(mapBounds);

    for (var i = 0, marker; marker = this.markers_[i]; i++) {
        if (!marker.isAdded && this.isMarkerInBounds_(marker, bounds)) {
            this.addToClosestCluster_(marker);
        }
    }
};


/**
 * A cluster that contains markers.
 *
 * @param {MarkerClusterer} markerClusterer The markerclusterer that this
 *     cluster is associated with.
 * @constructor
 * @ignore
 */
function Cluster(markerClusterer) {
    this.markerClusterer_ = markerClusterer;
    this.map_ = markerClusterer.getMap();
    this.gridSize_ = markerClusterer.getGridSize();
    this.minClusterSize_ = markerClusterer.getMinClusterSize();
    this.averageCenter_ = markerClusterer.isAverageCenter();
    this.center_ = null;
    this.markers_ = [];
    this.bounds_ = null;
    this.clusterIcon_ = new ClusterIcon(this, markerClusterer.getStyles(),
        markerClusterer.getGridSize());
}

/**
 * Determins if a marker is already added to the cluster.
 *
 * @param {google.maps.Marker} marker The marker to check.
 * @return {boolean} True if the marker is already added.
 */
Cluster.prototype.isMarkerAlreadyAdded = function(marker) {
    if (this.markers_.indexOf) {
        return this.markers_.indexOf(marker) != -1;
    } else {
        for (var i = 0, m; m = this.markers_[i]; i++) {
            if (m == marker) {
                return true;
            }
        }
    }
    return false;
};


/**
 * Add a marker the cluster.
 *
 * @param {google.maps.Marker} marker The marker to add.
 * @return {boolean} True if the marker was added.
 */
Cluster.prototype.addMarker = function(marker) {
    if (this.isMarkerAlreadyAdded(marker)) {
        return false;
    }

    if (!this.center_) {
        this.center_ = marker.getPosition();
        this.calculateBounds_();
    } else {
        if (this.averageCenter_) {
            var l = this.markers_.length + 1;
            var lat = (this.center_.lat() * (l-1) + marker.getPosition().lat()) / l;
            var lng = (this.center_.lng() * (l-1) + marker.getPosition().lng()) / l;
            this.center_ = new google.maps.LatLng(lat, lng);
            this.calculateBounds_();
        }
    }

    marker.isAdded = true;
    this.markers_.push(marker);

    var len = this.markers_.length;
    if (len < this.minClusterSize_ && marker.getMap() != this.map_) {
        // Min cluster size not reached so show the marker.
        marker.setMap(this.map_);
    }

    if (len == this.minClusterSize_) {
        // Hide the markers that were showing.
        for (var i = 0; i < len; i++) {
            this.markers_[i].setMap(null);
        }
    }

    if (len >= this.minClusterSize_) {
        marker.setMap(null);
    }

    this.updateIcon();
    return true;
};


/**
 * Returns the marker clusterer that the cluster is associated with.
 *
 * @return {MarkerClusterer} The associated marker clusterer.
 */
Cluster.prototype.getMarkerClusterer = function() {
    return this.markerClusterer_;
};


/**
 * Returns the bounds of the cluster.
 *
 * @return {google.maps.LatLngBounds} the cluster bounds.
 */
Cluster.prototype.getBounds = function() {
    var bounds = new google.maps.LatLngBounds(this.center_, this.center_);
    var markers = this.getMarkers();
    for (var i = 0, marker; marker = markers[i]; i++) {
        bounds.extend(marker.getPosition());
    }
    return bounds;
};


/**
 * Removes the cluster
 */
Cluster.prototype.remove = function() {
    this.clusterIcon_.remove();
    this.markers_.length = 0;
    delete this.markers_;
};


/**
 * Returns the center of the cluster.
 *
 * @return {number} The cluster center.
 */
Cluster.prototype.getSize = function() {
    return this.markers_.length;
};


/**
 * Returns the center of the cluster.
 *
 * @return {Array.<google.maps.Marker>} The cluster center.
 */
Cluster.prototype.getMarkers = function() {
    return this.markers_;
};


/**
 * Returns the center of the cluster.
 *
 * @return {google.maps.LatLng} The cluster center.
 */
Cluster.prototype.getCenter = function() {
    return this.center_;
};


/**
 * Calculated the extended bounds of the cluster with the grid.
 *
 * @private
 */
Cluster.prototype.calculateBounds_ = function() {
    var bounds = new google.maps.LatLngBounds(this.center_, this.center_);
    this.bounds_ = this.markerClusterer_.getExtendedBounds(bounds);
};


/**
 * Determines if a marker lies in the clusters bounds.
 *
 * @param {google.maps.Marker} marker The marker to check.
 * @return {boolean} True if the marker lies in the bounds.
 */
Cluster.prototype.isMarkerInClusterBounds = function(marker) {
    return this.bounds_.contains(marker.getPosition());
};


/**
 * Returns the map that the cluster is associated with.
 *
 * @return {google.maps.Map} The map.
 */
Cluster.prototype.getMap = function() {
    return this.map_;
};


/**
 * Updates the cluster icon
 */
Cluster.prototype.updateIcon = function() {
    var zoom = this.map_.getZoom();
    var mz = this.markerClusterer_.getMaxZoom();

    if (mz && zoom > mz) {
        // The zoom is greater than our max zoom so show all the markers in cluster.
        for (var i = 0, marker; marker = this.markers_[i]; i++) {
            marker.setMap(this.map_);
        }
        return;
    }

    if (this.markers_.length < this.minClusterSize_) {
        // Min cluster size not yet reached.
        this.clusterIcon_.hide();
        return;
    }

    var numStyles = this.markerClusterer_.getStyles().length;
    var sums = this.markerClusterer_.getCalculator()(this.markers_, numStyles);
    this.clusterIcon_.setCenter(this.center_);
    this.clusterIcon_.setSums(sums);
    this.clusterIcon_.show();
};


/**
 * A cluster icon
 *
 * @param {Cluster} cluster The cluster to be associated with.
 * @param {Object} styles An object that has style properties:
 *     'url': (string) The image url.
 *     'height': (number) The image height.
 *     'width': (number) The image width.
 *     'anchor': (Array) The anchor position of the label text.
 *     'textColor': (string) The text color.
 *     'textSize': (number) The text size.
 *     'backgroundPosition: (string) The background postition x, y.
 * @param {number=} opt_padding Optional padding to apply to the cluster icon.
 * @constructor
 * @extends google.maps.OverlayView
 * @ignore
 */
function ClusterIcon(cluster, styles, opt_padding) {
    cluster.getMarkerClusterer().extend(ClusterIcon, google.maps.OverlayView);

    this.styles_ = styles;
    this.padding_ = opt_padding || 0;
    this.cluster_ = cluster;
    this.center_ = null;
    this.map_ = cluster.getMap();
    this.div_ = null;
    this.sums_ = null;
    this.visible_ = false;

    this.setMap(this.map_);
}


/**
 * Triggers the clusterclick event and zoom's if the option is set.
 *
 * @param {google.maps.MouseEvent} event The event to propagate
 */
ClusterIcon.prototype.triggerClusterClick = function(event) {
    var markerClusterer = this.cluster_.getMarkerClusterer();

    // Trigger the clusterclick event.
    google.maps.event.trigger(markerClusterer, 'clusterclick', this.cluster_, event);

    if (markerClusterer.isZoomOnClick()) {
        // Zoom into the cluster.
        this.map_.fitBounds(this.cluster_.getBounds());
    }
};


/**
 * Adding the cluster icon to the dom.
 * @ignore
 */
ClusterIcon.prototype.onAdd = function() {
    this.div_ = document.createElement('DIV');
    this.div_.className = 'mkdf-cluster-marker';
    if (this.visible_) {
        var pos = this.getPosFromLatLng_(this.center_);
        this.div_.style.cssText = this.createCss(pos);
        this.div_.innerHTML = '<div class="mkdf-cluster-marker-inner">' +
            '<span class="mkdf-cluster-marker-number">' + this.sums_.text + '</span>' +
            '<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"' +
                'width="594.657px" height="832.35px" viewBox="0 0 594.657 832.35" enable-background="new 0 0 594.657 832.35" xml:space="preserve">' +
                '<path fill="#FFCD0A" d="M507.572,87.086C451.414,30.928,376.748,0,297.329,0S143.244,30.928,87.086,87.086S0,217.91,0,297.33' +
                'c0,37.328,8.104,75.127,24.773,115.561c13.006,31.545,31.131,64.504,57.041,103.725l82.887,125.467l113.352,180.572' +
                'c4.189,6.676,11.396,10.66,19.276,10.66c7.881,0,15.087-3.984,19.276-10.66l113.319-180.521l82.919-125.518' +
                'c25.911-39.221,44.035-72.18,57.041-103.725c16.67-40.434,24.772-78.232,24.772-115.561' +
                'C594.657,217.91,563.729,143.244,507.572,87.086z" class="pin-color"/>' +
            '</svg></div>';
    }

    var panes = this.getPanes();
    panes.overlayMouseTarget.appendChild(this.div_);

    var that = this;
    google.maps.event.addDomListener(this.div_, 'click', function(event) {
        that.triggerClusterClick(event);
    });
};


/**
 * Returns the position to place the div dending on the latlng.
 *
 * @param {google.maps.LatLng} latlng The position in latlng.
 * @return {google.maps.Point} The position in pixels.
 * @private
 */
ClusterIcon.prototype.getPosFromLatLng_ = function(latlng) {
    var pos = this.getProjection().fromLatLngToDivPixel(latlng);

    if (typeof this.iconAnchor_ === 'object' && this.iconAnchor_.length === 2) {
        pos.x -= this.iconAnchor_[0];
        pos.y -= this.iconAnchor_[1];
    } else {
        pos.x -= parseInt(this.width_ / 2, 10);
        pos.y -= parseInt(this.height_ / 2, 10);
    }
    return pos;
};


/**
 * Draw the icon.
 * @ignore
 */
ClusterIcon.prototype.draw = function() {
    if (this.visible_) {
        var pos = this.getPosFromLatLng_(this.center_);
        this.div_.style.top = pos.y + 'px';
        this.div_.style.left = pos.x + 'px';
    }
};


/**
 * Hide the icon.
 */
ClusterIcon.prototype.hide = function() {
    if (this.div_) {
        this.div_.style.display = 'none';
    }
    this.visible_ = false;
};


/**
 * Position and show the icon.
 */
ClusterIcon.prototype.show = function() {
    if (this.div_) {
        var pos = this.getPosFromLatLng_(this.center_);
        this.div_.style.cssText = this.createCss(pos);
        this.div_.style.display = '';
    }
    this.visible_ = true;
};


/**
 * Remove the icon from the map
 */
ClusterIcon.prototype.remove = function() {
    this.setMap(null);
};


/**
 * Implementation of the onRemove interface.
 * @ignore
 */
ClusterIcon.prototype.onRemove = function() {
    if (this.div_ && this.div_.parentNode) {
        this.hide();
        this.div_.parentNode.removeChild(this.div_);
        this.div_ = null;
    }
};


/**
 * Set the sums of the icon.
 *
 * @param {Object} sums The sums containing:
 *   'text': (string) The text to display in the icon.
 *   'index': (number) The style index of the icon.
 */
ClusterIcon.prototype.setSums = function(sums) {
    this.sums_ = sums;
    this.text_ = sums.text;
    this.index_ = sums.index;
    if (this.div_) {
        this.div_.innerHTML = sums.text;
    }

    this.useStyle();
};


/**
 * Sets the icon to the the styles.
 */
ClusterIcon.prototype.useStyle = function() {
    var index = Math.max(0, this.sums_.index - 1);
    index = Math.min(this.styles_.length - 1, index);
    var style = this.styles_[index];
    this.url_ = style['url'];
    this.height_ = style['height'];
    this.width_ = style['width'];
    this.textColor_ = style['textColor'];
    this.anchor_ = style['anchor'];
    this.textSize_ = style['textSize'];
    this.backgroundPosition_ = style['backgroundPosition'];
    this.iconAnchor_ = style['iconAnchor'];
};


/**
 * Sets the center of the icon.
 *
 * @param {google.maps.LatLng} center The latlng to set as the center.
 */
ClusterIcon.prototype.setCenter = function(center) {
    this.center_ = center;
};


/**
 * Create the css text based on the position of the icon.
 *
 * @param {google.maps.Point} pos The position.
 * @return {string} The css style text.
 */
ClusterIcon.prototype.createCss = function(pos) {
    var style = [];
    style.push('background-image:url(' + this.url_ + ');');
    var backgroundPosition = this.backgroundPosition_ ? this.backgroundPosition_ : '0 0';
    style.push('background-position:' + backgroundPosition + ';');

    if (typeof this.anchor_ === 'object') {
        if (typeof this.anchor_[0] === 'number' && this.anchor_[0] > 0 &&
            this.anchor_[0] < this.height_) {
            style.push('height:' + (this.height_ - this.anchor_[0]) +
                'px; padding-top:' + this.anchor_[0] + 'px;');
        } else if (typeof this.anchor_[0] === 'number' && this.anchor_[0] < 0 &&
            -this.anchor_[0] < this.height_) {
            style.push('height:' + this.height_ + 'px; line-height:' + (this.height_ + this.anchor_[0]) +
                'px;');
        } else {
            style.push('height:' + this.height_ + 'px; line-height:' + this.height_ +
                'px;');
        }
        if (typeof this.anchor_[1] === 'number' && this.anchor_[1] > 0 &&
            this.anchor_[1] < this.width_) {
            style.push('width:' + (this.width_ - this.anchor_[1]) +
                'px; padding-left:' + this.anchor_[1] + 'px;');
        } else {
            style.push('width:' + this.width_ + 'px; text-align:center;');
        }
    } else {
        style.push('height:' + this.height_ + 'px; line-height:' +
            this.height_ + 'px; width:' + this.width_ + 'px; text-align:center;');
    }

    var txtColor = this.textColor_ ? this.textColor_ : 'black';
    var txtSize = this.textSize_ ? this.textSize_ : 11;

    style.push('cursor:pointer; top:' + pos.y + 'px; left:' +
        pos.x + 'px; color:' + txtColor + '; position:absolute; font-size:' +
        txtSize + 'px; font-family:Arial,sans-serif; font-weight:bold');
    return style.join('');
};


// Export Symbols for Closure
// If you are not going to compile with closure then you can remove the
// code below.
window['MarkerClusterer'] = MarkerClusterer;
MarkerClusterer.prototype['addMarker'] = MarkerClusterer.prototype.addMarker;
MarkerClusterer.prototype['addMarkers'] = MarkerClusterer.prototype.addMarkers;
MarkerClusterer.prototype['clearMarkers'] =
    MarkerClusterer.prototype.clearMarkers;
MarkerClusterer.prototype['fitMapToMarkers'] =
    MarkerClusterer.prototype.fitMapToMarkers;
MarkerClusterer.prototype['getCalculator'] =
    MarkerClusterer.prototype.getCalculator;
MarkerClusterer.prototype['getGridSize'] =
    MarkerClusterer.prototype.getGridSize;
MarkerClusterer.prototype['getExtendedBounds'] =
    MarkerClusterer.prototype.getExtendedBounds;
MarkerClusterer.prototype['getMap'] = MarkerClusterer.prototype.getMap;
MarkerClusterer.prototype['getMarkers'] = MarkerClusterer.prototype.getMarkers;
MarkerClusterer.prototype['getMaxZoom'] = MarkerClusterer.prototype.getMaxZoom;
MarkerClusterer.prototype['getStyles'] = MarkerClusterer.prototype.getStyles;
MarkerClusterer.prototype['getTotalClusters'] =
    MarkerClusterer.prototype.getTotalClusters;
MarkerClusterer.prototype['getTotalMarkers'] =
    MarkerClusterer.prototype.getTotalMarkers;
MarkerClusterer.prototype['redraw'] = MarkerClusterer.prototype.redraw;
MarkerClusterer.prototype['removeMarker'] =
    MarkerClusterer.prototype.removeMarker;
MarkerClusterer.prototype['removeMarkers'] =
    MarkerClusterer.prototype.removeMarkers;
MarkerClusterer.prototype['resetViewport'] =
    MarkerClusterer.prototype.resetViewport;
MarkerClusterer.prototype['repaint'] =
    MarkerClusterer.prototype.repaint;
MarkerClusterer.prototype['setCalculator'] =
    MarkerClusterer.prototype.setCalculator;
MarkerClusterer.prototype['setGridSize'] =
    MarkerClusterer.prototype.setGridSize;
MarkerClusterer.prototype['setMaxZoom'] =
    MarkerClusterer.prototype.setMaxZoom;
MarkerClusterer.prototype['onAdd'] = MarkerClusterer.prototype.onAdd;
MarkerClusterer.prototype['draw'] = MarkerClusterer.prototype.draw;

Cluster.prototype['getCenter'] = Cluster.prototype.getCenter;
Cluster.prototype['getSize'] = Cluster.prototype.getSize;
Cluster.prototype['getMarkers'] = Cluster.prototype.getMarkers;

ClusterIcon.prototype['onAdd'] = ClusterIcon.prototype.onAdd;
ClusterIcon.prototype['draw'] = ClusterIcon.prototype.draw;
ClusterIcon.prototype['onRemove'] = ClusterIcon.prototype.onRemove;
(function ($) {
	'use strict';
	
	var propertyRating = {};
	mkdf.modules.propertyRating = propertyRating;

    propertyRating.mkdfOnDocumentReady = mkdfOnDocumentReady;
	
	$(document).ready(mkdfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function mkdfOnDocumentReady() {
		mkdfInitCommentRating();
	}
	
	function mkdfInitCommentRating() {
		var ratingInput = $('#mkdf-rating'),
			ratingValue = ratingInput.val(),
			stars = $('.mkdf-star-rating');
		
		var addActive = function () {
			for (var i = 0; i < stars.length; i++) {
				var star = stars[i];
				if (i < ratingValue) {
					$(star).addClass('active');
				} else {
					$(star).removeClass('active');
				}
			}
		};
		
		addActive();
		
		stars.click(function () {
			ratingInput.val($(this).data('value')).trigger('change');
		});
		
		ratingInput.change(function () {
			ratingValue = ratingInput.val();
			addActive();
		});
	}
	
})(jQuery);
(function($) {
    'use strict';

    var roles = {};
    mkdf.modules.roles = roles;

    roles.mkdfOnDocumentReady = mkdfOnDocumentReady;

    $(document).ready(mkdfOnDocumentReady);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
        mkdfInitRegisterSelect();
    }

    function mkdfInitRegisterSelect() {
        var registerForm = $('.mkdf-register-content-inner');
        var select = registerForm.find('select');
        if (select.length) {
            select.each(function() {
                var thisSelect = $(this);

                thisSelect.select2({
                    minimumResultsForSearch: Infinity
                });
            });
        }
    }

})(jQuery);
(function($) {
    'use strict';

    var agency = {};
    mkdf.modules.agency = agency;

    agency.mkdfOnDocumentReady = mkdfOnDocumentReady;
    agency.mkdfOnWindowLoad = mkdfOnWindowLoad;
    agency.mkdfOnWindowResize = mkdfOnWindowResize;
    agency.mkdfOnWindowScroll = mkdfOnWindowScroll;

    $(document).ready(mkdfOnDocumentReady);
    $(window).load(mkdfOnWindowLoad);
    $(window).resize(mkdfOnWindowResize);
    $(window).scroll(mkdfOnWindowScroll);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
        mkdfAgencyAddAgent();
        mkdfUpdateAgencyProfile();
    }

    /*
     All functions to be called on $(window).load() should be in this function
     */
    function mkdfOnWindowLoad() {
    }

    /*
     All functions to be called on $(window).resize() should be in this function
     */
    function mkdfOnWindowResize() {

    }

    /*
     All functions to be called on $(window).scroll() should be in this function
     */
    function mkdfOnWindowScroll() {
    }

    /**
     * Add Agent Profile
     */
    function mkdfAgencyAddAgent() {
        var addForm = $('#mkdf-re-add-agent-form');

        if ( addForm.length ) {
            var btnText = addForm.find('button'),
                updatingBtnText = btnText.data('updating-text'),
                updatedBtnText = btnText.data('updated-text');

            addForm.on('submit', function (e) {
                e.preventDefault();
                var prevBtnText = btnText.html();
                btnText.html(updatingBtnText);

                var ajaxData = {
                    action: 'mkdf_re_add_agent_profile',
                    data: $(this).serialize()
                };

                $.ajax({
                    type: 'POST',
                    data: ajaxData,
                    url: mkdfGlobalVars.vars.mkdfAjaxUrl,
                    success: function (data) {
                        var response;
                        response = JSON.parse(data);

                        // append ajax response html
                        mkdf.modules.socialLogin.mkdfRenderAjaxResponseMessage(response);
                        if (response.status == 'success') {
                            btnText.html(updatedBtnText);
                        } else {
                            btnText.html(prevBtnText);
                        }
                    }
                });
                return false;
            });
        }
    }

    /**
     * Update Agency Profile
     */
    function mkdfUpdateAgencyProfile() {
        var addForm = $('#mkdf-re-update-agency-profile-form');

        if ( addForm.length ) {
            var btnText = addForm.find('button'),
                updatingBtnText = btnText.data('updating-text'),
                updatedBtnText = btnText.data('updated-text');

            addForm.on('submit', function (e) {
                e.preventDefault();
                var prevBtnText = btnText.html();
                btnText.html(updatingBtnText);

                var ajaxData = {
                    action: 'mkdf_re_update_agency_profile',
                    data: $(this).serialize()
                };

                $.ajax({
                    type: 'POST',
                    data: ajaxData,
                    url: mkdfGlobalVars.vars.mkdfAjaxUrl,
                    success: function (data) {
                        var response;
                        response = JSON.parse(data);

                        // append ajax response html
                        mkdf.modules.socialLogin.mkdfRenderAjaxResponseMessage(response);
                        if (response.status == 'success') {
                            btnText.html(updatedBtnText);
                        } else {
                            btnText.html(prevBtnText);
                        }
                    }
                });
                return false;
            });
        }
    }

})(jQuery);
(function($) {
    'use strict';

    var agent = {};
    mkdf.modules.agent = agent;

    agent.mkdfOnDocumentReady = mkdfOnDocumentReady;
    agent.mkdfOnWindowLoad = mkdfOnWindowLoad;
    agent.mkdfOnWindowResize = mkdfOnWindowResize;
    agent.mkdfOnWindowScroll = mkdfOnWindowScroll;

    $(document).ready(mkdfOnDocumentReady);
    $(window).load(mkdfOnWindowLoad);
    $(window).resize(mkdfOnWindowResize);
    $(window).scroll(mkdfOnWindowScroll);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
        mkdfUpdateAgentProfile();
    }

    /*
     All functions to be called on $(window).load() should be in this function
     */
    function mkdfOnWindowLoad() {
    }

    /*
     All functions to be called on $(window).resize() should be in this function
     */
    function mkdfOnWindowResize() {

    }

    /*
     All functions to be called on $(window).scroll() should be in this function
     */
    function mkdfOnWindowScroll() {
    }
    /**
     * Update Agency Profile
     */
    function mkdfUpdateAgentProfile() {
        var addForm = $('#mkdf-re-update-agent-profile-form');

        if ( addForm.length ) {
            var btnText = addForm.find('button'),
                updatingBtnText = btnText.data('updating-text'),
                updatedBtnText = btnText.data('updated-text');

            addForm.on('submit', function (e) {
                e.preventDefault();
                var prevBtnText = btnText.html();
                btnText.html(updatingBtnText);

                var ajaxData = {
                    action: 'mkdf_re_update_agent_profile',
                    data: $(this).serialize()
                };

                $.ajax({
                    type: 'POST',
                    data: ajaxData,
                    url: mkdfGlobalVars.vars.mkdfAjaxUrl,
                    success: function (data) {
                        var response;
                        response = JSON.parse(data);

                        // append ajax response html
                        mkdf.modules.socialLogin.mkdfRenderAjaxResponseMessage(response);
                        if (response.status == 'success') {
                            btnText.html(updatedBtnText);
                        } else {
                            btnText.html(prevBtnText);
                        }
                    }
                });
                return false;
            });
        }
    }

})(jQuery);
(function($) {
    'use strict';

    var owner = {};
    mkdf.modules.owner = owner;

    owner.mkdfOnDocumentReady = mkdfOnDocumentReady;
    owner.mkdfOnWindowLoad = mkdfOnWindowLoad;
    owner.mkdfOnWindowResize = mkdfOnWindowResize;
    owner.mkdfOnWindowScroll = mkdfOnWindowScroll;

    $(document).ready(mkdfOnDocumentReady);
    $(window).load(mkdfOnWindowLoad);
    $(window).resize(mkdfOnWindowResize);
    $(window).scroll(mkdfOnWindowScroll);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
        mkdfUpdateOwnerProfile();
    }

    /*
     All functions to be called on $(window).load() should be in this function
     */
    function mkdfOnWindowLoad() {
    }

    /*
     All functions to be called on $(window).resize() should be in this function
     */
    function mkdfOnWindowResize() {

    }

    /*
     All functions to be called on $(window).scroll() should be in this function
     */
    function mkdfOnWindowScroll() {
    }
    /**
     * Update Agency Profile
     */
    function mkdfUpdateOwnerProfile() {
        var addForm = $('#mkdf-re-update-owner-profile-form');

        if ( addForm.length ) {
            var btnText = addForm.find('button'),
                updatingBtnText = btnText.data('updating-text'),
                updatedBtnText = btnText.data('updated-text');

            addForm.on('submit', function (e) {
                e.preventDefault();
                var prevBtnText = btnText.html();
                btnText.html(updatingBtnText);

                var ajaxData = {
                    action: 'mkdf_re_update_owner_profile',
                    data: $(this).serialize()
                };

                $.ajax({
                    type: 'POST',
                    data: ajaxData,
                    url: mkdfGlobalVars.vars.mkdfAjaxUrl,
                    success: function (data) {
                        var response;
                        response = JSON.parse(data);

                        // append ajax response html
                        mkdf.modules.socialLogin.mkdfRenderAjaxResponseMessage(response);
                        if (response.status == 'success') {
                            btnText.html(updatedBtnText);
                        } else {
                            btnText.html(prevBtnText);
                        }
                    }
                });
                return false;
            });
        }
    }

})(jQuery);