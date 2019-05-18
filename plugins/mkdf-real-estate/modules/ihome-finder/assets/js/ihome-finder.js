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