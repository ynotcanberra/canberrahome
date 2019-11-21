<?php

if ( ! function_exists( 'mkdf_re_statistics_menu' ) ) {
    /**
     * Function that generates admin menu for lms post types.
     */
    function mkdf_re_statistics_menu() {
        if ( mkdf_re_theme_installed() ) {
            global $zuhaus_mikado_Framework;

            $page_hook_suffix = add_menu_page(
                'Mikado Statistics',      // The value used to populate the browser's title bar when the menu page is active
                'Mikado Statistics',      // The text of the menu in the administrator's sidebar
                'administrator',        // What roles are able to access the menu
                'mkdf_re_stats_menu',  // The ID used to bind submenu items to this menu
                'mkdf_re_statistics_page',                     // The callback function used to render this menu
                $zuhaus_mikado_Framework->getSkin()->getSkinURI() . '/assets/img/admin-logo-icon.png', // Icon For menu Item
                10                // Position
            );

            add_action( 'admin_print_scripts-' . $page_hook_suffix, 'zuhaus_mikado_enqueue_admin_scripts' );
            add_action( 'admin_print_styles-' . $page_hook_suffix, 'zuhaus_mikado_enqueue_admin_styles' );
        }
    }

    add_action( 'admin_menu', 'mkdf_re_statistics_menu' );
}

if(!function_exists('mkdf_re_statistics_page')) {
    function mkdf_re_statistics_page() {
        $params = array();
        $links = array();

        $link = array();
        $link['name'] = esc_html__('Most Viewed', 'mkdf-real-estate');
        $link['url'] = menu_page_url('users_most_viewed', false);
        $links[] = $link;

        $link = array();
        $link['name'] = esc_html__('Most Favorite', 'mkdf-real-estate');
        $link['url'] = menu_page_url('users_most_favorite', false);
        $links[] = $link;

        $link = array();
        $link['name'] = esc_html__('Saved Searches', 'mkdf-real-estate');
        $link['url'] = menu_page_url('users_saved_searches', false);
        $links[] = $link;

        $params['links'] = $links;

        echo mkdf_re_get_module_template_part( 'statistics/templates/statistics', '', $params );
    }
}

if ( ! function_exists( 'mkdf_re_update_property_count_views' ) ) {
    function mkdf_re_update_property_count_views() {
        $post_ID = get_the_ID();
        $user_ID = get_current_user_id();

        if ( is_singular( 'property' ) ) {
            if ( isset( $_COOKIE[ 'mkdf-re-property-views_' . $post_ID ] ) ) {
                setcookie( 'mkdf-re-property-views_' . $post_ID, $post_ID, time() * 20, '/' );
                return;
            } else {
                //Update post views
                $count = get_post_meta( $post_ID, 'mkdf_count_property_views_meta', true );
                if ( $count == '' ) {
                    $count = 1;
                } else {
                    $count ++;
                }
                update_post_meta( $post_ID, 'mkdf_count_property_views_meta', $count );

                //Add item to user views
                $user_views = get_user_meta( $user_ID, 'mkdf_user_property_views_meta', true );
                if(empty($user_views)) {
                    $user_views = array();
                    $user_views[] = $post_ID;
                } else {
                    if(!in_array($post_ID, $user_views)) {
                        $user_views[] = $post_ID;
                    }
                }
                update_user_meta($user_ID, 'mkdf_user_property_views_meta', $user_views);

                setcookie( 'mkdf-re-property-views_' . $post_ID, $post_ID, intval(time() * 20), '/' );
            }
        }
    }

    add_action( 'wp', 'mkdf_re_update_property_count_views' );
}

if ( ! function_exists( 'mkdf_re_update_property_daily_views' ) ) {
    function mkdf_re_update_property_daily_views() {
        $post_ID = get_the_ID();

        if ( is_singular( 'property' ) ) {
            if ( isset( $_COOKIE[ 'mkdf-re-property-daily_' . $post_ID ] ) ) {
                return;
            } else {
                $today = date('m-d-Y', time());
                $views_by_day = get_post_meta( $post_ID, 'mkdf_count_property_views_by_day_meta', true );

                if(!empty($views_by_day)) {
                    if(!isset($views_by_day[$today]) || empty ($views_by_day[$today])) {
                        $views_by_day[$today] = 1;
                    } else {
                        $views = (int) $views_by_day[$today];
                        $views_by_day[$today] = $views + 1;
                    }
                } else {
                    $views_by_day = array();
                    $views_by_day[$today] = 1;
                }
                update_post_meta( $post_ID, 'mkdf_count_property_views_by_day_meta', $views_by_day );
                setcookie( 'mkdf-re-property-daily_' . $post_ID, $post_ID, strtotime('today 23:59'), '/' );
            }
        }
    }

    add_action( 'wp', 'mkdf_re_update_property_daily_views' );
}

if ( ! function_exists( 'mkdf_re_get_property_count_views' ) ) {
    function mkdf_re_get_property_count_views( $post_ID = '' ) {
        if ( $post_ID == '' ) {
            $post_ID = get_the_ID();
        }

        $count = get_post_meta( $post_ID, 'mkdf_count_property_views_meta', true );

        if ( $count === '' ) {
            update_post_meta( $post_ID, 'mkdf_count_post_views_meta', '0' );
            return 0;
        }

        return $count;
    }
}

if ( ! function_exists( 'mkdf_re_get_user_recent_views' ) ) {
    function mkdf_re_get_user_recent_views() {
        $recent_views = get_user_meta(get_current_user_id(), 'mkdf_user_property_views_meta', true);

        return $recent_views;
    }
}

//Most viewed functions
if(!function_exists('mkdf_re_add_most_viewed_statistics')) {
    function mkdf_re_add_most_viewed_statistics() {
        add_submenu_page(
            'mkdf_re_stats_menu',
            esc_html__('Most Viewed', 'mkdf-real-estate'),
            esc_html__('Most Viewed', 'mkdf-real-estate'),
            'administrator',
            'users_most_viewed',
            'mkdf_re_users_most_viewed'
        );
    }

    add_action('admin_menu', 'mkdf_re_add_most_viewed_statistics', 11);
}

if(!function_exists('mkdf_re_users_most_viewed')) {
    function mkdf_re_users_most_viewed() {
        $params = array();

        $posts = array();
        $query = new WP_Query(array(
            'post_type' => 'property',
            'post_status' => 'publish'
        ));

        if($query->have_posts()) {
            while($query->have_posts()) {
                $query->the_post();
                $post = array();
                $post['id'] = get_the_ID();
                $post['propertyID'] = get_post_meta(get_the_ID(), 'mkdf_property_id_meta', true);
                $post['title'] = get_the_title();
                $post['image'] = get_the_post_thumbnail(get_the_ID(), array(50,50));

                $cities = mkdf_re_get_property_taxonomy('property-city');
                if(isset($cities) && is_array($cities)) {
                    $cities_names = array();
                    foreach($cities as $city) {
                        $cities_names[] = $city->name;
                    }
                    $cities = implode(', ', $cities_names);
                } else {
                    $cities = '';
                }
                $post['city'] = $cities;

                $statuses = mkdf_re_get_property_taxonomy('property-status');
                if(isset($statuses) && is_array($statuses)) {
                    $statuses_names = array();
                    foreach($statuses as $status) {
                        $statuses_names[] = $status->name;
                    }
                    $statuses = implode(', ', $statuses_names);
                } else {
                    $statuses = '';
                }
                $post['status'] = $statuses;

                $types = mkdf_re_get_property_taxonomy('property-type');
                if(isset($types) && is_array($types)) {
                    $types_names = array();
                    foreach($types as $type) {
                        $types_names[] = $type->name;
                    }
                    $types = implode(', ', $types_names);
                } else {
                    $types = '';
                }
                $post['type'] = $types;

                $post['price'] = mkdf_re_get_real_estate_item_price();
                $post['views'] = get_post_meta(get_the_ID(), 'mkdf_count_property_views_meta', true);
                $post['view_link'] =  get_the_permalink();
                $post['edit_link'] =  admin_url('post.php?post=' . get_the_ID() . '&action=edit');

                $posts[] = $post;
            }
        }

        wp_reset_query();

        $params['posts'] = $posts;

        echo mkdf_re_get_module_template_part( 'statistics/templates/most-viewed', '', $params );
    }
}

//Most favorite functions
if(!function_exists('mkdf_re_add_most_favorite_statistics')) {
    function mkdf_re_add_most_favorite_statistics() {
        add_submenu_page(
            'mkdf_re_stats_menu',
            esc_html__('Most Favorite', 'mkdf-real-estate'),
            esc_html__('Most Favorite', 'mkdf-real-estate'),
            'administrator',
            'users_most_favorite',
            'mkdf_re_users_most_favorite'
        );
    }

    add_action('admin_menu', 'mkdf_re_add_most_favorite_statistics', 12);
}

if(!function_exists('mkdf_re_users_most_favorite')) {
    function mkdf_re_users_most_favorite() {
        $params = array();

        $posts = array();
        $query = new WP_Query(array(
            'post_type' => 'property',
            'post_status' => 'publish'
        ));

        if($query->have_posts()) {
            while($query->have_posts()) {
                $query->the_post();
                $post = array();
                $post['id'] = get_the_ID();
                $post['propertyID'] = get_post_meta(get_the_ID(), 'mkdf_property_id_meta', true);
                $post['title'] = get_the_title();
                $post['image'] = get_the_post_thumbnail(get_the_ID(), array(50,50));

                $cities = mkdf_re_get_property_taxonomy('property-city');
                if(isset($cities) && is_array($cities)) {
                    $cities_names = array();
                    foreach($cities as $city) {
                        $cities_names[] = $city->name;
                    }
                    $cities = implode(', ', $cities_names);
                } else {
                    $cities = '';
                }
                $post['city'] = $cities;

                $statuses = mkdf_re_get_property_taxonomy('property-status');
                if(isset($statuses) && is_array($statuses)) {
                    $statuses_names = array();
                    foreach($statuses as $status) {
                        $statuses_names[] = $status->name;
                    }
                    $statuses = implode(', ', $statuses_names);
                } else {
                    $statuses = '';
                }
                $post['status'] = $statuses;

                $types = mkdf_re_get_property_taxonomy('property-type');
                if(isset($types) && is_array($types)) {
                    $types_names = array();
                    foreach($types as $type) {
                        $types_names[] = $type->name;
                    }
                    $types = implode(', ', $types_names);
                } else {
                    $types = '';
                }
                $post['type'] = $types;

                $post['price'] = mkdf_re_get_real_estate_item_price();

                $favorites = get_post_meta(get_the_ID(), 'mkdf_users_wishlist', true);
                if(isset($favorites) & is_array($favorites)) {
                    $favorites = count($favorites);
                } else {
                    $favorites = 0;
                }
                $post['favorites'] = $favorites;
                $post['view_link'] =  get_the_permalink();
                $post['edit_link'] =  admin_url('post.php?post=' . get_the_ID() . '&action=edit');

                $posts[] = $post;
            }
        }

        wp_reset_query();

        $params['posts'] = $posts;

        echo mkdf_re_get_module_template_part( 'statistics/templates/most-favorite', '', $params );
    }
}

//Saved searches functions
if(!function_exists('mkdf_re_add_saved_searches_statistics')) {
    function mkdf_re_add_saved_searches_statistics() {
        add_submenu_page(
            'mkdf_re_stats_menu',
            esc_html__('Saved Searches', 'mkdf-real-estate'),
            esc_html__('Saved Searches', 'mkdf-real-estate'),
            'administrator',
            'users_saved_searches',
            'mkdf_re_users_saved_searches'
        );
    }

    add_action('admin_menu', 'mkdf_re_add_saved_searches_statistics', 13);
}

if(!function_exists('mkdf_re_users_saved_searches')) {
    function mkdf_re_users_saved_searches() {
        $params = array();

        $users = get_users();
        if(!empty($users) && is_array($users)) {
            $searches = array();
            foreach ($users as $user) {
                $saved_searches = get_user_meta($user->ID, 'mkdf_user_saved_queries', true);
                if(!empty($saved_searches) && is_array($saved_searches)) {
                    foreach($saved_searches as $saved_search) {
                        $searches[] = $saved_search;
                    }
                }
            }
            $params['searches'] = $searches;
        }

        echo mkdf_re_get_module_template_part( 'statistics/templates/saved-searches', '', $params );
    }
}