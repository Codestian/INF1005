<?php

use App\Lib\Schema;
use App\Model\Restaurants;

class CreateRestaurantsTable {

    // Modify the table variable to target table.
    public mysqli $mysqli;
    private string $table = "restaurant";
    public function __construct(mysqli $mysqli)
    {
        $this->mysqli = $mysqli;
    }

    // Creates the table with specified configuration.
    public function up() : void {
        $builder = new Schema($this->table);

        // CREATE COLUMNS AND CONSTRAINTS HERE
        $builder->addColumn("id", "INT", true, true);
        $builder->addColumn("name", "VARCHAR(64)", true, false, true);
        $builder->addColumn("description", "TEXT(512)", true);
        $builder->addColumn("address", "VARCHAR(60)", true);
        $builder->addColumn("rating", "INT", true);
        $builder->addColumn("opening_hours", "INT", true);
        $builder->addColumn("closing_hours", "INT", true);
        $builder->addColumn("estimated_price", "INT", true);
        $builder->addColumn("cuisine_id", "INT", true);

        $builder->setPrimaryKey("id");
        $builder->setForeignKey("cuisine_id", "cuisine", "id");

        $this->mysqli->query($builder->buildCreate());
    }

    //  If you need to insert data right after migration, do it here.
    public function seed() : void {
        //  NOTE: Comment this out in production.
        $restaurants = new Restaurants($this->mysqli);

        $keys = ['name', 'description', 'address', 'rating', 'opening_hours', 'closing_hours', 'estimated_price', 'cuisine_id'];

        $restaurants->create($this->table, $keys, ['Saap Saap Thai', 'Berry nice food', 'Tampines Hub', 5, 1000, 2200, 14, 1]);
        $restaurants->create($this->table, $keys, ['McDonalds', 'McSpicy makes me poop', 'Temasek Polytechnic', 4, 1100, 2100, 12, 6]);
        $restaurants->create($this->table, $keys, ['Saizeriya', 'Microwaved dishes', 'Jurong Point Mall', 2, 1200, 0000, 9, 2]);
    }

}
