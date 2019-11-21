<?php
$city_enabled = isset($enable_city) && $enable_city === 'yes';
$cities = mkdf_re_get_taxonomy_list('property-city');
?>
<?php if($city_enabled) { ?>
    <div class="mkdf-search-bottom-part mkdf-search-city-section">
        <label for="mkdf-search-city"><?php esc_html_e('Choose a location', 'mkdf-real-estate') ?></label>
        <div class="mkdf-search-property-icon">
            <span aria-hidden="true" class="mkdf-icon-ion-icon ion-ios-location-outline"></span>
        </div>
        <select id="mkdf-search-city" name="mkdf-search-city">
            <option value=""><?php esc_html_e('All Locations', 'mkdf-real-estate') ?></option>
            <?php foreach($cities as $key => $city) { ?>
                <option value="<?php echo esc_attr($key); ?>"><?php echo esc_html($city); ?></option>
            <?php } ?>
        </select>
    </div>
<?php } ?>