# Vessel tracking using lumen microframework

[![Build Status](https://travis-ci.org/joemccann/dillinger.svg?branch=master)](https://travis-ci.org/joemccann/dillinger)

# instructions!

  - Make sure that you have the followings (Ideally I would use docker)
   MongoDB
   Composer
   PHP updated
  - Clone the repository to your environment
  - Composer install
  - .env example rename it to .env
  - From the command line navigate to you project and enter :
   php artisan import:ships-positions.That command will import the positions of vessels to your mongodb
  - After that enter:
```sh
   php -S localhost:8000 -t public
```
   To start the server
 - The routes are (Ideally I would use swagger):
   http://localhost:8000/vessels => fetch the document raw
   http://localhost:8000/vessels?mmsi=247039300 => fetch data with specific mmsi
   http://localhost:8000/vessels?mmsi=247039300,311486000 => fetch data with various mmsi
   http://localhost:8000/vessels?timestamp=1372700100 => fetch data with specific timestamp
 - I have written tests that covers some cases for all the routes. To run the asssertions enter:
 ```sh
   ./vendor/bin/phpunit Tests/TestQueries
```
My Work exists in:

 -  Console/Commands/ShipsPositionsImport.php
 - Console/Kernel.php
 - Http/Controllers/ShipsController.php
 -  Http/Middleware/LimiterPerIp.php
 -  Http/Models/ShipPosition.php
 -  Http/Models/UserIp.php
 - bootsrap/app.php
 - data-imports
 - database/migrations
 - routes
 - tests/TestQueries



