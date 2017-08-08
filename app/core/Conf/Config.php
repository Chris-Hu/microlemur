<?php declare(strict_types = 1);

namespace Core\Conf;

use Core\Constant;
use Core\IReadOnly;
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

        $this->bucket = new class($data) implements IReadOnly
        {
            private $_data;

            public function __construct($data)
            {
                $this->_data = $data;
            }

            public function get(string $key)
            {
                return $this->_data->$key ?? null;
            }
        };
    }

    /**
     * @return IReadOnly
     */
    public function bucket():IReadOnly
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