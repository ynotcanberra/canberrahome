<div class="mkdf-re-admin-most-viewed">
    <h1 class="wp-heading-inline"><?php esc_html_e('Users most viewed', 'mkdf-real-estate') ?></h1>
    <table class="mkdf-re-most-viewed wp-list-table widefat fixed striped posts">
        <thead>
        <tr>
            <td>
                <?php esc_html_e('Property ID', 'mkdf-real-estate') ?>
            </td>
            <td>
                <?php esc_html_e('Title', 'mkdf-real-estate') ?>
            </td>
            <td>
                <?php esc_html_e('Image', 'mkdf-real-estate') ?>
            </td>
            <td>
                <?php esc_html_e('City', 'mkdf-real-estate') ?>
            </td>
            <td>
                <?php esc_html_e('Status', 'mkdf-real-estate') ?>
            </td>
            <td>
                <?php esc_html_e('Type', 'mkdf-real-estate') ?>
            </td>
            <td>
                <?php esc_html_e('Price', 'mkdf-real-estate') ?>
            </td>
            <td>
                <?php esc_html_e('Views', 'mkdf-real-estate') ?>
            </td>
            <td>
                <?php esc_html_e('Actions', 'mkdf-real-estate') ?>
            </td>
        </tr>
        </thead>
        <tbody>
        <?php if(!empty($posts)) { ?>
        <?php foreach($posts as $post) { ?>
            <tr class="iedit author-self level-0 most-viewed hentry">
                <td>
                    <?php echo esc_html($post['propertyID']) ?>
                </td>
                <td>
                    <?php echo esc_html($post['title']) ?>
                </td>
                <td>
                    <?php print $post['image']; ?>
                </td>
                <td>
                    <?php echo esc_html($post['city']) ?>
                </td>
                <td>
                    <?php echo esc_html($post['status']) ?>
                </td>
                <td>
                    <?php echo esc_html($post['type']) ?>
                </td>
                <td>
                    <?php echo esc_html($post['price']) ?>
                </td>
                <td>
                    <?php echo esc_html($post['views']) ?>
                </td>
                <td>
                    <a href="<?php echo esc_url($post['view_link']) ?>" target="_blank" title="<?php esc_attr_e('View', 'mkdf-real-estate'); ?>">
                        <i class="dashicons-before dashicons-admin-links"></i>
                    </a>
                    <a href="<?php echo esc_url($post['edit_link']) ?>" target="_blank" title="<?php esc_attr_e('Edit', 'mkdf-real-estate'); ?>">
                        <i class="dashicons-before dashicons-edit"></i>
                    </a>
                </td>
            </tr>
        <?php } ?>
        <?php } ?>
        </tbody>
    </table>
</div>