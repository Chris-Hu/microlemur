<?php
declare(strict_types=1);

namespace Core\Db;
/**
 * Class Connection
 * @author Chris K. Hu <chris@microlemur.com>
 */
class Connection
{
    use \Core\Config;
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
        $dbConf = $this->config()->get("db");

        $valid = ( $dsn = $dbConf->get("dsn") ?? false)
                && ( $user = $dbConf->get("user") ?? false)
                && ($password = $dbConf->get("password") ?? false);

        if (!$valid) {
            throw new Exception("DB Configuration Error ...");
        }
        $this->connector = new \PDO($dsn,$user,$password);
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