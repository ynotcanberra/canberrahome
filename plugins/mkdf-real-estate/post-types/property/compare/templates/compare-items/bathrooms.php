<li class="mkdf-re-info-holder">
    <div>
        <?php esc_html_e('Bathrooms', 'mkdf-real-estate'); ?>
    </div>
    <?php foreach($added_properties as $property) { ?>
        <?php $value = get_post_meta($property, 'mkdf_property_bathrooms_meta', true); ?>
        <div>
            <?php echo esc_html($value); ?>
        </div>
    <?php } ?>
</li>