<?php
/**
 * Shopify plugin for Craft CMS 3.x
 *
 * A toolset to integrate Craft with Shopify
 *
 * @link      https://superbig.co
 * @copyright Copyright (c) 2018 Superbig
 */

namespace superbig\shopify\assetbundles\Shopify;

use Craft;
use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;

/**
 * @author    Superbig
 * @package   Shopify
 * @since     1.0.0
 */
class ShopifyAsset extends AssetBundle
{
    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->sourcePath = "@superbig/shopify/assetbundles/shopify/dist";

        $this->depends = [
            CpAsset::class,
        ];

        $this->js = [
            'js/Shopify.js',
        ];

        $this->css = [
            'css/Shopify.css',
        ];

        parent::init();
    }
}
