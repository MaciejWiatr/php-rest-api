<?php

require_once("BaseModel.php");

class Book extends BaseModel
{
    public string $name;
    public string $author;
    public string $description;

    public function __construct(string $name, string $author, string $description)
    {
        $this->name = $name;
        $this->author = $author;
        $this->description = $description;
    }
}
