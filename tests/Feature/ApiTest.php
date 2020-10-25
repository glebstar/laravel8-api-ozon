<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Services\ApiOzon;

class ApiTest extends TestCase
{
    private $items = [
        'items' => [
            [
                'attributes' => [
                    [
                        'id' => 0,
                    ]
                ],
                'category_id' => 0,
                'depth' => 200,
                'dimension_unit' => 'mm',
                'height' => 200,
                'images' => ['string'],
                'offer_id' => 'item_001',
                'price' => 'string',
                'vat' => '0',
                'weight' => 1,
                'weight_unit' => 'kg',
                'width' => 200,
            ],
        ],
    ];

    /**
     * Test Add Products
     *
     * @return void
     */
    public function testAddProducts()
    {
        $client = new ApiOzon();
        $response = $client->addProducts($this->items);

        $this->assertTrue(isset($response['result']['task_id']));
    }

    /**
     * Test Product info
     *
     * @return void
     */
    public function testGetProductInfo()
    {
        $client = new ApiOzon();
        $response = $client->getProductInfo(['offer_id' => 'item_001']);

        $this->assertTrue(1 == preg_match('/^.+Product not found/ms', $response['error']));
    }

    public function testAddProductsApi()
    {
        $response = $this->postJson('/api/add-products', $this->items);
        $response->assertStatus(200);
    }

    public function testGetProductInfoApi()
    {
        $response = $this->postJson('/api/product-info', ['offer_id' => 'item_001']);
        $response->assertStatus(401);
    }
}
