<?php
namespace Core\Http;

/**
 * A simple marker
 * Interface RequestInterface
 * @package Core\Http
 */
interface RequestInterface {
    public function isSecure():bool;
}