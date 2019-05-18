<div class="mkdf-package-title">
    <h5><?php the_title(); ?></h5>
    <?php if($params['featured'] === 'yes') {?>
        <div class="mkdf-package-badge"><?php esc_html_e('Featured', 'mkdf-real-estate') ?></div>
    <?php } ?>
</div>
<div class="mkdf-package-price">
    <span class="mkdf-price-currency">
        <?php echo esc_html($package_values['currency']) ?>
    </span>
    <span class="mkdf-price-value">
        <?php echo esc_html($package_values['price']) ?>
    </span>
</div>
<div class="mkdf-package-content">
    <div class="mkdf-package-listings">
        <i class="mkdf-package-icon icon-check" aria-hidden="true"></i>
        <span class="mkdf-listings-label">
            <?php esc_html_e('Listings Included:', 'mkdf-real-estate') ?>
        </span>
        <span class="mkdf-listings-value">
            <?php echo esc_html($package_values['listings_inluded']) ?>
        </span>
    </div>
    <div class="mkdf-package-featured">
        <i class="mkdf-package-icon icon-check" aria-hidden="true"></i>
        <span class="mkdf-featured-label">
            <?php esc_html_e('Featured Included:', 'mkdf-real-estate') ?>
        </span>
        <span class="mkdf-featured-value">
            <?php echo esc_html($package_values['featured_inluded']) ?>
        </span>
    </div>
    <div class="mkdf-package-duration">
        <i class="mkdf-package-icon icon-check" aria-hidden="true"></i>
        <span class="mkdf-duration-label">
            <?php esc_html_e('Duration (months):', 'mkdf-real-estate') ?>
        </span>
        <span class="mkdf-duration-value">
           <?php //echo esc_html($package_values['duration']) ?>
          <?php echo esc_html('6') ?>
        </span>
    </div>
</div>
<div class="mkdf-package-action">
    <?php mkdf_re_get_package_buy_form(); ?>
</div>