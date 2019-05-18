<?php if ( $query_results->max_num_pages > 1 ) {
	$holder_styles = $this_object->getLoadMoreStyles( $params );
	?>
    <?php echo mkdf_re_get_cpt_shortcode_module_template_part( 'property', 'property-list', 'pagination/loading-element' ); ?>
	<div class="mkdf-pl-load-more-holder">
		<div class="mkdf-pl-load-more" <?php zuhaus_mikado_inline_style( $holder_styles ); ?>>
			<?php
			echo zuhaus_mikado_get_button_html( array(
				'link' => 'javascript: void(0)',
				'size' => 'large',
				'text' => esc_html__( 'Load more', 'mkdf-real-estate' )
			) );
			?>
		</div>
	</div>
<?php }