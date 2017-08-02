<?php

namespace LWechat\Core\ServiceProviders;

use LWechat\Authorizer\Member;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class AuthorizerServiceProvider
 * @package LWechat\Core\ServiceProviders
 */
class AuthorizerServiceProvider implements ServiceProviderInterface
{
    /**
     * @param Container $pimple
     */
    public function register(Container $pimple)
    {
        $pimple['member'] = function() use ($pimple){
            return new Member($pimple['config']['appid'], $pimple['access_token']);
        };
    }

}