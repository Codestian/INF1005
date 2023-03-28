<?php

use App\Lib\Schema;
use App\Model\Roles;

class CreateRegionsTable {

    // Modify the table variable to target table.
    public mysqli $mysqli;
    private string $table = "region";
    public function __construct(mysqli $mysqli)
    {
        $this->mysqli = $mysqli;
    }

    // Creates the table with specified configuration.
    public function up() : void {
        $builder = new Schema($this->table);

        // CREATE COLUMNS AND CONSTRAINTS HERE
        $builder->addColumn("id", "INT", true, true);
        $builder->addColumn("name", "VARCHAR(10)", true, false, true);

        $builder->setPrimaryKey("id");

        $this->mysqli->query($builder->buildCreate());
    }

    //  If you need to insert data right after migration, do it here.
    public function seed() : void {
        $roles = new Roles($this->mysqli);
        $roles->create($this->table, ['name'], ['north']);
        $roles->create($this->table, ['name'], ['south']);
        $roles->create($this->table, ['name'], ['east']);
        $roles->create($this->table, ['name'], ['west']);
    }

}
