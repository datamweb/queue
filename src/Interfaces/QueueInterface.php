<?php

declare(strict_types=1);

namespace CodeIgniter\Queue\Interfaces;

use CodeIgniter\Queue\Entities\QueueJob;
use Throwable;

interface QueueInterface
{
    public function push(string $queue, string $job, array $data);

    public function pop(string $queue, array $priorities);

    public function later(QueueJob $queueJob, int $seconds);

    public function failed(QueueJob $queueJob, Throwable $err, bool $keepJob);

    public function done(QueueJob $queueJob, bool $keepJob);

    public function clear(?string $queue = null);

    public function retry(?int $id, ?string $queue);

    public function forget(int $id);

    public function flush(?int $hours, ?string $queue);

    public function listFailed(?string $queue);
}
