<?php
namespace Core\Conf;
use Core\InstanceLoader;
use Core\ReadOnlyInterface;

/**
 * @author Chris K. Hu <chris@microlemur.com>
 */
trait ConfigTrait
{
    public function configBucket():ReadOnlyInterface
    {
         return (! InstanceLoader::get(__METHOD__))
            ? InstanceLoader::add(__METHOD__,  (new Config())->bucket() )
            : InstanceLoader::get(__METHOD__);
    }
}