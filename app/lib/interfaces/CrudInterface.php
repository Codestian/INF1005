<?php namespace App\Lib\Interfaces;
interface CrudInterface {
    public function getAll() : array;
    public function getOne(int $index) : array;
    public function create(array $requestData) : array;
    public function update(int $index, array $requestData) : array;
    public function delete(int $index) : array;
}