<?php

namespace Bramatom\tests;

use Bramatom\SellingPartnerAmazon\AmazonMarketPlace;
use Bramatom\SellingPartnerAmazon\AmazonMarketplaceId;
use Bramatom\SellingPartnerAmazon\AmazonMarketplaceZone;
use Bramatom\SellingPartnerAmazon\AmazonSellingPartnerZoneEndpoint;
use PHPUnit\Framework\TestCase;

class AmazonMarketPlaceTest extends TestCase
{
    public function testValidMarketplace()
    {
        $marketplace = new AmazonMarketplace(AmazonMarketplaceId::EUROPE_ITALY);

        $this->assertFalse($marketplace->error);
        $this->assertEquals(AmazonMarketplaceId::EUROPE_ITALY, $marketplace->getId());
        $this->assertEquals('Italy (EU)', $marketplace->getName());
        $this->assertEquals(AmazonMarketplaceZone::EUROPE, $marketplace->getZone());
        $this->assertEquals(AmazonSellingPartnerZoneEndpoint::EUROPE, $marketplace->getEndpoint());
    }

    public function testInvalidMarketplace()
    {
        $marketplace = new AmazonMarketplace('INVALID_ID');

        $this->assertTrue($marketplace->error);
        $this->assertNull($marketplace->getId());
        $this->assertNull($marketplace->getName());
        $this->assertNull($marketplace->getEndpoint());
    }
}
