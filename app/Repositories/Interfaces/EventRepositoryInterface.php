<?php

namespace App\Repositories\Interfaces;

use App\Models\Event;
use Illuminate\Support\Collection;

interface EventRepositoryInterface
{
    public function all(): Collection;

    public function find(int $id): ?Event;
    
    public function create(array $data): Event;

    public function update(Event $event, array $data): Event;

    public function delete(Event $event): bool;
}
