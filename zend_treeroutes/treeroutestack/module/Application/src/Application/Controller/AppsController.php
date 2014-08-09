<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class AppsController extends AbstractActionController
{
    public function listAction()
    {
        echo "<pre>";
        echo 'Controller: Apps' . PHP_EOL;
        echo 'Action: list' . PHP_EOL;
        echo "</pre>";

        exit();

        //return new ViewModel();
        return array();
    }

    public function detailsAction()
    {
        echo "<pre>";
        echo 'Controller: Apps' . PHP_EOL;
        echo 'Action: details' . PHP_EOL;
        echo 'App ID: ' . $this->params('appid') . PHP_EOL;
        echo "</pre>";

        exit();
    }

    public function widgetAction()
    {
        echo "<pre>";
        echo 'Controller: Apps' . PHP_EOL;
        echo 'Action: widget' . PHP_EOL;
        echo 'App ID: ' . $this->params('appid') . PHP_EOL;
        echo 'App resource: ' . $this->params('file') . PHP_EOL;
        echo "</pre>";

        exit();
    }
}
