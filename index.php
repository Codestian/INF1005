<?php
require __DIR__ . "/vendor/autoload.php";

use App\Controller\About;
use App\Controller\api\ItemController;
use App\Controller\Api\UserController;
use App\Controller\Booking;
use App\Controller\Home;
use App\Controller\Api\RestaurantController;
use App\Lib\App;
use App\Lib\Config;
use App\Lib\Database;
use App\Lib\Router;

Router::get("/", function () {
    (new Home())->indexAction();
});

Router::get("/about/?", function () {
    (new About())->indexAction();
});

Router::get("/booking", function () {
    (new Booking())->indexAction();
});

// The below code is for backend API, frontend is above.
$mysqli = (new Database())->getConnection();

$api_suffix = Config::get("API_SUFFIX");

$restaurant_controller = new RestaurantController($mysqli);
$item_controller = new ItemController($mysqli);
$user_controller = new UserController($mysqli);

//  Retrieves all restaurants
Router::get("/{$api_suffix}/restaurants/?", [$restaurant_controller, "getAllRestaurants"]);
//  Retrieves one restaurant by its id
Router::get("/{$api_suffix}/restaurants/(\d+)/?", [$restaurant_controller, "getOneRestaurantById"]);
//  Creates a new restaurant
Router::post("/{$api_suffix}/restaurants/?", [$restaurant_controller, "createRestaurant"]);
//  Updates one restaurant by its id
Router::put("/{$api_suffix}/restaurants/(\d+)/?", [$restaurant_controller, "updateRestaurant"]);
//  Deletes one restaurant by its id
Router::delete("/{$api_suffix}/restaurants/(\d+)/?", [$restaurant_controller, "deleteRestaurant"]);

// Retrieves all restaurant items
Router::get("/{$api_suffix}/items/?", [$item_controller, "getAllItems"]);
// Retrieves all restaurant items
Router::get("/{$api_suffix}/items/(\d+)/?", [$item_controller, "getOneItemById"]);
//  Creates a new restaurant item
Router::post("/{$api_suffix}/items/?", [$item_controller, "createItem"]);
//  Updates one restaurant item by its id
Router::put("/{$api_suffix}/items/(\d+)/?", [$item_controller, "updateItem"]);
//  Deletes one restaurant item by its id
Router::delete("/{$api_suffix}/items/(\d+)/?", [$item_controller, "deleteItem"]);

//  Retrieves all users
Router::get("/{$api_suffix}/users/?", [$user_controller, "getAllUsers"]);
//  Retrieves one user by its id
Router::get("/{$api_suffix}/users/(\d+)/?", [$user_controller, "getOneUserById"]);
//  Creates a new user
Router::post("/{$api_suffix}/users/?", [$user_controller, "createUser"]);
//  Updates one user by its id
Router::put("/{$api_suffix}/users/(\d+)/?", [$user_controller, "updateUser"]);
//  Deletes one user by its id
Router::delete("/u{$api_suffix}/sers/(\d+)/?", [$user_controller, "deleteUser"]);

// Retrieves all restaurant items by restaurant id
Router::get("/{$api_suffix}/restaurants/(\d+)/items/?", [$item_controller, "getAllItemsByRestaurantId"]);

App::run();
