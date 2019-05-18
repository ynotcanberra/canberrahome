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