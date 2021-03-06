<?php
namespace LWechat\Core\ServiceProviders;
use LWechat\Staff\Staff;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class StaffServiceProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        $pimple['staff'] = function() use ($pimple){
            return new Staff($pimple['auth']);
        };
    }

}