<?php
$author_name = get_user_meta($author->ID, 'first_name', true) . ' ' . get_user_meta($author->ID, 'last_name', true);
?>
<div class="mkdf-re-author-title-holder">
    <h3 class="mkdf-re-author-title">
        <?php echo esc_html($author_name); ?>
    </h3>
    <h5 class="mkdf-re-author-description mkdf-author-role">
        <?php echo esc_html($role); ?>
    </h5>
</div>