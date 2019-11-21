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