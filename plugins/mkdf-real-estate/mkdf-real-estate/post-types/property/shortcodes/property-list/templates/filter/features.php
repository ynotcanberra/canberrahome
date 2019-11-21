<?php
$feature_set = isset($params['property_features']) && $params['property_features'] !== '';
$hide_active_filter = isset($params['hide_active_filter']) && $params['hide_active_filter'] === 'yes';
$features = mkdf_re_get_taxonomy_list('property-feature');
$property_features = explode(',', $property_features);
?>
<?php if(!$feature_set || ($feature_set && !$hide_active_filter)) { ?>
<div class="mkdf-filter-section mkdf-filter-section-9 mkdf-section-features">
    <div class="mkdf-filter-features-holder">
        <div class="mkdf-filter-features-wrapper clearfix">
            <?php foreach ($features as $key => $feature) { ?>
                <div class="mkdf-feature-item">
                    <input type="checkbox" <?php echo !empty($property_features) && in_array($key, $property_features) ? 'checked' : ''; ?> class="mkdf-feature-cb" data-id="<?php echo esc_attr($key); ?>" id="mkdf-feature-<?php echo esc_attr($key); ?>" name="mkdf-features[]" value="" />
                    <label class="mkdf-checkbox-label" for="mkdf-feature-<?php echo esc_attr($key); ?>">
                        <span class="mkdf-label-view"></span>
                        <span class="mkdf-label-text">
                            <?php echo esc_html($feature); ?>
                        </span>
                    </label>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<?php } ?>