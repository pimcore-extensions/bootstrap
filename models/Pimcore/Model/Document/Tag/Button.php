<?php

namespace Pimcore\Model\Document\Tag;

class Button extends \Pimcore\Model\Document\Tag\Link
{

    protected $styles = array('default', 'success', 'info', 'warning', 'danger');
    protected $sizes = array(
        'Large' => 'btn-lg',
        'Default' => null,
        'Small' => 'btn-sm',
        'Extra Small' => 'btn-xs',
    );

    /**
     * Automatically inject bootstrap classes to the link
     * @return string
     */
    public function frontend()
    {
        $html = parent::frontend();
        $matches = array();
        if(preg_match('/^<a.*?class=[\'"](.*?)[\'"]/i', $html, $matches)) {
            $classes = explode(' ', $matches[1]);
        } else {
            $classes = array();
        }
        // base button class
        if (!in_array('btn', $classes) ) {
            $classes[] = 'btn';
        }
        // button style
        if (isset($this->data['buttonStyle'])) {
            $styleClass = 'btn-' . strtolower($this->data['buttonStyle']);
            if (!in_array($styleClass, $classes)) {
                $classes[] = $styleClass;
            }
        }
        // button size
        if (isset($this->data['buttonSize']) && array_key_exists($this->data['buttonSize'], $this->sizes)) {
            $sizeClass = $this->sizes[$this->data['buttonSize']];
            if (!empty($sizeClass) && !in_array($sizeClass, $classes)) {
                $classes[] = $sizeClass;
            }
        }
        // button active
        if (isset($this->data['buttonActive']) && (bool) $this->data['buttonActive'] && !in_array('active', $classes)) {
            $classes[] = 'active';
        }
        // button disabled
        if (isset($this->data['buttonDisabled']) && (bool) $this->data['buttonDisabled'] && !in_array('disabled', $classes)) {
            $classes[] = 'disabled';
        }

        // make the replacement
        $classAttr = implode(' ', $classes);
        if (empty($matches)) {
            $html = str_replace('<a ', '<a class="' . $classAttr . '" ', $html);
        } else {
            $html = preg_replace('/^<a(.*?)class=[\'"](.*?)[\'"]/i', "<a$1class=\"$classAttr\"", $html);
        }
        return $html;
    }

    /**
     * @see Document\Tag\TagInterface::getType
     * @return string
     */
    public function getType()
    {
        return "button";
    }

}
