<?php require_once __DIR__."/../app/runner.php";

class Index extends Core\Http\Page
{
    public function execute()
    {
        $feed = new \Core\View\Feed();
        $feed->add("tooManyApiCalls", false)
            ->add("websiteCurrentState" ,"WEBSITE_IS_ONLINE")
            ->add("showCaptcha", true);

        $this->view->compose("index")
                ->with($feed)->render();
    }
}

(new Index())->execute();