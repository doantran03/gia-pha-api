<?php

namespace App\Repositories\Eloquent;

use App\Models\Event;
use Illuminate\Support\Collection;
use App\Repositories\Interfaces\EventRepositoryInterface;

class EventRepository implements EventRepositoryInterface
{   
    public function all(): Collection
    {
        return Event::with()->get();
    }

    public function find(int $id): ?Event
    {
        return Event::with()->find($id);
    }

    public function create(array $data): Event
    {
        return Event::create($data);
    }

    public function update(Event $event, array $data): Event
    {
        $event->update($data);
        return $event;
    }

    public function delete(Event $event): bool
    {
        return $event->delete();
    }
}
