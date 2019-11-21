<?php
$blog_single_navigation = zuhaus_mikado_options()->getOptionValue('blog_single_navigation') === 'no' ? false : true;
$blog_navigation_through_same_category = zuhaus_mikado_options()->getOptionValue('blog_navigation_through_same_category') === 'no' ? false : true;
?>
<?php if($blog_single_navigation){ ?>
	<div class="mkdf-blog-single-navigation">
		<div class="mkdf-blog-single-navigation-inner clearfix">
            <?php
                /* Single navigation section - SETTING PARAMS */
                $post_navigation = array(
                    'prev' => array(
                        'label' => '<span class="mkdf-blog-single-nav-label">'.esc_html__('Previous post', 'zuhaus').'</span>'
                    ),
                    'next' => array(
                        'label' => '<span class="mkdf-blog-single-nav-label">'.esc_html__('Next post', 'zuhaus').'</span>'
                    )
                );

                if($blog_navigation_through_same_category){
                    if(get_previous_post(true) !== ""){
                        $post_navigation['prev']['post'] = get_previous_post(true);
                    }
                    if(get_next_post(true) !== ""){
                        $post_navigation['next']['post'] = get_next_post(true);
                    }
                } else {
                    if(get_previous_post() !== ""){
                        $post_navigation['prev']['post'] = get_previous_post();
                    }
                    if(get_next_post() !== ""){
                        $post_navigation['next']['post'] = get_next_post();
                    }
                }

                /* Single navigation section - RENDERING */
                foreach (array('prev', 'next') as $nav_type) {
                    if (isset($post_navigation[$nav_type]['post'])) { ?>
                        <?php $mkdf_nav_class = get_the_post_thumbnail($post_navigation[$nav_type]['post']->ID) == '' ? 'mkdf-no-nav-image' : '';  ?>
                        <div class="mkdf-blog-single-nav-wrapper">
                            <a itemprop="url" class="mkdf-blog-single-<?php echo esc_attr($nav_type); ?>  <?php echo esc_attr($mkdf_nav_class); ?>" href="<?php echo get_permalink($post_navigation[$nav_type]['post']->ID); ?>">
                                <?php if($nav_type == 'prev') { ?>
                                <span class="mkdf-blog-single-nav-image">
                                    <?php echo get_the_post_thumbnail($post_navigation[$nav_type]['post']->ID, 'zuhaus_mikado_square'); ?>
                                </span>
                                <?php } ?>
                                <span class="mkdf-blog-single-nav-text">
                                    <?php echo wp_kses($post_navigation[$nav_type]['label'], array('span' => array('class' => true))); ?>
                                    <span class="mkdf-blog-single-nav-title">
                                        <?php echo the_title_attribute(array('post' => $post_navigation[$nav_type]['post']->ID)); ?>
                                    </span>
                                </span>
                                <?php if($nav_type == 'next') { ?>
                                    <span class="mkdf-blog-single-nav-image">
                                    <?php echo get_the_post_thumbnail($post_navigation[$nav_type]['post']->ID, 'zuhaus_mikado_square'); ?>
                                </span>
                                <?php } ?>
                            </a>
                        </div>
                    <?php }
                }
            ?>
		</div>
	</div>
<?php } ?>