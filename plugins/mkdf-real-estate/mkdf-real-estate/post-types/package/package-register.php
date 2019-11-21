<?php
namespace MikadofRE\CPT\Package;

use MikadofRE\Lib\PostTypeInterface;

/**
 * Class PackageRegister
 * @package MikadofRE\CPT\Package
 */
class PackageRegister implements PostTypeInterface {
    /**
     * @var string
     */
    private $base;
    private $taxonomies;

    public function __construct() {
        $this->base     = 'package';
        $this->taxonomies  = $this->postTaxonomiesParams();
    }

    /**
     * @return string
     */
    public function getBase() {
        return $this->base;
    }

    /**
     * @return array
     */
    public function getTaxonomies() {
        return $this->taxonomies;
    }

    /**
     * Registers custom post type with WordPress
     */
    public function register() {
        $this->registerPostType();
        $this->registerTaxonomies();
    }


    /**
     * Registers custom post type with WordPress
     */
    private function registerPostType() {
        $menuPosition = 5;
        $menuIcon = 'dashicons-media-text';
        $slug = $this->base;

        register_post_type( $this->base,
            array(
                'labels' => array(
                    'name'          => esc_html__( 'Mikado Pricing Packages','mkdf-real-estate' ),
                    'singular_name' => esc_html__( 'Mikado Pricing Package','mkdf-real-estate' ),
                    'add_item'      => esc_html__( 'New Pricing Package','mkdf-real-estate' ),
                    'add_new_item'  => esc_html__( 'Add New Pricing Package','mkdf-real-estate' ),
                    'edit_item'     => esc_html__( 'Edit Pricing Package','mkdf-real-estate' )
                ),
                'public'        => true,
                'has_archive'   => false,
                'rewrite'       => array('slug' => $slug),
                'menu_position' => $menuPosition,
                'show_ui'       => true,
                'supports'      => array('author', 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes', 'comments'),
                'menu_icon'     =>  $menuIcon,
                'exclude_from_search' => true,
                'show_in_admin_bar'   => false,
                'show_in_nav_menus'   => false,
                'publicly_queryable'  => false,
                'query_var'           => false
            )
        );
    }

    private function registerTaxonomies() {
        foreach($this->taxonomies as $key=>$value) {
            $labels = array(
                'name'              => $value['plural_name'],
                'singular_name'     => sprintf( esc_html__( '%s', 'mkdf-real-estate' ), $value['singular_name'] ),
                'search_items'      => sprintf( esc_html__( 'Search %s', 'mkdf-real-estate' ), $value['plural_name'] ),
                'all_items'         => sprintf( esc_html__( 'All %s', 'mkdf-real-estate' ), $value['plural_name'] ),
                'parent_item'       => sprintf( esc_html__( 'Parent %s', 'mkdf-real-estate' ), $value['singular_name'] ),
                'parent_item_colon' => sprintf( esc_html__( 'Parent %s:', 'mkdf-real-estate' ), $value['singular_name'] ),
                'edit_item'         => sprintf( esc_html__( 'Edit %s', 'mkdf-real-estate' ), $value['singular_name'] ),
                'update_item'       => sprintf( esc_html__( 'Update %s', 'mkdf-real-estate' ), $value['singular_name'] ),
                'add_new_item'      => sprintf( esc_html__( 'Add New %s', 'mkdf-real-estate' ), $value['singular_name'] ),
                'new_item_name'     => sprintf( esc_html__( 'New %s Name', 'mkdf-real-estate' ), $value['singular_name'] ),
                'not_found'         => sprintf( esc_html__( 'No %s Found', 'mkdf-real-estate' ), $value['plural_name'] ),
                'menu_name'         => sprintf( esc_html__( '%s', 'mkdf-real-estate' ), $value['plural_name'] ),
            );

            $slug = $key;

            register_taxonomy($key, array($this->base), array(
                'hierarchical'      => $value['hierarchical'],
                'labels'            => $labels,
                'show_ui'           => true,
                'query_var'         => false,
                'show_admin_column' => true,
                'rewrite'           => array('slug' => $slug),
            ));
        }
    }

    private function postTaxonomiesParams() {
        $post_taxonomies = array();

        //Add type taxonomy
        $post_taxonomies['package-category'] = array(
            'singular_name' => esc_html__('Category', 'mkdf-real-estate'),
            'plural_name' => esc_html__('Categories', 'mkdf-real-estate'),
            'underscore_name' => 'property_categories',
            'hierarchical' => true
        );

        return $post_taxonomies;
    }
}