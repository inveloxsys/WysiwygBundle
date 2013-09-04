<?php

namespace MuchoMasFacil\WysiwygBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerAware;

class DefaultController extends ContainerAware
{
    public function indexAction($selector, $settings_key)
    {
        $flavors = $this->container->getParameter('mucho_mas_facil_wysiwyg.flavors');
        if (!isset($flavors[$settings_key])) {
            throw new \Exception('The flavor with key `'. $settings_key .'` is not defined in mucho_mas_facil_wysiwyg.flavors configuration');
        }
        $settings = $flavors[$settings_key];
        $response = $this->container->get('http_kernel')->forward($settings['action'], array(
            'selector'  => $selector,
            'template' => $settings['template'],
        ));

        return $response;
    }
}
