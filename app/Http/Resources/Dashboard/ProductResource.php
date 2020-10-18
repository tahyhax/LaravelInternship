<?php

namespace App\Http\Resources\Dashboard;

use Illuminate\Http\Resources\Json\JsonResource;
//use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

//        return [
//            'data' => $this->collection
//            'id' => $this->id,
//            'name' => $this->name,
//            'categories' =>   CategoryResource::collection($this->whenLoaded($this->categories)),
//            'created_at' => $this->created_at,
//            'updated_at' => $this->updated_at,
//        ];
//        echo(json_encode($request));
        return parent::toArray($request);
    }
}
