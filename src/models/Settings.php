<?php
/**
 * Shopify plugin for Craft CMS 3.x
 *
 * A toolset to integrate Craft with Shopify
 *
 * @link      https://superbig.co
 * @copyright Copyright (c) 2018 Superbig
 */

namespace superbig\shopify\models;

use superbig\shopify\Shopify;

use Craft;
use craft\base\Model;

/**
 * @author    Superbig
 * @package   Shopify
 * @since     1.0.0
 */
class Settings extends Model
{
    // Public Properties
    // =========================================================================

    /*** @var string */
    public $apiKey = '';

    /*** @var string */
    public $apiSecret = '';

    /*** @var string */
    public $hostname = '';

    /*** @var boolean */
    public $cache = false;

    /*** @var int */
    public $cacheDuration = 60 * 60 * 24 * 30;

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['apiKey', 'apiSecret', 'hostname'], 'string'],
        ];
    }
}
