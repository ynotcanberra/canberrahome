<?php
/*
Template Name: Full Width
*/
?>
<?php
$mkdf_sidebar_layout = zuhaus_mikado_sidebar_layout();

get_header();
zuhaus_mikado_get_title();
get_template_part( 'slider' );
?>

<div class="mkdf-full-width">
    <?php do_action( 'zuhaus_mikado_after_container_open' ); ?>

	<div class="mkdf-full-width-inner">
        <?php do_action( 'zuhaus_mikado_after_container_inner_open' ); ?>
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<div class="mkdf-grid-row">
				<div <?php echo zuhaus_mikado_get_content_sidebar_class(); ?>>
					<?php
						the_content();
						do_action( 'zuhaus_mikado_page_after_content' );
					?>
				</div>
				<?php if ( $mkdf_sidebar_layout !== 'no-sidebar' ) { ?>
					<div <?php echo zuhaus_mikado_get_sidebar_holder_class(); ?>>
						<?php get_sidebar(); ?>
					</div>
				<?php } ?>
			</div>
		<?php endwhile; endif; ?>
	</div>

    <?php do_action( 'zuhaus_mikado_before_container_close' ); ?>
</div>

<?php get_footer(); ?>