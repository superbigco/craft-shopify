/**
 * Shopify plugin for Craft CMS
 *
 * ShopifyField Field JS
 *
 * @author    Superbig
 * @copyright Copyright (c) 2018 Superbig
 * @link      https://superbig.co
 * @package   Shopify
 * @since     1.0.0ShopifyShopifyField
 */

 ;(function ( $, window, document, undefined ) {

    var pluginName = "ShopifyField",
        defaults = {
        };

    // Plugin constructor
    function Plugin( element, options ) {
        this.element = element;

        this.options = $.extend( {}, defaults, options) ;

        this._defaults = defaults;
        this._name = pluginName;

        this.init();
    }

    Plugin.prototype = {

        init: function() {
            var _this = this;

            $(function () {
                $('#' + _this.options.namespacedId)
                    .select2({
                        //limit: _this.options.limit,
                        //placeholder: _this.options.placeholder
                    });
            });
        }
    };

    // A really lightweight plugin wrapper around the constructor,
    // preventing against multiple instantiations
    $.fn[pluginName] = function ( options ) {
        return this.each(function () {
            if (!$.data(this, "plugin_" + pluginName)) {
                $.data(this, "plugin_" + pluginName,
                new Plugin( this, options ));
            }
        });
    };

})( jQuery, window, document );
