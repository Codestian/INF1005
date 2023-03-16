<?php

use App\Lib\Schema;

class Test2CreateRolesTable {
    public function up() : string {
        $builder = new Schema("role");

        $builder->addColumn("id", "INT", true, true);
        $builder->addColumn("role", "VARCHAR(45)", true);

        $builder->setPrimaryKey("id");
        $builder->setUniqueIndex("name_UNIQUE", "role");

        return $builder->build();
    }

}
