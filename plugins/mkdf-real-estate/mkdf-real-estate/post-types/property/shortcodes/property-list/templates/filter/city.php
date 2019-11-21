<?php
$city_set = isset($params['property_city']) && $params['property_city'] !== '';
$hide_active_filter = isset($params['hide_active_filter']) && $params['hide_active_filter'] === 'yes';
$cities = mkdf_re_get_taxonomy_list('property-city');
?>
<?php if(!$city_set || ($city_set && !$hide_active_filter)) { ?>
<div class="mkdf-filter-section mkdf-filter-section-3 mkdf-section-city">
    <div class="mkdf-filter-city-holder" data-default-city="<?php echo esc_attr($params['property_city']); ?>" data-city="<?php echo esc_attr($params['property_city']); ?>">
        <label for="mkdf-filter-city"><?php esc_html_e('Choose a location', 'mkdf-real-estate') ?></label>
        <div class="mkdf-filter-property-icon">
            <span aria-hidden="true" class="mkdf-icon-ion-icon ion-ios-location-outline"></span>
        </div>
        <select id="mkdf-filter-city" name="mkdf-filter-city" class="mkdf-filter-cities">
            <option value=""><?php esc_html_e('All Locations', 'mkdf-real-estate') ?></option>
            <?php foreach($cities as $key => $city) { ?>
                <option <?php echo $params['property_city'] == $key ? 'selected' : ''; ?> value="<?php echo esc_attr($key); ?>"><?php echo esc_html($city); ?></option>
            <?php } ?>
        </select>
    </div>
</div>
<?php } ?>