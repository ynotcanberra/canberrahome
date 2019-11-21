<div class="mkdf-rating-form-title-holder">
	<div class="mkdf-comment-form-rating">
		<label><?php esc_html_e( 'Rating', 'mkdf-real-estate' ) ?><span class="required">*</span></label>
		<span class="mkdf-comment-rating-box">
			<?php for ( $i = 1; $i <= 5; $i ++ ) { ?>
				<span class="mkdf-star-rating" data-value="<?php echo esc_attr( $i ); ?>"></span>
			<?php } ?>
			<input type="hidden" name="mkdf_rating" id="mkdf-rating" value="3">
		</span>
	</div>
</div>