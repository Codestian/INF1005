<?php

use App\Lib\Schema;

class CreateRestaurantsTable {

    public function up() : string {
        $builder = new Schema("restaurants");
        $builder->addColumn("id", "INT", true, true);
        $builder->addColumn("name", "VARCHAR(64)", true);
        $builder->addColumn("description", "TEXT(512)", true);
        $builder->addColumn("address", "VARCHAR(60)", true);

        $builder->setPrimaryKey("id");
        $builder->setUniqueIndex("name_UNIQUE", "name");

        return $builder->build();
    }

}
