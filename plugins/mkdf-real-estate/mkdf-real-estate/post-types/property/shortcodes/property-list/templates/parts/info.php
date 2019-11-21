<?php
$size = get_post_meta(get_the_ID(), 'mkdf_property_size_meta', true);
$structure = get_post_meta(get_the_ID(), 'mkdf_property_bedrooms_meta', true);
$accommodation = get_post_meta(get_the_ID(), 'mkdf_property_accommodation_meta', true);
?>
<div class="mkdf-item-info">
    <span class="mkdf-item-icon"><span aria-hidden="true" class="icon_house_alt"></span></span>
    <?php if(!empty($size)) { ?>
        <span class="mkdf-item-size"><?php echo mkdf_re_get_real_estate_size($size); ?></span>
        <span class="mkdf-item-dash">&ndash;</span>
    <?php } ?>
    <?php if(!empty($structure)) { ?>
        <span class="mkdf-item-structure"><?php echo esc_html($structure); ?></span>
        <span class="mkdf-item-dash">&ndash;</span>
    <?php } ?>
    <?php if(!empty($accommodation)) { ?>
        <span class="mkdf-item-accomodation"><?php echo esc_html($accommodation); ?></span>
    <?php } ?>
</div>
