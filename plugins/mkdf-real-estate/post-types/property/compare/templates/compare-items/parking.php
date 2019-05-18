<li class="mkdf-re-info-holder">
    <div>
        <?php esc_html_e('Parking', 'mkdf-real-estate'); ?>
    </div>
    <?php foreach($added_properties as $property) { ?>
        <?php $value = get_post_meta($property, 'mkdf_property_parking_meta', true); ?>
        <div>
            <?php echo esc_html($value); ?>
        </div>
    <?php } ?>
</li>