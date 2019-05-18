<div class="mkdf-re-admin-users-packages">
    <h1 class="wp-heading-inline"><?php esc_html_e('Users packages', 'mkdf-real-estate') ?></h1>
    <table class="mkdf-re-users-packages wp-list-table widefat fixed striped posts">
        <thead>
            <tr>
                <td>
                    <?php esc_html_e('Order ID', 'mkdf-real-estate') ?>
                </td>
                <td>
                    <?php esc_html_e('Package name', 'mkdf-real-estate') ?>
                </td>
                <td>
                    <?php esc_html_e('Date acquired', 'mkdf-real-estate') ?>
                </td>
                <td>
                    <?php esc_html_e('Price', 'mkdf-real-estate') ?>
                </td>
                <td>
                    <?php esc_html_e('Buyer name', 'mkdf-real-estate') ?>
                </td>
                <td>
                    <?php esc_html_e('Buyer email', 'mkdf-real-estate') ?>
                </td>
                <td>
                    <?php esc_html_e('Payment method', 'mkdf-real-estate') ?>
                </td>
                <td>
                    <?php esc_html_e('Payment status', 'mkdf-real-estate') ?>
                </td>
                <td>
                    <?php esc_html_e('Actions', 'mkdf-real-estate') ?>
                </td>
            </tr>
        </thead>
        <tbody>
            <?php foreach($users_orders as $order) { ?>
                <tr class="iedit author-self level-0 type-package hentry">
                    <td>
                        <?php echo esc_html($order['order_id']) ?>
                    </td>
                    <td>
                        <?php echo esc_html($order['order_package_name']) ?>
                    </td>
                    <td>
                        <?php echo esc_html($order['order_date']) ?>
                    </td>
                    <td>
                        <?php echo esc_html($order['order_price']) ?>
                    </td>
                    <td>
                        <?php echo esc_html($order['order_buyer_name']) ?>
                    </td>
                    <td>
                        <?php echo esc_html($order['order_buyer_email']) ?>
                    </td>
                    <td>
                        <?php echo esc_html($order['order_payment_method']) ?>
                    </td>
                    <td>
                        <?php echo esc_html($order['order_status']) ?>
                    </td>
                    <td>
                        <a href="<?php echo esc_url($order['order_link']) ?>" target="_self">
                            <i class="dashicons-before dashicons-edit"></i>
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>