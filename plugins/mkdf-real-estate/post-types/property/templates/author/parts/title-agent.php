<?php
$agent_name = get_user_meta($author->ID, 'first_name', true) . ' ' . get_user_meta($author->ID, 'last_name', true);
$agent_position = get_user_meta($author->ID, 'mkdf_agent_position', true);
?>
<div class="mkdf-re-author-title-holder">
    <h3 class="mkdf-re-author-title">
        <?php echo esc_html($agent_name); ?>
    </h3>
    <h5 class="mkdf-re-author-description">
        <?php echo esc_html($agent_position); ?>
    </h5>
</div>