<?php

declare(strict_types=1);

namespace Monitor\Handler;

use Monitor\Job;
use Monitor\ReportLine;

interface HandlerInterface
{
    /**
     * @param Job $job
     * @return ReportLine|null
     */
    public function handle(Job $job): ?ReportLine;

    /**
     * @return bool
     */
    public function shouldBreak(): bool;
}
