<ul id="mkdf-re-popup-items">
    <li>
        <div class="mkdf-re-empty-div">

        </div>
        <?php foreach($added_properties as $property) { ?>
            <?php
                $property_params = array();
                $property_params['id'] = $property;
                //$property_params['enable_remove_icon'] = true;
            ?>
            <div class="mkdf-re-item-holder">
	            <div class="mkdf-item-top-section">
		            <?php echo mkdf_re_cpt_single_module_template_part( 'compare/templates/parts/remove', 'property', '', $property_params ); ?>
		            <?php echo mkdf_re_cpt_single_module_template_part( 'compare/templates/parts/image', 'property', '', $property_params ); ?>
		            <div class="mkdf-item-top-section-content">
			            <div class="mkdf-item-top-section-content-inner">
				            <div class="mkdf-item-info-top">
					            <?php echo mkdf_re_cpt_single_module_template_part( 'compare/templates/parts/taxonomy-status', 'property', '', $property_params ); ?>
				            </div>
			            </div>
		            </div>
	            </div>
	            <div class="mkdf-item-bottom-section">
		            <div class="mkdf-item-bottom-section-content">
			            <?php echo mkdf_re_cpt_single_module_template_part( 'compare/templates/parts/title', 'property', '', $property_params ); ?>
			            <?php echo mkdf_re_cpt_single_module_template_part( 'compare/templates/parts/price', 'property', '', $property_params ); ?>
		            </div>
	            </div>
            </div>
        <?php } ?>
    </li>
    <?php echo mkdf_re_cpt_single_module_template_part( 'compare/templates/compare-items/size', 'property', '', $params ); ?>
    <?php echo mkdf_re_cpt_single_module_template_part( 'compare/templates/compare-items/bedrooms', 'property', '', $params ); ?>
    <?php echo mkdf_re_cpt_single_module_template_part( 'compare/templates/compare-items/bathrooms', 'property', '', $params ); ?>
    <?php echo mkdf_re_cpt_single_module_template_part( 'compare/templates/compare-items/floor', 'property', '', $params ); ?>
    <?php echo mkdf_re_cpt_single_module_template_part( 'compare/templates/compare-items/year-built', 'property', '', $params ); ?>
    <?php echo mkdf_re_cpt_single_module_template_part( 'compare/templates/compare-items/features', 'property', '', $params ); ?>
</ul>
