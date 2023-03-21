<?php

use App\Lib\Schema;
use App\Model\Items;

class CreateItemsTable {

    // Modify the table variable to target table.
    public mysqli $mysqli;
    private string $table = "item";
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
        $builder->addColumn("price", "FLOAT", true);
        $builder->addColumn("restaurant_id", "INT", true);

        $builder->setPrimaryKey("id");
        $builder->setForeignKey("restaurant_id", "restaurant", "id");

        $this->mysqli->query($builder->buildCreate());
    }

    //  If you need to insert data right after migration, do it here.
    public function seed() : void {
        //  NOTE: Comment this out in production.
        $items = new Items($this->mysqli);

        $keys = ['name', 'description', 'price', 'restaurant_id'];

        $items->create($this->table, $keys, ['Omelette', 'I like eggs', 12.00, 1]);
        $items->create($this->table, $keys, ['Tomyam Noodle', 'Spicy but delicious', 5.00, 1]);
        $items->create($this->table, $keys, ['McSpicy Burger', 'The chipotle of Singapore', 6.50, 2]);
        $items->create($this->table, $keys, ['French Fries', 'Fries that taste nice', 3.50, 2]);
        $items->create($this->table, $keys, ['McChicken Burger', 'A chicken burger', 3.00, 2]);
        $items->create($this->table, $keys, ['Bolognese Spaghetti', 'Nice noodles with cheese', 10.50, 3]);
    }

}
