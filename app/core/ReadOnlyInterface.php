<?php

namespace Core;

interface ReadOnlyInterface
{
    public function get(string $key);
}