<?php declare(strict_types=1);
namespace Core\Security\Token;
use Core\InstanceLoader;
/**
 * A Simple Token Manager
 * @author Chris K. Hu <chris@microlemur.com>
 */
trait TokenTrait
{
    public function token():TokenManager
    {
        return (! InstanceLoader::get(__TRAIT__))
            ? InstanceLoader::add(__TRAIT__,  new TokenManager() )
            : InstanceLoader::get(__TRAIT__);
    }
}