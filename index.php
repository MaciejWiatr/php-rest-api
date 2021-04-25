<?php
require_once "router.php";
require_once "db/DatabaseConnection.php";
require_once "controllers/BookController.php";
require_once "repositories/BookRepository.php";
require_once "controllers/UserController.php";

$bookRepository = new BookRepository($connection);

Router::register('/book', new BookController($bookRepository));
Router::register('/user', new UserController());

Router::enableJson();
Router::run();
