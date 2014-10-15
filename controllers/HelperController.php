<?php


class Bootstrap_HelperController extends Pimcore_Controller_Action_Admin {
    
    public function areaAction () 
    {
        $this->view->name = $this->_getParam("name", "image");
    }
}
