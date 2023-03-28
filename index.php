<?php
require __DIR__ . "/vendor/autoload.php";

use App\Controller\Api\ItemController;
use App\Controller\Api\RoleController;
use App\Controller\Api\UserController;

use App\Controller\Api\Providers\GoogleAuthController;

use App\Controller\Api\RestaurantController;
use App\Lib\App;
use App\Lib\Config;
use App\Lib\Database;
use App\Lib\Request;
use App\Lib\Response;
use App\Lib\Router;

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

$restaurant_controller = new RestaurantController($mysqli);
$item_controller = new ItemController($mysqli);
$user_controller = new UserController($mysqli);
$role_controller = new RoleController($mysqli);

$google_auth_controller = new GoogleAuthController($mysqli);

Router::get("/{$api_suffix}/?", function (Request $req, Response $res) {
    $data = new StdClass();
    $data->message = "Welcome to Choppy's API";
    $res->toJSON($data);
});

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
Router::delete("/{$api_suffix}/users/(\d+)/?", [$user_controller, "deleteUser"]);

//  Retrieves all roles
Router::get("/{$api_suffix}/roles/?", [$role_controller, "getAllRoles"]);
//  Retrieves one role by its id
Router::get("/{$api_suffix}/roles/(\d+)/?", [$role_controller, "getOneRoleById"]);
//  Creates a new role
Router::post("/{$api_suffix}/roles/?", [$role_controller, "createRole"]);
//  Updates one role by its id
Router::put("/{$api_suffix}/roles/(\d+)/?", [$role_controller, "updateRole"]);
//  Deletes one role by its id
Router::delete("/u{$api_suffix}/roles/(\d+)/?", [$role_controller, "deleteRole"]);

// Retrieves all restaurant items by restaurant id
Router::get("/{$api_suffix}/restaurants/(\d+)/items/?", [$item_controller, "getAllItemsByRestaurantId"]);

// Authentication
Router::post("/{$api_suffix}/auth/login/?", [$user_controller, "loginUser"]);
Router::post("/{$api_suffix}/auth/register/?", [$user_controller, "registerUser"]);
Router::get("/{$api_suffix}/auth/logout/?", [$user_controller, "logoutUser"]);

Router::get("/{$api_suffix}/auth/verify/?", [$user_controller, "verifyUser"]);

// Google Oauth login
Router::get("/{$api_suffix}/auth/google/url/?", [$google_auth_controller, "getAuthUrl"]);
Router::get("/{$api_suffix}/auth/google/login/?(\?code=.+)?", [$google_auth_controller, "login"]);

//Router::get(".*", function() {
//    include("routes/404.php");
//});

App::run();
