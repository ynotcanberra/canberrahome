<?php $property_db_id = $_GET['property_id'];
$params = mkdf_re_get_property_meta($property_db_id);
extract($params);
?>

<div class="mkdf-edit-property-page">
	<div>
		<form method="post" id="mkdf-re-edit-property-form">
			<input type="hidden" name="property_db_id" id="property_db_id" value="<?php echo esc_attr($property_db_id);?>"/>
			<div class="mkdf-membership-input-holder">
				<label for="property_title"><?php esc_html_e( 'Property Title', 'mkdf-real-estate' ); ?></label>
				<input class="mkdf-membership-input" type="text" name="property_title" id="property_title"
				       value="<?php echo isset($title) ? esc_attr($title) : '';?>">
			</div>
			<div class="mkdf-membership-input-holder">
				<label for="property_id"><?php esc_html_e( 'Property ID', 'mkdf-real-estate' ); ?></label>
				<input class="mkdf-membership-input" type="text" name="property_id" id="property_id"
				       value="<?php echo isset($mkdf_property_id_meta) ? esc_attr($mkdf_property_id_meta) : '';?>">
			</div>
			<div class="mkdf-membership-gallery-holder">
				<label for="property_featured_image"><?php esc_html_e( 'Featured Image', 'mkdf-real-estate' ); ?></label>
				<ul class="mkdf-membership-gallery-images-holder">
					<?php if ( isset($featured_image_url) ) { ?>
						<li class="mkdf-membership-gallery-image"><img src="<?php echo esc_url($featured_image_url);?>" /></li>
					<?php } ?>
				</ul>
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
					<?php if (isset($featured_image_url)) { 
						$hidden_value = $featured_image_url;
					} else {
						$hidden_value = '';
					} ?>
					<input type="hidden" class="mkdf-membership-media-hidden" name="property_featured_image_hidden" value="<?php echo esc_attr($hidden_value);?>"/>
			       <button class="mkdf-btn mkdf-btn-solid mkdf-membership-remove-image" data-name="property_featured_image"><?php esc_html_e('Remove Media','mkdf-real-estate'); ?></button>
				</div>
			</div>
			<div class="mkdf-membership-input-holder">
				<label class="mkdf-membership-input-label" for="property_type"><?php esc_html_e( 'Property Type', 'mkdf-real-estate' ); ?></label>
				<?php $property_terms = mkdf_re_get_property_terms_list('property-type');
				if (is_array($property_terms) && count($property_terms)) { ?>
					<div class="mkdf-grid-row">
					<?php foreach ($property_terms as $property_term) { 
						$checked = false;
						if (in_array($property_term['id'], $property_type_terms)){
							$checked = true;
						}
						?>
						<div class="mkdf-grid-col-3">
							<div class="mkdf-checkbox-style">
								<input type="checkbox" name="property_type[]" value="<?php echo esc_attr($property_term['id'])?>" <?php echo esc_attr($checked ? 'checked=checked' : '');?>>
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
					<?php foreach ($property_terms as $property_term) { 
						$checked = false;
						if (in_array($property_term['id'], $property_feature_terms)){
							$checked = true;
						}
						?>
						<div class="mkdf-grid-col-3">
							<div class="mkdf-checkbox-style">
								<input type="checkbox" name="property_feature[]" value="<?php echo esc_attr($property_term['id'])?>" <?php echo esc_attr($checked ? 'checked=checked' : '');?>>
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
					<?php foreach ($property_terms as $property_term) { 
						$checked = false;
						if (in_array($property_term['id'], $property_status_terms)){
							$checked = true;
						}
						?>
						<div class="mkdf-grid-col-3">
							<div class="mkdf-checkbox-style">
								<input type="checkbox" name="property_status[]" value="<?php echo esc_attr($property_term['id'])?>" <?php echo esc_attr($checked ? 'checked=checked' : '');?>>
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
					<?php foreach ($property_terms as $property_term) { 
						$checked = false;
						if (in_array($property_term['id'], $property_county_terms)){
							$checked = true;
						}
						?>
						<div class="mkdf-grid-col-3">
							<div class="mkdf-checkbox-style">
								<input type="checkbox" name="property_county[]" value="<?php echo esc_attr($property_term['id'])?>" <?php echo esc_attr($checked ? 'checked=checked' : '');?>>
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
				<label class="mkdf-membership-input-label" for="property_city"><?php esc_html_e( 'Property City', 'mkdf-real-estate' ); ?></label>
				<?php $property_terms = mkdf_re_get_property_terms_list('property-city');
				if (is_array($property_terms) && count($property_terms)) { ?>
					<div class="mkdf-grid-row">
					<?php foreach ($property_terms as $property_term) { 
						$checked = false;
						if (in_array($property_term['id'], $property_city_terms)){
							$checked = true;
						}
						?>
						<div class="mkdf-grid-col-3">
							<div class="mkdf-checkbox-style">
								<input type="checkbox" name="property_city[]" value="<?php echo esc_attr($property_term['id'])?>" <?php echo esc_attr($checked ? 'checked=checked' : '');?>>
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
					<?php foreach ($property_terms as $property_term) {
						$checked = false;
						if (in_array($property_term['id'], $property_neighborhood_terms)){
							$checked = true;
						}
						?>
						<div class="mkdf-grid-col-3">
							<div class="mkdf-checkbox-style">
								<input type="checkbox" name="property_neighborhood[]" value="<?php echo esc_attr($property_term['id'])?>" <?php echo esc_attr($checked ? 'checked=checked' : '');?>>
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
					<?php foreach ($property_terms as $property_term) { 
						$checked = false;
						if (in_array($property_term['slug'], $property_tag_terms)){
							$checked = true;
						} ?>
						<div class="mkdf-grid-col-3">
							<div class="mkdf-checkbox-style">
								<input type="checkbox" name="property_tag[]" value="<?php echo esc_attr($property_term['slug'])?>" <?php echo esc_attr($checked ? 'checked=checked' : '');?>>
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
				<textarea class="mkdf-membership-input" name="property_description" id="property_description" rows="5"><?php echo esc_html($description);?></textarea>
			</div>
			<h3><?php esc_html_e('Specifications','mkdf-real-estate');?></h3>
			<div class="mkdf-membership-input-holder">
				<label for="price"><?php esc_html_e( 'Price', 'mkdf-real-estate' ); ?></label>
				<input class="mkdf-membership-input" type="text" name="price" id="price"
				       value="<?php echo isset($mkdf_property_price_meta) ? esc_attr($mkdf_property_price_meta) : '';?>">
			</div>
			<div class="mkdf-membership-input-holder">
				<label for="discount_price"><?php esc_html_e( 'Discount Price', 'mkdf-real-estate' ); ?></label>
				<input class="mkdf-membership-input" type="text" name="discount_price" id="discount_price"
				       value="<?php echo isset($mkdf_property_discount_price_meta) ? esc_attr($mkdf_property_discount_price_meta) : '';?>">
			</div>
			<div class="mkdf-membership-input-holder">
				<label for="price_label"><?php esc_html_e( 'Price Label', 'mkdf-real-estate' ); ?></label>
				<input class="mkdf-membership-input" type="text" name="price_label" id="price_label"
				       value="<?php echo isset($mkdf_property_price_label_meta) ? esc_attr($mkdf_property_price_label_meta) : '';?>">
			</div>
			<div class="mkdf-membership-input-holder">
				<label for="price_label_position"><?php esc_html_e( 'Price Label Position', 'mkdf-real-estate' ); ?></label>
				<div class="mkdf-grid-row">
					<div class="mkdf-grid-col-12">
						<select name="price_label_position" id="price_label_position">
							<?php if (!isset($mkdf_property_price_label_position_meta)) $mkdf_property_price_label_position_meta = ''; ?>
							<option <?php echo esc_attr(($mkdf_property_price_label_position_meta == '') ? 'selected=selected' : ''); ?> value=""><?php esc_html_e('Default','mkdf-real-estate'); ?></option>
							<option <?php echo esc_attr(($mkdf_property_price_label_position_meta == 'before') ? 'selected=selected' : ''); ?> value="before"><?php esc_html_e('Before Price','mkdf-real-estate'); ?></option>
							<option <?php echo esc_attr(($mkdf_property_price_label_position_meta == 'after') ? 'selected=selected' : ''); ?> value="after"><?php esc_html_e('After Price','mkdf-real-estate'); ?></option>
						</select>
					</div>
				</div>
			</div>
			<div class="mkdf-membership-input-holder">
				<label for="size"><?php esc_html_e( 'Size', 'mkdf-real-estate' ); ?></label>
				<input class="mkdf-membership-input" type="text" name="size" id="size"
				       value="<?php echo isset($mkdf_property_size_meta) ? esc_attr($mkdf_property_size_meta) : '';?>">
			</div>
			<div class="mkdf-membership-input-holder">
				<label for="size_label"><?php esc_html_e( 'Size Label', 'mkdf-real-estate' ); ?></label>
				<input class="mkdf-membership-input" type="text" name="size_label" id="size_label"
				       value="<?php echo isset($mkdf_property_size_label_meta) ? esc_attr($mkdf_property_size_label_meta) : '';?>">
			</div>
			<div class="mkdf-membership-input-holder">
				<label for="size_label_position"><?php esc_html_e( 'Size Label Position', 'mkdf-real-estate' ); ?></label>
				<div class="mkdf-grid-row">
					<div class="mkdf-grid-col-12">
						<select name="size_label_position" id="size_label_position">
							<?php if (!isset($mkdf_property_size_label_position_meta)) $mkdf_property_size_label_position_meta = ''; ?>
							<option <?php echo esc_attr(($mkdf_property_size_label_position_meta == '') ? 'selected=selected' : ''); ?> value=""><?php esc_html_e('Default','mkdf-real-estate'); ?></option>
							<option <?php echo esc_attr(($mkdf_property_size_label_position_meta == 'before') ? 'selected=selected' : ''); ?> value="before"><?php esc_html_e('Before Value','mkdf-real-estate'); ?></option>
							<option <?php echo esc_attr(($mkdf_property_size_label_position_meta == 'after') ? 'selected=selected' : ''); ?> value="after"><?php esc_html_e('After Value','mkdf-real-estate'); ?></option>
						</select>
					</div>
				</div>
			</div>
			<div class="mkdf-membership-input-holder">
				<label for="bedrooms"><?php esc_html_e( 'Bedrooms', 'mkdf-real-estate' ); ?></label>
				<input class="mkdf-membership-input" type="text" name="bedrooms" id="bedrooms"
				       value="<?php echo isset($mkdf_property_bedrooms_meta) ? esc_attr($mkdf_property_bedrooms_meta) : '';?>">
			</div>
			<div class="mkdf-membership-input-holder">
				<label for="bathrooms"><?php esc_html_e( 'Bathrooms', 'mkdf-real-estate' ); ?></label>
				<input class="mkdf-membership-input" type="text" name="bathrooms" id="bathrooms"
				       value="<?php echo isset($mkdf_property_bathrooms_meta) ? esc_attr($mkdf_property_bathrooms_meta) : '';?>">
			</div>
			<div class="mkdf-membership-input-holder">
				<label for="floor"><?php esc_html_e( 'Floor', 'mkdf-real-estate' ); ?></label>
				<input class="mkdf-membership-input" type="text" name="floor" id="floor"
				       value="<?php echo isset($mkdf_property_floor_meta) ? esc_attr($mkdf_property_floor_meta) : '';?>">
			</div>
			<div class="mkdf-membership-input-holder">
				<label for="total_floors"><?php esc_html_e( 'Total Floors', 'mkdf-real-estate' ); ?></label>
				<input class="mkdf-membership-input" type="text" name="total_floors" id="total_floors"
				       value="<?php echo isset($mkdf_property_total_floors_meta) ? esc_attr($mkdf_property_total_floors_meta) : '';?>">
			</div>
			<div class="mkdf-membership-input-holder">
				<label for="year_built"><?php esc_html_e( 'Year Built', 'mkdf-real-estate' ); ?></label>
				<input class="mkdf-membership-input" type="text" name="year_built" id="year_built"
				       value="<?php echo isset($mkdf_property_year_built_meta) ? esc_attr($mkdf_property_year_built_meta) : '';?>">
			</div>
			<div class="mkdf-membership-input-holder">
				<label for="heating"><?php esc_html_e( 'Heating', 'mkdf-real-estate' ); ?></label>
				<input class="mkdf-membership-input" type="text" name="heating" id="heating"
				       value="<?php echo isset($mkdf_property_heating_meta) ? esc_attr($mkdf_property_heating_meta) : '';?>">
			</div>
			<div class="mkdf-membership-input-holder">
				<label for="accommodation"><?php esc_html_e( 'Accommodation', 'mkdf-real-estate' ); ?></label>
				<input class="mkdf-membership-input" type="text" name="accommodation" id="accommodation"
				       value="<?php echo isset($mkdf_property_accommodation_meta) ? esc_attr($mkdf_property_accommodation_meta) : '';?>">
			</div>
			<h3><?php esc_html_e('Additional Specifications','mkdf-real-estate');?></h3>
			<div class="mkdf-membership-input-holder">
				<label for="ceiling_height"><?php esc_html_e( 'Ceiling Height', 'mkdf-real-estate' ); ?></label>
				<input class="mkdf-membership-input" type="text" name="ceiling_height" id="ceiling_height"
				       value="<?php echo isset($mkdf_property_ceiling_height_meta) ? esc_attr($mkdf_property_ceiling_height_meta) : '';?>">
			</div>
			<div class="mkdf-membership-input-holder">
				<label for="parking"><?php esc_html_e( 'Parking', 'mkdf-real-estate' ); ?></label>
				<input class="mkdf-membership-input" type="text" name="parking" id="parking"
				       value="<?php echo isset($mkdf_property_parking_meta) ? esc_attr($mkdf_property_parking_meta) : '';?>">
			</div>
			<div class="mkdf-membership-input-holder">
				<label for="property_from_center"><?php esc_html_e( 'Distance From the Center', 'mkdf-real-estate' ); ?></label>
				<input class="mkdf-membership-input" type="text" name="property_from_center" id="property_from_center"
				       value="<?php echo isset($mkdf_property_from_center_meta) ? esc_attr($mkdf_property_from_center_meta) : '';?>">
			</div>
			<div class="mkdf-membership-input-holder">
				<label for="area_size"><?php esc_html_e( 'Land Size', 'mkdf-real-estate' ); ?></label>
				<input class="mkdf-membership-input" type="text" name="area_size" id="area_size"
				       value="<?php echo isset($mkdf_property_area_size_meta) ? esc_attr($mkdf_property_area_size_meta) : '';?>">
			</div>
			<div class="mkdf-membership-input-holder">
				<label for="garages"><?php esc_html_e( 'Garages', 'mkdf-real-estate' ); ?></label>
				<input class="mkdf-membership-input" type="text" name="garages" id="garages"
				       value="<?php echo isset($mkdf_property_garages_meta) ? esc_attr($mkdf_property_garages_meta) : '';?>">
			</div>
			<div class="mkdf-membership-input-holder">
				<label for="garages_size"><?php esc_html_e( 'Garages Size', 'mkdf-real-estate' ); ?></label>
				<input class="mkdf-membership-input" type="text" name="garages_size" id="garages_size"
				       value="<?php echo isset($mkdf_property_garages_size_meta) ? esc_attr($mkdf_property_garages_size_meta) : '';?>">
			</div>
			<div class="mkdf-membership-input-holder">
				<label for="additional_space"><?php esc_html_e( 'Garage size', 'mkdf-real-estate' ); ?></label>
				<input class="mkdf-membership-input" type="text" name="additional_space" id="additional_space"
				       value="<?php echo isset($mkdf_property_additional_space_meta) ? esc_attr($mkdf_property_additional_space_meta) : '';?>">
			</div>
			<div class="mkdf-membership-input-holder">
				<label for="publication_date"><?php esc_html_e( 'Publication Date', 'mkdf-real-estate' ); ?></label>
				<input class="mkdf-membership-input datepicker" type="text" name="publication_date" id="publication_date"
				       value="<?php echo isset($mkdf_property_publication_date_meta) ? esc_attr($mkdf_property_publication_date_meta) : '';?>">
			</div>
			<div class="mkdf-membership-input-holder">
				<label for="featured_property"><?php esc_html_e( 'Featured Property', 'mkdf-real-estate' ); ?></label>
				<div class="mkdf-grid-row">
					<div class="mkdf-grid-col-12">
						<select name="featured_property" id="featured_property">
							<?php if (!isset($mkdf_property_is_featured_meta)) $mkdf_property_is_featured_meta = ''; ?>
							<option <?php echo esc_attr(($mkdf_property_is_featured_meta == '') ? 'selected=selected' : ''); ?> value=""><?php esc_html_e('Default','mkdf-real-estate'); ?></option>
							<option <?php echo esc_attr(($mkdf_property_is_featured_meta == 'no') ? 'selected=selected' : ''); ?> value="no"><?php esc_html_e('No','mkdf-real-estate'); ?></option>
							<option <?php echo esc_attr(($mkdf_property_is_featured_meta == 'yes') ? 'selected=selected' : ''); ?> value="yes"><?php esc_html_e('Yes','mkdf-real-estate'); ?></option>
						</select>
					</div>
				</div>
			</div>
			<div class="displaynone">
			<h3><?php esc_html_e('Leasing Terms','mkdf-real-estate');?></h3>
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
						<?php for ($i=0; $i < $leasing_number; $i++) { ?>
						<tr class="mkdf-membership-repeater-fields-row">
							<td class="mkdf-membership-repeater-sort">
								<i class="fa fa-sort"></i>
							</td>
							<td>
								<div class="mkdf-page-form-section mkdf-membership-repeater-field" id="property_leasing_terms_icon-<?php echo esc_attr($i);?>">
									<div class="mkdf-section-content">
										<div class="container-fluid">
											<div class="mkdf-membership-gallery-holder">
												<label for="property_leasing_terms_icon"><?php esc_html_e( 'Image', 'mkdf-real-estate' ); ?></label>
												<ul class="mkdf-membership-gallery-images-holder">
													<?php if (isset($mkdf_property_leasing_terms_icon_meta[$i])) { ?>
														<li class="mkdf-membership-gallery-image">
															<img src="<?php echo esc_url($mkdf_property_leasing_terms_icon_meta[$i]);?>"/>
														</li>
													<?php } ?>
												</ul>
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
													<?php if (isset($mkdf_property_leasing_terms_icon_meta[$i])) { 
														$hidden_value = $mkdf_property_leasing_terms_icon_meta[$i];
													} else {
														$hidden_value = '';
													} ?>
													<input type="hidden" class="mkdf-membership-media-hidden" name="property_leasing_terms_icon_hidden[]" value="<?php echo esc_attr($hidden_value);?>"/>
													<button class="mkdf-btn mkdf-btn-solid mkdf-membership-remove-image" data-name="property_leasing_terms_icon-<?php echo esc_attr($i)?>"><?php esc_html_e('Remove Media','mkdf-real-estate'); ?></button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</td>
							<td>
								<div class="mkdf-page-form-section mkdf-membership-repeater-field" id="property_leasing_terms_label-<?php echo esc_attr($i);?>">
									<div class="mkdf-section-content">
										<div class="container-fluid">
	                                        <input type="text" class="mkdf-membership-input" name="property_leasing_terms_label[]" value="<?php echo isset($mkdf_property_leasing_terms_label_meta[$i]) ? esc_attr($mkdf_property_leasing_terms_label_meta[$i]) : ''; ?>">
										</div>
									</div>
								</div>
							</td>
							<td>
								<div class="mkdf-page-form-section mkdf-membership-repeater-field" id="property_leasing_terms_value-<?php echo esc_attr($i);?>">
									<div class="mkdf-section-content">
										<div class="container-fluid">
	                                        <input type="text" class="mkdf-membership-input" name="property_leasing_terms_value[]" value="<?php echo isset($mkdf_property_leasing_terms_value_meta[$i]) ? esc_attr($mkdf_property_leasing_terms_value_meta[$i]) : ''; ?>">
										</div>
									</div>
								</div>
							</td>
							<td class="mkdf-membership-repeater-remove">
								<a class="mkdf-clone-remove" href="#"><i class="fa fa-times"></i></a>
							</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
				<div class="mkdf-membership-repeater-add">
					<a class="mkdf-clone mkdf-btn mkdf-btn-solid" data-count="<?php echo esc_attr($leasing_number); ?>" href="#"><?php esc_html_e('Add New','mkdf-real-estate'); ?></a>
				</div>
			</div>
			<h3><?php esc_html_e('Costs','mkdf-real-estate');?></h3>
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
						<?php for ($i=0; $i < $cost_number; $i++) { ?>
							<tr class="mkdf-membership-repeater-fields-row">
								<td class="mkdf-membership-repeater-sort">
									<i class="fa fa-sort"></i>
								</td>
								<td>
									<div class="mkdf-page-form-section mkdf-membership-repeater-field" id="property_costs_icon-<?php echo esc_attr($i);?>">
										<div class="mkdf-section-content">
											<div class="container-fluid">
												<div class="mkdf-membership-gallery-holder">
													<label for="property_costs_icon"><?php esc_html_e( 'Image', 'mkdf-real-estate' ); ?></label>
													<ul class="mkdf-membership-gallery-images-holder">
														<?php if (isset($mkdf_property_costs_icon_meta[$i])) { ?>
															<li class="mkdf-membership-gallery-image">
																<img src="<?php echo esc_url($mkdf_property_costs_icon_meta[$i]);?>"/>
															</li>
														<?php } ?>
													</ul>
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
														<?php if (isset($mkdf_property_costs_icon_meta[$i])) { 
															$hidden_value = $mkdf_property_costs_icon_meta[$i];
														} else {
															$hidden_value = '';
														} ?>
														<input type="hidden" class="mkdf-membership-media-hidden" name="property_costs_icon_hidden[]" value="<?php echo esc_attr($hidden_value);?>"/>
														<button class="mkdf-btn mkdf-btn-solid mkdf-membership-remove-image" data-name="property_costs_icon-<?php echo esc_attr($i)?>"><?php esc_html_e('Remove Media','mkdf-real-estate'); ?></button>
													</div>
												</div>
											</div>
										</div>
									</div>
								</td>
								<td>
									<div class="mkdf-page-form-section mkdf-membership-repeater-field" id="property_costs_label-<?php echo esc_attr($i);?>">
										<div class="mkdf-section-content">
											<div class="container-fluid">
		                                        <input type="text" class="mkdf-membership-input" name="property_costs_label[]" value="<?php echo isset($mkdf_property_costs_label_meta[$i]) ? esc_attr($mkdf_property_costs_label_meta[$i]) : ''; ?>">
											</div>
										</div>
									</div>
								</td>
								<td>
									<div class="mkdf-page-form-section mkdf-membership-repeater-field" id="property_costs_value-<?php echo esc_attr($i);?>">
										<div class="mkdf-section-content">
											<div class="container-fluid">
		                                        <input type="text" class="mkdf-membership-input" name="property_costs_value[]" value="<?php echo isset($mkdf_property_costs_value_meta[$i]) ? esc_attr($mkdf_property_costs_value_meta[$i]) : ''; ?>">
											</div>
										</div>
									</div>
								</td>
								<td class="mkdf-membership-repeater-remove">
									<a class="mkdf-clone-remove" href="#"><i class="fa fa-times"></i></a>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
				<div class="mkdf-membership-repeater-add">
					<a class="mkdf-clone mkdf-btn mkdf-btn-solid" data-count="<?php echo esc_attr($cost_number); ?>" href="#"><?php esc_html_e('Add New','mkdf-real-estate'); ?></a>
				</div>
			</div>
			</div>
			<h3><?php esc_html_e('Address','mkdf-real-estate');?></h3>
			<div class="mkdf-membership-address-field"  data-country="" data-lat-field="property_latitude" data-long-field="property_longitude" id="property_full_address">
				<div class="mkdf-field-desc">
					<h5><?php esc_html_e('Full Adress','mkdf-real-estate'); ?></h5>
				</div>
				<div class="mkdf-section-content">
					<input type="text" class="form-control mkdf-input mkdf-form-element" name="property_full_address" value="<?php echo isset($mkdf_property_full_address_meta) ? esc_attr($mkdf_property_full_address_meta) : '';?>" placeholder="<?php esc_html_e('Enter a location','mkdf-real-estate'); ?>" autocomplete="off">
					<div class="map_canvas"></div>
					<a id="reset" href="#" style="display:none;"><?php esc_html_e( 'Reset Marker', 'mkdf-real-estate' ); ?></a>
				</div>
			</div>
			<div class="mkdf-membership-input-holder mkdf-membership-address-elements displaynone">
				<label for="property_latitude"><?php esc_html_e( 'Latitude', 'mkdf-real-estate' ); ?></label>
				<input class="mkdf-membership-input"  data-geo="lat" type="text" name="property_latitude" id="property_latitude" 
					value="<?php echo isset($mkdf_property_full_address_latitude) ? esc_attr($mkdf_property_full_address_latitude) : '';?>">
			</div>
			<div class="mkdf-membership-input-holder mkdf-membership-address-elements displaynone">
				<label for="property_longitude"><?php esc_html_e( 'Longitude', 'mkdf-real-estate' ); ?></label>
				<input class="mkdf-membership-input" data-geo="lng" type="text" name="property_longitude" id="property_longitude" 
					value="<?php echo isset($mkdf_property_full_address_longitude) ? esc_attr($mkdf_property_full_address_longitude) : '';?>">
			</div>
			<div class="mkdf-membership-input-holder displaynone">
				<label for="property_simple_address"><?php esc_html_e( 'Simple Address', 'mkdf-real-estate' ); ?></label>
				<input class="mkdf-membership-input" type="text" name="property_simple_address" id="property_simple_address"
				       value="<?php echo isset($mkdf_property_simple_address_meta) ? esc_attr($mkdf_property_simple_address_meta) : '';?>">
			</div>
			<div class="mkdf-membership-input-holder">
				<label for="property_zip_code"><?php esc_html_e( 'Property ZIP Code', 'mkdf-real-estate' ); ?></label>
				<input class="mkdf-membership-input" type="text" name="property_zip_code" id="property_zip_code"
				       value="<?php echo isset($mkdf_property_zip_code_meta) ? esc_attr($mkdf_property_zip_code_meta) : '';?>">
			</div>
			<div class="mkdf-membership-input-holder">
				<label for="property_country"><?php esc_html_e( 'Country', 'mkdf-real-estate' ); ?></label>
				<div class="mkdf-grid-row">
					<div class="mkdf-grid-col-12">
					<?php $country_options = mkdf_re_get_countries_list();
					if (is_array($country_options) && count($country_options)) { ?>
						<select name="property_country" id="property_country">
							<?php if (!isset($mkdf_property_address_country_meta)) $mkdf_property_address_country_meta = ''; ?>
							<?php foreach($country_options as $country_key => $country) { ?>
								<option <?php echo esc_attr(($mkdf_property_address_country_meta == $country_key) ? 'selected=selected' : ''); ?> value="<?php echo esc_attr($country_key);?>"><?php echo esc_attr($country);?></option>
							<?php } ?>
						</select>
					<?php } ?>
					</div>
				</div>
			</div>
			<h3><?php esc_html_e('Media','mkdf-real-estate');?></h3>
			<div class="mkdf-membership-gallery-holder">
				<label for="property_image_gallery"><?php esc_html_e( 'Gallery Images', 'mkdf-real-estate' ); ?></label>
				<ul class="mkdf-membership-gallery-images-holder">
					<?php 
					if (isset($mkdf_property_image_gallery)) {
						$gallery_images = explode(',', $mkdf_property_image_gallery);
						foreach ($gallery_images as $image) {
							$url = wp_get_attachment_url($image); ?>
							<li class="mkdf-membership-gallery-image">
								<img src="<?php echo esc_url($url);?>"/>
							</li>
						<?php } 
					} ?>
				</ul>
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
					<?php if (isset($mkdf_property_image_gallery)) { 
						$hidden_value = $mkdf_property_image_gallery;
					} else {
						$hidden_value = '';
					} ?>
					<input type="hidden" class="mkdf-membership-media-hidden" name="property_image_gallery_hidden" value="<?php echo esc_attr($hidden_value);?>"/>
			       <button class="mkdf-btn mkdf-btn-solid mkdf-membership-remove-image" data-name="property_image_gallery"><?php esc_html_e('Remove Media','mkdf-real-estate'); ?></button>
				</div>
			</div>
			<div class="mkdf-membership-input-holder">
				<label for="property_video_type"><?php esc_html_e( 'Video Service', 'mkdf-real-estate' ); ?></label>
				<div class="mkdf-grid-row">
					<div class="mkdf-grid-col-12">
						<select name="property_video_type" id="property_video_type">
							<?php if (!isset($mkdf_property_video_type_meta)) $mkdf_property_video_type_meta = 'social_networks'; ?>
							<option <?php echo esc_attr(($mkdf_property_video_type_meta == 'social_networks') ? 'selected=selected' : ''); ?> value="social_networks"><?php esc_html_e('Video Service','mkdf-real-estate'); ?></option>
							<option <?php echo esc_attr(($mkdf_property_video_type_meta == 'self') ? 'selected=selected' : ''); ?> value="self"><?php esc_html_e('Self Hosted','mkdf-real-estate'); ?></option>
						</select>
					</div>
				</div>
			</div>
			<div class="mkdf-membership-input-holder">
				<label for="property_video_link"><?php esc_html_e( 'Enter video URL (if self hosted, enter MP4 format)', 'mkdf-real-estate' ); ?></label>
				<input class="mkdf-membership-input" type="text" name="property_video_link" id="property_video_link"
				       value="<?php echo isset($mkdf_property_video_link_meta) ? esc_attr($mkdf_property_video_link_meta) : '';?>">
			</div>
			<div class="mkdf-membership-gallery-holder displaynone">
				<label for="property_video_image"><?php esc_html_e( 'Video Image', 'mkdf-real-estate' ); ?></label>
				<ul class="mkdf-membership-gallery-images-holder">
					<?php if ( isset($mkdf_property_video_image_meta) ) { ?>
						<li class="mkdf-membership-gallery-image"><img src="<?php echo esc_url($mkdf_property_video_image_meta);?>" /></li>
					<?php } ?>
				</ul>
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
					<?php if (isset($mkdf_property_video_image_meta)) { 
						$hidden_value = $mkdf_property_video_image_meta;
					} else {
						$hidden_value = '';
					} ?>
					<input type="hidden" class="mkdf-membership-media-hidden" name="property_video_image_hidden" value="<?php echo esc_attr($hidden_value);?>"/>
			       <button class="mkdf-btn mkdf-btn-solid mkdf-membership-remove-image" data-name="property_video_image"><?php esc_html_e('Remove Media','mkdf-real-estate'); ?></button>
				</div>
			</div>
			<div class="mkdf-membership-input-holder displaynone">
				<label for="property_virtual_tour"><?php esc_html_e( 'Virtual Tour Core', 'mkdf-real-estate' ); ?></label>
				<textarea class="mkdf-membership-input" name="property_virtual_tour" id="property_virtual_tour" rows="5"><?php echo isset($mkdf_property_virtual_tour_meta) ? esc_html($mkdf_property_virtual_tour_meta) : '';?></textarea>
			</div>
			<div class="mkdf-membership-gallery-holder displaynone">
				<label for="property_attachment"><?php esc_html_e( 'Attachment', 'mkdf-real-estate' ); ?></label>
				<ul class="mkdf-membership-gallery-images-holder">
					<?php if ( isset($mkdf_property_attachment_meta) ) { ?>
						<li class="mkdf-membership-gallery-image">
							<span class="mkdf-membership-input-text"><?php echo esc_html($mkdf_property_attachment_meta);?></span>
						</li>
					<?php } ?>
				</ul>
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
					<?php if (isset($mkdf_property_attachment_meta)) { 
						$hidden_value = $mkdf_property_attachment_meta;
					} else {
						$hidden_value = '';
					} ?>
					<input type="hidden" class="mkdf-membership-media-hidden" name="property_attachment_hidden" value="<?php echo esc_attr($hidden_value);?>"/>
					<button class="mkdf-btn mkdf-btn-solid mkdf-membership-remove-image" data-name="property_attachment"><?php esc_html_e('Remove Media','mkdf-real-estate'); ?></button>
				</div>
			</div>
			<div class="displaynone">
			<h3><?php esc_html_e('Multi Units / Sub Properties','mkdf-real-estate');?></h3>
			<div class="mkdf-membership-repeater-wrapper mkdf-membership-table">
				<div class="mkdf-membership-repeater-fields-holder mkdf-membership-sortable-holder clearfix ui-sortable">
					<?php for ($i=0; $i < $multi_unit_number; $i++) { ?>
						<div class="mkdf-membership-repeater-fields-row">
							<div class="mkdf-membership-repeater-sort">
								<i class="fa fa-sort"></i>
							</div>
							<div class="mkdf-membership-repeater-row-holder">
								<div class="mkdf-grid-row">
									<div class="mkdf-grid-col-6">
										<div class="mkdf-page-form-section mkdf-membership-repeater-field" id="property_multi_unit_title-<?php echo esc_attr($i);?>">
											<div class="mkdf-section-content">
												<div class="container-fluid">
													<label for="property_multi_unit_title"><?php esc_html_e( 'Title', 'mkdf-real-estate' ); ?></label>
			                                        <input type="text" class="mkdf-membership-input" name="property_multi_unit_title[]" value="<?php echo isset($mkdf_property_multi_unit_title_meta[$i]) ? esc_attr($mkdf_property_multi_unit_title_meta[$i]) : ''; ?>">
												</div>
											</div>
										</div>
									</div>
									<div class="mkdf-grid-col-6">
										<div class="mkdf-page-form-section mkdf-membership-repeater-field" id="property_multi_unit_type-<?php echo esc_attr($i);?>">
											<div class="mkdf-section-content">
												<div class="container-fluid">
													<label for="property_multi_unit_type"><?php esc_html_e( 'Type', 'mkdf-real-estate' ); ?></label>
			                                        <input type="text" class="mkdf-membership-input" name="property_multi_unit_type[]" value="<?php echo isset($mkdf_property_multi_unit_type_meta[$i]) ? esc_attr($mkdf_property_multi_unit_type_meta[$i]) : ''; ?>">
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="mkdf-grid-row">
									<div class="mkdf-grid-col-6">
										<div class="mkdf-page-form-section mkdf-membership-repeater-field" id="property_multi_unit_price-<?php echo esc_attr($i);?>">
											<div class="mkdf-section-content">
												<div class="container-fluid">
													<label for="property_multi_unit_price"><?php esc_html_e( 'Price', 'mkdf-real-estate' ); ?></label>
			                                        <input type="text" class="mkdf-membership-input" name="property_multi_unit_price[]" value="<?php echo isset($mkdf_property_multi_unit_price_meta[$i]) ? esc_attr($mkdf_property_multi_unit_price_meta[$i]) : ''; ?>">
												</div>
											</div>
										</div>
									</div>
									<div class="mkdf-grid-col-6">
										<div class="mkdf-page-form-section mkdf-membership-repeater-field" id="property_multi_unit_bedrooms-<?php echo esc_attr($i);?>">
											<div class="mkdf-section-content">
												<div class="container-fluid">
													<label for="property_multi_unit_bedrooms"><?php esc_html_e( 'Bedrooms', 'mkdf-real-estate' ); ?></label>
			                                        <input type="text" class="mkdf-membership-input" name="property_multi_unit_bedrooms[]" value="<?php echo isset($mkdf_property_multi_unit_bedrooms_meta[$i]) ? esc_attr($mkdf_property_multi_unit_bedrooms_meta[$i]) : ''; ?>">
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="mkdf-grid-row">
									<div class="mkdf-grid-col-6">
										<div class="mkdf-page-form-section mkdf-membership-repeater-field" id="property_multi_unit_bathrooms-<?php echo esc_attr($i);?>">
											<div class="mkdf-section-content">
												<div class="container-fluid">
													<label for="property_multi_unit_bathrooms"><?php esc_html_e( 'Bathrooms', 'mkdf-real-estate' ); ?></label>
			                                        <input type="text" class="mkdf-membership-input" name="property_multi_unit_bathrooms[]" value="<?php echo isset($mkdf_property_multi_unit_bathrooms_meta[$i]) ? esc_attr($mkdf_property_multi_unit_bathrooms_meta[$i]) : ''; ?>">
												</div>
											</div>
										</div>
									</div>
									<div class="mkdf-grid-col-6">
										<div class="mkdf-page-form-section mkdf-membership-repeater-field" id="property_multi_unit_size-<?php echo esc_attr($i);?>">
											<div class="mkdf-section-content">
												<div class="container-fluid">
													<label for="property_multi_unit_size"><?php esc_html_e( 'Size', 'mkdf-real-estate' ); ?></label>
			                                        <input type="text" class="mkdf-membership-input" name="property_multi_unit_size[]" value="<?php echo isset($mkdf_property_multi_unit_size_meta[$i]) ? esc_attr($mkdf_property_multi_unit_size_meta[$i]) : ''; ?>">
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="mkdf-grid-row">
									<div class="mkdf-grid-col-6">
										<div class="mkdf-page-form-section mkdf-membership-repeater-field" id="property_multi_unit_available-<?php echo esc_attr($i);?>">
											<div class="mkdf-section-content">
												<div class="container-fluid">
													<label for="property_multi_unit_available"><?php esc_html_e( 'Availability Date', 'mkdf-real-estate' ); ?></label>
			                                        <input type="text" class="mkdf-membership-input" name="property_multi_unit_available[]" value="<?php echo isset($mkdf_property_multi_unit_available_meta[$i]) ? esc_attr($mkdf_property_multi_unit_available_meta[$i]) : ''; ?>">
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
					<?php } ?>
				</div>
				<div class="mkdf-membership-repeater-add">
					<a class="mkdf-clone mkdf-btn mkdf-btn-solid" data-count="<?php echo esc_attr($multi_unit_number); ?>" href="#"><?php esc_html_e('Add New','mkdf-real-estate'); ?></a>
				</div>
			</div>
			
			<h3><?php esc_html_e('Home Plans','mkdf-real-estate');?></h3>
			<div class="mkdf-membership-repeater-wrapper mkdf-membership-table">
				<div class="mkdf-membership-repeater-fields-holder mkdf-membership-sortable-holder clearfix ui-sortable">
					<?php for ($i=0; $i < $home_plan_number; $i++) { ?>
						<div class="mkdf-membership-repeater-fields-row">
							<div class="mkdf-membership-repeater-sort">
								<i class="fa fa-sort"></i>
							</div>
							<div class="mkdf-membership-repeater-row-holder">
								<div class="mkdf-grid-row">
									<div class="mkdf-grid-col-6">
										<div class="mkdf-page-form-section mkdf-membership-repeater-field" id="property_home_plan_title-<?php echo esc_attr($i);?>">
											<div class="mkdf-section-content">
												<div class="container-fluid">
													<label for="property_home_plan_title"><?php esc_html_e( 'Title', 'mkdf-real-estate' ); ?></label>
			                                        <input type="text" class="mkdf-membership-input" name="property_home_plan_title[]" value="<?php echo isset($mkdf_property_home_plan_title_meta[$i]) ? esc_attr($mkdf_property_home_plan_title_meta[$i]) : ''; ?>">
												</div>
											</div>
										</div>
									</div>
									<div class="mkdf-grid-col-6">
										<div class="mkdf-page-form-section mkdf-membership-repeater-field" id="property_home_plan_price-<?php echo esc_attr($i);?>">
											<div class="mkdf-section-content">
												<div class="container-fluid">
													<label for="property_home_plan_price"><?php esc_html_e( 'Price', 'mkdf-real-estate' ); ?></label>
			                                        <input type="text" class="mkdf-membership-input" name="property_home_plan_price[]" value="<?php echo isset($mkdf_property_home_plan_price_meta[$i]) ? esc_attr($mkdf_property_home_plan_price_meta[$i]) : ''; ?>">
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="mkdf-grid-row">
									<div class="mkdf-grid-col-6">
										<div class="mkdf-page-form-section mkdf-membership-repeater-field" id="property_home_plan_bedrooms-<?php echo esc_attr($i);?>">
											<div class="mkdf-section-content">
												<div class="container-fluid">
													<label for="property_home_plan_bedrooms"><?php esc_html_e( 'Bedrooms', 'mkdf-real-estate' ); ?></label>
			                                        <input type="text" class="mkdf-membership-input" name="property_home_plan_bedrooms[]" value="<?php echo isset($mkdf_property_home_plan_bedrooms_meta[$i]) ? esc_attr($mkdf_property_home_plan_bedrooms_meta[$i]) : ''; ?>">
												</div>
											</div>
										</div>
									</div>
									<div class="mkdf-grid-col-6">
										<div class="mkdf-page-form-section mkdf-membership-repeater-field" id="property_home_plan_bathrooms-<?php echo esc_attr($i);?>">
											<div class="mkdf-section-content">
												<div class="container-fluid">
													<label for="property_home_plan_bathrooms"><?php esc_html_e( 'Bathrooms', 'mkdf-real-estate' ); ?></label>
			                                        <input type="text" class="mkdf-membership-input" name="property_home_plan_bathrooms[]" value="<?php echo isset($mkdf_property_home_plan_bathrooms_meta[$i]) ? esc_attr($mkdf_property_home_plan_bathrooms_meta[$i]) : ''; ?>">
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="mkdf-grid-row">
									<div class="mkdf-grid-col-6">
										<div class="mkdf-page-form-section mkdf-membership-repeater-field" id="property_home_plan_size-<?php echo esc_attr($i);?>">
											<div class="mkdf-section-content">
												<div class="container-fluid">
													<label for="property_home_plan_size"><?php esc_html_e( 'Size', 'mkdf-real-estate' ); ?></label>
			                                        <input type="text" class="mkdf-membership-input" name="property_home_plan_size[]" value="<?php echo isset($mkdf_property_home_plan_size_meta[$i]) ? esc_attr($mkdf_property_home_plan_size_meta[$i]) : ''; ?>">
												</div>
											</div>
										</div>
									</div>
									<div class="mkdf-grid-col-6">
										<div class="mkdf-page-form-section mkdf-membership-repeater-field" id="property_home_plan_image-<?php echo esc_attr($i);?>">
											<div class="mkdf-section-content">
												<div class="container-fluid">
													<div class="mkdf-membership-gallery-holder">
														<label for="property_home_plan_image"><?php esc_html_e( 'Image', 'mkdf-real-estate' ); ?></label>
														<ul class="mkdf-membership-gallery-images-holder">
															<?php if (isset($mkdf_property_home_plan_image_meta[$i])) { ?>
																<li class="mkdf-membership-gallery-image">
																	<img src="<?php echo esc_url($mkdf_property_home_plan_image_meta[$i]);?>"/>
																</li>
															<?php } ?>
														</ul>
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
															<?php if (isset($mkdf_property_home_plan_image_meta[$i])) { 
																$hidden_value = $mkdf_property_home_plan_image_meta[$i];
															} else {
																$hidden_value = '';
															} ?>
															<input type="hidden" class="mkdf-membership-media-hidden" name="property_home_plan_image_hidden[]" value="<?php echo esc_attr($hidden_value);?>"/>
															<button class="mkdf-btn mkdf-btn-solid mkdf-membership-remove-image" data-name="property_home_plan_image-<?php echo esc_attr($i)?>"><?php esc_html_e('Remove Media','mkdf-real-estate'); ?></button>
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
			                                        <textarea class="mkdf-membership-input" name="property_home_plan_description[]" rows="5"><?php echo isset($mkdf_property_home_plan_description_meta[$i]) ? esc_html($mkdf_property_home_plan_description_meta[$i]) : ''; ?></textarea>
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
					<?php } ?>
				</div>
				<div class="mkdf-membership-repeater-add">
					<a class="mkdf-clone mkdf-btn mkdf-btn-solid" data-count="<?php echo esc_attr($home_plan_number); ?>" href="#"><?php esc_html_e('Add New','mkdf-real-estate'); ?></a>
				</div>
			</div>
			</div>
			<?php
			if ( mkdf_membership_theme_installed() ) {
				echo zuhaus_mikado_get_button_html( array(
					'text'      => esc_html__( 'EDIT PROPERTY', 'mkdf-real-estate' ),
					'html_type' => 'button',
					'custom_class' => 'add-property-button',
					'custom_attrs' => array(
						'data-updating-text' => esc_html__('EDITING PROPERTY', 'mkdf-real-estate'),
						'data-updated-text' => esc_html__('PROPERTY EDITED', 'mkdf-real-estate'),
					)
				) );
			} else {
				echo '<button type="submit">' . esc_html__( 'EDIT PROPERTY', 'mkdf-real-estate' ) . '</button>';
			}
			wp_nonce_field( 'mkdf_validate_edit_property', 'mkdf_nonce_edit_property' )
			?>
		</form>
		<?php
		do_action( 'mkdf_membership_action_login_ajax_response' );
		?>
	</div>
</div>