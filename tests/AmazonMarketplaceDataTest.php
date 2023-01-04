<?php

namespace Bramatom\tests;

use Bramatom\SellingPartnerAmazon\AmazonMarketplaceData;
use Bramatom\SellingPartnerAmazon\AmazonMarketplaceId;
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
