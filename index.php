<?php
require __DIR__ . '/vendor/autoload.php';

use App\Controller\About;
use App\Controller\Booking;
use App\Controller\Home;
use App\Controller\Api\RestaurantController;
use App\Lib\App;
use App\Lib\Database;
use App\Lib\Router;

Router::get('/', function () {
    (new Home())->indexAction();
});

Router::get('/about/?', function () {
    (new About())->indexAction();
});

Router::get('/booking', function () {
    (new Booking())->indexAction();
});

// The below code is for backend API, frontend is above.
$mysqli = (new Database())->getConnection();

$restaurant_controller = new RestaurantController($mysqli);

//  Retrieves all restaurants
Router::get('/restaurants/?', [$restaurant_controller, 'getAllRestaurants']);
//  Retrieves one restaurant by its id
Router::get('/restaurants/(\d+)/?', [$restaurant_controller, 'getOneRestaurantById']);
//  Creates a new restaurant
Router::post('/restaurants/?', [$restaurant_controller, 'createRestaurant']);
//  Updates one restaurant by its id
Router::put('/restaurants/(\d+)/?', [$restaurant_controller, 'updateRestaurant']);
//  Deletes one restaurant by its id
Router::delete('/restaurants/(\d+)/?', [$restaurant_controller, 'deleteRestaurant']);

App::run();
