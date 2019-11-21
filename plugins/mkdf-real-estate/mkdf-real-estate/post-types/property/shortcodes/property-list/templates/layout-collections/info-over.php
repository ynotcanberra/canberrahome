<div class="mkdf-item-top-section">
    <?php echo mkdf_re_get_cpt_shortcode_module_template_part( 'property', 'property-list', 'parts/image', $params['type'], $params ); ?>
    <div class="mkdf-item-top-section-content">
        <div class="mkdf-item-top-section-content-inner">
            <div class="mkdf-item-info-top">
                <?php echo mkdf_re_get_cpt_shortcode_module_template_part( 'property', 'property-list', 'parts/taxonomy', 'status', $params ); ?>
                <?php echo mkdf_re_get_cpt_shortcode_module_template_part( 'property', 'property-list', 'parts/featured', '', $params ); ?>
            </div>
            <div class="mkdf-item-info-bottom">
                <div class="mkdf-item-info-bottom-left">
                    <?php echo mkdf_re_get_cpt_shortcode_module_template_part( 'property', 'property-list', 'parts/title', '', $params ); ?>
                    <?php echo mkdf_re_get_cpt_shortcode_module_template_part( 'property', 'property-list', 'parts/address', '', $params ); ?>
                </div>
                <div class="mkdf-item-info-bottom-right">
                    <?php echo mkdf_re_get_cpt_shortcode_module_template_part( 'property', 'property-list', 'parts/price', '', $params ); ?>
                </div>
            </div>
        </div>
    </div>
</div>
