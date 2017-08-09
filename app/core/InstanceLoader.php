<?php
namespace Core;

/**
 * A simple instance loader , mainly used in traits
 * @author Chris K. Hu <chris@microlemur.com>
 */
abstract class InstanceLoader
{
    /**
     * instances registry
     * @var array
     */
    protected static $registry = [];

    /**
     * @param string $key
     * @return mixed
     */
    public static function get(string $key)
    {
        return static::$registry[$key] ?? static::$registry[$key];
    }

    /**
     * Adds object to registry
     * @param string $key
     * @param $object
     * @return mixed
     */
    public static function add(string $key, $object )
    {
        static::$registry[$key] = $object;
        return $object;
    }
}