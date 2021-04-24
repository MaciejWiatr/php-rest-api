<?php

abstract class BaseRepository
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    abstract public function add(...$args);

    public function getById()
    {
        throw new ErrorException("Not implemented");
    }

    public function getAll()
    {
        throw new ErrorException("Not implemented");
    }

    public function remove()
    {
        throw new ErrorException("Not implemented");
    }
}
