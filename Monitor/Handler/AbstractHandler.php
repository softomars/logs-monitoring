<?php

declare(strict_types=1);

namespace Monitor\Handler;

use Monitor\Job;
use Monitor\ReportLine;

abstract class AbstractHandler implements HandlerInterface
{
    const LOG_LEVEL = 'Warning';

    /**
     * @param Job $job
     * @return ReportLine|null
     */
    public function handle(Job $job): ?ReportLine
    {
        $duration = $job->getDuration();
        if ($this->isApplicable($job)) {
            return new ReportLine(
                static::LOG_LEVEL,
                "Job {$job->description} (PID {$job->pid}) took {$duration} seconds."
            );
        }

        return null;
    }

    /**
     * @return bool
     */
    public function shouldBreak(): bool
    {
        return false;
    }

    /**
     * @return int
     */
    abstract public function getPriority(): int;

    /**
     * @param Job $job
     * @return bool
     */
    abstract public function isApplicable(Job $job): bool;
}
