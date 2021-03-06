<?php
defined( 'ABSPATH' ) || exit();

class WC_Product_Package extends WC_Abstract_Legacy_Product {

    /**
     * BY MIKADO
     *
     * This is the name of this object type.
     * @var string
     */
    protected $object_type = 'package';

    /**
     * BY MIKADO
     *
     * Post type.
     * @var string
     */
    protected $post_type = 'package';

    /**
     * BY MIKADO
     *
     * Cache group.
     * @var string
     */
    protected $cache_group = 'package';

    /**
     * Stores product data.
     *
     * @var array
     */
    protected $data = array(
        'name'               => '',
        'slug'               => '',
        'date_created'       => null,
        'date_modified'      => null,
        'status'             => false,
        'featured'           => false,
        'catalog_visibility' => 'visible',
        'description'        => '',
        'short_description'  => '',
        'sku'                => '',
        'price'              => '',
        'regular_price'      => '',
        'sale_price'         => '',
        'date_on_sale_from'  => null,
        'date_on_sale_to'    => null,
        'total_sales'        => '0',
        'tax_status'         => 'taxable',
        'tax_class'          => '',
        'manage_stock'       => false,
        'stock_quantity'     => null,
        'stock_status'       => 'instock',
        'backorders'         => 'no',
        'sold_individually'  => true,  /* BY MIKADO */
        'weight'             => '',
        'length'             => '',
        'width'              => '',
        'height'             => '',
        'upsell_ids'         => array(),
        'cross_sell_ids'     => array(),
        'parent_id'          => 0,
        'reviews_allowed'    => true,
        'purchase_note'      => '',
        'attributes'         => array(),
        'default_attributes' => array(),
        'menu_order'         => 0,
        'virtual'            => false,
        'downloadable'       => false,
        'category_ids'       => array(),
        'tag_ids'            => array(),
        'shipping_class_id'  => 0,
        'downloads'          => array(),
        'image_id'           => '',
        'gallery_image_ids'  => array(),
        'download_limit'     => -1,
        'download_expiry'    => -1,
        'rating_counts'      => array(),
        'average_rating'     => 0,
        'review_count'       => 0,
    );

    /**
     * Supported features such as 'ajax_add_to_cart'.
     *
     * @var array
     */
    protected $supports = array();

    /**
     * Get the product if ID is passed, otherwise the product is new and empty.
     * This class should NOT be instantiated, but the wc_get_product() function
     * should be used. It is possible, but the wc_get_product() is preferred.
     *
     * @param int|WC_Product|object $product Product to init.
     */
    public function __construct( $product = 0 ) {
        parent::__construct( $product );
        if ( is_numeric( $product ) && $product > 0 ) {
            $this->set_id( $product );
        } elseif ( $product instanceof self ) {
            $this->set_id( absint( $product->get_id() ) );
        } elseif ( ! empty( $product->ID ) ) {
            $this->set_id( absint( $product->ID ) );
        } else {
            $this->set_object_read( true );
        }

        /* BY MIKADO */
        $this->data_store = WC_Data_Store::load( 'package' );
        if ( $this->get_id() > 0 ) {
            $this->data_store->read( $this );
        }
    }

    /**
     * BY MIKADO
     *
     * Get internal type. Should return string and *should be overridden* by child classes.
     *
     * The product_type property is deprecated but is used here for BW compat with child classes which may be defining product_type and not have a get_type method.
     *
     * @since 3.0.0
     * @return string
     */
    public function get_type() {
        return isset( $this->product_type ) ? $this->product_type : 'package';
    }

    /**
     * BY MIKADO
     *
     * Get product name.
     *
     * @since 3.0.0
     * @param  string $context
     * @return string
     */
    public function get_name( $context = 'view' ) {
        return get_the_title($this->get_id());
    }

    /**
     * Get product slug.
     *
     * @since 3.0.0
     * @param  string $context
     * @return string
     */
    public function get_slug( $context = 'view' ) {
        return $this->get_prop( 'slug', $context );
    }

    /**
     * Get product created date.
     *
     * @since 3.0.0
     * @param  string $context
     * @return WC_DateTime|NULL object if the date is set or null if there is no date.
     */
    public function get_date_created( $context = 'view' ) {
        return $this->get_prop( 'date_created', $context );
    }

    /**
     * Get product modified date.
     *
     * @since 3.0.0
     * @param  string $context
     * @return WC_DateTime|NULL object if the date is set or null if there is no date.
     */
    public function get_date_modified( $context = 'view' ) {
        return $this->get_prop( 'date_modified', $context );
    }

    /**
     * Get product status.
     *
     * @since 3.0.0
     * @param  string $context
     * @return string
     */
    public function get_status( $context = 'view' ) {
        return $this->get_prop( 'status', $context );
    }

    /**
     * If the product is featured.
     *
     * @since 3.0.0
     * @param  string $context
     * @return boolean
     */
    public function get_featured( $context = 'view' ) {
        return $this->get_prop( 'featured', $context );
    }

    /**
     * Get catalog visibility.
     *
     * @since 3.0.0
     * @param  string $context
     * @return string
     */
    public function get_catalog_visibility( $context = 'view' ) {
        return $this->get_prop( 'catalog_visibility', $context );
    }

    /**
     * Get product description.
     *
     * @since 3.0.0
     * @param  string $context
     * @return string
     */
    public function get_description( $context = 'view' ) {
        return $this->get_prop( 'description', $context );
    }

    /**
     * Get product short description.
     *
     * @since 3.0.0
     * @param  string $context
     * @return string
     */
    public function get_short_description( $context = 'view' ) {
        return $this->get_prop( 'short_description', $context );
    }

    /**
     * Get SKU (Stock-keeping unit) - product unique ID.
     *
     * @param  string $context
     * @return string
     */
    public function get_sku( $context = 'view' ) {
        return $this->get_prop( 'sku', $context );
    }

    /**
     * BY MIKADO
     *
     * Returns the product's active price.
     *
     * @param  string $context
     * @return string price
     */
    public function get_price( $context = 'view' ) {
        return mkdf_re_calculate_package_price($this->get_id());
    }

    /**
     * Returns the product's regular price.
     *
     * @param  string $context
     * @return string price
     */
    public function get_regular_price( $context = 'view' ) {
        return $this->get_prop( 'regular_price', $context );
    }

    /**
     * Returns the product's sale price.
     *
     * @param  string $context
     * @return string price
     */
    public function get_sale_price( $context = 'view' ) {
        return $this->get_prop( 'sale_price', $context );
    }

    /**
     * Get date on sale from.
     *
     * @since 3.0.0
     * @param  string $context
     * @return WC_DateTime|NULL object if the date is set or null if there is no date.
     */
    public function get_date_on_sale_from( $context = 'view' ) {
        return $this->get_prop( 'date_on_sale_from', $context );
    }

    /**
     * Get date on sale to.
     *
     * @since 3.0.0
     * @param  string $context
     * @return WC_DateTime|NULL object if the date is set or null if there is no date.
     */
    public function get_date_on_sale_to( $context = 'view' ) {
        return $this->get_prop( 'date_on_sale_to', $context );
    }

    /**
     * Get number total of sales.
     *
     * @since 3.0.0
     * @param  string $context
     * @return int
     */
    public function get_total_sales( $context = 'view' ) {
        return $this->get_prop( 'total_sales', $context );
    }

    /**
     * Returns the tax status.
     *
     * @param  string $context
     * @return string
     */
    public function get_tax_status( $context = 'view' ) {
        return $this->get_prop( 'tax_status', $context );
    }

    /**
     * Returns the tax class.
     *
     * @param  string $context
     * @return string
     */
    public function get_tax_class( $context = 'view' ) {
        return $this->get_prop( 'tax_class', $context );
    }

    /**
     * Return if product manage stock.
     *
     * @since 3.0.0
     * @param  string $context
     * @return boolean
     */
    public function get_manage_stock( $context = 'view' ) {
        return $this->get_prop( 'manage_stock', $context );
    }

    /**
     * Returns number of items available for sale.
     *
     * @param  string $context
     * @return int|null
     */
    public function get_stock_quantity( $context = 'view' ) {
        return $this->get_prop( 'stock_quantity', $context );
    }

    /**
     * Return the stock status.
     *
     * @param  string $context
     * @since 3.0.0
     * @return string
     */
    public function get_stock_status( $context = 'view' ) {
        return $this->get_prop( 'stock_status', $context );
    }

    /**
     * Get backorders.
     *
     * @param  string $context
     * @since 3.0.0
     * @return string yes no or notify
     */
    public function get_backorders( $context = 'view' ) {
        return $this->get_prop( 'backorders', $context );
    }

    /**
     * Return if should be sold individually.
     *
     * @param  string $context
     * @since 3.0.0
     * @return boolean
     */
    public function get_sold_individually( $context = 'view' ) {
        return $this->get_prop( 'sold_individually', $context );
    }

    /**
     * Returns the product's weight.
     *
     * @param  string $context
     * @return string
     */
    public function get_weight( $context = 'view' ) {
        return $this->get_prop( 'weight', $context );
    }

    /**
     * Returns the product length.
     *
     * @param  string $context
     * @return string
     */
    public function get_length( $context = 'view' ) {
        return $this->get_prop( 'length', $context );
    }

    /**
     * Returns the product width.
     *
     * @param  string $context
     * @return string
     */
    public function get_width( $context = 'view' ) {
        return $this->get_prop( 'width', $context );
    }

    /**
     * Returns the product height.
     *
     * @param  string $context
     * @return string
     */
    public function get_height( $context = 'view' ) {
        return $this->get_prop( 'height', $context );
    }

    /**
     * Returns formatted dimensions.
     *
     * @param  $formatted True by default for legacy support - will be false/not set in future versions to return the array only. Use wc_format_dimensions for formatted versions instead.
     * @return string|array
     */
    public function get_dimensions( $formatted = true ) {
        if ( $formatted ) {
            wc_deprecated_argument( 'WC_Product::get_dimensions', '3.0', 'By default, get_dimensions has an argument set to true so that HTML is returned. This is to support the legacy version of the method. To get HTML dimensions, instead use wc_format_dimensions() function. Pass false to this method to return an array of dimensions. This will be the new default behavior in future versions.' );
            return apply_filters( 'mkdf_re_package_product_dimensions', wc_format_dimensions( $this->get_dimensions( false ) ), $this );
        }
        return array(
            'length' => $this->get_length(),
            'width'  => $this->get_width(),
            'height' => $this->get_height(),
        );
    }

    /**
     * Get upsel IDs.
     *
     * @since 3.0.0
     * @param  string $context
     * @return array
     */
    public function get_upsell_ids( $context = 'view' ) {
        return $this->get_prop( 'upsell_ids', $context );
    }

    /**
     * Get cross sell IDs.
     *
     * @since 3.0.0
     * @param  string $context
     * @return array
     */
    public function get_cross_sell_ids( $context = 'view' ) {
        return $this->get_prop( 'cross_sell_ids', $context );
    }

    /**
     * Get parent ID.
     *
     * @since 3.0.0
     * @param  string $context
     * @return int
     */
    public function get_parent_id( $context = 'view' ) {
        return $this->get_prop( 'parent_id', $context );
    }

    /**
     * Return if reviews is allowed.
     *
     * @since 3.0.0
     * @param  string $context
     * @return bool
     */
    public function get_reviews_allowed( $context = 'view' ) {
        return $this->get_prop( 'reviews_allowed', $context );
    }

    /**
     * Get purchase note.
     *
     * @since 3.0.0
     * @param  string $context
     * @return string
     */
    public function get_purchase_note( $context = 'view' ) {
        return $this->get_prop( 'purchase_note', $context );
    }

    /**
     * Returns product attributes.
     *
     * @param  string $context
     * @return array
     */
    public function get_attributes( $context = 'view' ) {
        return $this->get_prop( 'attributes', $context );
    }

    /**
     * Get default attributes.
     *
     * @since 3.0.0
     * @param  string $context
     * @return array
     */
    public function get_default_attributes( $context = 'view' ) {
        return $this->get_prop( 'default_attributes', $context );
    }

    /**
     * Get menu order.
     *
     * @since 3.0.0
     * @param  string $context
     * @return int
     */
    public function get_menu_order( $context = 'view' ) {
        return $this->get_prop( 'menu_order', $context );
    }

    /**
     * Get category ids.
     *
     * @since 3.0.0
     * @param  string $context
     * @return array
     */
    public function get_category_ids( $context = 'view' ) {
        return $this->get_prop( 'category_ids', $context );
    }

    /**
     * Get tag ids.
     *
     * @since 3.0.0
     * @param  string $context
     * @return array
     */
    public function get_tag_ids( $context = 'view' ) {
        return $this->get_prop( 'tag_ids', $context );
    }

    /**
     * Get virtual.
     *
     * @since 3.0.0
     * @param  string $context
     * @return bool
     */
    public function get_virtual( $context = 'view' ) {
        return $this->get_prop( 'virtual', $context );
    }

    /**
     * Returns the gallery attachment ids.
     *
     * @param  string $context
     * @return array
     */
    public function get_gallery_image_ids( $context = 'view' ) {
        return $this->get_prop( 'gallery_image_ids', $context );
    }

    /**
     * Get shipping class ID.
     *
     * @since 3.0.0
     * @param  string $context
     * @return int
     */
    public function get_shipping_class_id( $context = 'view' ) {
        return $this->get_prop( 'shipping_class_id', $context );
    }

    /**
     * Get downloads.
     *
     * @since 3.0.0
     * @param  string $context
     * @return array
     */
    public function get_downloads( $context = 'view' ) {
        return $this->get_prop( 'downloads', $context );
    }

    /**
     * Get download expiry.
     *
     * @since 3.0.0
     * @param  string $context
     * @return int
     */
    public function get_download_expiry( $context = 'view' ) {
        return $this->get_prop( 'download_expiry', $context );
    }

    /**
     * Get downloadable.
     *
     * @since 3.0.0
     * @param  string $context
     * @return bool
     */
    public function get_downloadable( $context = 'view' ) {
        return $this->get_prop( 'downloadable', $context );
    }

    /**
     * Get download limit.
     *
     * @since 3.0.0
     * @param  string $context
     * @return int
     */
    public function get_download_limit( $context = 'view' ) {
        return $this->get_prop( 'download_limit', $context );
    }

    /**
     * Get main image ID.
     *
     * @since 3.0.0
     * @param  string $context
     * @return string
     */
    public function get_image_id( $context = 'view' ) {
        return $this->get_prop( 'image_id', $context );
    }

    /**
     * Get rating count.
     * @param  string $context
     * @return array of counts
     */
    public function get_rating_counts( $context = 'view' ) {
        return $this->get_prop( 'rating_counts', $context );
    }

    /**
     * Get average rating.
     * @param  string $context
     * @return float
     */
    public function get_average_rating( $context = 'view' ) {
        return $this->get_prop( 'average_rating', $context );
    }

    /**
     * Get review count.
     * @param  string $context
     * @return int
     */
    public function get_review_count( $context = 'view' ) {
        return $this->get_prop( 'review_count', $context );
    }

    /*
    |--------------------------------------------------------------------------
    | Setters
    |--------------------------------------------------------------------------
    |
    | Functions for setting product data. These should not update anything in the
    | database itself and should only change what is stored in the class
    | object.
    */

    /**
     * BY MIKADO
     *
     * Set product name.
     *
     * @since 3.0.0
     * @param string $name Product name.
     */
    public function set_name( $name ) {
        $this->set_prop( 'name', get_the_title($this->get_id()) );
    }

    /**
     * Set product slug.
     *
     * @since 3.0.0
     * @param string $slug Product slug.
     */
    public function set_slug( $slug ) {
        $this->set_prop( 'slug', $slug );
    }

    /**
     * Set product created date.
     *
     * @since 3.0.0
     * @param string|integer|null $date UTC timestamp, or ISO 8601 DateTime. If the DateTime string has no timezone or offset, WordPress site timezone will be assumed. Null if their is no date.
     */
    public function set_date_created( $date = null ) {
        $this->set_date_prop( 'date_created', $date );
    }

    /**
     * Set product modified date.
     *
     * @since 3.0.0
     * @param string|integer|null $date UTC timestamp, or ISO 8601 DateTime. If the DateTime string has no timezone or offset, WordPress site timezone will be assumed. Null if their is no date.
     */
    public function set_date_modified( $date = null ) {
        $this->set_date_prop( 'date_modified', $date );
    }

    /**
     * Set product status.
     *
     * @since 3.0.0
     * @param string $status Product status.
     */
    public function set_status( $status ) {
        $this->set_prop( 'status', $status );
    }

    /**
     * Set if the product is featured.
     *
     * @since 3.0.0
     * @param bool|string
     */
    public function set_featured( $featured ) {
        $this->set_prop( 'featured', wc_string_to_bool( $featured ) );
    }

    /**
     * Set catalog visibility.
     *
     * @since 3.0.0
     * @throws WC_Data_Exception
     * @param string $visibility Options: 'hidden', 'visible', 'search' and 'catalog'.
     */
    public function set_catalog_visibility( $visibility ) {
        $options = array_keys( wc_get_product_visibility_options() );
        if ( ! in_array( $visibility, $options, true ) ) {
            $this->error( 'product_invalid_catalog_visibility', __( 'Invalid catalog visibility option.', 'mkdf-real-estate' ) );
        }
        $this->set_prop( 'catalog_visibility', $visibility );
    }

    /**
     * Set product description.
     *
     * @since 3.0.0
     * @param string $description Product description.
     */
    public function set_description( $description ) {
        $this->set_prop( 'description', $description );
    }

    /**
     * Set product short description.
     *
     * @since 3.0.0
     * @param string $short_description Product short description.
     */
    public function set_short_description( $short_description ) {
        $this->set_prop( 'short_description', $short_description );
    }

    /**
     * Set SKU.
     *
     * @since 3.0.0
     * @throws WC_Data_Exception
     * @param string $sku Product SKU.
     */
    public function set_sku( $sku ) {
        $sku = (string) $sku;
        if ( $this->get_object_read() && ! empty( $sku ) && ! wc_product_has_unique_sku( $this->get_id(), $sku ) ) {
            $sku_found = wc_get_product_id_by_sku( $sku );

            $this->error( 'product_invalid_sku', __( 'Invalid or duplicated SKU.', 'mkdf-real-estate' ), 400, array( 'resource_id' => $sku_found ) );
        }
        $this->set_prop( 'sku', $sku );
    }

    /**
     * BY MIKADO
     *
     * Set the product's active price.
     *
     * @param string $price Price.
     */
    public function set_price( $price ) {
        $this->set_prop( 'price', mkdf_re_calculate_package_price($this->get_id()) );
    }

    /**
     * Set the product's regular price.
     *
     * @since 3.0.0
     * @param string $price Regular price.
     */
    public function set_regular_price( $price ) {
        $this->set_prop( 'regular_price', wc_format_decimal( $price ) );
    }

    /**
     * Set the product's sale price.
     *
     * @since 3.0.0
     * @param string $price sale price.
     */
    public function set_sale_price( $price ) {
        $this->set_prop( 'sale_price', wc_format_decimal( $price ) );
    }

    /**
     * Set date on sale from.
     *
     * @since 3.0.0
     * @param string|integer|null $date UTC timestamp, or ISO 8601 DateTime. If the DateTime string has no timezone or offset, WordPress site timezone will be assumed. Null if their is no date.
     */
    public function set_date_on_sale_from( $date = null ) {
        $this->set_date_prop( 'date_on_sale_from', $date );
    }

    /**
     * Set date on sale to.
     *
     * @since 3.0.0
     * @param string|integer|null $date UTC timestamp, or ISO 8601 DateTime. If the DateTime string has no timezone or offset, WordPress site timezone will be assumed. Null if their is no date.
     */
    public function set_date_on_sale_to( $date = null ) {
        $this->set_date_prop( 'date_on_sale_to', $date );
    }

    /**
     * Set number total of sales.
     *
     * @since 3.0.0
     * @param int $total Total of sales.
     */
    public function set_total_sales( $total ) {
        $this->set_prop( 'total_sales', absint( $total ) );
    }

    /**
     * Set the tax status.
     *
     * @since 3.0.0
     * @throws WC_Data_Exception
     * @param string $status Tax status.
     */
    public function set_tax_status( $status ) {
        $options = array(
            'taxable',
            'shipping',
            'none',
        );

        // Set default if empty.
        if ( empty( $status ) ) {
            $status = 'taxable';
        }

        if ( ! in_array( $status, $options, true ) ) {
            $this->error( 'product_invalid_tax_status', __( 'Invalid product tax status.', 'mkdf-real-estate' ) );
        }

        $this->set_prop( 'tax_status', $status );
    }

    /**
     * Set the tax class.
     *
     * @since 3.0.0
     * @param string $class Tax class.
     */
    public function set_tax_class( $class ) {
        $class       = sanitize_title( $class );
        $class       = 'standard' === $class ? '' : $class;
        $this->set_prop( 'tax_class', $class );
    }

    /**
     * Set if product manage stock.
     *
     * @since 3.0.0
     * @param bool
     */
    public function set_manage_stock( $manage_stock ) {
        $this->set_prop( 'manage_stock', wc_string_to_bool( $manage_stock ) );
    }

    /**
     * Set number of items available for sale.
     *
     * @since 3.0.0
     * @param float|null $quantity Stock quantity.
     */
    public function set_stock_quantity( $quantity ) {
        $this->set_prop( 'stock_quantity', '' !== $quantity ? wc_stock_amount( $quantity ) : null );
    }

    /**
     * Set stock status.
     *
     * @param string $status New status.
     */
    public function set_stock_status( $status = '' ) {
        $this->set_prop( 'stock_status', 'outofstock' === $status ? 'outofstock' : 'instock' );
    }

    /**
     * Set backorders.
     *
     * @since 3.0.0
     * @param string $backorders Options: 'yes', 'no' or 'notify'.
     */
    public function set_backorders( $backorders ) {
        $this->set_prop( 'backorders', $backorders );
    }

    /**
     * Set if should be sold individually.
     *
     * @since 3.0.0
     * @param bool
     */
    public function set_sold_individually( $sold_individually ) {
        $this->set_prop( 'sold_individually', wc_string_to_bool( $sold_individually ) );
    }

    /**
     * Set the product's weight.
     *
     * @since 3.0.0
     * @param float|string $weight Total weight.
     */
    public function set_weight( $weight ) {
        $this->set_prop( 'weight', '' === $weight ? '' : wc_format_decimal( $weight ) );
    }

    /**
     * Set the product length.
     *
     * @since 3.0.0
     * @param float|string $length Total length.
     */
    public function set_length( $length ) {
        $this->set_prop( 'length', '' === $length ? '' : wc_format_decimal( $length ) );
    }

    /**
     * Set the product width.
     *
     * @since 3.0.0
     * @param float|string $width Total width.
     */
    public function set_width( $width ) {
        $this->set_prop( 'width', '' === $width ? '' : wc_format_decimal( $width ) );
    }

    /**
     * Set the product height.
     *
     * @since 3.0.0
     * @param float|string $height Total height.
     */
    public function set_height( $height ) {
        $this->set_prop( 'height', '' === $height ? '' : wc_format_decimal( $height ) );
    }

    /**
     * Set upsell IDs.
     *
     * @since 3.0.0
     * @param array $upsell_ids IDs from the up-sell products.
     */
    public function set_upsell_ids( $upsell_ids ) {
        $this->set_prop( 'upsell_ids', array_filter( (array) $upsell_ids ) );
    }

    /**
     * Set crosssell IDs.
     *
     * @since 3.0.0
     * @param array $cross_sell_ids IDs from the cross-sell products.
     */
    public function set_cross_sell_ids( $cross_sell_ids ) {
        $this->set_prop( 'cross_sell_ids', array_filter( (array) $cross_sell_ids ) );
    }

    /**
     * Set parent ID.
     *
     * @since 3.0.0
     * @param int $parent_id Product parent ID.
     */
    public function set_parent_id( $parent_id ) {
        $this->set_prop( 'parent_id', absint( $parent_id ) );
    }

    /**
     * Set if reviews is allowed.
     *
     * @since 3.0.0
     * @param bool $reviews_allowed Reviews allowed or not.
     */
    public function set_reviews_allowed( $reviews_allowed ) {
        $this->set_prop( 'reviews_allowed', wc_string_to_bool( $reviews_allowed ) );
    }

    /**
     * Set purchase note.
     *
     * @since 3.0.0
     * @param string $purchase_note Purchase note.
     */
    public function set_purchase_note( $purchase_note ) {
        $this->set_prop( 'purchase_note', $purchase_note );
    }

    /**
     * Set product attributes.
     *
     * Attributes are made up of:
     * 		id - 0 for product level attributes. ID for global attributes.
     * 		name - Attribute name.
     * 		options - attribute value or array of term ids/names.
     * 		position - integer sort order.
     * 		visible - If visible on frontend.
     * 		variation - If used for variations.
     * 	Indexed by unqiue key to allow clearing old ones after a set.
     *
     * @since 3.0.0
     * @param array $raw_attributes Array of WC_Product_Attribute objects.
     */
    public function set_attributes( $raw_attributes ) {
        $attributes = array_fill_keys( array_keys( $this->get_attributes( 'edit' ) ), null );
        foreach ( $raw_attributes as $attribute ) {
            if ( is_a( $attribute, 'WC_Product_Attribute' ) ) {
                $attributes[ sanitize_title( $attribute->get_name() ) ] = $attribute;
            }
        }

        uasort( $attributes, 'wc_product_attribute_uasort_comparison' );
        $this->set_prop( 'attributes', $attributes );
    }

    /**
     * Set default attributes.
     *
     * @since 3.0.0
     * @param array $default_attributes List of default attributes.
     */
    public function set_default_attributes( $default_attributes ) {
        $this->set_prop( 'default_attributes', array_filter( (array) $default_attributes ) );
    }

    /**
     * Set menu order.
     *
     * @since 3.0.0
     * @param int $menu_order Menu order.
     */
    public function set_menu_order( $menu_order ) {
        $this->set_prop( 'menu_order', intval( $menu_order ) );
    }

    /**
     * Set the product categories.
     *
     * @since 3.0.0
     * @param array $term_ids List of terms IDs.
     */
    public function set_category_ids( $term_ids ) {
        $this->set_prop( 'category_ids', array_unique( array_map( 'intval', $term_ids ) ) );
    }

    /**
     * Set the product tags.
     *
     * @since 3.0.0
     * @param array $term_ids List of terms IDs.
     */
    public function set_tag_ids( $term_ids ) {
        $this->set_prop( 'tag_ids', array_unique( array_map( 'intval', $term_ids ) ) );
    }

    /**
     * Set if the product is virtual.
     *
     * @since 3.0.0
     * @param bool|string
     */
    public function set_virtual( $virtual ) {
        $this->set_prop( 'virtual', wc_string_to_bool( $virtual ) );
    }

    /**
     * Set shipping class ID.
     *
     * @since 3.0.0
     * @param int
     */
    public function set_shipping_class_id( $id ) {
        $this->set_prop( 'shipping_class_id', absint( $id ) );
    }

    /**
     * Set if the product is downloadable.
     *
     * @since 3.0.0
     * @param bool|string
     */
    public function set_downloadable( $downloadable ) {
        $this->set_prop( 'downloadable', wc_string_to_bool( $downloadable ) );
    }

    /**
     * Set downloads.
     *
     * @since 3.0.0
     * @param $downloads_array array of WC_Product_Download objects or arrays.
     */
    public function set_downloads( $downloads_array ) {
        $downloads = array();
        $errors    = array();

        foreach ( $downloads_array as $download ) {
            if ( is_a( $download, 'WC_Product_Download' ) ) {
                $download_object = $download;
            } else {
                $download_object           = new WC_Product_Download();
                $download['previous_hash'] = isset( $download['previous_hash'] ) ? $download['previous_hash'] : '';
                $file_hash                 = apply_filters( 'mkdf_re_package_downloadable_file_hash', md5( $download['file'] ), $this->get_id(), $download['name'], $download['file'], $download['previous_hash'] );

                $download_object->set_id( $file_hash );
                $download_object->set_name( $download['name'] );
                $download_object->set_file( $download['file'] );
                $download_object->set_previous_hash( $download['previous_hash'] );
            }

            // Validate the file extension
            if ( ! $download_object->is_allowed_filetype() ) {
                $errors[] = sprintf( __( 'The downloadable file %1$s cannot be used as it does not have an allowed file type. Allowed types include: %2$s', 'mkdf-real-estate' ), '<code>' . basename( $download_object->get_file() ) . '</code>', '<code>' . implode( ', ', array_keys( $download_object->get_allowed_mime_types() ) ) . '</code>' );
                continue;
            }

            // Validate the file exists.
            if ( ! $download_object->file_exists() ) {
                $errors[] = sprintf( __( 'The downloadable file %s cannot be used as it does not exist on the server.', 'mkdf-real-estate' ), '<code>' . $download_object->get_file() . '</code>' );
                continue;
            }

            $downloads[ $download_object->get_id() ] = $download_object;
        }

        if ( $errors ) {
            $this->error( 'product_invalid_download', $errors[0] );
        }

        $this->set_prop( 'downloads', $downloads );
    }

    /**
     * Set download limit.
     *
     * @since 3.0.0
     * @param int $download_limit
     */
    public function set_download_limit( $download_limit ) {
        $this->set_prop( 'download_limit', -1 === (int) $download_limit || '' === $download_limit ? -1 : absint( $download_limit ) );
    }

    /**
     * Set download expiry.
     *
     * @since 3.0.0
     * @param int $download_expiry
     */
    public function set_download_expiry( $download_expiry ) {
        $this->set_prop( 'download_expiry', -1 === (int) $download_expiry || '' === $download_expiry ? -1 : absint( $download_expiry ) );
    }

    /**
     * Set gallery attachment ids.
     *
     * @since 3.0.0
     * @param array $image_ids
     */
    public function set_gallery_image_ids( $image_ids ) {
        $image_ids = wp_parse_id_list( $image_ids );

        if ( $this->get_object_read() ) {
            $image_ids = array_filter( $image_ids, 'wp_attachment_is_image' );
        }

        $this->set_prop( 'gallery_image_ids', $image_ids );
    }

    /**
     * Set main image ID.
     *
     * @since 3.0.0
     * @param int $image_id
     */
    public function set_image_id( $image_id = '' ) {
        $this->set_prop( 'image_id', $image_id );
    }

    /**
     * Set rating counts. Read only.
     * @param array $counts
     */
    public function set_rating_counts( $counts ) {
        $this->set_prop( 'rating_counts', array_filter( array_map( 'absint', (array) $counts ) ) );
    }

    /**
     * Set average rating. Read only.
     * @param float $average
     */
    public function set_average_rating( $average ) {
        $this->set_prop( 'average_rating', wc_format_decimal( $average ) );
    }

    /**
     * Set review count. Read only.
     * @param int $count
     */
    public function set_review_count( $count ) {
        $this->set_prop( 'review_count', absint( $count ) );
    }

    /*
	|--------------------------------------------------------------------------
	| Other Methods
	|--------------------------------------------------------------------------
	*/

    /**
     * Ensure properties are set correctly before save.
     * @since 3.0.0
     */
    public function validate_props() {
        // Before updating, ensure stock props are all aligned. Qty and backorders are not needed if not stock managed.
        if ( ! $this->get_manage_stock() ) {
            $this->set_stock_quantity( '' );
            $this->set_backorders( 'no' );

            // If we are stock managing and we don't have stock, force out of stock status.
        } elseif ( $this->get_stock_quantity() <= get_option( 'mkdf_re_package_notify_no_stock_amount' ) && 'no' === $this->get_backorders() ) {
            $this->set_stock_status( 'outofstock' );

            // If the stock level is changing and we do now have enough, force in stock status.
        } elseif ( $this->get_stock_quantity() > get_option( 'mkdf_re_package_notify_no_stock_amount' ) && array_key_exists( 'stock_quantity', $this->get_changes() ) ) {
            $this->set_stock_status( 'instock' );
        }
    }

    /**
     * Save data (either create or update depending on if we are working on an existing product).
     *
     * @since 3.0.0
     */
    public function save() {
        $this->validate_props();

        if ( $this->data_store ) {
            // Trigger action before saving to the DB. Use a pointer to adjust object props before save.
            do_action( 'mkdf_re_package_before_' . $this->object_type . '_object_save', $this, $this->data_store );

            if ( $this->get_id() ) {
                $this->data_store->update( $this );
            } else {
                $this->data_store->create( $this );
            }
            if ( $this->get_parent_id() ) {
                wp_schedule_single_event( time(), 'mkdf_re_package_deferred_product_sync', array( 'product_id' => $this->get_parent_id() ) );
            }
            return $this->get_id();
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Conditionals
    |--------------------------------------------------------------------------
    */

    /**
     * BY MIKADO
     *
     * Check if a product supports a given feature.
     *
     * Product classes should override this to declare support (or lack of support) for a feature.
     *
     * @param string $feature string The name of a feature to test support for.
     * @return bool True if the product supports the feature, false otherwise.
     * @since 2.5.0
     */
    public function supports( $feature ) {
        return apply_filters( 'mkdf_re_package_product_supports', in_array( $feature, $this->supports ) ? true : false, $feature, $this );
    }

    /**
     * BY MIKADO
     *
     * Returns whether or not the product post exists.
     *
     * @return bool
     */
    public function exists() {
        return $this->get_id() > 0 && 'package' === get_post_type( absint( $this->get_id() ) );
    }

    /**
     * Checks the product type.
     *
     * Backwards compat with downloadable/virtual.
     *
     * @param string $type Array or string of types
     * @return bool
     */
    public function is_type( $type ) {
        return ( $this->get_type() === $type || ( is_array( $type ) && in_array( $this->get_type(), $type ) ) );
    }

    /**
     * BY MIKADO
     *
     * Checks if a product is downloadable.
     *
     * @return bool
     */
    public function is_downloadable() {
        return apply_filters( 'mkdf_re_package_is_downloadable', true === $this->get_downloadable(), $this );
    }

    /**
     * BY MIKADO
     *
     * Checks if a product is virtual (has no shipping).
     *
     * @return bool
     */
    public function is_virtual() {
        return apply_filters( 'mkdf_re_package_is_virtual', true === $this->get_virtual(), $this );
    }

    /**
     * Returns whether or not the product is featured.
     *
     * @return bool
     */
    public function is_featured() {
        return true === $this->get_featured();
    }

    /**
     * BY MIKADO
     *
     * Check if a product is sold individually (no quantities).
     *
     * @return bool
     */
    public function is_sold_individually() {
        return apply_filters( 'mkdf_re_package_is_sold_individually', true === $this->get_sold_individually(), $this );
    }

    /**
     * Returns whether or not the product is visible in the catalog.
     *
     * @return bool
     */
    public function is_visible() {
        $visible = 'visible' === $this->get_catalog_visibility() || ( is_search() && 'search' === $this->get_catalog_visibility() ) || ( ! is_search() && 'catalog' === $this->get_catalog_visibility() );

        if ( 'publish' !== $this->get_status() && ! current_user_can( 'edit_post', $this->get_id() ) ) {
            $visible = false;
        }

        if ( 'yes' === get_option( 'mkdf_re_package_hide_out_of_stock_items' ) && ! $this->is_in_stock() ) {
            $visible = false;
        }

        return apply_filters( 'mkdf_re_package_is_visible', $visible, $this->get_id() );
    }

    /**
     * BY MIKADO
     *
     * Returns false if the product cannot be bought.
     *
     * @return bool
     */
    public function is_purchasable() {
        return apply_filters( 'mkdf_re_package_is_purchasable', $this->exists(), $this );
    }

    /**
     * Returns whether or not the product is on sale.
     *
     * @param  string $context What the value is for. Valid values are view and edit.
     * @return bool
     */
    public function is_on_sale( $context = 'view' ) {
        if ( '' !== (string) $this->get_sale_price( $context ) && $this->get_regular_price( $context ) > $this->get_sale_price( $context ) ) {
            $on_sale = true;

            if ( $this->get_date_on_sale_from( $context ) && $this->get_date_on_sale_from( $context )->getTimestamp() > time() ) {
                $on_sale = false;
            }

            if ( $this->get_date_on_sale_to( $context ) && $this->get_date_on_sale_to( $context )->getTimestamp() < time() ) {
                $on_sale = false;
            }
        } else {
            $on_sale = false;
        }
        return 'view' === $context ? apply_filters( 'mkdf_re_package_is_on_sale', $on_sale, $this ) : $on_sale;
    }

    /**
     * Returns whether or not the product has dimensions set.
     *
     * @return bool
     */
    public function has_dimensions() {
        return ( $this->get_length() || $this->get_height() || $this->get_width() ) && ! $this->get_virtual();
    }

    /**
     * Returns whether or not the product has weight set.
     *
     * @return bool
     */
    public function has_weight() {
        return $this->get_weight() && ! $this->get_virtual();
    }

    /**
     * BY MIKADO
     *
     * Returns whether or not the product is in stock.
     *
     * @return bool
     */
    public function is_in_stock() {
        return apply_filters( 'mkdf_re_package_is_in_stock', 'instock' === $this->get_stock_status(), $this );
    }

    /**
     * BY MIKADO
     *
     * Checks if a product needs shipping.
     *
     * @return bool
     */
    public function needs_shipping() {
        return false;
    }

    /**
     * BY MIKADO
     *
     * Returns whether or not the product is taxable.
     *
     * @return bool
     */
    public function is_taxable() {
        return false;
    }

    /**
     * BY MIKADO
     *
     * Returns whether or not the product shipping is taxable.
     *
     * @return bool
     */
    public function is_shipping_taxable() {
        return false;
    }

    /**
     * BY MIKADO
     *
     * Returns whether or not the product is stock managed.
     *
     * @return bool
     */
    public function managing_stock() {
        return false;
    }

    /**
     * BY MIKADO
     *
     * Returns whether or not the product can be backordered.
     *
     * @return bool
     */
    public function backorders_allowed() {
        return false;
    }

    /**
     * BY MIKADO
     *
     * Returns whether or not the product needs to notify the customer on backorder.
     *
     * @return bool
     */
    public function backorders_require_notification() {
        return false;
    }

    /**
     * BY MIKADO
     *
     * Check if a product is on backorder.
     *
     * @param int $qty_in_cart (default: 0)
     * @return bool
     */
    public function is_on_backorder( $qty_in_cart = 0 ) {
        return false;
    }

    /**
     * BY MIKADO
     *
     * Returns whether or not the product has enough stock for the order.
     *
     * @param mixed $quantity
     * @return bool
     */
    public function has_enough_stock( $quantity ) {
        return true;
    }

    /**
     * Returns whether or not the product has any visible attributes.
     *
     * @return boolean
     */
    public function has_attributes() {
        foreach ( $this->get_attributes() as $attribute ) {
            if ( $attribute->get_visible() ) {
                return true;
            }
        }
        return false;
    }

    /**
     * Returns whether or not the product has any child product.
     *
     * @return bool
     */
    public function has_child() {
        return 0 < count( $this->get_children() );
    }

    /**
     * Does a child have dimensions?
     *
     * @since 3.0.0
     * @return bool
     */
    public function child_has_dimensions() {
        return false;
    }

    /**
     * Does a child have a weight?
     *
     * @since 3.0.0
     * @return boolean
     */
    public function child_has_weight() {
        return false;
    }

    /**
     * Check if downloadable product has a file attached.
     *
     * @since 1.6.2
     *
     * @param string $download_id file identifier
     * @return bool Whether downloadable product has a file attached.
     */
    public function has_file( $download_id = '' ) {
        return $this->is_downloadable() && $this->get_file( $download_id );
    }

    /**
     * Returns whether or not the product has additonal options that need
     * selecting before adding to cart.
     *
     * @since  3.0.0
     * @return boolean
     */
    public function has_options() {
        return false;
    }

    /*
    |--------------------------------------------------------------------------
    | Non-CRUD Getters
    |--------------------------------------------------------------------------
    */

    /**
     * BY MIKADO
     *
     * Get the product's title. For products this is the product name.
     *
     * @return string
     */
    public function get_title() {
        return get_the_title($this->get_id());
    }

    /**
     * BY MIKADO
     *
     * Product permalink.
     * @return string
     */
    public function get_permalink() {
        return get_permalink( $this->get_id() );
    }

    /**
     * Returns the children IDs if applicable. Overridden by child classes.
     *
     * @return array of IDs
     */
    public function get_children() {
        return array();
    }

    /**
     * If the stock level comes from another product ID, this should be modified.
     * @since  3.0.0
     * @return int
     */
    public function get_stock_managed_by_id() {
        return $this->get_id();
    }

    /**
     * BY MIKADO
     *
     * Returns the price in html format.
     * @return string
     */
    public function get_price_html( $deprecated = '' ) {
        if ( '' === $this->get_price() ) {
            return apply_filters( 'mkdf_re_package_empty_price_html', '', $this );
        }

        if ( $this->is_on_sale() ) {
            $price = wc_format_sale_price( wc_get_price_to_display( $this, array( 'price' => $this->get_regular_price() ) ), wc_get_price_to_display( $this ) ) . $this->get_price_suffix();
        } else {
            $price = wc_price( wc_get_price_to_display( $this ) ) . $this->get_price_suffix();
        }

        return apply_filters( 'mkdf_re_package_get_price_html', $price, $this );
    }

    /**
     * Get product name with SKU or ID. Used within admin.
     *
     * @return string Formatted product name
     */
    public function get_formatted_name() {
        if ( $this->get_sku() ) {
            $identifier = $this->get_sku();
        } else {
            $identifier = '#' . $this->get_id();
        }
        return sprintf( '%2$s (%1$s)', $identifier, $this->get_name() );
    }

    /**
     * Get min quantity which can be purchased at once.
     *
     * @since  3.0.0
     * @return int
     */
    public function get_min_purchase_quantity() {
        return 1;
    }

    /**
     * Get max quantity which can be purchased at once.
     *
     * @since  3.0.0
     * @return int Quantity or -1 if unlimited.
     */
    public function get_max_purchase_quantity() {
        return $this->is_sold_individually() ? 1 : ( $this->backorders_allowed() || ! $this->get_manage_stock() ? -1 : $this->get_stock_quantity() );
    }

    /**
     * BY MIKADO
     *
     * Get the add to url used mainly in loops.
     *
     * @return string
     */
    public function add_to_cart_url() {
        return apply_filters( 'mkdf_re_package_add_to_cart_url', $this->get_permalink(), $this );
    }

    /**
     * BY MIKADO
     *
     * Get the add to cart button text for the single page.
     *
     * @return string
     */
    public function single_add_to_cart_text() {
        return apply_filters( 'mkdf_re_package_single_add_to_cart_text', __( 'Add to cart', 'mkdf-real-estate' ), $this );
    }

    /**
     * BY MIKADO
     *
     * Get the add to cart button text.
     *
     * @return string
     */
    public function add_to_cart_text() {
        return apply_filters( 'mkdf_re_package_product_add_to_cart_text', __( 'Read more', 'mkdf-real-estate' ), $this );
    }

    /**
     * Returns the main product image.
     *
     * @param string $size (default: 'shop_thumbnail')
     * @param array $attr
     * @param bool True to return $placeholder if no image is found, or false to return an empty string.
     * @return string
     */
    public function get_image( $size = 'shop_thumbnail', $attr = array(), $placeholder = true ) {
        if ( has_post_thumbnail( $this->get_id() ) ) {
            $image = get_the_post_thumbnail( $this->get_id(), $size, $attr );
        } elseif ( ( $parent_id = wp_get_post_parent_id( $this->get_id() ) ) && has_post_thumbnail( $parent_id ) ) {
            $image = get_the_post_thumbnail( $parent_id, $size, $attr );
        } elseif ( $placeholder ) {
            $image = wc_placeholder_img( $size );
        } else {
            $image = '';
        }
        return str_replace( array( 'https://', 'http://' ), '//', $image );
    }

    /**
     * Returns the product shipping class SLUG.
     *
     * @return string
     */
    public function get_shipping_class() {
        return '';
    }

    /**
     * Returns a single product attribute as a string.
     * @param  string $attribute to get.
     * @return string
     */
    public function get_attribute( $attribute ) {
        $attributes = $this->get_attributes();
        $attribute  = sanitize_title( $attribute );

        if ( isset( $attributes[ $attribute ] ) ) {
            $attribute_object = $attributes[ $attribute ];
        } elseif ( isset( $attributes[ 'pa_' . $attribute ] ) ) {
            $attribute_object = $attributes[ 'pa_' . $attribute ];
        } else {
            return '';
        }
        return $attribute_object->is_taxonomy() ? implode( ', ', wc_get_product_terms( $this->get_id(), $attribute_object->get_name(), array( 'fields' => 'names' ) ) ) : wc_implode_text_attributes( $attribute_object->get_options() );
    }

    /**
     * Get the total amount (COUNT) of ratings, or just the count for one rating e.g. number of 5 star ratings.
     * @param  int $value Optional. Rating value to get the count for. By default returns the count of all rating values.
     * @return int
     */
    public function get_rating_count( $value = null ) {
        $counts = $this->get_rating_counts();

        if ( is_null( $value ) ) {
            return array_sum( $counts );
        } elseif ( isset( $counts[ $value ] ) ) {
            return absint( $counts[ $value ] );
        } else {
            return 0;
        }
    }

    /**
     * BY MIKADO
     *
     * Get a file by $download_id.
     *
     * @param string $download_id file identifier
     * @return array|false if not found
     */
    public function get_file( $download_id = '' ) {
        $files = $this->get_downloads();

        if ( '' === $download_id ) {
            $file = sizeof( $files ) ? current( $files ) : false;
        } elseif ( isset( $files[ $download_id ] ) ) {
            $file = $files[ $download_id ];
        } else {
            $file = false;
        }

        return apply_filters( 'mkdf_re_package_product_file', $file, $this, $download_id );
    }

    /**
     * BY MIKADO
     *
     * Get file download path identified by $download_id.
     *
     * @param string $download_id file identifier
     * @return string
     */
    public function get_file_download_path( $download_id ) {
        $files     = $this->get_downloads();
        $file_path = isset( $files[ $download_id ] ) ? $files[ $download_id ]->get_file() : '';

        // allow overriding based on the particular file being requested
        return apply_filters( 'mkdf_re_package_product_file_download_path', $file_path, $this, $download_id );
    }

    /**
     * BY MIKADO
     *
     * Get the suffix to display after prices > 0.
     *
     * @param  string  $price to calculate, left blank to just use get_price()
     * @param  integer $qty   passed on to get_price_including_tax() or get_price_excluding_tax()
     * @return string
     */
    public function get_price_suffix( $price = '', $qty = 1 ) {
        $html = '';

        if ( ( $suffix = get_option( 'mkdf_re_package_price_display_suffix' ) ) && wc_tax_enabled() && 'taxable' === $this->get_tax_status() ) {
            if ( '' === $price ) {
                $price = $this->get_price();
            }
            $replacements = array(
                '{price_including_tax}' => wc_price( wc_get_price_including_tax( $this, array( 'qty' => $qty, 'price' => $price ) ) ),
                '{price_excluding_tax}' => wc_price( wc_get_price_excluding_tax( $this, array( 'qty' => $qty, 'price' => $price ) ) ),
            );
            $html = str_replace( array_keys( $replacements ), array_values( $replacements ), ' <small class="woocommerce-price-suffix">' . wp_kses_post( $suffix ) . '</small>' );
        }
        return apply_filters( 'mkdf_re_package_get_price_suffix', $html, $this, $price, $qty );
    }

    /**
     * Returns the availability of the product.
     *
     * @return string
     */
    public function get_availability() {
        return apply_filters( 'mkdf_re_package_get_availability', array(
            'availability' => $this->get_availability_text(),
            'class'        => $this->get_availability_class(),
        ), $this );
    }

    /**
     * BY MIKADO
     *
     * Get availability text based on stock status.
     *
     * @return string
     */
    protected function get_availability_text() {
        if ( ! $this->is_in_stock() ) {
            $availability = __( 'Out of stock', 'mkdf-real-estate' );
        } elseif ( $this->managing_stock() && $this->is_on_backorder( 1 ) ) {
            $availability = __( 'Available on backorder', 'mkdf-real-estate' );
        } elseif ( $this->managing_stock() ) {
            $availability = wc_format_stock_for_display( $this );
        } else {
            $availability = '';
        }
        return apply_filters( 'mkdf_re_package_get_availability_text', $availability, $this );
    }

    /**
     * BY MIKADO
     *
     * Get availability classname based on stock status.
     *
     * @return string
     */
    protected function get_availability_class() {
        if ( ! $this->is_in_stock() ) {
            $class = 'out-of-stock';
        } elseif ( $this->managing_stock() && $this->is_on_backorder( 1 ) ) {
            $class = 'available-on-backorder';
        } else {
            $class = 'in-stock';
        }
        return apply_filters( 'mkdf_re_package_get_availability_class', $class, $this );
    }

}