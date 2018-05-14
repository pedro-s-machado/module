<?php

namespace ItemExtend\Omeka2Importer;

use Omeka2Importer\Importer\AbstractImporter;

class ExtensionImporter extends AbstractImporter
{
    public function import($itemData, $resourceJson)
    {
        $logger = $this->getServiceLocator()->get('Omeka\Logger');
        $extensionId = $itemData['extended_resources']['geolocations']['id'];
        if (empty($geolocationId)) {
            return $resourceJson;
        }
        $response = $this->client->geolocations->get($geolocationId);
        $geolocationsData = json_decode($response->getBody(), true);
        $resourceJson['o-module-itemextend:text'][] = [
            'o-module-itemextend:' => $geolocationsData['latitude'],            
        ];
        return $resourceJson;
    }
}