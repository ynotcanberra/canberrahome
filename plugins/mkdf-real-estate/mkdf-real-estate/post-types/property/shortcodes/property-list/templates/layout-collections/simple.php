<div class="mkdf-item-content-wrapper">
    <div class="mkdf-item-image-section">
        <?php echo mkdf_re_get_cpt_shortcode_module_template_part( 'property', 'property-list', 'parts/image', '', $params ); ?>
    </div>
    <div class="mkdf-item-content">
        <?php echo mkdf_re_get_cpt_shortcode_module_template_part( 'property', 'property-list', 'parts/title', '', $params ); ?>
        <?php echo mkdf_re_get_cpt_shortcode_module_template_part( 'property', 'property-list', 'parts/price', '', $params ); ?>
        <?php echo mkdf_re_get_cpt_shortcode_module_template_part( 'property', 'property-list', 'parts/info', '', $params ); ?>
        <?php echo mkdf_re_get_cpt_shortcode_module_template_part( 'property', 'property-list', 'parts/taxonomy', 'type', $params ); ?>
    </div>
</div>