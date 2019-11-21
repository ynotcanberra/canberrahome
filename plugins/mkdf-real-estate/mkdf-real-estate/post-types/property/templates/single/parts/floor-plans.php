<?php
$titles         = get_post_meta(get_the_ID(), 'mkdf_property_home_plan_title_meta', true);
$prices         = get_post_meta(get_the_ID(), 'mkdf_property_home_plan_price_meta', true);
$bedrooms       = get_post_meta(get_the_ID(), 'mkdf_property_home_plan_bedrooms_meta', true);
$bathrooms      = get_post_meta(get_the_ID(), 'mkdf_property_home_plan_bathrooms_meta', true);
$sizes          = get_post_meta(get_the_ID(), 'mkdf_property_home_plan_size_meta', true);
$images         = get_post_meta(get_the_ID(), 'mkdf_property_home_plan_image_meta', true);
$descriptions   = get_post_meta(get_the_ID(), 'mkdf_property_home_plan_description_meta', true);
if(is_array($titles) && !empty($titles[0])) {
?>
<div class="mkdf-property-floor-plans mkdf-property-label-items-holder">
    <div class="mkdf-property-floor-plans-label mkdf-property-label-style">
        <h5>
            <?php esc_html_e('Floor Plans', 'mkdf-real-estate'); ?>
        </h5>
    </div>
    <div class="mkdf-property-floor-plans-items mkdf-property-items-style clearfix">
        <div class="mkdf-accordion-holder mkdf-accordion mkdf-ac-boxed clearfix">
            <?php foreach($titles as $key => $title) { ?>
            <h6 class="mkdf-accordion-title">
                <span class="mkdf-accordion-mark">
                    <span class="mkdf_icon_plus fa fa-plus"></span>
                    <span class="mkdf_icon_minus fa fa-minus"></span>
                </span>
                <span class="mkdf-accordion-title-content">
                    <span class="mkdf-accordion-title-value">
                        <?php echo esc_html($title); ?>
                    </span>
                    <span class="mkdf-accordion-title-info">
                        <span class="mkdf-accordion-title-item mkdf-accordion-title-size">
                            <span class="mkdf-accordion-size-label">
                                <?php esc_html_e('size:', 'mkdf-real-estate'); ?>
                            </span>
                            <span class="mkdf-accordion-size-value">
                                <?php echo esc_html($sizes[$key]); ?>
                            </span>
                        </span>
                        <span class="mkdf-accordion-title-item mkdf-accordion-title-rooms">
                            <span class="mkdf-accordion-room-label">
                                <?php esc_html_e('rooms:', 'mkdf-real-estate'); ?>
                            </span>
                            <span class="mkdf-accordion-room-value">
                                <?php echo esc_html($bedrooms[$key]); ?>
                            </span>
                        </span>
                        <span class="mkdf-accordion-title-item mkdf-accordion-title-baths">
                            <span class="mkdf-accordion-bath-label">
                                <?php esc_html_e('baths:', 'mkdf-real-estate'); ?>
                            </span>
                            <span class="mkdf-accordion-bath-value">
                                <?php echo esc_html($bathrooms[$key]); ?>
                            </span>
                        </span>
                    </span>
                </span>
            </h6>
            <div class="mkdf-accordion-content">
                <div class="mkdf-accordion-content-inner">
                    <div class="mkdf-accordion-description">
                        <?php echo esc_html($descriptions[$key]); ?>
                    </div>
                    <div class="mkdf-accordion-image">
                        <img src="<?php echo esc_url($images[$key]); ?>" alt="<?php esc_attr_e('Floor plan image', 'mkdf-real-estate') ?>"/>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
<?php } ?>