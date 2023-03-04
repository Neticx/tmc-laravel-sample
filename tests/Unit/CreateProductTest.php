<?php

namespace Tests\Unit;



use App\Entities\GenericResponseEntity;
use App\Models\Product;
use App\Repositories\ProductRepository;
use App\UseCases\CreateProductUseCase;
use Tests\TestCase;

class CreateProductTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_insert_product_failed_auth()
    {
        $response = $this->postJson('/api/products');
        $response->assertStatus(401);
    }

    public function test_insert_product_failed_validation()
    {
        $this->withoutMiddleware();

        $response = $this->postJson('/api/products');
        $response->assertStatus(422);
        $response->assertInvalid(['name' => 'The name field is required.']);
    }

    public function test_insert_product_usecase_success()
    {
        $payload = [
            'name'=> 'test',
            'sku' => 'sku',
            'price' => 1,
            'stock' => 2,
            'categoryId' => 'id'
        ];

        $response = new GenericResponseEntity();
        $response->success = true;
        $response->data = [
            'id' => null,
            'name'=> 'test',
            'sku' => 'sku',
            'price' => 1,
            'stock' => 2,
            'createdAt' => 0
        ];

        $mock = mock(ProductRepository::class)->expect(create: fn ($name) => new Product($payload) );

        $service = app(CreateProductUseCase::class)->exec((object)$payload,$mock);

        $this->assertEquals($service, $response);
    }
}
