<?php

namespace Yab\FlightDeck\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class APIResource extends JsonResource
{
    /**
     * Extend the JsonResource class to create our own APIResource
     *
     * @param mixed $resource
     * @param string $message
     */
    public function __construct($resource, string $message = null)
    {
        parent::__construct($resource);

        $this->additional([
            'success' => true,
            'message' => $message ?? 'Your request was successful.',
            'data' => [
                $resource->toArray(),
            ],
        ]);
    }
}
