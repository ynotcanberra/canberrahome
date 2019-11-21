<div class="mkdf-ci-image">
    <?php if(isset($enable_remove_icon) && $enable_remove_icon) { ?>
        <?php echo mkdf_re_cpt_single_module_template_part( 'compare/templates/parts/remove', 'property', '', $params ); ?>
    <?php } ?>
	<?php if ( has_post_thumbnail( $id ) ) {
    $image_src = get_the_post_thumbnail_url( $id );

    if ( strpos( $image_src, '.gif' ) !== false ) {
        echo get_the_post_thumbnail( $id, 'full' );
    } else {
        echo get_the_post_thumbnail( $id, 'full' );
    }
} else { ?>
    <img itemprop="image" class="mkdf-ci-original-image" width="800" height="600" src="<?php echo MIKADO_RE_CPT_URL_PATH.'/property/assets/img/property_featured_image.jpg'; ?>" alt="<?php esc_attr_e('Property Featured Image', 'mkdf-real-estate'); ?>" />
<?php } ?>
</div>