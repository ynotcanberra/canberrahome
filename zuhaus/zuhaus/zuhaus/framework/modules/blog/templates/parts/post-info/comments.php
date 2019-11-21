<?php if(comments_open()) { ?>
	<div class="mkdf-post-info-comments-holder">
		<a itemprop="url" class="mkdf-post-info-comments" href="<?php comments_link(); ?>" target="_self">
			<i class="icon-bubble"></i><?php comments_number('0 ' . esc_html__('','zuhaus'), '1 '.esc_html__('','zuhaus'), '% '.esc_html__('','zuhaus') ); ?>
		</a>
	</div>
<?php } ?>