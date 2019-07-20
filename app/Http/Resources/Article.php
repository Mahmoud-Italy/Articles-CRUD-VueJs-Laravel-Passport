<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Helper;

class Article extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'name' => $this->name,
            'image' => $this->image,
            'title' => $this->title,
            'body' => $this->body,
            'created_at' => Helper::timeElapsed($this->created_at)
        ];
    }

    public function with($request) 
    {
        return [
            'version' => '1.0.0',
            'author' => ''
        ];
    }
}
