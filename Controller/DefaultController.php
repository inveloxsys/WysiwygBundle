<?php

namespace MuchoMasFacil\WysiwygBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerAware;

use MuchoMasFacil\WysiwygBundle\ElFinder\Connector;

class DefaultController extends ContainerAware
{
    public function indexAction($selector, $settings_key)
    {
        $opts = array(
            // 'debug' => true,
            'roots' => array(
                array(
                    'driver'        => 'LocalFileSystem',   // driver for accessing file system (REQUIRED)
                    'path'          => '/home/alvaro/workspace/ipe/web/uploads/',         // path to files (REQUIRED)
                    'URL'           => 'http://ipe/uploads/', // URL to files (REQUIRED)
                    //'accessControl' => 'access'             // disable and hide dot starting files (OPTIONAL)
                )
            )
        );

        
        $connector = new Connector($opts);
        
        return new Response($connector);

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
