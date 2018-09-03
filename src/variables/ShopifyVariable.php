<?php
/**
 * Shopify plugin for Craft CMS 3.x
 *
 * A toolset to integrate Craft with Shopify
 *
 * @link      https://superbig.co
 * @copyright Copyright (c) 2018 Superbig
 */

namespace superbig\shopify\variables;

use superbig\shopify\Shopify;

use Craft;

/**
 * @author    Superbig
 * @package   Shopify
 * @since     1.0.0
 */
class ShopifyVariable
{
    // Public Methods
    // =========================================================================

    /**
     * @param array $options
     *
     * @return mixed
     */
    public function getProducts($options = [])
    {
        return Shopify::$plugin->productService->getProducts($options);
    }

    public function getProduct($id = null)
    {
        return Shopify::$plugin->productService->getProduct($id);
    }

    public function getProductsCount($options = [])
    {
        return Shopify::$plugin->productService->getProductsCount($options);
    }

    public function getAllProducts($options = [])
    {
        return Shopify::$plugin->productService->getAllProducts($options);
    }
}
