<?php
$show_related_posts = zuhaus_mikado_options()->getOptionValue('property_single_show_related') == 'yes' ? true : false;

//Get option for number of columns
$number_of_columns = 4;
$number_of_columns_option = zuhaus_mikado_options()->getOptionValue('real_estate_related_posts_number_of_columns');
if(!empty($number_of_columns_option)) {
    $number_of_columns = $number_of_columns_option;
}

//Get option for item space
$space_between_items = 'tiny';
$space_between_items_option = zuhaus_mikado_options()->getOptionValue('real_estate_related_posts_space_between_items');
if(!empty($space_between_items_option)) {
    $space_between_items = $space_between_items_option;
}

//Get option for image size
$image_size = 'full';
$image_size_option = zuhaus_mikado_options()->getOptionValue('real_estate_related_posts_image_size');
if(!empty($image_size_option)) {
    $image_size = $image_size_option;
}

//Get related posts
$post_id = get_the_ID();
$related_posts = mkdf_re_get_property_single_related_posts($post_id);
$related_posts_array = array();
if ( $related_posts && $related_posts->have_posts() ) :
    while ( $related_posts->have_posts() ) : $related_posts->the_post();
        $related_posts_array[] = get_the_ID();
    endwhile;
endif;
wp_reset_postdata();

$params = array(
    'type'                => 'gallery',
    'number_of_columns'   => $number_of_columns,
    'space_between_items' => $space_between_items,
    'image_proportions'   => $image_size,
    'selected_properties' => implode(',', $related_posts_array)
);

$html = zuhaus_mikado_execute_shortcode('mkdf_property_list', $params);
?>
<?php if($show_related_posts) { ?>
    <div class="mkdf-property-related-posts-holder">
        <div class="mkdf-property-related-posts-title">
            <h5><?php esc_html_e("Similar Properties", 'mkdf-real-estate'); ?></h5>
        </div>
        <div class="mkdf-property-related-posts">
            <?php print $html; ?>
        </div>
    </div>
<?php } ?>
