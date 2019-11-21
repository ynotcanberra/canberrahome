<?php
$date_published = get_post_meta(get_the_ID(), 'mkdf_property_publication_date_meta', true);
$number_of_views = get_post_meta(get_the_ID(), 'mkdf_count_property_views_meta', true);
$property_id = get_post_meta(get_the_ID(), 'mkdf_property_id_meta', true);
?>
<div class="mkdf-property-title-section">
    <div class="mkdf-property-title-outer">
        <div class="mkdf-property-title-inner">
            <div class="mkdf-title-top">
                <div class="mkdf-property-title-left">
                    <h2>
                        <?php echo get_the_title(); ?>
                    </h2>
                </div>
                <div class="mkdf-property-title-right">
                    <?php echo mkdf_re_get_cpt_single_module_template_part( 'templates/single/parts/taxonomy', 'property', 'status', $params ); ?>
                </div>
            </div>
            <div class="mkdf-title-bottom">
                <div class="mkdf-property-title-left clearfix">
                    <div class="mkdf-title-inline-part">
                        <?php echo esc_html($date_published); ?>
                    </div>
                    <div class="mkdf-title-inline-part">
                        <?php echo mkdf_re_get_cpt_single_module_template_part( 'templates/single/parts/rating', 'property', 'simple', $params ); ?>
                    </div>
                    <div class="mkdf-title-inline-part">
                        <?php echo mkdf_re_get_wishlist_button(); ?>
                    </div>
                    <?php if(!empty($number_of_views)) { ?>
                    <div class="mkdf-title-inline-part">
                        <i class="lnr lnr-eye" aria-hidden="true"></i>
                        <span class="mkdf-views-value"><?php echo esc_html($number_of_views); ?></span>
                    </div>
                    <?php } ?>
                    <div class="mkdf-title-inline-part">
                        <?php echo mkdf_re_get_cpt_single_module_template_part( 'templates/single/parts/social', 'property', '', $params ); ?>
                    </div>
	                <?php
	                $enable_compare = zuhaus_mikado_options()->getOptionValue('enable_property_comparing');
	                if ($enable_compare == 'yes') {
		                $enable_compare_single = zuhaus_mikado_options()->getOptionValue('enable_property_comparing_single');
		                if($enable_compare_single == 'yes') { ?>
	                        <div class="mkdf-title-inline-part">
				                <div class="mkdf-item-compare">
					                <?php echo mkdf_re_get_add_to_compare_list_button(); ?>
				                </div>
			                </div>
		                <?php   }
	                }
	                ?>
                </div>
                <div class="mkdf-property-title-right">
                    <div class="mkdf-title-id">
                        <span class="mkdf-property-id-label">
                            <?php esc_html_e('Property ID:', 'mkdf-real-estate'); ?>
                        </span>
                        <span class="mkdf-property-id-value">
                            <?php echo esc_html($property_id); ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
