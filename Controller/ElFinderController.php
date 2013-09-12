<?php

namespace MuchoMasFacil\WysiwygBundle\Controller;

use MuchoMasFacil\WysiwygBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Response;

class ElFinderController extends Controller
{

    public function indexAction($selector, $elfinder_flavor_key = 'default', $elfinder_connector_key = 'images')
    {     

        $flavors = $this->container->getParameter('mucho_mas_facil_wysiwyg.elfinder_flavors');        
        if (!isset($flavors[$elfinder_flavor_key])) {
            throw new \Exception('The flavor with key `'. $elfinder_flavor_key .'` is not defined in mucho_mas_facil_wysiwyg.elfinder_flavors configuration');
        }        
        $settings = $flavors[$elfinder_flavor_key];

        $response = $this->forward($settings['action'], array(
            'selector'  => $selector,
            'template' => $settings['template'],
            'elfinder_flavor_key' => $elfinder_flavor_key,
            'elfinder_connector_key' => $elfinder_connector_key,
        ), $this->container->get('request')->query->all());
        
        
        return $response;
    }

    public function elfinderConnectorAction( $elfinder_connector_key = 'images')
    {     
        $connectors = $this->container->getParameter('mucho_mas_facil_wysiwyg.elfinder_connectors');        
        if (!isset($connectors[$elfinder_connector_key])) {
            throw new \Exception('The connector with key `'. $elfinder_connector_key .'` is not defined in mucho_mas_facil_wysiwyg.elfinder_connectors configuration');
        }        
        $settings = $connectors[$elfinder_connector_key];
        $response = $this->forward($settings['action'], array(
            'elfinder_connector_key' => $elfinder_connector_key,
        ));
        
        return $response;
    }

    public function standAloneAction( $elfinder_flavor_key = 'default', $elfinder_connector_key = 'images')
    {
        $this->render_vars['elfinder_flavor_key'] = $elfinder_flavor_key;
        $this->render_vars['elfinder_connector_key'] = $elfinder_connector_key;

        return $this->container->get('templating')->renderResponse($this->guessTemplateName(__FUNCTION__), $this->render_vars);
    }


}
