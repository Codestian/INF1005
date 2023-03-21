<?php

use App\Lib\Schema;

class CreateReservationsTable {

    // Modify the table variable to target table.
    public mysqli $mysqli;
    private string $table = "reservation";
    public function __construct(mysqli $mysqli)
    {
        $this->mysqli = $mysqli;
    }

    // Creates the table with specified configuration.
    public function up() : void {
        $builder = new Schema($this->table);

        $builder->addColumn("id", "INT", true, true);
        $builder->setPrimaryKey("id");
        $builder->addColumn("datetime", "DATETIME", true, false, true);
        $builder->addColumn("pax", "INT", true);
        $builder->addColumn("pax", "INT", true);

        $this->mysqli->query($builder->buildCreate());
    }

    //  If you need to insert data right after migration, do it here.
    public function seed() : void {
    }

}
