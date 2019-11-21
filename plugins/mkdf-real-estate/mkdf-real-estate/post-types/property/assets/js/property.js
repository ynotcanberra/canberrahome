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