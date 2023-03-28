<?php

use App\Lib\Schema;

class CreateReviewsTable {

    // Modify the table variable to target table.
    public mysqli $mysqli;
    private string $table = "review";
    public function __construct(mysqli $mysqli)
    {
        $this->mysqli = $mysqli;
    }

    // Creates the table with specified configuration.
    public function up() : void {
        $builder = new Schema($this->table);

        $builder->addColumn("id", "INT", true, true);
        $builder->addColumn("rating", "INT", true);
        $builder->addColumn("description", "TEXT(512)", true);
        $builder->addColumn("date", "DATETIME", true);
        $builder->addColumn("restaurant_id", "INT", true);
        $builder->addColumn("user_id", "INT", true);

        $builder->setPrimaryKey("id");
        $builder->setForeignKey("restaurant_id", "restaurant", "id");
        $builder->setForeignKey("user_id", "user", "id");

        $this->mysqli->query($builder->buildCreate());
    }

    //  If you need to insert data right after migration, do it here.
    public function seed() : void {
    }

}
