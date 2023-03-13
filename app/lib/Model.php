<?php namespace App\Lib;

use App\Lib\Interfaces\CrudInterface;

abstract class Model implements CrudInterface {
    public function getAll(): array
    {
        // TODO: Implement getAll() method.
    }

    public function getOne(int $index): array
    {
        // TODO: Implement getOne() method.
    }

    public function create(array $requestData): array
    {
        // TODO: Implement create() method.
    }

    public function update(int $index, array $requestData): array
    {
        // TODO: Implement update() method.
    }

    public function delete(int $index): array
    {
        // TODO: Implement delete() method.
    }

}