<?php 

namespace App\Services;

use App\Models\Event;
use App\Repositories\Interfaces\EventRepositoryInterface;

class EventService 
{
    protected EventRepositoryInterface $eventRepository;

    public function __construct(EventRepositoryInterface $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    public function create(array $data): Event
    {
        return $this->eventRepository->create($data);
    }

    public function update(Event $event, array $data): Event
    {
        return $this->eventRepository->update($event, $data);
    }

    public function delete(Event $event): void
    {
        $this->eventRepository->delete($event);
    }
}