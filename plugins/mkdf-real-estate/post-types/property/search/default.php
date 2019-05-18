<?php
$shortcode_params = mkdf_re_get_search_page_sc_params($params);

echo zuhaus_mikado_execute_shortcode('mkdf_property_list', $shortcode_params);