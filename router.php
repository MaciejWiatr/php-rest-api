<?php

require_once "controllers/BaseController.php";


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
            foreach (self::$routes as $uri => $controller) {
                if (strpos($request_uri, $uri) !== false) {
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
        } catch (InvalidDataException $e) {
            echo $e->getMessage();
        } catch (Error | Exception $e) {
            http_response_code(400);
            echo "Bad request\n" . $e->getMessage();
        }
        exit();
    }
}
