<?php

namespace Bootstrap\Controller\Plugin;

class Debug extends \Zend_Controller_Plugin_Abstract {

    protected $enabled = true;

    public function disable() {
        $this->enabled = false;
        return true;
    }

    public function dispatchLoopShutdown() 
    {
        if(!\Pimcore\Tool::isHtmlResponse($this->getResponse())) {
            return;
        }

        if(!\Pimcore::inDebugMode())
        {
            return;
        }

        try {

            $body = $this->getResponse()->getBody();
            
            if(preg_match_all('/<img[^>]+src="([^">]+)".*>/', $body, $images))
            {
                foreach($images[0] as $image)
                {
                    $attr = "/(\S+)=[\"']?((?:.(?![\"']?\s+(?:\S+)=|[>\"']))+.)[\"']?/i";

                    if(preg_match_all($attr, $image, $attributes))
                    {
                        $values = array();
                        
                        foreach($attributes[0] as $attribute)
                        {
                            $keyValue = explode("=", $attribute);

                            $key = $keyValue[0];
                            $value = substr($keyValue[1], 1, strlen($keyValue[1]) - 2);
                            
                            $values[$key] = $value;
                        }
                        
                        $width = 500;
                        $height = 500;
                        $text = "Lorem Ipsum";
                        
                        if(array_key_exists("data-width", $values))
                            $width = $values["data-width"];
                            
                        if(array_key_exists("data-height", $values))
                            $height = $values["data-height"];
                            
                        if(array_key_exists("data-text", $values))
                            $text = $values["data-text"];
                        
                        $body = str_replace($image, '<img class="img-responsive" data-src="holder.js/' . $width . 'x' . $height . '/auto/#777:#ccc/text:'.$text.'" />', $body);
                    }
                }
            }
            
                        
            //
            
            $this->getResponse()->setBody($body);
        } 
        catch (\Exception $e) 
        {
            \Logger::error($e);
        }
    }
}

