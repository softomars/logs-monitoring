<?php
spl_autoload_register(function($className)
{
    $namespace=str_replace("\\", "/", __NAMESPACE__);
    $className=str_replace("\\", "/", $className);
    $class= __DIR__ . DIRECTORY_SEPARATOR . (empty($namespace) ? "" : $namespace . "/") . "{$className}.php";
    include_once($class);
});

use Monitor\LogMonitorCommand;

$options = getopt('', ['input:', 'output:']);

if (!isset($options['input'], $options['output'])) {
    echo "Usage: php main.php --input=/path/to/logs.log --output=/path/to/report.log";
    exit(1);
}

$command = new LogMonitorCommand();
$command->run($options['input'], $options['output']);

echo "Report written successfully\n";
