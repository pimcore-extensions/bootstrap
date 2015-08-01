<?php

namespace Bootstrap;

use Bootstrap\Controller\Plugin\ScriptPaths;
use Pimcore\API\Plugin\AbstractPlugin;
use Pimcore\API\Plugin\PluginInterface;
use Pimcore\Controller\Action\Frontend;

class Plugin extends AbstractPlugin implements PluginInterface
{

    protected static $installedFileName = "/var/config/.bootstrap";

    public function __construct($jsPaths = null, $cssPaths = null, $alternateIndexDir = null)
    {
        parent::__construct($jsPaths, $cssPaths);
    }

    public static function onFrontInit(Frontend $front)
    {
        /** @var \Pimcore\View $view */
        $view = $front->view;
        $view->addScriptPath(PIMCORE_PLUGINS_PATH . '/Bootstrap/views/scripts');
        $view->addHelperPath(PIMCORE_PLUGINS_PATH . '/Bootstrap/lib/Bootstrap/View/Helper', '\\Bootstrap\\View\\Helper\\');
    }

    public static function isInstalled()
    {
        return file_exists(PIMCORE_WEBSITE_PATH . self::$installedFileName);
    }

    public function preDispatch($e)
    {

        //$e->getTarget()->registerPlugin(new Bootstrap_Controller_Plugin_Debug(), 11);
    }

    public static function install()
    {
        self::recurse_copy(PIMCORE_PLUGINS_PATH . "/Bootstrap/views/areas", PIMCORE_WEBSITE_VAR . "/areas");

        touch(PIMCORE_WEBSITE_PATH . self::$installedFileName);
    }

    public static function uninstall()
    {
        $respository = PIMCORE_PLUGINS_PATH . "/Bootstrap/views/areas";

        $blockDirs = scandir($respository);

        foreach ($blockDirs as $blockDir) {
            if ($blockDir == "." && $blockDir == "..")
                continue;

            if (is_dir($respository . "/" . $blockDir)) {
                if (is_file($respository . "/" . $blockDir . "/area.xml"))
                    self::rrmdir(PIMCORE_WEBSITE_VAR . "/areas/" . $blockDir);
            }
        }

        unlink(PIMCORE_WEBSITE_PATH . self::$installedFileName);
    }

    public static function rrmdir($dir)
    {
        if (is_dir($dir)) {
            $objects = scandir($dir);

            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (filetype($dir . "/" . $object) == "dir")
                        self::rrmdir($dir . "/" . $object);
                    else
                        unlink($dir . "/" . $object);
                }
            }

            reset($objects);
            rmdir($dir);
        }
    }

    public static function getTranslationFile($language)
    {
        return "/Bootstrap/lang/$language.csv";
    }

    protected static function recurse_copy($src,$dst)
    {
        $dir = opendir($src);
        @mkdir($dst);

        while(false !== ( $file = readdir($dir)) ) {
            if (( $file != '.' ) && ( $file != '..' )) {
                if ( is_dir($src . '/' . $file) ) {
                    self::recurse_copy($src . '/' . $file,$dst . '/' . $file);
                }
                else {
                    copy($src . '/' . $file,$dst . '/' . $file);
                }
            }
        }
        closedir($dir);
    }
}
