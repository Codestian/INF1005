<?php namespace App\Lib\Interfaces;
interface CrudInterface {
    public function create(string $insert, array $column, array $values) : array;
    public function read(array $select, string $from, array $where) : array;
    public function update(string $update, array $set, array $where) : array;
    public function delete(string $delete, array $where) : array;
}