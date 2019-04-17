<form role="search" method="get" class="searchform" id="searchform-<?php echo esc_attr(rand(0, 1000)); ?>" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="screen-reader-text"><?php esc_html_e( 'Search for:', 'zuhaus' ); ?></label>
	<div class="input-holder clearfix">
		<input type="search" class="search-field" placeholder="<?php esc_html_e( 'Search...', 'zuhaus' ); ?>" value="" name="s" title="<?php esc_html_e( 'Search for:', 'zuhaus' ); ?>"/>
		<button type="submit" class="mkdf-search-submit"><?php echo zuhaus_mikado_icon_collections()->renderIcon( 'icon-magnifier', 'simple_line_icons' ); ?></button>
	</div>
</form>