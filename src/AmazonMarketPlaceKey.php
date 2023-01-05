<?php

namespace Bramatom\SellingPartnerAmazon;

class AmazonMarketPlaceKey
{
    public AmazonMarketPlace $marketplace;
    public string $secretKey;
    public string $accessKey;
    public string $sellerId;
 public function __construct(AmazonMarketPlace $marketplace,string $secretKey, string $accessKey, string $sellerId)
    {
        $this->marketplace = $marketplace;
        if($this->marketplace->error){
            throw new \Exception('Invalid marketplace');
        }
        $this->secretKey = $secretKey;
        $this->accessKey = $accessKey;
        $this->sellerId = $sellerId;
    }

    /**
     * @throws \Exception
     */
    public static function create(string $marketPlaceId, string $secretKey, string $accessKey, string $sellerId, bool $isSandbox = true)
    {
        try {
            $marketplace = new AmazonMarketPlace($marketPlaceId,$isSandbox);
            return new AmazonMarketPlaceKey($marketplace, $secretKey, $accessKey, $sellerId);
        }catch(\Throwable $e){
            throw new \Exception($e->getMessage());
        }
    }


}