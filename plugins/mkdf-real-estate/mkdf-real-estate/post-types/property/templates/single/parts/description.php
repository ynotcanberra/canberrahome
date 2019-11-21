<?php
    $attachment = get_post_meta(get_the_ID(), 'mkdf_property_attachment_meta', true);
?>
<div class="mkdf-property-description mkdf-property-label-items-holder">
    <div class="mkdf-property-description-label mkdf-property-label-style">
        <h5>
            <?php esc_html_e('Description', 'mkdf-real-estate'); ?>
        </h5>
    </div>
    <div class="mkdf-property-description-items mkdf-property-items-style clearfix">
        <?php the_content(); ?>
        <?php if(!empty($attachment)) { ?>
            <div class="mkdf-property-attachment">
                <a href="<?php echo esc_url($attachment); ?>" download target="_blank">
                    <span class="mkdf-attachment-label"><?php esc_html_e('Download Prospect', 'mkdf-real-estate'); ?></span>
                    <span class="mkdf-attachment-icon"><span class="arrow_carrot-down" aria-hidden="true"></span></span>
                </a>
            </div>
        <?php } ?>

    </div>
</div>