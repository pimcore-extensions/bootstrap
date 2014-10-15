<?php

class Bootstrap_Controller_Plugin_Frontend extends Zend_Controller_Plugin_Abstract {

    protected $enabled = true;

    public function disable() {
        $this->enabled = false;
        return true;
    }

    public function dispatchLoopShutdown() 
    {
        if(!Pimcore_Tool::isHtmlResponse($this->getResponse())) {
            return;
        }

        try {
            
            $body = $this->getResponse()->getBody();

            $code = "\n\n\n<!-- Bootstrap Includes -->\n";

            $headCode = '';

            
            $headEndPosition = stripos($body, "</title>");
            if($headEndPosition !== false) {
                $body = substr_replace($body, "\n\n</title>\n".$headCode, $headEndPosition, 7);
            }


            /*


            // search for the end <head> tag, and insert the google analytics code before
            // this method is much faster than using simple_html_dom and uses less memory
            $bodyEndPosition = stripos($body, "</body>");
            if($bodyEndPosition !== false) {
                $body = substr_replace($body, $code . "\n\n</body>\n", $bodyEndPosition, 7);
            }
*/

            $this->getResponse()->setBody($body);
        } 
        catch (\Exception $e) 
        {
            Logger::error($e);
        }
    }
}

