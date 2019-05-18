<?php
$specification_items = mkdf_re_get_property_specification_items();
$additional_specification_items = mkdf_re_get_property_additional_specification_items();
?>
<div class="mkdf-property-specification mkdf-property-label-items-holder">
    <div class="mkdf-property-spec-label mkdf-property-label-style">
        <h5>
            <?php esc_html_e('Specification', 'mkdf-real-estate'); ?>
        </h5>
    </div>
    <div class="mkdf-property-spec-items mkdf-property-items-style clearfix">
        <div class="mkdf-spec">
            <div class="mkdf-grid-row">
                <?php foreach($specification_items as $item) { ?>
                    <div class="mkdf-grid-col-6 <?php echo $rtrim = rtrim($item['label'],':'); ?>">
                        <div class="mkdf-spec-item mkdf-label-items-item ">
                            <span class="mkdf-spec-item-label mkdf-label-items-label">
                                <span class="mkdf-label-icon">
                                    <?php print $item['icon']; ?>
                                </span>
                                <span class="mkdf-label-text">
                                    <?php echo esc_html($item['label']); ?>
                                </span>
                            </span>
                            <span class="mkdf-spec-item-value mkdf-label-items-value">
                                <?php echo esc_html($item['value']); ?>
                            </span>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="mkdf-additional-spec">
            <div class="mkdf-grid-row">
                <?php foreach($additional_specification_items as $item) { ?>
                    <div class="mkdf-grid-col-6 <?php if (esc_html($item['label'])=='Parking:sdsds') {echo "Parking"; } else{ echo $rtrim = rtrim($item['label'],':');} ?>">
                        <div class="mkdf-spec-item mkdf-label-items-item">
                            <span class="mkdf-spec-item-label mkdf-label-items-label">
                                <span class="mkdf-label-icon">
                                    <?php print $item['icon']; ?>
                                </span>
                                    <span class="mkdf-label-text">
                                    <?php if (esc_html($item['label'])=='Parking:sdsds') {echo "Parking:"; } elseif(esc_html($item['label'])=='Publication date:'){ echo "Inspection:";} else {echo esc_html($item['label']);} ?>
                                </span>
                            </span>
                            <span class="mkdf-spec-item-value mkdf-label-items-value">
                                <?php echo esc_html($item['value']); ?>
                            </span>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>