<?php
/**
 * Shopify plugin for Craft CMS 3.x
 *
 * A toolset to integrate Craft with Shopify
 *
 * @link      https://superbig.co
 * @copyright Copyright (c) 2018 Superbig
 */

namespace superbig\shopify\services;

use Illuminate\Support\Collection;
use PHPShopify\ShopifySDK;
use superbig\shopify\Shopify;

use Craft;
use craft\base\Component;

/**
 * @author    Superbig
 * @package   Shopify
 * @since     1.0.0
 */
class ProductService extends Component
{
    private $_client;

    // Public Methods
    // =========================================================================

    public function getAllProducts($options = [])
    {
        $options = array_merge([
            'limit' => 50,
        ], $options);

        // Get count
        $totalCount = $this->getProductsCount($options);
        $pages      = round(ceil($totalCount / $options['limit']));

        // Get all pages
        if ($pages === 0) {
            return null;
        }

        return collect(range(1, $pages))
            ->map(function($page) use ($options) {
                return $this->getProducts(array_merge($options, ['page' => $page]));
            })
            ->collapse();
    }

    public function getProducts($options = []): Collection
    {
        $settings = Shopify::$plugin->getSettings();
        $cache    = $options['cache'] ?? $settings->cache;
        $options  = array_merge([
            'limit' => 50,
        ], $options);

        $fieldOption = $options['fields'] ?? false;
        if ($fieldOption && is_array($fieldOption)) {
            $options['fields'] = implode(',', $fieldOption);
        }

        if ($cache) {
            $result = Craft::$app
                ->getCache()
                ->getOrSet($this->getCacheSignature($options), function() use ($options) {

                    return $this
                        ->getClient()
                        ->Product->get($options);
                }, $settings->cacheDuration);

            return collect($result);
        }

        $result = $this
            ->getClient()
            ->Product->get($options);

        return collect($result);
    }

    public function getProduct($id = null)
    {
        $settings = Shopify::$plugin->getSettings();
        $cache    = $options['cache'] ?? $settings->cache;
        $options  = array_merge([
        ], $options);

        $fieldOption = $options['fields'] ?? false;
        if ($fieldOption && is_array($fieldOption)) {
            $options['fields'] = implode(',', $fieldOption);
        }

        if ($cache) {
            $cacheKey = $this->getCacheSignature($options, "product-{$id}");
            $result   = Craft::$app
                ->getCache()
                ->getOrSet($cacheKey, function() use ($id, $options) {

                    return $this
                        ->getClient()
                        ->Product($id)->get($options);
                }, $settings->cacheDuration);

            return collect($result);
        }

        $result = $this
            ->getClient()
            ->Product($id)->get($options);

        return $result;
    }

    public function getProductsCount($options = [])
    {
        $keys = [
            'vendor	',
            'product_type',
            'collection_id	',
            'created_at_min',
            'created_at_max	',
            'updated_at_min',
            'updated_at_max',
            'published_at_min',
            'published_at_max',
            'published_status',
        ];

        $settings = Shopify::$plugin->getSettings();
        $cache    = $options['cache'] ?? $settings->cache;
        $options  = collect($options)->only($keys)->filter()->toArray();

        if ($cache) {
            $cacheKey = $this->getCacheSignature($options, "products-count");
            $result   = Craft::$app
                ->getCache()
                ->getOrSet($cacheKey, function() use ($options) {
                    return $this
                        ->getClient()
                        ->Product->count($options);
                }, $settings->cacheDuration);

            return $result;
        }

        $result = $this
            ->getClient()
            ->Product->count($options);

        return $result;
    }

    public function getCacheSignature($options = [], $resource = ''): string
    {
        sort($options);

        return md5($resource . json_encode($options));
    }

    public function getClient()
    {
        $settings = Shopify::$plugin->getSettings();
        if (!$this->_client) {
            $config        = [
                'ShopUrl'  => $settings->hostname,
                'ApiKey'   => $settings->apiKey,
                'Password' => $settings->apiSecret,
            ];
            $this->_client = ShopifySDK::config($config);
        }

        return $this->_client;
    }
}
