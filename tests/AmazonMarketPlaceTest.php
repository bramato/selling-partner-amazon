<?php

namespace Bramatom\tests;

use Bramatom\SellingPartnerAmazon\AmazonMarketPlace;
use Bramatom\SellingPartnerAmazon\AmazonMarketplaceData;
use Bramatom\SellingPartnerAmazon\AmazonMarketplaceId;
use Bramatom\SellingPartnerAmazon\AmazonMarketplaceZone;
use Bramatom\SellingPartnerAmazon\AmazonSellingPartnerZoneEndpoint;
use PHPUnit\Framework\TestCase;

class AmazonMarketPlaceTest extends TestCase
{
    public function testValidMarketplace()
    {
        AmazonMarketPlaceData::clearMarketplaces();
        $marketplace = new AmazonMarketplace(AmazonMarketplaceId::EUROPE_ITALY, false);
        $this->assertFalse($marketplace->error);
        $this->assertEquals(AmazonMarketplaceId::EUROPE_ITALY, $marketplace->getId());
        $this->assertEquals('Italy (EU)', $marketplace->getName());
        $this->assertEquals(AmazonMarketplaceZone::EUROPE, $marketplace->getZone());
        $this->assertEquals(AmazonSellingPartnerZoneEndpoint::EUROPE, $marketplace->getEndpoint());
    }

    public function testInvalidMarketplace()
    {
        AmazonMarketPlaceData::clearMarketplaces();
        $marketplace = new AmazonMarketplace('INVALID_ID',false);
        $this->assertTrue($marketplace->error);
        $this->assertNull($marketplace->getId());
        $this->assertNull($marketplace->getName());
        $this->assertNull($marketplace->getEndpoint());
    }
}
