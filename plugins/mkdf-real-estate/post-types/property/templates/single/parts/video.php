<?php
$has_video_link = get_post_meta(get_the_ID(), "mkdf_property_video_custom_meta", true) !== '' || get_post_meta(get_the_ID(), "mkdf_property_video_link_meta", true) !== '';

if ($has_video_link) {

    $video_type = get_post_meta( get_the_ID(), "mkdf_property_video_type_meta", true );
    if ( $video_type == 'social_networks' ) {
        $video_link = get_post_meta( get_the_ID(), "mkdf_property_video_link_meta", true );
    } else if ( $video_type == 'self' ) {
        $video_link = get_post_meta( get_the_ID(), "mkdf_property_video_custom_meta", true );
    }
    $video_image = get_post_meta( get_the_ID(), "mkdf_property_video_image_meta", true );
    $video_image_id = zuhaus_mikado_get_attachment_id_from_url($video_image);
    $video_button_params = array(
        'video_image' => $video_image_id,
        'video_link' => $video_link,
    );

?>
    <div class="mkdf-property-video mkdf-property-label-items-holder">
        <div class="mkdf-property-video-label mkdf-property-label-style">
            <h5>
                <?php esc_html_e('Property Video', 'mkdf-real-estate'); ?>
            </h5>
        </div>
        <div class="mkdf-property-video-items mkdf-property-items-style clearfix">
            <?php echo zuhaus_mikado_execute_shortcode('mkdf_video_button', $video_button_params); ?>
        </div>
    </div>
<?php } ?>