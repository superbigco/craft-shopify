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

use superbig\shopify\Shopify;

use Craft;
use craft\base\Component;

/**
 * @author    Superbig
 * @package   Shopify
 * @since     1.0.0
 */
class OrderService extends Component
{
    // Public Methods
    // =========================================================================

    /*
     * @return mixed
     */
    public function exampleService()
    {
        $result = 'something';
        // Check our Plugin's settings for `someAttribute`
        if (Shopify::$plugin->getSettings()->someAttribute) {
        }

        return $result;
    }
}
