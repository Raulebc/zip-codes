<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ZipCodeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'zip_code'       => $this->id,
            'locality'       => $this->locality,
            'federal_entity' => $this->federal_entity,
            'settlements'    => $this->settlements,
            'municipality'   => $this->municipality,
        ];
    }
}
