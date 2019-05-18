<li class="mkdf-ptl-item mkdf-item-space <?php echo $id == $params['active_element'] ? 'active' : ''; ?>" data-id="<?php echo esc_attr($id); ?>">
    <div class="mkdf-ptl-item-inner">
        <?php echo mkdf_re_get_cpt_shortcode_module_template_part( 'property', 'property-type-list', 'layout-collections/' . $item_layout, '', $params, $additional_params ); ?>
        <a itemprop="url" class="mkdf-ptl-item-link" href="<?php echo esc_url($link); ?>" target="_self"></a>
    </div>
</li>