<?php
$share_type = isset($share_type) ? $share_type : 'list';
?>
<?php if(zuhaus_mikado_options()->getOptionValue('enable_social_share') === 'yes' && zuhaus_mikado_options()->getOptionValue('enable_social_share_on_post') === 'yes') { ?>
    <div class="mkdf-blog-share">
        <?php echo zuhaus_mikado_get_social_share_html(array('type' => $share_type)); ?>
    </div>
<?php } ?>