<?php

namespace MuchoMasFacil\WysiwygBundle\Controller;

use MuchoMasFacil\WysiwygBundle\Controller\Controller;

class WysiwygFlavorsController extends Controller
{
    public function ckeditor4DefaultAction($selector, $template = null, $flavor_key = null)
    {
        $this->render_vars['selector'] = $selector;
        $this->render_vars['flavor_key'] = $flavor_key;
        if (empty($template)) {
            $template = $this->guessTemplateName(__FUNCTION__, 'js');
        }

        return $this->container->get('templating')->renderResponse($template, $this->render_vars);
    }

    public function tinymce4DefaultAction($selector, $template = null, $flavor_key = null)
    {
        $this->render_vars['selector'] = $selector;
        $this->render_vars['flavor_key'] = $flavor_key;
        if (empty($template)) {
            $template = $this->guessTemplateName(__FUNCTION__, 'js');
        }

        return $this->container->get('templating')->renderResponse($template, $this->render_vars);
    }

}
