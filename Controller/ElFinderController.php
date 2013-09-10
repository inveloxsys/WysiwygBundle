<?php

namespace MuchoMasFacil\WysiwygBundle\Controller;

use MuchoMasFacil\WysiwygBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Response;

use MuchoMasFacil\WysiwygBundle\ElFinder\Connector;

class ElFinderController extends Controller
{

    public function indexAction($selector, $elfinder_flavor_key = 'images')
    {     

        $flavors = $this->container->getParameter('mucho_mas_facil_wysiwyg.elfinder.flavors');        
        if (!isset($flavors[$elfinder_flavor_key])) {
            throw new \Exception('The flavor with key `'. $elfinder_flavor_key .'` is not defined in mucho_mas_facil_wysiwyg.elfinder.flavors configuration');
        }        
        $settings = $flavors[$elfinder_flavor_key];
        if (empty($settings['template'])) {
            $settings['template'] = 'MuchoMasFacilWysiwygBundle:ElFinderFlavors:elFinder.js.twig';
        }

        $response = $this->forward($settings['action'], array(
            'selector'  => $selector,
            'template' => $settings['template'],
            'elfinder_flavor_key' => $elfinder_flavor_key,
        ));

        return $response;
    }

    public function standAloneAction( $elfinder_flavor_key = 'images')
    {
        $this->render_vars['elfinder_flavor_key'] = $elfinder_flavor_key;
        return $this->container->get('templating')->renderResponse($this->guessTemplateName(__FUNCTION__), $this->render_vars);
    }

    public function elfinderConnectorAction( $elfinder_flavor_key = 'images')
    {
        //https://github.com/Studio-42/elFinder/wiki/Connector-configuration-options        
        $opts = array(
            // 'debug' => true,
            'roots' => array(
                array(
                    'driver'        => 'LocalFileSystem',   // driver for accessing file system (REQUIRED)
                    'path'          => '/home/alvaro/workspace/ipe/web/uploads/',         // path to files (REQUIRED)
                    'URL'           => 'http://ipe/uploads/', // URL to files (REQUIRED)
                    'uploadAllow'   => array('image'), # allow any images
                    'uploadAllow'   => array('image/png', 'application/x-shockwave-flash'), # allow png and flash
                    'uploadMaxSize' => '2M'

//Maximum upload file size. This size is per files. Can be set as number or string with unit 10M, 500K, 1G.
                    //'accessControl' => 'access'             // disable and hide dot starting files (OPTIONAL)
                )
            )
        );

        
        $connector = new Connector($opts);
        
        return new Response($connector);
    }


}
