<div class="mkdf-property-enquiry-holder">
    <div class="mkdf-property-enquiry-inner">
        <a class="mkdf-property-enquiry-close">
            <?php echo zuhaus_mikado_icon_collections()->renderIcon( 'icon_close_alt', 'font_elegant' );?>
        </a>
        <form class="mkdf-property-enquiry-form mkdf-style-form" method="POST">

            <label><?php esc_html_e('Full Name', 'mkdf-real-estate'); ?></label>
            <input type="text" name="enquiry-name" id="enquiry-name" placeholder="<?php esc_html_e( 'Your Full Name', 'mkdf-real-estate' );?>" required pattern=".{6,}">
            <label><?php esc_html_e('E-mail Address', 'mkdf-real-estate'); ?></label>
            <input type="email" name="enquiry-email" id="enquiry-email" placeholder="<?php esc_html_e( 'Your E-mail Address', 'mkdf-real-estate' );?>" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$">
            <label><?php esc_html_e('Your Message', 'mkdf-real-estate'); ?></label>
            <textarea name="enquiry-message" id="enquiry-message" placeholder="<?php esc_html_e( 'Your Message', 'mkdf-real-estate' );?>" required></textarea>

            <?php echo zuhaus_mikado_get_button_html(array(
                'text' => esc_html__('Send Your Message', 'mkdf-real-estate'),
                'html_type' => 'button',
                'type' => 'solid',
                'custom_class' => 'mkdf-property-single-enquiry-submit'
            )); ?>

            <input type="hidden" id="property-item-id" value="<?php echo get_the_ID(); ?>">
            <?php wp_nonce_field('mkdf_re_validate_property_item_enquiry', 'mkdf_re_nonce_property_item_enquiry'); ?>
        </form>
        <div class="mkdf-property-enquiry-response"></div>
    </div>
</div>