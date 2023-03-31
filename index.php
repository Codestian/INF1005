<?php
require __DIR__ . "/vendor/autoload.php";

use App\Controller\Api\Providers\GoogleAuthController;

use App\Controller\CuisineController;
use App\Controller\ProviderController;
use App\Controller\RegionController;
use App\Controller\ReservationController;
use App\Controller\RestaurantController;
use App\Controller\ItemController;
use App\Controller\ReviewController;
use App\Controller\RoleController;
use App\Controller\UserController;

use App\Lib\App;
use App\Lib\Config;
use App\Lib\Database;
use App\Lib\Request;
use App\Lib\Response;
use App\Lib\Router;
use App\Model\Cuisine;
use App\Model\Items;
use App\Model\Provider;
use App\Model\Region;
use App\Model\Reservation;
use App\Model\Restaurants;
use App\Model\Review;
use App\Model\Roles;

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
Router::get("/privacy-policy/?", fn() => include("routes/Privacy.php"));
Router::get("/terms-and-conditions/?", fn() => include("routes/Terms.php"));

Router::get("/profile/?", fn() => include("routes/auth/Profile.php"));

Router::get("/login", fn() => include "routes/auth/Login.php");
Router::get("/register", fn() => include "routes/auth/Register.php");
Router::get("/auth/redirect/google/?(/?\?.*)", fn() => include "routes/auth/RedirectGoogle.php");

Router::get("/admin/dashboard/?", fn() => include "routes/admin/Home.php");
Router::get("/admin/dashboard/([a-z]+)/?", function(Request $req, Response $res) {
    $table_name = $req->params[0];
    include("routes/admin/Dashboard.php");
});

Router::get("/admin/login/?", fn() => include("routes/admin/Login.php"));

// The below code is for backend API, frontend is above.
$mysqli = (new Database())->getConnection();

$api_suffix = Config::get("API_SUFFIX");

$restaurant_controller = new RestaurantController(
    new Restaurants($mysqli),
    'restaurant',
    ['id', 'name', 'description', 'address', 'rating', 'opening_hours', 'closing_hours', 'estimated_price', 'cuisine_id', 'region_id']
);

$item_controller = new ItemController(
    new Items($mysqli),
    'item',
    ['id', 'name', 'description', 'price', 'restaurant_id']
);

$role_controller = new RoleController(
    new Roles($mysqli),
    'role',
    ['id', 'name']
);

$region_controller = new RegionController(
    new Region($mysqli),
    'region',
    ['id', 'name']
);

$review_controller = new ReviewController(
    new Review($mysqli),
    'review',
    ['id', 'rating', 'description', 'date', 'restaurant_id', 'user_id']
);

$cuisine_controller = new CuisineController(
    new Cuisine($mysqli),
    'cuisine',
    ['id', 'name']
);

$reservation_controller = new ReservationController(
    new Reservation($mysqli),
    'reservation',
    ['id', 'datetime', 'pax', 'user_id', 'restaurant_id']
);

$provider_controller = new ProviderController(
    new Provider($mysqli),
    'provider',
    ['id', 'name']
);

$user_controller = new UserController(
    new Provider($mysqli),
    'user',
    ['id', 'username', 'email', 'password', 'role_id', 'provider_id']
);


Router::get("/{$api_suffix}/?", function (Request $req, Response $res) {
    $data = new StdClass();
    $data->message = "Welcome to Choppy's API";
    $res->toJSON($data);
});

$google_auth_controller = new GoogleAuthController($mysqli);

addRoutesForResource('restaurants', $restaurant_controller);
addRoutesForResource('items', $item_controller);
addRoutesForResource('roles', $role_controller);
addRoutesForResource('regions', $region_controller);
addRoutesForResource('reviews', $review_controller);
addRoutesForResource('cuisines', $cuisine_controller);
addRoutesForResource('reservations', $reservation_controller);
addRoutesForResource('providers', $provider_controller);
addRoutesForResource('users', $user_controller);

// Retrieves all restaurant items by restaurant id
Router::get("/{$api_suffix}/restaurants/(\d+)/items/?", [$item_controller, "getAllRowsByRestaurantId"]);

// Retrieves all restaurants by region id
Router::get("/{$api_suffix}/regions/(\d+)/restaurants/?", [$restaurant_controller, "getAllRowsByRegionId"]);

// Authentication
Router::post("/{$api_suffix}/auth/login/?", [$user_controller, "loginUser"]);
Router::post("/{$api_suffix}/auth/register/?", [$user_controller, "registerUser"]);
Router::get("/{$api_suffix}/auth/logout/?", [$user_controller, "logoutUser"]);
Router::get("/{$api_suffix}/auth/verify/?", [$user_controller, "verifyUser"]);

// Google Oauth login
Router::get("/{$api_suffix}/auth/google/url/?", [$google_auth_controller, "getAuthUrl"]);
Router::get("/{$api_suffix}/auth/google/login/?(\?code=.+)?", [$google_auth_controller, "login"]);

function addRoutesForResource($resource_name, $controller): void {
    $api_suffix = "api/v1"; // Replace with your own API version suffix

    Router::get("/{$api_suffix}/{$resource_name}/?", [$controller, "getAllRows"]);
    Router::get("/{$api_suffix}/{$resource_name}/(\d+)/?", [$controller, "getOneRowById"]);
    Router::post("/{$api_suffix}/{$resource_name}/?", [$controller, "createRow"]);
    Router::put("/{$api_suffix}/{$resource_name}/(\d+)/?", [$controller, "updateRow"]);
    Router::delete("/{$api_suffix}/{$resource_name}/(\d+)/?", [$controller, "deleteRow"]);
}

App::run();
