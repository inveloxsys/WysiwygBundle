<?php

namespace MuchoMasFacil\WysiwygBundle\Controller;

use MuchoMasFacil\WysiwygBundle\Controller\Controller;

class ElFinderFlavorsController extends Controller
{
    public function imagesAction($selector, $template = null)
    {
        $this->render_vars['selector'] = $selector;
        if (empty($template)) {
            $template = $this->guessTemplateName(__FUNCTION__, 'js');
        }

        return $this->container->get('templating')->renderResponse($template, $this->render_vars);
    }

    public function pdfAction($selector, $template = null)
    {
        $this->render_vars['selector'] = $selector;
        if (empty($template)) {
            $template = $this->guessTemplateName(__FUNCTION__, 'js');
        }

        return $this->container->get('templating')->renderResponse($template, $this->render_vars);
    }

    public function genericAction($selector, $template = null)
    {
        $this->render_vars['selector'] = $selector;
        if (empty($template)) {
            $template = $this->guessTemplateName(__FUNCTION__, 'js');
        }

        return $this->container->get('templating')->renderResponse($template, $this->render_vars);
    }

}
