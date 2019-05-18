<div class="mkdf-membership-dashboard-page">
	<div>
		<form method="post" id="mkdf-re-update-agency-profile-form">
			<div class="mkdf-membership-input-holder">
				<label for="mkdf_agency_name"><?php esc_html_e( 'Agency Name', 'mkdf-real-estate' ); ?></label>
				<input class="mkdf-membership-input" type="text" name="mkdf_agency_name" id="mkdf_agency_name"
				       value="<?php echo $mkdf_agency_name; ?>">
			</div>
			<div class="mkdf-membership-input-holder">
				<label for="mkdf_agency_licence"><?php esc_html_e( 'Agency Licence', 'mkdf-real-estate' ); ?></label>
				<input class="mkdf-membership-input" type="text" name="mkdf_agency_licence" id="mkdf_agency_licence"
				       value="<?php echo $mkdf_agency_licence; ?>">
			</div>
			<div class="mkdf-membership-input-holder">
				<label for="email"><?php esc_html_e( 'Email', 'mkdf-real-estate' ); ?></label>
				<input class="mkdf-membership-input" type="email" name="email" id="email"
				       value="<?php echo $email; ?>">
			</div>
			<div class="mkdf-membership-input-holder">
				<label for="url"><?php esc_html_e( 'Website', 'mkdf-real-estate' ); ?></label>
				<input class="mkdf-membership-input" type="text" name="url" id="url" value="<?php echo $website; ?>">
			</div>
			<div class="mkdf-membership-input-holder">
				<label for="mkdf_agency_telephone"><?php esc_html_e( 'Telephone', 'mkdf-real-estate' ); ?></label>
				<input class="mkdf-membership-input" type="text" name="mkdf_agency_telephone" id="mkdf_agency_telephone" value="<?php echo $mkdf_agency_telephone; ?>">
			</div>
			<div class="mkdf-membership-input-holder">
				<label for="mkdf_agency_mobile_phone"><?php esc_html_e( 'Mobile Phone', 'mkdf-real-estate' ); ?></label>
				<input class="mkdf-membership-input" type="text" name="mkdf_agency_mobile_phone" id="mkdf_agency_mobile_phone" value="<?php echo $mkdf_agency_mobile_phone; ?>">
			</div>
			<div class="mkdf-membership-input-holder">
				<label for="mkdf_agency_fax_number"><?php esc_html_e( 'Fax Number', 'mkdf-real-estate' ); ?></label>
				<input class="mkdf-membership-input" type="text" name="mkdf_agency_fax_number" id="mkdf_agency_fax_number" value="<?php echo $mkdf_agency_fax_number; ?>">
			</div>
			<div class="mkdf-membership-input-holder">
				<label for="mkdf_agency_address"><?php esc_html_e( 'Address', 'mkdf-real-estate' ); ?></label>
				<input class="mkdf-membership-input" type="text" name="mkdf_agency_address" id="mkdf_agency_address" value="<?php echo $mkdf_agency_address; ?>">
			</div>
			<div class="mkdf-membership-input-holder">
				<label for="description"><?php esc_html_e( 'Description', 'mkdf-real-estate' ); ?></label>
				<input class="mkdf-membership-input" type="text" name="description" id="description"
				       value="<?php echo $description; ?>">
			</div>
			<div class="mkdf-membership-input-holder">
				<label for="password"><?php esc_html_e( 'Password', 'mkdf-real-estate' ); ?></label>
				<input class="mkdf-membership-input" type="password" name="password" id="password" value="">
			</div>
			<div class="mkdf-membership-input-holder">
				<label for="password2"><?php esc_html_e( 'Repeat Password', 'mkdf-real-estate' ); ?></label>
				<input class="mkdf-membership-input" type="password" name="password2" id="password2" value="">
			</div>
			<?php
			if ( mkdf_membership_theme_installed() ) {
				echo zuhaus_mikado_get_button_html( array(
					'text'      => esc_html__( 'UPDATE PROFILE', 'mkdf-real-estate' ),
					'html_type' => 'button',
					'custom_attrs' => array(
						'data-updating-text' => esc_html__('UPDATING PROFILE', 'mkdf-real-estate'),
						'data-updated-text' => esc_html__('PROFILE UPDATED', 'mkdf-real-estate'),
					)
				) );
			} else {
				echo '<button type="submit">' . esc_html__( 'UPDATE PROFILE', 'mkdf-real-estate' ) . '</button>';
			}
			wp_nonce_field( 'mkdf_validate_edit_agency_profile', 'mkdf_nonce_edit_agency_profile' )
			?>
		</form>
		<?php
		do_action( 'mkdf_membership_action_login_ajax_response' );
		?>
	</div>
</div>