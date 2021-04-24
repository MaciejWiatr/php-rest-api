<?php

require_once(__DIR__ . "/../models/Book.php");

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
        $result = $this->bookRepository->getAll();
        echo json_encode($result);
    }

    public function post()
    {
        $inputJSON = file_get_contents('php://input');
        $data = json_decode($inputJSON, TRUE);
        if (!isset($data["name"]) || !isset($data["description"]) || !isset($data["author"])) {
            echo "Invalid data was provided";
        }
        $book = new Book($data["name"], $data["author"], $data["description"]);
        echo $this->bookRepository->add($book);
    }

    public function getById(int $id)
    {
        $result = $this->bookRepository->getById($id);
        echo json_encode($result);
    }
};
