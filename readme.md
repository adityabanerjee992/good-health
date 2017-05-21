# Good Health Is An E Commerce Website Build On Laravel 5.1. 

This is a custom developed website named good health build on Laravel 5.1 to sell prescription drugs and medicines online. 

### Installation ###

* `https://github.com/adityabanerjee992/good-health.git projectname`
* `cd projectname`
* `composer install`
* `php artisan key:generate`
* Create a database and inform *.env*
* `php artisan migrate --seed` to create and populate tables
* `php artisan serve` to start the app on http://localhost:8000/


### Session ###

* Go to your .env file and change SESSION_DRIVER=file to SESSION_DRIVER=database.
* Next you will need to create a session migration: php artisan session:table.
* Now composer dump-autoload for good practice.
* Finally migrate (php artisan migrate).


### Features ###

* Admin Panel is included.
* Through admin panel you could assign roles and permission to users i.e role based access.
* Authentication (Register, Login, Logout).
* Managing Orders from admin panel. 
* Invoice printing for operations. 
* Logs are generated on every event to track everything from admin panel.
* Managing products from admin panel. 
* Bulk product upload from admin using csv.
* Managing stores from admin panel.
* Search functionality to find products. 
* Different categories for products.
* End to end cart functionality.
* Email and sms on differnet events.
* Customer dashboard to view or edit his orders, address etc. 

### Admin Panel ###

* To access the admin panel go to http://localhost:8000/admin.
* Enter username -: admin@admin.com
* Enter password -: admin 


### Help ###

For any support or questions please email me at adityabanerjee992@gmail.com.

