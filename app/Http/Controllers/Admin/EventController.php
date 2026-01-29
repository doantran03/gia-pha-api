<?php

namespace App\Http\Controllers\Admin;

use App\Models\Event;
use App\Services\EventService;
use App\Http\Requests\EventRequest;
use App\Http\Controllers\Controller;

class EventController extends Controller
{
    protected EventService $eventService;

    public function __construct(EventService $eventService)
    {
        $this->eventService = $eventService;
    }

    public function index()
    {
        $events = Event::orderBy('created_at', 'desc')->get();

        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(EventRequest $request)
    {
        $this->eventService->create($request->validated());

        return redirect()
            ->route('events.index')
            ->with('success', 'Sự kiện đã được tạo thành công.');
    }

    public function edit($eventId)
    {
        $event = Event::findOrFail($eventId);

        return view('admin.events.edit', compact('event'));
    }

    public function update(EventRequest $request, $eventId)
    {
        $event = Event::findOrFail($eventId);

        $this->eventService->update($event, $request->validated());
        
        return redirect()
            ->route('events.index')
            ->with('success', 'Sự kiện đã được cập nhật thành công.');
    }

    public function delete($eventId)
    {
        $event = Event::findOrFail($eventId);

        $this->eventService->delete($event);

        return redirect()
            ->route('events.index')
            ->with('success', 'Sự kiện đã được xóa thành công.');
    }
}
