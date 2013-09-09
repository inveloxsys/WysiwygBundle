<?php

namespace MuchoMasFacil\WysiwygBundle\Controller;

use MuchoMasFacil\WysiwygBundle\Controller\Controller;

class WysiwygController extends Controller
{

    public function indexAction($selector, $flavor_key)
    {        
        $flavors = $this->container->getParameter('mucho_mas_facil_wysiwyg.flavors');
        if (!isset($flavors[$flavor_key])) {
            throw new \Exception('The flavor with key `'. $flavor_key .'` is not defined in mucho_mas_facil_wysiwyg.flavors configuration');
        }
        $settings = $flavors[$flavor_key];
        $response = $this->forward($settings['action'], array(
            'selector'  => $selector,
            'template' => $settings['template'],
        ));

        return $response;
    }

    public function ckeditor4DefaultAction($selector, $template = null)
    {
        $this->render_vars['selector'] = $selector;
        if (empty($template)) {
            $template = $this->guessTemplateName(__FUNCTION__, 'js');
        }

        return $this->container->get('templating')->renderResponse($template, $this->render_vars);
    }

    public function tinymce4DefaultAction($selector, $template = null)
    {
        $this->render_vars['selector'] = $selector;
        if (empty($template)) {
            $template = $this->guessTemplateName(__FUNCTION__, 'js');
        }

        return $this->container->get('templating')->renderResponse($template, $this->render_vars);
    }

}
