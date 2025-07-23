<?php

declare(strict_types=1);

namespace Monitor\Handler;

use Monitor\Job;

class ErrorHandler extends AbstractHandler
{
    const LOG_LEVEL = 'Error';

    /**
     * {@inheritDoc}
     */
    public function shouldBreak(): bool
    {
        // Assuming we don't want to have warnings also for these jobs
        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function getPriority(): int
    {
        return 1;
    }

    /**
     * {@inheritDoc}
     */
    public function isApplicable(Job $job): bool
    {
        return $job->getDuration() > 600;
    }
}
