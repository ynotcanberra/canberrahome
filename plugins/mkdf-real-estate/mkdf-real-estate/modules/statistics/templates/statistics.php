<div class="mkdf-re-admin-statistics">
    <h1 class="wp-heading-inline"><?php esc_html_e('Mikado Statistics', 'mkdf-real-estate') ?></h1>
    <table class="mkdf-re-statistics wp-list-table widefat fixed striped posts">
        <tbody>
        <?php if(!empty($links)) { ?>
            <?php foreach($links as $link) { ?>
                <tr class="iedit author-self level-0 mkdf-statistics hentry">
                    <td>
                        <a href="<?php echo esc_url($link['url']) ?>" target="_self">
                            <?php echo esc_html($link['name']) ?>
                        </a>
                    </td>
                </tr>
            <?php } ?>
        <?php } ?>
        </tbody>
    </table>
</div>