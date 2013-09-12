<?php

namespace MuchoMasFacil\WysiwygBundle\Controller;

use MuchoMasFacil\WysiwygBundle\Controller\Controller;

class ElFinderFlavorsController extends Controller
{
    public function defaultAction($selector, $template = null, $elfinder_flavor_key = 'default', $elfinder_connector_key = 'images')
    {
        $this->render_vars['selector'] = $selector;
        $this->render_vars['elfinder_flavor_key'] = $elfinder_flavor_key;
        $this->render_vars['elfinder_connector_key'] = $elfinder_connector_key;
        if (empty($template)) {
            $template = $this->guessTemplateName(__FUNCTION__, 'js');
        }

        return $this->container->get('templating')->renderResponse($template, $this->render_vars);
    }

    public function ckeditor4Action($selector, $template = null, $elfinder_flavor_key = 'default', $elfinder_connector_key = 'images')
    {
        $this->render_vars['selector'] = $selector;
        $this->render_vars['elfinder_flavor_key'] = $elfinder_flavor_key;
        $this->render_vars['elfinder_connector_key'] = $elfinder_connector_key;
        if (empty($template)) {
            $template = $this->guessTemplateName(__FUNCTION__, 'js');
        }

        return $this->container->get('templating')->renderResponse($template, $this->render_vars);
    }

    public function tinymce4Action($selector, $template = null, $elfinder_flavor_key = 'default', $elfinder_connector_key = 'images')
    {
        $this->render_vars['selector'] = $selector;
        $this->render_vars['elfinder_flavor_key'] = $elfinder_flavor_key;
        $this->render_vars['elfinder_connector_key'] = $elfinder_connector_key;
        if (empty($template)) {
            $template = $this->guessTemplateName(__FUNCTION__, 'js');
        }

        return $this->container->get('templating')->renderResponse($template, $this->render_vars);
    }

}
