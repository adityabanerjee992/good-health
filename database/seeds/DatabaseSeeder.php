<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call(GoodHealthDBSeeder::class);

        $this->call(AdminSeeder::class);
        $this->command->info('Admin User created with username admin@admin.com and password admin');


        Model::reguard();
    }
}

class GoodHealthDBSeeder extends Seeder {

    public function run()
    {
        $faker = Faker\Factory::create();

        factory('App\Category', 6)->create();
        factory('App\Company', 1)->create();
        factory('App\Manufacturer', 10)->create();
        factory('App\Packing', 26)->create();
        factory('App\Salt', 24)->create();
        factory('App\Unit', 15)->create();
        

       $type = App\Type::create([
            'type_name' => 'OTC'
        ]);

       $type = App\Type::create([
            'type_name' => 'SCHEDULED'
        ]);

       $type = App\Type::create([
            'type_name' => 'REGULAR'
        ]);       

       $payment_type = App\PaymentType::create([
            'name' => 'Cash On Delivery',
            'fee'  => 50,
            'description' => 'With COD you can pay in cash 
                              at the time of actual delivery 
                              of the product at your doorstep,
                              without requiring you to make any 
                              advance payment online.'
        ]);

       $payment_type = App\PaymentType::create([
            'name' => 'Online Payment',
            'fee'  => 0,
            'description' => 'We Accept Visa, Master Card, 
                              Mastro and Credit Card of all 
                              major banks. All transaction 
                              are secured using SSL encryption.'

        ]);


        $categories = App\Category::lists('id');
        $last2 = count($categories) - 1;

        $companies = App\Company::lists('id');
        $last3 = count($companies) - 1;
    
        $manufacturers = App\Manufacturer::lists('id');
        $last4 = count($manufacturers) - 1;

        $packings = App\Packing::lists('id');
        $last5 = count($packings) - 1;
    
        $salts = App\Salt::lists('id');
        $last6 = count($salts) - 1;
    
        $units = App\Unit::lists('id');
        $last7 = count($units) - 1;

        $types = App\Type::lists('id');
        $last8 = count($types) - 1;


        for ($i = 1; $i <= 24; $i++) {

            $ailment =   factory('App\Ailment')->create();

            if (count($salts))
            {
               $ailment->salts()->attach( $salts[ rand(0, $last6 ) ] );
            }
         }


        $salts = App\Salt::lists('id');
        $last6 = count($salts) - 1;


        for ($i = 1; $i <= 20; $i++) {

            $class =  factory('App\Classes')->create();

            if (count($salts))
            {
               $class->salts()->attach( $salts[ rand(0, $last6 ) ] );
            }
         }


        $ailments = App\Ailment::lists('id');
        $last = count($ailments) - 1;

        $classes = App\Classes::lists('id');
        $last1 = count($classes) - 1;

        $salts = App\Salt::lists('id');
        $last6 = count($salts) - 1;
    
 
        for ($i = 1; $i <= 28; $i++) {

           $product =  factory('App\Product')->create();

            if (count($ailments))
            {
               $product->ailments()->attach( $ailments[ rand(0, $last ) ] );
            } 

            if (count($classes))
            {
               $product->classes()->attach( $classes[ rand(0, $last1 ) ] );
            }  

            if (count($categories))
            {
               $product->categories()->attach( $categories[ rand(0, $last2 ) ] );
            }

            if (count($companies))
            {
               $product->companies()->attach( $companies[ rand(0, $last3 ) ] );
            }  

            if (count($manufacturers))
            {
               $product->manufacturers()->attach( $manufacturers[ rand(0, $last4 ) ] );
            }

            if (count($packings))
            {
               $product->packings()->attach( $packings[ rand(0, $last5 ) ] );
            }

            if (count($salts))
            {
               $product->salts()->attach( $salts[ rand(0, $last6 ) ] );
            }

            if (count($units))
            {
               $product->units()->attach( $units[ rand(0, $last7 ) ] );
            } 

            if (count($types))
            {
               $product->types()->attach( $types[ rand(0, $last8 ) ] );
            }
         }
    }

}

