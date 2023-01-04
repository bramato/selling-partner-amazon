<?php

namespace Bramatom\SellingPartnerAmazon\classes;

class AmazonMarketPlace
{
    private array $data;
    public ?string $id = null;
    public ?string $name = null;
    public ?string $zone = null;
    public ?string $endpoint = null;
    public bool $error = false;

    public function __construct(string $marketPlaceId)
    {
        $data = AmazonMarketplaceData::getById($marketPlaceId);
        if (is_array($data)){
            $this->data = $data;
            $this->id = $data['id'];
            $this->name = $data['name'];
            $this->zone = $data['zone'];
            $this->endpoint = $data['endpoint'];
        } else {
            $this->error = true;
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getZone()
    {
        return $this->zone;
    }

    public function getEndpoint()
    {
        return $this->endpoint;
    }

}