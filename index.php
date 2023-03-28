<?php
require __DIR__ . "/vendor/autoload.php";

use App\Controller\Api\UserController;
use App\Controller\Api\Providers\GoogleAuthController;

use App\Controller\RestaurantController;
use App\Controller\ItemController;
use App\Controller\ReviewController;
use App\Controller\RoleController;

use App\Lib\App;
use App\Lib\Config;
use App\Lib\Database;
use App\Lib\Request;
use App\Lib\Response;
use App\Lib\Router;
use App\Model\Users;

Router::get("/", fn() => include("routes/Home.php"));

Router::get("/restaurants/?", fn() => include("routes/Restaurants.php"));
Router::get("/restaurants/(\d+)/?", fn() => include("routes/RestaurantsOne.php"));

Router::get("/restaurants/north/?", fn() => include("routes/RestaurantsMap.php"));
Router::get("/restaurants/central/?", fn() => include("routes/RestaurantsMap.php"));
Router::get("/restaurants/east/?", fn() => include("routes/RestaurantsMap.php"));
Router::get("/restaurants/west/?", fn() => include("routes/RestaurantsMap.php"));

Router::get("/about/?", fn() => include("routes/About.php"));
Router::get("/contact/?", fn() => include("routes/Contact.php"));
Router::get("/work/?", fn() => include("routes/Work.php"));

Router::get("/profile/?", fn() => include("routes/auth/Profile.php"));

Router::get("/login", fn() => include "routes/auth/Login.php");
Router::get("/register", fn() => include "routes/auth/Register.php");
Router::get("/auth/redirect/google/?(/?\?.*)", fn() => include "routes/auth/RedirectGoogle.php");

Router::get("/admin/dashboard/([a-z]+)/?", function(Request $req, Response $res) {
    $table_name = $req->params[0];
    include("routes/admin/Dashboard.php");
});

Router::get("/admin/login/?", fn() => include("routes/admin/Login.php"));

// The below code is for backend API, frontend is above.
$mysqli = (new Database())->getConnection();

$api_suffix = Config::get("API_SUFFIX");

$restaurant_controller = new RestaurantController(
    new \App\Model\Restaurants($mysqli),
    'restaurant',
    ['id', 'name', 'description', 'address', 'rating', 'opening_hours', 'closing_hours', 'estimated_price', 'cuisine_id']
);

$item_controller = new ItemController(
    new \App\Model\Items($mysqli),
    'item',
    ['id', 'name', 'description', 'price', 'restaurant_id']
);

$role_controller = new RoleController(
    new \App\Model\Roles($mysqli),
    'role',
    ['id', 'name']
);

$review_controller = new ReviewController(
    new \App\Model\Review($mysqli),
    'review',
    ['id', 'rating', 'description', 'date', 'restaurant_id', 'user_id']
);


$user_controller = new UserController($mysqli);

$google_auth_controller = new GoogleAuthController($mysqli);

Router::get("/{$api_suffix}/?", function (Request $req, Response $res) {
    $data = new StdClass();
    $data->message = "Welcome to Choppy's API";
    $res->toJSON($data);
});

addRoutesForResource('restaurants', $restaurant_controller);
addRoutesForResource('items', $item_controller);
addRoutesForResource('roles', $role_controller);
addRoutesForResource('reviews', $review_controller);

function addRoutesForResource($resource_name, $controller): void {
    $api_suffix = "api/v1"; // Replace with your own API version suffix

    Router::get("/{$api_suffix}/{$resource_name}/?", [$controller, "getAllRows"]);
    Router::get("/{$api_suffix}/{$resource_name}/(\d+)/?", [$controller, "getOneRowById"]);
    Router::post("/{$api_suffix}/{$resource_name}/?", [$controller, "createRow"]);
    Router::put("/{$api_suffix}/{$resource_name}/(\d+)/?", [$controller, "updateRow"]);
    Router::delete("/{$api_suffix}/{$resource_name}/(\d+)/?", [$controller, "deleteRow"]);
}

//  Retrieves all users
Router::get("/{$api_suffix}/users/?", [$user_controller, "getAllUsers"]);
//  Retrieves one user by its id
Router::get("/{$api_suffix}/users/(\d+)/?", [$user_controller, "getOneUserById"]);
//  Creates a new user
Router::post("/{$api_suffix}/users/?", [$user_controller, "createUser"]);
//  Updates one user by its id
Router::put("/{$api_suffix}/users/(\d+)/?", [$user_controller, "updateUser"]);
//  Deletes one user by its id
Router::delete("/{$api_suffix}/users/(\d+)/?", [$user_controller, "deleteUser"]);

// Retrieves all restaurant items by restaurant id
//Router::get("/{$api_suffix}/restaurants/(\d+)/items/?", [$item_controller, "getAllItemsByRestaurantId"]);

// Authentication
Router::post("/{$api_suffix}/auth/login/?", [$user_controller, "loginUser"]);
Router::post("/{$api_suffix}/auth/register/?", [$user_controller, "registerUser"]);
Router::get("/{$api_suffix}/auth/logout/?", [$user_controller, "logoutUser"]);

Router::get("/{$api_suffix}/auth/verify/?", [$user_controller, "verifyUser"]);

// Google Oauth login
Router::get("/{$api_suffix}/auth/google/url/?", [$google_auth_controller, "getAuthUrl"]);
Router::get("/{$api_suffix}/auth/google/login/?(\?code=.+)?", [$google_auth_controller, "login"]);

App::run();
