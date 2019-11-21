<?php
namespace MikadofRE\CPT\Property;

use MikadofRE\Lib\PostTypeInterface;

/**
 * Class PropertyRegister
 * @package MikadofRE\CPT\Property
 */
class PropertyRegister implements PostTypeInterface {
    /**
     * @var string
     */
    private $base;
    private $taxonomies;

    public function __construct() {
        $this->base = 'property';
        $this->taxonomies = $this->postTaxonomiesParams();

	    add_filter('archive_template', array($this, 'registerArchiveTemplate'));
        add_filter('single_template', array($this, 'registerSingleTemplate'));
    }

    /**
     * @return string
     */
    public function getBase() {
        return $this->base;
    }

    /**
     * @return string
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
	 * Registers property archive template if one does'nt exists in theme.
	 * Hooked to archive_template filter
	 * @param $archive string current template
	 * @return string string changed template
	 */
	public function registerArchiveTemplate($archive) {
		global $post;

		if(mkdf_re_real_estate_role_called()) {
            return MIKADO_RE_CPT_PATH . '/property/templates/archive-author.php';
        }

		if(isset($post) && $post->post_type == $this->base) {
			if(!file_exists(get_template_directory().'/archive-'.$this->base.'.php')) {
				return MIKADO_RE_CPT_PATH.'/property/templates/archive-'.$this->base.'.php';
			}
		}
		
		return $archive;
	}

    /**
     * Registers property single template if one does'nt exists in theme.
     * Hooked to single_template filter
     * @param $single string current template
     * @return string string changed template
     */
    public function registerSingleTemplate($single) {
        global $post;

        if(isset($post) && $post->post_type == $this->base) {
            if(!file_exists(get_template_directory().'/single-property.php')) {
                return MIKADO_RE_CPT_PATH.'/property/templates/single-'.$this->base.'.php';
            }
        }

        return $single;
    }

    /**
     * Registers custom post type with WordPress
     */
    private function registerPostType() {
        $menuPosition = 5;
        $menuIcon = 'dashicons-location';
        $slug = $this->base;

        if(mkdf_re_theme_installed()) {
            if ( zuhaus_mikado_options()->getOptionValue( 'property_single_slug' ) ) {
                $slug = zuhaus_mikado_options()->getOptionValue( 'property_single_slug' );
            }
        }

        register_post_type( $this->base,
            array(
                'labels' => array(
                    'name'          => esc_html__( 'Mikado Properties','mkdf-real-estate' ),
                    'singular_name' => esc_html__( 'Mikado Property','mkdf-real-estate' ),
                    'add_item'      => esc_html__( 'New Property','mkdf-real-estate' ),
                    'add_new_item'  => esc_html__( 'Add New Property','mkdf-real-estate' ),
                    'edit_item'     => esc_html__( 'Edit Property','mkdf-real-estate' )
                ),
                'public'        => true,
                'has_archive'   => true,
                'rewrite'       => array('slug' => $slug),
                'menu_position' => $menuPosition,
                'show_ui'       => true,
                'supports'      => array('author', 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes', 'comments'),
                'menu_icon'     =>  $menuIcon
            )
        );
    }

    private function registerTaxonomies() {
        foreach($this->taxonomies as $key=>$value) {
            $labels = array(
                'name'              => $value['plural_name'],
                'singular_name'     => sprintf( esc_html__( 'Property %s', 'mkdf-real-estate' ), $value['singular_name'] ),
                'search_items'      => sprintf( esc_html__( 'Search Property %s', 'mkdf-real-estate' ), $value['plural_name'] ),
                'all_items'         => sprintf( esc_html__( 'All Property %s', 'mkdf-real-estate' ), $value['plural_name'] ),
                'parent_item'       => sprintf( esc_html__( 'Parent Property %s', 'mkdf-real-estate' ), $value['singular_name'] ),
                'parent_item_colon' => sprintf( esc_html__( 'Parent Property %s:', 'mkdf-real-estate' ), $value['singular_name'] ),
                'edit_item'         => sprintf( esc_html__( 'Edit Property %s', 'mkdf-real-estate' ), $value['singular_name'] ),
                'update_item'       => sprintf( esc_html__( 'Update Property %s', 'mkdf-real-estate' ), $value['singular_name'] ),
                'add_new_item'      => sprintf( esc_html__( 'Add New Property %s', 'mkdf-real-estate' ), $value['singular_name'] ),
                'new_item_name'     => sprintf( esc_html__( 'New Property %s Name', 'mkdf-real-estate' ), $value['singular_name'] ),
                'not_found'         => sprintf( esc_html__( 'No Property %s Found', 'mkdf-real-estate' ), $value['plural_name'] ),
                'menu_name'         => sprintf( esc_html__( 'Property %s', 'mkdf-real-estate' ), $value['plural_name'] ),
            );

            $slug = $key;
            if(mkdf_re_theme_installed()) {
                if ( zuhaus_mikado_options()->getOptionValue( $value['underscore_name'] . '_slug' ) ) {
                    $slug = zuhaus_mikado_options()->getOptionValue( $value['underscore_name'] . '_slug'  );
                }
            }

            register_taxonomy($key, array($this->base), array(
                'hierarchical'      => $value['hierarchical'],
                'labels'            => $labels,
                'show_ui'           => true,
                'query_var'         => true,
                'show_admin_column' => true,
                'rewrite'           => array('slug' => $slug)
            ));
        }
    }

    private function postTaxonomiesParams() {
        $post_taxonomies = array();

        //Add type taxonomy
        $post_taxonomies['property-type'] = array(
            'singular_name' => esc_html__('Type', 'mkdf-real-estate'),
            'plural_name' => esc_html__('Types', 'mkdf-real-estate'),
            'underscore_name' => 'property_types',
            'hierarchical' => true
        );

        //Add feature taxonomy
        $post_taxonomies['property-feature'] = array(
            'singular_name' => esc_html__('Feature', 'mkdf-real-estate'),
            'plural_name' => esc_html__('Features', 'mkdf-real-estate'),
            'underscore_name' => 'property_features',
            'hierarchical' => true
        );

        //Add status taxonomy
        $post_taxonomies['property-status'] = array(
            'singular_name' => esc_html__('Status', 'mkdf-real-estate'),
            'plural_name' => esc_html__('Statuses', 'mkdf-real-estate'),
            'underscore_name' => 'property_status',
            'hierarchical' => true
        );

        //Add county taxonomy
        $post_taxonomies['property-county'] = array(
            'singular_name' => esc_html__('County/State', 'mkdf-real-estate'),
            'plural_name' => esc_html__('Counties/States', 'mkdf-real-estate'),
            'underscore_name' => 'property_county',
            'hierarchical' => true
        );

        //Add city taxonomy
        $post_taxonomies['property-city'] = array(
            'singular_name' => esc_html__('City', 'mkdf-real-estate'),
            'plural_name' => esc_html__('Cities', 'mkdf-real-estate'),
            'underscore_name' => 'property_city',
            'hierarchical' => true
        );

        //Add neighborhood taxonomy
        $post_taxonomies['property-neighborhood'] = array(
            'singular_name' => esc_html__('Neighborhood', 'mkdf-real-estate'),
            'plural_name' => esc_html__('Neighborhoods', 'mkdf-real-estate'),
            'underscore_name' => 'property_neighborhood',
            'hierarchical' => true
        );

        //Add tags taxonomy
        $post_taxonomies['property-tag'] = array(
            'singular_name' => esc_html__('Tag', 'mkdf-real-estate'),
            'plural_name' => esc_html__('Tags', 'mkdf-real-estate'),
            'underscore_name' => 'property_tags',
            'hierarchical' => false
        );

        $post_taxonomies = apply_filters('mkdf_re_filter_property_taxonomies_list', $post_taxonomies);

        return $post_taxonomies;
    }
}