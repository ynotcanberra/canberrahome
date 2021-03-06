<div class="mkdf-re-admin-saved-searches">
    <h1 class="wp-heading-inline"><?php esc_html_e('Users saved searches', 'mkdf-real-estate') ?></h1>
    <table class="mkdf-re-saved-searches wp-list-table widefat fixed striped posts">
        <thead>
        <tr>
            <td><?php esc_html_e('Status', 'mkdf-real-estate') ?></td>
            <td><?php esc_html_e('Type', 'mkdf-real-estate') ?></td>
            <td><?php esc_html_e('City', 'mkdf-real-estate') ?></td>
            <td><?php esc_html_e('Price', 'mkdf-real-estate') ?></td>
            <td><?php esc_html_e('Size', 'mkdf-real-estate') ?></td>
            <td><?php esc_html_e('Bedrooms', 'mkdf-real-estate') ?></td>
            <td><?php esc_html_e('Bathrooms', 'mkdf-real-estate') ?></td>
            <td><?php esc_html_e('Features', 'mkdf-real-estate') ?></td>
            <td><?php esc_html_e('Actions', 'mkdf-real-estate') ?></td>
        </tr>
        </thead>
        <tbody>
        <?php if(!empty($searches)) { ?>
            <?php foreach($searches as $search) { ?>
                <tr>
                    <td>
                        <?php
                        if(!empty($search['status'])) {
                            echo esc_html(mkdf_re_get_taxonomy_name_from_id($search['status']));
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if(!empty($search['type'])) {
                            echo esc_html(mkdf_re_get_taxonomy_name_from_id($search['type']));
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if(!empty($search['city'])) {
                            echo esc_html(mkdf_re_get_taxonomy_name_from_id($search['city']));
                        }
                        ?>
                    </td>
                    <td>
                        <?php echo esc_html($search['minPrice']) . ' - ' .esc_html($search['maxPrice']); ?>
                    </td>
                    <td>
                        <?php echo esc_html($search['minSize']) . ' - ' .esc_html($search['maxSize']); ?>
                    </td>
                    <td>
                        <?php echo esc_html($search['bedrooms']); ?>
                    </td>
                    <td>
                        <?php echo esc_html($search['bathrooms']); ?>
                    </td>
                    <td>
                        <?php
                        if(!empty($search['features'])) {
                            $features = explode(',', $search['features']);
                            $feature_names = array();
                            foreach ($features as $feature) {
                                $feature_names[] = mkdf_re_get_taxonomy_name_from_id($feature);
                            }
                            $feature_names = implode(', ', $feature_names);
                            echo esc_html($feature_names);
                        }
                        ?>
                    </td>
                    <td>
                        <form role="search" method="get" target="_blank" class="searchform mkdf-property-search" action="<?php echo esc_url( home_url( "/" ) ) ?>">
                            <input type="hidden" name="s" value="" />
                            <input type="hidden" name="mkdf-property-search" value="yes" />
                            <input type="hidden" name="mkdf-search-city" id="mkdf-search-city" value="<?php echo esc_attr($search['city']); ?>"/>
                            <input type="hidden" name="mkdf-search-status" id="mkdf-search-status" value="<?php echo esc_attr($search['status']); ?>"/>
                            <input type="hidden" name="mkdf-search-type" id="mkdf-search-type" value="<?php echo esc_attr($search['type']); ?>"/>
                            <input type="hidden" name="mkdf-search-minPrice" id="mkdf-search-minPrice" value="<?php echo esc_attr($search['minPrice']); ?>"/>
                            <input type="hidden" name="mkdf-search-maxPrice" id="mkdf-search-maxPrice" value="<?php echo esc_attr($search['maxPrice']); ?>"/>
                            <input type="hidden" name="mkdf-search-minSize" id="mkdf-search-minSize" value="<?php echo esc_attr($search['minSize']); ?>"/>
                            <input type="hidden" name="mkdf-search-maxSize" id="mkdf-search-maxSize" value="<?php echo esc_attr($search['maxSize']); ?>"/>
                            <input type="hidden" name="mkdf-search-bedrooms" id="mkdf-search-bedrooms" value="<?php echo esc_attr($search['bedrooms']); ?>"/>
                            <input type="hidden" name="mkdf-search-bathrooms" id="mkdf-search-bathrooms" value="<?php echo esc_attr($search['bathrooms']); ?>"/>
                            <input type="hidden" name="mkdf-search-features" id="mkdf-search-features" value="<?php echo esc_attr($search['features']); ?>"/>
                            <button class="mkdf-query-search-page" title="<?php esc_attr_e('View', 'mkdf-real-estate'); ?>">
                                <i class="dashicons-before dashicons-admin-links"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        <?php } ?>
        </tbody>
    </table>
</div>