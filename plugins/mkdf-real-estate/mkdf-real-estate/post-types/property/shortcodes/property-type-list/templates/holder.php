<div class="mkdf-property-type-list-holder <?php echo esc_attr( $holder_classes ); ?>">
    <ul class="mkdf-ptl-inner <?php echo esc_attr( $holder_inner_classes ); ?> clearfix">
        <?php
        if ( isset($property_types) && !empty($property_types) ) {
            foreach($property_types as $type) {
                $additional_params['id'] = $type->term_id;
                $additional_params['name'] = $type->name;
                $additional_params['slug'] = $type->slug;
                $additional_params['count'] = $type->count;
                $additional_params['link'] = get_term_link($type->term_id);
                $additional_params['object'] = $type;
                echo mkdf_re_get_cpt_shortcode_module_template_part( 'property', 'property-type-list', 'item', '', $params, $additional_params );
            }
        } else {
            echo mkdf_re_get_cpt_shortcode_module_template_part( 'property', 'property-type-list', 'parts/posts-not-found', '', $params, $additional_params );
        }
        ?>
    </ul>
</div>