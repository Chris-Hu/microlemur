<?php

namespace Core\Storage;
/**
 * A simple key value storage
 * @author Chris K. Hu <chris@microlemur.com>
 */
interface KeyValueInterface
{
    public function set(string $key, $value);
    public function get(string $key);
    public function exists($key):bool;
}