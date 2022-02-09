<?php

class StoreService {

    public function getStoreCoordinates(Store $store): string {
        $geoService = new GoogleMaps();
        return $geoService->getCoordinates($store->getAddress());
    }

}
