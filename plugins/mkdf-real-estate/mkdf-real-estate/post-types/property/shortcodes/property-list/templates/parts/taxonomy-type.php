<?php
$types = mkdf_re_get_property_taxonomy('property-type');
if(is_array($types) && !empty($types)) { ?>
    <span class="mkdf-property-types">
    <?php foreach($types as $type) { ?>
        <span class="mkdf-property-type">
            <?php echo esc_html($type->name); ?>
        </span>
    <?php  } ?>
    </span>
<?php }