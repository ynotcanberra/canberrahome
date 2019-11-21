<div class="mkdf-add-agent-page">
	<div>
		<form method="post" id="mkdf-re-add-agent-form">
			<div class="mkdf-membership-input-holder">
				<label for="username"><?php esc_html_e( 'Username', 'mkdf-real-estate' ); ?></label>
				<input class="mkdf-membership-input" type="text" name="username" id="username"
				       value="">
			</div>
			<div class="mkdf-membership-input-holder">
				<label for="first_name"><?php esc_html_e( 'First Name', 'mkdf-real-estate' ); ?></label>
				<input class="mkdf-membership-input" type="text" name="first_name" id="first_name"
				       value="">
			</div>
			<div class="mkdf-membership-input-holder">
				<label for="last_name"><?php esc_html_e( 'Last Name', 'mkdf-real-estate' ); ?></label>
				<input class="mkdf-membership-input" type="text" name="last_name" id="last_name"
				       value="">
			</div>
			<div class="mkdf-membership-input-holder">
				<label for="email"><?php esc_html_e( 'Email', 'mkdf-real-estate' ); ?></label>
				<input class="mkdf-membership-input" type="email" name="email" id="email"
				       value="">
			</div>
			<div class="mkdf-membership-input-holder">
				<label for="url"><?php esc_html_e( 'Website', 'mkdf-real-estate' ); ?></label>
				<input class="mkdf-membership-input" type="text" name="url" id="url" value="">
			</div>
			<div class="mkdf-membership-input-holder">
				<label for="description"><?php esc_html_e( 'Description', 'mkdf-real-estate' ); ?></label>
				<input class="mkdf-membership-input" type="text" name="description" id="description"
				       value="">
			</div>
			<div class="mkdf-membership-input-holder">
				<label for="password"><?php esc_html_e( 'Password', 'mkdf-real-estate' ); ?></label>
				<input class="mkdf-membership-input" type="password" name="password" id="password" value="">
			</div>
			<div class="mkdf-membership-input-holder">
				<label for="password2"><?php esc_html_e( 'Repeat Password', 'mkdf-real-estate' ); ?></label>
				<input class="mkdf-membership-input" type="password" name="password2" id="password2" value="">
			</div>
			<input type="hidden" name="agency" id="agency" value="<?php echo get_current_user_id();?>">
			<?php
			if ( mkdf_membership_theme_installed() ) {
				echo zuhaus_mikado_get_button_html( array(
					'text'      => esc_html__( 'CREATE AGENT', 'mkdf-real-estate' ),
					'html_type' => 'button',
					'custom_attrs' => array(
						'data-updating-text' => esc_html__('CREATING AGENT', 'mkdf-real-estate'),
						'data-updated-text' => esc_html__('AGENT CREATED', 'mkdf-real-estate'),
					)
				) );
			} else {
				echo '<button type="submit">' . esc_html__( 'CREATE AGENT', 'mkdf-real-estate' ) . '</button>';
			}
			wp_nonce_field( 'mkdf_validate_add_agent_profile', 'mkdf_nonce_add_agent_profile' )
			?>
		</form>
		<?php
		do_action( 'mkdf_membership_action_login_ajax_response' );
		?>
	</div>
</div>