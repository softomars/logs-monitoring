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

$options = getopt('', ['input:', 'output:']);

if (!isset($options['input'], $options['output'])) {
    echo "Usage: php main.php --input=/path/to/logs.log --output=/path/to/report.log";
    exit(1);
}

$command = new LogMonitorCommand();
$command->run($options['input'], $options['output']);

echo "Report written successfully\n";
