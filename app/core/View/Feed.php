<?php
namespace Core\View;

/**
 * Feed for View use
 * @author Chris K. Hu <chris@microlemur.com>
 */
class Feed
{
    private $registry = [];

    /**
     * replace key if exist
     * @param string $key
     * @param $value
     * @return $this
     */
    public function add(string $key ,$value) {
        $this->registry[$key] = $value;
        return $this;
    }

    /**
     * @param $key
     * @return mixed|null
     */
    public function __get($key) {
        return $this->registry[$key] ?? null;
    }
}