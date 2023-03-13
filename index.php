<?php
require __DIR__ . '/vendor/autoload.php';

use App\Controller\About;
use App\Controller\api\ItemController;
use App\Controller\Api\UserController;
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
$item_controller = new ItemController($mysqli);
$user_controller = new UserController($mysqli);

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

// Retrieves all restaurant items
Router::get('/items/?', [$item_controller, 'getAllItems']);
// Retrieves all restaurant items
Router::get('/items/(\d+)/?', [$item_controller, 'getOneItemById']);
//  Creates a new restaurant item
Router::post('/items/?', [$item_controller, 'createItem']);
//  Updates one restaurant item by its id
Router::put('/items/(\d+)/?', [$item_controller, 'updateItem']);
//  Deletes one restaurant item by its id
Router::delete('/items/(\d+)/?', [$item_controller, 'deleteItem']);


//  Retrieves all users
Router::get('/users/?', [$user_controller, 'getAllUsers']);
//  Retrieves one user by its id
Router::get('/users/(\d+)/?', [$user_controller, 'getOneUserById']);
//  Creates a new user
Router::post('/users/?', [$user_controller, 'createUser']);
//  Updates one user by its id
Router::put('/users/(\d+)/?', [$user_controller, 'updateUser']);
//  Deletes one user by its id
Router::delete('/users/(\d+)/?', [$user_controller, 'deleteUser']);

// Retrieves all restaurant items by restaurant id
Router::get('/restaurants/(\d+)/items/?', [$item_controller, 'getAllItemsByRestaurantId']);

App::run();
