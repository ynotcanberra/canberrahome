<?php
if(isset($enable_type) && $enable_type === 'yes') {
    $property_list_params = array(
        'number_of_columns'         => '6',
        'skin'                      => $skin,
        'space_between_items'       => 'normal'
    );
?>
<div class="mkdf-search-top-part mkdf-search-type-section">
    <input type="hidden" id="mkdf-search-type" name="mkdf-search-type"/>
    <?php echo zuhaus_mikado_execute_shortcode('mkdf_property_type_list', $property_list_params); ?>
</div>
<?php } ?>