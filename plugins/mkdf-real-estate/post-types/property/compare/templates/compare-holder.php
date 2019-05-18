<div class="mkdf-re-compare-holder <?php echo esc_attr($holder_classes); ?>">
    <div class="mkdf-re-compare-holder-title">
        <h3><?php esc_html_e('Compare properties', 'mkdf-real-estate') ?></h3>
    </div>
    <a class="mkdf-re-compare-holder-opener" href="javascript:void(0)">
        <span><?php esc_html_e('Compare', 'mkdf-real-estate') ?></span>
    </a>
    <div class="mkdf-re-compare-holder-scroll">
        <div class="mkdf-re-compare-items-holder <?php echo esc_attr($items_layout); ?>">
            <?php if(isset($added_properties) && !empty($added_properties)) { ?>
                <?php foreach($added_properties as $property) { ?>
                    <?php echo mkdf_re_get_compare_list_item($property); ?>
                <?php } ?>
            <?php } ?>
        </div>
        <div class="mkdf-re-compare-actions">
            <?php echo zuhaus_mikado_get_button_html(
                    array(
                        'type'          => 'simple',
                        'text'          => esc_html__('Details', 'mkdf-real-estate'),
                        'custom_class'  => 'mkdf-re-compare-do-compare'
                    )
            ); ?>
            <?php echo zuhaus_mikado_get_button_html(
                array(
                    'type'          => 'simple',
                    'text'          => esc_html__('Reset', 'mkdf-real-estate'),
                    'custom_class'  => 'mkdf-re-compare-do-reset'
                )
            ); ?>
        </div>
    </div>
</div>