<?php
spl_autoload_register(function($className)
{
    $className = str_replace('\\', '/', $className);
    $classPath = __DIR__ . '/' . $className . '.php';

    if (file_exists($classPath)) {
        include_once $classPath;
    }
});

use Monitor\LogMonitorCommand;
$command = new LogMonitorCommand();
$command->run('/workspace/notebook/logs.log', '/workspace/notebook/output.log');


