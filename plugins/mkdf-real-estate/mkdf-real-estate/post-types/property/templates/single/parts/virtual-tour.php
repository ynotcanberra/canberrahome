<?php
    $virtual_tour = get_post_meta(get_the_ID(), 'mkdf_property_virtual_tour_meta', true);
?>
<div class="mkdf-property-virtual-tour mkdf-property-label-items-holder">
    <div class="mkdf-property-virtual-tour-label mkdf-property-label-style">
        <h5>
            <?php esc_html_e('Virtual Tour', 'mkdf-real-estate'); ?>
        </h5>
    </div>
    <div class="mkdf-property-virtual-tour-items mkdf-property-items-style clearfix">
        <?php print $virtual_tour; ?>
    </div>
</div>