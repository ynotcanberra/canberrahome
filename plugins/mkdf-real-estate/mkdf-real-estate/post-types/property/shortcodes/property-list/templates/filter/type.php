<?php
$property_set = isset($params['property_type']) && $params['property_type'] !== '';
$hide_active_filter = isset($params['hide_active_filter']) && $params['hide_active_filter'] === 'yes';
$property_list_params = array(
    'number_of_columns'         => '6',
    'space_between_items'       => 'tiny',
    'active_element'            => $params['property_type'],
);
?>
<?php if(!$property_set || ($property_set && !$hide_active_filter)) { ?>
<div class="mkdf-filter-section mkdf-filter-section-9 mkdf-section-type">
    <div class="mkdf-filter-type-holder" data-default-type="<?php echo esc_attr($params['property_type']); ?>" data-type="<?php echo esc_attr($params['property_type']); ?>">
        <?php echo zuhaus_mikado_execute_shortcode('mkdf_property_type_list', $property_list_params); ?>
    </div>
</div>
<?php } ?>