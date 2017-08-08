<?php declare(strict_types=1);

namespace Core\Session;
use Core\InstanceLoader;

/**
 * Session
 * @author Chris K. Hu <chris@microlemur.com>
 */

trait SessionTrait
{
    public function session():Session
    {
        return (! InstanceLoader::get(__TRAIT__))
            ? InstanceLoader::add(__TRAIT__,  new Session() )
            : InstanceLoader::get(__TRAIT__);
    }
}