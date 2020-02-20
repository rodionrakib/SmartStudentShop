<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use App\Repositories\ProductRepository;
use App\Shop\Products\Product;
use App\Shop\Products\ProductImage;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProductTest extends TestCase
{

    use RefreshDatabase;
   

    /** @test */
    public function it_can_have_many_image()
    {
        $product = factory(Product::class)->create();
        $image1 = factory(ProductImage::class)->create();
        $product->images()->save($image1);

        $this->assertCount(1,$product->images());

    }
     /** @test */
     public function it_can_show_all_the_product_images()
     {
         $product = 'apple';
         $cover = UploadedFile::fake()->image('file.png', 600, 600);
 
         $params = [
             'sku' => $this->faker->numberBetween(1111111, 999999),
             'name' => $product,
             'slug' => Str::slug($product),
             'description' => $this->faker->paragraph,
             'cover' => $cover,
             'quantity' => 10,
             'price' => 9.95,
             'status' => 1,
             'image' => [
                 UploadedFile::fake()->image('file.png', 200, 200),
                 UploadedFile::fake()->image('file1.png', 200, 200),
                 UploadedFile::fake()->image('file2.png', 200, 200)
             ]
         ];
 
         $productRepo = new ProductRepository(new Product);
         $created = $productRepo->createProduct($params);
 
         $repo = new ProductRepository($created);
         $repo->saveProductImages(collect($params['image']), $created);
         $this->assertCount(3, $repo->findProductImages());
     }
    /** @test */
    public function it_can_save_the_cover_image_properly_in_file_storage()
    {
        $cover = UploadedFile::fake()->image('cover.jpg', 600, 600);

        $product = factory(Product::class)->create();
        $productRepo = new ProductRepository($product);
        $filename = $productRepo->saveCoverImage($cover);

        $exists = Storage::disk('public')->exists($filename);

        $this->assertTrue($exists);
    }

    /** @test */
    public function it_can_update_a_product()
    {
        $product = factory(Product::class)->create();
        $productName = 'apple';
        $cover = UploadedFile::fake()->image('file.png', 600, 600);

        $data = [
            'sku' => '11111',
            'name' => $productName,
            'slug' => str_slug($productName),
            'description' => $this->faker->paragraph,
            'cover' => $cover,
            'quantity' => 11,
            'price' => 9.95,
            'status' => 1
        ];

        $productRepo = new ProductRepository($product);
        $updated = $productRepo->updateProduct($data);

        $this->assertTrue($updated);
    }

    /** @test */
    public function it_can_create_a_product()
    {
        $product = 'apple';
        $cover = UploadedFile::fake()->image('file.png', 600, 600);

        $params = [
            'sku' => $this->faker->numberBetween(1111111, 999999),
            'name' => $product,
            'slug' => Str::slug($product),
            'description' => $this->faker->paragraph,
            'cover' => $cover,
            'quantity' => 10,
            'price' => 9.95,
            'status' => 1,
        ];

        $product = new ProductRepository(new Product);
        $created = $product->createProduct($params);

        $this->assertInstanceOf(Product::class, $created);
        $this->assertEquals($params['sku'], $created->sku);
        $this->assertEquals($params['name'], $created->name);
        $this->assertEquals($params['slug'], $created->slug);
        $this->assertEquals($params['description'], $created->description);
        $this->assertEquals($params['cover'], $created->cover);
        $this->assertEquals($params['quantity'], $created->quantity);
        $this->assertEquals($params['price'], $created->price);
        $this->assertEquals($params['status'], $created->status);
    }
}
