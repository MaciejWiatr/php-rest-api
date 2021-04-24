<?php

require_once "controllers/BaseController.php";
require_once "handlers/errorHandler.php";


class Router
{
    private static array $routes = array();

    public static function register(string $uri, BaseController $controller)
    {
        if (array_key_exists($uri, self::$routes)) {
            throw new ErrorException("Cannot register two controllers to the same uri");
        } else {
            self::$routes[$uri] = $controller;
        }
    }

    public static function run()
    {
        set_error_handler("myErrorHandler");
        try {
            $request_uri = $_SERVER["REQUEST_URI"];
            foreach (self::$routes as $uri => $controller) {
                if (strpos($request_uri, $uri) !== false) {
                    switch ($_SERVER["REQUEST_METHOD"]) {
                        case "GET": {
                                if (isset($_GET["id"])) {
                                    $controller->getById($_GET["id"]);
                                } else {
                                    $controller->get();
                                }
                                break;
                            }
                        case "POST": {
                                $controller->post();
                                break;
                            }
                        default: {
                                throw new ErrorException("Method not supported");
                                break;
                            }
                    }
                } else {
                    echo "404 Not found";
                }
            }
        } catch (Error | Exception $e) {
            echo "Error occured";
            exit();
        }
    }
}
