<?php
$id = isset($id) ? $id : get_the_ID();
$slider_images = get_post_meta($id, 'mkdf_property_image_gallery', true);
$image_ids = explode(',', $slider_images);

if($slider_images !== '') :

    $slider_images_array = explode( ',', $slider_images );
    if ( isset( $slider_images_array ) && count( $slider_images_array ) ) : ?>
        <div class="mkdf-container">
            <div class="mkdf-container-inner clearfix">
                <div class="mkdf-owl-slider" data-enable-thumbnail='yes' data-enable-loop="no" >
                    <?php
                    for ( $i = 0; $i < count( $slider_images_array ); $i ++ ) : ?>
                        <?php if ( isset( $slider_images_array[ $i ] ) ) : ?>
                            <div class="mkdf-hotel-room-slider-item">
                                <a href="<?php echo wp_get_attachment_url( $slider_images_array[ $i ] ) ?>"
                                   data-rel="prettyPhoto[gallery_excerpt_pretty_photo]">
                                    <?php echo wp_get_attachment_image( $slider_images_array[ $i ], 'full' ); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                    <?php endfor; ?>
                </div>

                <ul class="mkdf-slider-thumbnail" data-thumbnail-count="<?php echo count( $slider_images_array )?>">
                    <?php
                    for ( $i = 0; $i < count( $slider_images_array ); $i ++ ) : ?>
                        <?php if ( isset( $slider_images_array[ $i ] ) ) : ?>
                            <li class="mkdf-slider-thumbnail-item">
                                <?php echo wp_get_attachment_image( $slider_images_array[ $i ], 'full' ); ?>
                            </li>
                        <?php endif; ?>
                    <?php endfor; ?>
                </ul>
            </div>
        </div>
    <?php endif; ?>
<?php endif; ?>