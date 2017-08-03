<?php
namespace Core\Http;
use Core\View\View;

/**
 * @author Chris K. Hu <chris@microlemur.com>
 */

abstract class Page
{
    /**
     * @var View
     */
    protected $view;

    public function __construct()
    {
        $this->view = new View();
    }

    abstract public function execute();
}