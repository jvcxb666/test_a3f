<?php

require 'vendor/autoload.php';

use App\Parser;
use App\Cache;

$url = 'www.php.net';

try{
    $parser = new Parser($url);
    $result = $parser->getTags();
    $count = $parser->getCount();

    $cache = new Cache($url);
    $cache->setData($result,$count);
    $cache->writeFile();
    $cache->clear();
}catch(\Exception $e){
    echo 'Error '.$e->getMessage();
}

?>