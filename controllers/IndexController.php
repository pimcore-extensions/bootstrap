<?php


class Bootstrap_IndexController extends Pimcore_Controller_Action_Frontend {
    
    public function areaAction () 
    {
        // reachable via http://your.domain/plugin/Bootstrap/index/index
        $this->view->extraBricks = $this->_getParam("extraBricks", array());
        $this->view->excludeBricks = $this->_getParam("extraBricks", array());
    }
}
