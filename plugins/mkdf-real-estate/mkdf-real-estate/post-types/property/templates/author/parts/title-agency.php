<?php
$agency_name = get_user_meta($author->ID, 'mkdf_agency_name', true);
$agency_licence = get_user_meta($author->ID, 'mkdf_agency_licence', true);
?>
<div class="mkdf-re-author-title-holder">
    <h3 class="mkdf-re-author-title">
        <?php echo esc_html($agency_name); ?>
    </h3>
    <h5 class="mkdf-re-author-description">
        <?php echo esc_html($agency_licence); ?>
    </h5>
</div>