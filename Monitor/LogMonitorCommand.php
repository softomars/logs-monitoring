<?php

declare(strict_types=1);

namespace Monitor;

use Monitor\Handler\ErrorHandler;
use Monitor\Handler\WarningHandler;

class LogMonitorCommand
{
    /**
     * @param string $inputFile
     * @param string $outputFile
     * @return void
     */
    public function run(string $inputFile, string $outputFile): void
    {
        $reader = new LogReader();
        $reader->addHandler(new ErrorHandler());
        $reader->addHandler(new WarningHandler());

        $reader->process($inputFile);

        $report = new ReportGenerator($outputFile);
        $report->generate($reader->getReportLines());
    }
}

