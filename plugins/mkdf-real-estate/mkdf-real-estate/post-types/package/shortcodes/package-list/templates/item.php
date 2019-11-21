<li class="mkdf-package-item <?php echo esc_attr( $this_object->getArticleClasses( $params ) ); ?>">
    <div class="mkdf-package-item-inner">
        <?php echo mkdf_re_get_cpt_shortcode_module_template_part( 'package', 'package-list', 'layout-collections/' . $item_layout, '', $params, $additional_params ); ?>
    </div>
</li>