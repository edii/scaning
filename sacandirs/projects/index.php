<?php

require_once 'lib/Scandir.class.php';
require_once 'lib/Validate.class.php';

use lib\ScanDirs;
use lib\Validate;

$useFilePath = __DIR__.DIRECTORY_SEPARATOR.'dir'.DIRECTORY_SEPARATOR.'ава2.jpg';

$validators = new Validate();
$objectScan = ScanDirs::getInstance();
$validators->isValidate(
    $useFilePath,
    $objectScan->inDirectory(__DIR__.DIRECTORY_SEPARATOR.'dir'.DIRECTORY_SEPARATOR, true)
);

var_dump($validators->getDuplicates());