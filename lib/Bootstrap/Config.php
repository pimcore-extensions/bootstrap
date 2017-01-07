<?php

namespace Bootstrap;

use Pimcore\Tool;

class Config {

    /**
     * @static
     * @return \Zend_Config
     */
    public static function getConfig () {

        $config = null;

        $configFile = PIMCORE_CONFIGURATION_DIRECTORY . "/bootstrap-config.xml";

        if(\Zend_Registry::isRegistered("bootstrap_config")) {
            $config = \Zend_Registry::get("bootstrap_config");
        } else  {
            try {
                $config = new \Zend_Config_Xml($configFile);
                self::setConfig($config);
            } catch (\Exception $e) {
                \Logger::emergency("Cannot find system configuration, should be located at: " . $configFile);
                if(is_file( $configFile )) {
                    $m = "Your bootstrap-config.xml located at " . $configFile . " is invalid, please check and correct it manually!";
                    Tool::exitWithError($m);
                }
            }
        }

        return $config;
    }

    /**
     * @static
     * @param \Zend_Config $config
     * @return void
     */
    public static function setConfig (\Zend_Config $config) {
        \Zend_Registry::set("bootstrap_config", $config);
    }
}
