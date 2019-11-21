<?php
    $user_packages = mkdf_re_get_user_packages_list();
    $package_url = mkdf_re_get_pricing_packages_page();
?>
<div class="mkdf-re-profile-packages-holder">
    <table>
        <thead>
            <tr>
                <td><?php esc_html_e('Package Name', 'mkdf-real-estate') ?></td>
                <td><?php esc_html_e('Expiration Date', 'mkdf-real-estate') ?></td>
                <td><?php esc_html_e('Items Included', 'mkdf-real-estate') ?></td>
                <td><?php esc_html_e('Items Remaining', 'mkdf-real-estate') ?></td>
                <td><?php esc_html_e('Featured Included', 'mkdf-real-estate') ?></td>
                <td><?php esc_html_e('Featured Remaining', 'mkdf-real-estate') ?></td>
                <td><?php esc_html_e('Status', 'mkdf-real-estate') ?></td>
            </tr>
        </thead>
        <tbody>
            <?php if ( ! empty( $user_packages ) ) { ?>
                <?php foreach($user_packages as $key => $package) { ?>
                    <?php $package_info = mkdf_re_get_package_info($key);?>
                    <tr>
                        <td>
                            <?php echo esc_html($package_info['package_name']); ?>
                        </td>
                        <td>
                            <?php echo esc_html(gmdate( 'd/m/Y', $package_info['expiration_date'])); ?>
                        </td>
                        <td>
                            <?php echo esc_html($package_info['items_included']); ?>
                        </td>
                        <td>
                            <?php echo esc_html($package_info['items_remaining']); ?>
                        </td>
                        <td>
                            <?php echo esc_html($package_info['featured_items_included']); ?>
                        </td>
                        <td>
                            <?php echo esc_html($package_info['featured_items_remaining']); ?>
                        </td>
                        <td>
                            <?php echo mkdf_re_get_package_status($key); ?>
                        </td>
                    </tr>
                <?php } ?>
            <?php } ?>
        </tbody>
    </table>
    <?php
        if ( mkdf_membership_theme_installed() ) {
            echo zuhaus_mikado_get_button_html( array(
                'text'      => esc_html__( 'Buy Package', 'mkdf-real-estate' ),
                'custom_class' => 'mkdf-membership-buy-package',
                'link' => $package_url
            ) );
        } else {
            echo '<a itemprop="url" href="' . $package_url . '" target="_self" class="mkdf-btn mkdf-btn-medium mkdf-btn-solid mkdf-membership-buy-package"><span class="mkdf-btn-text">' . esc_html__( "Buy Package", "mkdf-real-estate" ) . '</span></a>';
        }
    ?>
</div>
