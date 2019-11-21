<div class="mkdf-full-width">
    <div class="mkdf-full-width-inner clearfix">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <div class="mkdf-property-single-holder">
                <?php if ( post_password_required() ) {
                    echo get_the_password_form();
                } else { ?>
                    <?php

                    do_action( 'zuhaus_mikado_property_page_before_content' );

                    mkdf_re_get_cpt_single_module_template_part( 'templates/single/layout-collections/default', 'property', '', $params );

                    do_action( 'zuhaus_mikado_property_page_after_content' );

                    ?>
                <?php } ?>
            </div>
        <?php endwhile; endif; ?>
    </div>
</div>