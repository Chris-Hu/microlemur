<?php declare(strict_types = 1);

namespace Core;
/**
 * @author Chris K. Hu <chris@microlemur.com>
 */

trait Config
{
    /**
     * @var string
     */
    private static $confPath = __DIR__ . "/../config/";

    /**
     * @var string
     */
    private $confFile;

    /**
     * @var bool
     */
    private static $loaded = false;

    /**
     * @var \stdClass
     */
    private static $bucket;

    /**
     * @return Caller Class
     * @throws Exception
     */
    public function config()
    {
        if (empty(static::$bucket) || !static::$loaded) {
            $this->confFile = static::$confPath . "app{$this->env()}.json";
            if (!file_exists($this->confFile)) {
                throw new Exception("Conf File {$this->confFile} NOT FOUND... ");
            }
            $data = json_decode(file_get_contents($this->confFile));
            if (is_null($data)) {
                throw new Exception("Failed to read CONF File {$this->confFile} ... ");
            }
            static::$loaded = true;

            static::$bucket = new class
            {
                private $_data;

                public function get(string $key)
                {
                    return $this->_data->$key ?? null;
                }

                public function setData($data)
                {
                    $this->_data = $data;
                }
            };

            static::$bucket->setData($data);
        }

        return static::$bucket;
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