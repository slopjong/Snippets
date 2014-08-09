<?php

namespace Application\Controller;

use Application\Constants\Directory;
use Application\Model\App;
use Application\Model\AppList;
use Application\Model\GenericFile;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class AppsController extends AbstractActionController
{
    /** @var $this AbstractActionController */

    public function listAction()
    {
        return array(
            "apps" => new AppList()
        );
    }

    public function detailsAction()
    {
        $appid = (int) $this->params('appid');

        return array(
            "app" => new App($appid)
        );
    }

    public function widgetAction()
    {
        $appdir = getcwd() . "/apps";
        $appid = (int) $this->params('appid');
        $file = $this->params('file');

        if(empty($file))
            $file = "index.html";

        $file_path = $appdir . "/$appid/www/$file";
        if(file_exists($file_path))
        {
            header('Content-Type: '. GenericFile::mimetype($file));
            header("Content-Length: " . filesize($file_path));

            readfile($file_path);
        }
        else
        {
            header('HTTP/1.1 404 Not Found');
        }

        exit();
    }

    public function iconAction()
    {
        $appdir = getcwd() . "/apps";
        $appid = (int) $this->params('appid');

        $icon_path = $appdir . "/$appid/icon.png";
        if(file_exists($icon_path))
        {
            header('Content-Type: image/png');
            header("Content-Length: " . filesize($icon_path));

            readfile($icon_path);
        }

        exit();
    }

}
