<?php

namespace Yab\FlightDeck\Http\Resources;

use Yab\FlightDeck\Http\Resources\APIResource;

class UserResource extends APIResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
