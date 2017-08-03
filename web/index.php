<?php require_once __DIR__."/../app/runner.php";

class Index extends Core\Http\Page {

    public function execute()
    {
        $feed = new \Core\View\Feed();
        $feed->add("projectName", "Lemur NanoFramework")
            ->add("version" ,0.1);

        (new \Core\View\View())
            ->compose("index")
            ->with($feed)->render();
    }
}

(new Index())->execute();