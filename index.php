<?php

require_once 'library/framework/Autoloader.php';
$autoloader = Framework_Autoloader::getInstance();
$autoloader->addDir('app')
    ->addDir('library');

$database = new Framework_Database();
$database->setAdapter(new Framework_Database_Adapter_Mysql());
$connection = $database->getConnection('localhost', 'database', 'root', 'pass');

$modelRegistry = Framework_Model_Registry::getInstance();
$modelRegistry->setConnection($connection);

$mvc = Framework_Mvc::getInstance();
$mvc->setDefaultRoute(array('Book', 'overview'));
$output = $mvc->run()->getOutput();

$request = new Framework_Controller_Request();

if ($request->has('ajax')) {
    echo $output;
}
else {
    $layout = new Framework_Layout();

    $layout->load('Default');
    $layout->mvc = $output;

    echo $layout->render();
}