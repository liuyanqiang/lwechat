<?php
namespace LWechat\Core\ServiceProviders;
use LWechat\User\User;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class UserServiceProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        $pimple['user'] = function() use ($pimple){
            return new User($pimple['auth']);
        };
    }

}