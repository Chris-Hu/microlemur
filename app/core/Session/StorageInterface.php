<?php declare(strict_types=1);
namespace Core\Session;

/**
 * @author Chris K. Hu <chris@microlemur.com>
 */
interface StorageInterface
{
    public function start(array $options = []);
    public function isStarted():bool;
    public function setId(string $id);
    public function getId():string;
    public function setName(string $name);
    public function set(string $key, $value);
    public function get(string $key);
    public function clear();
    public function destroy();
}