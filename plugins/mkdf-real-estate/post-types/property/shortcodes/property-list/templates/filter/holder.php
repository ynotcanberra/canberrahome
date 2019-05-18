<?php if(isset($params['enable_filter']) && $params['enable_filter'] === 'yes') { ?>
    <div class="mkdf-property-list-filter-part">
        <div class="mkdf-filter-row mkdf-filter-section-st">
            <?php echo mkdf_re_get_cpt_shortcode_module_template_part( 'property', 'property-list', 'filter/status', '', $params ); ?>
            <?php echo mkdf_re_get_cpt_shortcode_module_template_part( 'property', 'property-list', 'filter/type', '', $params ); ?>
        </div>
        <div class="mkdf-filter-row mkdf-filter-section-csp">
            <?php echo mkdf_re_get_cpt_shortcode_module_template_part( 'property', 'property-list', 'filter/city', '', $params ); ?>
            <?php echo mkdf_re_get_cpt_shortcode_module_template_part( 'property', 'property-list', 'filter/size', '', $params ); ?>
            <?php echo mkdf_re_get_cpt_shortcode_module_template_part( 'property', 'property-list', 'filter/price-range', '', $params ); ?>
        </div>
        <div class="mkdf-filter-row mkdf-filter-section-sf">
            <?php echo mkdf_re_get_cpt_shortcode_module_template_part( 'property', 'property-list', 'filter/specification', '', $params ); ?>
            <?php echo mkdf_re_get_cpt_shortcode_module_template_part( 'property', 'property-list', 'filter/features', '', $params ); ?>
        </div>
        <div class="mkdf-filter-row mkdf-filter-section-action">
            <?php echo mkdf_re_get_cpt_shortcode_module_template_part( 'property', 'property-list', 'filter/button', '', $params ); ?>
        </div>
    </div>
    <?php echo mkdf_re_get_cpt_shortcode_module_template_part( 'property', 'property-list', 'filter/loading-element' ); ?>
<?php } ?>