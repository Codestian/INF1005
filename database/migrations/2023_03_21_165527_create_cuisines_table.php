<?php

use App\Lib\Schema;
use App\Model\Cuisine;

class CreateCuisinesTable {

    // Modify the table variable to target table.
    public mysqli $mysqli;
    private string $table = "cuisine";
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
        $cuisine = new Cuisine($this->mysqli);
        $cuisine->create($this->table, ['name'], ['thai']);
        $cuisine->create($this->table, ['name'], ['italian']);
        $cuisine->create($this->table, ['name'], ['chinese']);
        $cuisine->create($this->table, ['name'], ['mexican']);
        $cuisine->create($this->table, ['name'], ['minangkabau']);
        $cuisine->create($this->table, ['name'], ['fast food']);
    }

}
