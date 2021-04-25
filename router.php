<?php

require_once "controllers/BaseController.php";
require_once "http_helpers/http_response.php";


class Router
{
    private static array $routes = array();

    public static function enableJson()
    {
        header('Content-Type: application/json');
    }

    public static function register(string $uri, BaseController $controller)
    {
        if (array_key_exists($uri, self::$routes)) {
            throw new ErrorException("Cannot register two controllers with the same uri");
        } else {
            self::$routes[$uri] = $controller;
        }
    }

    public static function run()
    {
        try {
            $request_uri = $_SERVER["REQUEST_URI"];
            $controller_found = false;
            foreach (self::$routes as $uri => $controller) {
                if (strpos($request_uri, $uri) !== false) {
                    $controller_found = true;

                    switch ($_SERVER["REQUEST_METHOD"]) {
                        case "GET": {
                                $controller->get();
                                break;
                            }
                        case "POST": {
                                $controller->post();
                                break;
                            }
                        default: {
                                echo "Method not supported";
                                break;
                            }
                    }
                }
            }
            if (!$controller_found) {
                http_response(404, "Not found");
            }
        } catch (InvalidDataException $e) {
            http_response(400, "Bad request\n" . $e->getMessage());
        } catch (Error | Exception $e) {
            http_response(500, "Sever error\n" . $e->getMessage());
        }
        exit();
    }
}
