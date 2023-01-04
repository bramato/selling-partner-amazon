<?php

namespace Bramatom\SellingPartnerAmazon\classes;

class AmazonMarketplaceData
{
    private static $marketplaces = [];

    public static function getAll():array
    {
        if (empty(self::$marketplaces)) {
            self::initMarketplaces();
        }
        return self::$marketplaces;
    }

    public static function getById($id)
    {
        if (empty(self::$marketplaces)) {
            self::initMarketplaces();
        }
        foreach (self::$marketplaces as $marketplace) {
            if ($marketplace['id'] === $id) {
                return $marketplace;
            }
        }
        return null;
    }

    private static function initMarketplaces(): void
    {
        self::$marketplaces = [
            [
                'id' => AmazonMarketplaceId::EUROPE_ITALY,
                'name' => 'Italy (EU)',
                'zone' => AmazonMarketplaceZone::EUROPE,
                'endpoint' => AmazonSellingPartnerZoneEndpoint::EUROPE,
            ],
            [
                'id' => AmazonMarketplaceId::EUROPE_GERMANY,
                'name' => 'Germany (EU)',
                'zone' => AmazonMarketplaceZone::EUROPE,
                'endpoint' => AmazonSellingPartnerZoneEndpoint::EUROPE,
            ],
            [
                'id' => AmazonMarketplaceId::EUROPE_FRANCE,
                'name' => 'France (EU)',
                'zone' => AmazonMarketplaceZone::EUROPE,
                'endpoint' => AmazonSellingPartnerZoneEndpoint::EUROPE,
            ],
            [
                'id' => AmazonMarketplaceId::EUROPE_SPAIN,
                'name' => 'Spain (EU)',
                'zone' => AmazonMarketplaceZone::EUROPE,
                'endpoint' => AmazonSellingPartnerZoneEndpoint::EUROPE,
            ],


            // altri marketplace...
        ];
    }
}
