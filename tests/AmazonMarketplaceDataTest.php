<?php

namespace Bramatom\tests;

use Bramatom\SellingPartnerAmazon\AmazonMarketplaceData;
use Bramatom\SellingPartnerAmazon\AmazonMarketplaceId;
use Bramatom\SellingPartnerAmazon\AmazonSellingPartnerZoneEndpoint;
use PHPUnit\Framework\TestCase;

class AmazonMarketplaceDataTest extends TestCase
{
    /**
     * @return void
     */
    public function testGetAll()
    {
        $marketplaces = AmazonMarketplaceData::getAll();
        $this->assertNotEmpty($marketplaces);
        $this->assertIsArray($marketplaces);
        // CHeck if in all elements has a value from SANDBOX
        $this->assertContains(AmazonSellingPartnerZoneEndpoint::EUROPE, array_column($marketplaces, 'endpoint'));

    }
    public function testGetAllSandBox(){
        AmazonMarketPlaceData::clearMarketplaces();
        $marketplaces = AmazonMarketplaceData::getAll(true);
        $this->assertNotEmpty($marketplaces);
        $this->assertIsArray($marketplaces);
        // CHeck if in all elements has a value from SANDBOX
        $this->assertContains(AmazonSellingPartnerZoneEndpoint::EUROPE_SANDBOX, array_column($marketplaces, 'endpoint'));

    }
    /**
     * @return void
     */
    public function testGetById()
    {
        $marketplace = AmazonMarketplaceData::getById(AmazonMarketplaceId::EUROPE_ITALY);
        $this->assertNotEmpty($marketplace);
        $this->assertEquals(AmazonMarketplaceId::EUROPE_ITALY, $marketplace['id']);

        $marketplace = AmazonMarketplaceData::getById('invalid-id');
        $this->assertNull($marketplace);
    }

}
