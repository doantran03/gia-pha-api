<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'start' => $this->start
                ->setTimezone('Asia/Ho_Chi_Minh')
                ->format('Y-m-d H:i:s'),
            'end' => optional($this->end)
                ->setTimezone('Asia/Ho_Chi_Minh')
                ->format('Y-m-d H:i:s'),
            'allDay' => $this->all_day,
            'color' => $this->background_color,
            'url' => $this->when(
                !empty($this->link),
                $this->link
            ),
        ];
    }
}
