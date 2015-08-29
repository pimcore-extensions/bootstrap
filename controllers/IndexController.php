<?php

namespace Bootstrap;

class IndexController extends \Pimcore\Controller\Action\Frontend
{
    public function areaAction()
    {
        // reachable via http://your.domain/plugin/Bootstrap/index/index
        $this->view->extraBricks = $this->_getParam("extraBricks", array());
        $this->view->excludeBricks = $this->_getParam("extraBricks", array());
    }
}
