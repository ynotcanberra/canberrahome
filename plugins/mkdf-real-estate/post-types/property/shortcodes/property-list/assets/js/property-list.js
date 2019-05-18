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