<?php

namespace Modules\Appointment\Transformers;

use App\Http\Resources\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class MeetingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'starts_at' => $this->starts_at,
            'ends_at' => $this->ends_at,
            'notes' => $this->notes,
            'status' => $this->status,
            'title' => $this->title,
            'user' => $this->whenLoaded('user', fn() => new UserResource($this->user)),
        ];
    }
}
