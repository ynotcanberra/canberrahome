<article class="mkdf-pl-item <?php echo esc_attr( $this_object->getArticleClasses( $params ) ); ?>" id="<?php echo esc_attr(get_the_ID()); ?>">
    <div class="mkdf-pl-item-inner">
        <?php echo mkdf_re_get_cpt_shortcode_module_template_part( 'property', 'property-list', 'layout-collections/' . $item_layout, '', $params ); ?>
        <a itemprop="url" class="mkdf-pli-link mkdf-block-drag-link" href="<?php echo get_permalink(); ?>" target="_self"></a>
    </div>
</article>