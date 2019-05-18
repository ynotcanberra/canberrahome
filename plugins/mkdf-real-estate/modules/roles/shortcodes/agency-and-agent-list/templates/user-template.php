<?php
$users = $all_users['users'];
if (is_array($users) && count($users)) {
	foreach ($users as $user) { ?>

	<li class="mkdf-aal-item mkdf-item-space">
		<div class="mkdf-aal-item-inner">
			<div class="mkdf-aal-image">
				<?php echo $user['image'];?>
			</div>
			<div class="mkdf-aal-item-content">
				<h5 class="mkdf-aal-item-title"><?php echo esc_html($user['name']);?></h5>
				<?php if ($user['description'] !== '') { ?>
					<p class="mkdf-aal-item-desc"><?php echo esc_html($user['description']);?></p>
				<?php } ?>
				<?php if ( is_array($user['social_icons']) && count($user['social_icons']) ) { ?>
					<div class="mkdf-aal-item-social">
						<?php foreach ($user['social_icons'] as $social_icon) {
							print $social_icon;
						} ?>
					</div>
				<?php } ?>
			</div>
            <?php if($enable_link == 'yes') { ?>
                <a class="mkdf-aal-user-link" href="<?php echo esc_url($user['link']);?>" target="_self"></a>
            <?php } ?>
		</div>
	</li>
<?php } 
} ?>