<div class="mkdf-pcl-item-image">
    <?php echo mkdf_re_get_taxonomy_featured_image($id, 'property_city_featured_image'); ?>
</div>
<div class="mkdf-pcl-item-content">
    <div class="mkdf-pcl-item-content-outer">
        <div class="mkdf-pcl-item-content-inner">
            <div class="mkdf-pcl-item-count">
                <?php echo esc_html($count); ?>
            </div>
            <div class="mkdf-pcl-item-label">
                <?php esc_html_e('Real Estate', 'mkdf-real-estate'); ?>
            </div>
            <div class="mkdf-pcl-item-separator">
                <span></span>
            </div>
            <h5 class="mkdf-pcl-item-title">
                <?php echo esc_html($name); ?>
            </h5>
            <div class="mkdf-pcl-item-county">
                <?php echo esc_html(mkdf_re_get_taxonomy_name_from_id($county));?>
            </div>
        </div>
    </div>
</div>