<div class="mkdf-re-compare-popup">
    <div class="mkdf-re-popup-outer">
        <a class="mkdf-re-compare-popup-close" href="javascript:void(0)">
            <i class="icon-close"></i>
        </a>
        <div class="mkdf-re-popup-inner">
            <div class="mkdf-re-popup-items-holder">
                <?php if(isset($added_properties) && !empty($added_properties)) { ?>
                    <?php echo mkdf_re_get_compare_list_items_structured($added_properties); ?>
                <?php } else {
                    echo mkdf_re_cpt_single_module_template_part( 'compare/templates/parts/posts-not-found', 'property' );
                } ?>
            </div>
        </div>
    </div>
</div>