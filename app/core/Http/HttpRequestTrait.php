<?php
namespace Core\Http;

trait HttpRequestTrait
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