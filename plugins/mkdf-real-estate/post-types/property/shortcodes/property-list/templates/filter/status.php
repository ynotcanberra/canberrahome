<?php
$status_set = isset($params['property_status']) && $params['property_status'] !== '';
$hide_active_filter = isset($params['hide_active_filter']) && $params['hide_active_filter'] === 'yes';
$statuses = mkdf_re_get_taxonomy_list('property-status');
?>
<?php if(!$status_set || ($status_set && !$hide_active_filter)) { ?>
<div class="mkdf-filter-section mkdf-filter-section-3 mkdf-section-status">
    <div class="mkdf-filter-status-holder" data-default-status="<?php echo esc_attr($params['property_status']); ?>" data-status="<?php echo esc_attr($params['property_status']); ?>">
        <div class="mkdf-filter-property-icon">
            <span aria-hidden="true" class="mkdf-icon-ion-icon ion-ios-compose-outline"></span>
        </div>
        <select class="mkdf-filter-statuses">
            <option value=""><?php esc_html_e('All Properties', 'mkdf-real-estate') ?></option>
            <?php foreach($statuses as $key => $status) { ?>
                <option <?php echo $params['property_status'] == $key ? 'selected' : ''; ?> value="<?php echo esc_attr($key); ?>"><?php echo esc_html($status); ?></option>
            <?php } ?>
        </select>
    </div>
</div>
<?php } ?>