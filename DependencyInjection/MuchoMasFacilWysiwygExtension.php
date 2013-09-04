<?php

namespace MuchoMasFacil\WysiwygBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class MuchoMasFacilWysiwygExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        //first load services and definitions
        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        //with definitios we make a mergue
        //and add them to our list
        $parameter_configs[] = array(
            'flavors'  => $container->getParameter('mucho_mas_facil_wysiwyg.flavors'),
            //'elfinder_settings'  => $container->getParameter('mucho_mas_facil_wysiwyg.elfinder_settings'),
            );

        $configuration = new Configuration();
        $final_config = $this->processConfiguration($configuration, array_merge($parameter_configs, $configs));

        $container->setParameter('mucho_mas_facil_wysiwyg.flavors', $final_config['flavors']);
        //$container->setParameter('mucho_mas_facil_wysiwyg.elfinder_settings', $final_config['elfinder_settings']);
    }
}
