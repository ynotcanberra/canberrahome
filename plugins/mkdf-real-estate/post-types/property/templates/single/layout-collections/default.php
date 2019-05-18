<?php
    echo mkdf_re_get_cpt_single_module_template_part( 'templates/single/parts/slider', 'property', $params['item_layout'], $params );
    echo mkdf_re_get_cpt_single_module_template_part( 'templates/single/parts/basic-info', 'property', '', $params );
?>
<div class="mkdf-container">
    <div class="mkdf-container-inner clearfix">
        <div class="mkdf-grid-row">
            <div <?php echo zuhaus_mikado_get_content_sidebar_class(); ?>>
                <div class="mkdf-property-single-outer">
                    <?php echo mkdf_re_get_cpt_single_module_template_part( 'templates/single/parts/title', 'property', '', $params ); ?>
                    <?php echo mkdf_re_get_cpt_single_module_template_part( 'templates/single/parts/specification', 'property', '', $params ); ?>
                    <?php echo mkdf_re_get_cpt_single_module_template_part( 'templates/single/parts/leasing-terms', 'property', '', $params ); ?>
                    <?php echo mkdf_re_get_cpt_single_module_template_part( 'templates/single/parts/costs', 'property', '', $params ); ?>
                    <?php echo mkdf_re_get_cpt_single_module_template_part( 'templates/single/parts/features', 'property', '', $params ); ?>
                    <?php echo mkdf_re_get_cpt_single_module_template_part( 'templates/single/parts/map', 'property', '', $params ); ?>
                    <?php echo mkdf_re_get_cpt_single_module_template_part( 'templates/single/parts/video', 'property', '', $params ); ?>
                    <?php echo mkdf_re_get_cpt_single_module_template_part( 'templates/single/parts/description', 'property', '', $params ); ?>
                    <?php echo mkdf_re_get_cpt_single_module_template_part( 'templates/single/parts/virtual-tour', 'property', '', $params ); ?>
                    <?php echo mkdf_re_get_cpt_single_module_template_part( 'templates/single/parts/multi-unit', 'property', '', $params ); ?>
                    <?php echo mkdf_re_get_cpt_single_module_template_part( 'templates/single/parts/floor-plans', 'property', '', $params ); ?>
                    <?php echo mkdf_re_get_cpt_single_module_template_part( 'templates/single/parts/tags', 'property', '', $params ); ?>
                    <?php echo mkdf_re_get_cpt_single_module_template_part( 'templates/single/parts/related-properties', 'property', '', $params ); ?>
                    <?php echo mkdf_re_get_rating_form(); ?>
                </div>
            </div>
            <?php if ( $sidebar_layout !== 'no-sidebar' ) { ?>
                <div <?php echo zuhaus_mikado_get_sidebar_holder_class(); ?>>
                    <?php get_sidebar(); ?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>