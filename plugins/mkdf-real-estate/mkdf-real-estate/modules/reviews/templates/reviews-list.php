<div class="mkdf-property-reviews">
    <div class="mkdf-property-reviews-list-top">
        <div class="mkdf-property-reviews-number-wrapper">
            <h5 class="mkdf-property-reviews-summary">
                <span class="mkdf-property-reviews-number">
                    <?php echo mkdf_re_property_number_of_ratings(); ?>
                </span>
                <span class="mkdf-property-reviews-label">
                    <?php echo mkdf_re_property_number_of_ratings() === 1 ? esc_html__('Review', 'mkdf-real-estate') : esc_html__('Reviews', 'mkdf-real-estate'); ?>
                </span>
            </h5>
            <span class="mkdf-property-stars-wrapper">
                <span class="mkdf-property-stars">
                    <?php
                    $review_rating = mkdf_re_property_average_rating();
                    for ($i = 1; $i <= $review_rating; $i++) { ?>
                        <i class="fa fa-star" aria-hidden="true"></i>
                    <?php } ?>
                </span>
            </span>
        </div>
    </div>
    <div class="mkdf-property-reviews-list">
        <?php comments_template('', true); ?>
    </div>
</div>