<?php

namespace Bramatom\tests;

use Bramatom\SellingPartnerAmazon\AmazonMarketPlace;
use Bramatom\SellingPartnerAmazon\AmazonMarketplaceId;
use Bramatom\SellingPartnerAmazon\AmazonMarketPlaceKey;
use PHPUnit\Framework\TestCase;

class AmazonMarketPlaceKeyTest extends TestCase
{
    public function testValidMarketplace()
    {
        $key = AmazonMarketPlaceKey::create(
            AmazonMarketplaceId::EUROPE_ITALY,
            'SECRET_KEY',
            'ACCESS_KEY',
            'SELLER_ID'
        );

        $this->assertInstanceOf(AmazonMarketPlace::class, $key->marketplace);
        $this->assertFalse($key->marketplace->error);
        $this->assertEquals(AmazonMarketplaceId::EUROPE_ITALY, $key->marketplace->getId());
        $this->assertEquals('SECRET_KEY', $key->secretKey);
        $this->assertEquals('ACCESS_KEY', $key->accessKey);
        $this->assertEquals('SELLER_ID', $key->sellerId);
    }

    public function testInvalidMarketplace()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Invalid marketplace');

        AmazonMarketPlaceKey::create(
            'INVALID_MARKETPLACE_ID',
            'SECRET_KEY',
            'ACCESS_KEY',
            'SELLER_ID'
        );
    }
}
