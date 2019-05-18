<?php
$id = isset($id) ? $id : get_the_ID();
$gallery_images = get_post_meta($id, 'mkdf_property_image_gallery', true);
$image_ids = explode(',', $gallery_images);

$params = array(
    'number-of-items' => '4',
    'enable-navigation' => 'no',
    'enable-pagination' => 'no',
    'enable-loop' => 'yes',
    'enable-auto-width' => 'yes',
    'enable-center' => 'no',
    'slider-animate-in' => 'fadeIn',
    'slider-animate-out' => 'fadeOut',
    'slider-speed-animation' => '500',
    'slider-speed' => '3000',
    'slider-margin' => '3',
    'enable-autoplay' => 'yes',
    'pretty_photo' => 'yes'
);
$dataString = '';
foreach ($params as $key => $value) {
    if($value !== '') {
        $new_key = str_replace( '_', '-', $key );

        $dataString .= ' data-'.$new_key.'="'.esc_attr($value).'"';
    }
}

if(is_array($image_ids) && count($image_ids)){ ?>
    <div class="mkdf-property-single-gallery-holder mkdf-owl-slider " <?php echo wp_kses($dataString, array('data')); ?> >
        <?php foreach($image_ids as $image_id){
            $img_url = wp_get_attachment_image_src($image_id, 'full');
            $img_desc = get_post_meta($image_id, '_wp_attachment_image_alt', true);
            if($img_url !== ''){ ?>
                <div class="mkdf-property-single-gallery-item">
                    <a itemprop="image" class="mkdf-property-single-lightbox" href="<?php echo esc_url($img_url[0])?>" data-rel="prettyPhoto[single_pretty_photo]">
                        <img src="<?php echo esc_url($img_url[0]); ?>" alt="<?php echo esc_attr($img_desc); ?>"/>
                    </a>
                </div>
            <?php }
        } ?>
    </div>
<?php }