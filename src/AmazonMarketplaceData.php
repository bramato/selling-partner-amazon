<?php

namespace Bramatom\SellingPartnerAmazon;

class AmazonMarketplaceData
{
    /**
     * @var array
     */
    private static $marketplaces = [];

    /**
     * @return array
     */
    public static function getAll(bool $is_sandbox = false):array
    {
        if (empty(self::$marketplaces)) {
            self::initMarketplaces($is_sandbox);
        }
        return self::$marketplaces;
    }

    /**
     * @param $id
     *
     * @return mixed|null
     */
    public static function getById($id, bool $is_sandbox = false)
    {
        if (empty(self::$marketplaces)) {
            self::initMarketplaces($is_sandbox);
        }
        foreach (self::$marketplaces as $marketplace) {
            if ($marketplace['id'] === $id) {
                return $marketplace;
            }
        }
        return null;
    }

    /**
     * Returns the marketplace id for a given country code.
     * If no marketplace id is found, null is returned.
     * If is_sandbox is set to true, the marketplace id for the sandbox is returned.
     * If is_sandbox is set to false, the marketplace id for the production environment is returned.
     * If is_sandbox is not set, the marketplace id for the production environment is returned.
     *
     * @param bool $is_sandbox
     *
     * @return void
     */
    private static function initMarketplaces(bool $is_sandbox = false): void
    {
        if($is_sandbox){
            self::$marketplaces = [
                [
                    'id' => AmazonMarketplaceId::EUROPE_ITALY,
                    'name' => 'Italy (EU)',
                    'zone' => AmazonMarketplaceZone::EUROPE,
                    'endpoint' => AmazonSellingPartnerZoneEndpoint::EUROPE_SANDBOX,
                ],
                [
                    'id' => AmazonMarketplaceId::EUROPE_GERMANY,
                    'name' => 'Germany (EU)',
                    'zone' => AmazonMarketplaceZone::EUROPE,
                    'endpoint' => AmazonSellingPartnerZoneEndpoint::EUROPE_SANDBOX,
                ],
                [
                    'id' => AmazonMarketplaceId::EUROPE_FRANCE,
                    'name' => 'France (EU)',
                    'zone' => AmazonMarketplaceZone::EUROPE,
                    'endpoint' => AmazonSellingPartnerZoneEndpoint::EUROPE_SANDBOX,
                ],
                [
                    'id' => AmazonMarketplaceId::EUROPE_SPAIN,
                    'name' => 'Spain (EU)',
                    'zone' => AmazonMarketplaceZone::EUROPE,
                    'endpoint' => AmazonSellingPartnerZoneEndpoint::EUROPE_SANDBOX,
                ],
            ];
        }else{
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
    public static function clearMarketplaces(): void
    {
        self::$marketplaces = null;
    }
}
