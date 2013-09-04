<?php

namespace MuchoMasFacil\WysiwygBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerAware;

class FlavorsController extends ContainerAware
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

    public function ckeditor4DefaultAction($selector, $template = null)
    {
        $this->render_vars['selector'] = $selector;
        if (empty($template)) {
            $template = $this->guessTemplateName(__FUNCTION__, 'js');
        }

        return $this->container->get('templating')->renderResponse($template, $this->render_vars);
    }

    public function tinymce4DefaultAction($selector, $template = null)
    {
        $this->render_vars['selector'] = $selector;
        if (empty($template)) {
            $template = $this->guessTemplateName(__FUNCTION__, 'js');
        }

        return $this->container->get('templating')->renderResponse($template, $this->render_vars);
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
}
