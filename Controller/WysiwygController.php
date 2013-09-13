<?php

namespace MuchoMasFacil\WysiwygBundle\Controller;

use MuchoMasFacil\WysiwygBundle\Controller\Controller;

class WysiwygController extends Controller
{

    public function indexAction($selector, $flavor_key, Request $request)
    {        
        $flavors = $this->container->getParameter('mucho_mas_facil_wysiwyg.flavors');
        if (!isset($flavors[$flavor_key])) {
            throw new \Exception('The flavor with key `'. $flavor_key .'` is not defined in mucho_mas_facil_wysiwyg.flavors configuration');
        }
        $settings = $flavors[$flavor_key];
        $response = $this->forward($settings['action'], array(
            'selector'  => $selector,
            'template' => $settings['template'],
            'flavor_key' => $flavor_key,
        ), $request->query->all());

        return $response;
    }

}
