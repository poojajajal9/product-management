<?php

namespace Tests\Unit;

use App\Models\Product;
use App\Repositories\ProductsRepository;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use WithFaker, DatabaseTransactions, DatabaseMigrations;

    protected $product;

    public function setUp(): void
    {
        parent::setUp();
        $this->product = new Product();
    }

    /** @test */
    public function basic_test()
    {
        $this->assertTrue(true);
    }

    /** @test */
    public function it_can_create_a_product()
    {
        $data = [
            'name'        => $this->faker->word,
            'description' => $this->faker->paragraph,
            'picture'     => $this->faker->url,
            'is_active'   => $this->faker->boolean,
        ];

        $product_repository = new ProductsRepository(new Product());

        $product = $product_repository->store($data);
        $this->assertInstanceOf(Product::class, $product);

        $this->assertEquals($data['name'], $product->name);
        $this->assertEquals($data['description'], $product->description);
        $this->assertEquals($data['picture'], $product->picture);
        $this->assertEquals($data['is_active'], $product->is_active);
    }

    /** @test */
    public function it_can_show_the_product()
    {
        // todo: we can use factory here

        $data = [
            'name'        => $this->faker->word,
            'description' => $this->faker->paragraph,
            'picture'     => $this->faker->url,
            'is_active'   => $this->faker->boolean,
        ];

        $product_repository = new ProductsRepository(new Product());
        $product = $product_repository->store($data);

        $found = $product_repository->getProductById($product->id);
        $this->assertInstanceOf(Product::class, $found);

        $this->assertEquals($found->name, $product->name);
        $this->assertEquals($found->description, $product->description);
        $this->assertEquals($found->src, $product->src);
    }

    /** @test */
    public function it_can_update_the_product()
    {
        // todo: we can use factory here

        $data = [
            'name'        => $this->faker->word,
            'description' => $this->faker->paragraph,
            'picture'     => $this->faker->url,
            'is_active'   => $this->faker->boolean,
        ];

        $product_repository = new ProductsRepository(new Product());
        $product = $product_repository->store($data);

        $update = $product_repository->update($data, $product->id);

        $this->assertTrue($update);

        $this->assertEquals($data['name'], $product->name);
        $this->assertEquals($data['description'], $product->description);
        $this->assertEquals($data['picture'], $product->picture);
        $this->assertEquals($data['is_active'], $product->is_active);
    }
}
