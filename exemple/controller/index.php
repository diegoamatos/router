<?php

require dirname(__DIR__, 2) . "/vendor/autoload.php";
require __DIR__ . "/Test/Simple.php";
require __DIR__ . "/Test/Name.php";

use SimpSyst\Router\Router;

define("BASE", "https://www.localhost/simpsyst/router/exemple/controller");
$router = new Router(BASE);

/**
 * routes
 */
$router->namespace("Test");

$router->get("/", "Simple:home");
$router->get("/edit/{id}", "Simple:edit");
$router->post("/edit/{id}", "Simple:edit");

/**
 * group by routes and namespace
 */
$router->group("admin");

$router->get("/", "Simple:admin");
$router->get("/user/{id}", "Simple:admin");
$router->get("/user/{id}/profile", "Simple:admin");
$router->get("/user/{id}/profile/{photo}", "Simple:admin");

/**
 * named routes
 */
$router->group("name");
$router->get("/", "Name:home", "name.home");
$router->get("/hello", "Name:hello", "name.hello");

$router->get("/redirect", "Name:redirect", "name.redirect");
$router->get("/redirect/{category}/{page}", "Name:redirect", "name.redirect");
$router->get("/params/{category}/page/{page}", "Name:params", "name.params");

/**
 * Group Error
 */
$router->group("error")->namespace("Test");
$router->get("/{errcode}", "Simple:notFound");

/**
 * execute
 */
$router->dispatch();

if ($router->error()) {
    var_dump($router->error());
    //router->redirect("/error/{$router->error()}");
}