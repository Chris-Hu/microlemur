<?php
declare(strict_types=1);

namespace Core\Db;
use Core\Conf\ConfigTrait;

/**
 * Class Connection
 * @author Chris K. Hu <chris@microlemur.com>
 */
class Connection
{
    use ConfigTrait;

    /**
     * @var \PDO
     */
    private $connector;

    public function __construct()
    {
        $conf = $this->configBucket()->get("app");
        $valid = ( $conf->db->dsn ?? false)
                && ( $conf->db->user ?? false)
                && ( $conf->db->password ?? false);

        if (!$valid) {
            throw new Exception("DB Configuration Error ...");
        }
        $this->connector = new \PDO($conf->db->dsn,$conf->db->user,$conf->db->password);
    }

    /**
     * @return \PDO
     */
    public function connector():\PDO {
         return $this->connector;
    }
}