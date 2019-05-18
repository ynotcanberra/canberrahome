<?php
$item_featured_value =  get_post_meta( get_the_ID(), 'mkdf_property_is_featured_meta', true);
$item_featured = ! empty( $item_featured_value ) && $item_featured_value === 'yes' ? true: false;
if($item_featured) {
?>
<div class="mkdf-item-featured">
    <i class="ion-flash" aria-hidden="true"></i>
</div>
<?php }
