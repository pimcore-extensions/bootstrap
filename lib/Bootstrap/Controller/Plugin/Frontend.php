<?php

namespace Bootstrap\Controller\Plugin;

class Frontend extends \Zend_Controller_Plugin_Abstract
{
    /**
     * @var bool
     */
    protected $initialized = false;

    public function preDispatch()
    {
        // preDispatch can be called more than once
        if ($this->initialized) {
            return;
        }

        /** @var \Pimcore\Controller\Action\Helper\ViewRenderer $renderer */
        $renderer = \Zend_Controller_Action_HelperBroker::getExistingHelper('ViewRenderer');
        $renderer->initView();

        /** @var \Pimcore\View $view */
        $view = $renderer->view;
        $view->addScriptPath(PIMCORE_PLUGINS_PATH . '/Bootstrap/views/scripts');

        $this->initialized = true;
    }
}

