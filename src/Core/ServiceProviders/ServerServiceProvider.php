<?php
namespace LWechat\Core\ServiceProviders;

use LWechat\Server\AccessToken;
use LWechat\Server\EventNotice;
use LWechat\Server\PreAuthCode;
use LWechat\Server\Wxcrypt;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServerServiceProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        $pimple['access_token'] = function() use ($pimple){
            $config = $pimple['config']->getAll();
            $cacheKey = $config['ticketKey'] . $config['appid'];
            return new AccessToken($config['appid'], $config['appsecret'], $pimple['cache'], $cacheKey);
        };

        $pimple['wxcrypt'] = function() use ($pimple){
            $config = $pimple['config']->getAll();
            return new Wxcrypt($config['token'], $config['encodingAesKey'], $config['appid']);
        };

        $pimple['autocode'] = function() use ($pimple){
            return new PreAuthCode($pimple['config']['appid'], $pimple['cache']);
        };

        $pimple['event'] = function() use ($pimple){
            return new EventNotice($pimple);
        };
    }

}