<?php

namespace Bootstrap;

use Bootstrap\Controller\Plugin\ScriptPaths;
use Pimcore\API\Plugin\AbstractPlugin;
use Pimcore\API\Plugin\PluginInterface;
use Pimcore\Controller\Action\Frontend;

class Plugin extends AbstractPlugin implements PluginInterface
{
    public function init()
    {
        parent::init();

        \Pimcore::getEventManager()->attach('system.startup', function (\Zend_EventManager_Event $e) {
            /** @var \Zend_Controller_Front $front */
            $front = $e->getTarget();
            // system.startup occurs too early to register view scripts path
            // we need to do it through controller plugin in preDispatch()
            $front->registerPlugin(new Controller\Plugin\Frontend());
        });
    }

    public static function isInstalled()
    {
        return true;
    }

    public static function install()
    {
    }

    public static function uninstall()
    {
    }

    /**
     * Absolute path to the folder holding plugin translation files.
     *
     * @return string
     */
    public static function getTranslationFileDirectory()
    {
        return PIMCORE_PLUGINS_PATH . '/Bootstrap/lang';
    }

    /**
     * Path for the specified language relative to plugin directory.
     *
     * @param string $language
     * @return string
     */
    public static function getTranslationFile($language)
    {
        if (is_file(self::getTranslationFileDirectory() . "/$language.csv")) {
            return "/Bootstrap/lang/$language.csv";
        }

        return '/Bootstrap/lang/en.csv';
    }
}
