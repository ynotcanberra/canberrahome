<?php
$tags = mkdf_re_get_property_taxonomy('property-tag');
?>
<div class="mkdf-property-tags mkdf-property-label-items-holder">
    <div class="mkdf-property-tags-label mkdf-property-label-style">
        <h5>
            <?php esc_html_e('Property Tags', 'mkdf-real-estate'); ?>
        </h5>
    </div>
    <div class="mkdf-property-tags-items mkdf-property-items-style clearfix">
        <?php foreach($tags as $tag) { ?>
              <div class="mkdf-tag-item">
                  <a href="<?php echo get_term_link($tag->term_id); ?>" target="_self">
                    <?php echo esc_html($tag->name); ?>
                  </a>
              </div>
        <?php } ?>
    </div>
</div>