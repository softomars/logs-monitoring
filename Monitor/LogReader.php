<?php

declare(strict_types=1);

namespace Monitor;

use Monitor\Handler\AbstractHandler;
use Monitor\Handler\HandlerInterface;
use DateTimeImmutable;

class LogReader
{
    /**
     * @var array
     */
    private array $handlers = [];

    /**
     * @var array
     */
    private array $reportLines = [];

    /**
     * @param HandlerInterface $handler
     * @return void
     */
    public function addHandler(HandlerInterface $handler): void
    {
        $this->handlers[] = $handler;
    }

    /**
     * @param string $filePath
     * @return void
     */
    public function process(string $filePath): void
    {
        usort($this->handlers, function(AbstractHandler $a, AbstractHandler $b) {
            return $a->getPriority() > $b->getPriority() ? 1 : -1;
        });
        $handle = fopen($filePath, 'r');
        $jobs = [];

        while (($line = fgets($handle)) !== false) {
            $parts = array_map('trim', explode(',', $line));

            if (count($parts) !== 4) {
                // invalid line
                continue;
            }

            [$time, $desc, $action, $pid] = $parts;
            $timestamp = DateTimeImmutable::createFromFormat('H:i:s', $time);

            if ($action === 'START') {
                $jobs[$pid] = new Job($desc, $pid, $timestamp);
            } elseif ($action === 'END' && isset($jobs[$pid])) {
                $jobs[$pid]->setEnd($timestamp);
                $this->triggerHandlers($jobs[$pid]);
                unset($jobs[$pid]);
            }
        }

        fclose($handle);
    }

    /**
     * @param Job $job
     * @return void
     */
    private function triggerHandlers(Job $job): void
    {
        foreach ($this->handlers as $handler) {
            $reportLine = $handler->handle($job);
            if ($reportLine) {
                $this->reportLines[] = $reportLine;
            }

            if ($reportLine && $handler->shouldBreak()) {
                break;
            }
        }
    }

    /**
     * @return ReportLine[]
     */
    public function getReportLines(): array
    {
        return $this->reportLines;
    }
}
