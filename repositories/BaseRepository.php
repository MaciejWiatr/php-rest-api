<?php

abstract class BaseRepository
{
    private $db;

    abstract public function __construct($db);

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
