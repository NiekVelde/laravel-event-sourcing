<?php

namespace Spatie\EventSourcing\Tests\TestClasses\Projectors;

use Exception;
use Spatie\EventSourcing\Projectors\QueuedProjector;

class ProjectorThatThrowsAnException extends BalanceProjector implements QueuedProjector
{
    public function onMoneyAdded($event)
    {
        throw new Exception('Computer says no.');
    }
}
