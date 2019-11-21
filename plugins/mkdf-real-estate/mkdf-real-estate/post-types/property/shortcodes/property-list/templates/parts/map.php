<?php if(isset($params['enable_map']) && $params['enable_map'] === 'yes') { ?>
<div class="mkdf-property-list-map-part">
    <?php echo mkdf_re_get_real_estate_multiple_map($additional_params['query_results']); ?>
</div>
<?php } ?>