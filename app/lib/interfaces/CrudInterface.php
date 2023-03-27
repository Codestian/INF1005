<?php namespace App\Lib\Interfaces;
interface CrudInterface {
    public function create(string $insert, array $column, array $values) : object;
    public function read(array $select, string $from, array $where) : array;
    public function update(string $update, array $set, array $where) : object;
    public function delete(string $delete, array $where) : object;
}