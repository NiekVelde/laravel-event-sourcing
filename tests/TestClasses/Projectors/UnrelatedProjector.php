<?php

namespace Spatie\EventSourcing\Tests\TestClasses\Projectors;

use Exception;
use Illuminate\Support\Collection;
use Spatie\EventSourcing\Projectors\Projector;
use Spatie\EventSourcing\Projectors\ProjectsEvents;
use Spatie\EventSourcing\StoredEvent;

class UnrelatedProjector implements Projector
{
    use ProjectsEvents;

    public function getName(): string
    {
        return get_class($this);
    }

    public function shouldBeCalledImmediately(): bool
    {
        return false;
    }

    public function handles(): array
    {
        return [];
    }

    public function handle(StoredEvent $event)
    {

    }

    public function handleException(Exception $exception): void
    {

    }

    public function getEventHandlingMethods(): Collection
    {
        return collect();
    }
}
