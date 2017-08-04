<?php
namespace Core\View;

use Core\Constant;
use Core\Exception;

/**
 * Class View
 * @author Chris K. Hu
 */
class View implements RendererInterface
{
    private $viewPath = Constant::ROOT_DIR . "/templates/";

    /**
     * @var string
     */
    private $viewFile = "";

    /**
     * @var string
     */
    private $view = "";

    /**
     * @var string
     */
    protected $viewString = "";

    /**
     * @var Feed
     */
    protected $feed;


    /**
     * @param string $view
     * @return $this
     */
    public function compose(string $view)
    {
        $this->view = $view;
        $this->viewFile = $this->viewPath . "$view.tpl.php";
        if (!file_exists($this->viewFile)) {
            throw new Exception("VIEW File {$this->viewFile} NOT FOUND ...");
        }
        return $this;
    }

    /**
     * @param Feed $feed
     * @return $this
     */
    public function with(Feed $feed)
    {
        $this->feed = $feed;
        return $this;
    }

    public function path(string $path)
    {
        $this->viewPath = $path ?? $this->viewPath;
        return $this;
    }

    /**
     * @param string $view
     * @throws Exception
     */
    public function render()
    {
        if (!empty($this->feed)) {
            $tpl_var = $this->view . "_var";
            $$tpl_var = $this->feed;
        }

        ob_start();
        include($this->viewFile);
        $output = ob_get_contents();
        @ob_end_clean();
        echo $output;
    }

    /**
     * @return string
     */
    public function __toString():string
    {
        return $this->viewString;
    }

    /**
     * @param $data
     */
    public function renderJson($data)
    {
        header('Content-Type: application/json');
        echo is_array($data) ? json_encode($data) : $data;
    }
}