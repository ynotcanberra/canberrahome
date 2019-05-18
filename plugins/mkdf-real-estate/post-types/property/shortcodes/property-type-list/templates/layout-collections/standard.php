<div class="mkdf-ptl-item-image">
    <?php if($params['skin'] === 'mkdf-light-skin') {?>
        <?php echo mkdf_re_get_taxonomy_icon($id, 'property_type_custom_icon_light', 'property_type_icon'); ?>
    <?php } else { ?>
        <?php echo mkdf_re_get_taxonomy_icon($id, 'property_type_custom_icon', 'property_type_icon'); ?>
    <?php } ?>
</div>
<div class="mkdf-ptl-item-title">
    <?php echo esc_html($name); ?>
</div>