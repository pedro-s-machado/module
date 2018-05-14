<?php
namespace ItemExtend\Api\Representation;

use Omeka\Api\Representation\AbstractEntityRepresentation;

class MappingMarkerRepresentation extends AbstractEntityRepresentation
{
    public function getJsonLdType()
    {
        return 'o-module-itemextend';
    }

    public function getJsonLd()
    {
        return [
            'o-module-itemextend:text' => $this->text(),
        ];
    }

    public function text()
    {
        return $this->resource->getText();
    }
}