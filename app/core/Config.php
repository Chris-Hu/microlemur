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
    private static $path = __DIR__ . "/../config/";

    /**
     * @var string
     */
    private $file;

    /**
     * @var bool
     */
    private static $loaded = false;

    /**
     * @var \stdClass
     */
    protected $data;

    /**
     * @return Config
     * @throws Exception
     */
    public function config() : Config
    {
        if (!static::$loaded) {
            $this->file = static::$path . "app{$this->env()}.json";
            if (!file_exists($this->file)) {
                throw new Exception("Conf File {$this->file} NOT FOUND... ");
            }
            $this->data = json_decode(file_get_contents($this->file));
            if (is_null($this->conf)) {
                throw new Exception("Failed to read CONF File {$this->file} ... ");
            }
            static::$loaded = true;
        }
        return $this;
    }

    /**
     * @param string $key
     * @return null|\stdClass
     */
    public function get(string $key)
    {
        if (!static::$loaded) $this->config();
        return $this->data ?? null;
    }

    /**
     * @return string
     */
    protected function env() :string
    {
        $env = $_ENV["LEMUR_FRAMEWORK_ENV"];
        if (preg_match("/dev/i", $env)) {
            return "dev";
        }

        if (preg_match("/prod/i", $env)) {
            return "";
        }

        if (preg_match("/test/i", $env)) {
            return "test";
        }
        return "local";
    }
}