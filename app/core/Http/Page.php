<?php
namespace Core\Http;
use Core\View\View;

/**
 * @author Chris K. Hu <chris@microlemur.com>
 */

abstract class Page
{
    abstract public function execute();
}