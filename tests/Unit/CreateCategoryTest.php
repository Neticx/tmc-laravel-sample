<?php

namespace Tests\Unit;



use App\Entities\GenericResponseEntity;
use App\Models\Category;
use App\Repositories\CategoryRepository;
use App\UseCases\CreateCategoryUseCase;
use Tests\TestCase;

class CreateCategoryTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_insert_category_failed_auth()
    {
        $response = $this->postJson('/api/category');
        $response->assertStatus(401);
    }

    public function test_insert_category_failed_validation()
    {
        $this->withoutMiddleware();

        $response = $this->postJson('/api/category');
        $response->assertStatus(422);
        $response->assertInvalid(['name' => 'The name field is required.']);
    }

    public function test_insert_category_usecase_success()
    {
        $payload = [
            'name'=> 'test'
        ];

        $response = new GenericResponseEntity();
        $response->success = true;
        $response->data = [
            'id' => null,
            'name'=> 'test',
            'createdAt' => 0
        ];

        $mock = mock(CategoryRepository::class)->expect(create: fn ($name) => new Category($payload) );

        $service = app(CreateCategoryUseCase::class)->exec((object)$payload,$mock);

        $this->assertEquals($service, $response);
    }
}
