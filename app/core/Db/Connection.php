<?php
declare(strict_types=1);

namespace Core\Db;
use Core\Conf\ConfTrait;

/**
 * Class Connection
 * @author Chris K. Hu <chris@microlemur.com>
 */
class Connection
{
    use ConfTrait;

    /**
     * @var \PDO
     */
    private $connector;

    public function __construct()
    {
        $dbConf = $this->configBucket()->get("db");
        $valid = ( $dbConf->dsn ?? false)
                && ( $dbConf->user ?? false)
                && ( $dbConf->password ?? false);

        if (!$valid) {
            throw new Exception("DB Configuration Error ...");
        }
        $this->connector = new \PDO($dbConf->dsn,$dbConf->user,$dbConf->password);
    }

    /**
     * @return \PDO
     */
    public function connector():\PDO {
         return $this->connector;
    }
}