<?php

namespace MuchoMasFacil\WysiwygBundle\Controller;

use MuchoMasFacil\WysiwygBundle\Controller\Controller;

use MuchoMasFacil\WysiwygBundle\ElFinder\Connector;

class ElFinderConnectorsController extends Controller
{
    public function defaultAction($elfinder_connector_key)
    {        
        $connectors = $this->container->getParameter('mucho_mas_facil_wysiwyg.elfinder_connectors');        
        if (!isset($connectors[$elfinder_connector_key])) {
            throw new \Exception('The connector with key `'. $elfinder_connector_key .'` is not defined in mucho_mas_facil_wysiwyg.elfinder_connectors configuration');
        }        
        $settings = $connectors[$elfinder_connector_key];
        $options = $settings['options'];
        //try to guess URL from path        
        if (isset($options['roots'])) {
            foreach ($options['roots'] as $key => $root_options) {
                if ($root_options['driver'] == 'LocalFileSystem') {
                    if  (empty($root_options['URL'])) {
                        $options['roots'][$key]['URL'] = $this->guessElFinderURLFromPath($root_options['path']);                    
                    }
                } 
            }
        }
        
        $connector = new Connector($options);
        
        return new Response($connector);
    }

    protected function guessElFinderURLFromPath($path)
    {
        $request = $this->container->get('request');
        $default_web_dir = $this->container->get('kernel')->getRootDir() . '/../web';
        return $request->getSchemeAndHttpHost() . str_replace($default_web_dir, '', $path);
    }


}
