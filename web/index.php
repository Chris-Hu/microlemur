<?php require_once __DIR__."/../app/runner.php";

class Index extends Core\Http\Page
{
    public function execute()
    {
        $feed = new \Core\View\Feed();
        $feed->add("projectName", "MicroLemur Framework")
            ->add("version" ,"0.2");

        (new \Core\View\View())
                ->compose("index")
                ->with($feed)->render();
    }
}

(new Index())->execute();