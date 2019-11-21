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