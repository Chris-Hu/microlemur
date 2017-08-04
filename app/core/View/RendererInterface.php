<?php
namespace Core\View;

/**
 * Feed for View use
 * @author Chris K. Hu <chris@microlemur.com>
 */
interface RendererInterface
{
    public function compose(string $view);
    public function render();
}