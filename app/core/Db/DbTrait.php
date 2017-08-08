<?php
namespace Core\Db;
/**
 * @author Christian K. Hu <chris@microlemur.com>
 */
trait DbTrait
{
    public function dbConnection():\PDO
    {
        return (! InstanceLoader::get(__TRAIT__))
            ? InstanceLoader::add(__TRAIT__,  (new Connection())->connector() )
            : InstanceLoader::get(__TRAIT__);
    }
}