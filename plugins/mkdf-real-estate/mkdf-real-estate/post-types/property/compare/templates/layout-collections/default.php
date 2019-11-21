<div class="mkdf-ci-item" data-item-id="<?php echo esc_attr($id); ?>">
    <div class="mkdf-ci-item-inner">
        <div class="mkdf-item-top-section">
	        <?php echo mkdf_re_cpt_single_module_template_part( 'compare/templates/parts/remove', 'property', '', $params ); ?>
            <?php echo mkdf_re_cpt_single_module_template_part( 'compare/templates/parts/image', 'property', '', $params ); ?>
            <div class="mkdf-item-top-section-content">
                <div class="mkdf-item-top-section-content-inner">
                    <div class="mkdf-item-info-top">
                        <?php echo mkdf_re_cpt_single_module_template_part( 'compare/templates/parts/taxonomy-status', 'property', '', $params ); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="mkdf-item-bottom-section">
            <div class="mkdf-item-bottom-section-content">
                <?php echo mkdf_re_cpt_single_module_template_part( 'compare/templates/parts/title', 'property', '', $params ); ?>
                <?php echo mkdf_re_cpt_single_module_template_part( 'compare/templates/parts/price', 'property', '', $params ); ?>
            </div>
        </div>
    </div>
</div>
