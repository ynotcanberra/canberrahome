<?php
$statuses = mkdf_re_get_property_taxonomy('property-status', $id);
if(is_array($statuses) && !empty($statuses)) { ?>
    <span class="mkdf-ci-statuses">
    <?php foreach($statuses as $status) { ?>
        <span class="mkdf-ci-status">
            <?php echo esc_html($status->name); ?>
        </span>
    <?php  } ?>
    </span>
<?php }