<?php
$social_networks = zuhaus_mikado_get_user_custom_fields($author->ID);

if(is_array($social_networks) && !empty($social_networks)) {
?>
<div class="mkdf-re-author-footer mkdf-author-social">
    <p class="mkdf-re-social-label">
        <?php esc_html_e("Follow me on", "mkdf-real-estate") ?>
    </p>
    <?php if (is_array($social_networks) && count($social_networks)) { ?>
        <div class="mkdf-contact-social-icons clearfix">
            <?php foreach ($social_networks as $network) { ?>
                <a itemprop="url" href="<?php echo esc_attr($network['link']) ?>" target="_blank">
                    <?php echo zuhaus_mikado_icon_collections()->renderIcon($network['class'], 'font_elegant'); ?>
                </a>
            <?php } ?>
        </div>
    <?php } ?>
</div>
<?php }