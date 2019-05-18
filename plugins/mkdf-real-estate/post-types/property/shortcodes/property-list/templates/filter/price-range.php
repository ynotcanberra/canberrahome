<?php
$min_price = isset($property_min_price) && !empty($property_min_price) ? $property_min_price : 0;
$max_price = isset($property_max_price) && !empty($property_max_price) ? $property_max_price : mkdf_re_get_property_max_price_value();
$price_label = zuhaus_mikado_options()->getOptionValue('property_price_label');
$price_label = $price_label != '' ? $price_label : esc_html('$');
?>
<div class="mkdf-filter-section mkdf-filter-section-6 mkdf-section-price">
    <div class="mkdf-filter-price-holder" data-price-label-setting="<?php echo esc_attr($price_label); ?>" data-max-price-setting="<?php echo esc_attr(mkdf_re_get_property_max_price_value()); ?>">
        <div class="mkdf-range-slider-response-holder">
            <span><?php esc_html_e('Price range: ', 'mkdf-real-estate'); ?></span>
            <span id="mkdf-min-price-label"><?php esc_html_e('From', 'mkdf-real-estate'); ?></span>
            <span id="mkdf-min-price-value" data-min-price="<?php echo esc_attr($min_price); ?>"><?php echo esc_html($price_label) . esc_html($min_price); ?></span>
            <span id="mkdf-max-price-label"><?php esc_html_e('to', 'mkdf-real-estate'); ?></span>
            <span id="mkdf-max-price-value" data-max-price="<?php echo esc_attr($max_price); ?>"><?php echo esc_html($price_label) . esc_html($max_price); ?></span>
        </div>
        <div class="mkdf-range-slider-wrapper">
            <div class="mkdf-range-slider"></div>
        </div>
    </div>
</div>