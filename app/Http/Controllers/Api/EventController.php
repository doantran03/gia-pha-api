<?php

namespace App\Http\Controllers\Api;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $events = Event::orderBy('start')->get();

        return response()->json([
            'success' => true,
            'data' => $events
        ]);
    }
}
