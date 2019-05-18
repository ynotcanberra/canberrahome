<?php
//fallback if someone enters page directly and has no packages

$package = mkdf_re_property_addition_enabled();

//stongly false because of the 0 key for packages
if ($package === false) { ?>
	<div class="mkdf-no-package">
		<h3><?php esc_html_e('Please buy package in order to add more properties.','mkdf-real-estate'); ?></h3>
		<?php if ( mkdf_membership_theme_installed() ) {
			echo zuhaus_mikado_get_button_html( array(
				'text'      => esc_html__( 'BUY PACKAGES', 'mkdf-real-estate' ),
				'link'      => mkdf_re_get_pricing_packages_page()
			) );
		} else {
			echo '<a itemprop="url" href="' . esc_url(mkdf_re_get_pricing_packages_page()) .'" target="_self" class="mkdf-btn mkdf-btn-medium mkdf-btn-solid"><span class="mkdf-btn-text">' . esc_html__( 'BUY PACKAGES', 'mkdf-real-estate' ) . '</span></a>';
		}
		?>
	</div>
<?php } else { ?>
<div class="mkdf-add-property-page">
	<div>
		<form method="post" id="mkdf-re-add-property-form">
			<div class="mkdf-membership-input-holder">
				<label for="property_title"><?php esc_html_e( 'Property Title', 'mkdf-real-estate' ); ?></label>
				<input class="mkdf-membership-input" type="text" name="property_title" id="property_title"
				       value="">
			</div>
			<div class="mkdf-membership-input-holder">
				<label for="property_id"><?php esc_html_e( 'Property ID', 'mkdf-real-estate' ); ?></label>
				<input class="mkdf-membership-input" type="text" name="property_id" id="property_id"
				       value="">
			</div>
			<h5><?php esc_html_e('Featured Image','mkdf-real-estate');?></h5>
			<div class="mkdf-membership-gallery-holder">
				<label for="property_featured_image" style="color:red;"><?php esc_html_e( 'Image should be 800 X 600 pixels', 'mkdf-real-estate' ); ?></label>
				<ul class="mkdf-membership-gallery-images-holder"></ul>
				<div class="mkdf-membership-gallery-uploader">
					<?php 
					if ( mkdf_membership_theme_installed() ) {
						echo zuhaus_mikado_get_button_html( array(
							'text'      => esc_html__( 'Upload', 'mkdf-real-estate' ),
							'custom_class' => 'mkdf-membership-gallery-upload'
						) );
					} else {
						echo '<a itemprop="url" href="#" target="_self" class="mkdf-btn mkdf-btn-medium mkdf-btn-solid mkdf-membership-gallery-upload"><span class="mkdf-btn-text">' . esc_html__( 'Upload', 'mkdf-real-estate' ) . '</span></a>';
					} ?>
					<input class="mkdf-membership-gallery-upload-hidden" type="file" name="property_featured_image" id="property_featured_image"
					       value="">
				</div>
			</div>
			<div class="mkdf-membership-input-holder">
				<label class="mkdf-membership-input-label" for="property_type"><?php esc_html_e( 'Property Type', 'mkdf-real-estate' ); ?></label>
				<?php $property_terms = mkdf_re_get_property_terms_list('property-type');
				if (is_array($property_terms) && count($property_terms)) { ?>
					<div class="mkdf-grid-row">
					<?php foreach ($property_terms as $property_term) { ?>
						<div class="mkdf-grid-col-3">
							<div class="mkdf-checkbox-style">
								<input type="checkbox" name="property_type[]" value="<?php echo esc_attr($property_term['id'])?>">
								<label class="mkdf-checkbox-label" for="mkdf-feature-<?php echo esc_attr($property_term['id'])?>">
									<span class="mkdf-label-view"></span>
									<span class="mkdf-label-text">
										<?php echo esc_html($property_term['name'])?>
									</span>
								</label>
							</div>
						</div>
					<?php } ?>
					</div>
				<?php } ?>
			</div>
			<div class="mkdf-membership-input-holder">
				<label class="mkdf-membership-input-label" for="property_feature"><?php esc_html_e( 'Property Feature', 'mkdf-real-estate' ); ?></label>
				<?php $property_terms = mkdf_re_get_property_terms_list('property-feature');
				if (is_array($property_terms) && count($property_terms)) { ?>
					<div class="mkdf-grid-row">
					<?php foreach ($property_terms as $property_term) { ?>
						<div class="mkdf-grid-col-3">
							<div class="mkdf-checkbox-style">
								<input type="checkbox" name="property_feature[]" value="<?php echo esc_attr($property_term['id'])?>">
								<label class="mkdf-checkbox-label" for="mkdf-feature-<?php echo esc_attr($property_term['id'])?>">
									<span class="mkdf-label-view"></span>
									<span class="mkdf-label-text">
										<?php echo esc_html($property_term['name'])?>
									</span>
								</label>
							</div>
						</div>
					<?php } ?>
					</div>
				<?php } ?>
			</div>
			<div class="mkdf-membership-input-holder">
				<label class="mkdf-membership-input-label" for="property_status"><?php esc_html_e( 'Property Status', 'mkdf-real-estate' ); ?></label>
				<?php $property_terms = mkdf_re_get_property_terms_list('property-status');
				if (is_array($property_terms) && count($property_terms)) { ?>
					<div class="mkdf-grid-row">
					<?php foreach ($property_terms as $property_term) { ?>
						<div class="mkdf-grid-col-3">
							<div class="mkdf-checkbox-style">
								<input type="checkbox" name="property_status[]" value="<?php echo esc_attr($property_term['id'])?>">
								<label class="mkdf-checkbox-label" for="mkdf-feature-<?php echo esc_attr($property_term['id'])?>">
									<span class="mkdf-label-view"></span>
									<span class="mkdf-label-text">
										<?php echo esc_html($property_term['name'])?>
									</span>
								</label>
							</div>
						</div>
					<?php } ?>
					</div>
				<?php } ?>
			</div>
			<div class="mkdf-membership-input-holder displaynone">
				<label class="mkdf-membership-input-label" for="property_county"><?php esc_html_e( 'Property County/State', 'mkdf-real-estate' ); ?></label>
				<?php $property_terms = mkdf_re_get_property_terms_list('property-county');
				if (is_array($property_terms) && count($property_terms)) { ?>
					<div class="mkdf-grid-row">
					<?php foreach ($property_terms as $property_term) { ?>
						<div class="mkdf-grid-col-3">
							<div class="mkdf-checkbox-style">
								<input type="checkbox" name="property_county[]" value="<?php echo esc_attr($property_term['id'])?>">
								<label class="mkdf-checkbox-label" for="mkdf-feature-<?php echo esc_attr($property_term['id'])?>">
									<span class="mkdf-label-view"></span>
									<span class="mkdf-label-text">
										<?php echo esc_html($property_term['name'])?>
									</span>
								</label>
							</div>
						</div>
					<?php } ?>
					</div>
				<?php } ?>
			</div>
			<div class="mkdf-membership-input-holder">
				<label class="mkdf-membership-input-label" for="property_city"><?php esc_html_e( 'Area', 'mkdf-real-estate' ); ?></label>
				<?php $property_terms = mkdf_re_get_property_terms_list('property-city');
				if (is_array($property_terms) && count($property_terms)) { ?>
					<div class="mkdf-grid-row">
					<?php foreach ($property_terms as $property_term) { ?>
						<div class="mkdf-grid-col-3">
							<div class="mkdf-checkbox-style">
								<input type="checkbox" name="property_city[]" value="<?php echo esc_attr($property_term['id'])?>">
								<label class="mkdf-checkbox-label" for="mkdf-feature-<?php echo esc_attr($property_term['id'])?>">
									<span class="mkdf-label-view"></span>
									<span class="mkdf-label-text">
										<?php echo esc_html($property_term['name'])?>
									</span>
								</label>
							</div>
						</div>
					<?php } ?>
					</div>
				<?php } ?>
			</div>
			<div class="mkdf-membership-input-holder">
				<label class="mkdf-membership-input-label" for="property_neighborhood"><?php esc_html_e( 'Property Neighborhood', 'mkdf-real-estate' ); ?></label>
				<?php $property_terms = mkdf_re_get_property_terms_list('property-neighborhood');
				if (is_array($property_terms) && count($property_terms)) { ?>
					<div class="mkdf-grid-row">
					<?php foreach ($property_terms as $property_term) { ?>
						<div class="mkdf-grid-col-3">
							<div class="mkdf-checkbox-style">
								<input type="checkbox" name="property_neighborhood[]" value="<?php echo esc_attr($property_term['id'])?>">
								<label class="mkdf-checkbox-label" for="mkdf-feature-<?php echo esc_attr($property_term['id'])?>">
									<span class="mkdf-label-view"></span>
									<span class="mkdf-label-text">
										<?php echo esc_html($property_term['name'])?>
									</span>
								</label>
							</div>
						</div>
					<?php } ?>
					</div>
				<?php } ?>
			</div>
			<div class="mkdf-membership-input-holder">
				<label class="mkdf-membership-input-label" for="property_tag"><?php esc_html_e( 'Property Tags', 'mkdf-real-estate' ); ?></label>
				<?php $property_terms = mkdf_re_get_property_terms_list('property-tag');
				//slug is used here sa value instead of ids because it is a non-hierahical taxonomy
				if (is_array($property_terms) && count($property_terms)) { ?>
					<div class="mkdf-grid-row">
					<?php foreach ($property_terms as $property_term) { ?>
						<div class="mkdf-grid-col-3">
							<div class="mkdf-checkbox-style">
								<input type="checkbox" name="property_tag[]" value="<?php echo esc_attr($property_term['slug'])?>">
								<label class="mkdf-checkbox-label" for="mkdf-feature-<?php echo esc_attr($property_term['slug'])?>">
									<span class="mkdf-label-view"></span>
									<span class="mkdf-label-text">
										<?php echo esc_html($property_term['name'])?>
									</span>
								</label>
							</div>
						</div>
					<?php } ?>
					</div>
				<?php } ?>
			</div>
			<div class="mkdf-membership-input-holder">
				<label class="mkdf-membership-input-label" for="property_description"><?php esc_html_e( 'Description', 'mkdf-real-estate' ); ?></label>
				<textarea class="mkdf-membership-input" name="property_description" id="property_description" rows="5"></textarea>
			</div>
			<h5><?php esc_html_e('Specifications','mkdf-real-estate');?></h5>
			<div class="mkdf-membership-input-holder">
				<label for="price"><?php esc_html_e( 'Price', 'mkdf-real-estate' ); ?></label>
				<input class="mkdf-membership-input" type="text" name="price" id="price"
				       value="">
			</div>
			<div class="mkdf-membership-input-holder">
				<label for="discount_price"><?php esc_html_e( 'Discount Price', 'mkdf-real-estate' ); ?></label>
				<input class="mkdf-membership-input" type="text" name="discount_price" id="discount_price"
				       value="">
			</div>
			<div class="mkdf-membership-input-holder">
				<label for="price_label"><?php esc_html_e( 'Price Label', 'mkdf-real-estate' ); ?></label>
				<input class="mkdf-membership-input" type="text" name="price_label" id="price_label"
				       value="">
			</div>
			<div class="mkdf-membership-input-holder">
				<label for="price_label_position"><?php esc_html_e( 'Price Label Position', 'mkdf-real-estate' ); ?></label>
				<div class="mkdf-grid-row">
					<div class="mkdf-grid-col-12">
						<select name="price_label_position" id="price_label_position">
							<option selected="selected" value=""><?php esc_html_e('Default','mkdf-real-estate'); ?></option>
							<option value="before"><?php esc_html_e('Before Price','mkdf-real-estate'); ?></option>
							<option value="after"><?php esc_html_e('After Price','mkdf-real-estate'); ?></option>
						</select>
					</div>
				</div>
			</div>
			<div class="mkdf-membership-input-holder">
				<label for="size"><?php esc_html_e( 'Building Size', 'mkdf-real-estate' ); ?></label>
				<input class="mkdf-membership-input" type="text" name="size" id="size"
				       value="">
			</div>
			<div class="mkdf-membership-input-holder">
				<label for="size_label"><?php esc_html_e( 'Size Label', 'mkdf-real-estate' ); ?></label>
				<input class="mkdf-membership-input" type="text" name="size_label" id="size_label"
				       value="">
			</div>
			<div class="mkdf-membership-input-holder">
				<label for="size_label_position"><?php esc_html_e( 'Size Label Position', 'mkdf-real-estate' ); ?></label>
				<div class="mkdf-grid-row">
					<div class="mkdf-grid-col-12">
						<select name="size_label_position" id="size_label_position">
							<option selected="selected" value=""><?php esc_html_e('Default','mkdf-real-estate'); ?></option>
							<option value="before"><?php esc_html_e('Before Value','mkdf-real-estate'); ?></option>
							<option value="after"><?php esc_html_e('After Value','mkdf-real-estate'); ?></option>
						</select>
					</div>
				</div>
			</div>
			<div class="mkdf-membership-input-holder">
				<label for="bedrooms"><?php esc_html_e( 'Bedrooms', 'mkdf-real-estate' ); ?></label>
				<input class="mkdf-membership-input" type="text" name="bedrooms" id="bedrooms"
				       value="">
			</div>
			<div class="mkdf-membership-input-holder">
				<label for="bathrooms"><?php esc_html_e( 'Bathrooms', 'mkdf-real-estate' ); ?></label>
				<input class="mkdf-membership-input" type="text" name="bathrooms" id="bathrooms"
				       value="">
			</div>
			<div class="mkdf-membership-input-holder">
				<label for="floor"><?php esc_html_e( 'Floor', 'mkdf-real-estate' ); ?></label>
				<input class="mkdf-membership-input" type="text" name="floor" id="floor"
				       value="">
			</div>
			<div class="mkdf-membership-input-holder">
				<label for="total_floors"><?php esc_html_e( 'Total Floors', 'mkdf-real-estate' ); ?></label>
				<input class="mkdf-membership-input" type="text" name="total_floors" id="total_floors"
				       value="">
			</div>
			<div class="mkdf-membership-input-holder">
				<label for="year_built"><?php esc_html_e( 'Year Built', 'mkdf-real-estate' ); ?></label>
				<input class="mkdf-membership-input" type="text" name="year_built" id="year_built"
				       value="">
			</div>
			<div class="mkdf-membership-input-holder">
				<label for="heating"><?php esc_html_e( 'Energy rating (EER)', 'mkdf-real-estate' ); ?></label>
				<input class="mkdf-membership-input" type="text" name="heating" id="heating"
				       value="">
			</div>
			<div class="mkdf-membership-input-holder">
				<label for="accommodation"><?php esc_html_e( 'Accommodation', 'mkdf-real-estate' ); ?></label>
				<input class="mkdf-membership-input" type="text" name="accommodation" id="accommodation"
				       value="">
			</div>
			<h5><?php esc_html_e('Additional Specifications','mkdf-real-estate');?></h5>
			<div class="mkdf-membership-input-holder">
				<label for="ceiling_height"><?php esc_html_e( 'Ceiling Height', 'mkdf-real-estate' ); ?></label>
				<input class="mkdf-membership-input" type="text" name="ceiling_height" id="ceiling_height"
				       value="">
			</div>
			<div class="mkdf-membership-input-holder">
				<label for="parking"><?php esc_html_e( 'Parking', 'mkdf-real-estate' ); ?></label>
				<input class="mkdf-membership-input" type="text" name="parking" id="parking"
				       value="">
			</div>
			<div class="mkdf-membership-input-holder">
				<label for="property_from_center"><?php esc_html_e( 'Distance From the Center', 'mkdf-real-estate' ); ?></label>
				<input class="mkdf-membership-input" type="text" name="property_from_center" id="property_from_center"
				       value="">
			</div>
			<div class="mkdf-membership-input-holder">
				<label for="area_size"><?php esc_html_e( 'Land Size', 'mkdf-real-estate' ); ?></label>
				<input class="mkdf-membership-input" type="text" name="area_size" id="area_size"
				       value="">
			</div>
			<div class="mkdf-membership-input-holder">
				<label for="garages"><?php esc_html_e( 'Garages', 'mkdf-real-estate' ); ?></label>
				<input class="mkdf-membership-input" type="text" name="garages" id="garages"
				       value="">
			</div>
			<div class="mkdf-membership-input-holder">
				<label for="garages_size"><?php esc_html_e( 'Garages Size', 'mkdf-real-estate' ); ?></label>
				<input class="mkdf-membership-input" type="text" name="garages_size" id="garages_size"
				       value="">
			</div>
			<div class="mkdf-membership-input-holder">
				<label for="additional_space"><?php esc_html_e( 'Garage size', 'mkdf-real-estate' ); ?></label>
				<input class="mkdf-membership-input" type="text" name="additional_space" id="additional_space"
				       value="">
			</div>
			<div class="mkdf-membership-input-holder">
				<label for="publication_date"><?php esc_html_e( 'Next Inspection', 'mkdf-real-estate' ); ?></label>
				<input class="mkdf-membership-input datepicker" type="text" name="publication_date" id="publication_date"
				       value="">
			</div>
			<?php if ($number_of_featured > 0) { ?>
				<div class="mkdf-membership-input-holder">
					<label for="featured_property"><?php esc_html_e( 'Featured Property', 'mkdf-real-estate' ); ?></label>
					<div class="mkdf-grid-row">
						<div class="mkdf-grid-col-12">
							<select name="featured_property" id="featured_property">
								<option selected="selected" value=""><?php esc_html_e('Default','mkdf-real-estate'); ?></option>
								<option value="no"><?php esc_html_e('No','mkdf-real-estate'); ?></option>
								<option value="yes"><?php esc_html_e('Yes','mkdf-real-estate'); ?></option>
							</select>
						</div>
					</div>
				</div>
			<?php } ?>
			<div class="displaynone">
			<h5><?php esc_html_e('Leasing Terms','mkdf-real-estate');?></h5>
			<div class="mkdf-membership-repeater-wrapper">
				<table class="mkdf-membership-repeater-fields-holder mkdf-table-layout mkdf-membership-sortable-holder clearfix ui-sortable">
					<thead>
						<tr>
							<th><?php esc_html_e('Order','mkdf-real-estate'); ?></th>
							<th><?php esc_html_e('Icon','mkdf-real-estate'); ?></th>
							<th><?php esc_html_e('Label','mkdf-real-estate'); ?></th>
							<th><?php esc_html_e('Value','mkdf-real-estate'); ?></th>
							<th><?php esc_html_e('Remove','mkdf-real-estate'); ?></th>
						</tr>
					</thead>
					<tbody class="mkdf-membership-sortable-holder ui-sortable">
						<tr class="mkdf-membership-repeater-fields-row">
							<td class="mkdf-membership-repeater-sort">
								<i class="fa fa-sort"></i>
							</td>
							<td>
								<div class="mkdf-page-form-section mkdf-membership-repeater-field" id="property_leasing_terms_icon-0">
									<div class="mkdf-section-content">
										<div class="container-fluid">
											<div class="mkdf-membership-gallery-holder">
												<label for="property_leasing_terms_icon"><?php esc_html_e( 'Icon', 'mkdf-real-estate' ); ?></label>
												<ul class="mkdf-membership-gallery-images-holder"></ul>
												<div class="mkdf-membership-gallery-uploader">
													<?php 
													if ( mkdf_membership_theme_installed() ) {
														echo zuhaus_mikado_get_button_html( array(
															'text'      => esc_html__( 'Upload', 'mkdf-real-estate' ),
															'custom_class' => 'mkdf-membership-gallery-upload'
														) );
													} else {
														echo '<a itemprop="url" href="#" target="_self" class="mkdf-btn mkdf-btn-medium mkdf-btn-solid mkdf-membership-gallery-upload"><span class="mkdf-btn-text">' . esc_html__( 'Upload', 'mkdf-real-estate' ) . '</span></a>';
													} ?>
													<input class="mkdf-membership-gallery-upload-hidden" type="file" name="property_leasing_terms_icon[]" id="property_leasing_terms_icon"
													       value="">
												</div>
											</div>
										</div>
									</div>
								</div>
							</td>
							<td>
								<div class="mkdf-page-form-section mkdf-membership-repeater-field" id="property_leasing_terms_label-0">
									<div class="mkdf-section-content">
										<div class="container-fluid">
	                                        <input type="text" class="mkdf-membership-input" name="property_leasing_terms_label[]" value="">
										</div>
									</div>
								</div>
							</td>
							<td>
								<div class="mkdf-page-form-section mkdf-membership-repeater-field" id="property_leasing_terms_value-0">
									<div class="mkdf-section-content">
										<div class="container-fluid">
	                                        <input type="text" class="mkdf-membership-input" name="property_leasing_terms_value[]" value="">
										</div>
									</div>
								</div>
							</td>
							<td class="mkdf-membership-repeater-remove">
								<a class="mkdf-clone-remove" href="#"><i class="fa fa-times"></i></a>
							</td>
						</tr>
					</tbody>
				</table>
				<div class="mkdf-membership-repeater-add">
					<a class="mkdf-clone mkdf-btn mkdf-btn-solid" data-count="1" href="#"><?php esc_html_e('Add New','mkdf-real-estate'); ?></a>
				</div>
			</div>
			<h5><?php esc_html_e('Costs','mkdf-real-estate');?></h5>
			<div class="mkdf-membership-repeater-wrapper">
				<table class="mkdf-membership-repeater-fields-holder mkdf-table-layout mkdf-membership-sortable-holder clearfix ui-sortable">
					<thead>
						<tr>
							<th><?php esc_html_e('Order','mkdf-real-estate'); ?></th>
							<th><?php esc_html_e('Icon','mkdf-real-estate'); ?></th>
							<th><?php esc_html_e('Label','mkdf-real-estate'); ?></th>
							<th><?php esc_html_e('Value','mkdf-real-estate'); ?></th>
							<th><?php esc_html_e('Remove','mkdf-real-estate'); ?></th>
						</tr>
					</thead>
					<tbody class="mkdf-membership-sortable-holder ui-sortable">
						<tr class="mkdf-membership-repeater-fields-row">
							<td class="mkdf-membership-repeater-sort">
								<i class="fa fa-sort"></i>
							</td>
							<td>
								<div class="mkdf-page-form-section mkdf-membership-repeater-field" id="property_costs_icon-0">
									<div class="mkdf-section-content">
										<div class="container-fluid">
											<div class="mkdf-membership-gallery-holder">
												<label for="property_costs_icon"><?php esc_html_e( 'Icon', 'mkdf-real-estate' ); ?></label>
												<ul class="mkdf-membership-gallery-images-holder"></ul>
												<div class="mkdf-membership-gallery-uploader">
													<?php 
													if ( mkdf_membership_theme_installed() ) {
														echo zuhaus_mikado_get_button_html( array(
															'text'      => esc_html__( 'Upload', 'mkdf-real-estate' ),
															'custom_class' => 'mkdf-membership-gallery-upload'
														) );
													} else {
														echo '<a itemprop="url" href="#" target="_self" class="mkdf-btn mkdf-btn-medium mkdf-btn-solid mkdf-membership-gallery-upload"><span class="mkdf-btn-text">' . esc_html__( 'Upload', 'mkdf-real-estate' ) . '</span></a>';
													} ?>
													<input class="mkdf-membership-gallery-upload-hidden" type="file" name="property_costs_icon[]" id="property_costs_icon"
													       value="">
												</div>
											</div>
										</div>
									</div>
								</div>
							</td>
							<td>
								<div class="mkdf-page-form-section mkdf-membership-repeater-field" id="property_costs_label-0">
									<div class="mkdf-section-content">
										<div class="container-fluid">
	                                        <input type="text" class="mkdf-membership-input" name="property_costs_label[]" value="">
										</div>
									</div>
								</div>
							</td>
							<td>
								<div class="mkdf-page-form-section mkdf-membership-repeater-field" id="property_costs_value-0">
									<div class="mkdf-section-content">
										<div class="container-fluid">
	                                        <input type="text" class="mkdf-membership-input" name="property_costs_value[]" value="">
										</div>
									</div>
								</div>
							</td>
							<td class="mkdf-membership-repeater-remove">
								<a class="mkdf-clone-remove" href="#"><i class="fa fa-times"></i></a>
							</td>
						</tr>
					</tbody>
				</table>
				<div class="mkdf-membership-repeater-add">
					<a class="mkdf-clone mkdf-btn mkdf-btn-solid" data-count="1" href="#"><?php esc_html_e('Add New','mkdf-real-estate'); ?></a>
				</div>
			</div>
			</div>
			<h5><?php esc_html_e('Address','mkdf-real-estate');?></h5>
			<div class="mkdf-membership-address-field"  data-country="" data-lat-field="property_latitude" data-long-field="property_longitude" id="property_full_address">
				<div class="mkdf-field-desc">
					<h5><?php esc_html_e('Full Adress','mkdf-real-estate'); ?></h5>
				</div>
				<div class="mkdf-section-content">
					<input type="text" class="form-control mkdf-input mkdf-form-element" name="property_full_address" value="" placeholder="<?php esc_html_e('Enter a location','mkdf-real-estate'); ?>" autocomplete="off">
					<div class="map_canvas"></div>
					<a id="reset" href="#" style="display:none;"><?php esc_html_e( 'Reset Marker', 'mkdf-real-estate' ); ?></a>
				</div>
			</div>
			<div class="mkdf-membership-input-holder mkdf-membership-address-elements displaynone">
				<label for="property_latitude"><?php esc_html_e( 'Latitude', 'mkdf-real-estate' ); ?></label>
				<input class="mkdf-membership-input"  data-geo="lat" type="text" name="property_latitude" id="property_latitude" value="">
			</div>
			<div class="mkdf-membership-input-holder mkdf-membership-address-elements displaynone">
				<label for="property_longitude"><?php esc_html_e( 'Longitude', 'mkdf-real-estate' ); ?></label>
				<input class="mkdf-membership-input" data-geo="lng" type="text" name="property_longitude" id="property_longitude" value="">
			</div>
			<div class="mkdf-membership-input-holder displaynone">
				<label for="property_simple_address"><?php esc_html_e( 'Simple Address', 'mkdf-real-estate' ); ?></label>
				<input class="mkdf-membership-input" type="text" name="property_simple_address" id="property_simple_address"
				       value="">
			</div>
			<div class="mkdf-membership-input-holder">
				<label for="property_zip_code"><?php esc_html_e( 'Property ZIP Code', 'mkdf-real-estate' ); ?></label>
				<input class="mkdf-membership-input" type="text" name="property_zip_code" id="property_zip_code"
				       value="">
			</div>
			<div class="mkdf-membership-input-holder">
				<label for="property_country"><?php esc_html_e( 'Country', 'mkdf-real-estate' ); ?></label>
				<div class="mkdf-grid-row">
					<div class="mkdf-grid-col-12">
					<?php $country_options = mkdf_re_get_countries_list();
					if (is_array($country_options) && count($country_options)) { ?>
						<select name="property_country" id="property_country">
							<?php foreach($country_options as $country_key => $country) { ?>
								<option value="<?php echo esc_attr($country_key);?>"><?php echo esc_attr($country);?></option>
							<?php } ?>
						</select>
					<?php } ?>
					</div>
				</div>
			</div>
			<h5><?php esc_html_e('Media','mkdf-real-estate');?></h5>
			<div class="mkdf-membership-gallery-holder">
				<label for="property_image_gallery"><?php esc_html_e( 'Gallery Images', 'mkdf-real-estate' ); ?></label>
				<ul class="mkdf-membership-gallery-images-holder"></ul>
				<div class="mkdf-membership-gallery-uploader">
					<?php 
					if ( mkdf_membership_theme_installed() ) {
						echo zuhaus_mikado_get_button_html( array(
							'text'      => esc_html__( 'Upload', 'mkdf-real-estate' ),
							'custom_class' => 'mkdf-membership-gallery-upload'
						) );
					} else {
						echo '<a itemprop="url" href="#" target="_self" class="mkdf-btn mkdf-btn-medium mkdf-btn-solid mkdf-membership-gallery-upload"><span class="mkdf-btn-text">' . esc_html__( 'Upload', 'mkdf-real-estate' ) . '</span></a>';
					} ?>
					<input class="mkdf-membership-gallery-upload-hidden" type="file" name="property_image_gallery" id="property_image_gallery"
					       value="" multiple>
				</div>
			</div>
			<div class="mkdf-membership-input-holder">
				<label for="property_video_type"><?php esc_html_e( 'Video Service', 'mkdf-real-estate' ); ?></label>
				<div class="mkdf-grid-row">
					<div class="mkdf-grid-col-12">
						<select name="property_video_type" id="property_video_type">
							<option value="social_networks" selected="selected"><?php esc_html_e('Video Service','mkdf-real-estate'); ?></option>
							<option value="self"><?php esc_html_e('Self Hosted','mkdf-real-estate'); ?></option>
						</select>
					</div>
				</div>
			</div>
			<div class="mkdf-membership-input-holder">
				<label for="property_video_link"><?php esc_html_e( 'Enter video URL (if self hosted, enter MP4 format)', 'mkdf-real-estate' ); ?></label>
				<input class="mkdf-membership-input" type="text" name="property_video_link" id="property_video_link"
				       value="">
			</div>
			<div class="mkdf-membership-gallery-holder displaynone">
				<label for="property_video_image"><?php esc_html_e( 'Video Image', 'mkdf-real-estate' ); ?></label>
				<ul class="mkdf-membership-gallery-images-holder"></ul>
				<div class="mkdf-membership-gallery-uploader">
					<?php 
					if ( mkdf_membership_theme_installed() ) {
						echo zuhaus_mikado_get_button_html( array(
							'text'      => esc_html__( 'Upload', 'mkdf-real-estate' ),
							'custom_class' => 'mkdf-membership-gallery-upload'
						) );
					} else {
						echo '<a itemprop="url" href="#" target="_self" class="mkdf-btn mkdf-btn-medium mkdf-btn-solid mkdf-membership-gallery-upload"><span class="mkdf-btn-text">' . esc_html__( 'Upload', 'mkdf-real-estate' ) . '</span></a>';
					} ?>
					<input class="mkdf-membership-gallery-upload-hidden" type="file" name="property_video_image" id="property_video_image"
					       value="">
				</div>
			</div>
			<div class="mkdf-membership-input-holder displaynone">
				<label for="property_virtual_tour"><?php esc_html_e( 'Virtual Tour Core', 'mkdf-real-estate' ); ?></label>
				<textarea class="mkdf-membership-input" name="property_virtual_tour" id="property_virtual_tour" rows="5"></textarea>
			</div>
			<div class="mkdf-membership-gallery-holder displaynone">
				<label for="property_attachment"><?php esc_html_e( 'Attachment', 'mkdf-real-estate' ); ?></label>
				<ul class="mkdf-membership-gallery-images-holder"></ul>
				<div class="mkdf-membership-gallery-uploader">
					<?php 
					if ( mkdf_membership_theme_installed() ) {
						echo zuhaus_mikado_get_button_html( array(
							'text'      => esc_html__( 'Upload', 'mkdf-real-estate' ),
							'custom_class' => 'mkdf-membership-gallery-upload'
						) );
					} else {
						echo '<a itemprop="url" href="#" target="_self" class="mkdf-btn mkdf-btn-medium mkdf-btn-solid mkdf-membership-gallery-upload"><span class="mkdf-btn-text">' . esc_html__( 'Upload', 'mkdf-real-estate' ) . '</span></a>';
					} ?>
					<input class="mkdf-membership-gallery-upload-hidden" type="file" name="property_attachment" id="property_attachment"
					       value="">
				</div>
			</div>
			<div class="displaynone">
			<h5><?php esc_html_e('Multi Units / Sub Properties','mkdf-real-estate');?></h5>
			<div class="mkdf-membership-repeater-wrapper mkdf-membership-table">
				<div class="mkdf-membership-repeater-fields-holder mkdf-membership-sortable-holder clearfix ui-sortable">
					<div class="mkdf-membership-repeater-fields-row">
						<div class="mkdf-membership-repeater-sort">
							<i class="fa fa-sort"></i>
						</div>
						<div class="mkdf-membership-repeater-row-holder">
							<div class="mkdf-grid-row">
								<div class="mkdf-grid-col-6">
									<div class="mkdf-page-form-section mkdf-membership-repeater-field" id="property_multi_unit_title-0">
										<div class="mkdf-section-content">
											<div class="container-fluid">
												<label for="property_multi_unit_title"><?php esc_html_e( 'Title', 'mkdf-real-estate' ); ?></label>
		                                        <input type="text" class="mkdf-membership-input" name="property_multi_unit_title[]" value="">
											</div>
										</div>
									</div>
								</div>
								<div class="mkdf-grid-col-6">
									<div class="mkdf-page-form-section mkdf-membership-repeater-field" id="property_multi_unit_type-0">
										<div class="mkdf-section-content">
											<div class="container-fluid">
												<label for="property_multi_unit_type"><?php esc_html_e( 'Type', 'mkdf-real-estate' ); ?></label>
		                                        <input type="text" class="mkdf-membership-input" name="property_multi_unit_type[]" value="">
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="mkdf-grid-row">
								<div class="mkdf-grid-col-6">
									<div class="mkdf-page-form-section mkdf-membership-repeater-field" id="property_multi_unit_price-0">
										<div class="mkdf-section-content">
											<div class="container-fluid">
												<label for="property_multi_unit_price"><?php esc_html_e( 'Price', 'mkdf-real-estate' ); ?></label>
		                                        <input type="text" class="mkdf-membership-input" name="property_multi_unit_price[]" value="">
											</div>
										</div>
									</div>
								</div>
								<div class="mkdf-grid-col-6">
									<div class="mkdf-page-form-section mkdf-membership-repeater-field" id="property_multi_unit_bedrooms-0">
										<div class="mkdf-section-content">
											<div class="container-fluid">
												<label for="property_multi_unit_bedrooms"><?php esc_html_e( 'Bedrooms', 'mkdf-real-estate' ); ?></label>
		                                        <input type="text" class="mkdf-membership-input" name="property_multi_unit_bedrooms[]" value="">
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="mkdf-grid-row">
								<div class="mkdf-grid-col-6">
									<div class="mkdf-page-form-section mkdf-membership-repeater-field" id="property_multi_unit_bathrooms-0">
										<div class="mkdf-section-content">
											<div class="container-fluid">
												<label for="property_multi_unit_bathrooms"><?php esc_html_e( 'Bathrooms', 'mkdf-real-estate' ); ?></label>
		                                        <input type="text" class="mkdf-membership-input" name="property_multi_unit_bathrooms[]" value="">
											</div>
										</div>
									</div>
								</div>
								<div class="mkdf-grid-col-6">
									<div class="mkdf-page-form-section mkdf-membership-repeater-field" id="property_multi_unit_size-0">
										<div class="mkdf-section-content">
											<div class="container-fluid">
												<label for="property_multi_unit_size"><?php esc_html_e( 'Size', 'mkdf-real-estate' ); ?></label>
		                                        <input type="text" class="mkdf-membership-input" name="property_multi_unit_size[]" value="">
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="mkdf-grid-row">
								<div class="mkdf-grid-col-6">
									<div class="mkdf-page-form-section mkdf-membership-repeater-field" id="property_multi_unit_available-0">
										<div class="mkdf-section-content">
											<div class="container-fluid">
												<label for="property_multi_unit_available"><?php esc_html_e( 'Availability Date', 'mkdf-real-estate' ); ?></label>
		                                        <input type="text" class="mkdf-membership-input" name="property_multi_unit_available[]" value="">
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="mkdf-membership-repeater-remove">
							<a class="mkdf-clone-remove" href="#"><i class="fa fa-times"></i></a>
						</div>
					</div>
				</div>
				<div class="mkdf-membership-repeater-add">
					<a class="mkdf-clone mkdf-btn mkdf-btn-solid" data-count="1" href="#"><?php esc_html_e('Add New','mkdf-real-estate'); ?></a>
				</div>
			</div>
			
			<h5><?php esc_html_e('Home Plans','mkdf-real-estate');?></h5>
			<div class="mkdf-membership-repeater-wrapper mkdf-membership-table">
				<div class="mkdf-membership-repeater-fields-holder mkdf-membership-sortable-holder clearfix ui-sortable">
					<div class="mkdf-membership-repeater-fields-row">
						<div class="mkdf-membership-repeater-sort">
							<i class="fa fa-sort"></i>
						</div>
						<div class="mkdf-membership-repeater-row-holder">
							<div class="mkdf-grid-row">
								<div class="mkdf-grid-col-6">
									<div class="mkdf-page-form-section mkdf-membership-repeater-field" id="property_home_plan_title-0">
										<div class="mkdf-section-content">
											<div class="container-fluid">
												<label for="property_home_plan_title"><?php esc_html_e( 'Title', 'mkdf-real-estate' ); ?></label>
		                                        <input type="text" class="mkdf-membership-input" name="property_home_plan_title[]" value="">
											</div>
										</div>
									</div>
								</div>
								<div class="mkdf-grid-col-6">
									<div class="mkdf-page-form-section mkdf-membership-repeater-field" id="property_home_plan_price-0">
										<div class="mkdf-section-content">
											<div class="container-fluid">
												<label for="property_home_plan_price"><?php esc_html_e( 'Price', 'mkdf-real-estate' ); ?></label>
		                                        <input type="text" class="mkdf-membership-input" name="property_home_plan_price[]" value="">
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="mkdf-grid-row">
								<div class="mkdf-grid-col-6">
									<div class="mkdf-page-form-section mkdf-membership-repeater-field" id="property_home_plan_bedrooms-0">
										<div class="mkdf-section-content">
											<div class="container-fluid">
												<label for="property_home_plan_bedrooms"><?php esc_html_e( 'Bedrooms', 'mkdf-real-estate' ); ?></label>
		                                        <input type="text" class="mkdf-membership-input" name="property_home_plan_bedrooms[]" value="">
											</div>
										</div>
									</div>
								</div>
								<div class="mkdf-grid-col-6">
									<div class="mkdf-page-form-section mkdf-membership-repeater-field" id="property_home_plan_bathrooms-0">
										<div class="mkdf-section-content">
											<div class="container-fluid">
												<label for="property_home_plan_bathrooms"><?php esc_html_e( 'Bathrooms', 'mkdf-real-estate' ); ?></label>
		                                        <input type="text" class="mkdf-membership-input" name="property_home_plan_bathrooms[]" value="">
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="mkdf-grid-row">
								<div class="mkdf-grid-col-6">
									<div class="mkdf-page-form-section mkdf-membership-repeater-field" id="property_home_plan_size-0">
										<div class="mkdf-section-content">
											<div class="container-fluid">
												<label for="property_home_plan_size"><?php esc_html_e( 'Size', 'mkdf-real-estate' ); ?></label>
		                                        <input type="text" class="mkdf-membership-input" name="property_home_plan_size[]" value="">
											</div>
										</div>
									</div>
								</div>
								<div class="mkdf-grid-col-6">
									<div class="mkdf-page-form-section mkdf-membership-repeater-field" id="property_home_plan_image-0">
										<div class="mkdf-section-content">
											<div class="container-fluid">
												<div class="mkdf-membership-gallery-holder">
													<label for="property_home_plan_image"><?php esc_html_e( 'Image', 'mkdf-real-estate' ); ?></label>
													<ul class="mkdf-membership-gallery-images-holder"></ul>
													<div class="mkdf-membership-gallery-uploader">
														<?php 
														if ( mkdf_membership_theme_installed() ) {
															echo zuhaus_mikado_get_button_html( array(
																'text'      => esc_html__( 'Upload', 'mkdf-real-estate' ),
																'custom_class' => 'mkdf-membership-gallery-upload'
															) );
														} else {
															echo '<a itemprop="url" href="#" target="_self" class="mkdf-btn mkdf-btn-medium mkdf-btn-solid mkdf-membership-gallery-upload"><span class="mkdf-btn-text">' . esc_html__( 'Upload', 'mkdf-real-estate' ) . '</span></a>';
														} ?>
														<input class="mkdf-membership-gallery-upload-hidden" type="file" name="property_home_plan_image[]" id="property_home_plan_image"
														       value="">
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="mkdf-grid-row">
								<div class="mkdf-grid-col-12">
									<div class="mkdf-page-form-section mkdf-membership-repeater-field mkdf-membership-input-holder" id="property_home_plan_description-0">
										<div class="mkdf-section-content">
											<div class="container-fluid">
												<label for="property_home_plan_description"><?php esc_html_e( 'Description', 'mkdf-real-estate' ); ?></label>
		                                        <textarea class="mkdf-membership-input" name="property_home_plan_description[]" value="" rows="5"></textarea>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="mkdf-membership-repeater-remove">
							<a class="mkdf-clone-remove" href="#"><i class="fa fa-times"></i></a>
						</div>
					</div>
				</div>
				<div class="mkdf-membership-repeater-add">
					<a class="mkdf-clone mkdf-btn mkdf-btn-solid" data-count="1" href="#"><?php esc_html_e('Add New','mkdf-real-estate'); ?></a>
				</div>
			</div>
			</div>
			<input type="hidden" name="property_package_meta" value="<?php echo mkdf_re_get_user_current_package(); ?>"/>
			<?php
			if ( mkdf_membership_theme_installed() ) {
				echo zuhaus_mikado_get_button_html( array(
					'text'      => esc_html__( 'CREATE PROPERTY', 'mkdf-real-estate' ),
					'html_type' => 'button',
					'custom_class' => 'add-property-button',
					'custom_attrs' => array(
						'data-updating-text' => esc_html__('CREATING PROPERTY', 'mkdf-real-estate'),
						'data-updated-text' => esc_html__('PROPERTY CREATED', 'mkdf-real-estate'),
					)
				) );
			} else {
				echo '<button type="submit">' . esc_html__( 'CREATE PROPERTY', 'mkdf-real-estate' ) . '</button>';
			}
			wp_nonce_field( 'mkdf_validate_add_property', 'mkdf_nonce_add_property' )
			?>
		</form>
		<?php
		do_action( 'mkdf_membership_action_login_ajax_response' );
		?>
	</div>
</div>
<?php } ?>