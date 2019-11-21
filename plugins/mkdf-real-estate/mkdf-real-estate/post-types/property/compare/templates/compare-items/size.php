<li class="mkdf-re-info-holder">
    <div>
        <?php esc_html_e('Size', 'mkdf-real-estate'); ?>
    </div>
    <?php foreach($added_properties as $property) { ?>
        <?php $value = get_post_meta($property, 'mkdf_property_size_meta', true); ?>
        <div>
            <?php echo mkdf_re_get_real_estate_size_html($value); ?>
        </div>
    <?php } ?>
</li>