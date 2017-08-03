<?php

namespace Core;

interface IReadOnly
{
    public function get(string $key);
}