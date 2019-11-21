<?php
$icons = get_post_meta(get_the_ID(), 'mkdf_property_costs_icon_meta', true);
$labels = get_post_meta(get_the_ID(), 'mkdf_property_costs_label_meta', true);
$values = get_post_meta(get_the_ID(), 'mkdf_property_costs_value_meta', true);

if(is_array($values) && !empty($values[0])) { ?>
<div class="mkdf-property-costs mkdf-property-label-items-holder">
    <div class="mkdf-property-cost-label mkdf-property-label-style">
        <h5>
            <?php esc_html_e('Costs', 'mkdf-real-estate'); ?>
        </h5>
    </div>
    <div class="mkdf-property-cost-items mkdf-property-items-style clearfix">
        <div class="mkdf-grid-row">
            <?php foreach($values as $key => $value) { ?>
            <div class="mkdf-grid-col-6">
                <div class="mkdf-costs mkdf-label-items-item">
                    <span class="mkdf-label-items-label">
                        <span class="mkdf-label-icon">
                            <img src="<?php echo esc_attr($icons[$key]); ?>" alt="<?php esc_attr_e('Costs icon','mkdf-real-estate'); ?>"/>
                        </span>
                        <span class="mkdf-label-text">
                            <?php echo esc_html($labels[$key]) ?>
                        </span>
                    </span>
                    <span class="mkdf-cost-value mkdf-label-items-value">
                        <?php echo esc_html($value) ?>
                    </span>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
<?php } ?>
