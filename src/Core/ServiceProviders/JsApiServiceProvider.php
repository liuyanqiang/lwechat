<?php

namespace LWechat\Core\ServiceProviders;

use LWechat\Js\Api;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class JsApiServiceProvider
 * @package LWechat\Core\ServiceProviders
 */
class JsApiServiceProvider implements ServiceProviderInterface
{
    /**
     * @param Container $pimple
     */
    public function register(Container $pimple)
    {
        $pimple['jsapi'] = function () use ($pimple) {
            return new Api($pimple['auth'], $pimple['cache']);
        };
    }

}