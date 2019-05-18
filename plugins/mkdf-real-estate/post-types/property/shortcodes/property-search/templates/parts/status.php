<?php
$status_enabled = isset($enable_status) && $enable_status === 'yes';
$statuses = mkdf_re_get_taxonomy_list('property-status');
?>
<?php if($status_enabled) { ?>
    <div class="mkdf-search-bottom-part mkdf-search-status-section">
        <label for="mkdf-search-status"><?php esc_html_e('Status', 'mkdf-real-estate') ?></label>
        <div class="mkdf-search-property-icon">
            <span aria-hidden="true" class="mkdf-icon-ion-icon ion-ios-compose-outline"></span>
        </div>
        <select id="mkdf-search-status" name="mkdf-search-status">
            <option value=""><?php esc_html_e('All Properties', 'mkdf-real-estate') ?></option>
            <?php foreach($statuses as $key => $status) { ?>
                <option value="<?php echo esc_attr($key); ?>"><?php echo esc_html($status); ?></option>
            <?php } ?>
        </select>
    </div>
<?php } ?>