<?php

namespace MuchoMasFacil\WysiwygBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpKernel\HttpKernelInterface;

use MuchoMasFacil\WysiwygBundle\ElFinder\Connector;

class DefaultController extends ContainerAware
{
    public function indexAction($selector, $flavor_key)
    {
        // $opts = array(
        //     // 'debug' => true,
        //     'roots' => array(
        //         array(
        //             'driver'        => 'LocalFileSystem',   // driver for accessing file system (REQUIRED)
        //             'path'          => '/home/alvaro/workspace/ipe/web/uploads/',         // path to files (REQUIRED)
        //             'URL'           => 'http://ipe/uploads/', // URL to files (REQUIRED)
        //             //'accessControl' => 'access'             // disable and hide dot starting files (OPTIONAL)
        //         )
        //     )
        // );


        // $connector = new Connector($opts);

        // return new Response($connector);

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

    /**
     * Forwards the request to another controller.
     *
     * @param string $controller The controller name (a string like BlogBundle:Post:index)
     * @param array  $path       An array of path parameters
     * @param array  $query      An array of query parameters
     *
     * @return Response A Response instance
     */
    private function forward($controller, array $path = array(), array $query = array())
    {
        $path['_controller'] = $controller;
        $subRequest = $this->container->get('request')->duplicate($query, null, $path);

        return $this->container->get('http_kernel')->handle($subRequest, HttpKernelInterface::SUB_REQUEST);
    }
}
