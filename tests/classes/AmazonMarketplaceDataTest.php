<?php

namespace classes;

use Bramatom\SellingPartnerAmazon\classes\AmazonMarketplaceData;
use Bramatom\SellingPartnerAmazon\classes\AmazonMarketplaceId;
use PHPUnit\Framework\TestCase;
use stdClass;

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
