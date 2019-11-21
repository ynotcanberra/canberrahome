<?php
$review_rating = mkdf_re_property_average_rating();
if($review_rating && !empty($review_rating)) {
?>
<span class="mkdf-property-stars">
    <?php
    for ( $i = 1; $i <= $review_rating; $i ++ ) { ?>
        <i class="fa fa-star" aria-hidden="true"></i>
    <?php } ?>
</span>
<?php } ?>