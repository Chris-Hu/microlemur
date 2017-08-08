<?php
namespace Core\Conf;

use Core\IReadOnly;

/**
 * @author Chris K. Hu <chris@microlemur.com>
 */
trait ConfTrait
{
    public function configBucket():IReadOnly
    {
         return (! InstanceLoader::get(__TRAIT__))
            ? InstanceLoader::add(__TRAIT__,  (new Config())->bucket() )
            : InstanceLoader::get(__TRAIT__);
    }
}