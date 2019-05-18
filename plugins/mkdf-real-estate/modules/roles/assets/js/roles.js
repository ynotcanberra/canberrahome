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