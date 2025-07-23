<?php

declare(strict_types=1);

namespace Monitor;

use DateTimeImmutable;

class Job
{
    /**
     * @param string $pid
     * @param string $description
     * @param DateTimeImmutable $start
     * @param DateTimeImmutable|null $end
     */
    public function __construct(
        public string $pid,
        public string $description,
        public DateTimeImmutable $start,
        public ?DateTimeImmutable $end = null
    ) {}

    /**
     * @param DateTimeImmutable $end
     * @return void
     */
    public function setEnd(DateTimeImmutable $end): void
    {
        $this->end = $end;
    }

    /**
     * @return int|null
     */
    public function getDuration(): ?int
    {
        return $this->end ? $this->end->getTimestamp() - $this->start->getTimestamp() : null;
    }
}