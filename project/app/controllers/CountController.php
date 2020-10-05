<?php

class CountController extends ControllerBase
{
    public function indexAction()
    {
      $this->view->products = Products::count();
    }
}

