<?php

namespace App\Http\Resources\Project;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
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
            'type' => $this->type,
            'title' => $this->title,
            'is_on_time' => $this->is_on_time ? 'Yes' : 'No',
            'is_chain' => $this->is_chain ? 'Yes' : 'No',
            'deadline' => isset($this->deadline) ? $this->deadline->format('Y-m-d') : '',
            'date_of_create' => $this->date_of_create->format('Y-m-d'),
            'created_at' => $this->created_at->format('Y-m-d'),
            'contracted_at' => $this->contracted_at->format('Y-m-d'),
            'has_investors' => $this->has_investors ? 'Yes' : 'No',
            'has_outsource' => $this->has_outsource ? 'Yes' : 'No',
            'worker_count' => $this->worker_count,
            'service_count' => $this->service_count,
        ];
    }
}
