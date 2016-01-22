<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Packing::class, function (Faker\Generator $faker) {
 
    return [
        'packing_type' =>App\Http\Utilities\DbDataProvider::getPacking(),
    ];
});

$factory->define(App\Unit::class, function (Faker\Generator $faker) {
    return [
        'unit_type' => App\Http\Utilities\DbDataProvider::getUnit(),
    ];
});

$factory->define(App\Company::class, function (Faker\Generator $faker) {
    return [
        'company_name' => App\Http\Utilities\DbDataProvider::getCompany(),
    ];
});

$factory->define(App\Category::class, function (Faker\Generator $faker) {
    return [
        'category_name' =>App\Http\Utilities\DbDataProvider::getCategory(),
    ];
});

$factory->define(App\Manufacturer::class, function (Faker\Generator $faker) {
    return [
        'manufacturer_name' => App\Http\Utilities\DbDataProvider::getManufacturer(),
    ];
});

$factory->define(App\Salt::class, function (Faker\Generator $faker) {
    return [
        'salt_name' => App\Http\Utilities\DbDataProvider::getSalt(),
    ];
});

$factory->define(App\Ailment::class, function (Faker\Generator $faker) {
    return [
        'ailment_name' => App\Http\Utilities\DbDataProvider::getAilment(),
    ];
});


$factory->define(App\Classes::class, function (Faker\Generator $faker) {
    return [
        'class_name' => App\Http\Utilities\DbDataProvider::getClasses(),
    ];
});

$factory->define(App\Product::class, function (Faker\Generator $faker) {
    return [
        'product_code' => uniqid(),
        'product_name' => App\Http\Utilities\DbDataProvider::getProductName(),
        'product_mrp'  => $faker->randomFloat(NULL,1,1000),
        'product_rate_a' => $faker->randomFloat(NULL,1,1000),
        'product_rate_b' => $faker->randomFloat(NULL,1,1000),
        'product_tax'	=> $faker->randomDigitNotNull
     ];
});
