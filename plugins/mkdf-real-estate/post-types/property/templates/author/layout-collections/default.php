<div class="mkdf-container">
    <div class="mkdf-container-inner clearfix">
        <div class="mkdf-grid-row">
            <div <?php echo zuhaus_mikado_get_content_sidebar_class(); ?>>
                <div class="mkdf-re-author-holder">
                    <div class="mkdf-re-author-info-section clearfix">
                        <div class="mkdf-author-image">
                            <?php echo mkdf_re_get_cpt_single_module_template_part( 'templates/author/parts/image', 'property', '', $params ); ?>
                        </div>
                        <div class="mkdf-author-info">
                            <?php echo mkdf_re_get_cpt_single_module_template_part( 'templates/author/parts/title', 'property', $role, $params ); ?>
                            <?php echo mkdf_re_get_cpt_single_module_template_part( 'templates/author/parts/description', 'property', $role, $params ); ?>
                            <?php echo mkdf_re_get_cpt_single_module_template_part( 'templates/author/parts/contact', 'property', $role, $params ); ?>
                            <?php echo mkdf_re_get_cpt_single_module_template_part( 'templates/author/parts/footer', 'property', $role, $params ); ?>
                        </div>
                    </div>
                    <div class="mkdf-re-author-properties-section">
                        <h2 class="mkdf-re-properties-title">
                            <?php esc_html_e('Property List', 'mkdf-real-estate'); ?>
                        </h2>
                        <?php mkdf_re_get_archive_property_list('', '', $author->ID, 'no', 'no'); ?>
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