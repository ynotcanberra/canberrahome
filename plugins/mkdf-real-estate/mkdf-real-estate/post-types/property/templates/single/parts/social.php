<?php
$share_type = isset($share_type) ? $share_type : 'dropdown';
?>

<?php if(zuhaus_mikado_options()->getOptionValue('enable_social_share') == 'yes' && zuhaus_mikado_options()->getOptionValue('enable_social_share_on_property') == 'yes') : ?>
    <div class="mkdf-property-social-share">
        <?php echo zuhaus_mikado_get_social_share_html(array('type' => $share_type)) ?>
    </div>
<?php endif; ?>