<?php declare(strict_types=1);

namespace Core\Session;

/**
 * Session
 * @author Chris K. Hu <chris@microlemur.com>
 */

trait Session
{
    public function session():Runner
    {
        return Runner::instance();
    }
}