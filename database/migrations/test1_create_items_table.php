<?php

use App\Lib\Schema;

class Test1CreateItemsTable {
    public function up() : string {
        // Ensure table name is not plural.
        $builder = new Schema("item");

        $builder->addColumn("id", "INT", true, true);
        $builder->addColumn("name", "VARCHAR(45)", true);
        $builder->addColumn("price", "FLOAT", true);
        $builder->addColumn("restaurant_id", "INT", true, false);

        $builder->setPrimaryKey("id");
        $builder->setForeignKey("restaurant_id", "restaurant", "id");
        $builder->setUniqueIndex("name_UNIQUE", "name");

        return $builder->build();
    }

}
