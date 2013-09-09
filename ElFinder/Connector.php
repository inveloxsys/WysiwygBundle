<?php 

namespace MuchoMasFacil\WysiwygBundle\ElFinder;


require dirname(__FILE__).'/../../../../../component/elfinder/php/elFinderConnector.class.php';
require dirname(__FILE__).'/../../../../../component/elfinder/php/elFinder.class.php';
require dirname(__FILE__).'/../../../../../component/elfinder/php/elFinderVolumeDriver.class.php';
require dirname(__FILE__).'/../../../../../component/elfinder/php/elFinderVolumeLocalFileSystem.class.php';
require dirname(__FILE__).'/../../../../../component/elfinder/php/elFinderVolumeMySQL.class.php';
require dirname(__FILE__).'/../../../../../component/elfinder/php/elFinderVolumeFTP.class.php';

class Connector
{
    public function __construct($opts)
    {
        // run elFinder
        $connector = new \elFinderConnector(new \elFinder($opts));
        return $connector->run();    
    }
    
}