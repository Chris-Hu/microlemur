<?php declare(strict_types = 1);

namespace Core\Conf;

use Core\Conf\Props\Security;
use Core\Constant;
use Core\ReadOnlyInterface;

/**
 * @author Chris K. Hu <chris@microlemur.com>
 */

class Config
{
    /**
     * @var string
     */
    private $confPath = Constant::ROOT_DIR."/app/config/";

    /**
     * @var string
     */
    private $confFile;

    /**
     * @var IReadOnly
     */
    private $bucket;

    public function __construct()
    {
        $this->confFile = $this->confPath . "app{$this->env()}.json";
        if (!file_exists($this->confFile)) {
            throw new Exception("Conf File {$this->confFile} NOT FOUND... ");
        }
        $data = json_decode(file_get_contents($this->confFile));
        if (is_null($data)) {
            throw new Exception("Failed to read CONF File {$this->confFile} ... ");
        }

        $this->bucket = new class($data) implements ReadOnlyInterface
        {
            private $_data;

            public function __construct($data)
            {
                $this->_data = $data;
            }

            /**
             * @param string $key
             * @return mixed
             * @throws Exception
             */
            public function get(string $key)
            {
                if (!isset($this->_data->$key)) {
                    throw new Exception("$key MISSING in Configuration file ... ");
                }
                switch ($key) {
                    case "app.security":
                        return new Security($this->_data->$key);
                    default:
                        return $this->_data->$key;
                }
            }
        };
    }

    /**
     * @return IReadOnly
     */
    public function bucket():ReadOnlyInterface
    {
        return $this->bucket;
    }

    /**
     * @return string
     */
    protected function env() :string
    {
        $env = $_ENV["LEMUR_FRAMEWORK_ENV"] ?? "";
        if (preg_match("/dev/i", $env)) {
            return ".dev";
        }

        if (preg_match("/prod/i", $env)) {
            return "";
        }

        if (preg_match("/test/i", $env)) {
            return ".test";
        }
        return ".local";
    }
}