<?php
$query_results = new \WP_Query( $query_args );
?>
<div class="mkdf-re-profile-all-properties-holder">
	<?php if($query_results->have_posts()){
			while ( $query_results->have_posts() ) {
				$query_results->the_post(); ?>
					<div class="mkdf-re-profile-property-item">
						<div class="mkdf-re-profile-property-item-image">
							<?php
							if ( has_post_thumbnail( get_the_ID() ) ) {
								$image = get_the_post_thumbnail_url( get_the_ID(), 'thumbnail' );
							} else {
								$image = MIKADO_RE_CPT_URL_PATH . '/property/assets/img/property_featured_image.jpg';
							}
							?>
							<img src="<?php echo esc_attr( $image ); ?>" alt="<?php echo esc_attr( 'Property thumbnail', 'mkdf-real-estate' ) ?>"/>
						</div>
						<div class="mkdf-re-profile-property-item-title">
							<h4>
								<a href="<?php echo get_the_permalink( get_the_ID() ); ?>">
									<?php echo get_the_title( get_the_ID() ); ?>
								</a>
							</h4>
						</div>
						<div class="mkdf-re-profile-property-item-buttons">
							<?php 
							if ( mkdf_membership_theme_installed() ) {
								echo zuhaus_mikado_get_button_html( array(
									'text'      => esc_html__( 'EDIT PROPERTY', 'mkdf-real-estate' ),
									'custom_class' => 'mkdf-property-item-edit',
									'link' => esc_url( add_query_arg( array( 'user-action' => 'edit-property', 'property_id' => get_the_ID() ), $dashboard_url ) )
								) );
							} else {
								echo '<a itemprop="url" href="'.esc_url( add_query_arg( array( 'user-action' => 'edit-property', 'property_id' => get_the_ID() ), $dashboard_url ) ).'" target="_self" class="mkdf-btn mkdf-btn-medium mkdf-btn-solid mkdf-property-item-edit"><span class="mkdf-btn-text">' . esc_html__( 'EDIT PROPERTY', 'mkdf-real-estate' ) . '</span></a>';
							}
							?>
							<?php 
							if ( mkdf_membership_theme_installed() ) {
								echo zuhaus_mikado_get_button_html( array(
									'text'      => esc_html__( 'DELETE PROPERTY', 'mkdf-real-estate' ),
									'custom_class' => 'mkdf-property-item-delete',
									'custom_attrs' => array(
										'data-property-id' => get_the_ID(),
										'data-confirm-text' => esc_html__('Are you sure you want to delete this property?','mkdf-real-estate')
									)
								) );
							} else {
								echo '<a href="#" target="_self" class="mkdf-btn mkdf-btn-medium mkdf-btn-solid mkdf-property-item-delete" data-property-id="<?php echo get_the_ID()?>" data-confirm-text="<?php esc_html__("Are you sure you want to delete this property?","mkdf-real-estate");?>"><span class="mkdf-btn-text">' . esc_html__( 'EDIT PROPERTY', 'mkdf-real-estate' ) . '</span></a>';
							}
							?>
						</div>
					</div>
					<?php
				}
			} else { ?>
		<h3><?php esc_html_e( "You haven't added any property yet.", "mkdf-real-estate" ) ?> </h3>
	<?php } ?>
</div>