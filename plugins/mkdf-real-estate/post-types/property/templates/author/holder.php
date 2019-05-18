<?php do_action('zuhaus_mikado_before_main_content'); ?>
<div class="<?php echo esc_attr( $holder_params['holder'] ); ?>">
    <?php do_action('zuhaus_mikado_after_container_open'); ?>
    <div class="<?php echo esc_attr( $holder_params['inner'] ); ?>">
        <?php mkdf_re_get_cpt_single_module_template_part( 'templates/author/layout-collections/default', 'property', '', $params ); ?>
    </div>
    <?php do_action('zuhaus_mikado_before_container_close'); ?>
</div>