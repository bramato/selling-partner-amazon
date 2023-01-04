<?php
namespace Bramatom\SellingPartnerAmazon\classes;

use GuzzleHttp\Client;

class AmazonSellingPartnerClient
{
    protected Client $client;
    protected string $accessKey;
    protected string $secretKey;
    protected string $sellerId;
    protected AmazonMarketPlace $marketplace;

    public function __construct(AmazonMarketPlaceKey $key)
    {
        $this->accessKey = $key->accessKey;
        $this->secretKey = $key->secretKey;
        $this->sellerId = $key->sellerId;
        $this->marketplace = $key->marketplace;

        $this->client = new Client([
            'base_uri' => $this->marketplace->getEndpoint(),
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'AWS4-HMAC-SHA256'
            ]
        ]);
    }

    public function makeRequest($method, $path, array $options = [])
    {
        $options['headers']['X-Amz-Target'] = "com.amazon.paapi5.v1.ProductAdvertisingAPIv1.$path";
        $options['headers']['X-Amz-Date'] = gmdate('Ymd\THis\Z');
        $options['headers']['X-Amz-Seller-Id'] = $this->sellerId;

        // Calcola l'intestazione di autorizzazione utilizzando i dettagli di accesso della chiave segreta
        // Consulta la documentazione di Amazon per maggiori dettagli su come calcolare l'intestazione di autorizzazione
        $options['headers']['Authorization'] = $this->calculateAuthorizationHeader($method, $path, $options);

        $response = $this->client->request($method, $path, $options);

        return json_decode($response->getBody()->getContents(), true);
    }

    protected function calculateAuthorizationHeader($method, $path, $options)
    {
        $query = $options['query'] ?? [];
        $body = $options['body'] ?? '';
        $headers = $options['headers'] ?? [];

        // Crea la stringa di richiesta
        $stringToSign = strtoupper($method) . "\n" . $path . "\n" . http_build_query($query) . "\n";
        foreach ($headers as $key => $value) {
            $stringToSign .= "$key:$value\n";
        }
        $stringToSign .= "\n" . $body;

        // Crea la stringa di creazione
        $creationString = $headers['X-Amz-Date'] . "\n";

        // Crea la stringa di firma
        $signatureString = "AWS4-HMAC-SHA256\n" . $creationString . $this->sellerId . "\n";

        // Crea la stringa di firma della chiave
        $signatureKeyString = "AWS4-HMAC-SHA256\n" . $this->marketplace->getId() . "\n" . $this->marketplace->getZone() . "\n";

        // Calcola la firma della chiave
        $signatureKey = hash_hmac('sha256', $signatureKeyString, $this->secretKey, true);

        // Calcola la firma
        $signature = hash_hmac('sha256', $signatureString, $signatureKey, true);

        // Codifica la firma in base64
        $signature = base64_encode($signature);

        // Crea l'intestazione di autorizzazione
        return "AWS4-HMAC-SHA256 Credential={$this->sellerId}/{$creationString}{$this->marketplace}/aws4_request, SignedHeaders=content-type;x-amz-date;x-amz-seller-id;x-amz-target, Signature=$signature";
    }

}
