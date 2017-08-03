<?php
namespace Core\Http;

/**
 * @author Chris K. Hu <chris@microlemur.com>
 */

abstract class Page
{
    protected $contentType = "text/html";

    abstract public function execute();
}