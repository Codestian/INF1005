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
        $builder->addColumn("region_id", "INT", true);

        $builder->setPrimaryKey("id");
        $builder->setForeignKey("cuisine_id", "cuisine", "id");
        $builder->setForeignKey("region_id", "region", "id");

        $this->mysqli->query($builder->buildCreate());
    }

    //  If you need to insert data right after migration, do it here.
    public function seed() : void {
        //  NOTE: Comment this out in production.
        $restaurants = new Restaurants($this->mysqli);

        $keys = ['name', 'description', 'address', 'rating', 'opening_hours', 'closing_hours', 'estimated_price', 'cuisine_id', 'region_id'];

        $restaurants->create($this->table, $keys, ['Saap Saap Thai', 'Vivamus at semper turpis. Praesent suscipit quam vitae consectetur varius. Vivamus condimentum nunc vel lacus sagittis, eu varius sapien aliquam. Fusce pretium et mi ac facilisis. Nulla facilisi. Donec iaculis faucibus urna. Praesent ultrices finibus ultricies.', 'Tampines Hub', 5, 1000, 2200, 14, 1, 1]);
        $restaurants->create($this->table, $keys, ['McDonalds', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In pharetra elit sit amet erat malesuada egestas nec sed massa. Mauris felis ipsum, sodales nec pharetra nec, suscipit id quam. Integer condimentum mi orci, ac pretium dui iaculis in. Nulla placerat diam turpis, id pretium ex vestibulum ut.', 'Temasek Polytechnic', 4, 1100, 2100, 12, 6, 4]);
        $restaurants->create($this->table, $keys, ['Saizeriya', 'Mauris quis risus tempus, aliquam lacus nec, posuere diam. Nulla at magna quis urna condimentum blandit sed tristique arcu. Praesent viverra erat sapien, eget maximus dolor posuere congue.', 'Jurong Point Mall', 2, 1200, 0000, 9, 2, 3]);
        $restaurants->create($this->table, $keys, ['Jinjjia Chicken', 'Nulla sit amet ipsum maximus eros ornare vestibulum. Ut ut iaculis turpis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Quisque consectetur, nibh et bibendum posuere, enim tellus facilisis metus, non dapibus odio felis vitae justo.', 'Jurong East', 5, 1000, 2200, 14, 2, 1]);
        $restaurants->create($this->table, $keys, ['Sushi Stuff', 'Donec diam nulla, faucibus sed placerat tincidunt, mattis vitae ante. Mauris quis risus tempus, aliquam lacus nec, posuere diam. Nulla at magna quis urna condimentum blandit sed tristique arcu.', 'AMK Hub', 5, 1000, 2200, 14, 1, 2]);
        $restaurants->create($this->table, $keys, ['KFC', 'Quisque ac ultrices dui, a placerat lectus. Sed nibh odio, sodales at arcu vitae, feugiat pretium nisl. Quisque in orci nec erat mattis aliquam eu eget mi.', 'Bugis', 5, 1000, 2200, 14, 6, 2]);

    }

}
