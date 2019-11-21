<?php
$property_bedrooms = isset($property_bedrooms) && !empty($property_bedrooms) ? $property_bedrooms : 0;
$property_bathrooms = isset($property_bathrooms) && !empty($property_bathrooms) ? $property_bathrooms : 0;
?>
<div class="mkdf-filter-section mkdf-filter-section-3 mkdf-section-spec">
    <div class="mkdf-filter-specification-holder">
        <div class="mkdf-quantity-buttons quantity">
            <label for="mkdf-specification-bedrooms"><?php esc_html_e('Bedrooms', 'mkdf-real-estate'); ?></label>
            <span class="mkdf-quantity-wrapper">
                <span class="mkdf-spec-quantity-minus icon_minus-06"></span>
                <input type="text" id="mkdf-specification-bedrooms" class="input-text qty text mkdf-spec-quantity-input" data-step="1" data-min="0" data-max="10" name="mkdf-specification-bedrooms" value="<?php echo esc_attr($property_bedrooms); ?>" title="<?php esc_attr_e( 'Property bedrooms', 'mkdf-real-estate' ) ?>" size="2" />
                <span class="mkdf-spec-quantity-plus icon_plus"></span>
            </span>
        </div>
        <div class="mkdf-quantity-buttons quantity">
            <label for="mkdf-specification-bathrooms"><?php esc_html_e('Bathrooms', 'mkdf-real-estate'); ?></label>
            <span class="mkdf-quantity-wrapper">
                <span class="mkdf-spec-quantity-minus icon_minus-06"></span>
                <input id="mkdf-specification-bathrooms" type="text" class="input-text qty text mkdf-spec-quantity-input" data-step="1" data-min="0" data-max="10" name="mkdf-specification-bathrooms" value="<?php echo esc_attr($property_bathrooms); ?>" title="<?php esc_attr_e( 'Property bathrooms', 'mkdf-real-estate' ) ?>" size="2" />
                <span class="mkdf-spec-quantity-plus icon_plus"></span>
            </span>
        </div>
    </div>
</div>