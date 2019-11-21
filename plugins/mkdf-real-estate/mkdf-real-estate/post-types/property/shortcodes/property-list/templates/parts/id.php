<?php
$property_id = get_post_meta(get_the_ID(), 'mkdf_property_id_meta', true);
?>
<span class="mkdf-property-id">
   <?php echo esc_html__('ID','mkdf-real-estate') . ' ' . esc_html($property_id); ?>
</span>
