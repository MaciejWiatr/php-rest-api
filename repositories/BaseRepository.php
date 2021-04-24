<?php

abstract class BaseRepository
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    abstract public function add($entity);

    public function getById(int $id)
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
