<?php

declare(strict_types=1);

namespace Monitor;

use RuntimeException;

class ReportGenerator
{
    /**
     * @param string $outputFile
     */
    public function __construct(private string $outputFile) {}

    /**
     * @param ReportLine[] $reportLines
     * @return void
     */
    public function generate(array $reportLines): void
    {
        $handle = fopen($this->outputFile, 'w');
        if (!$handle) {
            throw new RuntimeException("Cannot open file: {$this->outputFile}");
        }

        foreach ($reportLines as $line) {
            fwrite($handle, "[{$line->level}] {$line->message}\n");
        }

        fclose($handle);
    }
}
