<div class="mkdf-membership-dashboard-page">
	<div class="mkdf-membership-dashboard-page-content">
		<div class="mkdf-profile-image">
            <?php echo mkdf_membership_kses_img( $profile_image ); ?>
        </div>
		<p>
			<span><?php esc_html_e( 'Agency Name', 'mkdf-real-estate' ); ?>:</span>
			<?php echo esc_html($mkdf_agency_name); ?>
		</p>
		<p>
			<span><?php esc_html_e( 'Licence', 'mkdf-real-estate' ); ?>:</span>
			<?php echo esc_html($mkdf_agency_licence); ?>
		</p>
		<p>
			<span><?php esc_html_e( 'Email', 'mkdf-real-estate' ); ?>:</span>
			<?php echo esc_html($email); ?>
		</p>
		<p>
			<span><?php esc_html_e( 'Desription', 'mkdf-real-estate' ); ?>:</span>
			<?php echo esc_html($description); ?>
		</p>
		<p>
			<span><?php esc_html_e( 'Website', 'mkdf-real-estate' ); ?>:</span>
			<a href="<?php echo esc_url( $website ); ?>" target="_blank"><?php echo esc_url($website); ?></a>
		</p>
	</div>
</div>