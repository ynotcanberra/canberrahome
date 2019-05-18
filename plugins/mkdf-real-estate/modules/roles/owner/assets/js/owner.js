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