<?php
$cities = mkdf_re_get_property_taxonomy('property-city');
if(!empty($cities)) {
    $city_name = $cities[0]->name;
}
$counties = mkdf_re_get_property_taxonomy('property-county');
if(!empty($counties)) {
    $county_name = $counties[0]->name;
}
$zip_code = get_post_meta(get_the_ID(), 'mkdf_property_zip_code_meta', true);
$country = get_post_meta(get_the_ID(), 'mkdf_property_address_country_meta', true);
?>
<div class="mkdf-item-address">
    <?php if(!empty($cities)) { ?>
        <span class="mkdf-item-city"><?php echo esc_html($city_name); ?></span>
        <span class="mkdf-item-dash">&ndash;</span>
    <?php } ?>
    <?php if(!empty($counties)) { ?>
        <span class="mkdf-item-city"><?php echo esc_html($county_name); ?></span>
        <span class="mkdf-item-comma"></span>
    <?php } ?>
    <span class="mkdf-item-city"><?php //echo esc_html($country); ?></span>
    <span class="mkdf-item-city"><?php //echo esc_html($zip_code); ?></span>
</div>
