<?php
$author_description = get_user_meta($author->ID, 'description', true);
?>
<div class="mkdf-re-author-description-holder">
    <p class="mkdf-re-author-description">
        <?php echo esc_html($author_description); ?>
    </p>
</div>