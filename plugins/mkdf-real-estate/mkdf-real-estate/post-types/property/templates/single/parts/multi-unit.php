<?php
$titles         = get_post_meta(get_the_ID(), 'mkdf_property_multi_unit_title_meta', true);
$types          = get_post_meta(get_the_ID(), 'mkdf_property_multi_unit_type_meta', true);
$prices         = get_post_meta(get_the_ID(), 'mkdf_property_multi_unit_price_meta', true);
$bedrooms       = get_post_meta(get_the_ID(), 'mkdf_property_multi_unit_bedrooms_meta', true);
$bathrooms      = get_post_meta(get_the_ID(), 'mkdf_property_multi_unit_bathrooms_meta', true);
$sizes          = get_post_meta(get_the_ID(), 'mkdf_property_multi_unit_size_meta', true);
$dates          = get_post_meta(get_the_ID(), 'mkdf_property_multi_unit_available_meta', true);
if(is_array($titles) && !empty($titles[0])) {
?>
<div class="mkdf-property-multi-unit mkdf-property-label-items-holder">
    <div class="mkdf-property-multi-unit-label mkdf-property-label-style">
        <h5>
            <?php esc_html_e('Multi Units', 'mkdf-real-estate'); ?>
        </h5>
    </div>
    <div class="mkdf-property-multi-unit-items mkdf-property-items-style clearfix">
        <table>
            <thead>
                <tr>
                    <td><?php esc_html_e('Title', 'mkdf-real-estate'); ?></td>
                    <td><?php esc_html_e('Type', 'mkdf-real-estate'); ?></td>
                    <td><?php esc_html_e('Price', 'mkdf-real-estate'); ?></td>
                    <td><?php esc_html_e('Bedrooms', 'mkdf-real-estate'); ?></td>
                    <td><?php esc_html_e('Bathrooms', 'mkdf-real-estate'); ?></td>
                    <td><?php esc_html_e('Size', 'mkdf-real-estate'); ?></td>
                    <td><?php esc_html_e('Available', 'mkdf-real-estate'); ?></td>
                </tr>
            </thead>
            <tbody>
                <?php foreach($titles as $key => $title) { ?>
                    <tr>
                        <td>
                            <?php echo esc_html($title);?>
                        </td>
                        <td>
                            <?php echo esc_html($types[$key]);?>
                        </td>
                        <td>
                            <?php echo esc_html($prices[$key]);?>
                        </td>
                        <td>
                            <?php echo esc_html($bedrooms[$key]);?>
                        </td>
                        <td>
                            <?php echo esc_html($bathrooms[$key]);?>
                        </td>
                        <td>
                            <?php echo esc_html($sizes[$key]);?>
                        </td>
                        <td>
                            <?php echo esc_html($dates[$key]);?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<?php } ?>