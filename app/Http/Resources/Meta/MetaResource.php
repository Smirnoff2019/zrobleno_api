<?php

namespace App\Http\Resources\Meta;

use App\Http\Resources\ApiResource;
use App\Http\Resources\Matables\MetablesResource;
use App\Http\Resources\Meta\MetaField\MetaFieldResource;
use App\Http\Resources\Meta\Parent\ParentMetaResource;
use App\Models\Metables\Metables;
use App\Schemes\Meta\MetaSchema;
use Illuminate\Http\Request;

class MetaResource extends ApiResource implements MetaSchema
{

    /**
     * HTTP response status message
     *
     * @var string
     */
    protected $responseMessage = 'Meta retrieved successfully!';

    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray( $request )
    {
        return [
            self::COLUMN_ID            => $this->{self::COLUMN_ID},
            self::COLUMN_SLUG          => $this->{self::COLUMN_SLUG},
            self::COLUMN_NAME          => $this->{self::COLUMN_NAME},
            self::COLUMN_DESCRIPTION   => $this->{self::COLUMN_DESCRIPTION},

            'parent'                   => $this->when(
                                              $this->parent,
                                              new ParentMetaResource($this->parent),
                                              null
                                          ),
            'metaField'               => $this->when(
                                              $this->metaFields,
                                              new MetaFieldResource($this->metaFields),
                                              null
                                          ),
            'action'                  => $this->whenPivotLoaded(
                                              Metables::TABLE,
                                              function() {
                                                  return $this->pivot->action ?? [];
                                              }
                                          ),

            'value'                   => $this->whenPivotLoaded(
                                              Metables::TABLE,
                                              function() {
                                                  return $this->pivot->value ?? [];
                                              }
                                          ),

            self::COLUMN_UPDATED_AT   => $this->{self::COLUMN_UPDATED_AT},
            self::COLUMN_CREATED_AT   => $this->{self::COLUMN_CREATED_AT},
        ];
    }

}
