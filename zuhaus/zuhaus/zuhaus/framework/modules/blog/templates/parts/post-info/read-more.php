<?php if ( ! zuhaus_mikado_post_has_read_more() ) { ?>
	<div class="mkdf-post-read-more-button">
		<?php
		if ( zuhaus_mikado_core_plugin_installed() ) {
			echo zuhaus_mikado_get_button_html(
				apply_filters(
					'zuhaus_mikado_blog_template_read_more_button',
					array(
						'type'         => 'simple',
						'size'         => 'medium',
						'link'         => get_the_permalink(),
						'text'         => esc_html__( 'Read More', 'zuhaus' ),
						'custom_class' => 'mkdf-blog-list-button',
                        'icon_pack'    => 'font_elegant',
                        'fe_icon'      => 'arrow_carrot-right',
					)
				)
			);
		} else { ?>
			<a itemprop="url" href="<?php echo esc_attr( get_the_permalink() ); ?>" target="_self" class="mkdf-btn mkdf-btn-medium mkdf-btn-simple mkdf-btn-icon mkdf-blog-list-button">
                <span class="mkdf-btn-text"><?php echo esc_html__( 'Read More', 'zuhaus' ); ?></span>
                <span aria-hidden="true" class="mkdf-icon-font-elegant arrow_carrot-right "></span>
			</a>
		<?php } ?>
	</div>
<?php } ?>