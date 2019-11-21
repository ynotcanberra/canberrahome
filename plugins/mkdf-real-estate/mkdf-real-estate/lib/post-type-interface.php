<?php
namespace MikadofRE\Lib;

/**
 * interface PostTypeInterface
 * @package MikadofRE\Lib;
 */
interface PostTypeInterface {
    /**
     * @return string
     */
    public function getBase();

    /**
     * @return array
     */
    public function getTaxonomies();

    /**
     * Registers custom post type with WordPress
     */
    public function register();
}