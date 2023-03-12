<?php
require __DIR__ . '/vendor/autoload.php';

use App\Lib\App;
use App\Lib\Router;
use App\Lib\Request;
use App\Lib\Response;
use App\Model\Posts;

use App\Controller\Home;
use App\Controller\About;
use App\Controller\Contact;
use App\Controller\Login;
use App\Controller\Register;
use App\Controller\BookingOne;
use App\Controller\BookingTwo;
use App\Controller\BookingThree;
use App\Controller\User;
use App\Controller\Apply;
use App\Controller\Restaurant;
use App\Controller\Favourite;
use App\Controller\Bookings;
use App\Controller\MasterDir;
use App\Controller\Admin;
use App\Controller\North;
use App\Controller\Central;
use App\Controller\East;
use App\Controller\West;

Posts::load();

Router::get('/', function () {
    (new Home())->indexAction();
});

// About Us Page.
Router::get('/about', function () {
    (new About())->indexAction();
});

// Contact Us Page.
Router::get('/contact', function () {
    (new Contact())->indexAction();
});

// Log in Page.
Router::get('/login', function () {
    (new Login())->indexAction();
});

// Sign up Page.
Router::get('/register', function () {
    (new Register())->indexAction();
});

// Booking Restaurant Page 1.
Router::get('/bookingone', function () {
    (new BookingOne())->indexAction();
});

// Only go to Booking two when Booking One details are filled in successfully.
Router::get('/bookingtwo', function () {
    (new BookingTwo())->indexAction();
});

// Only go to Booking three when Booking One & Two details are filled in successfully.
Router::get('/bookingthree', function () {
    (new BookingThree())->indexAction();
});

// ONLY FOR USERS THAT ARE LOG-IN
Router::get('/user', function () {
    (new User())->indexAction();
});

// Restaurant Application Page
Router::get('/apply', function () {
    (new Apply())->indexAction();
});

// Restaurant Page ( INDIVIDUAL )
Router::get('/restaurant', function () {
    (new Restaurant())->indexAction();
});

// User Favourite Restaurant Page (REQUIRES LOGIN)
Router::get('/favourite', function () {
    (new Favourite())->indexAction();
});

// User's Bookings Page (REQUIRES LOGIN)
Router::get('/bookings', function () {
    (new Bookings())->indexAction();
});

// Restaurant Master Directory Page
Router::get('/master', function () {
    (new MasterDir())->indexAction();
});

// Admin Page ( Adds & Remove Restaurant List ) [ MUST BE AN ADMIN TO GO TO PAGE ]
Router::get('/admin', function () {
    (new Admin())->indexAction();
});

// North Side Directory Page
Router::get('/north', function () {
    (new North())->indexAction();
});

// Central Side Directory Page
Router::get('/central', function () {
    (new Central())->indexAction();
});

// East Side Directory Page
Router::get('/east', function () {
    (new East())->indexAction();
});

// West Side Directory Page
Router::get('/west', function () {
    (new West())->indexAction();
});

// The below code is for backend API, frontend is above.

Router::get('/post', function (Request $req, Response $res) {
    $res->toJSON(Posts::all());
});

Router::post('/post', function (Request $req, Response $res) {
    $post = Posts::add($req->getJSON());
    $res->status(201)->toJSON($post);
});

Router::get('/post/([0-9]*)', function (Request $req, Response $res) {
    $post = Posts::findById($req->params[0]);
    if ($post) {
        $res->toJSON($post);
    } else {
        $res->status(404)->toJSON(['error' => "Not Found"]);
    }
});

App::run();