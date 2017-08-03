<?php
namespace Core\Db;
/**
 * @author Christian K. Hu <chris@microlemur.com>
 */
trait Db
{
    public function dbConnection():\PDO
    {
        return Connection::instance()->connector();
    }
}