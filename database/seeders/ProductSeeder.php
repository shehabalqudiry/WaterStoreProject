<?php

namespace Database\Seeders;

use App\Models\Offer;
use App\Models\Slider;
use App\Models\Company;
use App\Models\Product;
use Illuminate\Support\Str;
use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{

    public function run()
    {
        PaymentMethod::create([
            'name' => "الدفع عند الاستلام",
            'details' => "يمكنك الدفع عند استلام طلبك",
        ]);

        Slider::create([
            "title" => "Slider 1",
            "description" => "Slider 1",
            "url" => 'http://lorempixel.com/640/480/',
            "image" => 'http://lorempixel.com/640/480/',
        ]);

        Slider::create([
            "title" => "Slider 2",
            "description" => "Slider 2",
            "url" => 'http://lorempixel.com/640/480/',
            "image" => 'http://lorempixel.com/640/480/',
        ]);


        Slider::create([
            "title" => "Slider 3",
            "description" => "Slider 3",
            "url" => 'http://lorempixel.com/640/480/',
            "image" => 'http://lorempixel.com/640/480/',
        ]);

        Offer::create([
            "title" => "Offer 1",
            "description" => "Offer 1",
            "price_in_offer" => mt_rand(10, 100),
            'product_id' => mt_rand(1, 50),
            "image" => 'http://lorempixel.com/640/480/',
        ]);

        Offer::create([
            "title" => "Offer 2",
            "description" => "Offer 2",
            "price_in_offer" => mt_rand(10, 100),
            'product_id' => mt_rand(1, 50),
            "image" => 'http://lorempixel.com/640/480/',
        ]);


        Offer::create([
            "title" => "Offer 3",
            "description" => "Offer 3",
            "price_in_offer" => mt_rand(10, 100),
            'product_id' => mt_rand(1, 50),
            "image" => 'http://lorempixel.com/640/480/',
        ]);

        for ($i=0; $i < 10; $i++) {
            Company::create([
                "title" => "اسم الشركة $i",
                "description" => "شرح مختصر للشركة $i",
                "image" => 'http://lorempixel.com/640/480/',
            ]);
        }

        for ($i=0; $i < 50; $i++) {
            Product::create([
                "title" => "اسم المنتج $i",
                "company_id" => mt_rand(1, 10),
                "type" => mt_rand(0, 1),
                "description" => "شرح مختصر للمنتج $i",
                "price" => mt_rand(1.00, 1000.00),
                "main_image" => 'http://lorempixel.com/640/480/',
            ]);
        }
    }
}
