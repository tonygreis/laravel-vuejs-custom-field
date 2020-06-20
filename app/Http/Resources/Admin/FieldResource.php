<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class FieldResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
          'id' => $this->id,
          'name' => $this->name,
          'type' => $this->type,
            'max' => $this->max,
            'default' => $this->default,
            'help' => $this->help,
            'required' => $this->required,
            'active' => $this->active,
            'options' => OptionResource::collection($this->options)
        ];
    }
}
