<?php
namespace Core\Conf;

use Core\IReadOnly;

/**
 * @author Chris K. Hu <chris@microlemur.com>
 */
trait Config
{
    public function configBucket():IReadOnly
    {
        return Loader::instance()->bucket();
    }
}