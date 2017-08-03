<?php
declare(strict_types=1);

namespace Core\Db;
use Core\Conf\Config;

/**
 * Class Connection
 * @author Chris K. Hu <chris@microlemur.com>
 */
class Connection
{
    use Config;
    /**
     * @var Connection
     */
    private static $self;

    /**
     * @var \PDO
     */
    private $connector;

    private function __construct()
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
     * @return Connection
     */
    public static function instance()
    {
        if ( is_null(static::$self)) {
            static::$self = new self();
        }

        return static::$self;
    }

    /**
     * @return \PDO
     */
    public function connector():\PDO {
         return $this->connector;
    }
}