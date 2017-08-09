<?php declare(strict_types=1);
namespace Core\Db;
use Core\InstanceLoader;
/**
 * @author Christian K. Hu <chris@microlemur.com>
 */
trait DbTrait
{
    public function dbConnection():\PDO
    {
        return (! InstanceLoader::get(__METHOD__))
            ? InstanceLoader::add(__METHOD__,  (new Connection())->connector() )
            : InstanceLoader::get(__METHOD__);

    }

}