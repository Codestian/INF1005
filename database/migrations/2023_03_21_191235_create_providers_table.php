<?php

use App\Lib\Schema;
use App\Model\Provider;

class CreateProvidersTable {

    // Modify the table variable to target table.
    public mysqli $mysqli;
    private string $table = "provider";
    public function __construct(mysqli $mysqli)
    {
        $this->mysqli = $mysqli;
    }

    // Creates the table with specified configuration.
    public function up() : void {
        $builder = new Schema($this->table);

        $builder->addColumn("id", "INT", true, true);
        $builder->addColumn("name", "VARCHAR(45)", true, false, true);

        $builder->setPrimaryKey("id");

        $this->mysqli->query($builder->buildCreate());
    }

    //  If you need to insert data right after migration, do it here.
    public function seed() : void {
        $roles = new Provider($this->mysqli);
        $roles->create($this->table, ['name'], ['traditional']);
        $roles->create($this->table, ['name'], ['google']);
        $roles->create($this->table, ['name'], ['apple']);
        $roles->create($this->table, ['name'], ['microsoft']);
    }

}
