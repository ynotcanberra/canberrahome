<?php
$size_label = zuhaus_mikado_options()->getOptionValue( 'property_size_label' );
?>
<div class="mkdf-filter-section mkdf-filter-section-3 mkdf-section-size">
    <div class="mkdf-filter-size-holder" data-size-min="" data-size-max="">
        <label><?php esc_html_e('Size', 'mkdf-real-estate') ?></label>
        <div class="mkdf-inputs-holder clearfix">
            <span class="mkdf-input-min-size">
                <input type="text" class="mkdf-min-size" name="mkdf-min-size" placeholder="<?php esc_html_e('Min', 'mkdf-real-estate') ?>" value="<?php echo esc_attr($property_min_size); ?>" />
                <span class="mkdf-sufix mkdf-min-sufix"><?php esc_html_e($size_label); ?></span>
            </span>
            <span class="mkdf-input-max-size">
                <input type="text" class="mkdf-max-size" name="mkdf-max-size" placeholder="<?php esc_html_e('Max', 'mkdf-real-estate') ?>" value="<?php echo esc_attr($property_max_size); ?>" />
                <span class="mkdf-sufix mkdf-max-sufix"><?php esc_html_e($size_label); ?></span>
            </span>
        </div>
    </div>
</div>