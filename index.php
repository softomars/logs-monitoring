<?php
spl_autoload_register(function($className)
{
    $namespace=str_replace("\\", "/", __NAMESPACE__);
    $className=str_replace("\\", "/", $className);
    $class= __DIR__ . DIRECTORY_SEPARATOR . (empty($namespace) ? "" : $namespace . "/") . "{$className}.php";
    include_once($class);
});

use Monitor\LogMonitorCommand;
$command = new LogMonitorCommand();
$command->run('/workspace/notebook/logs.log', '/workspace/notebook/output.log');


