<?php
namespace Core\Http;

trait HttpRequest
{
    protected function request()
    {
        static $request;
        if (is_null($request)) {
            $request = new Request();
        }
        return $request;
    }
}