<?php

class ProductsController extends ControllerBase
{
    public function indexAction()
    {
        $this->view->products = Products::find();
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

