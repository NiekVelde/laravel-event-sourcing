<?php

namespace Spatie\EventSourcing\Tests\TestClasses\Projectors;

use Exception;
use Illuminate\Support\Collection;
use Spatie\EventSourcing\Projectors\Projector;
use Spatie\EventSourcing\Projectors\ProjectsEvents;
use Spatie\EventSourcing\StoredEvent;
use Spatie\EventSourcing\Tests\TestClasses\Events\MoneyAddedEvent;

class MoneyAddedCountProjector implements Projector
{
    use ProjectsEvents;

    protected $handlesEvents = [
        MoneyAddedEvent::class => 'onMoneyAdded',
    ];

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
        return $this->handlesEvents;
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

    public function onMoneyAdded(MoneyAddedEvent $event)
    {
        $event->account->addition_count += 1;

        $event->account->save();
    }
}
