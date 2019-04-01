<?php if(zuhaus_mikado_core_plugin_installed()) { ?>
<div class="mkdf-blog-like">
	<?php if( function_exists('zuhaus_mikado_get_like') ) zuhaus_mikado_get_like(); ?>
</div>
<?php } ?>