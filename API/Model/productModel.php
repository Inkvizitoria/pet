<?php


namespace API\Model;


use API\Model;

class productModel extends Model
{

    public function create(string $table, array $parameters): bool
    {
        return parent::create($table, $parameters); // TODO: Create product
    }

    public function read(int $id, string $table = 'product'): array
    {
        return parent::getOne($id, $table); // TODO: Get product
    }

    public function update(string $table, int $id, array $parameters): bool
    {
        return parent::update($table, $id, $parameters); // TODO: Update product
    }

    public function delete(string $table, int $id): bool
    {
        return parent::delete($table, $id); // TODO: Delete product
    }


}