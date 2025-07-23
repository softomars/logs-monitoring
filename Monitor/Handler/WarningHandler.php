<?php

declare(strict_types=1);

namespace Monitor\Handler;

use Monitor\Job;

class WarningHandler extends AbstractHandler
{
    /**
     * {@inheritDoc}
     */
    public function getPriority(): int
    {
        return 10;
    }

    /**
     * {@inheritDoc}
     */
    public function isApplicable(Job $job): bool
    {
        return $job->getDuration() > 300;
    }
}
