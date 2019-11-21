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
