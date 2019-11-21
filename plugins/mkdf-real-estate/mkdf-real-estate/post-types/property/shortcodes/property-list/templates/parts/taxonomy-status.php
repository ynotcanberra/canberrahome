<?php
$statuses = mkdf_re_get_property_taxonomy('property-status');
if(is_array($statuses) && !empty($statuses)) { ?>
    <span class="mkdf-property-statuses">
    <?php foreach($statuses as $status) { ?>
        <span class="mkdf-property-status">
            <?php echo esc_html($status->name); ?>
        </span>
    <?php  } ?>
    </span>
<?php }