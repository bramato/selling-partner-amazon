<?php
use GuzzleHttp\Client;

class AmazonSellingPartner
{
    protected $client;
    protected $accessKey;
    protected $secretKey;
    protected $sellerId;
    protected $marketplace;
    protected $marketplaces = [
        'na' => 'https://sellingpartnerapi-na.amazon.com',
        'eu' => 'https://sellingpartnerapi-eu.amazon.com',
        'jp' => 'https://sellingpartnerapi-jp.amazon.com',
    ];

    public function __construct($accessKey, $secretKey, $sellerId, $marketplace)
    {
        $this->accessKey = $accessKey;
        $this->secretKey = $secretKey;
        $this->sellerId = $sellerId;
        $this->marketplace = $marketplace;

        $this->client = new Client([
            'base_uri' => $this->marketplaces[$this->marketplace],
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'AWS4-HMAC-SHA256'
            ]
        ]);
    }

    public function makeRequest($method, $path, $options = [])
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
        $query = isset($options['query']) ? $options['query'] : [];
        $body = isset($options['body']) ? $options['body'] : '';
        $headers = isset($options['headers']) ? $options['headers'] : [];

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
        $signatureKeyString = "AWS4-HMAC-SHA256\n" . $this->marketplace . "\n" . $this->region . "\n";

        // Calcola la firma della chiave
        $signatureKey = hash_hmac('sha256', $signatureKeyString, $this->secretKey, true);

        // Calcola la firma
        $signature = hash_hmac('sha256', $signatureString, $signatureKey, true);

        // Codifica la firma in base64
        $signature = base64_encode($signature);

        // Crea l'intestazione di autorizzazione
        $authorizationHeader = "AWS4-HMAC-SHA256 Credential={$this->sellerId}/{$creationString}{$this->marketplace}/aws4_request, SignedHeaders=content-type;x-amz-date;x-amz-seller-id;x-amz-target, Signature=$signature";

        return $authorizationHeader;
    }

}
