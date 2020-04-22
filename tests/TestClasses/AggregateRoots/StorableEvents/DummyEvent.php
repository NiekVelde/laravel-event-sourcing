<?php

namespace Spatie\EventSourcing\Tests\TestClasses\AggregateRoots\StorableEvents;

use Spatie\EventSourcing\ShouldBeStored;

class DummyEvent implements ShouldBeStored
{
    public $integer;

    public function __construct(int $integer)
    {
        $this->integer = $integer;
    }
}
