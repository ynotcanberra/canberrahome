<?php

if (isset($agents) && is_array($agents) && count($agents)){ ?>
	<div class="mkdf-re-all-agents">
		<div class="mkdf-re-all-agents-table-row mkdf-re-all-agents-heading">
			<span class="mkdf-re-all-agents-table-cell">
				<?php esc_html_e('Name','mkdf-real-estate');?>
			</span>
			<span class="mkdf-re-all-agents-table-cell">
				<?php esc_html_e('Position','mkdf-real-estate');?>
			</span>
			<span class="mkdf-re-all-agents-table-cell">
				<?php esc_html_e('Telephone','mkdf-real-estate');?>
			</span>
			<span class="mkdf-re-all-agents-table-cell">
				<?php esc_html_e('Mobile Phone','mkdf-real-estate');?>
			</span>
			<span class="mkdf-re-all-agents-table-cell">
				<?php esc_html_e('Email','mkdf-real-estate');?>
			</span>
			<span class="mkdf-re-all-agents-table-cell">
				<?php esc_html_e('Address','mkdf-real-estate');?>
			</span>
		</div>
		<?php foreach ($agents as $agent) { ?>
		<div class="mkdf-re-all-agents-table-row">
			<span class="mkdf-re-all-agents-table-cell">
				<?php echo esc_html($agent['name']);?>
			</span>
			<span class="mkdf-re-all-agents-table-cell">
				<?php if (isset($agent['position'])) {
					echo esc_html($agent['position']);
				} ?>
			</span>
			<span class="mkdf-re-all-agents-table-cell">
				<?php if (isset($agent['telephone'])) {
					echo esc_html($agent['telephone']);
				} ?>
			</span>
			<span class="mkdf-re-all-agents-table-cell">
				<?php if (isset($agent['mobile'])) {
					echo esc_html($agent['mobile']);
				} ?>
			</span>
			<span class="mkdf-re-all-agents-table-cell">
				<?php if (isset($agent['email'])) {
					echo esc_html($agent['email']);
				} ?>
			</span>
			<span class="mkdf-re-all-agents-table-cell">
				<?php if (isset($agent['address'])) {
					echo esc_html($agent['address']);
				} ?>
			</span>
		</div>	
		<?php } ?>
	</div>
<?php }