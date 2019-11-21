<?php
$user_address = get_user_meta($author->ID, 'mkdf_' . $role . '_address', true);
$user_phone = get_user_meta($author->ID, 'mkdf_' . $role . '_mobile_phone', true);
$user_email = get_the_author_meta('email', $author->ID);
$user_website = get_the_author_meta('url', $author->ID);
?>
<div class="mkdf-re-author-contact">
    <?php if( !empty($user_address) ) { ?>
        <div class="mkdf-re-contact-item">
            <span class="mkdf-contact-icon icon-location-pin"></span>
            <span class="mkdf-contact-label">
                <?php echo esc_html($user_address) ?>
            </span>
        </div>
    <?php } ?>
    <?php if( !empty($user_phone) ) { ?>
        <div class="mkdf-re-contact-item">
            <span class="mkdf-contact-icon icon-call-end"></span>
            <span class="mkdf-contact-label">
                <a href="tel:<?php echo esc_attr($user_phone) ?>" target="_self">
                    <?php echo esc_html($user_phone) ?>
                </a>
            </span>
        </div>
    <?php } ?>
    <?php if( !empty($user_email) ) { ?>
        <div class="mkdf-re-contact-item">
            <span class="mkdf-contact-icon icon-envelope"></span>
            <span class="mkdf-contact-label">
                <a href="mailto:<?php echo esc_attr($user_email) ?>" target="_self">
                    <?php echo esc_html($user_email) ?>
                </a>
            </span>
        </div>
    <?php } ?>
    <?php if( !empty($user_website) ) { ?>
        <div class="mkdf-re-contact-item">
            <span class="mkdf-contact-icon icon-link"></span>
            <span class="mkdf-contact-label">
                <a href="<?php echo esc_attr($user_website) ?>" target="_blank">
                    <?php echo esc_html($user_website) ?>
                </a>
            </span>
        </div>
    <?php } ?>
</div>