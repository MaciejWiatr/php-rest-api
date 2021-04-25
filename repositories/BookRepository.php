<?php

require_once("BaseRepository.php");

class BookRepository extends BaseRepository
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * @param Book $entity
     */
    public function add($entity): bool
    {
        $query = ("INSERT INTO books (id,name,author,description) VALUES (null, '$entity->name', '$entity->author', '$entity->description')");
        return $this->db->query($query) === TRUE;
    }

    public function getById(int $id)
    {
        $query = ("SELECT * FROM books WHERE id = $id");
        $result = $this->db->query($query);
        if ($result->num_rows > 0) {
            $rows = $result->fetch_assoc();
            return new Book($rows["name"], $rows["author"], $rows["description"]);
        } else {
            return null;
        }
    }

    public function getAll()
    {
        $query = ("SELECT * FROM books");
        $result = $this->db->query($query);
        $books = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($books, $row);
            }
            return $books;
        } else {
            return null;
        }
    }
}
