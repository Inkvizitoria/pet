<?php


namespace API\Model;


use API\Model;

class placeModel extends Model
{

    public function create(string $table, array $parameters): bool
    {
        return parent::create($table, $parameters); // TODO: Create place
    }

    public function read(int $id, string $table = 'place'): array
    {
        return parent::getOne($id, $table); // TODO: Get place
    }

    public function update(string $table, int $id, array $parameters): bool
    {
        return parent::update($table, $id, $parameters); // TODO: Update place
    }

    public function delete(string $table, int $id): bool
    {
        return parent::delete($table, $id); // TODO: Delete place
    }

}