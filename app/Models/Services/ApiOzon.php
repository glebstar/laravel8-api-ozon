<?php

namespace App\Models\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\UriInterface;

class ApiOzon
{
    protected $client;

    /**
     * ApiOzon constructor.
     */
    public function __construct()
    {
        $this->client = new Client([
            'headers' => [
                'Client-Id' => config('app.ozon.client-id'),
                'Api-Key' => config('app.ozon.api-key'),
                'Content-Type' => 'application/json'
            ],
            'base_uri' => config('app.ozon.base_uri')
        ]);
    }

    /**
     * Add products
     *
     * @param array $items
     * @return array|mixed
     */
    public function addProducts(array $items)
    {
        return $this->send('/v2/product/import', $items);
    }

    /**
     * Get product info
     *
     * @param array $params
     * @return array|mixed
     */
    public function getProductInfo(array $params)
    {
        return $this->send('/v2/product/info', $params);
    }

    /**
     * Send to API
     *
     * @param string|UriInterface $method
     * @param array $params
     * @return array|mixed
     */
    public function send($method, $params)
    {
        try {
            $response = $this->client
                ->post($method, ['json' => $params])->getBody()->getContents();
        } catch (GuzzleException $e) {
            return ['error' => $e->getMessage()];
        }

        return json_decode($response, true);
    }
}
