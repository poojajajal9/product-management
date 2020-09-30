<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = new \App\Models\Product();
        for ($i = 1; $i <= 20; $i++) {
            $product->create([
                'name' => 'Product ' . $i,
                'description' => 'Product ' . $i . ' <br> Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                'picture' => '1.png',
                'is_active' => 1
            ]);
        }
    }
}
