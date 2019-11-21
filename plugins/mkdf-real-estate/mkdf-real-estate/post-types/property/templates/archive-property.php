<?php
$mkdf_re_archive_holder_params = mkdf_re_get_holder_params_archive();
?>
<?php
get_header();
zuhaus_mikado_get_title(); ?>
<?php do_action('zuhaus_mikado_before_main_content'); ?>
<div class="<?php echo esc_attr( $mkdf_re_archive_holder_params['holder'] ); ?>">
	<?php do_action('zuhaus_mikado_after_container_open'); ?>
    <div class="<?php echo esc_attr( $mkdf_re_archive_holder_params['inner'] ); ?>">
		<?php
            $mkdf_taxonomy_name = '';
			$mkdf_taxonomy_id = get_queried_object_id();
			if(is_tax('property-type')) {
                $mkdf_taxonomy_name = 'property-type';
            } else if(is_tax('property-status')) {
                $mkdf_taxonomy_name = 'property-status';
            } else if(is_tax('property-city')) {
                $mkdf_taxonomy_name = 'property-city';
            } else if(is_tax('property-feature')) {
                $mkdf_taxonomy_name = 'property-feature';
            } else if(is_tax('property-county')) {
                $mkdf_taxonomy_name = 'property-county';
            } else if(is_tax('property-neighborhood')) {
                $mkdf_taxonomy_name = 'property-neighborhood';
            } else if(is_tax('property-tag')) {
                $mkdf_taxonomy_name = 'property-tag';
            }
		
			mkdf_re_get_archive_property_list($mkdf_taxonomy_id, $mkdf_taxonomy_name);
		?>
	</div>
	<?php do_action('zuhaus_mikado_before_container_close'); ?>
</div>
<?php get_footer(); ?>
