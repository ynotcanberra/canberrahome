<div class="mkdf-re-admin-most-favorite">
    <h1 class="wp-heading-inline"><?php esc_html_e('Users most favorite', 'mkdf-real-estate') ?></h1>
    <table class="mkdf-re-most-favorite wp-list-table widefat fixed striped posts">
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
                <?php esc_html_e('Favorites', 'mkdf-real-estate') ?>
            </td>
            <td>
                <?php esc_html_e('Actions', 'mkdf-real-estate') ?>
            </td>
        </tr>
        </thead>
        <tbody>
        <?php if(!empty($posts)) { ?>
        <?php foreach($posts as $post) { ?>
            <tr class="iedit author-self level-0 most-favorite hentry">
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
                    <?php echo esc_html($post['favorites']) ?>
                </td>
                <td>
                    <a href="<?php echo esc_url($post['view_link']) ?>" target="_blank">
                        <i class="dashicons-before dashicons-admin-links"></i>
                    </a>
                    <a href="<?php echo esc_url($post['edit_link']) ?>" target="_blank">
                        <i class="dashicons-before dashicons-edit"></i>
                    </a>
                </td>
            </tr>
        <?php } ?>
        <?php } ?>
        </tbody>
    </table>
</div>