<?php

use Phalcon\Mvc\Controller;
use Phalcon\Dispatcher;
use Phalcon\Mvc\View;

class ControllerBase extends Controller
{
    public function afterExecuteRoute(Dispatcher $dispatcher)
    {
        $this->view->disableLevel(array(
            View::LEVEL_ACTION_VIEW     => true,
            View::LEVEL_LAYOUT          => true,
            View::LEVEL_MAIN_LAYOUT     => true,
            View::LEVEL_AFTER_TEMPLATE  => true,
            View::LEVEL_BEFORE_TEMPLATE => true
        ));
        $data = $this->view->getParamsToView();
        $this->response->setJsonContent($data);
        return $this->response->send();
    }
}
