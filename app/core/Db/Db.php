<?php
namespace Core\Db;
/**
 * @author Chris K. Hu <chris@microlemur.com>
 */
trait Db
{
    public function dbConnection():\PDO
    {
        return Connection::instance()->connector();
    }
}