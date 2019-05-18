<div class="mkdf-property-list-holder <?php echo esc_attr( $holder_classes ); ?>" <?php echo wp_kses( $holder_data, array( 'data' ) ); ?>>
    <?php echo mkdf_re_get_cpt_shortcode_module_template_part( 'property', 'property-list', 'parts/map', '', $params, $additional_params ); ?>
    <div class="mkdf-property-list-items-part">
        <?php echo mkdf_re_get_cpt_shortcode_module_template_part( 'property', 'property-list', 'filter/holder', '', $params, $additional_params ); ?>
        <div class="mkdf-pl-inner mkdf-outer-space clearfix">
            <div class="mkdf-pl-grid-sizer"></div>
            <div class="mkdf-pl-grid-gutter"></div>
            <?php
            if ( $query_results->have_posts() ):
                while ( $query_results->have_posts() ) : $query_results->the_post();
                    echo mkdf_re_get_cpt_shortcode_module_template_part( 'property', 'property-list', 'item', '', $params, $additional_params );
                endwhile;
            else:
                echo mkdf_re_get_cpt_shortcode_module_template_part( 'property', 'property-list', 'parts/posts-not-found' );
            endif;

            wp_reset_postdata();
            ?>
        </div>
        <?php echo mkdf_re_get_cpt_shortcode_module_template_part( 'property', 'property-list', 'pagination/' . $pagination_type, '', $params, $additional_params  ); ?>
    </div>
</div>