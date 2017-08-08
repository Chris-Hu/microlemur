<?php declare(strict_types=1);
namespace Core\Session;
use Core\Storage\IKeyValue;

/**
 * @author Chris K. Hu <chris@microlemur.com>
 */
interface SessionInterface extends IKeyValue
{
    public function start(array $options = []);
    public function isStarted():bool;
    public function setId(string $id);
    public function getId():string;
    public function setName(string $name);
    public function clear();
    public function destroy();
}