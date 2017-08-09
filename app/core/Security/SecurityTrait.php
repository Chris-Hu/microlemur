<?php declare(strict_types=1);
namespace Core\Security;
use Core\InstanceLoader;
/**
 * @author Christian K. Hu <chris@microlemur.com>
 */
trait SecurityTrait
{
    public function token():TokenManager
    {
        return (! InstanceLoader::get(__METHOD__))
            ? InstanceLoader::add(__METHOD__,  new TokenManager() )
            : InstanceLoader::get(__METHOD__);
    }

    public function security():Security
    {
        return (! InstanceLoader::get(__METHOD__))
            ? InstanceLoader::add(__METHOD__,  new Security() )
            : InstanceLoader::get(__METHOD__);
    }
}