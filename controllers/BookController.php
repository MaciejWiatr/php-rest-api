<?php

require_once(__DIR__ . "/../models/Book.php");
require_once(__DIR__ . "/../exceptions/InvalidDataException.php");
require_once(__DIR__ . "/../http_helpers/http_response.php");
require_once(__DIR__ . "/../http_helpers/get_json_request.php");

class BookController extends BaseController
{
    private BookRepository $bookRepository;

    public function __construct(BookRepository $bookRepository)
    {
        header('Content-Type: application/json');
        $this->bookRepository = $bookRepository;
    }

    public function get()
    {
        if (isset($_GET["id"])) {
            $result = $this->bookRepository->getById($_GET["id"]);
        } else {
            $result = $this->bookRepository->getAll();
        }
        if (!$result) {
            http_response(404, "Not found");
        }
        http_response(200, $result);
    }

    public function post()
    {
        $data = get_json_request();
        if (!isset($data["name"]) || !isset($data["description"]) || !isset($data["author"])) {
            throw new InvalidDataException("Invalid data was provided");
        }
        $book = new Book($data["name"], $data["author"], $data["description"]);
        $result = $this->bookRepository->add($book);
        if (!$result) {
            http_response(400, "Bad request");
        }
        http_response(200, "Book was created successfully");
    }
};
