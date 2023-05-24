<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{

    public function toArray($request)
    {
        $data = [
            "ID"                => $this->id,
            "Name"              => $this->name,
            "Photo"             => $this->photo,
            "Email"             => $this->email,
            "PhoneNumber"       => $this->phone,
            "Long"              => $this->long,
            "Lat"               => $this->lat,
            "FirebaseToken"     => $this->fcm_token ?? "",
            "ApiKey"            => $this->api_key ?? "",
        ];


        return $data;
    }
}
