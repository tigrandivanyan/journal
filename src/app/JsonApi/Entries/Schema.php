<?php

namespace App\JsonApi\Entries;

use Neomerx\JsonApi\Schema\SchemaProvider;
use App\Studio;


class Schema extends SchemaProvider
{

    /**
     * @var string
     */
    protected $resourceType = 'entries';

    /**
     * @param $resource
     *      the domain record being serialized.
     * @return string
     */
    public function getId($resource)
    {
        return (string) $resource->getRouteKey();
    }

    /**
     * @param $resource
     *      the domain record being serialized.
     * @return array
     */
    public function getAttributes($resource)
    {

        if($resource->studio_id){
            $studio = Studio::find($resource->studio_id);
        }

        return [
            'entry_id' => $resource->id,
            'tour' => $resource->tour,
            'occurred_at' => $resource->occurred_at,
            'user_id' => $resource->user_id,
            'description_type_id' => $resource->description_type_id,
            'description' => $resource->description,
            'current_rng_state' => $resource->current_rng_state,
            'chef_id' => $resource->chef_id,
            'studio_id' => $resource->studio_id,
            'rng_id' => $studio->rng_id,
            'announcement' => $resource->announcement,
            'announcement_del' => $resource->announcement_del,
            'mail' => $resource->mail,
            'created-at' => $resource->created_at,
            'updated-at' => $resource->updated_at,
        ];
    }


    public function getRelationships($resource, $isPrimary, array $includeRelationships)
    {
        return [
            'user' => [
                self::SHOW_SELF => true,
                self::SHOW_RELATED => true,
            ],
            'type' => [
                self::SHOW_SELF => true,
                self::SHOW_RELATED => true,
            ],
            'chef' => [
                self::SHOW_SELF => true,
                self::SHOW_RELATED => true,
            ],
            'studio' => [
                self::SHOW_SELF => true,
                self::SHOW_RELATED => true,
            ]
        ];
    }



}
