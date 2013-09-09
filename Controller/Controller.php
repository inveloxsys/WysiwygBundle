<?php

namespace MuchoMasFacil\WysiwygBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerAware;



class Controller extends ContainerAware
{

    protected $render_vars = array();

    function __construct()
    {
        list($bundle_name, $controller_name) = $this->guessBundleAndControllerName($this);
        list($parent_bundle_name, $parent_controller_name) = $this->guessBundleAndControllerName(__CLASS__);

        $this->render_vars['bundle_name'] = $bundle_name;
        $this->render_vars['controller_name'] = $controller_name;
        $this->render_vars['parent_bundle_name'] = $parent_bundle_name;
        $this->render_vars['parent_controller_name'] = $parent_controller_name;
    }


    protected function guessBundleAndControllerName($bundle_class_name)
    {
        $reflector = new \ReflectionClass($bundle_class_name);
        $class_name = $reflector->getName();
        // get string left of \Controller\
        $bundle_name = strstr($class_name, '\\Controller\\', true);
        // get string right of \Controller\
        $controller_name = str_replace($bundle_name . '\\Controller\\', '', $class_name);
        // remove final Controller part
        $controller_name = str_replace('Controller', '', $controller_name);
        // join bundle parts to form bundle name
        $bundle_name = str_replace('\\', '', $bundle_name);

        return array($bundle_name, $controller_name);
    }

    protected function guessTemplateName($action_function_name, $template_format = 'html')
    {
        $this->render_vars['action_name'] = str_replace('Action', '', $action_function_name);

        return $this->render_vars['bundle_name'] . ':' . $this->render_vars['controller_name'] . ':' . $this->render_vars['action_name'] . '.'.$template_format.'.twig';
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
    protected function forward($controller, array $path = array(), array $query = array())
    {
        $path['_controller'] = $controller;
        $subRequest = $this->container->get('request')->duplicate($query, null, $path);

        return $this->container->get('http_kernel')->handle($subRequest, HttpKernelInterface::SUB_REQUEST);
    }
}
