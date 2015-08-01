<?php

namespace Bootstrap\View\Helper;

class ExcludeBricks extends \Zend_View_Helper_Abstract
{

    public function excludeBricks(array $excludeBricks = array(), $sort = true)
    {
        $availableBricks = array_keys(\Pimcore\ExtensionManager::getBrickConfigs());
        $allowedBricks = $availableBricks;
        if (!empty($excludeBricks)) {
            $allowedBricks = array_filter($allowedBricks, function($key) use ($excludeBricks) {
                return !in_array($key, $excludeBricks);
            });
        }
        if ($sort) {
            ksort($allowedBricks);
        }
        return $allowedBricks;
    }


}
