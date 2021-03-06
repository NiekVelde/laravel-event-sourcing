<?php

namespace Spatie\EventSourcing\Snapshots;

use Spatie\EventSourcing\Exceptions\InvalidEloquentSnapshotModel;

class EloquentSnapshotRepository implements SnapshotRepository
{
    protected $snapshotModel;

    public function __construct()
    {
        $this->snapshotModel = config('event-sourcing.snapshot_model', EloquentSnapshot::class);

        $class = new $this->snapshotModel();
        if (!($class instanceof EloquentSnapshot)) {
            throw new InvalidEloquentSnapshotModel("The class {$this->snapshotModel} must extend EloquentSnapshot");
        }
    }

    public function retrieve(string $aggregateUuid): ?Snapshot
    {
        /** @var \Illuminate\Database\Query\Builder $query */
        $query = $this->snapshotModel::query();

        if ($snapshot = $query->latest()->uuid($aggregateUuid)->first()) {
            return $snapshot->toSnapshot();
        }

        return null;
    }

    public function persist(Snapshot $snapshot): Snapshot
    {
        /** @var EloquentSnapshot $eloquentSnapshot */
        $eloquentSnapshot = new $this->snapshotModel();

        $eloquentSnapshot->aggregate_uuid = $snapshot->aggregateUuid;
        $eloquentSnapshot->aggregate_version = $snapshot->aggregateVersion;
        $eloquentSnapshot->state = $snapshot->state;

        $eloquentSnapshot->save();

        return $eloquentSnapshot->toSnapshot();
    }
}
