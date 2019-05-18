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