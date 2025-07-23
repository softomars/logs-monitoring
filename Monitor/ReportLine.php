<?php

declare(strict_types=1);

namespace Monitor;

class ReportLine
{
    /**
     * @param string $level
     * @param string $message
     */
    public function __construct(
        public string $level,
        public string $message
    ) {}
}
