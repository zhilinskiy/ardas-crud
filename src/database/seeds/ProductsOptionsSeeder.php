<?php

use App\Option;
use App\Product;
use Illuminate\Database\Seeder;

class ProductsOptionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $option1 = factory(Option::class)->create(['name' => 'recommended floor space']);
        $option2 = factory(Option::class)->create(['name' => 'color']);
        factory(Product::class, 25)
            ->create()
            ->each(function ($product) use ($option1, $option2) {
                $product->options()->attach($option1->id, ['value' => '16']);
                $product->options()->attach($option2->id, ['value' => 'white']);
            });
    }
}
