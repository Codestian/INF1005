<?php

use App\Lib\Schema;

class MigrationTemplate {

    // Modify the table variable to target table.
    public mysqli $mysqli;
    private string $table = "";
    public function __construct(mysqli $mysqli)
    {
        $this->mysqli = $mysqli;
    }

    // Creates the table with specified configuration.
    public function up() : void {
        $builder = new Schema($this->table);

        $builder->addColumn("id", "INT", true, true);
        // CREATE COLUMNS AND CONSTRAINTS HERE
        $builder->setPrimaryKey("id");

        $this->mysqli->query($builder->buildCreate());
    }

    //  If you need to insert data right after migration, do it here.
    public function seed() : void {
    }

}
