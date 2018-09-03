<?php
/**
 * Shopify plugin for Craft CMS 3.x
 *
 * A toolset to integrate Craft with Shopify
 *
 * @link      https://superbig.co
 * @copyright Copyright (c) 2018 Superbig
 */

namespace superbig\shopify\assetbundles\shopifyfieldfield;

use Craft;
use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;

/**
 * @author    Superbig
 * @package   Shopify
 * @since     1.0.0
 */
class ShopifyFieldFieldAsset extends AssetBundle
{
    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->sourcePath = "@superbig/shopify/assetbundles/shopifyfieldfield/dist";

        $this->depends = [
            CpAsset::class,
        ];

        $this->js = [
            'js/select2.min.js',
            'js/ShopifyField.js',
        ];

        $this->css = [
            'css/select2.min.css',
            'css/ShopifyField.css',
        ];

        parent::init();
    }
}
