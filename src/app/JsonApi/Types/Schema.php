<?php

namespace App\JsonApi\Types;

use Neomerx\JsonApi\Schema\SchemaProvider;

class Schema extends SchemaProvider
{

    /**
     * @var string
     */
    protected $resourceType = 'types';

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
        return [
            'entrie_type_id' => $resource->id,
            'eng_name' => $resource->eng_name,
            'ru_name' => $resource->ru_name,
            'email' => $resource->email,
            'allow_to_edit' => $resource->allow_to_edit,
            'created-at' => $resource->created_at->toAtomString(),
            'updated-at' => $resource->updated_at->toAtomString(),
        ];
    }



    public function getRelationships($resource, $isPrimary, array $includeRelationships)
    {
        return [
            'entry' => [
                self::SHOW_SELF => true,
                self::SHOW_RELATED => true,
            ]
        ];
    }

}
