<?php

use App\Lib\Schema;
use App\Model\Roles;

class CreateRolesTable {

    // Modify the table variable to target table.
    public mysqli $mysqli;
    private string $table = "role";
    public function __construct(mysqli $mysqli)
    {
        $this->mysqli = $mysqli;
    }

    // Creates the table with specified configuration.
    public function up() : void {
        $builder = new Schema($this->table);

        // CREATE COLUMNS AND CONSTRAINTS HERE
        $builder->addColumn("id", "INT", true, true);
        $builder->addColumn("name", "VARCHAR(45)", true, false, true);

        $builder->setPrimaryKey("id");

        $this->mysqli->query($builder->buildCreate());
    }

    //  If you need to insert data right after migration, do it here.
    public function seed() : void {
        $roles = new Roles($this->mysqli);
        $roles->create($this->table, ['name'], ['admin']);
        $roles->create($this->table, ['name'], ['c_user']);
        $roles->create($this->table, ['name'], ['r_user']);
    }

}
