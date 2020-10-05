<?php

use Phalcon\Http\Request;

class ProductsController extends ControllerBase
{
    public function indexAction()
    {
        $params = $this->request->getQuery();

        $limit = $params['limit'];
        $page = $params['page'] - 1;

        $this->view->products = Products::find(
            [
                'skip' => $limit * $page,
                'limit' => $limit
            ]
        );

    }

    public function searchAction($name = '')
    {
        $this->view->products = Products::find([
            [
                'name' => [
                    '$regex'   => $name,
                    '$options' => 'i'
                ]
            ]
        ]);
    }


    public function viewAction($url = '')
    {
        $this->view->product = Products::findFirst([
            [
                'url' => $url
            ]
        ]);
    }
}

