<?php
namespace LWechat\Core\ServiceProviders;

use LWechat\Message\Message;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class MessageServiceProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        $pimple['message'] = function() use ($pimple){
            return new Message($pimple['wxcrypt'], $pimple['request'], $pimple['xml']);
        };
    }

}